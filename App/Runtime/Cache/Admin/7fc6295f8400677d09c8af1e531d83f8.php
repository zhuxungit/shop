<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta name="robots" c>
    <meta http-equiv="Content-Type" c/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Js/jquery.js"></script>
</head>
<body>

<h1>
    <span class="action-span"><a href="<?php echo U('add')?>">添加新商品</a></span>
    <span class="action-span1"><a href="<?php echo U('admin/index/index')?>">ECSHOP 管理中心</a> </span><span id="search_id"
                                                                                                          class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>

<div class="form-div">

    <form action="" name="searchForm" method="post">
        <img src="/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH"/>

        <select name="cat_id">
            <option value="0">所有栏目</option>
            <?php if(is_array($catData)): foreach($catData as $key=>$val): if($val["id"] == $cat_id): ?><option selected value="<?php echo ($val["id"]); ?>"><?php echo str_repeat('--',$val['level']); echo ($val["cat_name"]); ?></option>
                    <?php else: ?>
                    <option value="<?php echo ($val["id"]); ?>"><?php echo str_repeat('--',$val['level']); echo ($val["cat_name"]); ?></option><?php endif; endforeach; endif; ?>
        </select>

        <select name="brand_id">
            <option value="0">所有品牌</option>
            <option value="1">诺基亚</option>
            <option value="10">金立</option>
            <option value="9">联想</option>
            <option value="8">LG</option>
            <option value="7">索爱</option>
            <option value="6">三星</option>
            <option value="5">夏新</option>
            <option value="4">飞利浦</option>
            <option value="3">多普达</option>
            <option value="2">摩托罗拉</option>
            <option value="11"> 恒基伟业</option>
        </select>


        <select name="intro_type">
            <option value="0">全部</option>
            <option value="is_best">精品</option>
            <option value="is_new">新品</option>
            <option value="is_hot">热销</option>
            <option value="is_promote">特价</option>
            <option value="all_type">全部推荐</option>
        </select>


        <select name="suppliers_id">
            <option value="0">全部</option>
            <option value="1">北京供货商</option>
            <option value="2">上海供货商</option>
        </select>


        <select name="is_on_sale">
            <option value=''>全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>

        关键字 <input type="text" name="keyword" size="15"/>
        <input type="submit" value=" 搜索 " class="button"/>
    </form>
</div>
<form method="post" action="" name="listForm">

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>
                    <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox"/>
                    <a href="#">编号</a><img src="/Public/Admin/images/sort_desc.gif"/></th>

                <th><a href="#">商品名称</a></th>
                <th><a href="#">货号</a></th>
                <th><a href="#">商品缩略图</a></th>
                <th><a href="#">价格</a></th>
                <th><a href="#">上架</a></th>
                <th><a href="#">精品</a></th>
                <th><a href="#">新品</a></th>
                <th><a href="#">热销</a></th>
                <th><a href="#">推荐排序</a></th>
                <th><a href="#">库存</a></th>
                <th>操作</th>
            <tr>


                <?php if(is_array($goodsdata)): foreach($goodsdata as $key=>$val): ?><tr>
                <td><input type="checkbox" name="checkboxes[]" value="32"/><?php echo ($val["id"]); ?></td>

                <td class="first-cell" style=""><span><?php echo ($val["goods_name"]); ?></span></td>
                <td><span><?php echo ($val["goods_sn"]); ?></span></td>
                <td><span><img src="/Public/Uploads/<?php echo ($val["goods_thumb"]); ?>"/></span></td>
                <td align="right"><span><?php echo ($val["shop_price"]); ?></span></td>


                <td align="center" class="is_sale" data-id="<?php echo ($val["id"]); ?>">
                    <?php if($val['is_sale'] == 1): ?><img style="cursor: pointer" src="/Public/Admin/images/yes.gif"/>
                        <?php else: ?>
                        <img style="cursor: pointer" src="/Public/Admin/images/no.gif"/><?php endif; ?>
                </td>

                <td align="center" class="is_best" data-id="<?php echo ($val["id"]); ?>">
                    <?php if($val['is_best'] == 1): ?><img style="cursor: pointer" src="/Public/Admin/images/yes.gif"/>
                        <?php else: ?>
                        <img style="cursor: pointer" src="/Public/Admin/images/no.gif"/><?php endif; ?>
                </td>

                <td align="center" class="is_new" data-id="<?php echo ($val["id"]); ?>">
                    <?php if($val['is_new'] == 1): ?><img style="cursor: pointer" src="/Public/Admin/images/yes.gif"/>
                        <?php else: ?>
                        <img style="cursor: pointer" src="/Public/Admin/images/no.gif"/><?php endif; ?>
                </td>

                <td align="center" class="is_hot" data-id="<?php echo ($val["id"]); ?>">
                    <?php if($val['is_hot'] == 1): ?><img style="cursor: pointer" src="/Public/Admin/images/yes.gif"/>
                        <?php else: ?>
                        <img style="cursor: pointer" src="/Public/Admin/images/no.gif"/><?php endif; ?>
                </td>


                <td align="center"><span>100</span></td>
                <td align="right"><span><?php echo ($val["goods_number"]); ?></span></td>
                <td align="center">
                    <!--<a href="#" title="相册管理"><img src="/Public/Admin/images/picflag.gif" width="16" height="16" border="0"/></a>-->
                    <a href="<?php echo U('home/index/detail',['id'=>$val['id']]);?>" target="_blank" title="查看"><img src="/Public/Admin/images/icon_view.gif" width="16" height="16"
                                                                                                       border="0"/></a>
                    <a href="<?php echo U('update','id='.$val['id']);?>" title="编辑"><img src="/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0"/></a>
                    <a href="#" title="复制"><img src="/Public/Admin/images/icon_copy.gif" width="16" height="16" border="0"/></a>
                    <a href="javascript:void(0)" title="回收站" onclick="del(<?php echo ($val['id']); ?>)"><img src="/Public/Admin/images/icon_trash.gif" width="16" height="16"
                                                                                              border="0"/></a>
                    <a href="<?php echo U('product',['goods_id'=>$val[id]]);?>" title="货品列表"><img src="/Public/Admin/images/icon_docs.gif" width="16" height="16" border="0"/></a>
                </td>
            </tr><?php endforeach; endif; ?>

        </table>

        <table id="page-table" cellspacing="0">
            <tr>
                <td align="right" nowrap="true">
                    <?php echo ($pages); ?>
                </td>
            </tr>

        </table>

    </div>
</form>

<div id="footer">
    共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br/>
    版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。
</div>

<script>
    function del(id) {
        if (confirm('确定删除吗？')) {
            location.href = "/Admin/Goods/delete/id/" + id;
        } else {
            location.href = "/Admin/Goods/lst";
        }
    }

    /**
     * 检索
     */
    $(function () {
        //选择select标签，添加change事件
        $('select[name=cat_id]').change(function () {
            //完成表单提交
            $('form[name=searchForm]').submit();
        })
    })

    /**
     * 上架下架点击切换
     */
    $(function () {
        $('.is_sale').click(clickchange)
    })

    /**
     * 精品点击切换
     */
    $(function () {
        $('.is_best').click(clickchange)
    })

    /**
     * 新品点击切换
     */
    $(function () {
        $('.is_new').click(clickchange)
    })

    /**
     * 热销点击切换
     */
    $(function () {
        $('.is_hot').click(clickchange)
    })


    /**
     * 封装的点击切换函数
     */
    function clickchange() {
        //获取商品id
        _this  = $(this);
        id = _this.attr('data-id');
        type = _this.attr('class');
        //使用post方式
        $.post("change",{'id':id,'type':type},function (datas) {
            if(datas.status==1){
                _this.find('img').remove();
                _this.append(datas.info);
            }
        },'json')
    }

</script>

</body>
</html>