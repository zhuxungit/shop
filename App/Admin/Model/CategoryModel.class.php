<?php
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model
{
//    //验证的字段
//    protected $_validate = [
//
//    ];

    /**
     * 取出栏目数据（分类树）
     */
    public function getTree()
    {
        $arrTree = $this->select();
        return _getTree($arrTree,$pid=0,$level=0);

    }

    /**
     * 取出子孙数据
     * @param $id
     * @return array
     */
    public function getChild($id)
    {
        $arrChi = $this->select();
        return $this->_getChild($arrChi,$id);
    }

    /**
     * 子孙树
     */
    public function _getChild($arrChi,$id)
    {
        static $listChi=[];
        foreach ($arrChi as $val){
            if($id==$val['parent_id']){
                $listChi[] = $val['id'];
                $this->_getChild($arrChi,$val['id']);
            }
        }
        return $listChi;
    }

    /**
     * 获取面包屑导航数据（倒退，向上查找）
     */
    public function getFamily($cat_id)
    {
        //获取栏目数据
        $arr = $this->select();
        return array_reverse($this->_getFamily($arr,$cat_id));
    }

    /**
     * 面包屑
     */
    public function _getFamily($arr,$cat_id)
    {
        static $list = [];
        foreach ($arr as $v)
        {
            if($v['id']==$cat_id) {
                 $list[]= $v;
                 $this->_getFamily($arr,$v['parent_id']);
            }
        }
        return $list;
    }


}