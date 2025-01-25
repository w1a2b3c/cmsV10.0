<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>购物车_{sdcms[web_name]}</title>
</head>

<body>
	{include file="head.php"}
    <!--中间部分开始-->
    <div class="bg_body bg_body_inner">   
        <div class="width">
        	<!--面包屑导航开始-->
            <div class="ui-bread ui-bread-1">
                <ul>
                    <li><a href="{$webroot}">首页</a></li>
                    <li>购物车</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            <!--购物车开始-->
            <div class="cart">
                {if count($cart)==0}
                    <div class="nogoods"><span class="ui-icon-cart"></span><p>您的购物车里没有商品！</p><a href="{WEB_ROOT}">去购物</a></div>
                {else}
                    <form class="ui-form-cart">
                    <table class="ui-table ui-table-border ui-table-hover">
                        <thead class="ui-thead-gray">
                        <tr>
                            <th width="40"><label class="ui-checkbox"><input type="checkbox" class="checkall" value="" checked><i></i></label></th>
                            <th class="ui-text-left">商品</th>
                            <th width="200">数量</th>
                            <th width="120">单价</th>
                            <th width="120">小计</th>
                            <th width="80">操作</th>
                        </tr>
                        </thead>
                        {foreach $cart as $key=>$rs}
                        <tr>
                            <td><label class="ui-checkbox"><input type="checkbox" name="goodsid" value="{$rs['cartid']}" class="gift-{$rs['isgift']}" data-gift="gift-{$rs['goodsid']}" {if $rs['isgift']!=0 }disabled{/if} {if $rs['islock']==1}checked{else}disabled{/if}><i></i></label></td>
                            <td class="ui-text-left" style="white-space:normal">
								{if $rs['issuit']==0}
									<img src="{thumb($rs['pic'],100,100)}" class="pic">
									<a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank">{$rs['title']}</a><br><span class="ui-text-gray ui-mt-sm">{$rs['skuname']}</span><br>
									{if $rs['islock']<1}<span class="ui-btn ui-btn-red ui-btn-lt ui-mt-sm">商品已下架</span>{/if}
									{if $rs['isgift']!=0}<span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}
								{else}
									<a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank"><strong>{$rs['suitname']}</strong></a>
									<ul>
										<li><a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank">{$rs['title']} {$rs['skuname']}</a></li>
										{foreach $rs['suitdata'] as $aa=>$bb}
											<li><a href="{$bb['url']}" target="_blank" title="{$bb['title']}">{$bb['title']} {$bb['skuname']}</a></li>
										{/foreach}
									</ul>
								{/if}
                            </td>
                            <td><input type="text" value="{$rs['buynum']}" class="ui-inputnumber" data-id="{$rs['cartid']}" data-price="{getprice($rs['price'])}" data-point="{$rs['point']}" data-max="{$rs['stock']}" data-align="center"{if $rs['isgift']!=0} data-disabled="1"{/if}></td>
                            <td>
                            	<div{if $rs['price']==0 && $rs['isgift']==0} class="ui-hide"{/if}>￥{getprice($rs['price'])}</div>
                            	<div{if $rs['point']==0} class="ui-hide"{/if}><span class="ui-text-gray">{$rs['point']}</span> 积分</div>
                                </td>
                            <td class="item_total">
                                <div{if $rs['price']==0 && $rs['isgift']==0} class="ui-hide"{/if}>￥<span class="price">{getprice($rs['price']*$rs['buynum'])}</span></div>
                                <div{if $rs['point']==0} class="ui-hide"{/if}><span class="ui-text-gray point">{$rs['point']*$rs['buynum']}</span> 积分</div>
                            </td>
                            <td><a href="javascript:;" class="del" data-id="{$rs['cartid']}"><i class="ui-icon-delete"></i> 删除</a></td>
                        </tr>
                        {/foreach}
                        <tr>
                            <td colspan="6">
                            <div class="ui-row ui-align-items-center">
                                <div class="ui-col-5 ui-text-left"><label class="ui-checkbox"><input type="checkbox" class="checkall" value="" checked><i></i></label><a href="javascript:;" class="clear">删除选中的商品</a></div>
                                <div class="ui-col-7 ui-text-right">已选<span id="cart_num"><em>0</em></span>件商品　共计（不含运费）：<span id="cart_total_price">￥<em>0</em></span><span id="cart_total_point"><em>0</em>积分</span><button type="button" class="ui-btn ui-btn-blue ui-ml" id="goorder">去结算</button></div>
                            </div>
                            </td>
                        </tr>
                    </table>
    </form>
                {/if}
            </div>
            <!--购物车结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
    
<script>
var min_url='{U("min")}';
var max_url='{U("max")}';
var del_url='{U("del")}';
var clear_url='{U("clear")}';
var local_url='{THIS_LOCAL}';
function loginmsg(d,url)
{
	{if C('shop_other_nologin')==1}
	var msg=(url=='')?'注册':'直接下单';
	{else}
	var msg='注册';
	url='';
	{/if}
	$.dialog(
	{
		title:"操作提示",
		text:d,
		okval:'登录',
		cancelval:msg,
		ok:function()
		{
			location.href='{N("login")}';
		},
		cancel:function()
		{
			if(url=='')
			{
				location.href='{N("reg")}';
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
							location.href='{N("cart","","isbuy=1")}';
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

function getlist()
{
	var data=[];
	$(".ui-form-cart").find("input[type=checkbox]:checked").each(function()
	{
		if($(this).attr("class")!='checkall')
		{
			data.push($(this).val())
		}
	})
	return data.join(",");
}

function cart_total()
{
	var num=0;
	var total=0;
	var point=0;
	$(".cart input[name=goodsid]").each(function()
	{
		if($(this).prop("checked"))
		{
			num++;
			total+=parseFloat($(this).parent().parent().parent().find(".item_total .price").html());
			point+=parseFloat($(this).parent().parent().parent().find(".item_total .point").html());
		}
	});
	$("#cart_num em").html(num);

	if(total==0)
	{
		$("#cart_total_price").addClass("ui-hide");
	}
	else
	{
		$("#cart_total_price em").html(parseFloat(Number(total).toFixed(2)));
		$("#cart_total_price").removeClass("ui-hide");
	}
	if(point==0)
	{
		$("#cart_total_point").addClass("ui-hide");
	}
	else
	{
		$("#cart_total_point em").html(Number(point));
		$("#cart_total_point").removeClass("ui-hide");
	}
}

$(function()
{
	//全选
	$(".checkall").click(function()
	{
		setTimeout(function(){cart_total();},100)
	});
	//单个选择
	$(".cart input[name=goodsid]").click(function()
	{
		var result=$(this).prop("checked");
		var gift=$(this).attr("data-gift");
		if(gift!='gift-0')
		{
			$("."+gift).prop("checked",result);
		}
		cart_total();
	});
	//减少
	$(document).on("click",".ui-inputnumber-min",function()
	{
		var that=$(this);
		var pId=that.closest(".ui-inputnumber-wrap").find(".ui-inputnumber");
		var id=pId.attr("data-id");
		var price=pId.attr("data-price");
		var point=pId.attr("data-point");
		var num=pId.val();
		$.ajax(
		{
			type:'post',
			dataType:'json',
			url:min_url,
			data:'token={$token}&id='+id+'&num='+num,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					that.closest("tr").find(".item_total .price").html(parseFloat(Number(parseFloat(price*(parseInt(num)))).toFixed(2)));
					that.closest("tr").find(".item_total .point").html(parseFloat(Number(parseFloat(point*(parseInt(num))))));
					cart_total();
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		});
	});
	//增加
	$(document).on("click",".ui-inputnumber-max",function()
	{
		var that=$(this);
		var pId=that.closest(".ui-inputnumber-wrap").find(".ui-inputnumber");
		var id=pId.attr("data-id");
		var price=pId.attr("data-price");
		var point=pId.attr("data-point");
		var maxnum=pId.attr("data-max");
		var num=pId.val();
		if(parseInt(num)>parseInt(maxnum))
		{
			$.tips({text:'已达到最大数',id:$(this),align:'top'});
			return;
		}
		$.ajax(
		{
			type:'post',
			dataType:'json',
			url:max_url,
			data:'token={$token}&id='+id,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					that.closest("tr").find(".item_total .price").html(parseFloat(Number(parseFloat(price*(parseInt(num)))).toFixed(2)));
					that.closest("tr").find(".item_total .point").html(parseFloat(Number(parseFloat(point*(parseInt(num))))));
					cart_total();
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		});
	});
	//修改
	$(document).on("blur",".ui-inputnumber-text",function()
	{
		var that=$(this);
		setTimeout(function()
		{
			var pId=that.closest(".ui-inputnumber-wrap").find(".ui-inputnumber");
			var id=pId.attr("data-id");
			var price=pId.attr("data-price");
			var maxnum=pId.attr("data-max");
			var num=pId.val();
			if(parseInt(num)>parseInt(maxnum))
			{
				$.tips({text:'已达到最大数',id:$(this),align:'top'});
				return;
			}
			$.ajax(
			{
				type:'post',
				dataType:'json',
				url:max_url,
				data:'token={$token}&id='+id+'&num='+num,
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						that.closest("tr").find(".item_total span").html(Number(parseFloat(price*(parseInt(num)))).toFixed(2));
						cart_total();
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		},300)
	});
	
	//单个删除
	$(".cart .del").click(function()
	{
		var id=$(this).attr("data-id");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要从购物车中删除此商品？",
			ok:function(e)
			{
				$.ajax(
				{
					type:'post',
					dataType:'json',
					url:del_url,
					data:"token={$token}&id="+id,
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						e.close();
						if(d.state=='success')
						{
							location.href='{THIS_LOCAL}';
						}
						else
						{
							sdcms.error(d.msg);
						}
					}
                });
			}
		});

	});
	//清空选择的商品
	$(".cart .clear").click(function()
	{
		var list=getlist();
		if(list=="")
		{
			sdcms.error('请选择要删除的商品');
			return;
		}
		$.dialog(
		{
			title:"操作提示",
			text:"确定要删除选中的商品？",
			ok:function(e)
			{
				$.ajax(
				{
					type:'post',
					dataType:'json',
					url:clear_url,
					data:'token={$token}&id='+list,
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						e.close();
						if(d.state=='success')
						{
							location.href='{THIS_LOCAL}';
						}
						else
						{
							sdcms.error(d.msg);
						}
					}
				});
			}
		});
	});
	//去结算
	$("#goorder").click(function()
	{
		var list=getlist();
		if(list=='')
		{
			$.tips({text:'亲，至少选择一件商品哦',id:$(this),align:'top'});
			return;
		}
		{if USER_ID==0}
		loginmsg('请先登录或注册','{N("order")}');
		return false;
		{/if}
		$.ajax(
		{
			type:'post',
			dataType:'json',
			url:local_url,
			data:'token={$token}&id='+list,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					location.href=d.msg;
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		  });
	});
	//计算总价
	cart_total();
	{if $isbuy==1}
	$("#goorder").click();
	{/if}
});
</script>
</body>
</html>