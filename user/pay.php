<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>在线充值</title>
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
                    <li>财务明细</li>
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
                        <div class="ui-menu-name">在线充值</div>
                    </div>
                    
                    <!--begin-->
					<form method="post" class="ui-form mt-40">
						{sdcms:rs top="1" table="sd_user" where="id=$userid"}
						<div class="ui-form-group ui-row">
							<label class="ui-col-2 ui-col-form-label">账户余额：</label>
							<div class="ui-col-5 ui-mt">
								<span class="ui-text-red">{$rs[umoney]}</span> 元
							</div>
						</div>
						{/sdcms:rs}
						<div class="ui-form-group ui-row">
							<label class="ui-col-2 ui-col-form-label">充值金额：</label>
							<div class="ui-col-6">
								<input type="text" name="paymoney" class="ui-form-ip" placeholder="1元起充" data-rule="充值金额:required;dot;between(1,10000);">
							</div>
						</div>
						<div class="ui-form-group ui-row">
							<label class="ui-col-2 ui-col-form-label">支付方式：</label>
							<div class="ui-col-6">
								 <ul class="pay" id="orderpay">
									{if C('pay_open')==1}
										{if C('pay_alipay_open')==1 && isweixin()==0}
										<li><div><img src="{WEB_ROOT}api/pay/alipay/images/pay.png" data-config="alipay"><i class="ui-icon-check"></i></div></li>
										{/if}
										{if C('pay_wxpay_open')==1}
										<li><div><img src="{WEB_ROOT}api/pay/wxpay/images/pay.png" data-config="wxpay"><i class="ui-icon-check"></i></div></li>
										{/if}
									{/if}
								</ul>
								<input type="hidden" name="type" id="payway" data-rule="支付方式:required;" value="">
							</div>
						</div>
						<div class="ui-form-group ui-row">
							<label class="ui-col-2 ui-col-form-label"></label>
							<div class="ui-col-5">
                            	<input type="hidden" name="token" value="{$token}">
								<input type="submit" class="ui-btn ui-btn-blue" value="在线支付">
							</div>
						</div>
					</form>
					<!--over-->
                    
                    <!--右侧结束-->
                </div>
            </div>
            <!--中间部分结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
	<script src="{WEB_ROOT}public/js/jquery.qrcode.js"></script>
    <script>
	function freshorder(orderId)
	{
		var interval=setInterval(function()
		{
			$.ajax(
			{
				type:"post",
				cache:"false",
				url:"{U('checkpay')}",
				data:"token={$token}&orderid="+orderId,
				success:function(d)
				{
					if(d=='1')
					{
						location.href='{THIS_LOCAL}';
					}
				}
			})
		},1000);
	};
    $(function()
    {
    	$(".ui-form").form(
    	{
    		type:2,
			hide:2,
    		align:'center',
    		result:function(form)
    		{
				var payway=$("#payway").val();
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
							{if !ismobile()}
							if(payway=="wxpay")
							{
								$.ajax(
								{
									type:'get',
									dataType:'json',
									url:'{WEB_ROOT}api/pay/wxpay/p/api.php?type=2&orderid='+d.msg,
									error:function(e){alert(e.responseText);},
									success:function(data)
									{
										if(data.state=='success')
										{
											$("#qrcode").remove();
											$.dialog(
											{
												title:"微信支付",
												text:'<div class="text-center"><div id="qrcode" style="width:300px;height:300px;"></div><div>请打开【微信】，使用【扫一扫】完成付款。</div></div>',
												okval:'已完成支付',
												ok:function(e)
												{
													location.href='{N("user")}';
												}
											});
											$("#qrcode").qrcode({width:300,height:300,text:data.msg[0]}); 
										}
										else
										{
											sdcms.error(data.msg[0]);
										}
									}
								});
								freshorder(d.msg);
								return false;
							}
							{/if}
							var root="p";
							{if ismobile()}
							var root="m";
							{/if}
							{if isweixin()}
							if(payway=='wxpay')
							{
								var root='w';
							}
							{/if}
							location.href='{WEB_ROOT}api/pay/'+payway+'/'+root+'/api.php?type=2&orderid='+d.msg+'';
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