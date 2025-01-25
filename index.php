<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{if strlen(sdcms[seo_title])>0}{sdcms[seo_title]}{else}{sdcms[web_name]}{/if}</title>
    <meta name="keywords" content="{sdcms[seo_key]}">
    <meta name="description" content="{sdcms[seo_desc]}">
    <link rel="shortcut icon" href="/favicon.ico"/>
	<link rel="bookmark" href="/favicon.ico"/>
</head>

<body>
	{include file="head.php"}

    <div class="ui-carousel banner">
        <div class="ui-carousel-inner">
        	{sdcms:rs table="sd_ad" where="akey='pc' and islock=1"}
            {php $adlist=jsdecode($rs[datalist],1)}
            {if is_array($adlist)}
            	{php $step=0}
                {foreach $adlist as $num=>$val}
                    <div class="ui-carousel-item{if $step==0} active{/if}"><a style="background:url('{$val['image']}') no-repeat center;" href="{$val['url']}" title="{$val['desc']}"></a></div>
                {php $step++}
                {/foreach}
            {else}
                <div class="ui-carousel-item active"><a style="background:url('/upfile/pc/1.jpg') no-repeat center;"></a></div>
                <div class="ui-carousel-item"><a style="background:url('/upfile/pc/2.jpg') no-repeat center;"></a></div>
                <div class="ui-carousel-item"><a style="background:url('/upfile/pc/3.jpg') no-repeat center;"></a></div>
            {/if}
            {/sdcms:rs}
        </div>

        <div class="bslide">
    		<div class="width ui-row">
            	<div class="ui-col-3 userinfo">
                	<div class="face"><img src="{if USER_ID==0}{C('user_default_face')}{else}{get_user_info('uface')}{/if}"></div>
                    <div class="logintxt">
                    	{if USER_ID==0}
                        Hi，{hello_world()}
                        <p><a href="{N('reg')}">注册用户</a><a href="{N('login')}">用户登录</a></p>
                        {else}
                        {cutstr(get_user_info('uname'),16,1)}，{hello_world()}
                        <p><a href="{N('user')}">会员中心</a><a href="{N('myorder')}">我的订单</a></p>
                        {/if}
                    </div>
                </div>
                <div class="ui-col-5 ui-row icon">
                    <div class="ui-col-3"><a><i class="ui-icon-zheng"></i>正品行货</a></div>
                    <div class="ui-col-3"><a><i class="ui-icon-sheng"></i>天天低价</a></div>
                    <div class="ui-col-3"><a><i class="ui-icon-qi"></i>七天包退</a></div>
                    <div class="ui-col-3"><a><i class="ui-icon-kuai"></i>极速配送 </a></div>
                </div>
                <div class="ui-col-4">
                    <div class="ui-menu ui-menu-blue ui-mt">
                        <div class="ui-menu-name">商城动态</div>
                        <div class="ui-menu-more"><a href="{aurl(1)}">更多</a></div>
                    </div>
                    <div class="ui-scroll" data-time="5">
                        <ul class="ui-list">
                        	{php $sonid=article_sonid(1)}
                            {sdcms:rs top="8" table="sd_article" where="classid in($sonid) and islock=1" order="ordnum desc,id desc"}
                            <li><a href="{$rs[link]}" title="{$rs[title]}" class="ui-text-hide">{$rs[title]}</a></li>
                            {/sdcms:rs}
                        </ul>
                    </div>
                </div>
            </div>
    	</div>
    </div>

    <div class="bg_body">   
        <div class="width">
        	{sdcms:rg top="10" table="sd_market_limit" where="limit_open=1 and limit_close=0" order="limit_id desc"}
            {php $limitid=$rg[limit_id]}
            <div class="home_title ui-row">
                <div class="ui-col-10">
                    <h2>{$rg[limit_name]}</h2>
                    <div class="limit"><span class="ui-icon-time-circle"></span>剩余：<span class="ui-endtime" data-time="{$rg[limit_over]}"></span></div>
                </div>
                <div class="ui-col-2 ui-text-right more"><a href="{N('limit')}">更多<span class="ui-icon-more"></span></a></div>
            </div>
            <!---->
            <div class="ui-piclist ui-piclist-1-1 ui-piclist-col-5 ui-piclist-100 buyaction ui-mt-20">
                {sdcms:rs top="10" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="islock=1 and activity_id=$limitid and activity_type=1" order="ordnum desc,id desc"}
                <div class="ui-piclist-item">
                    <div class="ui-piclist-image"><a href="{$rs[link]}" title="{$rs[title]}"><img data-original="{thumb($rs[pic],300,300)}" src="/public/images/spacer.gif" alt="{$rs[title]}" /></a></div>
                    <div class="ui-piclist-body">
                        <div class="ui-piclist-title ui-text-hide"><a href="{$rs[link]}" title="{$rs[title]}">{$rs[title]}</a></div>
                        <div class="ui-piclist-flex">
                            <div class="ui-piclist-price"><strong>￥{getprice($rs[aprice])}</strong><del>￥{getprice($rs[vprice])}</del></div>
                            <div class="action" data-id="{$rs[id]}" data-sku="{strlen($rs[sku])}" data-url="{U('index/goodssku','id='.$rs[id].'')}"><a href="javascript:;" rel="nofollow" class="ui-btn ui-btn-blue">购买</a></div>
                        </div>
                    </div>
                </div>
                {/sdcms:rs}
            </div>
            <!---->
			{/sdcms:rg}
        </div>
        
        
        {sdcms:rp top="10" table="sd_goods_class" where="followid=0 and cate_nice=1" order="cate_order,cateid" auto="j"}
        {php $pid=$rp[cateid]}
        {php $sonid=goods_sonid($pid)}
        {php $subid=deal_subid($sonid)}
        <div class="width">
            <!---->
            <div class="ui-tabs home_goods" data-type="hover">
                <div class="ui-tabs-header-subject">
                    <div class="ui-tabs-header-title">{$j}F {$rp[cate_name]}</div>
                    <ul class="ui-tabs-nav">
                        <li class="active"><a href="{goods($rp[cateid],$rp[cate_url])}"><!--{$rp[cate_name]}-->推荐</a></li>
                        {sdcms:rs top="5" table="sd_goods_class" where="followid=$pid" order="cate_order,cateid"}
                        <li><a href="{goods($rs[cateid],$rs[cate_url])}">{$rs[cate_name]}</a></li>
                        {/sdcms:rs}
                    </ul>
                </div>
                <div class="ui-tabs-body">
                    <div class="ui-tabs-body-left">
                    	{php $cate_ad=jsdecode($rp[cate_ad])}
                        {if is_array($cate_ad)}
                            {if count($cate_ad)==1}
                            {foreach $cate_ad as $num=>$val}
                            <a href="{$val['url']}" target="_blank" style="margin:14px 0 15px 15px;display:block;"><img data-original="{$val['image']}" src="/public/images/spacer.gif" alt="{$val['desc']}" width="235" height="679"></a>
                            {/foreach}
                            {else}
                            	{php $step=0}
                                <ul class="home_goods_nice">
                                {foreach $cate_ad as $num=>$val}
                                	{if $step<2}
                                	<li><a href="{$val['url']}" target="_blank"><img data-original="{$val['image']}" src="/public/images/spacer.gif" alt="{$val['desc']}" ></a></li>
                                    {/if}
                                    {php $step++}
                                {/foreach}
                                </ul>
                            {/if}
                        {/if}
                    </div>
                    <div class="ui-tabs-content">
                        <div class="ui-tabs-pane active">
                            <!--pro start-->
                            <div class="ui-piclist ui-piclist-1-1 ui-piclist-col-4 ui-piclist-100 buyaction">
                                {sdcms:rs top="8" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="islock=1 and (classid in($sonid) $subid) and isnice=1" order="ordnum desc,id desc"}
                                {php $activity=$rs[is_activity]}
                                <div class="ui-piclist-item">
                                    <div class="ui-piclist-image"><a href="{$rs[link]}" title="{$rs[title]}"><img data-original="{thumb($rs[pic],300,300)}" src="/public/images/spacer.gif" alt="{$rs[title]}" /></a>{if $activity>0}{if $activity==1}<em>限时优惠</em>{else}<em class="bg-yellow">限时拼团</em>{/if}{/if}{if $rs[ispresale]==1}<em class="bg-yellow">预售</em>{/if}</div>
                                    <div class="ui-piclist-body">
                                        <div class="ui-piclist-title ui-text-hide"><a href="{$rs[link]}" title="{$rs[title]}">{$rs[title]}</a></div>
                                        <div class="ui-piclist-flex">
                                        	<div class="ui-piclist-price"><strong>{if $rs[types]==2}{$rs[point]}积分{else}￥{getprice($rs[vprice])}{/if}</strong><del>￥{getprice($rs[dprice])}</del></div>
                                            <div class="action" data-id="{$rs[id]}" data-sku="{strlen($rs[sku])}" data-url="{U('index/goodssku','id='.$rs[id].'')}">
                                                <a href="javascript:;" rel="nofollow" class="ui-btn ui-btn-blue">{if $rs[types]==2}兑换{else}购买{/if}</a>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/sdcms:rs}
                            </div>
                            <!--pro end-->
                        </div>
                        {sdcms:rc top="5" table="sd_goods_class" where="followid=$pid" order="cate_order,cateid"}
                        {php $sonid=goods_sonid($rc[cateid])}
                        {php $subid=deal_subid($sonid)}
                        <div class="ui-tabs-pane">
                            <!--pro start-->
                            <div class="ui-piclist ui-piclist-1-1 ui-piclist-col-4 ui-piclist-100 buyaction">
                                {sdcms:rg top="8" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="islock=1 and (classid in($sonid) $subid)" order="ordnum desc,id desc"}
                                {php $activity=$rg[is_activity]}
                                <div class="ui-piclist-item">
                                    <div class="ui-piclist-image"><a href="{$rg[link]}" title="{$rg[title]}"><img data-original="{thumb($rg[pic],300,300)}" src="/public/images/spacer.gif" alt="{$rg[title]}" /></a>{if $activity>0}{if $activity==1}<em>限时优惠</em>{else}<em class="bg-yellow">限时拼团</em>{/if}{/if}{if $rg[ispresale]==1}<em class="bg-yellow">预售</em>{/if}</div>
                                    <div class="ui-piclist-body">
                                        <div class="ui-piclist-title ui-text-hide"><a href="{$rg[link]}" title="{$rg[title]}">{$rg[title]}</a></div>
                                        <div class="ui-piclist-flex">
                                            <div class="ui-piclist-price"><strong>{if $rg[types]==2}{$rg[point]}积分{else}￥{getprice($rg[vprice])}{/if}</strong><del>￥{getprice($rg[dprice])}</del></div>
                                            <div class="action" data-id="{$rg[id]}" data-sku="{strlen($rg[sku])}" data-url="{U('index/goodssku','id='.$rg[id].'')}">
                                                <a href="javascript:;" rel="nofollow" class="ui-btn ui-btn-blue">{if $rg[types]!=2}购买{else}兑换{/if}</a>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {/sdcms:rg}
                            </div>
                            <!--pro end-->
                        </div>
                        {/sdcms:rc}
                        
                    </div>
               </div>
            </div>
            <!---->
        </div>
        {/sdcms:rp}
        
        {sdcms:rs top="0" table="sd_link" where="islock=1" order="ordnum,id"}
        {rs:head}
        <div class="width frinedlink">
        	<div class="ui-menu ui-menu-blue ui-mb-15"><div class="ui-menu-name">友情链接</div></div>
        {/rs:head}    
            <a href="{$rs[weburl]}" title="{$rs[webname]}" target="_blank">{$rs[webname]}</a>
        {rs:foot}
        </div>{/rs:foot}
        {/sdcms:rs}
    </div>
    {include file="foot.php"}
    
<script>
$(function()
{
	//首页菜单
	$(".topnav .navs li").eq(0).addClass("active");
	//倒计时插件，支持自定义回调
	$(".ui-endtime").endtime(function(e)
	{
		$(e).html('结束了');
	});
});
</script>
</body>
</html>