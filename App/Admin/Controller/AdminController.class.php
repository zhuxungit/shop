<?php
namespace Admin\Controller;

/**
 * 管理员类
 * Class AdminController
 * @package Admin\Controller
 */
class AdminController extends MyController
{
    /**
     * 添加管理员
     */
    public function add()
    {
        $adminmodel = D("admin");
        if (IS_POST) {

//            p($_POST);die;

            if ($adminmodel->create()) {
                if ($adminmodel->add()) {
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($adminmodel->getError());
            }
        }
        //获取角色列表
        $rolemodel = D("Role");
        $roledata = $rolemodel->select();
        $this->assign("roledata", $roledata);

        $this->display();
    }

    /**
     * 管理员列表展示
     */
    public function lst()
    {
        $adminmodel = D('Admin');

//        $admindata = $adminmodel->query("select a.admin_name,c.role_name from it_admin as a left join it_admin_role as b on a.id=b.admin_id left join it_role as c on b.role_id = c.id group by a.id;");
        $admindata = $adminmodel->field("a.admin_name,a.id,c.role_name")->join("a left join it_admin_role as b on a.id=b.admin_id left join it_role as c on b.role_id = c.id")->group("a.id")->select();

//        p($admindata);die;
        $this->assign("admindata", $admindata);

        $this->display();
    }

    /**
     * 删除管理员
     */
    public function delete()
    {
        $id = (int)$_GET['id'];
        if ($id == 1) {
            $this->error('参数有误');//说明是超级管理员
        }
        $adminmodel = D('Admin');
        if ($adminmodel->delete($id) !== false) {
            $this->success('删除成功', U("lst"));
            exit;
        } else {
            $error = $adminmodel->getError();
            if (empty($error)) {
                $error = "删除管理员表出错";
            }
            $this->error($error);
        }
    }

    /**
     * 修改管理员
     */
    public function update()
    {
        $id = (int)$_GET['id'];
        $adminmodel = D('Admin');
        if (IS_POST) {

            if ($adminmodel->create()) {
                //判断密码是否提交，如果没有提交则使用旧密码否则使用新密码
                $pwd = I('post.password');

                if (!empty($pwd)) {
                    //更新密码
                    $salt = substr(uniqid(), -6);
                    $adminmodel->password = md5(md5($pwd) . $salt);
                    $adminmodel->salt = $salt;
                } else {
                    //不修改密码
                    unset($adminmodel->password);
                }

                $result = $adminmodel->save();
//                p($result);die;
                if ($result !== false) {
                    $this->success('修改成功', U('lst'));
                    exit;
                } else {
                    $this->error("修改失败");
                }
            } else {
                $this->error($adminmodel->getError());
            }

        }
        //查询单条需要修改管理员信息
        $info = $adminmodel->field("a.admin_name,b.role_id,a.id ")->join("a left join it_admin_role as b on a.id=b.admin_id")->where("a.id = " . $id)->find();

//        p($info);die;

        $this->assign("info", $info);
        //获取角色列表
        $rolemodel = D("Role");
        $roledata = $rolemodel->select();
        $this->assign("roledata", $roledata);
        $this->display();
    }


}