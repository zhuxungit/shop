<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 权限列表 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='/Public/Js/jquery.js'></script>
</head>
<body>

<h1>
    <span class="action-span"><a href="<?php echo U('add');?>">添加权限</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 权限列表 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">

        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <th>权限名称</th>
                <th>是否显示</th>
                <th>操作</th>
            </tr>
            <?php foreach($privdata as $v){?>
            <tr align="center" class="0" id="0_1" id='tr_1'>
                <td align="left" class="first-cell" style='padding-left:0'>
                    <?php echo str_repeat("&nbsp;",$v['level']*8) ?>
                    <img <?php if($v[level] == 0): ?>src="/Public/Admin/images/menu_plus.gif" class="headpriv" <?php else: ?> src="/Public/Admin/images/menu_minus.gif"<?php endif; ?>  id="icon_0_1" width="9" height="9" border="0" style="margin-left:0em"/>
                    <span><a href="#"><?php echo $v['priv_name'] ?></a></span>
                </td>
                <td width="10%"><img  <?php if($v[is_show] == 1): ?>src="/Public/Admin/images/yes.gif"<?php else: ?>src="/Public/Admin/images/no.gif"<?php endif; ?> /></td>
                <td width="24%" align="center">
                    <a href="<?php echo U('update', ['id'=>$v['id']])?>">编辑</a> |
                    <a href="<?php echo U('delete', ['id'=>$v['id']])?>" title="移除">移除</a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</form>

<div id="footer">
    共执行 1 个查询，用时 0.015927 秒，Gzip 已禁用，内存占用 1.999 MB<br/>

    版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利
    。
</div>

</body>
<script>
    $('.headpriv + span').live('click',function () {
//        alert(1);
        $(this).parents('tr').slideToggle();
    })
</script>
</html>