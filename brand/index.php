<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>品牌专区_{if $num>0}{$num}_{/if}{sdcms[web_name]}</title>
    <meta name="keywords" content="{sdcms[seo_key]}">
    <meta name="description" content="{sdcms[seo_desc]}">
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
                    <li><a href="{N('brand')}">品牌专区</a></li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--品牌专区开始-->
            <div class="ui-filter ui-mt-15">
            	<div class="ui-row">
                	<div class="ui-col-1 ui-filter-left">按字母：</div>
                    <div class="ui-col-11 ui-filter-right">
                    	<a href="{N('brand')}" {if 0==$num} class="active"{/if}>全部</a>
                        {foreach $letter as $key=>$val}
                        <a href="{N('brand','','num='.$key.'')}" title="{$val}" {if $key==$num} class="active"{/if}>{$val}</a>
                        {/foreach}
                    </div>
                </div>
            </div>
            
            <div class="brand-list">
            	<ul>
                	{sdcms:rs top="0" table="sd_goods_brand" where="$where" order="ordernum,id"}
                	<li><a href="{N('brandshow','','id='.$rs[id].'')}" target="_blank" title="{$rs[name]}"><img src="{$rs[logo]}" width="100" height="50" alt="{$rs[name]}"><div class="name">{$rs[name]}</div></a></li>
                    {/sdcms:rs}
                </ul>
            </div>
            
            <!--品牌专区结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script>
$(function()
{
	//菜单
	$(".nav_{md5_16(N('brand'))}").addClass("active");
})
</script>
</body>
</html>