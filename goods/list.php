<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{if strlen($cate_title)>0}{$cate_title}_{/if}{$filter_key}{$cate_name}_{if $page>1}第{$page}页_{/if}{sdcms[web_name]}</title>
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
                    <li>商品列表</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--筛选开始-->
            <div class="ui-filter ui-mt-15">
            	<div class="ui-row">
                	<div class="ui-col-1 ui-filter-left">分类：</div>
                    <div class="ui-col-11 ui-filter-right">
                        {sdcms:rp top="0" table="sd_goods_class" where="followid=$classid" order="cate_order,cateid"}
                        {rp:eof}
                        {sdcms:rs top="0" table="sd_goods_class" where="followid=$followid" order="cate_order,cateid"}
                        <a href="{goods($rs[cateid],$rs[cate_url])}" title="{$rs[cate_name]}"{if $classid==$rs[cateid]} class="active"{/if}>{$rs[cate_name]}</a>
                        {/sdcms:rs}
                        {/rp:eof}
                        <a href="{goods($rp[cateid],$rp[cate_url])}" title="{$rp[cate_name]}"{if $classid==$rp[cateid]} class="active"{/if}>{$rp[cate_name]}</a>
                        {/sdcms:rp}
                    </div>
                </div>
            
                {if strlen($cate_filter_price) || $cate_brand!="0" || $cate_filter>0}
                <!--Filter Loop Begin-->
                {if $cate_brand!="0"}
                <div class="ui-row">
                	<div class="ui-col-1 ui-filter-left">品牌：</div>
                    <div class="ui-col-11 ui-filter-right ui-filter-right-image">
                    	<a href="{filter_url($classid,$cate_url,"brand=0&price=$price&filter=$filter")}"{if $brand==0} class="active"{/if}>全部</a>{foreach $filter_brand as $key=>$val}<a href="{filter_url($classid,$cate_url,"brand=".$val['id']."&price=$price&filter=$filter")}" class="image{if $brand==$val['id']} active{/if}"><img src="{$val['logo']}" alt="{$val['name']}" title="{$val['name']}"></a>{/foreach}
                    </div>
                </div>
                {/if}
                {if strlen($cate_filter_price)}
            	{php $filter_price=jsdecode($cate_filter_price)}
                <div class="ui-row">
                	<div class="ui-col-1 ui-filter-left">价格：</div>
                    <div class="ui-col-11 ui-filter-right">
                    	<a href="{filter_url($classid,$cate_url,"brand=$brand&price=0&filter=$filter")}"{if $price==0} class="active"{/if}>全部</a>
                        {foreach $filter_price as $key=>$val}
                        <a href="{filter_url($classid,$cate_url,"brand=$brand&price=$key&filter=$filter")}"{if $price==$key} class="active"{/if}>{$val['name']}</a>
                        {/foreach}
                    </div>
                </div>
                {/if}
                {if $cate_filter>0}
                	{foreach $filter_data as $key=>$val}
                    <div class="ui-row">
                        <div class="ui-col-1 ui-filter-left">{$key}：</div>
                        <div class="ui-col-11 ui-filter-right">
                            <a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=".filter_all($val,$filter)."")}" {filter_check($val,$filter)}>全部</a>
                            {foreach $val as $aa=>$bb}
                            <a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=".filter_join($val,$filter,$aa)."")}" {if in_array($aa,explode(',',$filter))}class="active"{/if}>{$bb}</a>
                            {/foreach}
                        </div>
                    </div>
                    {/foreach}
                {/if}
                {/if}
                <!--Filter Loop End-->
            </div>
            <!--筛选结束-->
            
            <!--排序开始-->
            <div class="ui-orderby ui-mt-15">
                <ul>
                    <li{if $order==0} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter")}">默认排序</a></li>
                    
                    {if !in_array($order,[1,2])}<li><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=1")}">销量</a></li>{/if}
                    {if $order==1}<li{if $order==1} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=2")}">销量<i class="ui-icon-down"></i></a></li>{/if}
                    {if $order==2}<li{if $order==2} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=1")}">销量<i class="ui-icon-up"></i></a></li>{/if}
                    
                    {if !in_array($order,[3,4])}<li><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=3")}">价格</a></li>{/if}
                    {if $order==3}<li{if $order==3} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=4")}">价格<i class="ui-icon-up"></i></a></li>{/if}
                    {if $order==4}<li{if $order==4} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=3")}">价格<i class="ui-icon-down"></i></a></li>{/if}
                    
                    {if !in_array($order,[5,6])}<li><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=5")}">日期</a></li>{/if}
                    {if $order==5}<li{if $order==5} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=6")}">日期<i class="ui-icon-down"></i></a></li>{/if}
                    {if $order==6}<li{if $order==6} class="active"{/if}><a href="{filter_url($classid,$cate_url,"brand=$brand&price=$price&filter=$filter&order=5")}">日期<i class="ui-icon-up"></i></a></li>{/if} 
                </ul>
            </div>
            <!--排序结束-->
            
            <!--商品部分开始-->
            <div class="goodlist">
            	<div class="ui-piclist ui-piclist-1-1 ui-piclist-col-5 ui-piclist-100 buyaction">
                	{sdcms:rs pagesize="$catepage" table="$table a left join sd_goods_data b on a.id=b.cid" where="$where" order="$orderby"}
                    {rs:eof}<div class="ui-font-16 ui-pt">没有找到您要的商品</div>{/rs:eof}
                    {php $activity=$rs[is_activity]}
                    <div class="ui-piclist-item">
                        <div class="ui-piclist-image">
                        <a href="{$rs[link]}" title="{$rs[title]}" target="_blank"><img data-original="{thumb($rs[pic],300,300)}" src="/public/images/spacer.gif" alt="{$rs[title]}"></a>
                        {if $activity>0}{if $activity==1}<em>限时优惠</em>{else}<em class="bg-yellow">限时拼团</em>{/if}{/if}{if $rs[ispresale]==1}<em class="bg-yellow">预售</em>{/if}
                        </div>
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
            </div>
            <!--商品部分结束-->
            
            <!--分页开始-->
            <div class="ui-page ui-page-mid ui-page-center">
                <ul>{$showpage}</ul>
            </div>
            <!--分页结束-->
            
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
    <script>
	$(function()
	{
		//菜单
		{if $classid==0}
		$(".nav_{md5_16(N('goods'))}").addClass("active");
		{else}
		$(".nav_{md5_16(gurl($classid))}").addClass("active");
		{/if}
	});
	</script>
</body>
</html>