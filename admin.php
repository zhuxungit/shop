<?php
//定义项目程序路径
define('APP_PATH','./App/');
//开启调试模式
define('APP_DEBUG',TRUE);
//想让该入口文件，直接路由到Admin模块里面的Index控制器的index方法
$_GET['m'] = 'Admin';
$_GET['c'] = 'Index';
$_GET['a'] = 'index';
//引入入口文件
require './ThinkPHP/ThinkPHP.php';
