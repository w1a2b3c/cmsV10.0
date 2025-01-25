<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{if strlen($seo_title)>0}{$seo_title}{else}{$title}_{if $page>1}第{$page}页_{/if}{$cate_name}_{sdcms[web_name]}{/if}</title>
    <meta name="keywords" content="{if strlen($seo_key)>0}{$seo_key}{else}{$title}{/if}">
    <meta name="description" content="{if strlen($seo_desc)>0}{$seo_desc}{else}{$title}{/if}">
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
                    {foreach $position as $rs}
                    <li><a href="{$rs['url']}" title="{$rs['name']}">{$rs['name']}</a></li>
                    {/foreach}
                    <li>内容</li>
                </ul>
            </div>
            <!--面包屑导航结束-->

            <div class="artcile">
            	<div class="artcile-left">
                	<div class="box ui-pt">
                    	<div class="ui-menu ui-menu-blue">
                        	<div class="ui-menu-name">栏目分类</div>
                        </div>
                        <div class="ui-box-nav ui-collapse-menu menu-sub">
                            {sdcms:rp top="0" table="sd_article_class" where="followid=0" order="cate_order,cateid"}
                            {php $sub_sonid=$rp[cateid]}
                            {php $sub_num=get_sonid_num($rp[cateid],1)}
                            {rp:eof}
                            <div class="ui-collapse-menu-title active">
                                <a href="{THIS_LOCAL}">{get_catename($topid,1)}</a>
                            </div>
                            {/rp:eof}
                    
                            <div class="ui-collapse-menu-title {is_active($rp[cateid],$art_parentid,'active',1)}">
                                <a href="{article($rp[cateid],$rp[cate_url])}" title="{$rp[cate_name]}">{$rp[cate_name]}</a>{if $sub_num>0}<i class="ui-icon-right"></i>{/if}
                            </div>
                            {if $sub_num>0}
                            <div class="ui-collapse-menu-body {is_active($rp[cateid],$art_parentid,'show',1)}">
                                <ul>
                                    {sdcms:rs top="0" table="sd_article_class" where="followid=$sub_sonid" order="cate_order,cateid"}
                                    <li class="{is_active($rs[cateid],$art_parentid,'active')}"><a href="{article($rs[cateid],$rs[cate_url])}" title="{$rs[cate_name]}">{$rs[cate_name]}</a></li>
                                    {/sdcms:rs}
                                </ul>
                            </div>
                            {/if}
                            {/sdcms:rp}
                        </div>
                    </div>
                    
                    <div class="box ui-mt-20 ui-pt-15">
                    	<div class="ui-menu ui-menu-blue">
                        	<div class="ui-menu-name">热门文章</div>
                        </div>
                        <ul class="menu-list">
                        	{sdcms:rs top="10" table="sd_article" where="islock=1" order="hits desc,id desc"}
                            <li class="ui-text-hide"><a href="{$rs[link]}" title="{$rs[title]}">{$rs[title]}</a></li>
                            {/sdcms:rs}
                        </ul>
                    </div>
                    
                </div>
                
                <div class="artcile-right">
                	<div class="box ui-pt-15">
                    	<div class="ui-menu ui-menu-blue">
                        	<div class="ui-menu-name">{$cate_name}</div>
                        </div>
                        <!---->
                        <div class="article-show">
                        	<h1>{$title}</h1>
                            <div class="info">日期：{date('Y-m-d',$createdate)}　人气：{$hits}</div>
                            <div class="intro">
                                {if $view_lever<2}
                                	<div class="ui-dialog ui-dialog-tips">
                                        <div class="ui-dialog-header">
                                            <div class="ui-dialog-title">友情提示</div>
                                        </div>
                                        <div class="ui-dialog-body">
                                            <i class="ui-icon-warning-circle ui-text-red ui-mr ui-font-24"></i>{if $view_lever==0}您需要登陆后，才能继续查看内容。{else}您的账户权限不足，无法查看！{/if}
                                        </div>
                                        {if USER_ID==0}
                                        <div class="ui-dialog-footer">
                                            <a class="ui-btn ui-btn-blue ui-mr-sm" href="{N('login')}">登录</a>
                                            <a class="ui-btn" href="{N('reg')}">注册</a>
                                        </div>
                                        {/if}
                                    </div> 
                                {else}
                                    {$content}
                                {/if}
                            </div>
                            {if $pagenum>1}
                            <div class="ui-page ui-page-mid ui-page-center"><ul>{pagelist($page,$pagenum)}</ul></div>
                            {/if}
                        </div>
                        <!---->
                    </div>
                </div>
                
            </div>
                    
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
    
</body>
</html>