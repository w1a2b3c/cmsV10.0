<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>多人拼团_{sdcms[web_name]}</title>
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
                    <li><a href="{N('group')}">多人拼团</a></li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--拼团开始-->
            {sdcms:rg top="0" table="sd_market_group" where="group_open=1 and group_close=0" order="group_id desc"}
            {php $groupid=$rg[group_id]}
            <div class="home_title ui-row">
                <div class="ui-col-10">
                    <h2>{$rg[group_name]}</h2>
                    <div class="limit"><span class="ui-icon-time-circle"></span>剩余：<span class="ui-endtime" data-time="{$rg[group_over]}"></span></div>
                </div>
            </div>
            <!---->
            <div class="ui-piclist ui-piclist-1-1 ui-piclist-col-5 ui-piclist-100 ui-mt-30 buyaction">
                {sdcms:rs top="0" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="islock=1 and activity_id=$groupid and activity_type=2" order="ordnum desc,id desc"}
                <div class="ui-piclist-item">
                    <div class="ui-piclist-image"><a href="{$rs[link]}" title="{$rs[title]}"><img data-original="{thumb($rs[pic],300,300)}" src="/public/images/spacer.gif" alt="{$rs[title]}" /></a></div>
                    <div class="ui-piclist-body">
                        <div class="ui-piclist-title ui-text-hide"><a href="{$rs[link]}" title="{$rs[title]}">{$rs[title]}</a></div>
                        <div class="ui-piclist-flex">
                            <div class="ui-piclist-price"><strong>￥{getprice($rs[aprice])}</strong><del>￥{getprice($rs[vprice])}</del></div>
                            <div class="action" data-id="{$rs[id]}" data-sku="{strlen($rs[sku])}" data-url="{U('index/goodssku','id='.$rs[id].'')}"><a href="javascript:;" class="ui-btn ui-btn-blue">购买</a></div>
                        </div>
                    </div>
                </div>
                {/sdcms:rs}
            </div>
            <!---->
            {/sdcms:rg}
            <!--拼团结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script>
$(function()
{
	//菜单
	$(".nav_{md5_16(N('group'))}").addClass("active");
	//倒计时插件，支持自定义回调
	$(".ui-endtime").endtime(function(e)
	{
		$(e).html('结束了');
	});
});
</script>
</body>
</html>