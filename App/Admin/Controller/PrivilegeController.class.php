<?php
namespace Admin\Controller;

class PrivilegeController extends MyController
{
    /**
     * 添加权限数据
     */
    public function add()
    {
        $privmodel = D('Privilege');
        if(IS_POST){
            if($privmodel->create()){
                //将录入的模块控制器方法字段转为小写录入
                if(!empty(I('post.module_name'))){
                    $privmodel->module_name = strtolower(I('post.module_name'));
                }
                if(!empty(I('post.controller_name'))){
                    $privmodel->controller_name = strtolower(I('post.controller_name'));
                }
                if(!empty(I('post.action_name'))){
                    $privmodel->action_name = strtolower(I('post.action_name'));
                }

                if ($privmodel->add()){
                    $this->success('添加成功',U('lst'));
                    exit;
                }
                else{
                    $this->error('添加失败');
                }
            }else{
                $this->error($privmodel->getError());
            }
        }
        $privdata = $privmodel->getPriv();
        $this->assign('privdata',$privdata);
        $this->display();
    }

    /**
     * 权限列表
     */
    public function lst()
    {
        //取出所有权限数据
        $privmodel = D('Privilege');
        $privdata = $privmodel->getPriv();
        $this->assign('privdata',$privdata);

        $this->display();
    }


    /**
     * 权限修改
     * 注意点：1.父级id不能是自己2.父级id不能是自己的子集
     */
    public function update()
    {
        $priv_id = (int)$_GET['id'];
        $privmodel = D('Privilege');
        //取出当前数据
        $privdatanow = $privmodel->where("id=$priv_id")->find();
        $this->assign('privdatanow',$privdatanow);

        if(IS_POST){
            if($privmodel->create()){
                $datas = I('post.');

                //注意点1 父级id不能是自己
                if($datas['id']==$datas['parent_id']){
                    $this->error('不能选择自己作为父级');
                }

                //注意点2 父级id不能是自己的子集
                $privdatas = $privmodel->select();
                $parents = _getTree($privdatas,$datas['id']);
                foreach ($parents as $k => $v) {
                    if($v['id']==$datas['parent_id']){
                        $this->error('不能选择自己的子集作为父级');
                    }
                }

                //将录入的模块控制器方法字段转为小写录入
                if(!empty(I('post.module_name'))){
                    $privmodel->module_name = strtolower(I('post.module_name'));
                }
                if(!empty(I('post.controller_name'))){
                    $privmodel->controller_name = strtolower(I('post.controller_name'));
                }
                if(!empty(I('post.action_name'))){
                    $privmodel->action_name = strtolower(I('post.action_name'));
                }

                if($privmodel->save()){
                    $this->success('修改成功',U('lst'));exit;
                }else if($privmodel->save()==0){
                    $this->success('木有修改',U('lst'));exit;
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error($privmodel->getError());
            }

        }

        //取出所有权限数据
        $privdata = $privmodel->getPriv();
        $this->assign('privdata',$privdata);


        $this->display();
    }

    public function delete()
    {
        $privmodel = D('Privilege');
        $id = (int)$_GET['id'];
        //判断当前权限是否有子权限，如果有子权限则不删除
        $info = $privmodel->where("parent_id=$id")->find();
        if ($info) {
            $this->error('该权限有子权限，不允许删除');
        }
        //删除权限
        if($privmodel->delete($id)) {
            $this->success('删除成功',U('lst'));exit;
        }else{
            $this->error('删除失败');
        }
        $this->display();
    }


}