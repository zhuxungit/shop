<?php
namespace Home\Model;

use Think\Model;

/**
 * 用户模型
 * Class UserModel
 * @package Home\Model
 */
class UserModel extends Model
{
//    //自动验证
//    public $validate = [
//        ['name', 'require', '用户名称不能为空'],
//        ['name', '/\w[6,12]/', '用户名称不能为空'],
//        ['passwd', 'require', '密码不能为空', 1, 'length'],
//        ['passwd', 'passwd2', '两次密码输入的不一致', 1, 'confirm'],
//    ];
//
//    //插入前自动补全,调用钩子函数
//    protected function _before_insert(&$data, $options)
//    {
//        $data['roleid'] = 1;
//        $data['addtime'] = date('Y-m-d H:i:s');
//    }
//
//
//}










    //定义登录动态方法的验证规则
    public $login_validate = [
        ['user_name', 'require', '用户不能为空',],
        ['user_pwd', 'require', '密码也不能为空',],
    ];

    //用户注册验证
    public $register_validate = [
        ['user_name', 'require', '用户名称不能为空'],
        ['user_name', '', '用户名称已经存在', 1, 'unique'],
        //新增数据时验证
        //第一个1指必须验证第二个1指数据新增时验证
        ['user_pwd', '5,12', '密码长度要在5到12位之间', 1, 'length'],
        //数据修改时验证
        //第一个2指不为空的时候验证第二个2指数据修改时验证
        ['user_pwd', '5,12', '密码长度要在5到12位之间', 2, 'length'],
        ['user_pwd2', 'user_pwd', '两次密码输入的不一致', 1, 'confirm'],
        ['user_email', 'require', '邮箱不能为空'],
        ['user_email', 'email', '邮箱格式必须正确'],
        ['captcha', 'require', '验证码不能为空',],
        ['captcha', 'check_verify', '验证码必须要正确', 1, 'callback'],
    ];


    public function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    /**
     * 登录方法
     * @return bool
     */
    public function login()
    {
        //接收提交的管理员名称和密码
        $user_name = I('post.user_name');
        $user_pwd = I('post.user_pwd');

        $info = $this->where("user_name='$user_name'")->find();

        if ($info) {
            //存在该用户信息
            if ($info['user_pwd'] == md5(md5($user_pwd) . $info['salt'])) {
                //说明用户名和密码是正确的，写入session
                session('user_name', $user_name);
                session('user_id', $info['id']);
                return true;
            }
        }
        $this->error = '用户名密码错误';
        return false;
    }

    protected function _before_insert(&$data, $options)
    {
        $salt = substr(uniqid(), -6);
        $pwd = I('post.user_pwd');
        $data['user_pwd'] = md5(md5($pwd) . $salt);
        $data['salt'] = $salt;
    }

}