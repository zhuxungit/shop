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


<div class="block box">
    <div class="blank"></div>
    <div id="ur_here">
        当前位置: <a href="#">首页</a> <code>&gt;</code> 用户注册
    </div>
</div>
<div class="blank"></div>

<div class="block box">

    <div class="usBox">
        <div class="usBox_2 clearfix">
            <div class="logtitle3"></div>
            <form id="signupForm" name="signupForm" action="" method="post">
                <table cellpadding="5" cellspacing="3" style="text-align:left; width:100%; border:0;">
                    <tbody>
                    <tr>
                        <td style="width:13%; text-align: right;"><label for="User_username" class="required">用户名
                            <span class="required">*</span></label>
                        </td>

                        <td style="width:87%;">
                            <input class="inputBg" size="25" name="user_name" id="user_name" type="text" value=""/>
                            <!-- <span style="color:red;">用户名已经存在</span> -->
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="User_password" class="required">密码 <span class="required">*</span></label>
                        </td>

                        <td>
                            <input class="inputBg" size="25" name="user_pwd" id="user_pwd" type="password" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><label for="User_password2">密码确认<span class="required">*</span></label></td>
                        <td>
                            <input class="inputBg" size="25" name="user_pwd2" id="user_pwd2" type="password"/>
                        </td>

                    </tr>
                    <tr>
                        <td align="right"><label for="User_user_email">邮箱<span class="required">*</span></label></td>
                        <td>
                            <input class="inputBg" size="25" name="user_email" id="user_email" type="text" value=""/>
                        </td>
                    </tr>
                    <!--<tr>-->

                        <!--<td align="right"><label for="User_user_qq">qq号码</label></td>-->
                        <!--<td>-->
                            <!--<input class="inputBg" size="25" name="user_qq" id="user_qq" type="text" value=""/>-->
                        <!--</td>-->
                    <!--</tr>-->
                    <tr>
                        <td align="right"><label for="User_user_tel">手机</label></td>
                        <td>
                            <input class="inputBg" size="25" name="user_phone" id="user_phone" type="text" value=""/>
                            <input type="button" id="phone_code_btn" onclick="send_msg()" value="点击获取验证码">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><label for="User_user_tel">输入手机验证码</label></td>
                        <td>
                            <input class="inputBg" size="25" name="phone_code" id="phone_code" type="text" value=""/>
                        </td>
                    </tr>
                    <tr>
                        <!--textArea($model,$attribute,$htmlOptions=array())-->
                        <td align="right"><label for="User_user_introduce">验证码</label></td>
                        <td>
                            <input class="inputBg" size="25" name="captcha" id="captcha" type="text" value=""/>
                            <img style="width: 80px;height: 30px" onclick="this.src='/Home/User/autoCode/t/'+Math.random();" src='/Home/User/autoCode'/>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>

                        <td align="left">
                            <input name="Submit" value="" class="us_Submit_reg" type="submit"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</div>

</div>
<script src="/Public/Home/js/jquery-1.8.2.min.js"></script>
<script src="/Public/Home/js/jquery.validate.js"></script>
<script type="text/javascript">
    //点击按钮发送短信验证、并倒计时
    var time = 10;
    function send_msg() {
        //发送手机验证码
        if (time==10) {
            phonenum = $('#user_phone').val();
//            alert($phonenum);
            $.post('<?php echo U("index/phoneCode");?>','phonenum='+phonenum,function (msg) {
//                console.log(msg);
                if (msg.status==0){
                    alert(msg.info);
                }
            },'json');
        }
        //实现倒计时
        if(time==0){
            //按钮可点击
            $('#phone_code_btn').attr('disabled',false);
            $('#phone_code_btn').val('点击获取验证码');
            time=10;
        }else {
            time--;
            $('#phone_code_btn').attr('disabled',true);
            $('#phone_code_btn').val('重新获取验证码（'+time+'）');
            setTimeout(send_msg,1000);

        }
    }

    /**
     * js前台输入验证
     */
    $("#signupForm").validate({
        rules: {
            user_name: {
                required: true,
                minlength: 5
            },
            user_pwd: {
                required: true,
                minlength: 5
            },
            user_pwd2: {
                required: true,
                minlength: 5,
                equalTo: "#user_pwd"
            },
            user_email: {
                required: true,
                email: true
            },
        },
        messages: {
            user_name: {
                required: "请输入用户名",
                minlength: "用户名长度必须不小于5个字符"
            },
            user_pwd: {
                required: "请输入密码",
                minlength: "密码长度必须不小于5个字符"
            },
            user_pwd2: {
                required: "请再次输入密码",
                minlength: "密码长度必须不小于5个字符",
                equalTo: "两次密码输入不一致"
            },
            user_email: "邮箱格式必须正确",
        }
    });
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