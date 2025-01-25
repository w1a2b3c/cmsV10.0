<?php if(!defined('IN_B2C')) exit;?>{if count($cart)==0}
<p>您的购物车是空的，请去挑选您的商品！</p>
{else}
	{php $num=0;}
    {php $total=0;}
<ul>
	{foreach $cart as $key=>$rs}
    {php $num++;}
    {php $total+=($rs['price']*$rs['buynum'])}
    {if $rs['issuit']==0}
    <li>
        <div class="image"><img src="{thumb($rs['pic'],40,40)}" width="40" /></div>
        <div class="name"><a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank">{$rs['title']}</a><br><span class="ui-text-gray ui-mt-sm">{$rs['skuname']}</span><br>
                                {if $rs['islock']<1}<span class="ui-btn ui-btn-red ui-btn-lt ui-mt-sm">商品已下架</span>{/if}
                                {if $rs['isgift']!=0}<span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}</div>
        <div class="price">￥<span>{getprice($rs['price'])}</span><br /> × <span>{$rs['buynum']}</span><a href="javascript:;" class="mincart-del" data-token="{$token}" data-url="{U('cart/del')}" data-id="{$rs['cartid']}">删除</a></div>
    </li>
    {else}
    <li>
        <div class="image"><img src="{thumb($rs['pic'],40,40)}" width="40" /></div>
        <div class="name"><a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank">{$rs['suitname']}</a></div>
        <div class="price">￥<span>{getprice($rs['price'])}</span><br /> × <span>{$rs['buynum']}</span><a href="javascript:;" class="mincart-del" data-token="{$token}" data-url="{U('cart/del')}" data-id="{$rs['cartid']}">删除</a></div>
    </li>
	{/if}
    {/foreach}
</ul>
<div class="action">
    <div class="total"><span>{$num}</span>件商品，共计：<span>{getprice($total)}</span>元</div>
    <div class="go"><a href="{N('cart')}" class="ui-btn ui-btn-blue ui-btn-sm">查看购物车</a></div>
</div>
{/if}