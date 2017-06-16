<?php
namespace Home\Model;

use Think\Model;

/**
 * 购物车模型
 * Class CartModel
 * @package Home\Model
 */
class CartModel extends Model
{
    /**
     * 清除购物车数据
     */
    public function clear()
    {
        //用户登录则清空购物车数据库，没有登录则清空cookie
        $user_id = session('user_id');
        if ($user_id > 0) {
            return $this->where("user_id=$user_id")->delete();
        } else {
            cookie('cart', null);
            return true;
        }
    }

    /**
     * 更新购物车
     * @param $goods_id
     * @param $goods_attr_id
     * @param int $goods_count
     * @param int $status
     * @return mixed
     */
    public function updatecart($goods_id, $goods_attr_id, $goods_count = 1, $status = 1)
    {
        //判断用户有没有登录，如果登录修改数据库，如果没登录修改cookie
        $user_id = session('user_id');
        if ($user_id > 0) {
            //用户登录
            if ($status == 1) {
                $this->where("goods_id=$goods_id and goods_attr_id = '$goods_attr_id' and user_id = $user_id")->setInc('goods_count', $goods_count);
            } else {
                $this->where("goods_id=$goods_id and goods_attr_id = '$goods_attr_id' and user_id = $user_id")->save(['goods_count' => $goods_count]);
            }
            return $this->where("goods_id=$goods_id and goods_attr_id = '$goods_attr_id' and user_id = $user_id")->find();
        } else {
            //用户没有登录修改cookie
            $cart = cookie('cart') ? cookie('cart') : [];
            $key = $goods_id . '-' . $goods_attr_id;
            $cart = unserialize($cart);

            if ($status == 1) {
                $cart[$key] += $goods_count;
            } else {
                $cart[$key] = $goods_count;
            }
            //得到的数据存到cookie中
            cookie('cart', serialize($cart), 3600 * 24 * 7, '/');
            $goodsinfo['goods_id'] = $goods_id;
            $goodsinfo['goods_attr_id'] = $goods_attr_id;
            $goodsinfo['goods_count'] = $cart[$key];

            return $goodsinfo;
        }
    }

    /**
     * 刪除购物车数据
     */
    public function del($goods_id, $goods_attr_id)
    {
        //判断用户是否登录，登录删除数据库，没登录删除cookie
        $user_id = session('user_id');
        if ($user_id > 0) {
            //已登录
//            p("goods_id=$goods_id and goods_attr_id='" . $goods_attr_id . "' and user_id=$user_id ");
            $info = $this->where("goods_id=$goods_id and goods_attr_id='" . $goods_attr_id . "' and user_id=$user_id ")->delete();
//    p($info);die;
            return $info;
        } else {
            //没有登录
            $cart = cookie('cart') ? unserialize(cookie('cart')) : [];
            $key = $goods_id . '-' . $goods_attr_id;
            //删除cookie对应数据
            unset($cart[$key]);
            //重新存到cookie中
            cookie('cart', serialize($cart), 3600 * 24 * 7, '/');
            return true;
        }
    }

    /**
     * 添加购物车
     * @param $goods_id
     * @param $goods_attr_id
     * @param $goods_count
     */
    public function addCart($goods_id, $goods_attr_id, $goods_count)
    {
        //判断用户是否登录，如果已经登录，存储到数据库中，如果没有则存储到cookie中
        $user_id = session('user_id');

        if ($user_id > 0) {
            //已经登录，存储到数据库中
            //判断表里是否有该数据，如果有则修改购买数量，如果没有则添加
//            p("goods_id=$goods_id and goods_attr_id='" . $goods_attr_id . "' and user_id=$user_id");die;
            $info = $this->where("goods_id=$goods_id and goods_attr_id='" . $goods_attr_id . "' and user_id=$user_id ")->find();

            if ($info) {
                //数据已存在
                $this->where(" goods_id=$goods_id and goods_attr_id='$goods_attr_id' and user_id = $user_id")->setInc('goods_count', $goods_count);
            } else {
                $this->add([
                    'goods_id' => $goods_id,
                    'goods_attr_id' => $goods_attr_id,
                    'goods_count' => $goods_count,
                    'user_id' => $user_id
                ]);
            }
        } else {
            $key = $goods_id . '-' . $goods_attr_id;
            if (cookie('cart')) {
                $cartdata = cookie('cart');
                $cartdata = unserialize($cartdata);
                //判断当前商品是否已经在cookie中，是则修改
                foreach ($cartdata as $k => $v) {
                    if ($k == $key) {
                        //商品存在，则修改数量
                        $cartdata[$key] = $cartdata[$key] + $goods_count;
                    } else {
                        //将原cookie中的数据先取出再追加，避免覆盖问题
                        $cartdata[$key] = $goods_count;
                    }
                }
            } else {
                $cartdata = [];
                $cartdata[$key] = $goods_count;
//                p($cartdata);die;
            }
            cookie('cart', serialize($cartdata), 3600 * 24 * 7);
        }
    }

    /**
     * 购物车列表
     */
    public function cartList()
    {
        $user_id = session('user_id');
//        p($user_id);die;
        if ($user_id > 0) {
            //已经登录，从数据库取数据
            $cartdata = $this->where("user_id=$user_id")->select();
//            p($cartdata);die;
        } else {
            //没有登录从cookie中取数据
            $cart = cookie('cart') ? unserialize(cookie('cart')) : [];
//            p($cart);die;
            $cartdata = [];
            foreach ($cart as $k => $v) {
                $a = explode('-', $k);

//                p($a);

                $cartdata[] = [
                    'goods_id' => $a[0],
                    'goods_attr_id' => $a[1],
                    'goods_count' => $v
                ];
            }
        }
//        p($a);
//        p($cartdata);die;

        $cartlist = [];
        foreach ($cartdata as $v) {
            $v['info'] = M('Goods')->field("goods_name,market_price,shop_price,goods_thumb")->where("id=" . $v['goods_id'])->find();
            $v['attr'] = $this->getCartAttr($v['goods_id'], $v['goods_attr_id']);
            $cartlist[] = $v;
        }
//        p($cartlist);die;
        return $cartlist;
    }

    /**
     *购物车列表页显示商品属性信息
     * @param $goods_id
     * @param $goods_attr_id
     */
    public function getCartAttr($goods_id, $goods_attr_id)
    {
        $sql = " select b.goods_id,GROUP_CONCAT(CONCAT(a.attr_name,':',b.attr_value) SEPARATOR '</br>') as goodsattr from it_attribute as a left join it_goods_attr as b on b.attr_id = a.id where b.goods_id = " . $goods_id . " and b.id in (" . $goods_attr_id . ") GROUP BY b.goods_id";
        $info = $this->query($sql);
        return $info[0]['goodsattr'];
    }

    /**
     * 商品数量以及总价格
     */
    public function getTotal()
    {
        //取出购物车数据
        $cartdata = $this->cartList();
//        p($cartdata);die;
        //初始化数据
        $total_number = 0;
        $total_price = 0;
        if (!empty($cartdata)) {
            foreach ($cartdata as $k => $v) {
                $total_number += $v['goods_count'];
                $total_price += $v['info']['shop_price'] * $v['goods_count'];
            }
        }
        return [
            'total_number' => $total_number,
            'total_price' => $total_price
        ];
    }

    //登陆后将cookie中的数据移动到数据库中
    public function cookie2db()
    {
        //cookie中取出数据如果不为空则移动
        $cart = cookie('cart') ? unserialize(cookie('cart')) : [];
        //Array
//        (
//        [13-39,40] => 1
//        )
        if (!empty($cart)) {
            //移动并清空cookie
            $user_id = session('user_id');
            foreach ($cart as $k => $v) {
                $a = explode('-', $k);
                $goods_id = $a[0];
                $goods_attr_id = $a[1];
                $goods_count = $v;

                //判断商品是否在数据库中如果在则修改数量，不在则添加
                $info = $this->where("goods_id=$goods_id and goods_attr_id='" . $goods_attr_id . "' and user_id=$user_id ")->find();



                if ($info) {
                    //修改数量
                    $this->where("goods_id=$goods_id and goods_attr_id='" . $goods_attr_id . "' and user_id=$user_id ")->setInc('goods_count', $goods_count);
                } else {
                    //添加数据
                    $this->add([
                        'goods_id' => $goods_id,
                        'goods_count' => $goods_count,
                        'goods_attr_id' => $goods_attr_id,
                        'user_id' => $user_id
                    ]);
                }
            }

        }
        //清空cookie
        cookie(null);
    }


}