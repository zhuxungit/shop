<?php
namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{
    protected $_validate = [
        ['role_name', 'require', '角色名称不能为空']
    ];

    /**
     * @param $data
     * @param $options
     */
    protected function _after_insert($data, $options)
    {
        //获取角色id
        $role_id = $data['id'];
        //获取权限id
        $priv_id = I('post.priv_id');

        $roleprivmodel = M('RolePrivilege');
        foreach ($priv_id as $v) {
            $roleprivmodel->add([
                'role_id' => $role_id,
                'priv_id' => $v
            ]);
        }

    }
    //删除角色与权限中间表的对应的角色数据
    protected function _after_delete($data, $options)
    {
        //获取角色id
//        p($data);
//        p($options);
//        die;
        //获取角色id
        $role_id = $data['id'];

        //删除中间表中的数据
        $roleprivmodel = M("RolePrivilege");
        $result = $roleprivmodel->where("role_id=$role_id")->delete();
        if ($result === false) {
            $this->error="删除中间表失败";
            return false;
        }
    }

}