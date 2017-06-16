<?php
namespace Admin\Controller;

use Think\Controller;

/**
 * 登录类
 * Class LoginController
 * @package Admin\Controller
 */
class LoginController extends Controller
{
    /**
     * 显示登录界面
     */
    public function login()
    {
//        p(md5(md5('admin').'abc123'));
//        die;

        if(IS_POST){
            $adminmodel = D('Admin');
            if ($adminmodel->validate($adminmodel->login_validate)->create()){
                if($adminmodel->login()){
                    $this->success('登录成功',U('Index/index'));
                    exit;
                }
            }
            $this->error($adminmodel->getError());
        }
        $this->display();
    }

    /**
     * 验证码
     */
    public function autoCode()
    {
        $verify = new \Think\Verify();
        $verify->fontsize = 20;
        $verify->length = 4;
        $verify->useNoise = false;
//        $verify->imageW = 0;
//        $verify->imageH = 0;
        $verify->entry();
    }

    public function logout()
    {
        //清除session
        session('admin_id',null);
        session('admin_name',null);

        if(session('?admin_id')){
            $this->success('退出成功',U('login'));
        }
    }

}