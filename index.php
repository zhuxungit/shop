<?php
//定义应用目录
define('APP_PATH', './App/');
//开启调试模式
define('APP_DEBUG', TRUE);
//网站跟路径
define('WEB_ROOT', str_replace('\\', '/', __DIR__));
//定义vender路径
define('VENDOR_PATH', WEB_ROOT.'/ThinkPHP/Library/Vendor/');
//引入Tp的入口文件
require './ThinkPHP/ThinkPHP.php';

?>