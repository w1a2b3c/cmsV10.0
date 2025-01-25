<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
<title>填写快递_{sdcms[web_name]}</title>
<meta name="keywords" content="{sdcms[seo_key]}">
<meta name="description" content="{sdcms[seo_desc]}">
</head>

<body>

	<div class="ui-p-20 ui-pt">
        <form class="ui-form" method="post">
            <div class="ui-menu ui-menu-blue ui-mb-15">
                <div class="ui-menu-name">请将商品退回至（请勿货到付款）：</div>
            </div>
            <div class="ui-p">
            {str_replace("\r\n","<br>",sdcms[shop_return_address])}
            </div>
            <div class="ui-menu ui-menu-blue ui-mb-15">
                <div class="ui-menu-name">需要退回的商品如下</div>
            </div>
            <!---->
            <table class="ui-table ui-table-border ui-table-hover ui-mb">
                <thead class="ui-thead-gray">
                <tr>
                    <th class="ui-text-left">商品</th>
                    <th width="100">退货数量</th>
                </tr>
                </thead>
                {foreach $goodslist as $key=>$rs}
                <tr>
                    <td class="ui-text-left">
                        <img src="{$rs['goods_pic']}" class="image">
                        <a href="{U('goodsshow','id='.$rs['goods_id'].'')}" target="_blank">{$rs['goods_name']}</a><br>{$rs['goods_skuname']}<br>
                        {if $rs['goods_isgift']!=0}<span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}
                    </td>
                    <td>{$rs['backnum']}</td>
                </tr>
                {/foreach}
            </table>
            <!---->
            <div class="ui-menu ui-menu-blue ui-mb-15">
                <div class="ui-menu-name">填写快递资料：</div>
            </div>
            <div class="ui-form-group ui-row">
                <div class="ui-col-2 ui-col-form-label">快递公司：</div>
                <div class="ui-col-6">
                    <input type="text" name="t0" maxlength="50" class="ui-form-ip" data-rule="快递公司:required;">
                </div>
            </div>
            <div class="ui-form-group ui-row">
                <div class="ui-col-2 ui-col-form-label">快递单号：</div>
                <div class="ui-col-6">
                    <input type="text" name="t1" maxlength="50" class="ui-form-ip" data-rule="快递单号:required;">
                </div>
            </div>

            <div class="hide"><input type="hidden" name="token" value="{$token}"><button type="submit" class="ui-btn ui-btn-blue" id="sdcms-submit">提交</button></div>
        </form>
    </div>
<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script>
$(function()
{
	var backurl=window.parent.location;
	$(".ui-form").form(
	{
		type:2,
		align:'center',
		result:function(form)
		{
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:'{THIS_LOCAL}',
				data:$(form).serialize(),
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success(d.msg);
						setTimeout(function(){parent.location.href=backurl;},1500);
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		}
	});
})
</script>
</body>
</html>