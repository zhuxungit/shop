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
            <a href="#">报价单</a>&nbsp;&nbsp;&nbsp;
            <?php echo ($nowwea); ?>
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
        <!-- 面包屑导航-->
        当前位置: <a href="<?php echo U('index/index');?>">首页</a> <code>&gt;</code>
        <?php if(is_array($breaddata)): foreach($breaddata as $key=>$val1): ?><a href="<?php echo U('category','cat_id='.$val1['id']);?>"><?php echo ($val1["cat_name"]); ?></a> <code>&gt;</code><?php endforeach; endif; ?>
    </div>
</div>
<div class="blank"></div>

<div class="block box">

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
                                <li class="goodsimg">
                                    <a href="#" target="_blank">
                                        <img src="/Public/Home/images/8_thumb_G_1241425513488.jpg" alt="飞利浦9@9v" class="B_blue"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" title="飞利浦9@9v">飞利浦9@9v</a><br/>
                                    本店售价：<font class="f1">￥399元</font><br/>
                                </li>
                            </ul>
                            <ul class="clearfix">
                                <li class="goodsimg">
                                    <a href="#" target="_blank">
                                        <img src="/Public/Home/images/9_thumb_G_1241511871555.jpg" alt="诺基亚E66" class="B_blue"/>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank" title="诺基亚E66">诺基亚E66</a><br/>
                                    本店售价：<font class="f1">￥2298元</font><br/>
                                </li>
                            </ul>
                            <ul id="clear_history">
                                <a onclick="clear_history()">[清空]</a>
                            </ul>
                        </div>
                    </div>
            </div>
            <div class="blank5"></div>

        </div>


        <div class="AreaR">

            <div class="box">
                <div class="box_1">
                    <h3><span>商品筛选</span></h3>
                    <div class="screeBox">
                        <strong>品牌：</strong>
                        <span>全部</span>
                        <a href="#">诺基亚</a>&nbsp;
                        <a href="#">摩托罗拉</a>&nbsp;
                        <a href="#">多普达</a>&nbsp;
                        <a href="#">飞利浦</a>&nbsp;
                        <a href="#">夏新</a>&nbsp;
                        <a href="#">三星</a>&nbsp;
                        <a href="#">索爱</a>&nbsp;
                        <a href="#">联想</a>&nbsp;
                        <a href="#">金立</a>&nbsp;
                    </div>
                    <div class="screeBox">
                        <strong>价格：</strong>
                        <span>全部</span>
                        <a href="#">200&nbsp;-&nbsp;1700</a>&nbsp;
                        <a href="#">1700&nbsp;-&nbsp;3200</a>&nbsp;
                        <a href="#">4700&nbsp;-&nbsp;6200</a>&nbsp;
                    </div>
                    <div class="screeBox">
                        <strong>颜色 :</strong>
                        <span>全部</span>
                        <a href="#">灰色</a>&nbsp;
                        <a href="#">白色</a>&nbsp;
                        <a href="#">金色</a>&nbsp;
                        <a href="#">黑色</a>&nbsp;
                    </div>
                    <div class="screeBox">
                        <strong>屏幕大小 :</strong>
                        <span>全部</span>
                        <a href="#">1.75英寸</a>&nbsp;
                        <a href="#">2.0英寸</a>&nbsp;
                        <a href="#">2.2英寸</a>&nbsp;
                        <a href="#">2.6英寸</a>&nbsp;
                        <a href="#">2.8英寸</a>&nbsp;
                    </div>
                    <div class="screeBox">
                        <strong>手机制式 :</strong>
                        <span>全部</span>
                        <a href="#">CDMA</a>&nbsp;
                        <a href="#">GSM,850,900,1800,1900</a>&nbsp;
                        <a href="#">GSM,900,1800,1900,2100</a>&nbsp;
                    </div>
                    <div class="screeBox">
                        <strong>外观样式 :</strong>
                        <span>全部</span>
                        <a href="#">滑盖</a>&nbsp;
                        <a href="#">直板</a>&nbsp;
                    </div>
                </div>
            </div>
            <div class="blank"></div>


            <div class="itemTit" id="itemBest">

                <div class="tit">精品推荐</div>
            </div>
            <div id="show_best_area" class="clearfix">
                <div class="goodsItem">

                    <a href="#"><img src="/Public/Home/images/9_thumb_G_1241511871555.jpg" alt="诺基亚E66" class="goodsimg"></a><br/>
                    <p class="f1"><a href="#" title="诺基亚E66">诺基亚E66</a></p>


                    <font class="market">￥2758元</font><br/>

                    <font class="f1">
                        ￥2298元 </font>
                </div>
                <div class="goodsItem">

                    <a href="#"><img src="/Public/Home/images/8_thumb_G_1241425513488.jpg" alt="飞利浦9@9v" class="goodsimg"></a><br/>
                    <p class="f1"><a href="#" title="飞利浦9@9v">飞利浦9@9v</a></p>


                    <font class="market">￥479元</font><br/>

                    <font class="f1">
                        ￥399元 </font>
                </div>
                <div class="goodsItem">

                    <a href="#"><img src="/Public/Home/images/17_thumb_G_1241969394587.jpg" alt="夏新N7" class="goodsimg"></a><br/>
                    <p class="f1"><a href="#" title="夏新N7">夏新N7</a></p>


                    <font class="market">￥2760元</font><br/>

                    <font class="f1">
                        ￥2300元 </font>
                </div>

            </div>
            <div class="blank"></div>
            <div class="box">
                <div class="box_1">
                    <h3>
                        <span>商品列表</span>
                        <form method="GET" class="sort" name="listform">
                            显示方式：
                            <a href="#"><img src="/Public/Home/images/display_mode_list.gif" alt=""></a>
                            <a href="#"><img src="/Public/Home/images/display_mode_grid_act.gif" alt=""></a>
                            <a href="#"><img src="/Public/Home/images/display_mode_text.gif" alt=""></a>&nbsp;&nbsp;

                            <a href="#"><img src="/Public/Home/images/goods_id_DESC.gif" alt="按上架时间排序"></a>
                            <a href="#"><img src="/Public/Home/images/shop_price_default.gif" alt="按价格排序"></a>
                            <a href="#"><img src="/Public/Home/images/last_update_default.gif" alt="按更新时间排序"></a>
                            <input name="category" value="3" type="hidden"/>
                            <input name="display" value="grid" id="display" type="hidden"/>
                            <input name="brand" value="0" type="hidden"/>
                            <input name="price_min" value="0" type="hidden"/>
                            <input name="price_max" value="0" type="hidden"/>
                            <input name="filter_attr" value="0" type="hidden"/>
                            <input name="page" value="1" type="hidden"/>
                            <input name="sort" value="goods_id" type="hidden"/>
                            <input name="order" value="DESC" type="hidden"/>
                        </form>
                    </h3>
                    <form name="compareForm" action="compare.php" method="post" onsubmit="return compareGoods(this);">
                        <div class="clearfix goodsBox" style="border: medium none; padding: 11px 0pt 10px 5px;">
                            <?php if(is_array($goodsdata)): foreach($goodsdata as $key=>$val): ?><div class="goodsItem">
                                    <a target="_blank" href="<?php echo U('index/detail','id='.$val[id]);?>"><img src="/Public/Uploads/<?php echo ($val["goods_thumb"]); ?>"
                                                                                                       alt="<?php echo ($val["goods_name"]); ?>" class="goodsimg"></a><br/>
                                    <p><a target="_blank" href="<?php echo U('index/detail','id='.$val[id]);?>" title="<?php echo ($val["goods_name"]); ?>"><?php echo ($val["goods_name"]); ?></a></p>
                                    <font class="market_s">￥<?php echo ($val["market_price"]); ?>2元</font><br/>
                                    <font class="shop_s">￥<?php echo ($val["shop_price"]); ?>元</font><br/>
                                    <a href="#"><img src="/Public/Home/images/goumai.gif"></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#"><img src="/Public/Home/images/shoucang.gif"></a>
                                </div><?php endforeach; endif; ?>

                        </div>
                    </form>

                </div>
            </div>
            <div class="blank5"></div>
            <form name="selectPageForm" action="/category.php" method="get">
                <div id="pager" class="pagebar">
                    <span class="f_l " style="margin-right: 10px;">总计 <b>12</b>  个记录</span>
                    <span class="page_now">1</span>
                    <a href="#">[2]</a>

                    <a class="next" href="#">下一页</a></div>
            </form>
        </div>

    </div>

</div>



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