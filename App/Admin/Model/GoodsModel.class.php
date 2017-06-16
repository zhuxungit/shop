<?php
namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model
{
    /**
     * 通过条件获取数据，精品、热品、新品
     * @param $type  string 类型（值为best new hot ）
     * @param $number number 取出几条数据
     * @return mixed
     */
    public function getByGoods($type, $number)
    {
        if ($type == 'best' || $type == 'hot' || $type == 'new') {
            return $this->where("is_" . $type . "=1")->limit($number)->select();
        }
    }

    /**
     * @param $data
     * @param $options
     * @return bool
     */
    public function _before_insert(&$data, $options)
    {
        $goods_sn = I("post.goods_sn");
        if (empty($goods_sn)) {
            $data['goods_sn'] = strtoupper("sn_" . time() . uniqid());
        }
        $data['add_time'] = time();
        $data['update_time'] = time();
        $data['goods_sales'] = 100;

        if ($_FILES['goods_img']['error'] == 0) {
            //调用函数完成上传
            $info = oneuploadimg('goods_img', 'Admin', $array = array(array('230', '230'), array('50', '50')));

            if ($info['info'] == 1) {
                //上传成功
//                $data['goods_ori'] = $info['img'][0];
//                $data['goods_img'] = $info['img'][1];
                $data['goods_thumb'] = $info['img'][2];
            } else {
                //上传失败
                $this->error = $info['error'];
                return false;
            }
        }
    }

    /**
     * @param $data
     * @param $options
     */
    protected function _after_insert($data, $options)
    {
//        echo '123';
//        die;
        //商品id
        $goods_id = $data['id'];
        //获取属性信息
        $attrs = I('post.attr');

//        p($attrs);
//        die;
        foreach ($attrs as $k => $v) {
            if (is_array($v)) {
                //$v是数组
                foreach ($v as $v1) {
                    M('GoodsAttr')->add([
                        'goods_id' => $goods_id,
                        'attr_id' => $k,
                        'attr_value' => $v1
                    ]);
                }
            } else {
                //$v不是数组
                M('GoodsAttr')->add([
                    'goods_id' => $goods_id,
                    'attr_id' => $k,
                    'attr_value' => $v,
                ]);
            }
        }
        if (hasimages('photo')) {
            //多文件
            $info = moreuploadimg('photo', 'Album', $array = [100, 100]);
            if ($info) {
                //上传成功
                $img = $info['img'];
                foreach ($img as $v) {
                    M('GoodsAlbum')->add([
                        'goods_id' => $goods_id,
                        'album_ori' => $v[0],
                        'album_thumb' => $v[1]
                    ]);

                }
            } else {
                //上传失败
                $this->error($info['error']);
            }
        }
    }

    /**
     * 更新后修改it_goods_attr表
     */
    public function afterupdate($id,$attrs)
    {
//        $id = I('id');
        //先删除原it_goods_attr表中goods_id对应的数据
        $goodsattrmodel = M('GoodsAttr');
        $delresult = $goodsattrmodel->where("goods_id=$id")->delete();
        //获取属性信息

        foreach ($attrs as $k => $v) {
            if (is_array($v)) {
                //$v是数组
                foreach ($v as $v1) {
                    //插入属性数据
                    $goodsattrmodel->add([
                        'goods_id' => $id,
                        'attr_id' => $k,
                        'attr_value' => $v1
                    ]);
                }
            } else {
                //$v不是数组
                //插入属性数据
                $goodsattrmodel->add([
                    'goods_id' => $id,
                    'attr_id' => $k,
                    'attr_value' => $v,
                ]);
            }
        }

        //上传多张图片(商品相册)
        $datas=$this->data;
        unset($_FILES['goods_img']);
        if (!empty($_FILES['photo']['name'][0])) {
            $info = uploadPics();
            foreach ($info as $k => $v) {
                $datas[$k]['album_ori'] = $v['savepath'] . $v['savename'];
                $datas[$k]['album_thumb'] = $v['thumb_savepath'] . $v['thumb_savename'];
                $datas[$k]['goods_id'] = $id;
            }
        }
        //将上传的多张图片存到数据库中
        $uploadpics = M('GoodsAlbum');
        $res = $uploadpics->addAll($datas);
        if (!$res) {
            $this->error = '图片上传失败';
        }
    }

}