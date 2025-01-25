<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{if strlen($seo_title)>0}{$seo_title}{else}{$name}_{if $page>1}第{$page}页_{/if}{sdcms[web_name]}{/if}</title>
    <meta name="keywords" content="{if strlen($seo_key)>0}{$seo_key}{else}{$name}{/if}">
    <meta name="description" content="{if strlen($seo_desc)>0}{$seo_desc}{else}{$name}{/if}">
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
                    <li>品牌介绍</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--品牌专区开始-->
            <div class="box-base">
            	<div class="ui-menu ui-menu-blue">
                	<div class="ui-menu-name">{$name}</div>
                    {if strlen($url)}
                    <div class="ui-menu-more"><a href="{$url}" target="_blank"><i class="ui-icon-link ui-mr-sm ui-text-gray"></i>访问官网</a></div>
                    {/if}
                </div>
                
                <div class="brand-show">{$intro}</div>
                
            </div>
            
            <!--商品部分开始-->
            <div class="goodlist">
            	<div class="ui-piclist ui-piclist-1-1 ui-piclist-col-5 ui-piclist-100 buyaction">
                	{sdcms:rs pagesize="$pagenum" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="$where" order="ordnum desc,id desc"}
                    {php $activity=$rs[is_activity]}
                    <div class="ui-piclist-item">
                        <div class="ui-piclist-image">
                        <a href="{$rs[link]}" title="{$rs[title]}" target="_blank"><img data-original="{thumb($rs[pic],300,300)}" src="/public/images/spacer.gif" alt="{$rs[title]}"></a>
                        {if $activity>0}{if $activity==1}<em>限时优惠</em>{else}<em class="bg-yellow">限时拼团</em>{/if}{/if}{if $rs[ispresale]==1}<em>预售</em>{/if}
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