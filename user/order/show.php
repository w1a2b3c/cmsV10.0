<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>订单详情</title>
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
                    <li>订单详情</li>
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
                    
                    <div class="myordershow">
                        <h2>订单号：{$order_no}</h2>
                        <div class="orderstatus">
                            <div id="step"></div>
                            {if $isclose==1}
                            <div class="action">
                                <div class="status">订单状态：已关闭</div>
                                <p>关闭原因：{if $closecause==0}付款超时{elseif $closecause==1}用户取消{elseif $closecause==2}用户退款{elseif $closecause==3}拼团失败{else}用户拒收{/if}。</p>
                            </div>
                            {else}
                                {if $stepnum==1}
                                <div class="action">
                                    <div class="status">订单状态：待付款</div>
                                    <div class="doing {if USER_ID==0} hide{/if}"><a href="{N('ordershow','','orderid='.$order_no.'')}" class="ui-btn ui-btn-blue">{if $ispreorder==0}现在付款{else}{if $isfullorder==1}现在付款{else}{if $isfristpay==0}支付定金：{getprice($fristmoney)}{else}支付尾款：{getprice($lastmoney)}{/if}{/if}{/if}</a>{if ($isfristpay==1 && $ispreorder==0) || ($ispreorder==1 && $isfristpay==0)}<a href="javascript:;" class="ui-btn ui-ml close_order" data-url="{U('autoclose','id='.$id.'&type=1')}">取消订单</a>{/if}</div>
                                    {if $ispreorder==0 || ($ispreorder==1 && $isfristpay==0)}<p>请在 <span class="ui-endtime" data-time="{$lastpaydate}">-</span> 内完成支付，超时后将取消订单。</p>{/if}
                                </div>
                                {/if}
                                {if $stepnum==2}
                                <div class="action">
                                    <div class="status">订单状态：
                                    {if $isrefund!=1}
                                        {if $payway==1}已付款{else}货到付款{/if}，待发货
                                    {else}
                                        {if $refundstate==1 || $refundstate==98}已申请退款{/if}
                                        {if $refundstate==99}退款被拒绝{/if}
                                        {if $refundstate==100}退款完成{/if}
                                    {/if}
                                    </div>
                                    <div class="doing {if USER_ID==0} hide{/if}">
                                        {if $payway==1}
                                            {if sdcms[shop_refund]==1 && $paytype==1 && $ordertype==1 && $ispreorder==0}
                                                {if $isrefund==0}
                                                    <a href="javascript:;" data-url="{U('refund','id='.$id.'')}" class="ui-btn ui-btn-blue refund">申请退款</a>
                                                {else}
                                                    <a href="javascript:;" data-url="{U('closerefund','id='.$id.'')}" class="ui-btn ui-btn-blue closerefund">取消申请</a>
                                                    {if $refundstate==99}
                                                        <a href="javascript:;" data-url="{U('showwhy','id='.$id.'')}" data-backurl="{U('reback','id='.$id.'')}" data-close="{U('closerefund','id='.$id.'')}" class="ui-btn ui-btn-blue showwhy">查看原因</a>
                                                    {/if}
                                                {/if}
                                            {/if}
										{else}
											{if $isdelivery==0}<a href="javascript:;" class="ui-btn ui-ml close_order" data-url="{U('autoclose','id='.$id.'&type=1')}">取消订单</a>{/if}
                                        {/if}
                                    </div>
                                    <p>
                                    {if $isrefund!=1}
                                        请耐心等待商品发货。
                                    {else}
                                        {if $refundstate==1 || $refundstate==98}请耐心等待客服处理{/if}
                                        {if $refundstate==99}退款被拒绝{/if}
                                        {if $refundstate==100}退款完成{/if}
                                    {/if}
                                    </p>
                                </div>
                                {/if}
                                {if $stepnum==3}
                                <div class="action">
                                    <div class="status">订单状态：{if $isrefund!=1}已发货，待确认{else}退款处理中{/if}</div>
                                    <div class="doing {if USER_ID==0} hide{/if}">
                                        {if $isrefund!=1}<a href="javascript:;" class="ui-btn ui-btn-blue auto_post" data-url="{U('autopost','id='.$id.'')}">确认收货</a>{/if}
                                        {if sdcms[shop_refund]==1 && $refundstate==0 && $paytype==1 && $payway==1}<a href="javascript:;" class="ui-btn ui-ml-sm refund" data-url="{U('refund','id='.$id.'')}">退款退货</a>{/if}
                                        {if $refundstate==1}<a href="javascript:;" data-url="{U('closerefund','id='.$id.'')}" class="ui-btn ui-btn-blue closerefund">取消申请</a>{/if}
                                        {if $refundstate==3}<a href="javascript:;" data-url="{U('fillpost','id='.$id.'')}" class="ui-btn ui-btn-blue fillpost">填写快递</a>{/if}
                                        {if $refundstate==99}<a href="javascript:;" data-url="{U('showwhy','id='.$id.'')}" data-backurl="{U('reback','id='.$id.'')}" data-close="{U('closerefund','id='.$id.'')}" class="ui-btn ui-btn-blue showwhy">查看原因</a>{/if}
                                    </div>
                                    <p> 
                                    {if $isrefund!=1}
                                        您的确认收货时间还有：<span class="ui-endtime" data-time="{$lastreceiptdate}">-</span>，超时后订单将自动收货。
                                    {else}                                   
                                        {if $refundstate==1 || $refundstate==2}已申请退款，待审核{/if}
                                        {if $refundstate==3}已同意退款，请填写快递资料{/if}
                                        {if $refundstate==4}已退回商品，待审核{/if}
                                        {if $refundstate==98}退款处理中，请耐心等待客服处理。{/if}
                                        {if $refundstate==99}退款被拒绝{/if}
                                        {if $refundstate==100}退款完成{/if}
                                    {/if}
                                    </p>
                                </div>
                                {/if}
                                {if $stepnum==4}
                                <div class="action">
                                    <div class="status">订单状态：已收货，未评价</div>
                                    <div class="doing {if USER_ID==0} hide{/if}"><a href="{U('myorderscore','id='.$id.'')}" class="ui-btn ui-btn-blue">商品评价</a></div>
                                    <p>您的评价是我们前行的动力！</p>
                                </div>
                                {/if}
                                {if $stepnum==5}
                                <div class="action">
                                    <div class="status">订单状态：已完成</div>
                                    <p>感谢您对我们产品的支持。</p>
                                </div>
                                {/if}
                            {/if}
                        </div>
                        <div class="goodslist">
                        	<div class="goods_subject">
                                <span class="name">商品明细</span>
                            </div>
                        	<table class="ui-table ui-table-hover">
                                <thead>
                                    <tr>
                                        <th>商品</th>
                                        <th>单价</th>
                                        <th>购买数量</th>
                                        <th>退货数量</th>
                                        <th>运费</th>
                                        <th>小计</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	{foreach $goodslist as $key=>$rs}
                                    <tr>
                                        <td valign="top" style="white-space:normal"><img src="{$rs['goods_pic']}" width="100" class="ui-mr-15 ui-bd" align="left"><a href="{U('goodsshow','id='.$rs['goods_id'].'')}" target="_blank">{$rs['goods_name']}</a><br><em class="ui-text-gray">{$rs['goods_skuname']}</em>{if $rs['goods_isgift']>0}<br><span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}</td>
                                        <td>
                                        	{if $rs['goods_price']>0 || $rs['goods_isgift']>0}<div>￥{getprice($rs['goods_price'])}</div>{/if}
                                            {if $rs['goods_point']>0}<div class="ui-text-gray">{$rs['goods_point']} 积分</div>{/if}
                                        </td>
                                        <td>{$rs['goods_num']}</td>
                                        <td>{$rs['backnum']}</td>
                                        <td>{if sdcms[shop_freight_mode]==0}{$rs['goods_freight']}{else}-{/if}</td>
                                        <td>
                                        	{if $rs['goods_total']>0 || $rs['goods_isgift']>0}<div>￥{getprice($rs['goods_total'])}</div>{/if}
                                            {if $rs['goods_total_point']>0}<div class="ui-text-gray">{$rs['goods_total_point']} 积分</div>{/if}
                                        </td>
                                    </tr>
                                    {/foreach}
                                    <tr>
                                    	<td></td>
                                        <td colspan="4" class="ui-text-right ui-height-26 ui-text-gray" style="padding-right:0;">
                                        	商　品：<br>
                                            运　费：<br>
                                            优　惠：<br>
											{if $order_admin!=0}改　价：<br>{/if}
                                            积　分：<br>
											{if $order_service>0}手续费：<br>{/if}
                                            总　计：
                                        </td>
                                        <td class="ui-text-left ui-height-26" style="padding-left:0;">
                                            ￥<em>{getprice($goods_total)}</em><br>
                                            ￥<em>{getprice($goods_freight)}</em><br>
                                            -￥<em>{getprice($goods_discount)}</em><br>
											{if $order_admin<0}￥<em>{getprice($order_admin)}</em><br>{/if}
                                            <em>{$order_point}</em><br>
											{if $order_service>0}￥<em>{getprice($order_service)}</em><br>{/if}
                                            ￥<em>{getprice($order_total)}</em>
											
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        {if $isrefund>0}
                        <div class="other">
                            <h3>退款信息</h3>
                            <ul>
                                {if count($refund)==0}
                                    <li>退款方式：仅退款</li>
                                    <li>退款原因：拼团失败</li>
                                    <li>退款状态：退款完成（ 原路退回 ）</li>
                                {else}
                                    <li>退款方式：{if $refund['types']==1}仅退款{else}退款退货{/if}</li>
                                    <li>退款金额：{$refund['refundmoney']}</li>
                                    <li>退款原因：{$refund['refundwhy']}</li>
                                    {if $refund['postcompany']!=''}<li>快递公司：{$refund['postcompany']}</li>
                                    <li>快递单号：{$refund['postno']}</li>{/if}
                                    <li>申请日期：{date('Y-m-d H:i:s',$refund['createdate'])}</li>
                                    <li>退款状态：{if $refund['isover']==1}退款完成（ {if $refund['isback']==1}原路退回{else}线下转账{/if} ）{else}处理中{/if}</li>
                                    {if $refund['backwhy']!=''}<li>退回原因：{$refund['backwhy']}</li>{/if}
                                {/if}
                            </ul>
                        </div>
                        {/if}
                        {if $isdelivery==1 && is_array($postdata)}
                        <div class="other">
                            <h3>发货信息</h3>
                            <ul>
								{if $group_state==0}
									<div class="ui-text-red">拼团未完成，暂时无法查看发货内容。</div>
								{else}
									{if $postdata['posttype']==1}
									<li>快递公司：{$postdata['postname']}</li>
									<li>　运单号：{$postdata['postsn']}</li>
									<div id="express">{$postdata['postdata']}</div>
									{else}
									<li>{if isempty($postdata['postdata'])}无需物流{else}{$postdata['postdata']}{/if}</li>
									{/if}
								{/if}
                            </ul>
                        </div>
                        {/if}
                        {if $invoice['invoice_type']>0}
                        <div class="other">
                            <h3>发票信息</h3>
                            <ul>
                                <li>类型：{if $invoice['invoice_type']==1}纸质发票{else}电子发票{/if}{if strlen($invoiceurl)}　　<a href="{$invoiceurl}" target="_blank">【查看发票】</a>{/if}</li>
                                <li>抬头：{$invoice['company_name']}</li>
                                {if $invoice['invoice_rise']==2}<li>纳税识别号：{$invoice['company_no']}</li>{/if}
                            </ul>
                        </div>
                        {/if}
                        {if $order_total>0 && count($paydata)>0}
                        <div class="other">
                            <h3>付款信息</h3>
                            <ul>
								{php $step=0;}
								{foreach $paydata as $key=>$rs}
                                <li>{if $ispreorder==1}{if $step==0}定金{else}尾款{/if} {else}金额{/if}：{getprice($rs['paymoney'])}</li>
                                {switch $rs['payway']}
                                {case 1}<li>方式：账户余款</li>{/case}
                                {case 2}<li>方式：{$rs['blankname']}</li>{/case}
                                {case 3}<li>方式：银行转账</li>{/case}
                                {case 4}<li>方式：快递代收</li>{/case}
                                {/switch}
                                <li>时间：{date('Y-m-d H:i:s',$rs['createdate'])}</li>
								{php $step++;}
								{/foreach}
                            </ul>
                        </div>
                        {/if}
                        
                        {if count($address)>1}
                            {if $store_id==0}
                            {php $shop_address_list=explode(',',C("shop_address_list"))}
                            <div class="other">
                                <h3>收货信息</h3>
                                <ul>
                                    {if strlen($address['name'])}<li>姓名：{$address['name']}</li>{/if}
                                    {if strlen($address['mobile'])}<li>手机：{$address['mobile']}</li>{/if}
                                    {if strlen($address['qq'])}<li>QQ号：{$address['qq']}</li>{/if}
                                    {if strlen($address['email'])}<li>邮箱：{$address['email']}</li>{/if}
                                    {if strlen($address['province'])}<li>地址：{$address['province']}{$address['city']}{$address['county']}{$address['street']}</li>{/if}
                                    {if strlen($address['idcard'])}<li>身份证：{$address['idcard']}</li>{/if}
                                </ul>
                            </div>
                            {else}
                            <div class="other">
                                <h3>取货信息</h3>
                                <ul>
                                    <li>门　店：{$address['title']}</li>
                                    <!--<li>电　话：{$address['mobile']}</li>-->
                                    <li>地　址：{$address['province']}{$address['city']}{$address['county']}{$address['street']}</li>
                                    <li>取货码：<span class="ui-text-red">{if $ispay==1}{$order_code}{else}订单未付款，无法查看{/if}</span></li>
                                </ul>
                            </div>
                            {/if}
                        {/if}
                        {if strlen($message)}
                        <div class="other">
                            <h3>买家留言</h3>
                            <ul>
                                <li>{$message}</li>
                            </ul>
                        </div>
                        {/if}
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
	$("#step").step({data:[{$stepdb}],index:{$stepnum},theme:'{C('theme_color')}',align:'bottom','arrow':true});
	{if sdcms[shop_refund]==1 && $paytype==1}
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
	
	{if ($stepnum==1 && ($ispreorder==0 || ($ispreorder==1 && $isfristpay==0))) || ($stepnum==2 && $payway==2 && $isdelivery==0)}
		{if $stepnum==1 && ($ispreorder==0 || ($ispreorder==1 && $isfristpay==0))}
		$(".ui-endtime").endtime(function(e)
		{
			$(e).html('已结束');
			$.ajax(
			{
				type:"post",
				dataType:'json',
				url:"{U('autoclose','id='.$id.'')}",
				data:"token={$token}",
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
		$(".close_order").click(function()
		{
			var url=$(this).attr("data-url");
			$.dialog(
			{
				title:"操作提示",
				text:"确定要关闭订单？不可恢复！",
				ok:function(e)
				{
					e.close();
					$.ajax(
					{
						url:url,
						type:'post',
						dataType:'json',
						data:"token={$token}",
						error:function(e){alert(e.responseText);},
						success:function(d)
						{
							if(d.state=='success')
							{
								sdcms.success('关闭成功');
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
		})
	{/if}
	
	{if $isdelivery==1 && $isrefund!=1}
		$(".ui-endtime").endtime(function(e)
		{
			$(e).html('已结束');
			$.ajax(
			{
				type:"post",
				dataType:'json',
				url:"{U('autopost','id='.$id.'&type=1')}",
				data:"token={$token}",
				success:function(d)
				{
					if(d.state=='success')
					{
						location.href='{THIS_LOCAL}';
					}
				}
			});
		});
		
		{if C('express_open')>0 && is_array($postdata) && $isevaluate==0}
		{if $postdata['posttype']==1}
			/*获取订单物流*/
			$.ajax(
			{
				url:"{U('getexpress')}",
				data:'token={$token}&orderid={$id}',
				type:'post',
				dataType:'json',
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						$("#express").html(d.msg);
					}
					else
					{
						//alert(d.msg)
					}
				}
			});
		{/if}
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
	{/if}
});	
</script>
</body>
</html>