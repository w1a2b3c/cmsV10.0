<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>修改密码</title>
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
                    <li>修改密码</li>
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
                        <div class="ui-menu-name">修改密码</div>
                    </div>
                    
                    <!--表单部分开始-->
                    {if $isempty==0}
                    <form method="post" class="ui-form ui-mt-40">
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">原密码：</label>
                        <div class="ui-col-5">
                            <input type="password" name="oldpass" autocomplete="off" class="ui-form-ip" placeholder="请输入原密码" data-rule="原密码:required;password;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">新密码：</label>
                        <div class="ui-col-5">
                            <input type="password" name="newpass" autocomplete="off" id="newpass" class="ui-form-ip" placeholder="请输入新密码" data-rule="新密码:required;password;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">确认新密码：</label>
                        <div class="ui-col-5">
                            <input type="password" name="repass" autocomplete="off" class="ui-form-ip" placeholder="请再次输入新密码" data-rule="确认新密码:required;password;match(newpass)">
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
                    {else}
                    <form method="post" class="ui-form mt-40">
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">密码：</label>
                        <div class="ui-col-5">
                            <input type="password" name="newpass" id="newpass" class="ui-form-ip" placeholder="请输入密码" data-rule="密码:required;password;">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label">确认密码：</label>
                        <div class="ui-col-5">
                            <input type="password" name="repass" class="ui-form-ip" placeholder="请再次输入密码" data-rule="确认密码:required;password;match(newpass)">
                        </div>
                    </div>
                    <div class="ui-form-group ui-row">
                        <label class="ui-col-2 ui-col-form-label"></label>
                        <div class="ui-col-5">
                        	<input type="hidden" name="token" value="{$token}">
                            <input type="submit" class="ui-btn ui-btn-blue" value="保存密码">
                            <div class="ui-text-red ui-p-15 ui-mt-15">您还没有设置密码，请先设置密码。</div>
                        </div>
                    </div>
                    </form>
                    {/if}
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
                    url:'{if $isempty==0}{THIS_LOCAL}{else}{U("newpass")}{/if}',
                    data:$(form).serialize(),
                    error:function(e){alert(e.responseText);},
                    success:function(d)
                    {
                        if(d.state=='success')
                        {
                            sdcms.success(d.msg);
                            setTimeout(function(){location.href='{THIS_LOCAL}';},1500);
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