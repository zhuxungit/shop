<?php
namespace Admin\Controller;

/**
 * 角色管理类
 * Class RoleController
 * @package Admin\Controller
 */
class RoleController extends MyController
{
    /**
     * 添加角色
     */
    public function add()
    {
        //取出权限数据
        $privmodel = D('Privilege');
        if (IS_POST) {
            $rolemodel = D('Role');
            if ($rolemodel->create()) {
                if ($rolemodel->add()) {
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($rolemodel->getError());
            }
        }
        //获取权限数据
//        $privdata = $privmodel->getPriv();
//        $this->assign('privdata', $privdata);
        $privdata = list_to_tree($privmodel->select(),$pk='id',$pid='parent_id');
//        p($privdata);die;
        $this->assign('privdata', $privdata);
        $this->display();
    }

    /**
     * 角色列表
     */
    public function lst()
    {
        $rolemodel = D('Role');
        $roledata = $rolemodel->field("a.role_name,group_concat(c.priv_name) as privnames,a.id")->join("a left join it_role_privilege b on a.id=b.role_id left join it_privilege as c on c.id = b.priv_id")->group("a.id")->select();
        $this->assign('roledata', $roledata);
        $this->display();
    }

    /**
     * 角色更新
     */
    public function update()
    {
        $this->display();
    }

    /**
     * 角色删除
     */
    public function delete()
    {
        $role_id = (int)$_GET['id'];

        //判断角色是否有管理员，
        $info = M('AdminRole')->where("role_id=$role_id")->find();
        if ($info) {
            $this->error("该角色有管理员不能删除");
        }
        //删除角色
        $rolemodel = D("Role");
        if ($rolemodel->delete($role_id) !== false) {
            $this->success("删除成功", U("lst"));
            exit;
        } else {

            $error = $rolemodel->getError();
            if(empty($error)){
                $error = "删除角色表数据失败";
            }

            $this->error();
        }
    }

}