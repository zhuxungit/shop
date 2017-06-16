<?php
namespace Home\Controller;

use Think\Controller;

/**
 * 订单类
 * Class OrderController
 * @package Home\Controller
 */
class OrderController extends Controller
{

    /**
     * 支付方式：支付宝
     */
    public function alipay()
    {
        $order_sn = I('order_sn');
//        p($_GET);die;
        $ordermodel = M('OrderInfo');
        $orderdata = $ordermodel->where("order_sn='$order_sn'")->find();
        $orderdata['title'] = '商城-商品购买';
        $orderdata['body']  = '商城内部购买的商品';

        //引入alipay提交文件
        vendor("alipay.alipay_submit#class");
        //引入alipay配置文件
        $alipay_config = C('PAY_ALIPAY');
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => $alipay_config['service'],
            "partner" => $alipay_config['partner'],
            "seller_id" => $alipay_config['seller_id'],
            "payment_type" => $alipay_config['payment_type'],
            "notify_url" => $alipay_config['notify_url'],
            "return_url" => $alipay_config['return_url'],

            "anti_phishing_key" => $alipay_config['anti_phishing_key'],
            "exter_invoke_ip" => $alipay_config['exter_invoke_ip'],
            "out_trade_no" => $orderdata['order_sn'],
            "subject" => $orderdata['title'],
            "total_fee" => $orderdata['order_amount'],
            "body" => $orderdata['body'],
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
            //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
            //如"参数名"=>"参数值"
        );

        //alipay建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;

    }


    /**
     * 处理订单
     */
    public function done()
    {
        $cartmodel = D('Cart');

        //做限制，如果没有商品则退出
        $total = $cartmodel->getTotal();
        if ($total['total_number'] == 0) {
            $this->error('当前购物车木有商品，不能下订单哦');
        }

        //判断是否登录，没有登录则先登录，登录完成再跳回来
        $user_id = session('user_id');
        if ($user_id < 0) {
            //木有登录
            session('redirect_url', 'Order/flow');
            $this->redirect('user/login');
        }

        //判断是否填写收货人地址
        $addressinfo = M('Address')->where("user_id = $user_id")->limit(1)->find();
        if (!$addressinfo) {
            //没有填写
            $this->redirect('writeaddress');
        }

        //订单信息入库
        $ordermodel = M('OrderInfo');
        $ordermodel->create();//注：创建数据对象后才能对表字段数据进行赋值添加
        $ordermodel->order_amount = $total['total_price'];
        $ordermodel->order_sn = 'sn_' . date('Y-m-d') . time() . rand(1000, 9999);
        $ordermodel->user_id = $user_id;
        $ordermodel->order_created_time = time();
        $order_id = $ordermodel->add();

        //插入it_order_goods表
        $cartdata = $cartmodel->cartList();

//        p($cartdata);die;
        //判断商品库存是否充足
        $productmodel = M('Product');
        foreach ($cartdata as $k => $v) {
            //出现问题：当前商品在购物车中，如果此时更改商品属性，则购物车里商品的原商品属性id就不存在，所以，清除购物车里的商品在商品属性表中不存在的商品


            //取出库存信息，如果商品没有属性则直接从goods表中取出，如果有则从商品库存表中取出
            if (empty($v['goods_attr_id'])) {
                //商品没有属性则直接从goods表中取出
                $proinfo = M('Goods')->where("goods_id = " . $v['goods_id'])->find();
            } else {
                $proinfo = $productmodel->where("goods_id = " . $v['goods_id'] . " and goods_attr_id ='" . $v['goods_attr_id'] . "'")->find();
            }
//            echo  $productmodel->_sql();die;
            if ($proinfo['goods_number'] < $v['goods_count']) {
                $this->error('库存不足，无法完成下订单');
            }

            M('OrderGoods')->add([
                'order_id' => $order_id,
                'goods_id' => $v['goods_id'],
                'goods_name' => $v['info']['goods_name'],
                'shop_price' => $v['info']['shop_price'],
                'goods_attr_id' => $v['goods_attr_id'],
                'goods_count' => $v['goods_count']
            ]);

            //订单入库成功后减掉商品库存要更新
            $productmodel->where("goods_id = " . $v['goods_id'] . " and goods_attr_id ='" . $v['goods_attr_id'] . "'")->setDec('goods_number', $v['goods_count']);
            //总的商品表中库存也要减掉
            $goodsmodel = D('Goods');
            $goodsmodel->where("id = " . $v['goods_id'])->setDec('goods_number', $v['goods_count']);

        }

        //清空购物车数据
        $cartmodel->clear();

        //跳转订单完成页面
        $orderdata = $ordermodel->find($order_id);
        $this->redirect('finish', [
            'order_sn' => $orderdata['order_sn'],
            'pay_type' => $orderdata['pay_type'],
            'shipping_type' => $orderdata['shipping_type'],
            'order_amount' => $orderdata['order_amount']
        ]);

    }

    /**
     * 下订单
     */
    public function flow()
    {
        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //判断购物车有无商品
        $cartmodel = D('Cart');
        $totle = $cartmodel->getTotal();
        if ($totle == 0) {
            $this->error('当前购物车木有商品，无法下订单哦');
        }

        //判断用户是否登录，如果没有登录跳转登录页面，登录完成再跳回来
        $user_id = session('user_id');
        if (empty($user_id)) {
            //没有登录
            session('redirect_url', 'Order/flow');
            $this->redirect('user/login');
        }

        //取出收件人信息
        $addressmodel = M('Address');
        $addressinfo = $addressmodel->where("user_id=$user_id")->limit(1)->find();
//        $addressinfo = $addressmodel->where("user_id=$user_id")->select();

        //判断用户是否填写收货人地址
        if (!$addressinfo) {
            $this->redirect('writeaddress');
        }
        $this->assign('addressinfo', $addressinfo);

        //获取购物车总数量以及总价格
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

//      商品详情页点击立即购买
        $cartmodel = D('Cart');
        if (IS_POST) {
            $post = I('post.');
            $goods_id = $post['goods_id'];
            $goods_count = $post['goods_count'];
            $goods_attr_id = implode(',', $post['attr']);
            $user_id = $post['user_id'];

            $arr = $cartmodel->where("goods_id=" . $goods_id . " and goods_attr_id ='" . $goods_attr_id . "' and user_id=" . $user_id)->find();
            if (!$arr) {
                $cartmodel->add([
                    'goods_id' => $goods_id,
                    'goods_count' => $goods_count,
                    'goods_attr_id' => $goods_attr_id,
                    'user_id' => $user_id
                ]);
            } else {
                $cartmodel->save([
                    'goods_id' => $goods_id,
                    'goods_count' => $goods_count + $arr['goods_count'],
                    'goods_attr_id' => $goods_attr_id,
                    'user_id' => $user_id
                ]);
            }
        }

        //取出订单商品数据
        $cartdata = $cartmodel->cartList();
//        p($cartdata);die;
        $this->assign('cartdata', $cartdata);

        $this->display();
    }

    public function finish()
    {
        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

        $this->display();
    }

    /**
     * 收货人信息写入数据库
     */
    public function writeaddress()
    {
        $user_id = session('user_id');

        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);


        $addressmodel = M('Address');
        if (IS_POST) {
            if ($addressmodel->create()) {
                if ($addressmodel->add()) {
                    $this->success('收货人信息添加成功', U('order/flow'));
                    exit;
                } else {
                    $this->error('收货人信息添加失败');
                }
            } else {
                $this->error('收货人信息填写不规范');
            }
        }

        //取出收件人信息
        $addressmodel = M('Address');
        $addressinfo = $addressmodel->where("user_id=$user_id")->limit(1)->find();
        $this->assign('addressinfo', $addressinfo);

        $this->display();
    }
}