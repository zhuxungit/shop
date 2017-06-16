<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
    //定义登录动态方法的验证规则
    public $login_validate = [
        ['admin_name', 'require', '管理员不能为空',],
        ['password', 'require', '密码也不能为空',],
        ['checkcode', 'require', '验证码不能为空',],
        ['checkcode', 'check_verify', '验证码必须要正确', 1, 'callback'],
    ];

    protected $_validate = [
        ['admin_name', 'require', '管理员名称不能为空'],
        ['admin_name', '', '管理员名称已经存在', 1, 'unique','MODEL_INSERT'],
        //新增数据时验证
        //第一个1指必须验证第二个1指数据新增时验证
        ['password', '5,12', '密码长度要在5到12位之间', 1, 'length','MODEL_UPDATE'],
        //数据修改时验证
        //第一个2指不为空的时候验证第二个2指数据修改时验证
        ['password', '5,12', '密码长度要在5到12位之间', 2, 'length','MODEL_UPDATE'],
        ['rpassword', 'password', '两次密码输入的不一致', 1, 'confirm']
    ];

    public function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    public function login()
    {
        //接收提交的管理员名称和密码
        $admin_name = I('post.admin_name');
        $password = I('post.password');
        $info = $this->where("admin_name='$admin_name'")->find();
        if ($info) {
            //存在该用户信息
            if ($info['password'] == md5(md5($password) . $info['salt'])) {
                //说明用户名和密码是正确的，写入session
                session('admin_name',$admin_name);
                session('admin_id',$info['id']);
                return true;
            }
        }
        $this->error = '用户名密码错误';
        return false;
    }

    protected function _before_insert(&$data, $options)
    {
        $salt = substr(uniqid(),-6);

        $pwd = I('post.password');
        $data['password'] = md5(md5($pwd).$salt);
        $data['salt'] = $salt;

    }

    //管理员与角色
    protected function _after_insert($data, $options)
    {
//        p($data);
//        p($options);
//        die;
        //获取管理员id
        $admin_id = $data['id'];
        //获取角色id
        $role_id = (int)$_POST['role_id'];
        $adminrolemodel = M("AdminRole");
        $adminrolemodel->add([
            'admin_id' => $admin_id,
            'role_id' => $role_id
        ]);
    }

    /**
     * 删除管理员角色中间表
     * @param $data
     * @param $options
     * @return bool
     */
    protected function _after_delete($data, $options)
    {
        $admin_id = $data['id'];

        $adminrolemodel = D("AdminRole");
        $adminrolemodel->where("admin_id=$admin_id")->delete();

        if($adminrolemodel===false){
            $this->error = "删除管理员角色中间表出错";
            return false;
        }
    }


    protected function _after_update($data, $options)
    {
        $rold_id = $_POST['role_id'];
        $admin_id = $data['id'];

        $adminrolemodel = D('AdminRole');
        $result = $adminrolemodel->where("admin_id =".$admin_id)->save(['role_id'=>$rold_id]);
        if($result===false){
            $this->error="修改管理员角色中间表失败";
            return false;
        }
    }

    /**
     * 获取左侧按钮
     */
    public function getButton()
    {
        //根据登录管理员的id，分别获取权限按钮，要求是只取出前两级按钮
        $admin_id = $_SESSION['admin_id'];
        if($admin_id==1){
            //超级管理员
            $sql = "select * from it_privilege where parent_id=0 and is_show=1";
            $arr = $this->query($sql);
            foreach ($arr as $k=>$v){
                $sql ="select * from it_privilege where  is_show=1 and parent_id = ".$v['id']." order by id desc";
                $arr[$k]["child"] = $this->query($sql);
            }
        }else{
            //普通用户
            $sql = "select c.* from it_admin_role a left join it_role_privilege b on a.role_id = b.role_id left join it_privilege c on c.id=b.priv_id where  c.is_show=1 and a.admin_id=$admin_id and c.parent_id=0";
            $arr = $this->query($sql);
            foreach ($arr as $k=>$v){
                $sql = "select c.* from it_admin_role as a left join it_role_privilege as b on a.role_id = b.role_id left join it_privilege as c on c.id = b.priv_id where c.is_show=1 and a.admin_id = $admin_id and c.parent_id = ".$v['id']." order by id desc";
                $arr[$k]['child'] = $this->query($sql);
            }
        }
        return $arr;
    }

}