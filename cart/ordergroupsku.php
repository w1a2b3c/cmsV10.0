<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
<title>规格选择</title>
<script>
if(self==top)
{ 
 location.href='{N("ordergroup","","id=".$tid."&type=1")}';
}
</script>
</head>

<body>

<div class="ui-pl-15 ui-pr-15">
	<div class="goods_info">
    	<div class="left" id="zoom_pic"><img src="{$pic}" width="100"></div>
        <div class="right">
        	<div class="title">{$title}</div>
            {if $types!=2}
            	{if $is_activity>0 || $ispresale==1}
                	{if $ispresale==0}
                        {if $vprice*$user_rate[1]<$aprice}
                            <div class="price"><span class="goods_vprice">￥{getprice($vprice*$user_rate[1])}</span><del class="goods_dprice">￥{getprice($aprice)}</del></div>
                        {else}
                            <div class="price"><span class="goods_vprice">￥{getprice($aprice)}</span><del class="goods_dprice">￥{getprice($vprice)}</del></div>
                        {/if}
                	{else}
                    	<div class="price"><span class="goods_dprice">￥{getprice($vprice)}</span></div>
                        {if $presalemode==2}
                            <div class="price"><em>定金：</em><span class="goods_vprice">￥{if $presaletype==1}{getprice($vprice*$presalepecent/100)}{else}{getprice($presalemoney)}{/if}</span></div>
                        {/if}
                    {/if}
                {else}
                    {if $user_rate[0]<1}
                        <div class="price"><span class="goods_vprice">￥{getprice($vprice*$user_rate[0])}</span><del class="goods_dprice">￥{getprice($vprice)}</del></div>
                    {else}
                        <div class="price"><span class="goods_vprice">￥{getprice($vprice)}</span><del class="goods_dprice">￥{getprice($dprice)}</del></div>
                    {/if}
                {/if}
            {/if}
            {if $types>1}
            	<div class="price"><span>{$point}</span>积分</div>
            {/if}
        </div>
    </div>
    <div class="goods_show goods_show_sku">
        {if is_array($sku)}
        <ul class="skushow">
            <p>请选择规格</p>
            {foreach $sku as $key=>$val}
            <li class="item_specpara"><em>{$key}：</em>
                <dl>
                    {foreach $val as $ak=>$bv}
                    {php $psmall='';}
                    {if isset($thumb[$bv]) && strlen($thumb[$bv])>0}
                    {php $psmall=$thumb[$bv];}
                    {/if}
                    <dt data-aid="{$bv}" data-url="{$psmall}" title="{$bv}">{if !isempty($psmall)}<img src="{$psmall}" width="36" height="36"> {/if}{$bv}<i class="ui-icon-check"></i></dt>
                    {/foreach}
                </dl>
            </li>
            {/foreach}
        </ul>
       
         {/if}
         {if $stock>0}
             <input type="hidden" name="sku_id" id="sku_id" value="{if !is_array($sku)}0{/if}">
             <ul class="action addcart">
                <li>
                    <em>购买：</em>
                    <div class="goodsnum"><input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="{if $maxnum>0&&$maxnum<=$stock}{$maxnum}{else}{$stock}{/if}"><u class="goods_stock">库存：{$stock}</u></div>
                </li>
                <li><em>&nbsp;</em>
                    <button class="ui-btn ui-btn-blue" data-id="{$tid}" data-url="{N('order','','type=2&tid='.$tid.'')}">我要参团</button></li>
            </ul>
        {else}
            <ul class="action addcart">
                <li><em>&nbsp;</em><button class="add-favorite ui-btn" disabled data-type="">已售罄</button>
            </li>
        </ul>
        {/if}
    </div>
    
</div>         

<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script>
{if is_array($sku)}
var skulist=[];
{foreach $sku_list as $key=>$val}
skulist['{$key}']='{$val}';
{/foreach}

function getprice()
{
	var a=false;
	$(".item_specpara dl").each(function(){if(!$("dt",this).hasClass('selected')){a=true;}});
	if(a)
	{
		$("#sku_id").val('');
		return;
	}
	$(".skushow").removeClass("sku_selected");
	var skuname=get_prospec();
	
	if(!(typeof(skulist[skuname])=='undefined'))
	{
		var data=$.parseJSON(skulist[skuname]);
		var html='';
		{if $is_activity>0}
			if(parseFloat(data.vprice*{$user_rate[1]})<data.aprice)
			{
				var aprice=Number(parseFloat(data.vprice*{$user_rate[1]})).toFixed(2);
				$(".goods_dprice").html('￥'+parseFloat(data.aprice));
				$(".goods_vprice").html('￥'+parseFloat(aprice));
			}
			else
			{
				$(".goods_dprice").html('￥'+parseFloat(data.vprice));
				$(".goods_vprice").html('￥'+parseFloat(data.aprice));
			}
		{else}
			{if $ispresale==0}
				{if $user_rate[0]<1}
					$(".goods_vprice").html('￥'+parseFloat(Number(parseFloat(data.vprice*{$user_rate[0]})).toFixed(2)));
				{/if}
			{else}
				{if $presalemode==2}
					{if $presaletype==1}
						$(".goods_vprice").html('￥'+parseFloat(Number(parseFloat(data.vprice*{$presalepecent/100})).toFixed(2)));
					{/if}
				{/if}
			{/if}
			{if $user_rate[0]<1}
				$(".goods_dprice").html('￥'+parseFloat(data.vprice));
			{else}
				$(".goods_dprice").html('￥'+parseFloat(data.dprice));
			{/if}
		{/if}
		$("#sku_id").val(data.aid);
		
		$(".goodsnum").html('<input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="'+data.stock+'"> 　<span class="goods_stock">库存：'+data.stock+'</span>');
		//重新渲染数字输入框效果
		$(".ui-inputnumber").inputnumber();

		if(data.stock<=0)
		{
			$(".addcart button").prop("disabled","disabled");
			$.tips({text:'已售罄',id:$(".addcart button"),align:'right-top'})
		}
		else
		{
			$(".addcart button").prop("disabled","");
		}
	}
	else
	{
		sdcms.error('规格参数错误');
	}
}

function get_prospec()
{
	var _val='';
	$(".item_specpara").each(function()
	{
		var i=$(this);
		var v=i.attr("data-attrval");
		if(v)
		{
			_val+=_val!=""?"|":"";
			_val+=v;
		}
	})
	return _val;
}
{/if}
$(function()
{
	$(".item_specpara").each(function()
	 {
		var i=$(this);
		var p=i.find("dl>dt");
		p.click(function()
		{
			if(!!$(this).hasClass("selected"))
			{
				$(this).removeClass("selected");
				i.removeAttr("data-attrval");
			}
			else
			{
				$(this).addClass("selected").siblings("dt").removeClass("selected");
				i.attr("data-attrval",$(this).attr("data-aid"))
			}
			getprice();
		})
	});
	$(".item_specpara dt").click(function()
	{
		var src=$(this).attr("data-url");
		if(src!='')
		{
			$("#zoom_pic img").attr("src",src);
		}
	});
	//参加拼团
	$(".addcart button").click(function()
	{
		var tid=$(this).attr("data-id");
		var url=$(this).attr("data-url");
		var goods_id="{$id}";
		var sku_id=$("#sku_id").val();
		if(sku_id=='')
		{
			$(".skushow").addClass("sku_selected");
			return;
		}
		var goods_num=$(".goodsnum").find('input[name=goodsnum]').val();
		$.ajax(
		{
			type:'post',
			dataType:'json',
			url:"{U('cart/buy','type=1')}",
			data:'token={$token}&goods_id='+goods_id+'&sku_id='+sku_id+'&goods_num='+goods_num,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					parent.location.href=url;
				}
				else
				{
					if(d.msg.substring(0,1)=="1")
					{
						$.dialog(
						{
							title:"操作提示",
							text:d.msg.substring(1),
							okval:'登录',
							cancelval:'注册',
							ok:function()
							{
								parent.location.href='{N("login")}';
							},
							cancel:function()
							{
								parent.location.href='{N("reg")}';
							}
						});
					}
					else
					{
						sdcms.error(d.msg.substring(1));
					}
				}
			}
		});
	});
})
</script>
</body>
</html>