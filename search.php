<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{$keyword}_{if $page>1}第{$page}页_{/if}{sdcms[web_name]}</title>
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
                    <li>商品搜索</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--排序开始-->
            <div class="ui-orderby ui-mt">
                <ul>
                    <li{if $order==0} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'')}">默认排序</a></li>
                    
                    {if !in_array($order,[1,2])}<li><a href="{N('search','','keyword='.urlencode($keyword).'&order=1')}">按销量</a></li>{/if}
                    {if $order==1}<li{if $order==1} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'&order=2')}">按销量<i class="ui-icon-down"></i></a></li>{/if}
                    {if $order==2}<li{if $order==2} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'&order=1')}">按销量<i class="ui-icon-up"></i></a></li>{/if}
                    
                    {if !in_array($order,[3,4])}<li><a href="{N('search','','keyword='.urlencode($keyword).'&order=3')}">按价格</a></li>{/if}
                    {if $order==3}<li{if $order==3} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'&order=4')}">按价格<i class="ui-icon-up"></i></a></li>{/if}
                    {if $order==4}<li{if $order==4} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'&order=3')}">按价格<i class="ui-icon-down"></i></a></li>{/if}
                    
                    {if !in_array($order,[5,6])}<li><a href="{N('search','','keyword='.urlencode($keyword).'&order=5')}">按日期</a></li>{/if}
                    {if $order==5}<li{if $order==5} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'&order=6')}">按日期<i class="ui-icon-down"></i></a></li>{/if}
                    {if $order==6}<li{if $order==6} class="active"{/if}><a href="{N('search','','keyword='.urlencode($keyword).'&order=5')}">按日期<i class="ui-icon-up"></i></a></li>{/if}
                </ul>
            </div>
            <!--排序结束-->
            
            <!--商品部分开始-->
            <div class="goodlist">
            	<div class="ui-piclist ui-piclist-1-1 ui-piclist-col-5 ui-piclist-100 buyaction">
                    {sdcms:rs pagesize="20" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="$where" order="$orderby"}
                    {rs:eof}<div class="font-14 pt">没有找到含有【<span class="ui-text-red">{$keyword}</span>】的商品</div>{/rs:eof}
                    {php $is_activity=$rs[is_activity]}
                    <div class="ui-piclist-item">
                        <div class="ui-piclist-image">
                        <a href="{$rs[link]}" title="{$rs[title]}" target="_blank"><img data-original="{$rs[pic]}" src="/public/images/spacer.gif" alt="{$rs[title]}" /></a>
                        {if $is_activity>0}
                            {if $is_activity==1}<em>限时优惠</em>{else}<em class="bg-yellow">限时拼团</em>{/if}
                        {/if}
                        </div>
                        <div class="ui-piclist-body">
                            <div class="ui-piclist-title ui-text-hide"><a href="{$rs[link]}" title="{$rs[title]}">{str_replace($keyword,"<font color=red>$keyword</font>",$rs[title])}</a></div>
                            <div class="ui-piclist-flex">
                                <div class="ui-piclist-price"><strong>{if $rs[types]==2}{$rs[point]}积分{else}￥{getprice($rs[vprice])}{/if}</strong><del>￥{getprice($rs[dprice])}</del></div>
                                <div class="action" data-id="{$rs[id]}" data-sku="{strlen($rs[sku])}" data-url="{U('index/goodssku','id='.$rs[id].'')}">
                                	<a href="javascript:;" class="ui-btn ui-btn-blue">{if $rs[types]==2}兑换{else}购买{/if}</a>                           
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
</body>
</html>