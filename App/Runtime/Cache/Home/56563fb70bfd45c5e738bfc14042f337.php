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


<script type="text/javascript" class="library" src="/Public/Home/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" class="library" src="/Public/Home/js/jquery.colorbox-min.js"></script>
<script type="text/javascript" class="library" src="/Public/Home/js/zzsc.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/zzsc.css">

<div class="block box">
    <div class="blank"></div>
    <div id="ur_here">
        <!-- 面包屑导航-->
        当前位置: <a href="<?php echo U('index/index');?>">首页</a> <code>&gt;</code>
        <?php if(is_array($breaddata)): foreach($breaddata as $key=>$val1): ?><a href="<?php echo U('category','cat_id='.$val1['id']);?>"><?php echo ($val1["cat_name"]); ?></a> <code>&gt;</code><?php endforeach; endif; ?>
        <?php echo ($goodsdata["goods_name"]); ?>
    </div>
</div>
<div class="blank"></div>


<div class="block clearfix">
    <div class="AreaL">
        <h3><span>商品分类</span></h3>
        <div id="category_tree" class="box_1">
            <dl>
                <dt><a href="#">CDMA手机</a></dt>
                <dd></dd>
            </dl>
            <dl>
                <dt><a href="#">GSM手机</a></dt>
                <dd></dd>
            </dl>
            <dl>
                <dt><a href="#">3G手机</a></dt>
                <dd></dd>
            </dl>
            <dl>
                <dt><a href="#">双模手机</a></dt>
                <dd></dd>
            </dl>

        </div>
        <div class="blank"></div>

        <div style="display: block;" class="box" id="history_div">
            <h3><span>浏览历史</span></h3>
            <div class="box_1">

                <div class="boxCenterList clearfix" id="history_list">
                    <ul class="clearfix">
                        <li class="goodsimg"><a href="#" target="_blank"><img src="/Public/Home/images/8_thumb_G_1241425513488.jpg" alt="飞利浦9@9v" class="B_blue"></a></li>
                        <li><a href="#" target="_blank" title="飞利浦9@9v">飞利浦9@9v</a><br/>本店售价：<font class="f1">￥399元</font><br/></li>
                    </ul>
                    <ul class="clearfix">
                        <li class="goodsimg"><a href="#" target="_blank"><img src="/Public/Home/images/9_thumb_G_1241511871555.jpg" alt="诺基亚E66" class="B_blue"></a></li>
                        <li><a href="#" target="_blank" title="诺基亚E66">诺基亚E66</a><br/>本店售价：<font class="f1">￥2298元</font><br/></li>
                    </ul>
                    <ul class="clearfix">
                        <li class="goodsimg"><a href="#" target="_blank"><img src="/Public/Home/images/17_thumb_G_1241969394587.jpg" alt="夏新N7" class="B_blue"></a></li>
                        <li><a href="#" target="_blank" title="夏新N7">夏新N7</a><br/>本店售价：<font class="f1">￥2300元</font><br/></li>
                    </ul>
                    <ul id="clear_history"><a onclick="clear_history()">[清空]</a></ul>
                </div>
            </div>
        </div>
        <div class="blank5"></div>
    </div>

    <div class="AreaR">
        <div id="goodsInfo" class="clearfix">
            <div class="imgInfo">
                <a style="position: relative; display: block; outline: 0pt none; text-decoration: none; width: 310px; -moz-user-select: none;"
                   href="/Public/Home/images/200905/goods_img/9_P_1241511871575.jpg" id="zoom1" class="MagicZoom MagicThumb" title="诺基亚E66">
                    <!--<img id="sim806035" src="/Public/Home/images/9_G_1241511871574.jpg" alt="诺基亚E66" height="310px" width="310px;"/>-->
                    <div class="MagicZoomBigImageCont"
                         style="width: 200px; height: 269px; overflow: hidden; z-index: 100; visibility: visible; position: absolute; top: -10000px; left: 327px; display: block;"
                         id="bc806035">
                        <div style="position: relative; z-index: 10; left: 0px; top: 0px; padding: 3px;" id="MagicZoomHeaderbc806035" class="MagicZoomHeader">
                            诺基亚E66
                        </div>
                        <div style="overflow: hidden;">
                            <img style="position: relative; border-width: 0px; padding: 0px; left: 0px; top: 0px; display: block; visibility: visible;"
                                 src="/Public/Home/images/9_P_1241511871575.jpg"/>
                        </div>
                        <div style="color:red; font-size: 10px; font-weight: bold; font-family: Tahoma; position: absolute; width: 100%; text-align: center; left: 0px; top: 249px;">
                        </div>
                    </div>
                    <div style="z-index: 10; visibility: hidden; position: absolute; opacity: 0.5; width: 98px; height: 98px; left: 31px; top: 1px;"
                         class="MagicZoomPup">
                    </div>
                </a>
                <div class="blank5"></div>

                <div class="con-FangDa" id="fangdajing">
                    <div class="con-fangDaIMg">
                        <!-- 正常显示的图片-->
                        <img src="/Public/Uploads/<?php echo ($albumdata[0][album_ori]); ?>">
                        <!-- 滑块-->
                        <div class="magnifyingBegin"></div>
                        <!-- 放大镜显示的图片 -->
                        <div class="magnifyingShow"><img src="/Public/Uploads/<?php echo ($albumdata[0][album_ori]); ?>"></div>
                    </div>

                    <ul class="con-FangDa-ImgList">
                        <?php if(is_array($albumdata)): foreach($albumdata as $key=>$pics): ?><!--<a style="outline: 0pt none;" href="/Public/Uploads/<?php echo ($pics["album_ori"]); ?>" rel="zoom1" rev="/Public/Uploads/<?php echo ($pics["album_ori"]); ?>" title="">-->
                            <li <?php if($key == 0): ?>class="active"<?php endif; ?> ><img src="/Public/Uploads/<?php echo ($pics["album_thumb"]); ?>" alt="诺基亚E66" class="onbg" data-bigimg="/Public/Uploads/<?php echo ($pics["album_ori"]); ?>"/></li>
                            <!--</a>--><?php endforeach; endif; ?>
                    </ul>
                </div>

            </div>


            <div class="textInfo">
                <form action="" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY">
                    <input type="hidden" name="goods_id" value="<?php echo ($goodsdata["id"]); ?>">
                    <div class="clearfix" style="font-size: 14px; font-weight: bold; padding-bottom: 8px;">
                        <?php echo ($goodsdata["goods_name"]); ?>
                    </div>
                    <ul>
                        <li class="clearfix">
                            <dd>
                                <strong>商品货号：</strong><?php echo ($goodsdata["goods_sn"]); ?>
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>商品库存：</strong>
                                <?php echo ($goodsdata["goods_number"]); ?> 台
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>商品品牌：</strong><a href="#">诺基亚</a>
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>商品重量：</strong>121克
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>上架时间：</strong>2009-05-06
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>商品点击数：</strong><?php echo ($goodsdata["goods_click"]); ?>
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>市场价格：</strong><font class="market">￥<?php echo ($goodsdata["market_price"]); ?>元</font><br/>

                                <strong>本店售价：</strong><font class="shop" id="ECS_SHOPPRICE">￥<?php echo ($goodsdata["shop_price"]); ?>元</font><br/>
                                <strong>注册用户：</strong><font class="shop" id="ECS_RANKPRICE_1">￥2298元</font><br/>
                                <strong>vip：</strong><font class="shop" id="ECS_RANKPRICE_2">￥2183元</font><br/>
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>用户评价：</strong>
                                <img src="/Public/Home/images/stars5.gif" alt="comment rank 5">
                            </dd>
                        </li>
                        <li class="padd">
                            <font class="f1">购买商品达到以下数量区间时可享受的优惠价格：</font><br/>
                            <table bgcolor="#aad6ff" border="0" cellpadding="3" cellspacing="1" width="100%">
                                <tbody>
                                <tr>
                                    <td align="center" bgcolor="#ffffff"><strong>数量</strong></td>
                                    <td align="center" bgcolor="#ffffff"><strong>优惠价格</strong></td>
                                </tr>
                                <tr>
                                    <td class="shop" align="center" bgcolor="#ffffff">3</td>
                                    <td class="shop" align="center" bgcolor="#ffffff">￥2200元</td>
                                </tr>
                                <tr>
                                    <td class="shop" align="center" bgcolor="#ffffff">5</td>
                                    <td class="shop" align="center" bgcolor="#ffffff">￥2100元</td>
                                </tr>
                                </tbody>
                            </table>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>商品总价：</strong><font id="ECS_GOODS_AMOUNT" class="shop">￥2298元</font>
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>购买数量：</strong>
                                <input name="goods_count" id="number" value="1" size="4" onblur="changePrice()" style="border: 1px solid rgb(204, 204, 204);"
                                       type="text"/>
                            </dd>
                        </li>
                        <li class="clearfix">
                            <dd>
                                <strong>购买此商品可使用：</strong><font class="f4">2200 积分</font>
                            </dd>
                        </li>
                        <?php if(is_array($radiodata)): foreach($radiodata as $key=>$val2): ?><li class="padd loop">
                                <strong><?php echo ($val2[0]['attr_name']); ?>:</strong>
                                <?php if(is_array($val2)): foreach($val2 as $key=>$val3): ?><label for="spec_value_227">
                                        <input type="radio" checked name="attr[<?php echo ($val3["attr_id"]); ?>]" value="<?php echo ($val3["id"]); ?>" id="spec_value_227"
                                               onclick="changePrice()"/>
                                        <?php echo ($val3["attr_value"]); ?>
                                    </label><?php endforeach; endif; ?>
                            </li><?php endforeach; endif; ?>

                        <li class="padd">
                            <a href="javascript:void(0)" id="ordernow"><img src="/Public/Home/images/goumai2.gif"></a>
                            <a href="javascript:void(0)" id="addCart"><img src="/Public/Home/images/shoucang2.gif"></a>
                            <a href="#"><img src="/Public/Home/images/tuijian.gif"></a>
                        </li>
                    </ul>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo session('user_id');?>">
                </form>
            </div>
        </div>
        <div class="blank"></div>
        <div class="box">
            <div class="box_1">
                <h3 style="padding: 0pt 5px;">
                    <div id="com_b" class="history clearfix">
                        <h2 style="cursor: pointer;">商品描述：</h2>
                        <h2 style="cursor: pointer;" class="h2bg">商品属性</h2>
                    </div>
                </h3>
                <div id="com_v" class="boxCenterList RelaArticle">
                    <p>在机身材质方面，诺基亚E66大量采用金属材质，刨光的金属表面光泽动人，背面的点状效果规则却又不失变化，时尚感总是在不经意间诠释出来，并被人们所感知。E66机身尺寸为<span style="color:red;"><span
                            style="font-size: larger;"><strong>107.5×49.5×13.6毫米，重量为121克</strong></span></span>，滑盖的造型竟然比E71还要轻一些。</p>
                    <p>&nbsp;</p>
                    <div>诺基亚E66机身正面是<span style="color:red;"><span
                            style="font-size: larger;"><strong>一块2.4英寸1600万色QVGA分辨率（240×320像素）液晶显示屏</strong></span></span>。屏幕上方拥有光线感应元件，能够自适应周
                        围环境光调节屏幕亮度；屏幕下方是方向功能键区。打开滑盖，可以看到传统的数字键盘，按键的大小、手感、间隔以及键程适中，手感非常舒适。
                    </div>
                    <div>&nbsp;</div>
                    <div>诺基亚为E66配备了一颗320万像素自动对焦摄像头，带有LED 闪光灯，支持多种拍照尺寸选择。</div>
                    <p>&nbsp;</p>
                </div>
                <div class="none" id="com_h">
                    <blockquote>
                        <p>在机身材质方面，诺基亚E66大量采用金属材质，刨光的金属表面光泽动人，背面的点状效果规则却又不失变化，时尚感总是在不经意间诠释出来，并被人们所感知。E66机身尺寸为<span style="color:red;"><span
                                style="font-size: larger;"><strong>107.5×49.5×13.6毫米，重量为121克</strong></span></span>，滑盖的造型竟然比E71还要轻一些。</p>
                        <p>&nbsp;</p>
                        <div>诺基亚E66机身正面是<span style="color:red;"><span
                                style="font-size: larger;"><strong>一块2.4英寸1600万色QVGA分辨率（240×320像素）液晶显示屏</strong></span></span>。屏幕上方拥有光线感应元件，能够自适应周
                            围环境光调节屏幕亮度；屏幕下方是方向功能键区。打开滑盖，可以看到传统的数字键盘，按键的大小、手感、间隔以及键程适中，手感非常舒适。
                        </div>
                        <div>&nbsp;</div>
                        <div>诺基亚为E66配备了一颗320万像素自动对焦摄像头，带有LED 闪光灯，支持多种拍照尺寸选择。</div>
                        <p>&nbsp;</p></blockquote>
                    <blockquote>
                        <table bgcolor="#dddddd" border="0" cellpadding="3" cellspacing="1" width="100%">
                            <tbody>
                            <tr>
                                <th colspan="2" bgcolor="#ffffff">商品属性</th>
                            </tr>
                            <tr>
                                <td class="f1" align="left" bgcolor="#ffffff" width="30%">[外观样式]</td>
                                <td align="left" bgcolor="#ffffff" width="70%">滑盖</td>
                            </tr>
                            </tbody>
                        </table>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="blank"></div>

        <div class="box">
            <div class="box_1">
                <h3><span class="text">商品标签</span></h3>
                <div class="boxCenterList clearfix ie6">
                    <form name="tagForm" id="tagForm">
                        <p id="ECS_TAGS" style="margin-bottom: 5px;">
                        </p>
                        <p>
                            <input name="tag" id="tag" class="inputBg" size="35" type="text"/>
                            <input value="添 加" class="bnt_blue" style="border: medium none;" type="submit"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="blank5"></div>
        <div class="box">
            <div class="box_1">
                <h3><span class="text">购买过此商品的人还购买过</span></h3>
                <div class="boxCenterList clearfix ie6">
                    <div class="goodsItem">
                        <a href="#">
                            <img src="/Public/Home/images/24_thumb_G_1241971981429.jpg" alt="P806" class="goodsimg"></a><br/>
                        <p><a href="#" title="P806">P806</a></p>
                        <font class="shop_s">￥2000元</font>
                    </div>
                    <div class="goodsItem">
                        <a href="#">
                            <img src="/Public/Home/images/22_thumb_G_1241971076803.jpg" alt="多普达Touch HD" class="goodsimg"/></a><br/>
                        <p><a href="#" title="多普达Touch HD">多普达Touc...</a></p>
                        <font class="shop_s">￥5999元</font>
                    </div>
                    <div class="goodsItem">
                        <a href="#">
                            <img src="/Public/Home/images/13_thumb_G_1241968002527.jpg" alt="诺基亚5320 XpressMusic" class="goodsimg"/></a><br/>
                        <p><a href="#" title="诺基亚5320 XpressMusic">诺基亚5320...</a></p>
                        <font class="shop_s">￥1311元</font>
                    </div>
                </div>
            </div>
        </div>
        <div class="blank5"></div>
        <div id="ECS_BOUGHT">
            <div class="box">
                <div class="box_1">
                    <h3><span class="text">购买记录</span>(近期成交数量<font class="f1">0</font>)</h3>
                    <div class="boxCenterList">
                        还没有人购买过此商品
                        <div id="buy_pagebar" class="f_r" style="margin-top: 10px;">
                            <form name="selectPageForm" action="../../../../index.php" method="get">
                                <div id="buy_pager">
                                    总计 0 个记录，共 1 页。 <span> <a href="#">第一页</a> <a href="#">上一页</a> <a href="#">下一页</a> <a href="#">最末页</a> </span>
                                </div>
                            </form>
                        </div>

                        <div class="blank5"></div>
                    </div>
                </div>
            </div>
            <div class="blank5"></div>
        </div>
        <div id="ECS_COMMENT">
            <div class="box">
                <div class="box_1">
                    <h3><span class="text">用户评论</span>(共<font class="f1">0</font>条评论)</h3>
                    <div class="boxCenterList clearfix" style="height: 1%;">
                        <ul class="comments">
                            <li>暂时还没有任何用户评论</li>
                        </ul>

                        <div id="pagebar" class="f_r">
                            <form name="selectPageForm" action="../../../../index.php" method="get">
                                <div id="pager">
                                    总计 0 个记录，共 1 页。 <span> <a href="#">第一页</a> <a href="#">上一页</a> <a href="#">下一页</a> <a href="#">最末页</a> </span>
                                </div>
                            </form>
                        </div>

                        <div class="blank5"></div>

                        <div class="commentsList">
                            <form action="#" method="post" name="commentForm" id="commentForm">
                                <table border="0" cellpadding="0" cellspacing="5" width="710">
                                    <tbody>
                                    <tr>
                                        <td align="right" width="64">用户名：</td>
                                        <td width="631">匿名用户</td>
                                    </tr>
                                    <tr>
                                        <td align="right">E-mail：</td>
                                        <td>
                                            <input name="email" id="email" maxlength="100" class="inputBorder" type="text"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">评价等级：</td>
                                        <td>
                                            <input name="comment_rank" value="1" id="comment_rank1" type="radio"/>
                                            <img src="/Public/Home/images/stars1.gif"/>
                                            <input name="comment_rank" value="2" id="comment_rank2" type="radio"/>
                                            <img src="/Public/Home/images/stars2.gif"/>
                                            <input name="comment_rank" value="3" id="comment_rank3" type="radio"/>
                                            <img src="/Public/Home/images/stars3.gif"/>
                                            <input name="comment_rank" value="4" id="comment_rank4" type="radio"/>
                                            <img src="/Public/Home/images/stars4.gif"/>
                                            <input name="comment_rank" value="5" checked="checked" id="comment_rank5" type="radio"/>
                                            <img src="/Public/Home/images/stars5.gif"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right" valign="top">评论内容：</td>
                                        <td>
                                            <textarea name="content" class="inputBorder" style="height: 50px; width: 620px;"></textarea>
                                            <input name="cmt_type" value="0" type="hidden"/>
                                            <input name="id" value="9" type="hidden"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div style="padding-left: 15px; text-align: left; float: left;">
                                                验证码：<input name="captcha" class="inputBorder" style="width: 50px; margin-left: 5px;" type="text"/>
                                                <img src="/Public/Home/images/captcha.png" alt="captcha" onclick="this.src='captcha.php?'+Math.random()" class="captcha"/>
                                            </div>
                                            <input name="" value="评论咨询" class="f_r bnt_blue_1" style="margin-right: 8px;" type="submit"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="blank5"></div>

        </div>
    </div>

</div>
<script src="/Public/Home/js/jquery-1.8.2.min.js"></script>

<script src="/Public/Home/js/layer/layer.js"></script>

<script>
    //点击加入收藏提交表单到购物车
    $(function () {
        $('#addCart').click(function () {
            $('#ECS_FORMBUY').prop('action', "<?php echo U('Cart/add');?>");
            $('#ECS_FORMBUY').submit();
        })
    })

    //点击立即购买提交表单
    $(function () {
        $('#ordernow').click(function () {
            //获得用户id
            var user = parseInt($('#user_id').val());
//        alert(user);
            if (user >= 1) {
                //已经登录
//                alert(1);
                //将数据提交到购买页面
                $('#ECS_FORMBUY').prop('action', "<?php echo U('order/flow');?>");
                //提交到购物车
                $('#ECS_FORMBUY').submit();
//                window.location.href = "<?php echo U('order/flow');?>";
            } else {
                //没有登录
                //使用layer插件
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['420px', '240px'], //宽高
                    content: '<form action="" method="post" id="login_form"><table align="left" border="0" cellpadding="3" cellspacing="5" width="100%"><tbody><tr><td align="right" width="15%">用户名</td><td width="85%"><input name="user_name" size="25" class="inputBg" type="text"></td></tr><tr><td align="right">密码</td><td><input name="user_pwd" size="15" class="inputBg" type="password"></td></tr><tr><td colspan="2"></td></tr><tr><td>&nbsp;</td><td align="left"><input  value="" onclick="login_submit()" class="us_Submit" type="button" /></td></tr><tr><td></td><td><a href="#" class="f3">注册邮件找回密码</a></td></tr></tbody></table></form>'
                });
//                window.location.href = "<?php echo U('user/login');?>";
            }
        })
    })

    function login_submit() {
        user_name = $('#login_form input[name=user_name]').val();
        user_pwd = $('#login_form input[name=user_pwd]').val();
        $.ajax({
            url: "<?php echo U('user/login');?>",
            data: 'user_name=' + user_name + "&user_pwd=" + user_pwd,
            type: 'post',
            dataType: 'json',
            success: function (msg) {
                if (msg.status == 1) {
                    //将数据提交到购买页面
                    $('#ECS_FORMBUY').attr('action', "<?php echo U('order/flow');?>");
                    //提交到购物车
                    $('#ECS_FORMBUY').submit();
                } else {
                    //登录失败操作
                    layer.msg(msg.info);
                }
            }
        })
    }

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