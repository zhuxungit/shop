<?php
namespace Admin\Controller;

use Think\Controller;

class MyController extends Controller
{
    //_initialize()会在构造函数中自动执行
    public function _initialize()
    {
        //验证是否登录，取出登录管理员id
        $admin_id = $_SESSION['admin_id'];
        if ($admin_id > 0) {
            //已经登录
            //如果是超级管理员则不需要验证
            if ($admin_id == 1) {
                return true;
            }
            //如果是index控制器，不需要验证
            if (CONTROLLER_NAME == 'Index') {
                return true;
            }

            $url = strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);

            $sql = "SELECT 
                    concat(c.module_name,'/',c.controller_name,'/',c.action_name) as url 
                    from it_privilege c where c.parent_id 
                    in (SELECT 
                    c.id
                    from it_admin_role as a 
                    left join it_role_privilege as b on a.role_id=b.role_id 
                    left join it_privilege c on b.priv_id=c.id
                    where a.admin_id = 1)";
            $urlarr = M()->query($sql);

            if (in_array($url,$urlarr)){
                return true;
            }else{
                $this->error('无权操作');
            }
//            p($urlarr);die;

        } else {
            $this->error('请先登录', U('Login/login'));
        }
    }
}