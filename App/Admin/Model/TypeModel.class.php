<?php
namespace Admin\Model;
use Think\Model;

class TypeModel extends Model
{
    //添加数据验证
    protected $_validate = [
        ['type_name', 'require', '类型名称不能为空']
    ];
    //定义在添加时，合法提交的字段
    protected $insertFields = ['type_name'];
}