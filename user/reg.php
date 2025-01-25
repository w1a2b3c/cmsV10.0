<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>会员注册_{sdcms[web_name]}</title>
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
                    <li>会员注册</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--会员注册开始-->
            <div class="box-base ui-row">
            	<div class="ui-col-8 ui-pl">
                	<!--左侧开始-->
                    <div class="ui-menu ui-menu-blue ">
                        <div class="ui-menu-name">{if $ispai==1}完善资料{else}会员注册{/if}</div>
                    </div>
                    <div class="ui-pt-40">
                        {if $ispai==1}
                        <div class="api_user"><span>{$api_info.nickname}</span>，请完善账户资料，如已有账户，请绑定账户。　【<a href="{U('user/apiout')}">退出</a>】</div>
                        {/if}
                        <!--表单部分开始-->
                        <form method="post" class="ui-form ui-ml-40">
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">手机号：</label>
                            <div class="ui-col-5">
                                <input type="text" name="mobile" maxlength="11" class="ui-form-ip" placeholder="请输入手机号码" data-token="{$token}" data-rule="手机号码:required;mobile;ajax({U('checkreg')});">
                            </div>
                        </div>
                        {if sdcms[user_reg_auth]==1 && sdcms[user_reg_type]==2}
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">验证码：</label>
                            <div class="ui-col-5">
                                <div class="ui-input-group">
                                    <input type="text" name="code" id="code" class="ui-form-ip radius-right-none" placeholder="请输入验证码" data-rule="验证码:required;">
                                    <div class="code"><img src="{U('code')}" height="40" id="verify" title="点击更换验证码"></div>
                                </div>
                            </div>
                        </div>
                        {/if}
                        {if sdcms[user_reg_type]==2 && strlen(sdcms[sms_open])>0}
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">短信验证码：</label>
                            <div class="ui-col-5">
                                <div class="ui-input-group">
                                    <input type="text" name="ecode" id="ecode" class="ui-form-ip radius-right-none" placeholder="请输入短信验证码" data-rule="短信验证码:required;">
                                    <button type="button" class="after">发送验证码</button>
                                </div>
                            </div>
                        </div>
                        {/if}
                        <div class="ui-form-group ui-row{if sdcms[user_nickname]==0} hide{/if}">
                            <label class="ui-col-2 ui-col-form-label">昵称：</label>
                            <div class="ui-col-5">
                                <input type="text" name="nickname" class="ui-form-ip" placeholder="请输入昵称" data-rule="昵称:required;" value="{if $ispai==1}{$api_info.nickname}{else}{$nickname}{/if}">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">密码：</label>
                            <div class="ui-col-5">
                                <input type="password" name="password" id="password" autocomplete="off" class="ui-form-ip" placeholder="请输入密码" data-rule="密码:required;password;">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">确认密码：</label>
                            <div class="ui-col-5">
                                <input type="password" name="repass" class="ui-form-ip" placeholder="请再次输入密码" data-rule="确认密码:required;password;match(password)">
                            </div>
                        </div>
                        {if sdcms[user_reg_auth]==1 && sdcms[user_reg_type]!=2}
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">验证码：</label>
                            <div class="ui-col-5">
                                <div class="ui-input-group">
                                    <input type="text" name="code" id="code" class="ui-form-ip radius-right-none" placeholder="请输入验证码" data-rule="验证码:required;">
                                    <div class="code"><img src="{U('code')}" height="40" id="verify" title="点击更换验证码"></div>
                                </div>
                            </div>
                        </div>
                        {/if}
                        <div class="ui-form-group ui-row">
                            <div class="ui-col-5 ui-offset-2">
                                <label class="ui-checkbox"><input name="agree" type="checkbox" value="1" id="agreement" data-rule="用户协议:checked;"><i></i>已阅读并同意：</label><a href="javascript:;" rel="nofollow" class="ui-text-red ui-modal-show" data-target="#my-modal-agree">用户协议、隐私政策</a>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label"></label>
                            <div class="ui-col-5">
                            	<input type="hidden" name="token" value="{$token}">
                                <input type="submit" class="ui-btn ui-btn-blue" value="{if $ispai==1}注册新用户{else}注册{/if}">
                            </div>
                        </div>
                        </form>
                        <!--表单部分结束-->
                    </div>
                    <!--左侧结束-->
                </div>
                <div class="ui-col-4 ui-pr ui-pl-40 form-right">
                	<!--右侧开始-->
                    <h3>已有账户？</h3>
                    <a href="{N('login')}" class="ui-btn ui-btn-yellow">{if $ispai==1}绑定账户{else}立即登录{/if}</a>
                    {if $ispai==0 && (sdcms[api_qq_open]==1 || sdcms[api_weibo_open]==1 || sdcms[api_weixin_open]==1)}
                    <div class="quick">
                        <h3>快捷登录</h3>
                        {if sdcms[api_qq_open]==1}<a href="{WEB_URL}{WEB_ROOT}api/login/qq/api.php" title="QQ登录"><span class="ui-icon-qq blue"></span>QQ登录</a>{/if}
                        {if sdcms[api_weibo_open]==1}<a href="{WEB_URL}{WEB_ROOT}api/login/weibo/api.php" title="微博登录"><span class="ui-icon-weibo red"></span>微博登录</a>{/if}
                        {if sdcms[api_weixin_open]==1}<a href="{WEB_URL}{WEB_ROOT}api/login/weixin/api.php" title="微信登录"><span class="ui-icon-weixin green"></span>微信登录</a>{/if}
                    </div>
                    {/if}
                    <!--右侧结束-->
                </div>
            </div>
            <!--会员注册结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    <div class="ui-modal ui-modal-bg" id="my-modal-agree">
        <div class="ui-modal-header">
            <div class="ui-modal-title">用户协议</div>
        </div>
        <div class="ui-modal-body ui-height-30">{block("agreement")}</div>
        <div class="ui-modal-footer">
            <button class="ui-btn ui-modal-close ui-mr user-disagree">不同意</button>
            <button class="ui-btn ui-btn-blue user-agree">同意协议</button>
        </div>
    </div>
    
    {include file="foot.php"}
<script>
$(function()
{
	$(".user-disagree").click(function()
	{
		$("#agreement").prop("checked",false);
	});
	$(".user-agree").click(function()
	{
		$("#agreement").prop("checked",true);
		$("#my-modal-agree").modal('close');
	});
	{if sdcms[user_reg_auth]==1}
	$("#verify").click(function()
	{
		$(this).attr("src",$(this).attr("src")+"{iif(sdcms[url_mode]==1,"&","?")}rnd="+Math.round());
		$("#code").val("");
	});
	{/if}
	$(".after").click(function(event)
	{
		var that=$(this);
		var mobile=that.closest("form").find("[name=mobile]").val();
		if(mobile=='')
		{
			sdcms.warn('请输入手机号码');
			return false;
		}			
		var code='';
		{if sdcms[user_reg_auth]==1}
		var code=that.closest("form").find("[name=code]").val();
		if(code=='')
		{
			sdcms.warn('请输入验证码');
			return false;
		}
		{/if}
		$.ajax(
		{
			url:"{U('regcode')}",
			type:'post',
			cache:false,
			dataType:'json',
			data:'token={$token}&mobile='+encodeURIComponent(mobile)+'&code='+encodeURIComponent(code),
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					that.backtime();
					sdcms.success(d.msg);
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		});
		
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
						setTimeout(function(){location.href='{$lasturl}';},1500);
					}
					else
					{
						{if sdcms[user_reg_auth]==1}$("#verify").click();{/if}
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