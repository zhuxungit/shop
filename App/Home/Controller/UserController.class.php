<?php
namespace Home\Controller;

use Think\Controller;

/**
 * 用户类
 * Class UserController
 * @package Home\Controller
 */
class UserController extends Controller
{

    /**
     * 通过邮箱激活
     */
    public function mailjh()
    {
        $uid = I('id');
        $mcode = I('mcode');
        $data = M('user')->where(array('id' => $uid, 'mail_code' => $mcode))->find();
        if ($data) {
            $res = M('user')->where('id=' . $uid)->save(array('mail_status' => 1));
            if ($res) {
                $this->success('恭喜你!账号激活成功!', U('login'));
            }
        } else {
            $this->error('激活失败!');
        }

    }

    /**
     * 注册用户方法
     */
    public function register()
    {
        $datas = I('post.');
        if (IS_POST) {
            $usermodel = D('User');
            $datas['mail_code'] = md5(time() . rand(1000, 9999) . $datas['user_name']);
            if ($usermodel->validate($usermodel->register_validate)->create()) {
                $uid = $usermodel->add($datas);
                if ($uid) {
                    //发送邮件
                    $content = '恭喜您！，' . $datas['user_name'] . '，注册成功，想要更进一步的了解请<a href="http://www.shshop.com/home/user/mailjh/id/' . $uid . '/mcode/' . $datas['mail_code'] . '">点击激活</a>';
                    send_mail($datas['user_email'], 'PHP9商城-激活邮件！！！', $content);
                    $this->success('用户注册成功,登陆前请先通过邮箱激活账号', U('login'));
                    exit;
                } else {
                    $this->error('用户注册失败');
                }

            } else {
                $this->error('注册数据验证不通过');
            }
        }
        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

        $this->display();
    }

    /**
     * 登录
     */
    public function login()
    {
        if (IS_POST) {
            $usermodel = D('User');
//            p($usermodel->login_validat);die;
            if ($usermodel->validate($usermodel->login_validate)->create()) {
                $res = $usermodel->login();
//                p($res);die;
                if ($res) {
                    //登录成功
                    $cartmodel = D('Cart');
                    $cartmodel->cookie2db();

                    //下订单如果没有登录则跳转过来
                    if (session('?redirect_url')) {
                        $url = session('redirect_url');
                        session('redirect_url', null);
                    } else {
                        $url = 'index/index';
                    }

//                    p($_SESSION);die;

                    $this->success('登录成功', U($url));
                    exit;

                } else {
                    $this->error('登录失败');
                }
            } else {
                $this->error('登录数据验证不通过');
            }
        }
        //导航栏数据
        $catemodel = D('Admin/Category');
        $catedata = $catemodel->where("parent_id=0")->select();
        $this->assign('catedata', $catedata);

        //获取购物车总数量以及总价格
        $cartmodel = D('Cart');
        $total = $cartmodel->getTotal();
        $this->assign('total', $total);

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

    /**
     * 退出登录
     */
    public function logout()
    {
        session(null);
        if (!session('user_id')) {
            $this->success('退出成功', U('index/index'));
        }
    }

}