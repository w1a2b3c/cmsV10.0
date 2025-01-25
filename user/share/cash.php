<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>申请提现</title>
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
                    <li>申请提现</li>
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
                        <div class="ui-menu-name">申请提现</div>
                    </div>
                    
                    <!--表单部分开始-->
                    <form method="post" class="ui-form ui-mt-40">
                    {sdcms:rs top="1" table="sd_user" where="id=$userid"}
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">可提现佣金：</label>
                        <div class="ui-col-7">
                        	<div class="ui-input-group">
                            	<input type="text" value="{$rs[share_money]}" readonly class="ui-form-ip radius-right-none">
                                <div class="after"><span class="ui-pl ui-pr">元</span></div>
                            </div>
                        </div>
                    </div>
                    {/sdcms:rs}
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">提现金额：</label>
                        <div class="ui-col-7">
                        	<div class="ui-input-group">
                            	<input type="text" name="amount" class="ui-form-ip radius-right-none" data-rule="提现金额:required;dot;">
                                <div class="after"><span class="ui-pl ui-pr">元</span></div>
                            </div>
                            <div class="ui-mt">最低金额：<span class="ui-text-red ui-mr-sm">{C('shop_cash_min')}</span>元{if C('shop_cash_charge')>0}　手续费：<span class="ui-text-blue ui-mr-sm">{C('shop_cash_charge')}</span>%，提现到余额不收费。{/if}</div>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">提现到：</label>
                        <div class="ui-col-7">
                            <select name="cashway" id="cashway" class="ui-form-ip" data-rule="提现方式:required;">
                            	<option value="">请选提现方式</option>
                                {if in_array(1,explode(',',C("shop_cash_way")))}
                                <option value="1">支付宝</option>
                                {/if}
                                {if in_array(2,explode(',',C("shop_cash_way")))}
                                <option value="2">微信</option>
                                {/if}
                                {if in_array(3,explode(',',C("shop_cash_way")))}
                                <option value="3">银行卡</option>
                                {/if}
                                {if in_array(4,explode(',',C("shop_cash_way")))}
                                <option value="4">余额</option>
                                {/if}
                            </select>
                        </div>
                    </div>
                    <div class="ui-form-group ui-row ui-hide cashinfo">
                        <label class="ui-col-2 ui-col-form-label">真实姓名：</label>
                        <div class="ui-col-7">
                            <input type="text" name="truename" class="ui-form-ip" maxlength="20" data-rule="真实姓名:required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row ui-hide cashname">
                        <label class="ui-col-2 ui-col-form-label">银行名称：</label>
                        <div class="ui-col-7">
                            <input type="text" name="blankname" class="ui-form-ip" maxlength="50" data-rule="银行名称:required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row ui-hide cashinfo">
                        <label class="ui-col-2 ui-col-form-label blank"></label>
                        <div class="ui-col-7">
                            <input type="text" name="cashid" class="ui-form-ip" maxlength="50" data-rule="required;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">登录密码：</label>
                        <div class="ui-col-7">
                            <input type="password" name="password" class="ui-form-ip" placeholder="请输入登录密码" data-rule="登录密码:required;password;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label"></label>
                        <div class="ui-col-7">
                        	<input type="hidden" name="token" value="{$token}">
                            <input type="submit" class="ui-btn ui-btn-blue" value="提交申请">
                        </div>
                    </div>
                    </form>
                    <!--表单部分结束-->
                                        
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
	$("#cashway").change(function()
	{
		var way=$(this).val();
		switch(way)
		{
			case "1":
				$(".cashinfo").removeClass("ui-hide");
				$(".cashname").addClass("ui-hide");
				$(".blank").html("支付宝账户：");
				break;
			case "2":
				$(".cashinfo").removeClass("ui-hide");
				$(".cashname").addClass("ui-hide");
				$(".blank").html("微信账户：");
				break;
			case "3":
				$(".cashinfo,.cashname").removeClass("ui-hide");
				$(".blank").html("银行卡号：");
				break;
			default:
				$(".cashinfo,.cashname").addClass("ui-hide");
				break;
		}
	});
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
						setTimeout(function(){location.href='{N("mysharecashlist")}';},1500);
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