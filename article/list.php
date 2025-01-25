<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{if strlen($cate_title)>0}{$cate_title}_{/if}{$cate_name}_{if $page>1}第{$page}页_{/if}{sdcms[web_name]}</title>
    <meta name="keywords" content="{if strlen($cate_key)>0}{$cate_key}{else}{$cate_name}{/if}">
    <meta name="description" content="{if strlen($cate_desc)>0}{$cate_desc}{else}{$cate_name}{/if}">
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
                    <li>列表</li>
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
                        <ul class="ui-media-list ui-mt-15 ui-mb-15">
                        	{sdcms:rs pagesize="$cate_page" table="sd_article" where="$where" order="ordnum desc,id desc"}
                            <li class="ui-media">
                                <div class="ui-media-body">
                                    <div class="ui-media-header ui-text-hide"><a href="{$rs[link]}" title="{$rs[title]}" target="_blank" style="font-weight:bold;">{$rs[title]}</a></div>
                                    <div class="ui-media-text ui-text-gray">{cutstr(nohtml($rs[intro]),300,1)}</div>
                                    <div class="ui-media-other"><span class="ui-icon-time-circle ui-mr"></span>{date('Y-m-d',$rs[createdate])}</div>
                                </div>
                                {if $rs[ispic]==1}
                                <div class="ui-media-img ui-ml-20">
                                    <a href="{$rs[link]}" title="{$rs[title]}" target="_blank"><img src="{$rs[pic]}" width="120" height="100" alt="{$rs[title]}"></a>
                                </div>
                                {/if}
                            </li>
                            {/sdcms:rs}
                        </ul>
                        <div class="ui-page ui-page-center"><ul>{$showpage}</ul></div>
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