<?php
namespace Admin\Model;

use Think\Model;

class PrivilegeModel extends Model
{
    protected $_validate = [
        ['priv_name', 'require', '权限名称不能为空'],
        ['parent_id', 'number', '上级权限不合法']
    ];

    /**
     * 格式化权限数据
     * @return mixed
     */
    public function getPriv()
    {
        //取出权限数据
        $arr = $this->select();
        return _getTree($arr,$parent_id=0,$level=0);
    }

//    /**
//     * 格式化数据
//     * @param array $arr     需要格式化的数据
//     * @param int $parent_id 父级id
//     * @param int $level     数据等级
//     * @return array $list
//     */
//    public function _getPriv($arr,$parent_id=0,$level=0)
//    {
//        static $list = [];
//        foreach ($arr as $k=>$v) {
//            if($v['parent_id']==$parent_id){
//                $v['level'] = $level;
//                $list[]=$v;
//                $this->_getPriv($arr,$v['id'],$level+1);
//            }
//        }
//        return $list;
//    }
}