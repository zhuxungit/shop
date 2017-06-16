<?php
namespace Admin\Controller;

//use Think\Controller;

class AttributeController extends MyController
{
    /**
     * 添加商品属性
     */
    public function add()
    {
        if (IS_POST) {
            $attrmodel = D('Attribute');
            $type_id = I('post.type_id');
            if ($attrmodel->create(I('POST.'), 1)) {
                if ($attrmodel->add()) {
                    //录入成功
                    $this->success('添加成功', U('lst', array('type_id' => $type_id)));
                    exit;
                } else {
                    //添加失败
                    $this->error('添加失败');
                }
            } else {
                $this->error($attrmodel->getError());
            }
        }

        //输出商品类型
        $typemodel = D('Type');
        $typedata = $typemodel->select();
//        var_dump($typedata);
//        die;
        $this->assign('typedata', $typedata);
        $this->display();
    }

    /**
     * 商品属性列表
     */
    public function lst()
    {
        //接收传递的type_id
        $type_id = intval($_GET['type_id']);
        if ($type_id == 0) {
            $where = ' and 1';
        } else {
            $where = " and type_id=$type_id";
        }
        //属性列表
        $attrmodel = D('Attribute');
//        $count = count($attrdata);
        $countArr = $attrmodel->query('select a.*,b.type_name from it_attribute as a left join it_type as b on a.type_id = b.id where 1 ' . $where);
        $count = count($countArr);
//        p($count);
//        die;
        $Page = new \Think\Page($count, 10);
        $sql = 'select a.*,b.type_name from it_attribute as a left join it_type as b on a.type_id = b.id where 1 ' . $where . " limit $Page->firstRow,$Page->listRows";
//        p($sql);
//        die;
        $attrdata = $attrmodel->query($sql);
        //输出商品类型
        $typemodel = D('Type');
        $typedata = $typemodel->select();
//        p($typedata);
//        die;
        $this->assign('typedata', $typedata);
        $this->assign('type_id', $type_id);
        $this->assign('attrdata', $attrdata);

        //分页实现
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        $this->assign('pagestr', $show);

        $this->display();
    }
}