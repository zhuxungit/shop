<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL' => 2,

//    'SHOW_PAGE_TRACE' => true,

    //数据库设置
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'shshop',
    'DB_USER' => 'root',
    'DB_PWD' => 'root',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'it_',

    //定义上传文件的根路径
    'UPLOAD_ROOT_PATH' => './Public/Uploads/',
    //定义上传文件允许后缀
    'UPLOAD_ALLOW_EXT' => ['png', 'jpg', 'jpeg', 'gif', 'bmp'],
    //定义上传文件允许的大小
    'UPLOAD_MAX_FILESIZE' => '3M'

);