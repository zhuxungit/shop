<?php
namespace Admin\Controller;
//use Think\Controller;

class CategoryController extends MyController
{
    /**
     * 添加栏目
     */
    public function add()
    {
        if (IS_POST) {
            $catModel = D('Category');
            if ($catModel->create(I('POST.', 1))) {
                if ($catModel->add()) {
                    //添加成功
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    //添加失败
                    $this->error('添加失败');
                }
            } else {
                $this->error($catModel->getError());
            }
        }
        $catModel = D('Category');
        $catData = $catModel->getTree();

        $this->assign('catData', $catData);
        $this->display();
    }

    /**
     * 栏目列表
     */
    public function lst()
    {
        $catModel = D('Category');
        $catData = $catModel->getTree();
        $this->assign('catData', $catData);
        $this->display();
    }

    /**
     * 删除
     */
    public function del()
    {
        $id = (int)$_GET['id'];
        //判断当前栏目是否有子栏目，如果有子栏目则不删除
        $catModel = D('Category');
        $info = $catModel->where("parent_id=$id")->find();
        if ($info) {
            $this->error('该栏目有子栏目，不允许删除');
        }
        if ($catModel->delete($id) !== false) {
            $this->success('删除成功', U('lst'));
        }
    }

    /**
     * 栏目修改
     */
    public function update()
    {
        $catModel = D('Category');
        $id = (int)$_GET['id'];
        if (IS_POST) {
            if ($catModel->create(I('post.', 2))) {
                if ($catModel->save()) {
                    $this->success('更新成功', U('lst'));
                    exit;
                } else if ($catModel->save() == 0) {
                    $this->success('木有修改', U('lst'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($catModel->getError());
            }
        }

        //获取当前栏目的子栏目
        $idArr = $catModel->getChild($id);
        $idArr[] = $id;
        $this->assign('idArr', $idArr);

        $rowData = $catModel->where("id=$id")->find();
        $this->assign('rowData', $rowData);

        $catData = $catModel->getTree();

        $this->assign('catData', $catData);
        $this->display();
    }
}