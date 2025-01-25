<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>忘记密码_{sdcms[web_name]}</title>
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
                    <li>忘记密码</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--忘记密码开始-->
            <div class="box-base ui-row">
            	<div class="ui-col-8 ui-pl">
                	<!--左侧开始-->
                    <div class="ui-menu ui-menu-blue ">
                        <div class="ui-menu-name">忘记密码</div>
                    </div>
                    <div class="ui-pt-40">
                        <!--表单部分开始-->
                        <form method="post" class="ui-form ui-ml-40">
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">手机号：</label>
                            <div class="ui-col-5">
                                <input type="text" name="mobile" maxlength="11" class="ui-form-ip" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;ajax({U('checkgetpass')});"  data-token="{$token}">
                            </div>
                        </div>
                        {if sdcms[user_getpass_auth]==1}
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
                            <label class="ui-col-2 ui-col-form-label">短信验证码：</label>
                            <div class="ui-col-5">
                                <div class="ui-input-group">
                                    <input type="text" name="ecode" id="ecode" class="ui-form-ip radius-right-none" placeholder="请输入短信验证码" data-rule="短信验证码:required;">
                                    <button type="button" class="after">发送验证码</button>
                                </div>
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">新密码：</label>
                            <div class="ui-col-5">
                                <input type="password" name="password" id="password" autocomplete="off" class="ui-form-ip" placeholder="请输入新密码" data-rule="新密码:required;password;">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">确认密码：</label>
                            <div class="ui-col-5">
                                <input type="password" name="repass" class="ui-form-ip" autocomplete="off" placeholder="请再次输入密码" data-rule="确认密码:required;password;match(password)">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label"></label>
                            <div class="ui-col-5">
                            	<input type="hidden" name="token" value="{$token}">
                                <input type="submit" class="ui-btn ui-btn-blue" value="修改密码">
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
                    <a href="{N('login')}" class="ui-btn ui-btn-yellow">立即登录</a>
                    {if sdcms[api_qq_open]==1 || sdcms[api_weibo_open]==1 || sdcms[api_weixin_open]==1}
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
            <!--忘记密码结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script>
$(function()
{
	{if sdcms[user_getpass_auth]==1}
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
		{if sdcms[user_getpass_auth]==1}
		var code=that.closest("form").find("[name=code]").val();
		if(code=='')
		{
			sdcms.warn('请输入验证码');
			return false;
		}
		{/if}
		$.ajax(
		{
			url:"{U('getpasscode')}",
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
						setTimeout(function(){location.href='{N('login')}';},1500);
					}
					else
					{
						{if sdcms[user_getpass_auth]==1}$("#verify").click();{/if}
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