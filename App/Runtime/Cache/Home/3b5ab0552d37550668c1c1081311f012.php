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
            <a href="#">选购中心</a>
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


<div class="block box">
    <div class="blank"></div>
    <div id="ur_here">
        当前位置: <a href="#">首页</a> <code>&gt;</code> 用户中心
    </div>
</div>

<div class="blank"></div>
<div class="blank"></div>

<div class="block clearfix">

    <div class="AreaR">
        <div class="box">
            <div class="box_1">
                <div class="userCenterBox boxCenterList clearfix" style="">
                    <h5><span>收货人信息</span></h5>
                    <div class="blank"></div>
                    <form action="/Home/Order/writeaddress" method="post" name="theForm">
                        <input type="hidden" name="admin_id" value="<?php echo (session('admin_id')); ?>">
                        <table bgcolor="#dddddd" border="0" cellpadding="5" cellspacing="1" width="100%">
                            <tbody>
                            <tr>
                                <td align="right" bgcolor="#ffffff">配送区域：</td>
                                <td colspan="3" align="left" bgcolor="#ffffff">
                                    <select name="country" id="selCountries_0">
                                        <option value="0">请选择国家</option>
                                        <option value="1" selected="selected">中国</option>
                                    </select>
                                    <select name="province" id="selProvinces_0">
                                        <option value="0">请选择省</option>
                                        <option value="2" selected="selected">北京</option>
                                        <option value="3">安徽</option>
                                        <option value="4">福建</option>
                                        <option value="5">甘肃</option>
                                        <option value="6">广东</option>
                                        <option value="7">广西</option>
                                        <option value="8">贵州</option>
                                        <option value="9">海南</option>
                                        <option value="10">河北</option>
                                        <option value="11">河南</option>
                                        <option value="12">黑龙江</option>
                                        <option value="13">湖北</option>
                                        <option value="14">湖南</option>
                                        <option value="15">吉林</option>
                                        <option value="16">江苏</option>
                                        <option value="17">江西</option>
                                        <option value="18">辽宁</option>
                                        <option value="19">内蒙古</option>
                                        <option value="20">宁夏</option>
                                        <option value="21">青海</option>
                                        <option value="22">山东</option>
                                        <option value="23">山西</option>
                                        <option value="24">陕西</option>
                                        <option value="25">北京</option>
                                        <option value="26">四川</option>
                                        <option value="27">天津</option>
                                        <option value="28">西藏</option>
                                        <option value="29">新疆</option>
                                        <option value="30">云南</option>
                                        <option value="31">浙江</option>
                                        <option value="32">重庆</option>
                                        <option value="33">香港</option>
                                        <option value="34">澳门</option>
                                        <option value="35">台湾</option>
                                    </select>
                                    <select name="city" id="selCities_0">
                                        <option value="0">请选择市</option>
                                        <option value="52" selected="selected">北京</option>
                                    </select>
                                    <select name="district" id="selDistricts_0">
                                        <option value="0">请选择区</option>
                                        <option value="500">东城区</option>
                                        <option value="501">西城区</option>
                                        <option value="502">海淀区</option>
                                        <option value="503">朝阳区</option>
                                        <option value="504">崇文区</option>
                                        <option value="505">宣武区</option>
                                        <option value="506">丰台区</option>
                                        <option value="507">石景山区</option>
                                        <option value="508">房山区</option>
                                        <option value="509">门头沟区</option>
                                        <option value="510">通州区</option>
                                        <option value="511">顺义区</option>
                                        <option value="512" selected="selected">昌平区</option>
                                        <option value="513">怀柔区</option>
                                        <option value="514">平谷区</option>
                                        <option value="515">大兴区</option>
                                        <option value="516">密云县</option>
                                        <option value="517">延庆县</option>
                                    </select>
                                    (必填)
                                </td>
                            </tr>
                            <tr>
                                <td align="right" bgcolor="#ffffff">收货人姓名：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="consignee_name" class="inputBg" id="consignee_0"  type="text" value="<?php echo ($addressinfo["consignee_name"]); ?>"/>
                                    (必填)
                                </td>
                                <td align="right" bgcolor="#ffffff">电子邮件地址：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="consignee_email" class="inputBg" id="email_0" value="shuhua141@163.com" type="text"/>
                                    (必填)
                                </td>
                            </tr>
                            <tr>
                                <td align="right" bgcolor="#ffffff">详细地址：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="consignee_address" class="inputBg" id="address_0" value="上地" type="text"/>
                                    (必填)
                                </td>
                                <td align="right" bgcolor="#ffffff">邮政编码：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="consignee_zipcode" class="inputBg" id="zipcode_0" value="232322" type="text"/></td>
                            </tr>
                            <tr>
                                <td align="right" bgcolor="#ffffff">电话：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="consignee_tel" class="inputBg" id="tel_0" value="<?php echo ($addressinfo["consignee_mobile"]); ?>" type="text"/>
                                    (必填)
                                </td>
                                <td align="right" bgcolor="#ffffff">手机：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="consignee_mobile" class="inputBg" id="mobile_0" value="1232323" type="text"/></td>
                            </tr>
                            <tr>
                                <td align="right" bgcolor="#ffffff">标志建筑：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="sign_building" class="inputBg" id="sign_building_0" type="text"/></td>
                                <td align="right" bgcolor="#ffffff">最佳送货时间：</td>
                                <td align="left" bgcolor="#ffffff">
                                    <input name="best_time" class="inputBg" id="best_time_0" type="text"/></td>
                            </tr>
                            <tr>
                                <td align="right" bgcolor="#ffffff">&nbsp;</td>
                                <td colspan="3" align="center" bgcolor="#ffffff">
                                    <input name="submit" class="bnt_blue_1" value="确认修改" type="submit"/>
                                    <input name="button" class="bnt_blue" value="删除" type="button"/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="blank"></div>-->



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