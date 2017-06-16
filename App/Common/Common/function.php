<?php
/**
 * 发送邮件
 * @param $to 接收邮件的地址
 * @param $title 邮件主题
 * @param $content 邮件内容
 * @return bool
 */
function send_mail($to, $title, $content)
{
    //引入PHPMailer的核心文件 使用require_once包含避免出现PHPMailer类重复定义的警告
    vendor('PHPMailer.PHPMailerAutoload');
    //实例化PHPMailer核心类
    $mail = new PHPMailer();

    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = false;

    //使用smtp鉴权方式发送邮件
    $mail->isSMTP();

    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;

    //链接qq域名邮箱的服务器地址
    $mail->Host = 'smtp.163.com';

    //设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = 'ssl';

    //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
    $mail->Port = 465;

    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';

    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = '账户激活邮件';

    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = 'm15262723161_2@163.com';

    //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
    $mail->Password = 'zhuxun163';

    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = 'm15262723161_2@163.com';

    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);

    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    $mail->addAddress($to, '测试');

    //添加多个收件人 则多次调用方法即可
    // $mail->addAddress('xxx@163.com','lsgo在线通知');

    //添加该邮件的主题
    $mail->Subject = $title;

    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $content;

    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    // $mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

    $status = $mail->send();

    //简单的判断与提示信息
    if ($status) {
        return true;
    } else {
        return false;
    }
}

/**
 * 发送模板短信
 * @param to 手机号码集合,用英文逗号分开
 * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
 */
function sendTemplateSMS($to, $datas, $tempId)
{
    vendor("sendMsg.CCPRestSmsSDK");
    $msg_conf = C('SEND_MSG');
    // 初始化REST SDK
    $accountSid = $msg_conf['accountSid'];
    $accountToken = $msg_conf['accountToken'];
    $serverIP = $msg_conf['serverIP'];
    $appId = $msg_conf['appId'];
    $serverPort = $msg_conf['serverPort'];
    $softVersion = $msg_conf['softVersion'];

    $rest = new REST($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
//    echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to, $datas, $tempId);
//    if ($result == NULL) {
////        echo "result error!";
//            break;
//    }
    if ($result->statusCode != 0) {
//        echo "error code :" . $result->statusCode . "<br>";
//        echo "error msg :" . $result->statusMsg . "<br>";
        return $data = ['code' => $result->statusCode, 'msg' => $result->statusMsg];
        //TODO 添加错误处理逻辑
    } else {
//        echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
        $smsmessage = $result->TemplateSMS;
//        echo "dateCreated:" . $smsmessage->dateCreated . "<br/>";
//        echo "smsMessageSid:" . $smsmessage->smsMessageSid . "<br/>";
        return $data = ['code' => 0, 'msg' => '发送成功'];
        //TODO 添加成功处理逻辑
    }
}


/**
 * 接口请求方法
 * @param $url 请求的地址
 * @param $https 使用启用https协议
 * @param $method 请求方式
 * @param $data 请求参数
 * @return
 */
function request($url, $https = true, $method = 'get', $data = null)
{
    //1.初始化，开打网页
    $ch = curl_init($url);
    //2.设置参数
    //设置请求的数据直接保存成字符串
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //支持https协议
    if ($https) {
        //绕过证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    //支持post请求
    if ($method = 'post') {
        curl_setopt($ch, CURLOPT_POST, true);
        //param=val&param2=val2
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    //3.发送请求
    $content = curl_exec($ch);
    //4.关闭资源链接
    curl_close($ch);
    //返回请求获取的数据
    return $content;
}


/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0, $level = 0)
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = &$list[$key];
                $tree[$key]['level'] = $level;
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    $list[$key]['level'] = $level + 1;
                    $parent[$child][] = &$list[$key];
//                    $parent[$child][]['level'] = $level+1;
                }
            }
        }
    }
    return $tree;
}


/**
 * 分类树
 */
//    protected $listTree=[];
function _getTree($catArr, $pid = 0, $level = 0)
{
    static $listTree = [];
    foreach ($catArr as $v) {
        if ($pid == $v['parent_id']) {
            $v['level'] = $level;
            $listTree[] = $v;
            _getTree($catArr, $v['id'], $level + 1);
        }
    }
    return $listTree;
}

/**
 * 数据字典函数
 * 获取表单是否显示状态
 * @param key string 数组键
 * @return 获取值
 */
function getStatus($key = 0)
{
    $array = [
        '0' => '否',
        '1' => '是'
    ];
    return $array[$key];
}

/**
 * 打印数组
 * @param $arr
 */
function p($arr)
{
    echo '<pre>';
    print_r($arr);
}

/**
 * （test）上传多张图片,并生成缩略图
 */
function uploadPics()
{
    $config = [
        'maxSize' => 3145728,
        'rootPath' => C('UPLOAD_ROOT_PATH'),
        'savePath' => 'Album/'
    ];
    $upload = new \Think\Upload($config);
    $info = $upload->upload();

//    p($info);die;

    $images = new \Think\Image();
    foreach ($info as $k => $v) {

        $images->open(C('UPLOAD_ROOT_PATH') . $v['savepath'] . $v['savename']);
        $images->thumb(100, 100)->save(C('UPLOAD_ROOT_PATH') . $v['savepath'] . 'thumb_' . $v['savename']);
        $info[$k]['thumb_savepath'] = $v['savepath'];
        $info[$k]['thumb_savename'] = 'thumb_' . $v['savename'];
    }

    if (!$info) {
        echo $upload->getError();
        die;
    }
    return $info;
}

/**
 * （test）上传单张图片,并生成缩略图
 */
function uploadPic()
{
    $config = [
        'maxSize' => 3145728,
        'rootPath' => C('UPLOAD_ROOT_PATH'),
        'savePath' => 'Admin/'
    ];
    $upload = new \Think\Upload($config);
    $info = $upload->upload();

//    p($info);die;

    $images = new \Think\Image();
    $images->open(C('UPLOAD_ROOT_PATH') . $info['goods_img']['savepath'] . $info['goods_img']['savename']);
    $images->thumb(150, 150)->save(C('UPLOAD_ROOT_PATH') . $info['goods_img']['savepath'] . 'thumb_' . $info['goods_img']['savename']);
    $info['goods_img']['thumb_savepath'] = $info['goods_img']['savepath'];
    $info['goods_img']['thumb_savename'] = 'thumb_' . $info['goods_img']['savename'];

    if (!$info) {
        echo $upload->getError();
        die;
    }
    return $info;
}


/**
 * 单文件上传函数
 * @return 存储上传文件的路径
 * @param string $filename 上传文件域的名称
 * @param string $dir 指定上传文件的位置（子目录）
 * @param array $array是否生成缩略图 ，生成几张缩略图，缩略图大小
 */
function oneuploadimg($filename, $dir, $array = array())
{
    //取出配置的上传文件的根路径
    $rootpath = C('UPLOAD_ROOT_PATH');
    //取出配置的上传文件的大小
    $max_file = (int)C('UPLOAD_MAX_FILESIZE');
    //取出php.ini配置文件里面的上传限制。
    $upload_max_filesize = (int)ini_get('upload_max_filesize');
    //最终允许的上传文件大小
    $allow_filesize = min($max_file, $upload_max_filesize) * 1024 * 1024;
    //取出上传文件允许的后缀
    $ext = C('UPLOAD_ALLOW_EXT');
    //执行上传的代码
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = $allow_filesize;// 设置附件上传大小
    $upload->exts = $ext;// 设置附件上传类型
    $upload->rootPath = $rootpath;
    $upload->savePath = $dir . '/'; // 设置附件上传目录    // 上传文件
    $info = $upload->upload();
    if ($info) {
        //上传成功
        $goods_ori = $info[$filename]['savepath'] . $info[$filename]['savename'];
        //定义一个数组，用于返回上传图片的路径
        $img[] = $goods_ori;
        if ($array) {
            //说明要生成缩略图
            $image = new \Think\Image();
            $image->open($rootpath . $goods_ori);
            foreach ($array as $k => $v) {
                $goods_img = $info[$filename]['savepath'] . $k . $info[$filename]['savename'];
                $image->thumb($v[0], $v[1])->save($rootpath . $goods_img);
                $img[] = $goods_img;
            }
        }
        return array(
            'info' => 1,
            'img' => $img
        );
    } else {
        //上传失败
        return array(
            'info' => 0,
            'error' => $upload->getError()
        );
    }
}

//purify防范XSS攻击
function removeXss($val)
{
    //方法一
//    static $obj = null;
//    if ($obj === null) {
//        require '/ThinkPHP/Library/Vender/HTMLPurifier/HTMLPurifier.includes.php';
//        $obj = new HTMLPurifier();
//    }
//    return $obj->purify($val);

    //方法二
    vendor('HTMLPurifier.HTMLPurifier.HTMLPurifier#auto');
    //获取默认配置
    $config = HTMLPurifier_Config::createDefault();
    //根据配置项来完成
    $purifier = new HTMLPurifier($config);
    //过滤字符串
    $clean_html = $purifier->purify($val);

    return $clean_html;

}

//多文件上传
function moreuploadimg($filename, $dir, $array = array())
{
    //取出配置中上传文件根路径
    $rootpath = C('UPLOAD_ROOT_PATH');
    //取出配置中的上传文件大小
    $max_file = (int)C('UPLOAD_MAX_FILESIZE');
    //取出php.ini文件中上传文件的大小
    $upload_max_filesize = (int)ini_get('upload_max_filesize');
    //最终的允许上传的文件大小
    $allow_filesize = min($max_file, $upload_max_filesize) * 1024 * 1024;
    //取出允许上传文件的后缀
    $ext = C('UPLOAD_ALLOW_EXT');
    //执行上传代码
    $update = new \Think\Upload;
    $update->rootPath = $rootpath;
    $update->savePath = 'Album/';
    $update->maxSize = $allow_filesize;
    $update->exts = $ext;
    $info = $update->upload(array("$filename" => $_FILES[$filename]));
    if ($info) {
        //表示上传成功
        $arr = array();
        foreach ($info as $v) {
            //取出原图地址
            $album_ori = $v['savepath'] . $v['savename'];
            $img = array();
            $img[] = $album_ori;
            //判断是否生成缩略图
            if ($array) {
                //生成缩略图
                $image = new \Think\Image();
                $image->open($rootpath . $album_ori);
                foreach ($array as $k1 => $v1) {
                    //生成缩略图地址名称
                    $album_thumb = $v['savepath'] . 'thumb' . $k1 . $v['savename'];
                    $image->thumb($v1[0], $v1[1])->save($rootpath . $album_thumb);
                    $img[] = $album_thumb;
                }
            }
            $arr[] = $img;
        }
        return [
            'info' => 1,
            'img' => $arr,
        ];

    } else {
        return [
            'info' => 0,
            'error' => $update->getError(),
        ];
    }
}


/**
 * 判断是否有多文件上传
 * @param $filename 文件域的名称
 */
function hasimages($filename)
{
    $error = $_FILES[$filename]['error'];
    foreach ($error as $v) {
        //只要是有一个文件的error是0，表示已经上传
        if ($v == 0) {
            return true;
        }
    }
}

