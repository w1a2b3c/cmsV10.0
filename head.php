<?php if(!defined('IN_B2C')) exit;?>	<div class="ui-topbar">
    	<div class="width ui-row">
        	<div class="ui-col-6">{if $site_isopen==1 && sdcms[city_open]==1}【<span class="ui-text-red">{$cityname}</span>】<a href="{N('city')}">城市切换<span class="ui-icon-down ui-ml-sm ui-font-16"></span></a>{else}{sdcms[ct_company]}欢迎您！{/if}</div>
            <div class="ui-col-6 ui-text-right">
            	<nav class="ui-nav">
                	<ul>
						{if sdcms[shop_other_nologin]==1 && USER_ID==0}<li><a href="javascript:;" class="ordersearch" data-token="{$token}" data-url="{U('other/order')}" rel="nofollow">订单查询</a></li>{/if}
                    	{if USER_ID==0}
                    	<li><a href="{N('login')}">请登录</a></li>
                        <li><a href="{N('reg')}">免费注册</a></li>
                        {else}
                        <li><a>{get_user_info('uname')}</a></li>
                        <li><a href="{N('user')}">会员中心<span class="ui-icon-down"></span></a>
                            <ul>
                                <li><a href="{N('myorder')}">我的订单</a></li>
                                <li><a href="{N('mycoupon')}">我的优惠券</a></li>
                                <li><a href="{N('myfavorite')}">我的收藏</a></li>
                                <li><a href="{N('out')}">退出登录</a></li>
                            </ul>
                        </li>
                        {/if}
                        {if sdcms[mobile_open]==1 && !isempty(sdcms[mobile_domain])}<li><a href="{sdcms[mobile_http]}{sdcms[mobile_domain]}" target="_blank">手机站</a></li>{/if}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="header width ui-row">
        <div class="ui-col-3 logo">
        	<a href="{WEB_ROOT}"><img src="{sdcms[web_logo]}" alt="{sdcms[web_name]}"></a>
        </div>
        <div class="ui-col-6 search">
            <form class="ui-form-search" action="{N('search')}" method="post" onSubmit="return checksearch(this)">
            <div class="ui-form-group">
                <div class="ui-input-group">
                	{if !isempty(sdcms[pathinfo]) && sdcms[url_mode]>1}<input type="hidden" name="s" value="search{sdcms[url_ext]}" />{/if}
                	{if sdcms[url_mode]==1}<input type="hidden" name="c" value="other" /><input type="hidden" name="a" value="search" />{/if}
                    <input type="hidden" name="token" value="{$token}">
                    <input type="text" name="keyword" class="ui-form-ip radius-right-none" placeholder="请输入关键字">
                    <button type="submit" class="after"><div class="ui-icon-search"></div></button>
                </div>
            </div>
            </form>
            <div class="hotkey">热门搜索：{searchkey()}</div>
        </div>
        <div class="ui-col-3">
        	<!--迷你购物车开始-->
            <div class="mincart" data-url="{U('cart/index','mincart=1')}">
                <a href="{N('cart')}"><i class="ui-icon-cart"></i>购物车<em id="cartnum" data-url="{U('cart/cartnum')}">{CART_NUM}</em></a>
                <div class="cart-detail"></div>
			</div>
            <!--迷你购物车结束-->
        </div>
    </div>
    
    <div class="width topnav ui-row">
        <div class="leftnav">
        	<span class="ui-icon-lists"></span><a href="{N('category')}">商品分类</a>
            <div class="home_nav ui-hide">
            	<ul>
                	{sdcms:rp top="0" table="sd_goods_class" where="followid=0" order="cate_order,cateid"}
                    {php $one_sonid=$rp[cateid]}
                    {php $cate_brands=$rp[cate_brand]}
                	<li>
                    	<a href="{goods($rp[cateid],$rp[cate_url])}" title="{$rp[cate_name]}">{$rp[cate_name]}</a>
                        <p>
                            {sdcms:rs top="4" table="sd_goods_class" where="followid=$one_sonid" order="cate_order,cateid"}<a href="{goods($rs[cateid],$rs[cate_url])}">{$rs[cate_name]}</a>{/sdcms:rs}
                        </p>
                        {if get_sonid_num($rp[cateid])!=0}
                        <div class="dropnav">
                            {sdcms:rs top="0" table="sd_goods_class" where="followid=$one_sonid" order="cate_order,cateid"}
                            {php $two_sonid=$rs[cateid]}
                            <dl>
                                <dt><a href="{goods($rs[cateid],$rs[cate_url])}" title="{$rs[cate_name]}">{$rs[cate_name]}</a></dt>
                                {sdcms:rt top="0" table="sd_goods_class" where="followid=$two_sonid" order="cate_order,cateid"}
                                {rt:head}<dd>{/rt:head}<a href="{goods($rt[cateid],$rt[cate_url])}" title="{$rt[cate_name]}"{if $rt[cate_nice]==1} class="active"{/if}>{$rt[cate_name]}</a>{rt:foot}</dd>{/rt:foot}
                                {/sdcms:rt}
                            </dl>
                            {/sdcms:rs}
                            {if $cate_brands<>"0"}
                            <div class="brand">
                            	<div class="bname">品牌推荐</div>
                                <div class="ui-line"></div>
                                {sdcms:rs top="0" table="sd_goods_brand" where="id in($cate_brands)" order="ordernum,id"}
                            	<a href="{N('brandshow','','id='.$rs[id].'')}" title="{$rs[name]}"><img src="{$rs[logo]}" alt="{$rs[name]}"></a>
                                {/sdcms:rs}
                            </div>
                            {/if}
                        </div>
                        {/if}
                    </li>
                    {/sdcms:rp}
                </ul>
            </div>
        </div>
        <nav class="navs">
            <ul>
                <li><a href="{$webroot}">商城首页</a></li>
                {sdcms:rs top="0" table="sd_menu" where="islock=1" order="ordnum,id"}
                <li class="nav_{md5_16(M($rs))}"><a href="{M($rs)}" title="{$rs[name]}">{$rs[name]}</a></li>
                {/sdcms:rs}
            </ul>
        </nav>
        
    </div>