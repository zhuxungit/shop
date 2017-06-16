<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 货品列表 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='/Public/Js/jquery.js'></script>

</head>
<body>

<h1>
    <span class="action-span"><a href="<?php echo U('add')?>">返回商品列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 货品列表 </span>
    <div style="clear:both"></div>
</h1>
<form method="post" action="/Admin/Goods/product" name="listForm">
    <div class="list-div" id="listDiv">

        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr align="left">
                <?php if(is_array($productinfo)): foreach($productinfo as $key=>$val): ?><th><?php echo ($val[0][attr_name]); ?></th><?php endforeach; endif; ?>
                <th>库存</th>
                <th>操作</th>
            </tr>


            <?php if(is_array($productdatas)): foreach($productdatas as $pk=>$pv): ?><tr>
                    <?php if(is_array($productinfo)): foreach($productinfo as $pk2=>$pv2): ?><td>
                            <select name="goods_attr[<?php echo ($pk2); ?>][]">
                                <option>请选择</option>
                                <?php if(is_array($pv2)): foreach($pv2 as $key=>$pv22): if(strpos($pv['goods_attr_id'],$pv22['id']) === false): ?><option value="<?php echo ($pv22["id"]); ?>"><?php echo ($pv22["attr_value"]); ?></option>
                                        <?php else: ?>
                                        <option selected="selected" value="<?php echo ($pv22["id"]); ?>"><?php echo ($pv22["attr_value"]); ?></option><?php endif; endforeach; endif; ?>
                            </select>
                        </td><?php endforeach; endif; ?>
                    <td><input type="text" name="goods_number[]" value="<?php echo ($pv['goods_number']); ?>"/></td>
                    <td><input type="button" value="+"/></td>
                </tr><?php endforeach; endif; ?>

            <tr>
                <?php if(is_array($productinfo)): foreach($productinfo as $pk2=>$pv2): ?><td>
                        <select name="goods_attr[<?php echo ($pk2); ?>][]">
                            <option>请选择</option>
                            <?php if(is_array($pv2)): foreach($pv2 as $key=>$pv22): if(strpos($pv['goods_attr_id'],$pv22['id']) === false): ?><option value="<?php echo ($pv22["id"]); ?>"><?php echo ($pv22["attr_value"]); ?></option>
                                    <?php else: ?>
                                    <option selected="selected" value="<?php echo ($pv22["id"]); ?>"><?php echo ($pv22["attr_value"]); ?></option><?php endif; endforeach; endif; ?>
                        </select>
                    </td><?php endforeach; endif; ?>
                <td><input type="text" name="goods_number[]" value="<?php echo ($pv['goods_number']); ?>"/></td>
                <td><input type="button" value="+"/></td>
            </tr>


            <input type="hidden" name="goods_id" value="<?php echo ($_GET['goods_id']); ?>"/>
            <input type="hidden" name="attr_id" value="{}">
            <tr>
                <td colspan="<?php echo count($productinfo)+2;?>" align="right"><input type="submit" value="保存"/></td>
            </tr>

        </table>
    </div>
</form>

<div id="footer">
    共执行 1 个查询，用时 0.015927 秒，Gzip 已禁用，内存占用 1.999 MB<br/>

    版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利
    。
</div>

<script>
    $(':input[type=button]').live('click', function () {
        obj = $(this).parents('tr');
        if ($(this).val() == '+') {
            var newobj = obj.clone();
            newobj.find(":input[type=button]").val('-');
            obj.before(newobj);
        } else {
            obj.remove();
        }

    })
</script>

</body>
</html>