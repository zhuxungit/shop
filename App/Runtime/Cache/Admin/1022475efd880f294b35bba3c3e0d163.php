<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
下单时间
<input id="order_create_time" type="date" name="order_create_time" value="2017-6-13">
用户名
<input id="user_name" type="text" name="user_name" value="">
<table>
    <tr>
        <td>订单id</td>
        <td>下单人</td>
        <td>商品名称</td>
        <td>订购数量</td>
        <td>订购时间</td>
    </tr>
    <?php if(is_array($orderdata)): foreach($orderdata as $key=>$val): if(is_array($val)): foreach($val as $key=>$val2): ?><tr>
                <td><?php echo ($val2["id"]); ?></td>
                <td><?php echo ($val2["user_name"]); ?>x</td>
                <td><?php echo ($val2["goods_name"]); ?></td>
                <td><?php echo ($val2["order_number"]); ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$val2["order_create_time"])); ?></td>
            </tr><?php endforeach; endif; endforeach; endif; ?>
</table>
<script src="/Public/Js/jquery.js"></script>
<script>
    /**
     * 根据时间提交
     */
    $("#order_create_time").blur(function () {
        order_create_time = $("#order_create_time").val();
//        console.log(order_create_time);
        $.post('<?php echo U("test/getOrderByName");?>', 'order_create_time=' + order_create_time, function (msg) {

        }, 'json')
    })
    $("#user_name").blur(function () {
        username = $("#user_name").val();
        $.post('<?php echo U("test/getOrderByName");?>', 'user_name=' + username, function (msg) {

        }, 'json')
    })
</script>
</body>
</html>