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


<script src="/Public/Home/js/jquery-1.8.2.min.js"></script>
<script src="/Public/Home/js/jR3DCarousel.min.js"></script>
<div class="block box">
    <div class="blank"></div>
    <div id="ur_here">
        当前位置: <a href="<?php echo U('index/index');?>">首页</a> <code>&gt;</code>
    </div>
</div>
<div class="blank"></div>
<div class="block box">

    <div class="block clearfix">
        <div class="AreaL">
            <h3><span>商品分类</span></h3>
            <div id="category_tree" class="box_1">

                <!-- 侧边栏数据-->
                <?php if(is_array($lanmudata)): foreach($lanmudata as $key=>$val): if($val['parent_id']==0): ?><dl>
                            <dt><a target="_blank" href="<?php echo U('category','cat_id='.$val['id']);?>"><?php echo ($val["cat_name"]); ?></a></dt>
                            <?php if(is_array($lanmudata)): foreach($lanmudata as $key=>$v): if($val['id'] == $v['parent_id']): ?><dd style="display: inline-block">
                                        <a target="_blank" href="<?php echo U('category','cat_id='.$v['id']);?>"><?php echo ($v["cat_name"]); ?></a>
                                    </dd><?php endif; endforeach; endif; ?>
                        </dl><?php endif; endforeach; endif; ?>

            </div>
            <div class="blank"></div>
            <div class="box">
                <h3><span>销售排行榜</span></h3>
                <div class="box_1">
                    <div class="top10List clearfix">
                        <?php if(is_array($goodssales)): foreach($goodssales as $key=>$gg): ?><ul class="clearfix">
                                <img <?php if($key == 0): ?>src="/Public/Home/images/top_1.gif" <?php elseif($key == 1): ?>src="/Public/Home/images/top_2.gif"<?php elseif($key == 2): ?>src="/Public/Home/images/top_3.gif"<?php endif; ?> class="iteration">
                                <?php if($key == 0): ?><li class="topimg">
                                    <a href="#"><img src="/Public/Uploads/<?php echo ($gg["goods_thumb"]); ?>" alt="" class="samllimg"></a>
                                </li> <?php elseif($key == 1): ?><li class="topimg">
                                    <a href="#"><img src="/Public/Uploads/<?php echo ($gg["goods_thumb"]); ?>" alt="" class="samllimg"></a>
                                </li><?php elseif($key == 2): ?><li class="topimg">
                                    <a href="#"><img src="/Public/Uploads/<?php echo ($gg["goods_thumb"]); ?>" alt="" class="samllimg"></a>
                                </li><?php endif; ?>
                                
                                <li class="iteration1">
                                    <a href="#" title=""><?php echo ($gg["goods_name"]); ?></a><br/>
                                    售价：<font class="f1">￥<?php echo ($gg["shop_price"]); ?>元</font><br/>
                                </li>
                            </ul><?php endforeach; endif; ?>
                        <!--<ul class="clearfix">-->
                        <!--<img src="/Public/Home/images/top_2.gif" class="iteration">-->
                        <!--<li class="topimg">-->
                        <!--<a href="#"><img src="/Public/Home/images/24_thumb_G_1241971981429.jpg" alt="" class="samllimg"></a>-->
                        <!--</li>-->

                        <!--<li class="iteration1">-->
                        <!--<a href="#" title="">P806</a><br/>-->
                        <!--本店售价：<font class="f1">￥2000元</font><br/>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--<ul class="clearfix">-->
                        <!--<img src="/Public/Home/images/top_3.gif" class="iteration">-->
                        <!--<li class="topimg">-->
                        <!--<a href="#"><img src="/Public/Home/images/12_thumb_G_1241965978410.jpg" alt="" class="samllimg"></a>-->
                        <!--</li>-->

                        <!--<li class="iteration1">-->
                        <!--<a href="#" title="">摩托罗拉A81...</a><br/>-->
                        <!--本店售价：<font class="f1">￥983元</font><br/>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--<ul class="clearfix">-->
                        <!--<img src="/Public/Home/images/top_4.gif" class="iteration">-->

                        <!--<li>-->
                        <!--<a href="#" title="">诺基亚E66</a><br/>-->
                        <!--本店售价：<font class="f1">￥2298元</font><br/>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--<ul class="clearfix">-->
                        <!--<img src="/Public/Home/images/top_5.gif" class="iteration">-->

                        <!--<li>-->
                        <!--<a href="#" title="">多普达Touc...</a><br/>-->
                        <!--本店售价：<font class="f1">￥5999元</font><br/>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--<ul class="clearfix">-->
                        <!--<img src="/Public/Home/images/top_6.gif" class="iteration">-->

                        <!--<li>-->
                        <!--<a href="#" title="">三星BC01</a><br/>-->
                        <!--本店售价：<font class="f1">￥280元</font><br/>-->
                        <!--</li>-->
                        <!--</ul>-->
                        <!--<ul class="clearfix">-->
                        <!--<img src="/Public/Home/images/top_7.gif" class="iteration">-->

                        <!--<li>-->
                        <!--<a href="#" title="">飞利浦9@9v</a><br/>-->
                        <!--本店售价：<font class="f1">￥399元</font><br/>-->
                        <!--</li>-->
                        <!--</ul>-->
                    </div>
                </div>
            </div>
            <div class="blank5"></div>
            <div class="box"><h3><span>品牌专区</span></h3>
                <div class="box_1">
                    <div class=" brands clearfix">
                        <a href="#"><img src="/Public/Home/images/1240803062307572427.gif" alt="诺基亚 (7)"></a>
                        <a href="#"><img src="/Public/Home/images/1240802922410634065.gif" alt="摩托罗拉 (1)"></a>
                        <a href="#"><img src="/Public/Home/images/1240803144788047486.gif" alt="多普达 (1)"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="AreaM">
            <div class="box clearfix">
                <div id="focus" class="jR3DCarouselGallery">
                    <!--<img src="/Public/Home/images/111.jpg" width="515" height="160" alt=""/>-->
                </div>
            </div>
            <div class="blank"></div>

            <div class="itemTit" id="itemHot">
                <div class="tit">热卖商品</div>
                <h2><a href="#">全部商品</a></h2>
                <h2 class="h2bg"><a href="#">GSM手机</a></h2>
                <h2 class="h2bg"><a href="#">双模手机</a></h2>
                <h2 class="h2bg"><a href="#">充值卡</a></h2>
                <h2 class="h2bg"><a href="#">移动手机充值卡</a></h2>
            </div>
            <div id="show_hot_area" class="clearfix">
                <?php if(is_array($hotdata)): foreach($hotdata as $key=>$v1): ?><div class="goodsItem">
                        <a target="_blank" href="<?php echo U('index/detail','id='.$v1['id']);?>"><img src="/Public/Uploads/<?php echo ($v1["goods_thumb"]); ?>" alt="<?php echo ($v1["goods_name"]); ?>"
                                                                                            class="goodsimg"></a><br/>
                        <p class="f1"><a target="_blank" href="<?php echo U('index/detail','id='.$v1['id']);?>" title="<?php echo ($v1["goods_name"]); ?>"><?php echo ($v1["goods_name"]); ?></a></p>
                        <font class="market">￥<?php echo ($v1["market_price"]); ?>元</font><br/>
                        <font class="f1">
                            ￥<?php echo ($v1["shop_price"]); ?>元 </font>
                    </div><?php endforeach; endif; ?>

            </div>
            <div class="blank"></div>

            <div class="itemTit" id="itemBest">

                <div class="tit">精品推荐</div>
                <h2><a href="#">全部商品</a></h2>
                <h2 class="h2bg"><a href="#">GSM手机</a></h2>
                <h2 class="h2bg"><a href="#">双模手机</a></h2>
                <h2 class="h2bg"><a href="#">充值卡</a></h2>
                <h2 class="h2bg"><a href="#">联通手机充值卡</a></h2>
            </div>
            <div id="show_best_area" class="clearfix">

                <?php if(is_array($bestdata)): foreach($bestdata as $key=>$v2): ?><div class="goodsItem">
                        <a href="<?php echo U('index/detail','id='.$v2['id']);?>"><img src="/Public/Uploads/<?php echo ($v2["goods_thumb"]); ?>" alt="<?php echo ($v2["goods_name"]); ?>" class="goodsimg"></a><br/>
                        <p class="f1"><a href="<?php echo U('index/detail','id='.$v2['id']);?>" title="<?php echo ($v2["goods_name"]); ?>"><?php echo ($v2["goods_name"]); ?></a></p>
                        <font class="market">￥<?php echo ($v2["market_price"]); ?>元</font><br/>
                        <font class="f1">
                            ￥<?php echo ($v2["shop_price"]); ?>元 </font>
                    </div><?php endforeach; endif; ?>

            </div>
            <div class="blank"></div>

            <div class="itemTit" id="itemNew">
                <div class="tit">新品上架</div>
                <h2><a href="#">全部商品</a></h2>
                <h2 class="h2bg"><a href="#">GSM手机</a></h2>
                <h2 class="h2bg"><a href="#">双模手机</a></h2>
                <h2 class="h2bg"><a href="#">充值卡</a></h2>
                <h2 class="h2bg"><a href="#">联通手机充值卡</a></h2>
            </div>
            <div id="show_new_area" class="clearfix">

                <?php if(is_array($newdata)): foreach($newdata as $key=>$v3): ?><div class="goodsItem">
                        <a href="<?php echo U('index/detail','id='.$v3['id']);?>"><img src="/Public/Uploads/<?php echo ($v3["goods_thumb"]); ?>" alt="<?php echo ($v3["goods_name"]); ?>" class="goodsimg"></a><br/>
                        <p class="f1"><a href="<?php echo U('index/detail','id='.$v3['id']);?>" title="<?php echo ($v3["goods_name"]); ?>"><?php echo ($v3["goods_name"]); ?></a></p>
                        <font class="market">￥<?php echo ($v3["market_price"]); ?>元</font><br/>
                        <font class="f1">
                            ￥<?php echo ($v3["shop_price"]); ?>元 </font>
                    </div><?php endforeach; endif; ?>


            </div>
            <div class="blank"></div>

        </div>


        <div class="AreaL" style="float: right;">

            <h3><span>新闻快讯</span></h3>
            <div class="NewsList tc box_1" style="border-top: medium none;">
                <ul>
                    <li>
                        <a href="#" title="三星SGHU308说明书下载">三星SGHU308说明书下载</a>
                    </li>
                    <li>
                        <a href="#" title="手机游戏下载">手机游戏下载</a>
                    </li>
                    <li>
                        <a href="#" title="促销诺基亚N96">促销诺基亚N96</a>
                    </li>
                    <li>
                        <a href="#" title="诺基亚5320 促销">诺基亚5320 促销</a>
                    </li>
                    <li>
                        <a href="#" title="3G知识普及">3G知识普及</a>
                    </li>
                    <li>
                        <a href="#" title="诺基亚6681手机广告欣赏">诺基亚6681手机广告欣赏</a>
                    </li>
                    <li>
                        <a href="#" title="飞利浦9@9促销">飞利浦9@9促销</a>
                    </li>
                    <li>
                        <a href="#" title="800万像素超强拍照机 LG Viewty Smart再曝光">800万像素超强拍照机 LG V...</a>
                    </li>
                </ul>
            </div>

            <div class="blank"></div>
            <div class="box">
                <h3><span>订单查询</span></h3>
                <div class="box_1">
                    <div class="boxCenterList">
                        <form name="ecsOrderQuery">
                            <input name="order_sn" class="inputBg" type="text"/><br/>
                            <div class="blank5"></div>
                            <input value="查询该订单号" class="bnt_blue_2" type="button"/>
                        </form>
                        <div id="ECS_ORDER_QUERY" style="margin-top: 8px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="blank"></div>
            <div class="blank"></div>
            <div class="box">
                <h3><span>邮件订阅</span></h3>
                <div class="box_1">

                    <div class="boxCenterList RelaArticle">
                        <input id="user_email" class="inputBg" type="text"/><br/>
                        <div class="blank5"></div>
                        <input class="bnt_blue" value="订阅" type="button"/>
                        <input class="bnt_bonus" value="退订" type="button"/>
                    </div>
                </div>
            </div>
            <div class="blank"></div>
            <div class="box">
                <h3>
                    <span><a href=""></a></span>
                    <a href="">更多</a>
                </h3>
                <div class="box_1">

                    <div class="boxCenterList RelaArticle">
                    </div>
                </div>
            </div>
            <div class="blank5"></div>
            <style type="text/css">
                .boxCenterList form {
                    display: inline;
                }

                .boxCenterList form a {
                    color: #404040;
                    text-decoration: underline;
                }
            </style>
            <div class="box">
                <h3><span>发货查询</span></h3>
                <div class="box_1">
                    <div class="boxCenterList">
                        订单号 2009061909851<br/>
                        发货单 232421
                        <div class="blank"></div>
                        订单号 2009052224892<br/>
                        发货单 1123344
                        <div class="blank"></div>
                    </div>
                </div>
            </div>
            <div class="blank"></div>
        </div>
    </div>
</div>
<script>
    $(".jR3DCarouselGallery").jR3DCarousel({
        "width": 515,
        "height": 160,
        "slideLayout": "fill",
        "animation": "slide3D",
        "animationCurve": "ease",
        "animationDuration": 700,
        "animationInterval": 1000,
        "autoplay": false,
        "navigation": "circles",
        "slides": [
            {
                "src": "/Public/Home/images/111.jpg"
            },
            {
                "src": "/Public/Home/images/222.jpg"
            },
            {
                "src": "/Public/Home/images/333.jpg"
            },
        ]
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