<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
<title>申请退款</title>
</head>

<body>
<div class="ui-p-20 ui-pt">
    {if $ispay==1 && $isdelivery==0 && $isclose==0}
    {php $data=explode("\r\n",C('shop_refund_why'))}
    <form class="ui-form" method="post">
        <div class="ui-menu ui-menu-blue ui-mb-15">
            <div class="ui-menu-name">退款原因</div>
        </div>
        <div class="ui-form-group">
            <input type="hidden" name="t0" value="1">
            {php $step=1}
            {foreach $data as $key=>$val}
            <label class="ui-radio"><input type="radio" value="{$val}" name="t1" data-rule="退款原因:required;checked"><i></i>{$val}</label><br>
            {php $step++;}
            {/foreach}
            <input type="hidden" name="t2" value="{$order_total}">
        </div>
        <div class="ui-hide"><input type="hidden" name="token" value="{$token}"><button type="submit" class="ui-btn ui-btn-blue" id="sdcms-submit">提交</button></div>
        <div class="ui-line"></div>
        <div class="ui-text-red ui-mt">1、申请退款后不可取消，退款申请通过后，支付金额将原路返回。<br>2、订单中使用优惠券等，退款后将无法返回。</div>
    </form>
    {else}
    {php $data=explode("\r\n",C('shop_return_why'))}
    <form class="ui-form" method="post">
        <div class="ui-form-group ui-row">
            <label class="ui-col-3 ui-col-form-label">退款方式：</label>
            <div class="ui-col-9 ui-mt">
                <label class="ui-radio"><input type="radio" name="t0" id="t0_1" value="1" checked><i></i>仅退款</label>
                <label class="ui-radio"><input type="radio" name="t0" id="t0_2" value="2"><i></i>退款退货</label>
            </div>
        </div>
        <div class="ui-form-group ui-row">
            <label class="ui-col-3 ui-col-form-label">退款原因：</label>
            <div class="ui-col-9">
                <select name="t1" class="ui-form-ip" data-rule="退款原因:required;">
                    <option value="">请选择退款原因</option>
                    {php $step=1}
                    {foreach $data as $key=>$val}
                    <option value="{$val}">{$val}</option>
                    {php $step++;}
                    {/foreach}
                </select>
            </div>
        </div> 
        <div class="ui-form-group ui-row">
            <label class="ui-col-3 ui-col-form-label">退款金额：</label>
            <div class="ui-col-9">
            	<div class="ui-input-group">
                <input type="text" name="t2" class="ui-form-ip radius-right-none" maxlength="8" data-rule="退款金额:required;dot;">
                <div class="after"><span class="ui-pl ui-pr">元</span></div>
                </div>
                <div class="ui-mt">最多可退款 <span class="ui-text-red">{$order_total}</span> 元</div>
            </div>
        </div>
        <div class="form-group ui-hide ui-mt-20 goodslist">
            <div class="ui-text-red">请勾选要退货的商品，并检查商品的退货数量。</div>
            <!---->
            <table class="ui-table ui-table-border ui-table-hover ui-mt-20">
                <thead class="ui-thead-gray">
                <tr>
                    <th width="40"><label class="ui-checkbox"><input type="checkbox" class="checkall" value="" checked><i></i></label></th>
                    <th>商品</th>
                    <th width="150">退货数量</th>
                </tr>
                </thead>
                {foreach $goodslist as $key=>$rs}
                <tr>
                    <td><label class="ui-checkbox"><input type="checkbox" name="goodsid[]" value="{$rs['aid']}" class="gift-{$rs['goods_isgift']}" data-id="{$rs['goods_isgift']}" data-gift="gift-{$rs['goods_id']}" {if $rs['goods_isgift']!=0 }disabled{/if} checked><i></i></label></td>
                    <td class="ui-text-left">
                        <img src="{$rs['goods_pic']}" class="image">
                        <a href="{U('goodsshow','id='.$rs['goods_id'].'')}" class="proname" target="_blank">{$rs['goods_name']}</a><br>{$rs['goods_skuname']}<br>
                        {if $rs['goods_isgift']!=0}<span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}
                    </td>
                    <td><input type="text" name="goodsnum[{$rs['aid']}]" value="{$rs['goods_num']}" class="ui-inputnumber" data-max="{$rs['goods_num']}" data-gift="{$rs['goods_isgift']}" data-min="1"></td>
                </tr>
                {/foreach}
            </table>
            <!---->
        </div>
        <div class="ui-hide"><input type="hidden" name="token" value="{$token}"><button type="submit" class="ui-btn ui-btn-blue" id="sdcms-submit">提交</button></div>
    </form>
    {/if}
</div>

<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script>
function backradio()
{
	$("input[name='goodsid[]']").each(function(){
		var result=$(this).attr("data-id");
		if(result!=0)
		{
			$(this).attr("disabled",true);
		}
	});
}
$(function()
{
	var backurl=window.parent.location;
	$(".ui-form").form(
	{
		type:2,
		align:'center',
		result:function(form)
		{
			$("input[name='goodsid[]']").attr("disabled",false);
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:'{THIS_LOCAL}',
				data:$(form).serialize(),
				error:function(e){backradio();alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success(d.msg);
						setTimeout(function(){parent.location.href=backurl;},1500);
					}
					else
					{
						backradio();
						sdcms.error(d.msg);
					}
				}
			});
		}
	});
	$("#t0_1").click(function()
	{
		$(".goodslist").addClass("ui-hide");
	});
	$("#t0_2").click(function()
	{
		$(".goodslist").removeClass("ui-hide");
	});
	//全选
	$(".checkall").click(function()
	{
		var result=$(this).prop("checked");
		$("input[type=checkbox]").each(function(){
			$(this).prop("checked",result);
		});
	});
	//单个选择
	$("input[name='goodsid[]']").click(function()
	{
		var result=$(this).prop("checked");
		var gift=$(this).attr("data-gift");
		$("."+gift).prop("checked",result);
	});
	//减少
	$(".min").click(function()
	{
		var that=$(this).parent();
		var num=that.find("input").val();
		if(that.attr("data-gift")!=0)
		{
			layer.tips('赠品不可以修改数量', $(this),{tips:[1,'#333']});
			return;
		}
		if(num<=1)
		{
			return;
		}
		that.find("input").val((parseInt(num)-1));
	});
	//增加
	$(".max").click(function()
	{
		var that=$(this).parent();
		var maxnum=that.attr("data-max");
		var num=that.find("input").val();
		if(that.attr("data-gift")!=0)
		{
			layer.tips('赠品不可以修改数量', $(this),{tips:[1,'#333']});
			return;
		}
		if(parseInt(num)>=parseInt(maxnum))
		{
			layer.tips('已达到最大数', $(this),{tips:[1,'#333']});
			return;
		}
		that.find("input").val((parseInt(num)+1));
	});
})
</script>
</body>
</html>