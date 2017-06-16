<?php
namespace Admin\Controller;

//use Think\Controller;

class TypeController extends MyController
{
    public function add()
    {
        if (IS_POST) {
            $typemodel = D('Type');
            if ($typemodel->create(I('post'), 1)) {
                if ($typemodel->add()) {
                    //添加成功
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    //添加失败
                    $this->error('添加失败');
                }
            } else {
                $this->error($typemodel->getError());
            }
        }

        $this->display();
    }

    public function lst()
    {
        $typemodel = D('Type');

        $typedata = $typemodel->select();

        $this->assign('typedata', $typedata);
        $this->display();

    }
}