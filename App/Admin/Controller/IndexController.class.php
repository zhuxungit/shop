<?php
namespace Admin\Controller;
//use Think\Controller;

class IndexController extends MyController
{
    public function index()
    {
        $this->display();
    }

    public function left()
    {
        $adminmodel = D('Admin');
        $menusdata = $adminmodel->getButton();

//        p($menusdata);die;

        $this->assign('menusdata',$menusdata);
        $this->display();
    }

    public function top()
    {
        $this->display();
    }

    public function drag()
    {
        $this->display();
    }

    public function main()
    {
        $this->display();
    }

    /**
     * 商品回收站
     */
    public function recycle()
    {
        $goodsmodel = D('Admin/goods');
        $goodsdata = $goodsmodel->where('is_delete=1')->select();
        $this->assign('goodsdata',$goodsdata);
        $this->display();
    }


    public function outdel()
    {
        $id = (int)$_GET['id'];
        $goodsmodel = D('Admin/goods');
        $goodsdata = $goodsmodel->where("id=$id")->find();
        $goodsdata['id'] = $id;
        $goodsdata['is_delete'] = 0;
        $goodsmodel->save($goodsdata);
        if ($goodsmodel) {
            $this->success('操作成功!', U('recycle'));
            exit;
        } else {
            $this->error('操作失败!');
        }
    }

}