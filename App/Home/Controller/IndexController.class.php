<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    /**
     *
     * 短信验证码
     */
    public function phoneCode()
    {
//        p($_POST);die;
        $phonenum = I('phonenum');
        $rand = rand(1000, 9999);
        //Demo调用
        //**************************************举例说明***********************************************************************
        //*假设您用测试Demo的APP ID，则需使用默认模板ID 1，发送手机号是13800000000，传入参数为6532和5，则调用方式为           *
        //*result = sendTemplateSMS("13800000000" ,array('6532','5'),"1");																		  *
        //*则13800000000手机号收到的短信内容是：【云通讯】您使用的是云通讯短信模板，您的验证码是6532，请于5分钟内正确输入     *
        //*********************************************************************************************************************
        $res = sendTemplateSMS($phonenum, array($rand, '5'), "1");//手机号码，替换内容数组，模板ID
        if ($res['code'] == 0) {
            $this->success($res['msg']);
        } else {
            $this->error('系统繁忙....');
        }
    }

    /**
     * 通过ip获取用户所在位置信息
     * @return array
     */
    public function getLocation()
    {
        //实例化，指定IP数据库
        $location = new \Org\Net\IpLocation('qqwry.dat');
        //将ip传进函数获取ip信息
        $ip = get_client_ip();
        $ipdata = $location->getlocation($ip);
        //转码操作
//        $iparea = iconv('GBK', 'UTF-8', $ipdata['country'] . $ipdata['area']);
//        $this->assign('iparea', $iparea);
        return $ipdata;
    }

    /**
     * 获取天气信息
     */
    public function getWeather()
    {
        $ipdata = $this->getLocation();
//        $location = iconv('GBK','UTF-8',$ipdata['area']);
//        p($location);die;
        $location = '上海';
        $url = "http://api.map.baidu.com/telematics/v2/weather?location=" . $location . "&ak=B8aced94da0b345579f481a1294c9094";
        $weatherdata = file_get_contents($url);
        $weatherxmlobj = simplexml_load_string($weatherdata);
        $resdata = $weatherxmlobj->results->result;
        return $nowwea = $resdata[0]->date . $resdata[0]->weather . '<img height=22  src="' . $resdata[0]->dayPictureUrl . '"/>';
    }

    /**
     * 前台首页
     */
    public function index()
    {
        //获得天气信息
        $nowwea = $this->getWeather();
        $this->assign('nowwea', $nowwea);
        //获取ip信息
        $ipdata = $this->getLocation();
        //转码操作
        $iparea = iconv('GBK', 'UTF-8', $ipdata['country'] . $ipdata['area']);
        $this->assign('iparea', $iparea);

        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);
//        p($iparea);die;
        //侧边栏目数据
        $lanmudata = $catemodel->order('id asc')->select();
        $this->assign('lanmudata', $lanmudata);
//        p($iparea);die;

        //取出精品、热品、新品
        $goodsmodel = D('Admin/Goods');
        $bestdata = $goodsmodel->getByGoods('best', 3);
        $newdata = $goodsmodel->getByGoods('new', 3);
        $hotdata = $goodsmodel->getByGoods('hot', 3);
        $this->assign('bestdata', $bestdata);
        $this->assign('newdata', $newdata);
        $this->assign('hotdata', $hotdata);
//        p($iparea);die;

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
//        p($total);die;
        $this->assign('total', $total);
//        p($iparea);die;

        $goodsmodel = D('Goods');
        $goodsdata = $goodsmodel->where("is_delete=0")->order("goods_sales desc")->select();
        $this->assign('goodssales', $goodsdata);

        $this->display();
    }

    /**
     * 取出侧边栏分类对应分类数据
     */
    public function category()
    {
        $cat_id = (int)$_GET['cat_id'];
        //返回前台页面，用于导航栏选项卡
        $this->assign('cat_id', $cat_id);
        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //取出所有商品分类
        $catemodel = D('Admin/Category');
        $cateChild = $catemodel->getChild($cat_id);
        if (empty($cateChild)) {
            $cateChild[] = $cat_id;
        }
        $catedatastr = implode(',', $cateChild);

        //面包屑导航栏
        $breaddata = $catemodel->getFamily($cat_id);
        $this->assign('breaddata', $breaddata);

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

        //取出分类对应商品
        $goodsmodel = D('Admin/goods');
        $goodsdata = $goodsmodel->where("is_delete=0 and cat_id in (" . $catedatastr . ")")->select();
        $this->assign('goodsdata', $goodsdata);

        $this->display();
    }

    /**
     * 商品详情
     */
    public function detail()
    {
        $goods_id = (int)$_GET['id'];
        //商品点击数自增
        $goodsmodel = D('goods');
        $goodsmodel->where("id=$goods_id")->setInc('goods_click');

        //对应商品详细数据
        $goodsdata = $goodsmodel->where("id=$goods_id")->find();
        $this->assign('goodsdata', $goodsdata);

        //取出商品相册图
        $albumpics = D('GoodsAlbum');
        $albumdata = $albumpics->where("goods_id=$goods_id")->select();
        $this->assign('albumdata', $albumdata);

        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //面包屑导航栏
        $breaddata = $catemodel->getFamily($goodsdata['cat_id']);
        $this->assign('breaddata', $breaddata);

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

        //取出商品属性
        $attrmodel = D('Attribute');
        $goodsattr = $attrmodel->field('a.attr_name,a.attr_type,b.*')->join("a left join it_goods_attr as b on b.attr_id = a.id ")->where("b.goods_id=$goods_id")->select();

        //构建三维数组，便于遍历
        $radiodata = [];
        foreach ($goodsattr as $v) {
            if ($v['attr_type'] == 1) {
                $radiodata[$v['attr_id']][] = $v;
            }
        }
//        P($radiodata);die;
        $this->assign('radiodata', $radiodata);

        $this->display();
    }

//    public function salelst()
//    {
//
//    }


}