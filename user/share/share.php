<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>我的分销</title>
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
                    <li>我的分销</li>
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
                        <div class="ui-menu-name">我的分销</div>
                    </div>
                    {if C('shop_share')>1}
                    <div class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                        <a class="ui-btn-group-item{if $type==1} active{/if}" href="{N('myshare','','type=1')}">一级分销</a>
						{if C('shop_share')>1}<a class="ui-btn-group-item{if $type==2} active{/if}" href="{N('myshare','','type=2')}">二级分销</a>{/if}
                        {if C('shop_share')>2}<a class="ui-btn-group-item{if $type==3} active{/if}" href="{N('myshare','','type=3')}">三级分销</a>{/if}
                    </div>
					{/if}

                    <table class="ui-table ui-table-border ui-table-hover ui-mt-15">
                        <thead class="ui-thead-gray">
                            <tr>
                                <th>昵称</th>
                                <th width="120">登录次数</th>
                                <th width="180">注册日期</th>
                            </tr>
                        </thead>
                        <tbody>
                        {sdcms:rs pagesize="20" table="sd_user" where="$where" order="id desc" key="id"}
                        {rs:eof}
                        <tr>
                            <td colspan="3">暂无记录</td>
                        </tr>
                        {/rs:eof}
                        <tr>
                            <td class="ui-text-left"><img src="{$rs[uface]}" width="30" height="30" class="ui-mr">{$rs[uname]}</td>
                            <td>{$rs[logintimes]}</td>
                            <td>{date('Y-m-d H:i:s',$rs[regdate])}</td>
                        </tr>
                        {/sdcms:rs}
                        </tbody>
                    </table>
                    <div class="ui-page ui-page-center ui-mt-15">
                    	<ul>{$showpage}</ul>
                    </div>

                    <div class="ui-menu ui-menu-blue ui-mt-15 ui-mb-20">
                        <div class="ui-menu-name">分销推广</div>
                    </div>
                    
                    <div class="ui-row">
                    	<div class="ui-col-3"><div class="qrcode ui-bd ui-p"></div></div>
                        <div class="ui-col-9 ui-pl-30">
                            <div class="ui-mb-20">
								<strong class="ui-text-red">操作提示：</strong>
								<div class="ui-pt ui-text-gray">您可以复制网址或将二维码分享给您的好友，好友注册后，成为您的分销商。<br>分销商购买商品并确认收货后，您将获得对应的推广收入。</div>
							</div>
							<div class="ui-form-group">
                            	<div class="ui-input-group">
                                	<input value="{WEB_URL}{N('reg','','uid='.$userid.'')}" id="copydata" readonly class="ui-form-ip radius-right-none">
                                    <a class="after ui-copy" data-target="#copydata">复制网址，发展分销商</a>
                                </div>
                            </div>
                        </div>
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
	$(".qrcode").html('<img src="{U('myshare','qrcode=1')}" width="216" height="220">');
})
</script>
</body>
</html>