<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="Generator" content="YONGDA v1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="Keywords" content="SMS EMS MMS 短消息群发 语音 阅读器 SMS,EMS,MMS,短消息群发语音合成信息阅读器 黑色 白色 滑盖"/>
    <meta name="Description" content=""/>

    <title>YONGDA商城 - Powered by YongDa</title>

    <link href="/Public/Home/css/style.css" rel="stylesheet" type="text/css"/>

</head>
<body style="cursor: auto;">

<div class="block clearfix" style="position: relative; height: 98px;">
    <a href="#" name="top"><img class="logo" src="/Public/Home/images/logo.gif"></a>

    <div id="topNav" class="clearfix">
        <div style="float: left;">
            <font id="ECS_MEMBERZONE">
                <div id="append_parent"></div>
                欢迎光临本店&nbsp;
                <?php if($_SESSION['user_id'] != ''): ?>&nbsp;<?php echo ($_SESSION['user_name']); ?>
                    <a href="<?php echo U('user/logout');?>">退出</a>
                    <?php else: ?>
                    <a href="<?php echo U('user/login');?>"> 登录</a>
                    <a href="<?php echo U('user/register');?>">注册</a><?php endif; ?>
            </font>
        </div>
        <div style="float: right;">
            <a href="<?php echo U('Cart/lst');?>">查看购物车</a>
            |
            <a href="<?php echo U('index/index');?>">选购中心</a>
            |
            <a href="#">标签云</a>
            |
            <a href="#">报价单</a>
        </div>
    </div>
    <div id="mainNav" class="clearfix">
        <a <?php if($cat_id < 1): ?>class='cur'<?php endif; ?> href="<?php echo U('index/index');?>" >首页<span></span></a>
        <?php if(is_array($catedata)): foreach($catedata as $key=>$val): if($val['id'] == $cat_id): ?><a class="cur" href="<?php echo U('index/category',['cat_id'=>$val[id]]);?>"><?php echo ($val["cat_name"]); ?><span></span></a>
                <?php else: ?>
                <a href="<?php echo U('index/category',['cat_id'=>$val[id]]);?>"><?php echo ($val["cat_name"]); ?><span></span></a><?php endif; endforeach; endif; ?>
        <a href="#">优惠活动<span></span></a>
        <a href="#">留言板<span></span></a>
    </div>

</div>

<div class="header_bg">
    <div style="float: left; font-size: 14px; color:white; padding-left: 15px;">
    </div>

    <form id="searchForm" method="get" action="#">
        <input name="keywords" id="keyword" type="text"/>
        <input name="imageField" value=" " class="go"
               style="cursor: pointer; background: url('/Public/Home/images/sousuo.gif') no-repeat scroll 0% 0% transparent; width: 39px; height: 20px; border: medium none; float: left; margin-right: 15px; vertical-align: middle;"
               type="submit"/>

    </form>
</div>
<div class="blank5"></div>
<div class="header_bg_b">
    <div class="f_l" style="padding-left: 10px;">
        <img src="/Public/Home/images/biao6.gif"/>
        <?php echo ($iparea); ?>，现在下单(截至次日00:30已出库)，<b>明天上午(9-14点)</b>送达 <b>免运费火热进行中！</b>
    </div>
    <div class="f_r" style="padding-right: 10px;">
        <img style="vertical-align: middle;" src="/Public/Home/images/biao3.gif">
        <span class="cart" id="ECS_CARTINFO">
                        <a href="" title="查看购物车">您的购物车中有 <?php echo ($total["total_number"]); ?> 件商品，总计金额 ￥<?php echo ($total["total_price"]); ?> 元。</a></span>
        <a href="<?php echo U('Cart/lst');?>"><img style="vertical-align: middle;" src="/Public/Home/images/biao7.gif"></a>

    </div>
</div>


<script src="/Public/Js/jquery.js"></script>
<style type="text/css">
    table {
        border: 1px solid #dddddd;
        border-collapse: collapse;
        width: 99%;
        margin: auto;
    }

    td {
        border: 1px solid #dddddd;
    }

    #consignee_addr {
        width: 450px;
    }
</style>


<div class="block box">
    <div class="blank"></div>
    <div id="ur_here">
        当前位置: <a href="#">首页</a> <code>&gt;</code> 购物流程
    </div>
</div>
<div class="blank"></div>

<div class="blank"></div>
<div class="block">
    <div class="flowBox">
        <h6><span>商品列表</span></h6>
        <form id="formCart" action="" method="post">
            <table cellpadding="5" cellspacing="1">
                <tbody>
                <tr>
                    <th>商品名称</th>
                    <th>属性</th>
                    <th>市场价</th>
                    <th>本店价</th>
                    <th>购买数量</th>
                    <th>小计</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($cartdata)): foreach($cartdata as $key=>$v): ?><tr>
                        <td align="center">
                            <a href="#" target="_blank"><img style="width: 80px; height: 80px;" src="/Public/Uploads/<?php echo ($v['info']['goods_thumb']); ?>" title="P806"/></a><br/>
                            <a href="#" target="_blank" class="f6"><?php echo $v['info']['goods_name']?></a>
                        </td>
                        <td><?php echo ($v['attr']); ?> <br/>
                        </td>
                        <td class="market_price" align="center">￥<?php echo ($v['info']['market_price']); ?>元</td>
                        <td class="shop_price" align="center">￥<span><?php echo ($v['info']['shop_price']); ?></span>元</td>
                        <td align="center">
                            <a href="javascript:void(0)" class="decr"><img src="/Public/Home/images/decr.gif"/></a>
                            <input name="goods_count" value="<?php echo ($v['goods_count']); ?>" size="4" class="inputBg" style="text-align: center;"
                                   type="text"/>
                            <a href="javascript:" class="incr"><img src="/Public/Home/images/incr.gif"/></a>
                            <input type="hidden" name="goods_id" value="<?php echo ($v['goods_id']); ?>"/>
                            <input type="hidden" name="goods_attr_id" value="<?php echo ($v['goods_attr_id']); ?>"/>
                        </td>
                        <td class="xiaoji_price" align="center">￥<span><?php echo ($v['info']['shop_price']*$v['goods_count']); ?></span>元</td>
                        <td align="center">
                            <a href="<?php echo U('Cart/del',array('goods_id'=>$v['goods_id'],'goods_attr_id'=>$v['goods_attr_id']));?>" class="f6">删除</a>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <table cellpadding="5" cellspacing="1">
                <tbody>
                <tr>
                    <td>
                        购物金额小计 ￥<span id="total_price"><?php echo ($total['total_price']); ?></span>元，比市场价 ￥2400.00元 节省了 ￥400.00元 (17%)
                    </td>
                    <td align="right">
                        <input value="清空购物车" class="bnt_blue_1" type="button" onclick="clearCart()"/>
                        <input id="updatecart" name="submit" class="bnt_blue_1" value="更新购物车" type="submit"/>
                    </td>
                </tr>
                </tbody>
            </table>
            <input name="step" value="update_cart" type="hidden"/>
        </form>
        <table cellpadding="5" cellspacing="0" width="99%">
            <tbody>
            <tr>
                <td><a href="<?php echo U('index/index');?>"><img src="/Public/Home/images/continue.gif" alt="continue"/></a></td>
                <td align="right"><a id="checkout" href="javascript:void(0)"><img src="/Public/Home/images/checkout.gif" alt="checkout"/></a></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="blank"></div>
    <div class="blank5"></div>
</div>

<script>

    $(function () {
        $("#checkout").click(function () {
            window.location.href = "<?php echo U('order/flow');?>";
        })
    })

    $(function () {
        //选择增加按钮
        $('.incr').click(function () {
            //计算商品单价
            var shop_price = parseFloat($(this).parents('tr').find('.shop_price span').html());
            //商品小计价格
            var xiaoji_price = parseFloat($(this).parents('tr').find('.xiaoji_price span').html());
            //新的小计价格=原来的小计价格+商品单价
            var new_xiaoji_price = xiaoji_price + shop_price;
            //原商品总价
            var total_price = parseFloat($('#total_price').html());
            //新的商品总价=原商品总价+商品单价
            var new_total_price = total_price + shop_price;
            //原购买数量
            var goods_count = parseInt($(this).prev(':input').val());
            //新数量
            var new_goods_count = goods_count + 1;
            //获取商品id
//            _this.parents('td').find(":input[name=goods_id]").val()

            var goods_id = parseInt($(this).parents('td').find(":input[name=goods_id]").val());
            //获取商品属性
            var goods_attr_id = $(this).parents('td').find(":input[name=goods_attr_id]").val();

//            alert(goods_attr_id);

            //ajax修改数据库数据
            var _this = $(this);
            $.ajax({
                url: 'update',
                type: 'post',
                data: {goods_id: goods_id, goods_attr_id: goods_attr_id},
                datatype: 'json',
                success: function (msg) {
                    //修改后将新数据进行显示-新的小计价格-新的商品总价-新数量
                    _this.parents('tr').find('.xiaoji_price span').html(new_xiaoji_price);
                    $('#total_price').html(new_total_price);
                    _this.prev(':input[type=text]').val(new_goods_count);
                    console.log(msg);
                }
            })
        })
    })
    /**
     * 清空购物车
     */
    function clearCart() {
        window.location.href = "<?php echo U('cart/clear');?>";
    }

    /**
     * 通过input修改购物车
     */
    $(":input[name=goods_count]").blur(function () {
        _this = $(this);
        //获取商品数量
        var goods_count = parseInt(_this.val());
        //获取商品id
        var goods_id = parseInt(_this.parents('td').find(":input[name=goods_id]").val());
        //获取商品属性
        var goods_attr_id = _this.parents('td').find(":input[name=goods_attr_id]").val();
        //计算商品单价
        var shop_price = parseFloat(_this.parents('tr').find('.shop_price span').html());

        $.ajax({
            url: 'update',
            type: 'post',
            data: {goods_id: goods_id, goods_attr_id: goods_attr_id, goods_count: goods_count},
            datatype: 'json',
            success: function (msg) {
                console.log(msg);
                msg = JSON.parse(msg);
                //修改后将新数据进行显示-新的小计价格-新的商品总价-新数量
                //商品小计价格
                var count = parseInt(msg.goods_count);
                var new_xiaoji_price = shop_price*count;
                _this.parents('tr').find('.xiaoji_price span').html(new_xiaoji_price);
                //原商品总价
//                console.log(msg.total_price);
                $('#total_price').html(msg.total_price);

            }
        })
    })

    $('#update_click').click(function () {
        window.location.reload();
    })
</script>


<div class="blank"></div>
<div class="block">
    <a href="#" target="_blank" title="YONGDA商城"><img alt="YONGDA商城" src="/Public/Home/images/di.jpg"></a>
    <div class="blank"></div>
</div>
<div class="block">
    <div class="box">
        <div class="helpTitBg" style="clear: both;">
            <dl>
                <dt><a href="#" title="新手上路 ">新手上路 </a></dt>
                <dd><a href="#" title="售后流程">售后流程</a></dd>
                <dd><a href="#" title="购物流程">购物流程</a></dd>
                <dd><a href="#" title="订购方式">订购方式</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="手机常识 ">手机常识 </a></dt>
                <dd><a href="#" title="如何分辨原装电池">如何分辨原装电池</a></dd>
                <dd><a href="#" title="如何分辨水货手机 ">如何分辨水货手机</a></dd>
                <dd><a href="#" title="如何享受全国联保">如何享受全国联保</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="配送与支付 ">配送与支付 </a></dt>
                <dd><a href="#" title="货到付款区域">货到付款区域</a></dd>
                <dd><a href="#" title="配送支付智能查询 ">配送支付智能查询</a></dd>
                <dd><a href="#" title="支付方式说明">支付方式说明</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="会员中心">会员中心</a></dt>
                <dd><a href="#" title="资金管理">资金管理</a></dd>
                <dd><a href="#" title="我的收藏">我的收藏</a></dd>
                <dd><a href="#" title="我的订单">我的订单</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="服务保证 ">服务保证 </a></dt>
                <dd><a href="#" title="退换货原则">退换货原则</a></dd>
                <dd><a href="#" title="售后服务保证 ">售后服务保证</a></dd>
                <dd><a href="#" title="产品质量保证 ">产品质量保证</a></dd>
            </dl>
            <dl>
                <dt><a href="#" title="联系我们 ">联系我们 </a></dt>
                <dd><a href="#" title="网站故障报告">网站故障报告</a></dd>
                <dd><a href="#" title="选机咨询 ">选机咨询</a></dd>
                <dd><a href="#" title="投诉与建议 ">投诉与建议</a></dd>
            </dl>
        </div>
    </div>


</div>
<div class="blank"></div>
<div id="bottomNav" class="box block">
    <div class="box_1">
        <div class="links clearfix">
            <a href="#" target="_blank" title="YONGDA商城"><img src="/Public/Home/images/category.htm" alt="YONGDA商城" border="0"></a>


            [<a href="#" target="_blank" title="">yongda商城</a>]
        </div>
    </div>
</div>
<div class="blank"></div>
<div id="bottomNav" class="box block">
    <div class="bNavList clearfix">
        <a href="#">免责条款</a>
        |
        <a href="#">隐私保护</a>
        |
        <a href="#">咨询热点</a>
        |
        <a href="#">联系我们</a>
        |
        <a href="#">公司简介</a>
        |
        <a href="#">批发方案</a>
        |
        <a href="#">配送方式</a>

    </div>
</div>

<div id="footer">
    <div class="text">
        © 2005-2012 YONGDA 版权所有，并保留所有权利。<br/>
    </div>
</div>
<div style="display: none; top: 200px;" id="compareBox" align="center">
    <ul id="compareList"></ul>
    <input value="" type="button"/>
</div>
</body>
</html>