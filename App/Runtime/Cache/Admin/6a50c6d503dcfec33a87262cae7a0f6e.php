<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP Menu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>

    <style type="text/css">
        body {
            background: #80BDCB;
        }

        #tabbar-div {
            background: #278296;
            padding-left: 10px;
            height: 21px;
            padding-top: 0px;
        }

        #tabbar-div p {
            margin: 1px 0 0 0;
        }

        .tab-front {
            background: #80BDCB;
            line-height: 20px;
            font-weight: bold;
            padding: 4px 15px 4px 18px;
            border-right: 2px solid #335b64;
            cursor: hand;
            cursor: pointer;
        }

        .tab-back {
            color: #F4FAFB;
            line-height: 20px;
            padding: 4px 15px 4px 18px;
            cursor: hand;
            cursor: pointer;
        }

        .tab-hover {
            color: #F4FAFB;
            line-height: 20px;
            padding: 4px 15px 4px 18px;
            cursor: hand;
            cursor: pointer;
            background: #2F9DB5;
        }

        #top-div {
            padding: 3px 0 2px;
            background: #BBDDE5;
            margin: 5px;
            text-align: center;
        }

        #main-div {
            border: 1px solid #345C65;
            padding: 5px;
            margin: 5px;
            background: #FFF;
        }

        #menu-list {
            padding: 0;
            margin: 0;
        }

        #menu-list ul {
            padding: 0;
            margin: 0;
            list-style-type: none;
            color: #335B64;
        }

        #menu-list li {
            padding-left: 16px;
            line-height: 16px;
            cursor: hand;
            cursor: pointer;
        }

        #main-div a:visited, #menu-list a:link, #menu-list a:hover {
            color: #335B64;
            text-decoration: none;
        }

        #menu-list a:active {
            color: #EB8A3D;
        }

        .explode {
            background: url(/Public/Admin/images/menu_minus.gif) no-repeat 0px 3px;
            font-weight: bold;
        }

        .collapse {
            background: url(/Public/Admin/images/menu_plus.gif) no-repeat 0px 3px;
            font-weight: bold;
        }

        .menu-item {
            background: url(/Public/Admin/images/menu_arrow.gif) no-repeat 0px 3px;
            font-weight: normal;
        }

        #help-title {
            font-size: 14px;
            color: #000080;
            margin: 5px 0;
            padding: 0px;
        }

        #help-content {
            margin: 0;
            padding: 0;
        }

        .tips {
            color: #CC0000;
        }

        .link {
            color: #000099;
        }
    </style>

</head>
<body>
<div id="tabbar-div">
    <p><span style="float:right; padding: 3px 5px;"><a href="#"><img id="toggleImg" src="/Public/Admin/images/menu_minus.gif"
                                                                     width="9" height="9" border="0"
                                                                     alt="闭合"/></a></span>

        <span class="tab-front" id="menu-tab">菜单</span>
    </p>
</div>
<div id="main-div">
    <div id="menu-list">
        <ul>
            <!--<li class="explode" key="02_cat_and_goods" name="menu">-->
                <!--<span>商品管理</span>-->
                <!--<ul>-->
                    <!--<li class="menu-item"><a href="<?php echo U('goods/lst');?>" target="main-frame">商品列表</a></li>-->
                    <!--<li class="menu-item"><a href="<?php echo U('goods/add');?>" target="main-frame">添加新商品</a></li>-->
                    <!--<li class="menu-item"><a href="<?php echo U('category/lst');?>" target="main-frame">商品分类</a></li>-->
                <!--</ul>-->
            <!--</li>-->

            <!--<li class="explode" key="04_order" name="menu">-->
                <!--<span>订单管理</span>-->
                <!--<ul>-->
                    <!--<li class="menu-item"><a href="#" target="main-frame">订单列表</a></li>-->
                <!--</ul>-->
            <!--</li>-->
            <?php foreach ($menusdata as $v){ ?>
            <li class="explode" key="04_order" name="menu">
                <span><?php echo $v['priv_name'] ?></span>
                <ul>
                    <?php foreach ($v['child'] as $v1){ $url = $v1['module_name'].'/'.$v1['controller_name'].'/'.$v1['action_name'];?>
                        <li class='menu-item'><a href='<?php echo U($url) ?>' target='main-frame'><?php echo $v1['priv_name']?> </a></li>

                    <?php }?>
                </ul>
            </li>
            <?php }?>
        </ul>
    </div>
    <div id="help-div" style="display:none">
        <h1 id="help-title"></h1>

        <div id="help-content"></div>
    </div>
</div>
<script src="/Public/Js/jquery.js"></script>

<script>
    $('.explode span').click(function () {
        $(this).siblings('ul').slideToggle();

    })
</script>

</body>
</html>