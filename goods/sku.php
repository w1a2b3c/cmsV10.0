<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
<title>规格选择</title>
</head>

<body>

<div class="ui-pl-15 ui-pr-15">
	<div class="goods_info">
    	<div class="left" id="zoom_pic"><img src="{$pic}" width="100" alt="{$title}"></div>
        <div class="right">
        	<div class="title">{$title}</div>
            {if $types!=2}
            	<div class="price"><span class="goods_vprice">{$vprice}</span><del class="goods_dprice">{$dprice}</del></div>
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
                    <dt data-aid="{$bv}" data-url="{$psmall}" title="{$bv}">{if !isempty($psmall)}<img src="{thumb($psmall,40,40)}" width="36" height="36"> {/if}{$bv}<i class="ui-icon-check"></i></dt>
                    {/foreach}
                </dl>
            </li>
            {/foreach}
         </ul>
         {/if}
         <input type="hidden" name="sku_id" id="sku_id" value="{if !is_array($sku)}0{/if}">
         <ul class="action addcart">
            <li>
                <em>数量：</em>
                <div class="goodsnum"><input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="{if $maxnum>0&&$maxnum<=$stock}{$maxnum}{else}{$stock}{/if}">{if $saletype!=2}<u class="goods_stock">库存：{$stock}</u>{/if}</div>
            </li>
            <li class="hasstock{if $stock==0} ui-hide{/if}"><em>&nbsp;</em>
            {if $is_activity==2}
                <button class="ui-btn ui-btn-yellow" data-id="{$id}" data-type="buy">单独购买<span class="tuan_sprice"></span></button>
                <button class="ui-btn ui-btn-blue" data-id="{$id}" data-type="tuan">我要开团<span class="tuan_aprice"></span></button>
            {else}
                <button class="ui-btn ui-btn-yellow" data-id="{$id}" data-type="buy">{if $types==2}积分兑换{else}{if $ispresale==1}{if $presalemode==1}全款预定{else}支付定金{if $presaletype==1}<span class="goods_vprice">￥{getprice($vprice*$presalepecent/100)}</span>{else}{$presalemoney}{/if}{/if}{else}立即购买{/if}{/if}</button>
                {if $ispresale==0}<button class="ui-btn ui-btn-blue" data-id="{$id}" data-type="cart">加入购物车</button>{/if}
            {/if}
            </li>
            <li class="nostock{if $stock>0} ui-hide{/if}"><em>&nbsp;</em><button class="ui-btn" disabled data-type="">已售罄</button></li>
        </ul>
    </div>
</div>         

<script src="{WEB_ROOT}public/js/jquery.js"></script>
<script src="{WEB_ROOT}public/js/ui.js"></script>
<script src="{WEB_THEME}js/b2c.js"></script>
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
		$(".goods_dprice").html(data.dprice);
		$(".goods_vprice").html(data.vprice);
		
		$("#sku_id").val(data.aid);
		{if $saletype!=2}
			$(".goodsnum").html('<input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="'+data.stock+'"><u class="goods_stock">库存：'+data.stock+'</u>');
		{else}
			$(".goodsnum").html('<input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="'+data.stock+'">');
		{/if}
		//重新渲染数字输入框效果
		$(".ui-inputnumber").inputnumber();
		
		if(data.stock<=0)
		{
			$(".hasstock").addClass("ui-hide");
			$(".nostock").removeClass("ui-hide");
		}
		else
		{
			$(".hasstock").removeClass("ui-hide");
			$(".nostock").addClass("ui-hide");
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

function cartmsg(d)
{
	$.dialog(
	{
		title:"操作提示",
		text:d,
		okval:'去结算',
		cancelval:'再逛逛',
		ok:function()
		{
			parent.location.href='{N("cart")}';
		},
		cancel:function(e)
		{
			e.close();
			parent.$.dialogclose();
		}
	});
}

$(function()
{
	{if $is_activity==2}
	$(".tuan_sprice").html($(".goods_dprice").html());
	$(".tuan_aprice").html($(".goods_vprice").html());
	{/if}
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
	})
	//加入购物车
	$(".addcart button").click(function()
	{
		var goods_id=$(this).attr("data-id");
		var type=$(this).attr("data-type");
		var sku_id=$("#sku_id").val();
		if(type=="cart")
		{
			var url="{U('cart/add')}";
		}
		else if(type=="buy")
		{
			var url="{U('cart/buy')}";
		}
		else if(type=="tuan")
		{
			var url="{U('cart/buy','type=1')}";
		}
		else
		{
			return false;
		}
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
			url:url,
			data:'token={$token}&goods_id='+goods_id+'&sku_id='+sku_id+'&goods_num='+goods_num,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(type=="cart")
				{
					if(d.state=='success')
					{
						cartmsg(d.msg);
						get_cartnum("{U('cart/cartnum')}",'{$token}',1);
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
				else
				{
					var backurl='{N("order","","type=1")}';
					if(type=="tuan")
					{
						backurl='{N("order","","type=2")}';
					}
					if(d.state=='success')
					{
						parent.location.href=backurl;
					}
					else
					{
						if(d.msg.substring(0,1)=="1")
						{
							{if C('shop_other_nologin')==1}
							var msg='直接下单';
							{else}
							var msg='注册';
							backurl='';
							{/if}
							$.dialog(
							{
								title:"操作提示",
								text:d.msg.substring(1),
								okval:'登录',
								cancelval:msg,
								ok:function()
								{
									parent.location.href='{N("login")}';
								},
								cancel:function()
								{
									if(backurl=='')
									{
										parent.location.href='{N("reg")}';
									}
									else
									{
										$.ajax(
										{
											type:'post',
											dataType:'json',
											url:'{U("user/newuser")}',
											data:'token={$token}&randnum={$randreg}',
											error:function(e){alert(e.responseText);},
											success:function(d)
											{
												if(d.state=='success')
												{
													parent.location.href=backurl;
												}
												else
												{
													sdcms.error(d.msg);
												}
											}
										});
									}
								}
							});
						}
						else
						{
							sdcms.error(d.msg.substring(1));
						}
					}
				}
			}
		});
	});
})
</script>
</body>
</html>