<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>我的订单</title>
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
                    <li><a href="{N('user')}">会员中心</a></li>
                    <li>我的订单</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--中间部分开始-->
            <div class="box-base box-user ui-row">
            	<div class="ui-col-2 border-right usernav">
                	<!--左侧开始-->
                    {include file="user/nav.php"}
                    <!--左侧结束-->
                </div>
                <div class="ui-col-10 ui-pl-30 ui-pr-30 ui-pb-15">
                	<!--右侧开始-->
                    <div class="ui-menu ui-menu-blue ui-mt-15 ui-mb-20">
                        <div class="ui-menu-name">我的订单</div>
                    </div>
                    
                    <div class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                        <a class="ui-btn-group-item{if $types==0} active{/if}" href="{N('myorder','','types=0')}">全部订单</a>
                        <a class="ui-btn-group-item{if $types==1} active{/if}" href="{N('myorder','','types=1')}">待付款</a>
                        <a class="ui-btn-group-item{if $types==2} active{/if}" href="{N('myorder','','types=2')}">待发货</a>
                        <a class="ui-btn-group-item{if $types==3} active{/if}" href="{N('myorder','','types=3')}">待收货</a>
                        <a class="ui-btn-group-item{if $types==4} active{/if}" href="{N('myorder','','types=4')}">待评价</a>
                        <a class="ui-btn-group-item{if $types==5} active{/if}" href="{N('myorder','','types=5')}">退款中</a>
                        <a class="ui-btn-group-item{if $types==6} active{/if}" href="{N('myorder','','types=6')}">已关闭</a>
                    </div>
                    
                    <ul class="myorder">
                        {sdcms:rs pagesize="10" table="sd_order" where="$where" order="order_id desc" key="order_id" auto="j"}
                        {rs:eof}没有找到相关订单{/rs:eof}
                        {php $orderid=$rs[order_id]}
                        <li>
                            <div class="goods_subject">
                                <div class="leftbox">
                                    <span class="date">{date('Y-m-d',$rs[createdate])}</span>
                                    <span class="orderid">订单号：<a href="{N('myordershow','','id='.$rs[order_id].'')}">{$rs[order_no]}</a>
                                    <span class="ui-btn ui-btn-info ui-btn-lt ui-ml ui-tips" data-title="{if $rs[comefrom]==1}Pc订单{elseif $rs[comefrom]==2}手机订单{elseif  $rs[comefrom]==3}微信订单{else}小程序订单{/if}">来源</span>
                                    {if $rs[ordertype]==2}<a href="{N('ordergroup','','id='.$rs[groupid].'&orderid='.$rs[order_id].'')}" class="ui-tips" data-title="查看拼团详情"><span class="ui-btn ui-btn-yellow ui-btn-lt ui-ml-sm">拼团</span></a>{/if}
                                    </span>
                                    <span class="price">单价</span>
                                    <span class="num">数量</span>
                                    <!--<span class="action">{if $rs[paytype]==1 && $rs[isover]==1}售后{/if}</span>-->
                                </div>
                                <div class="rightbox">
                                    <span class="total">{if $rs[paytype]==1}应付金额{else}应付积分{/if}</span>
                                    <span class="view"><a href="{N('myordershow','','id='.$rs[order_id].'')}">查看详情</a></span>
                                </div>
                            </div>
                            <div class="goods_item">
                                <div class="leftbox">
                                    {sdcms:rp top="0" table="sd_order_list" where="orderid=$orderid" order="aid" auto="i"}
                                    <div class="item{if ($rp[goods_issuit]==1 || $rp[goods_suitid]>0)} suit{/if}">
                                        <span class="pic"><img src="{$rp[goods_pic]}"></span>
                                        <span class="name"><a href="{U('goodsshow','id='.$rp[goods_id].'')}" target="_blank">{$rp[goods_name]}</a><em>{$rp[goods_skuname]}</em>{if $rp[goods_isgift]>0}<span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}</span>
                                        <span class="price">{if $rp[goods_price]>0}￥{getprice($rp[goods_price])}<br>{/if}{if $rp[goods_point]>0}{$rp[goods_point]} 积分{/if}</span>
                                        <span class="num">{$rp[goods_num]}</span>
                                    </div>
                                    {/sdcms:rp}
                                </div>
                                <div class="rightbox">
                                    <span class="total">
                                    {if $rs[order_total]>0}￥{getprice($rs[order_total])}{/if}{if $rs[order_point]>0}<div class="ui-mt-sm">{$rs[order_point]} <span class="ui-text-gray">积分</span></div>{/if}
                                    </span>
                                    <span class="status">
                                    {if $rs[isrefund]>0}
                                        {if $rs[refundstate]==1 || $rs[refundstate]==2}已申请退款<br><a href="javascript:;" data-url="{U('closerefund','id='.$rs[order_id].'')}" class="ui-btn ui-btn-blue closerefund ui-btn-sm">取消申请</a>{/if}
                                        {if $rs[refundstate]==3}已同意退款<br><a href="javascript:;" data-url="{U('fillpost','id='.$rs[order_id].'')}" class="ui-btn ui-btn-blue fillpost ui-btn-sm">填写快递</a>{/if}
                                        {if $rs[refundstate]==4}已退回商品<br>待审核{/if}
                                        {if $rs[refundstate]==98}退款处理中{/if}
                                        {if $rs[refundstate]==99}退款被拒绝<br><a href="javascript:;" data-url="{U('showwhy','id='.$rs[order_id].'')}" data-backurl="{U('reback','id='.$rs[order_id].'')}" data-close="{U('closerefund','id='.$rs[order_id].'')}" class="ui-btn ui-btn-blue showwhy ui-btn-sm">查看原因</a>{/if}
                                        {if $rs[refundstate]==100 && $rs[isclose]==0 && $rs[isover]==0}退款完成{/if}
                                    {/if}
                                    {if $rs[payway]==1}
                                        {if $rs[ispay]==0 && $rs[isclose]==0}
                                        	<a href="{N('ordershow','','orderid='.$rs[order_no].'')}" class="ui-btn ui-btn-blue ui-btn-sm">{if $rs[ispreorder]==0}现在付款{else}{if $rs[isfullorder]==1}现在付款{else}{if $rs[isfristpay]==0}支付定金{else}支付尾款{/if}{/if}{/if}</a>
                                        {/if}
                                        {if $rs[ispay]==1 && $rs[isdelivery]==0 && $rs[isclose]==0 && $rs[isrefund]!=1}
                                            {if $rs[store_id]==0}待发货{else}待取货{/if}
                                            {if sdcms[shop_refund]==1 && $rs[refundstate]==0 && $rs[paytype]==1 && $rs[ordertype]==1 && $rs[ispreorder]==0}
                                                <!--<br><a href="javascript:;" data-url="{U('refund','id='.$rs[order_id].'')}" class="ui-btn ui-btn-blue refund ui-btn-sm">申请退款</a>-->
                                            {/if}
                                        {/if}
                                    {else}
                                        {if $rs[isdelivery]==0 && $rs[isclose]==0}货到付款{/if}
                                    {/if}
                                    {if $rs[isdelivery]==1 && $rs[isreceived]==0 && $rs[isclose]==0 && $rs[isrefund]!=1}
                                        <a href="javascript:;" data-url="{U('autopost','id='.$rs[order_id].'')}" class="ui-btn ui-btn-blue auto_post ui-btn-sm">确认收货</a>
                                        {if sdcms[shop_refund]==1 && $rs[refundstate]==0 && $rs[paytype]==1 && $rs[payway]==1}<!--<a href="javascript:;" class="ui-btn ui-mt-sm refund ui-btn-sm" data-url="{U('refund','id='.$rs[order_id].'')}">退款退货</a>-->{/if}
                                    {/if}
                                    {if $rs[isreceived]==1 && $rs[isevaluate]==0}
                                        <a href="{U('myorderscore','id='.$rs[order_id].'')}" class="ui-btn ui-btn-blue ui-btn-sm">商品评价</a>
                                    {/if}
                                    {if $rs[isclose]==1}已关闭{/if}
                                    {if $rs[isover]==1 && $rs[isevaluate]==1}已完成{/if}
                                    </span>
                                </div>
                            </div>
                        </li>
                        {/sdcms:rs}
                    </ul>
                    <div class="ui-page ui-page-center ui-mt-15">
                    	<ul>{$showpage}</ul>
                    </div>
                    
                    <!--右侧结束-->
                </div>
            </div>
            <!--中间部分结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script>
$(function()
{
	{if sdcms[shop_refund]==1}
	$(".refund").click(function()
	{
		var url=$(this).attr("data-url");
		$.dialogbox(
		{
			title:"申请退款",
			text:url,
			width:'700px',
			height:'450px',
			type:3,
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			}
		});
	});
	$(".closerefund").click(function()
	{
		var url=$(this).attr("data-url");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要取消申请？不可恢复！",
			ok:function(e)
			{
				e.close();
				$.ajax(
				{
					url:url,
					data:"token={$token}",
					type:'post',
					dataType:'json',
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						if(d.state=='success')
						{
							sdcms.success('取消成功');
							setTimeout(function(){location.href='{THIS_LOCAL}';},1000);
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
	$(".showwhy").click(function()
	{
		var url=$(this).attr("data-url");
		var closeurl=$(this).attr("data-close");
		var backurl=$(this).attr("data-backurl");
		$.dialogbox(
		{
			title:"查看原因",
			text:url,
			width:'550px',
			height:'340px',
			type:3,
			okval:'重新申请',
			cancelval:'取消申请',
			ok:function(e)
			{
				e.close();
				setTimeout(function()
				{
					$.dialogbox(
					{
						title:"申请退款",
						text:backurl,
						width:'700px',
						height:'450px',
						type:3,
						ok:function(ee)
						{
							ee.iframe().contents().find("#sdcms-submit").click();
						},
						cancel:function()
						{
							location.href='{THIS_LOCAL}';
						}
					});
				},200);
			},
			cancel:function(e)
			{
				e.close();
				setTimeout(function()
				{
					$.dialog(
					{
						title:"操作提示",
						text:"确定要取消申请？不可恢复！",
						ok:function(ee)
						{
							ee.close();
							$.ajax(
							{
								url:closeurl,
								data:"token={$token}",
								type:'post',
								dataType:'json',
								error:function(e){alert(e.responseText);},
								success:function(d)
								{
									if(d.state=='success')
									{
										sdcms.success('取消成功');
										setTimeout(function(){location.href='{THIS_LOCAL}';},1000);
									}
									else
									{
										sdcms.error(d.msg);
									}
								}
							});
						}
					});
				},200);
			}
		});
	});
	$(".fillpost").click(function()
	{
		var url=$(this).attr("data-url");
		$.dialogbox(
		{
			title:"填写快递",
			text:url,
			width:'700px',
			height:'60%',
			type:3,
			oktheme:'ui-btn-info',
			ok:function(e)
			{
				e.iframe().contents().find("#sdcms-submit").click();
			}
		});
	});
	{/if}
	$(".auto_post").click(function()
	{
		var url=$(this).attr("data-url");
		$.dialog(
		{
			title:"操作提示",
			text:"确定已收货？不可恢复！",
			ok:function(e)
			{
				e.close();
				$.ajax(
				{
					url:url,
					data:"token={$token}",
					type:'post',
					dataType:'json',
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						if(d.state=='success')
						{
							sdcms.success('确认成功');
							setTimeout(function(){location.href='{THIS_LOCAL}';},1000);
						}
						else
						{
							sdcms.error(d.msg)
						}
					}
				});
			}
		});
	});
})
</script>
</body>
</html>