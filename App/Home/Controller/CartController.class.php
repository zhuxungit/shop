<?php
namespace Home\Controller;

use Think\Controller;

/**
 * 购物车类
 * Class CartController
 * @package Home\Controller
 */
class CartController extends Controller
{
    /**
     * 清空购物车
     */
    public function clear()
    {
        $cartmodel = D('cart');
        if($cartmodel->clear()){
            $this->success('清空购物车成功',U('index/index'));
        }else if($cartmodel->clear()==0){
            $this->success('购物车里木有商品哦',U('index/index'));
        }else{
            $this->error('清空购物车失败');
        }
    }

    /**
     * 更新购物车数据
     */
    public function update()
    {
        $goods_id = (int)$_POST['goods_id'];
        $goods_attr_id = $_POST['goods_attr_id'];

        //如果$status等于1 点击的增加减少按钮; 等于0 直接在input框中输入数量
        if(empty((int)$_POST['goods_count'])){
            $goods_count = 1;
            $status = 1;
        }else{
            $goods_count = (int)$_POST['goods_count'];
            $status = 0;
        }

        $cartmodel = D('cart');
        $upcartdata = $cartmodel->updatecart($goods_id,$goods_attr_id,$goods_count,$status);

        $newtotal = $cartmodel->getTotal();
        $upcartdata['total_number']=$newtotal['total_number'];
        $upcartdata['total_price']=$newtotal['total_price'];
        echo json_encode($upcartdata);
    }

    /**
     * 删除购物车
     */
    public function del()
    {
        $goods_id = (int)$_GET['goods_id'];
        $goods_attr_id = $_GET['goods_attr_id'];
        $cartmodel = D('Cart');
        $res = $cartmodel->del($goods_id,$goods_attr_id);
        if($res){
            $this->success('删除购物车商品成功',U('lst'));
        }else{
            $this->error('删除购物车商品失败');
        }

    }
    /**
     * 购物车添加
     */
    public function add()
    {
        if (I('post.attr')) {
            $goods_attr_id = implode(',', I('post.attr'));
        }else{
            $goods_attr_id = '';
        }
        $goods_id = I('post.goods_id');
//        $goods_attr_id = $goods_attr_id;
        $goods_count = I('post.goods_count');
        $cartmodel = D('Cart');
        $cartmodel->addCart($goods_id, $goods_attr_id, $goods_count);
//        $this->redirect('index/detail');
//        p($_COOKIE);die;
        $this->success('添加购物车成功', U('lst'));
    }

    /**
     * 购物车列表
     */
    public function lst()
    {
        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //取出购物车数据
        $cartmodel = D('Cart');
        $cartdata = $cartmodel->cartList();
        $this->assign('cartdata', $cartdata);

        //获取购物车总数量以及总价格
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

        $this->display();
    }


}