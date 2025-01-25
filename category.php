<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>商品分类_{sdcms[web_name]}</title>
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
                    <li>商品分类</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--商品分类开始-->
            <div class="ui-filter ui-mt-15">
                
                {sdcms:rp top="0" table="sd_goods_class" where="followid=0" order="cate_order,cateid"}
                {php $one_sonid=$rp[cateid]}
                <div class="ui-menu ui-menu-blue ui-ml-20 ui-mt-20"><div class="ui-menu-name"><a href="{goods($rp[cateid],$rp[cate_url])}" title="{$rp[cate_name]}">{$rp[cate_name]}</a></div></div>
                {sdcms:rs top="0" table="sd_goods_class" where="followid=$one_sonid" order="cate_order,cateid"}
                {php $two_sonid=$rs[cateid]}
                <div class="ui-row ui-pt-sm">
                    <div class="ui-col-1 ui-filter-left"><a href="{goods($rs[cateid],$rp[cate_url])}" title="{$rs[cate_name]}">{$rs[cate_name]}</a>：</div>
                    <div class="ui-col-11 ui-filter-right">
                    	{sdcms:rt top="0" table="sd_goods_class" where="followid=$two_sonid" order="cate_order,cateid"}
                        <a href="{goods($rt[cateid],$rt[cate_url])}" title="{$rt[cate_name]}">{$rt[cate_name]}</a>
                        {/sdcms:rt}
                    </div>
                </div>
                {/sdcms:rs}
                {/sdcms:rp}

            </div>
            <!--商品分类结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
</body>
</html>