<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>会员登录_{sdcms[web_name]}</title>
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
                    <li>会员登录</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--会员登录开始-->
            <div class="box-base ui-row min-400">
            	<div class="ui-col-8 ui-pl">
                	<!--左侧开始-->
                    <div class="ui-menu ui-menu-blue ">
                        <div class="ui-menu-name">{if $ispai==1}账户绑定{else}会员登录{/if}</div>
                    </div>
                    <div class="ui-pt-40">
                        {if $ispai==1}
                        <div class="api_user"><span>{$api_info.nickname}</span>，请完成账户绑定，如还没有账户，请先完善资料。　【<a href="{U('user/apiout')}">退出</a>】</div>
                        {/if}
                        <!--表单部分开始-->
                        <form method="post" class="ui-form ui-ml-40">
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">手机号：</label>
                            <div class="ui-col-5">
                                <input type="text" name="mobile" maxlength="11" class="ui-form-ip" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;">
                            </div>
                        </div>
                        <div class="ui-form-group ui-row">
                            <label class="ui-col-2 ui-col-form-label">密码：</label>
                            <div class="ui-col-5">
                            	<div class="ui-input-group">
                                	<input type="password" name="password" autocomplete="off" class="ui-form-ip radius-right-none" placeholder="请输入密码" data-rule="密码:required;password;">
                                    <div class="after"><a href="{N('getpass')}" class="pl pr" tabindex="-1">忘记密码</a></div>
                                </div>
                            </div>
                        </div>
                        {if sdcms[user_login_auth]==1}
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
                            <label class="ui-col-2 ui-col-form-label"></label>
                            <div class="ui-col-5">
                                <input type="hidden" name="token" value="{$token}">
                                <input type="submit" class="ui-btn ui-btn-blue" value="{if $ispai==1}确定绑定{else}登录{/if}">
                            </div>
                        </div>
                        </form>
                        <!--表单部分结束-->
                    </div>
                    <!--左侧结束-->
                </div>
                <div class="ui-col-4 ui-pr ui-pl-40 form-right">
                	<!--右侧开始-->
                    <h3>没有账户？</h3>
                    <a href="{N('reg')}" class="ui-btn ui-btn-yellow">{if $ispai==1}完善资料{else}立即注册{/if}</a>
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
            <!--会员登录结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script>
$(function()
{
	{if sdcms[user_login_auth]==1}
	$("#verify").click(function()
	{
		$(this).attr("src",$(this).attr("src")+"{iif(sdcms[url_mode]==1,"&","?")}rnd="+Math.round());
		$("#code").val("");
	});
	{/if}
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
						{if sdcms[user_login_auth]==1}$("#verify").click();{/if}
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