<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{$seo_title}</title>
    <meta name="keywords" content="{$seo_key}">
    <meta name="description" content="{$seo_desc}">
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
                    <li>Tags标签</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--begin-->
            <div class="ui-menu ui-menu-blue ui-mb-20 ui-mt-20">
                <div class="ui-menu-name">{$page_name}</div>
            </div>
            <div class="ui-mb-20">
                {sdcms:rs pagesize="100" table="sd_tags" where="hits>0" order="id desc"}
                <a href="{U('tags','id='.$rs[id].'')}" data-title="{$rs[title]}" target="_blank" class="ui-mb ui-mr ui-btn ui-tips">{$rs[title]}</a>
                {/sdcms:rs}
                
                {if $pg->totalpage>1}
                <div class="ui-page ui-page-center ui-page-mid ui-mt-20"><ul>{$showpage}</ul></div>
                {/if}
            </div>
            <!--over-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
</body>
</html>