<?php
return array(
    //'配置项'=>'配置值'
    'TMPL_PARSE_STRING' => [
        '__CSS__' => '/Public/Home/css',
        '__IMG__' => '/Public/Home/images',
        '__HJS__' => '/Public/Home/js',
        '__JS__' => '/Public/Js'
    ],
    //设置cookie的前缀
    'COOKIE_PREFIX' => 'home_',
    //开启layout布局
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'layout',

    /*
   *支付宝配置文件
   */
    'PAY_ALIPAY' => array(
        'partner' => '商户PID',
        //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
        'seller_id' => '商户PID',

        // MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        'key' => '商户的key',

        // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        'notify_url' => "http://www.shshop.com/alipay/notify_url.php",

        // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        'return_url' => "http://www.shshop.com/alipay/return_url.php",

        //签名方式
        'sign_type' => strtoupper('MD5'),

        //字符编码格式 目前支持 gbk 或 utf-8
        'input_charset' => strtolower('utf-8'),

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        'cacert' => VENDOR_PATH . 'alipay/cacert.pem',

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        'transport' => 'http',
        'payment_type' => "1",
        'service' => "create_direct_pay_by_user",

    ),

    /**
     * 短信验证码配置文件
     */
    'SEND_MSG' => array(
        //主帐号,对应开官网发者主账号下的 ACCOUNT SID
        'accountSid' => '8aaf07085c62aa66015c9b59705c13e9',
        //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
        'accountToken' => 'c69b06edf46b48afbb00fb7387b7885f',
        //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
        //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
        'appId' => '8aaf07085c62aa66015c9b5d4ef013f9',
        //请求地址
        //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
        //生产环境（用户应用上线使用）：app.cloopen.com
        'serverIP' => 'sandboxapp.cloopen.com',
        //请求端口，生产环境和沙盒环境一致
        'serverPort' => '8883',
        //REST版本号，在官网文档REST介绍中获得。
        'softVersion' => '2013-12-26',
    ),

);