<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>领券中心_{sdcms[web_name]}</title>
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
                    <li><a href="{N('coupon')}">领券中心</a></li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--优惠券开始-->
            <div class="coupon">
                {php $time=time();}
                {sdcms:rs top="0" table="sd_market_coupon" where="islock=1 and stock>0 and overdate>$time" order="ordnum,id"}
                {rs:eof}<p>暂时没有优惠券</p>{/rs:eof}
                <div class="coupon-item">
                    <div class="coupon-top">
                        <sub>￥</sub><span>{str_replace('.00','',$rs[amount])}</span>优惠券
                        <a href="javascript:;" class="getcoupon" data-id="{$rs[id]}" data-point="{$rs[point]}">{if $rs[point]==0}免费领取{else}{$rs[point]}积分兑换{/if}</a>
                    </div>
                    <div class="coupon-body">
                        <div class="coupon-name">{$rs[name]}</div>
                        <div class="coupon-intro">有效期：<span>{$rs[effectivedays]}</span> 天</div>
                    </div>
                </div>
               {/sdcms:rs}
            </div>
            <!--优惠券结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
    
<script>
function coupon(id)
{
	$.ajax(
	{
		type:'post',
		dataType:'json',
		url:'{THIS_LOCAL}',
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
$(function()
{
	//菜单
	$(".nav_{md5_16(N('coupon'))}").addClass("active");
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
});
</script>
</body>
</html>