<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>{if strlen($seo_title)>0}{$seo_title}{else}{$title}_{$cate_name}_{sdcms[web_name]}{/if}</title>
    <meta name="keywords" content="{if strlen($seo_key)>0}{$seo_key}{else}{$title}{/if}">
    <meta name="description" content="{if strlen($seo_desc)>0}{$seo_desc}{else}{$title}{/if}">
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
                    <li>商品内容</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--商品页大图、简介开始-->
            {php $piclist=jsdecode($piclist,1)}
            <div class="goods_show">
            	<div class="lefter">
                	<!--图片部分开始-->
                    {if count($piclist)>0}
                	<div class="goods_image">
                    	{php $big=reset($piclist)}
                    	<div class="big goods_big_pic">{if strlen($video)}<video src="{$video}" controls></video>{else}<a href="{$big['image']}" title="{$title}" class="ui-lightbox"><img src="{$big['image']}" alt="{$big['desc']}"></a>{/if}</div>
                        <div class="small goods_small_pic">
                            <ul>
                            	{php $j=0;}
                            	{if strlen($video)}
                                <li class="active" data-num="1" data-type="video"><img src="{if strlen($videopic)}{$videopic}{else}{WEB_THEME}images/video.png{/if}" data-url="{$video}" width="60" height="60"></li>
                                {php $j=1;}
                                {/if}
                                {php $step=0}
                                {foreach $piclist as $index=>$val}
                                {php $step++}
                                <li{if $step==1 && strlen($video)==0} class="active"{/if} data-num="{$step+$j}" data-type="image"><img src="{thumb($val['image'],60,60)}" data-url="{$val['image']}" alt="{$val['desc']}" width="60" height="60"></li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                    {/if}
                    <!--图片部分结束-->
                    
                    <!--拼团部分开始-->
                    {if $is_activity==2 && $stock>0}
                    {sdcms:rs top="10" table="sd_order_group a left join sd_user b on a.userid=b.id" where="group_state=1 and goods_id=$id" order="group_id desc"}
                    {rs:head}
                    <div class="group_list ui-scroll" data-time="5">
                        <ul class="ui-media-list ui-media-border-none">
                    {/rs:head}
                            <li class="ui-media">
                                <div class="ui-media-img ui-mr-20 ui-radius">
                                    <img src="{$rs[uface]}" width="64" height="64">
                                </div>
                                <div class="ui-media-body">
                                    <div class="ui-media-header">{$rs[uname]}</div>
                                    <div class="ui-media-text"><span>{$rs[neednum]}</span>人团，还差<span>{$rs[neednum]-$rs[hasnum]}</span>人成团，还剩：<span class="ui-endtime" data-url="{U('closegroup','gid='.$rs[group_id].'')}" data-time="{$rs[group_overdate]}"></span></div>
                                </div>
                                {if $rs[group_overdate]>time()}
                                <div class="ui-media-link ui-media-center"><a href="{N('ordergroup','','id='.$rs[group_id].'')}" class="ui-btn ui-btn-blue">参加拼团</a></div>
                                {/if}
                            </li>   
                    {rs:foot}
                        </ul>
                    </div>
                    {/rs:foot}
                    {/sdcms:rs}
                    {/if}
                    <!--拼团部分结束-->
                    <div class="space"></div>
                    <div class="action">
                        <div class="ui-btn-group ui-mt-30 ui-text-center">
                            <button data-id="{$id}" class="ui-modal-show ui-btn-group-item" data-target="#my-modal-share"><i class="ui-icon-share ui-mr"></i>分享</button>
                            <button data-id="{$id}" class="add-favorite ui-btn-group-item{if $user_favorite==1} active{/if}"><i class="ui-icon-star ui-mr"></i>{if $user_favorite==1}已{/if}收藏</button>
                        </div>
                    </div>

                </div>
                <div class="righter">
                	<!--righter begin-->
                	<h1>{$title}</h1>
                    
                    {if strlen($intro)>0}
                    <div class="words">{$intro}</div>
                    {/if}
                    
                    <div class="limit">
                    	{if $is_activity>0}
                    	<i class="ui-icon-time-circle ui-mr"></i>{if $is_activity==1}限时优惠{else}限时拼团（{$activity_num}人团）{/if}<div class="ui-endtime" data-time="{$activity_over}"></div>
                        {else}
                        <i class="ui-icon-propertysafety ui-mr"></i>商品价格
                        {/if}
                    </div>
                    <div class="price">
                    	<ul>
                            {if $types!=2}
                                <li><em>{if $ispresale==1}定　金{else}优惠价{/if}：</em><span class="goods_vprice">{$vprice}</span> 元</li>
                                <li><em>价　格：</em><del class="goods_dprice">{$dprice}</del> 元</li>
                            {/if}
                            {if $types>1}
                                <li><em>积　分：</em><span class="goods_point">{$point}</span></li>
                            {/if}
                            <li><em>已　售：</em>{$sales+$vsales} 件</li>
                        </ul>
                    	<div class="qrcode ui-tips" data-align="bottom-left" data-title="扫描二维码使用手机访问"></div>
                    </div>
                    
                    <ul class="attribute ui-row">
                        <li class="ui-col-6"><em>货号：</em>{$no}</li>
                    	{if $weight>0}<li class="ui-col-6"><em>重量：</em>{$weight} Kg</li>{/if}
                    </ul>
                    {if count($coupon)>0}
                    <div class="goods_coupon">
						<div class="goods_coupon_left">领券：</div>
                        <div class="goods_coupon_right">
                        	{foreach $coupon as $key=>$val}
                            <div class="goods_coupon_right_body"><div class="goods_coupon_right_name"><span>{getprice($val['amount'])}</span>元优惠券，满<span>{getprice($val['consume'])}</span>元可用</div><div class="goods_coupon_right_act"><a href="javascript:;" class="getcoupon" data-id="{$val['id']}" data-point="{$val['point']}">{if $val['point']==0}领取{else}兑换{/if}</a></div></div>
                            {/foreach}
                    	</div>
                    </div>
                    {/if}
                    <ul class="activity">
                    	{if $brandid>0}<li><em>品牌：</em><a href="{N('brandshow','','id='.$brandid.'')}">{$brandname}</a></li>{/if}
                        
                    	{if $ispresale==1}
                        	<li><em>发货时间：</em>
                            {if $postmode==1}
                            	<span>{date('Y-m-d',$postgoodsdate)}</span>
                            {else}
                            	支付尾款{if $postday>0}：<span>{$postday}</span>天后{else}当天{/if}发货
                            {/if}
                            </li>
                        {/if}
                        {if $freenum>0 && $types==1}<li><em>购买满：</em><span>{$freenum}</span>件包邮</li>{/if}
                        {if $types==1 && $point>0}<li><em>赠积分：</em><span>{$point}</span></li>{/if}
                        {if strlen($gift)>0 && count($giftdata)>0}
                        <li><em>购买赠：</em>
                            <dl>
                            {foreach $giftdata as $key=>$val}
                                <dt><a href="{$val['url']}" target="_blank" title="{$val['title']}　售价：{$val['price']}">{$val['title']} {$val['skuname']}</a>　( 库存：<span>{$val['stock']}</span>)</dt>
                            {/foreach}
                            </dl>
                        </li>
                        {/if}
                        {if $is_share==1}
                        	<li><em>佣金：</em>
                            	<span class="goods_share">{$share_money}</span> 元
                            </li>
                        {/if}
                    </ul>
                    
                    {if is_array($sku)}
                    <ul class="skushow">
                		<p>请选择规格</p>
                        {foreach $sku as $key=>$val}
                        <li class="item_specpara"><em>{$key}：</em>
                        	<dl>
                            	{foreach $val as $ak=>$bv}
                                {php $psmall='';}
                                {if isset($thumb[$bv]) && strlen($thumb[$bv])>0}
                                {php $psmall=$thumb[$bv];}
                                {/if}
                            	<dt data-aid="{$bv}" data-url="{$psmall}" title="{$bv}">{if !isempty($psmall)}<img src="{$psmall}" width="36" height="36"> {/if}{$bv}<i class="ui-icon-check"></i></dt>
                                {/foreach}
                            </dl>
                    	</li>
                        {/foreach}
                    </ul>
                    {/if}
                    
                    <ul class="action addcart">
                    	{if $stock>0}<li><em>数量：</em>
                        	<div class="goodsnum"><input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="{if $maxnum>0&&$maxnum<=$stock}{$maxnum}{else}{$stock}{/if}">{if $saletype!=2}<u class="goods_stock">库存：{$stock}</u>{/if}</div>
                        </li>{/if}
                        
                        <input type="hidden" name="sku_id" id="sku_id" value="{$sku_id}">
                    	<li class="hasstock{if $stock==0} ui-hide{/if}"><em>&nbsp;</em>
                            {if $is_activity==2}
                                <button class="ui-btn ui-btn-yellow" data-id="{$id}" data-type="buy">单独购买</button>
                                <button class="ui-btn ui-btn-blue" data-id="{$id}" data-type="tuan">我要开团</button>
                            {else}
                                <button class="ui-btn ui-btn-yellow" data-id="{$id}" data-type="buy">{if $types==2}积分兑换{else}{if $ispresale==1}{if $presalemode==1}全款预定{else}支付定金￥{if $presaletype==1}<span class="goods_vprice">{getprice($vprice)}</span>{else}{$presalemoney}{/if}{/if}{else}立即购买{/if}{/if}</button>
                                {if $ispresale==0}<button class="ui-btn ui-btn-blue" data-id="{$id}" data-type="cart">加入购物车</button>{/if}
                            {/if}
                    	</li>
                       	<li class="nostock{if $stock>0} ui-hide{/if}"><em>&nbsp;</em><button class="ui-btn" disabled data-type="">已售罄</button>
                    </ul>
                    
                    <!--righter over-->
                </div>
            </div>
            <!--商品页大图、简介结束-->
            
            <!--套装开始-->
            {if $issuit==1 && count($suitdata)>0 && $stock>0}
            {php $suit_list_price=0;}
            <div class="goods_suit ui-mt-15">
            	<div class="ui-tabs ui-tabs-white">
                    <ul class="ui-tabs-nav">
                        <li class="active"><a href="javascript:;" rel="nofollow">{$suitname}</a></li>
                    </ul>
                    
                    <div class="ui-tabs-content">
                        <div class="ui-tabs-pane active">
                            <!----> 
                            <div class="suit_base" data-price="{$suit_price}">
                                <a href="{THIS_LOCAL}" title="{$title}"><img data-original="{thumb($pic,280,280)}" src="/public/images/spacer.gif" alt="{$title}"><p>{$title}</p><p class="skuname"></p></a>
                            </div>
                            <div class="suit_plus">
                                <span class="ui-icon-plus"></span>
                            </div>
                            <div class="suit_list">
                                 <ul>
                                 	{foreach $suitdata as $key=>$val}
                                    {php $suit_list_price+=$val['price']}
                                    <li><a href="{$val['url']}" target="_blank" title="{$val['title']}"><div><img data-original="{$val['pic']}" src="/public/images/spacer.gif" alt="{$title}"></div><p class="ui-text-red">售价：{getprice($val['price'])}</p><p>{$val['title']}</p><p class="ui-text-gray">{$val['skuname']}</p></a></li>
                                    {/foreach}
                                </ul>
                            </div>
                            <div class="suit_total" data-price="{$suit_list_price}">
                                <ul>
                                    <li>原售价：￥<del>-</del></li>
                                    <li>优惠价：￥<span>-</span></li>
                                    <li>共节省：￥<em>-</em></li>
                                </ul>
                                <button type="button" class="ui-btn ui-btn-blue ui-mt-15 buysuit" data-id="{$id}" data-sid="0">购买此套装</button>
                            </div>
                            <!---->
                        </div>
                    </div>
                </div>
            </div>
            {/if}
            <!--套装结束-->
            
            <!--推荐商品、商品介绍、评价部分开始-->
            <div class="goods_show_footer">
            	<div class="lefter">
                	<div class="boxs">
                    	<!---->
                        <div class="ui-menu ui-menu-blue">
                            <div class="ui-menu-name">推荐商品</div>
                        </div>
                        <div class="likepro">
                            <!---->
                            <ul>
                                {sdcms:rs top="5" table="sd_goods" where="islock=1 and isnice=1 and classid=$classid and id<>$id" order="ordnum desc,id desc"}
                                <li><a href="{$rs[link]}" title="{$rs[title]}"><div><img data-original="{$rs[pic]}" src="/public/images/spacer.gif" alt="{$rs[title]}"></div><p><span>￥{getprice($rs[vprice])}</span></p><p>{cutstr($rs[title],70)}</p></a></li>
                                {/sdcms:rs}
                            </ul>
                            <!---->
                        </div>
                        <!---->
                    </div>
                    
                </div>
                <div class="righter">
                	<!---->
                    <div class="ui-tabs">
                        <ul class="ui-tabs-nav">
                            <li class="active"><a href="javascript:;" rel="nofollow">商品介绍</a></li>
                            {if count($edata)>0 && !isempty(implode($para))}
                            <li><a href="javascript:;" rel="nofollow">商品参数</a></li>
                            {/if}
                            <li><a href="javascript:;" rel="nofollow">客户评价（{$score['total']}）</a></li>
                        </ul>
                        <div class="ui-tabs-content">
                            <div class="ui-tabs-pane active">
                                {if $cate_filter>0&&strlen($filter)}
                                    <ul class="goods_param">
                                    {php $filter=explode(',',trim($filter,','))}
                                    {foreach $filter_data as $key=>$val}
                                    <li><span>{$key}：</span>{foreach $val as $aa=>$bb}{if in_array($aa,$filter)}{$bb}　{/if}{/foreach}</li>
                                    {/foreach}
                                    </ul>  
                                {/if}
                                {$content}
                                {if count($tagslist)>0}
                                <div class="tags">
                                    <a href="{N('label')}"><i class="ui-icon-tags"></i> 标签：</a>
                                    {foreach $tagslist as $rs}
                                        <a href="{$rs['url']}" title="{$rs['name']}" target="_blank" class="ui-btn ui-btn-sm">{$rs['name']}</a>
                                    {/foreach}
                                </div>
                                {/if}
                            </div>
                            
                            {if count($edata)>0 && !isempty(implode($para))}
                            <div class="ui-tabs-pane">
                            	<div class="ui-table-wrap">
                                    <table class="ui-table ui-table-border ui-table-hover">
                                        {foreach $edata as $key=>$rs}
                                        {if $rs['field_type']==1}
                                        <tr>
                                            <th colspan="2" class="ui-text-left">{$rs['title']}</th>
                                        </tr>
                                        {else}
                                            {if isset($para[$rs['field_key']]) && $para[$rs['field_key']]}
                                            <tr>
                                                <td width="100">{$rs['title']}</td>
                                                <td class="ui-text-left">{$para[$rs['field_key']]}</td>
                                            </tr>
                                            {/if}
                                        {/if}
                                        {/foreach}
                                    </table>
                                </div>
                            </div>
                            {/if}
                            <div class="ui-tabs-pane">
                                <!--33333-->
                                <div class="ui-row score_top">
                                	<div class="ui-col-3">
                                        {php $star=$score['star']}
                                        {for min="0" max="$star" step="1" var="j"}
                                        <i class="ui-icon-star ui-text-red"></i>
                                        {/for}
                                        <p><span>{$score['total']}</span>客户评价</p>
                                    </div>
                                    <div class="ui-col-9">
                                    	好评率：
                                        <div class="ui-progress ui-progress-blue ui-progress-lg"><div class="ui-progress-bar" style="width:{$score['good_percent']};">{$score['good_percent']}</div></div>
                                        <!--中评率：<div class="ui-progress ui-progress-green ui-progress-lg"><div class="ui-progress-bar" style="width:{$score['medium_percent']}">{$score['medium_percent']}</div></div>
                                        差评率：<div class="ui-progress ui-progress-red ui-progress-lg"><div class="ui-progress-bar" style="width:{$score['bad_percent']}">{$score['bad_percent']}</div></div>-->
                                    </div>
                                </div>
                                
                                <div class="score_bar" data-id="{$id}">
                                    <ul>
                                        <li class="active" data-type="0" data-total="{$score['total']}" data-num="{$score['total_num']}">全部（{$score['total']}）</li>
                                        <li data-type="1" data-total="{$score['pic']}" data-num="{$score['pic_num']}">有图（{$score['pic']}）</li>
                                        <li data-type="2" data-total="{$score['good']}" data-num="{$score['good_num']}">好评（{$score['good']}）</li>
                                        <li data-type="3" data-total="{$score['medium']}" data-num="{$score['medium_num']}">中评（{$score['medium']}）</li>
                                        <li data-type="4" data-total="{$score['bad']}" data-num="{$score['bad_num']}">差评（{$score['bad']}）</li>
                                    </ul>
                                </div>
                                
                                {no}
                                <ul class="ui-media-list ui-media-border" wu-tmpl="{name:'score'}">
                                	{{each data item i}}
                                    <li class="ui-media">
                                        <div class="ui-media-img ui-mr-20 ui-radius">
                                            <img wutpl-src="{{item.uface}}" alt="{{item.uname}}" width="64" height="64" class="loadpic">
                                        </div>
                                        <div class="ui-media-body">
                                            <div class="ui-media-header ui-row ui-align-items-center">
                                                <div class="ui-col-8">{{item.uname}}<span class="ui-pl"><% for(var i = 1; i <=item.score; i++){ %><i class="ui-icon-star ui-text-red"></i><% } %></span></div>
                                                <div class="ui-col-4 ui-text-right ui-font-15 ui-text-gray">{{item.createdate}}</div>
                                            </div>
                                            <div class="ui-media-text">
                                            	{{item.evaluate}}
                                                
                                                {{if item.piclist.length!=0}}
                                                <div class="ui-piclist ui-piclist-col-5 ui-mt">
                                                <%
                                                var piclist=item.piclist;
                                                for (var j in piclist)
                                                {
                                                %>
                                                <div class="ui-piclist-item">
                                                    <div class="ui-piclist-image"><a href="{{piclist[j]}}" rel="external nofollow" class="ui-lightbox" data-name="lightbox[{{item.aid}}]" data-title="客户评价"><img wutpl-src="{{piclist[j]}}" class="loadpic"></a></div>
                                                </div>
                                            	 <% } %>
                                                </div>
                                                {{/if}}
                                               
                                                {{if item.reply!=''}}<div class="ui-line ui-line-left"><span class="ui-text-red">客服回复：</span></div>{{item.reply}}</blockquote>{{/if}}
                                            </div>
                                        </div>
                                    </li>
                                    {{/each}}
                                </ul>
                                {/no}
                                <div id="page" class="ui-page ui-page-center ui-mt-15"></div>

                                <!--3333333-->
                            </div>
                        </div>
                    </div>
                    <!---->
                </div>
            </div>
            <!--推荐商品、商品介绍、评价部分结束-->
                    
        </div>
    </div>
    <!--中间部分结束-->
    
    <div class="ui-modal" id="my-modal-share">
        <div class="ui-modal-header">
            <div class="ui-modal-title">我要分享</div>
            <div class="ui-modal-close ui-rotate">×</div>
        </div>
        <div class="ui-modal-body">
        	<div class="ui-input-group">
                <input value="{WEB_URL}{THIS_LOCAL}" id="copydata" readonly class="ui-form-ip radius-right-none">
                <a class="after ui-copy" data-target="#copydata">复制网址</a>
            </div>
            <div class="ui-pt ui-text-gray">复制网址发给您的朋友{if $is_share==1 && $share_money>0}，登陆后分享，有机会获得：<span class="goods_share ui-text-red">{$share_money}</span> 元佣金{/if}</div>
            <div class="ui-show-share">
                分享：<a href="javascript:;" data-share="qq" data-title="分享到QQ空间" class="ui-tips"><i class="ui-icon-qq"></i></a><a href="javascript:;" data-share="weibo" data-title="分享到微博" class="ui-tips"><i class="ui-icon-weibo"></i></a><a href="javascript:;" data-share="weixin" data-title="分享到微信" class="ui-tips"><i class="ui-icon-weixin"></i></a>
            </div>
        </div>
        <div class="ui-modal-footer">
        	{if USER_ID==0 && $is_share==1 && $share_money>0}<a class="ui-btn ui-btn-blue ui-modal-close ui-mr" href="{N('login')}">登陆</a>{/if}
            <button class="ui-btn ui-modal-close">关闭</button>
        </div>
    </div>
    
    {include file="foot.php"}
    <script src="{WEB_ROOT}public/js/wu.tmpl.js"></script>
    <script src="{WEB_ROOT}public/js/jquery.qrcode.js"></script>
    <script>
	{if $islock<1}
	$(".addcart").html('<div class="ui-bd ui-text-red ui-p ui-pl-20">商品已下架</div>');
	{/if}

	var skulist=[];
	var skubase="";
	var skuid=0;
	var skustock={$stock};
	var suitnum={count($suitdata)};
	
	{php $step=1}
	{foreach $sku_list as $key=>$val}
		{if $step==1}
			var skubase="{$key}";
			var skuid={$val}.aid;
			var skustock={$val}.stock;
		{/if}
		skulist['{$key}']='{$val}';
		{php $step++;}
	{/foreach}
	
	function coupon(id)
	{
		$.ajax(
		{
			type:'post',
			dataType:'json',
			url:'{N("coupon")}',
			data:'token={$token}&id='+id,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					sdcms.success(d.msg);
				}
				else
				{
					sdcms.error(d.msg);
				}
			}
		});
	}
	
	function scorelist(total,num,type,id,page)
	{
		$.ajax(
		{ 
			url:'{U("scorelist")}', 
			dataType:'json',
			type:'post',
			data:'token={$token}&total='+total+'&num='+num+'&type='+type+'&id='+id+'&page='+page,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				wu.tmpl.render('score',d);
				/*图片404处理*/
				$(".loadpic").each(function()
				{
					var e=$(this);
					e.attr("src",e.attr("wutpl-src"));
				});
			}
		});
	}
	
	function get_score(total,num,type,id,page)
	{	
		$("#page").page(
		{
			totalnum:total,
			totalpage:num,
			thispage:page,
			num:5,
			callback:function(e)
			{
				scorelist(total,num,type,id,e.clickpage);
			}
		});
	}

	function getprice()
	{
		var a=false;
		$(".item_specpara dl").each(function(){if(!$("dt",this).hasClass('selected')){a=true;}});
		if(a)
		{
			$("#sku_id").val('');
			return;
		}
		$(".skushow").removeClass("sku_selected");
		var skuname=get_prospec();
		
		if(!(typeof(skulist[skuname])=='undefined'))
		{
			var data=$.parseJSON(skulist[skuname]);
			var html='';

			$(".goods_dprice").html(data.dprice);
			$(".goods_vprice").html(data.vprice);
			
			{if $is_share==1 && $share_type==2}
				$(".goods_share").html(data.share_price);
			{/if}

			html+='<li><em>货号：</em>'+data.no+'</li>';
			
			if(data.weight>0)
			{
				html+='<li><em>重量：</em>'+data.weight+' Kg</li>';
			}
			$(".attribute").html(html);
			if({$issuit}==1)
			{
				$(".suit_base").attr("data-price",data.vprice);
				$(".suit_base .skuname").html(skuname.replace("|"," "));
				$(".suit_total").find("button").attr("data-sid",data.aid);
				deal_suit();
			}
			
			$("#sku_id").val(data.aid);
			{if $saletype!=2}
				$(".goodsnum").html('<input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="'+data.stock+'"><u class="goods_stock">库存：'+data.stock+'</u>');
			{else}
				$(".goodsnum").html('<input type="text" name="goodsnum" value="1" class="ui-inputnumber" data-min="1" data-max="'+data.stock+'">');
			{/if}
			//重新渲染数字输入框效果
			$(".ui-inputnumber").inputnumber();
			
			if(data.stock<=0)
			{
				if({$issuit}==1 && suitnum>0)
				{
					$(".suit_total").find("button").prop("disabled","disabled");
					$(".pro_suit").addClass("ui-hide");
				}
				$(".hasstock").addClass("ui-hide");
				$(".nostock").removeClass("ui-hide");
			}
			else
			{
				if({$issuit}==1 && suitnum>0)
				{
					$(".suit_total").find("button").prop("disabled","");
				}
				$(".hasstock").removeClass("ui-hide");
				$(".nostock").addClass("ui-hide");
			}
		}
		else
		{
			sdcms.error('规格参数错误');
		}
	}
	
	function deal_suit()
	{
		var suittype={$suittype};
		var suitmoney={$suitmoney};
		var goods_base=parseFloat($(".suit_base").attr("data-price"));
		var goods_list=parseFloat($(".suit_total").attr("data-price"));
		var goods_total=Number(goods_base+goods_list).toFixed(2);
		var goods_discoun=0;
		if(suittype=="1")
		{
			goods_discoun=Number(goods_total-suitmoney).toFixed(2);
		}
		else
		{
			goods_discoun=Number(goods_total*suitmoney).toFixed(2);
		}
		var goods_save=Number(goods_total-goods_discoun).toFixed(2);
		$(".suit_total").find("del").html(parseFloat(goods_total));
		$(".suit_total").find("span").html(parseFloat(goods_discoun));
		$(".suit_total").find("em").html(parseFloat(goods_save));
		if(skustock==0)
		{
			$(".suit_total").find("button").prop("disabled","disabled");
		}
		else
		{
			$(".suit_total").find("button").prop("disabled","");
		}
		$(".pro_suit").removeClass("ui-hide");
	}
	
	function get_prospec()
	{
		var _val='';
		$(".item_specpara").each(function()
		{
			var i=$(this);
			var v=i.attr("data-attrval");
			if(v)
			{
				_val+=_val!=""?"|":"";
				_val+=v;
			}
		})
		return _val;
	}
	
	function loginmsg(d,url)
	{
		{if C('shop_other_nologin')==1}
		var msg=(url=='')?'注册':'直接下单';
		{else}
		var msg='注册';
		url='';
		{/if}
		$.dialog(
		{
			title:"操作提示",
			text:d,
			okval:'登录',
			cancelval:msg,
			ok:function()
			{
				location.href='{N("login")}';
			},
			cancel:function()
			{
				if(url=='')
				{
					location.href='{N("reg")}';
				}
				else
				{
					$.ajax(
					{
						type:'post',
						dataType:'json',
						url:'{U("user/newuser")}',
						data:'token={$token}&randnum={$randreg}',
						error:function(e){alert(e.responseText);},
						success:function(d)
						{
							if(d.state=='success')
							{
								location.href=url;
							}
							else
							{
								sdcms.error(d.msg);
							}
						}
					});
				}
			}
		});
	}
	
	function cartmsg(d)
	{
		$.dialog(
		{
			title:"操作提示",
			text:d,
			okval:'去结算',
			cancelval:'再逛逛',
			ok:function()
			{
				location.href='{N("cart")}';
			}
		});
	}
	
	$(function()
	{
		/*菜单*/
		$(".nav_{md5_16(N('goods'))}").addClass("active");
		
		/*二维码*/
		$(".qrcode").qrcode({width:80,height:80,foreground:"#000",background:"#FFF",text:"{WEB_URL}{THIS_LOCAL}"});
		
		/*商品组图*/
		if($(".goods_small_pic").length>0 && $(".goods_big_pic").length>0)
		{
			$(".goods_small_pic ul li").click(function()
			{
				var type=$(this).attr("data-type");
				var src=$(this).find("img").attr("data-url");
				var alt=$(this).find("img").attr("alt");
				var num=$(this).attr("data-num");
				if(type=='image')
				{
					$(".goods_big_pic").html('<a href="'+src+'" class="ui-lightbox" title="{$title}"><img src="'+src+'" alt="'+alt+'"></a>');
				}
				else
				{
					$(".goods_big_pic").html('<video src="'+src+'" controls></video>');
				}
				$(this).siblings().removeClass('active').end().addClass('active');
				$(".goods_small_pic").animate({scrollTop:((num-2)*86)+'px'},'slow');;
			})
			$(".item_specpara dt").click(function()
			{
				var src=$(this).attr("data-url");
				if(src!='')
				{
					$(".goods_big_pic").html('<a href="'+src+'" title="{$title}" class="ui-lightbox"><img src="'+src+'"></a>');
					$(".goods_small_pic ul li").each(function()
					{
						$(this).siblings().removeClass('active')
					})
				}
			})
		};
		
		/*优惠券*/
		$(".getcoupon").click(function()
		{
			{if USER_ID==0}
				$.dialog(
				{
					title:"操作提示",
					text:'请先登录或注册',
					okval:'登录',
					cancelval:'注册',
					ok:function()
					{
						parent.location.href='{N("login")}';
					},
					cancel:function()
					{
						parent.location.href='{N("reg")}';
					}
				});
			{else}
				var id=$(this).attr("data-id");
				var point=$(this).attr("data-point");
				var result=true;
				if(point>0)
				{
					$.dialog(
					{
						title:"操作提示",
						text:'确定花费 <span class="ui-text-red">'+point+'</span> 积分？',
						ok:function(e)
						{
							e.close();
							coupon(id);
						}
					});
				}
				else
				{
					coupon(id);
				}
			{/if}
		});
		
		/*评价点击*/
		if($(".score_bar").length>0)
		{
			$(".score_bar ul li").click(function()
			{
				var type=$(this).attr("data-type");
				var total=$(this).attr("data-total");
				var num=$(this).attr("data-num");
				var id=$(this).parent().parent().attr("data-id");
				get_score(total,num,type,id,1);
				$(this).siblings().removeClass('active').end().addClass('active');
			})
		}
		
		$(".item_specpara").each(function()
		{
			var i=$(this);
			var p=i.find("dl>dt");
			p.click(function()
			{
				if(!!$(this).hasClass("selected"))
				{
					$(this).removeClass("selected");
					i.removeAttr("data-attrval");
				}
				else
				{
					$(this).addClass("selected").siblings("dt").removeClass("selected");
					i.attr("data-attrval",$(this).attr("data-aid"))
				}
				getprice();
			})
		});
		
		/*套装价格计算*/
		if({$issuit}==1 && suitnum>0)
		{
			$(".suit_base .skuname").html(skubase.replace("|"," "));
			$(".suit_total").find("button").attr("data-sid",skuid);
			deal_suit();
		}
		
		/*组合购买*/
		$(".buysuit").click(function()
		{
			var goods_id=$(this).attr("data-id");
			var sku_id=$(this).attr("data-sid");
			$.ajax(
			{
				type:'post',
				dataType:'json',
				url:'{U("cart/add")}',
				data:'token={$token}&goods_id='+goods_id+'&sku_id='+sku_id+'&goods_num=1&suitid='+goods_id,
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						cartmsg(d.msg);
						get_cartnum("{U('cart/cartnum')}",'{$token}',0)
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		});
		
		/*加入购物车、立即购买*/
		$(".addcart button").click(function()
		{
			var that=this;
			var goods_id=$(this).attr("data-id");
			var type=$(this).attr("data-type");
			var sku_id=$("#sku_id").val();
			if(type=="cart")
			{
				var url="{U('cart/add')}";
			}
			else if(type=="buy")
			{
				var url="{U('cart/buy')}";
			}
			else if(type=="tuan")
			{
				var url="{U('cart/buy','type=1')}";
			}
			else
			{
				return false;
			}
			if(sku_id=='')
			{
				$(".skushow").addClass("sku_selected");
				return;
			}
			var goods_num=$(".goodsnum").find('input[name=goodsnum]').val();
			$.ajax(
			{
				type:'post',
				dataType:'json',
				url:url,
				data:'token={$token}&goods_id='+goods_id+'&sku_id='+sku_id+'&goods_num='+goods_num,
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(type=="cart")
					{
						if(d.state=='success')
						{
							cartmsg(d.msg);
							get_cartnum("{U('cart/cartnum')}",'{$token}',0)
						}
						else
						{
							sdcms.error(d.msg);
						}
					}
					else
					{
						var backurl='{N("order","","type=1")}';
						if(type=="tuan")
						{
							backurl='{N("order","","type=2")}';
						}
						
						if(d.state=='success')
						{
							location.href=backurl;
						}
						else
						{
							if(d.msg.substring(0,1)=="1")
							{
								loginmsg(d.msg.substring(1),backurl);
							}
							else
							{
								sdcms.error(d.msg.substring(1));
							}
						}
					}
				}
			});
		});

		/*加入收藏*/
		$(".add-favorite").click(function()
		{
			var goods_id=$(this).attr("data-id");
			var that=this;
			$.ajax(
			{
				type:'post',
				dataType:'json',
				url:'{U("cart/favorite")}',
				data:'token={$token}&id='+goods_id,
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						if(d.msg.substring(0,1)=="3")
						{
							$(that).html('<span class="ui-icon-star"></span> 已收藏').addClass("active");
						}
						else
						{
							$(that).html('<span class="ui-icon-star"></span> 收藏').removeClass("active");
						}
						sdcms.success(d.msg.substring(1));
					}
					else
					{
						if(d.msg.substring(0,1)=="1")
						{
							loginmsg(d.msg.substring(1),'');
						}
						else
						{
							$.tips({text:d.msg.substring(1),id:that,align:'bottom-left'})
						}
					}
				}
			});
		});
		
		get_score({$score['total']},{$score['total_num']},0,{$id},1);
		
		{if $is_activity>0}
			$(".ui-endtime").endtime(function(e)
			{
				var url=$(e).attr("data-url");
				$.ajax(
				{
					type:"post",
					dataType:'json',
					url:url,
					data:'token={$token}',
					success:function(d)
					{
						if(d.state=='success')
						{
							location.href='{THIS_LOCAL}';
						}
					}
				});
				$(e).html('结束了');
			});
		{/if}

	});
	</script>
</body>
</html>