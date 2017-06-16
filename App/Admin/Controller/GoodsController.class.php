<?php
namespace Admin\Controller;

//use Think\Controller;

use Think\Crypt\Driver\Think;

class GoodsController extends MyController
{
    /**
     * 商品库存
     */
    public function product()
    {
        $goods_id = I('goods_id');

//        p($goods_id);die;

        $productmodel = M('Product');
        if (IS_POST) {
            $goods_attr = I('goods_attr');
            $goods_number = I('goods_number');

//            p($_POST);die;

            //判断数据库库存表中是否有数据，有则删除
            $info = $productmodel->where("goods_id = $goods_id")->select();
            if($info){
                $productmodel->where("goods_id = $goods_id")->delete();
            }

            //初始化商品总库存
            $goodskucun = 0;

            foreach ($goods_number as $k => $v) {
                $goodskucun += $v;
                foreach ($goods_attr as $k1=>$v1) {
                     $a[$k][] = $v1[$k];
                }
                $productmodel->add([
                    'goods_id' => $goods_id,
                    'goods_attr_id' => implode(',',$a[$k]),
                    'goods_number'  => $v
                ]);
            }

//            p($a);die;

            //更新商品总库存
            $goodsmodel = D('goods');
            $res = $goodsmodel->where("id = $goods_id")->setField("goods_number", $goodskucun);
            if (!$res) {
                $this->error('保存库存失败');
            } else {
                $this->success('保存库存成功', U('lst'));exit;
            }
        }

        //页面显示不同属性商品
        $goodsattrmodel = M('GoodsAttr');
        $wheresql = $goodsattrmodel->alias('a')->field("a.goods_id")->group("a.goods_id")->having("COUNT(a.goods_id)>1")->buildSql();
        $goodsattrdatas = $goodsattrmodel->alias('a')->field("a.*,b.attr_name")->join("left join it_attribute as b on a.attr_id = b.id")->where("a.goods_id in $wheresql and a.goods_id=$goods_id")->order("b.id")->select();

//       echo  $goodsattrmodel->_sql();
        //组建三维数组
        $arr = [];
        foreach ($goodsattrdatas as $k => $v) {

            $arr[$v['attr_id']][] = $v;

        }
//        p($goodsattrdatas);die;
        $this->assign('productinfo', $arr);

        //如果该商品有库存信息则先显示
        $productdatas = $productmodel->where("goods_id=$goods_id")->select();
//        p($productdatas);die;
        $this->assign('productdatas',$productdatas);

//        dump(strpos('bsdfasd','a'));die;


        $this->display();
    }


    /**
     * 逻辑删除，非实际删除
     */
    public function delete()
    {
        $id = (int)$_GET['id'];
        $goodsmodel = D('goods');
        $goodsdata = $goodsmodel->where("id=$id")->find();
        $goodsdata['id'] = $id;
        $goodsdata['is_delete'] = 1;
        $goodsmodel->save($goodsdata);

        if ($goodsmodel) {
            $this->success('操作成功!', U('lst'));
            exit;
        } else {
            $this->error('操作失败!');
        }
    }

    /**
     * 上架与下架
     */
    public function change()
    {
        $type = $_POST['type'];
        $id = (int)$_POST['id'];
        $goodsmodel = D('goods');
        $goodsdata = $goodsmodel->where("id=$id")->find();
        $goodsdata['id'] = $id;
        if ($goodsdata[$type] == 1) {
            $goodsdata[$type] = 0;
            $imginfo = "<img style='cursor: pointer' src='/Public/Admin/images/no.gif'/>";
        } else {
            $goodsdata[$type] = 1;
            $imginfo = "<img style='cursor: pointer' src='/Public/Admin/images/yes.gif'/>";
        }
        $goodsmodel->save($goodsdata);

        if ($goodsmodel) {
            $this->success($imginfo, U('lst'));
            exit;
        } else {
            $this->error('操作失败!');
        }
    }

    /**
     * 商品添加
     */
    public function add()
    {
        if (IS_POST) {
            $goodsModel = D('goods');
            if ($goodsModel->create(I('post.', 1))) {

                if ($goodsModel->add()) {
                    //添加成功
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($goodsModel->getError());
            }
        }
        //取出商品的栏目信息
        $catModel = D('Category');
        $catData = $catModel->getTree();
        $this->assign('catData', $catData);

        //取出商品属性信息
        $typemodel = D('Type');
        $typedata = $typemodel->select();
        $this->assign('typedata', $typedata);

        $this->display();
    }

    /**
     * 商品更新
     */
    public function update()
    {
        $id = I('id');
        $attrs = I('post.attr');
        $goodsmodel = D('goods');
        if (IS_POST) {
            if ($goodsmodel->create()) {
                if (!empty($_FILES['goods_img']['name'])) {
                    $info = uploadPic();
                }
                if ($info) {
                    $goodsmodel->goods_thumb = $info['goods_img']['thumb_savepath'] . $info['goods_img']['thumb_savename'];
                }
                if ($goodsmodel->save()) {

                    //商品表修改保存成功后，修改商品属性表
                    $goodsmodel->afterupdate($id,$attrs);

                    $this->success('修改成功', U('lst'));
                    exit;
                } else if ($goodsmodel->save() == 0) {
                    $this->success('修改成功', U('lst'));
                    exit;
                } else {
                    $this->error('修改失败');
                }
            } else {
                $this->error($goodsmodel->getError());
            }
        }
        //取出商品的栏目信息
        $catModel = D('Category');
        $catData = $catModel->getTree();
        $this->assign('catData', $catData);
        //取出商品属性信息
        $typemodel = D('Type');
        $typedata = $typemodel->select();
        $this->assign('typedata', $typedata);
        //取出商品相册信息
        $albummodel = M('GoodsAlbum');
        $albumdata = $albummodel->where("goods_id=$id")->find();
        //取出当前商品数据
        $goodsdata = $goodsmodel->where("id=$id")->find();
        $goodsdata['album'] = $albumdata;
        $this->assign('goodsdata', $goodsdata);
        //取出商品相册里的相册图片
        $uploadpics = M('GoodsAlbum');
        $uploadpicsdata = $uploadpics->where("goods_id=$id")->select();
        $this->assign('uploadpicsdata', $uploadpicsdata);

        $this->display();
    }

    /**
     * 商品列表
     */
    public function lst()
    {
        $catModel = D('Category');

        //根据分类检索，获得所有分类数据
        $cat_id = $_POST['cat_id'] ? (int)$_POST['cat_id'] : 0;
        $catSearch = $catModel->getChild($cat_id);
        if (empty($childData)) {
            $catSearch[] = $cat_id;
        }
        $catSearch = implode(',', $catSearch);
        $this->assign('cat_id', $_POST['cat_id']);

        //取出商品的栏目信息
        $catData = $catModel->getTree();
        $this->assign('catData', $catData);

        //获得分页总数据条数
        $goodsmodel = D('goods');
        $count = $goodsmodel->where("is_delete=0")->count();
        $page = new \Think\Page($count, 10);
        $goodsdata = $goodsmodel->where("is_delete=0 and cat_id in (" . $catSearch . ")")->limit($page->firstRow . ',' . $page->listRows)->select();
        $page->setConfig('next', '下一页');
        $page->setConfig('prev', '上一页');
        $pages = $page->show();
        $this->assign('pages', $pages);

        //获得所有商品数据
        $this->assign('goodsdata', $goodsdata);

        $this->display();
    }

    public function delpics()
    {
        $id = (int)$_POST['id'];
//        p($goods_id);die;
        $data = M('GoodsAlbum')->where("id=$id")->find();
//        p($data);
        $res = M('GoodsAlbum')->delete($id);
        if ($res) {
            unlink(C('UPLOAD_ROOT_PATH') . $data['album_ori']);
            unlink(C('UPLOAD_ROOT_PATH') . $data['album_thumb']);
            $this->success('操作成功!');
        } else {
            $this->error('操作失败!');
        }
    }

    /**
     * 商品属性选项卡
     */
    public function showattr()
    {
        $type_id = $_GET['type_id'];
        $attrmodel = D('Attribute');
        $attrdata = $attrmodel->where("type_id=$type_id")->select();

        $str = '';
        foreach ($attrdata as $k => $v) {
            //属性类型是唯一
            if ($v['attr_input_type'] == 0) {
                //输入值的方式是手工输入，生成一个文本框
                $str .= '<tr><td>' . $v['attr_name'] . '</td><td>';
                $str .= "<input type='text' name='attr[]'/></td></tr>";
            } else {
                //输入值的方式是列表选择
                $attrs = $v['attr_value'];//取出可选值列表的值
                //把该值转换成一个数组
                $attrs = str_replace('，', ',', $attrs);//把中文的逗号转换成英文逗号
                $attrs = explode(',', $attrs);

                $str .= "<tr><td><a href='javascript:void(0)' onclick='copyown(this)'>[+]</a> " . $v['attr_name'] . "</td><td><select name='attr[" . $v['id'] . "][]'>";
                foreach ($attrs as $k1 => $v1) {
                    $str .= "<option value='$v1'>$v1</option>";
                }
                $str .= "</select></td></tr>";
            }
        }
        echo $str;
    }


}