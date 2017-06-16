<?php
namespace Admin\Model;
use Think\Model;

class AttributeModel extends Model
{
    //添加数据验证
    protected $_validate = [
        ['attr_name','require','属性名称不能为空'],
        ['type_id','number','商品类型不合法'],
        ['attr_type',[0,1],'属性类型不合法',1,'in'],
        ['attr_input_type',[0,1],'属性值录入方式不合法',1,'in'],
    ];

    //定义在添加时，合法提交的字段
//    protected $insertFields = ['attr_name','type_id','attr_type',''];

}