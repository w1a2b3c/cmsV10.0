<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>订单详情_{sdcms[web_name]}</title>
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
                    <li>订单详情</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--订单开始-->
            <div class="ordershow">
                <div class="tip">
                	{if $ispreorder==0}
                    <div>订单金额：￥<em>{getprice($order_total)}</em></div>
                    {else}
                    	{if $isfullorder==1}
                        	<div>订单金额：￥<em>{getprice($order_total)}</em></div>
                        {else}
                        	{if $isfristpay==0}
                            	<div>定金：￥<em>{getprice($fristmoney)}</em></div>
                            {else}
                            	<div>尾款：￥<em>{getprice($lastmoney)}</em></div>
                            {/if}
                        {/if}
                    {/if}
                    <h3><span class="ui-icon-check-circle ui-text-green ui-font-32"></span>{if $ispay==0}订单提交成功{else}订单付款成功{/if}</h3>
                    <p>您的订单号：<em>{$orderid}</em>　
                    	{if $isclose==1}<span>{if $closecause==1}用户取消{else}超时后自动关闭。{/if}</span>{/if}
                        {if $payway==1 && $ispay==0 && $isclose==0}
                            {if $ispreorder==0 || ($ispreorder==1 && $isfristpay==0)}请在 <em class="ui-endtime" data-time="{$lastpaydate}">-</em> 内完成支付，超时后将取消订单。{/if}
                        {/if}
                    	{if $payway==2}<br>您的订单为【<em class="ui-text-red">货到付款</em>】，您也可以通过下面支付方式付款。{/if}
                    </p>
                	</div>
                    {if $ispay==0 && $isclose==0 && $ispay==0}
                    <form method="post" class="ui-form">
                    <h5>请选择支付方式</h5>
                    <ul class="pay" id="orderpay">
                        {if C('shop_pay_user')==1 && $umoney>=$order_money}
                        <li><div><img src="{WEB_ROOT}api/pay/user/images/pay.png" data-config="user"><i class="ui-icon-check"></i></div></li>
                        {/if}
                        {if C('pay_open')==1}
                        {if C('pay_alipay_open')==1}
                        <li><div><img src="{WEB_ROOT}api/pay/alipay/images/pay.png" data-config="alipay"><i class="ui-icon-check"></i></div></li>
                        {/if}
                        {if C('pay_wxpay_open')==1}
                        <li><div><img src="{WEB_ROOT}api/pay/wxpay/images/pay.png" data-config="wxpay"><i class="ui-icon-check"></i></div></li>
                        {/if}
                        {/if}
                    </ul>
                    <input type="hidden" name="payway" id="payway" data-rule="支付方式:required;">
                    <div class="bottom"><button type="submit" class="ui-btn ui-btn-blue ui-mr">立即支付</button><a href="{N('myordershow','','id='.$order_id.'')}" class="ui-btn">查看订单</a></div>
                    </form>
                    {else}
                    {if $order_code}
                    <h5>取货信息</h5>
                    <ul class="ui-list ui-p-20 ui-pt-0">
                    	{sdcms:rs table="sd_order_address" where="orderid=$order_id"}
                       	<li><div>门　店：{$rs[title]}</div></li>
                        <!--<li><div>电　话：{$rs[mobile]}</div></li>-->
                        <li><div>地　址：{$rs[province]}{$rs[city]}{$rs[county]}{$rs[street]}</div></li>
                        {/sdcms:rs}
                        <li><div>取货码：<span class="ui-text-red">{$order_code}</span></div></li>
                    </ul>
                    <div class="bottom"><a href="{N('myordershow','','id='.$order_id.'')}" class="ui-btn">查看订单</a></div>
                    {/if}
                    {/if}
            </div>
            <!--订单结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    
    
    {include file="foot.php"}
{if $ispay==0 && $isclose==0}
<script src="{WEB_ROOT}public/js/jquery.qrcode.js"></script>   
<script>
var url='{if $ordertype==1 || $payway==2}{N('myordershow','','id='.$order_id.'')}{else}{N('ordergroup','','id='.$groupid.'&orderid='.$order_id.'')}{/if}';
{if $order_code}
url='{THIS_LOCAL}';
{/if}
$(function()
{
	{if $ispreorder==0 || ($ispreorder==1 && $isfristpay==0)}
	$(".ui-endtime").endtime(function(e)
	{
		$(e).html('已结束');
		$.ajax(
		{
			type:"post",
			dataType:'json',
			url:"{U('order/autoclose','id='.$order_id.'')}",
			data:'token={$token}',
			success:function(d)
			{
				if(d.state=='success')
				{
					location.href='{THIS_LOCAL}';
				}
			}
		});
	});
	{/if}
	//付款方式
	if($("#orderpay").length>0)
	{
		$("#orderpay li").click(function()
		{
			var config=$(this).find("img").attr("data-config");
			$("#payway").val(config);
			$(this).siblings().removeClass('active').end().addClass('active');
		})	
	}
	$(".ui-form").form(
	{
		type:2,
		hide:2,
		align:'center',
		result:function(form)
		{
			var payway=($(form).serialize()).substring(7);
			switch (payway)
			{
				case "user":
					$.ajax(
					{
						type:'post',
						dataType:'json',
						url:'{U("orderpay")}',
						data:"token={$token}&id={$order_id}",
						error:function(e){alert(e.responseText);},
						success:function(d)
						{
							if(d.state=='success')
							{
								sdcms.success(d.msg);
								setTimeout(function(){location.href=url;},1500)
							}
							else
							{
								sdcms.error(d.msg);
							}
						}
					});
					break;
				case "wxpay":
					$.ajax(
					{
						type:'get',
						dataType:'json',
						url:'{WEB_ROOT}api/pay/wxpay/p/api.php?orderid={$orderid}&type=1',
						error:function(e){alert(e.responseText);},
						success:function(d)
						{
							if(d.state=='success')
							{
								$("#qrcode").remove();
								$.dialog(
								{
									title:"微信支付",
									text:'<div class="ui-text-center"><div id="qrcode" style="width:300px;height:300px;margin:0 auto;"></div><p class="ui-mt">请打开【微信】，使用【扫一扫】完成付款。</p></div>',
									ok:function(e)
									{
										e.close();
									}
								});
								$("#qrcode").qrcode({width:300,height:300,text:d.msg[0]}); 
							}
							else
							{
								sdcms.error(d.msg[0]);
							}
						}
					});
					break;
				default:
					location.href='{WEB_URL}{WEB_ROOT}api/pay/'+payway+'/p/api.php?orderid={$orderid}&type=1';
					break;
			}
		}
	});
});
var timer=window.setInterval(freshorder,1000);
function freshorder()
{
	$.ajax(
	{
		type:"post",
		cache:"false",
		url:"{U('ordershow','orderid='.$orderid.'&type='.$type.'')}",
		data:'token={$token}',
		success:function(d)
		{
			if(d==1)
			{
				setTimeout(function(){location.href=url;},1000)
				clearInterval(timer);
			}
		}
	});
}
</script>
{/if}
</body>
</html>