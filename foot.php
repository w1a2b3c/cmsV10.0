<?php if(!defined('IN_B2C')) exit;?>	<div class="why">
    	<div class="width ui-row">
            <div class="ui-col-3">
                <i class="ui-icon-zheng"></i>正品行货放心选购
            </div>
            <div class="ui-col-3">
                <i class="ui-icon-sheng"></i>天天低价畅选无忧
            </div>
            <div class="ui-col-3">
                <i class="ui-icon-qi"></i>七天无理由退货
            </div>
            <div class="ui-col-3">
                <i class="ui-icon-kuai"></i>多地直发极速配送
            </div>
        </div>
    </div>
    
    <div class="width ui-row footnavs">
    	<div class="ui-col-9">
        	{sdcms:rp top="5" table="sd_article_class" where="followid=0 and cate_nice=1" order="cate_order,cateid"}
            {php $sonid=article_sonid($rp[cateid])}
            <div class="item">
            	<h4><a href="{article($rp[cateid],$rp[cate_url])}" title="{$rp[cate_name]}">{$rp[cate_name]}</a></h4>
                <ul>
                	{sdcms:rs top="3" table="sd_article" where="classid in($sonid)" order="ordnum desc,id desc"}
                    <li><a href="{$rs[link]}" title="{$rs[title]}" class="ui-text-hide">{cutstr($rs[title],20,0)}</a></li>
                    {/sdcms:rs}
                </ul>
            </div>
            {/sdcms:rp}
        </div>
        <div class="ui-col-3">
        	<div class="tel">
        		<i class="ui-icon-tel"></i>{sdcms[ct_tel]}
                <div class="date">工作时间：{sdcms[ct_work_time]}</div>
            </div>
        </div>
    </div>
    
    <div class="bg_footer">
    	<div class="width ui-row">
        	<div class="ui-col-10">
                <div class="link"><a href="{$webroot}">网站首页</a>{sdcms:rs top="8" table="sd_article_class" where="followid=0 and cate_nice=1" order="cate_order,cateid"}<a href="{article($rs[cateid],$rs[cate_url])}" title="{$rs[cate_name]}">{$rs[cate_name]}</a>{/sdcms:rs}<a href="{N('label')}">Tags标签</a></div>
                <div class="copyright">{sdcms[ct_company]}　版权所有 © 2008-{date('Y')} Inc.　<a href="https://beian.miit.gov.cn" target="_blank">{sdcms[web_icp]}</a>　<a href="{sdcms[beian_url]}" target="_blank">{sdcms[beian_num]}</a> {sdcms[count_code]}<br>{runtime()}</div>
            </div>
            <div class="ui-col-2 ui-text-right">
            	{if sdcms[weixin_qrcode]}<img src="{sdcms[weixin_qrcode]}" width="100" class="ui-tips" data-width="300" data-pic="{sdcms[weixin_qrcode]}" data-title="公众号二维码，扫码关注我们">{/if}
            </div>
        </div>
    </div>
    
    <div class="ui-bar ui-bar-blue">
    	<ul>
        	{foreach $plug_service as $key=>$val}
        	<li><a href="http://wpa.qq.com/msgrd?v=3&uin={$val['qq']}&site=qq&menu=yes"><i class="ui-icon-qq"></i><p>{$val['title']}</p></a></li>
            {/foreach}
            {if sdcms[ct_weixin]}<li><a href="javascript:;"><i class="ui-icon-weixin"></i><div><img src="{sdcms[ct_weixin]}" />使用【微信】扫一扫加好友</div></a></li>{/if}
        	<li><a href="{N('user')}"><i class="ui-icon-user"></i><p>我的会员</p></a></li>
            <li><a href="{N('myorder')}"><i class="ui-icon-shopping"></i><p>我的订单</p></a></li>
            <li><a href="{N('myfavorite')}"><i class="ui-icon-heart"></i><p>我的收藏</p></a></li>
        </ul>
        <ul>
        	<li><a href="{N('sitemap')}"><i class="ui-icon-location"></i><p>网站地图</p></a></li>
            <li><a href="javascript:;" class="ui-backtop"><i class="ui-icon-top"></i><p>返回顶部</p></a></li>
        </ul>
    </div>
    
    <script src="{WEB_ROOT}public/js/jquery.js"></script>
    <script src="{WEB_ROOT}public/js/ui.js?v={time()}"></script>
    <script src="{WEB_ROOT}public/js/jquery.lazyload.js"></script>
    <script src="{WEB_THEME}js/b2c.js"></script>
    <script>
	$(function()
	{
		$("img").lazyload(
		{
			effect:"fadeIn",
			skip_invisible:true,
			failure_limit:20
		});
		{if IS_HOME}
		$(".ui-tabs-nav li").hover(function()
		{
			$(window).trigger('scroll');
		})
		{/if}
	});
	</script>