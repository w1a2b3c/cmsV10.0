<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>拼团详情_{sdcms[web_name]}</title>
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
                    <li>拼团详情</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            <!--拼团开始-->
            <div class="ordergroup">
                <div class="left">
                    <div class="box">
                        <div class="ui-menu ui-menu-blue"><div class="ui-menu-name">拼团详情</div></div>
                        <div class="groupinfo">
                            <ul>
                                <li><span>成团人数：</span>{$neednum}</li>
                                <li><span>参团人数：</span>{if $group_state==3}{$neednum}{else}{$hasnum}{/if}</li>
                                <li><span>创建时间：</span>{date('Y-m-d H:i:s',$group_createdate)}</li>
                                {if $group_state<=2}
                                <li><span>剩余时间：</span><em class="ui-endtime" data-url="{U('index/closegroup','gid='.$groupid.'')}" data-time="{$group_overdate}">-</em></li>
                                {/if}
                                <li><span>拼团状态：</span>{if $group_state==3}成功{elseif $group_state==2}满员{elseif $group_state==1}进行中{else}失败{/if}</li>
                            </ul>
                        </div>
                        <div class="ui-menu ui-menu-blue"><div class="ui-menu-name">拼团商品</div></div>
                        <div class="goodsinfo">
                            {php $sku=0}
                            {sdcms:rs top="1" table="sd_goods a left join sd_goods_data b on a.id=b.cid" where="id=$goods_id"}
                            {php $sku=strlen($rs[sku])}
                            <a href="{$rs[link]}" title="{$rs[title]}" target="_blank">
                                <img src="{$rs[pic]}" width="100">
                                <div class="title">{$rs[title]}</div>
                                <div class="intro"><i class="ui-icon-team ui-text-gray"></i><em>{$neednum} 人团</em><br /><a class="ui-btn ui-btn-lt ui-btn-green ui-mt-sm">拼单立省 {$rs[vprice]-$rs[aprice]} 元</a></div>
                            </a>
                            {/sdcms:rs}
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="box">
                        <div class="ui-menu ui-menu-blue"><div class="ui-menu-name">参团记录</div></div>
                        <div class="grouplist">
                            <ul>
                                {sdcms:rs top="0" table="sd_order a left join sd_user b on a.userid=b.id" where="groupid=$groupid" order="order_id"}
                                <li><img src="{$rs[uface]}">{$rs[uname]}{if $i==1}　<a class="ui-btn ui-btn-blue ui-btn-lt">团长</a>{/if}<br><span>{date('Y-m-d H:i:s',$rs[createdate])}</span>{if $i==1}开团{else}参团{/if}　　{if $rs[ispay]==0}<em class="ui-btn ui-btn-yellow ui-btn-lt ui-mr">未付款</em>{/if}{if $rs[isclose]==1}<em class="ui-btn ui-btn-info ui-btn-lt">已取消</em>{/if}</li>
                                {/sdcms:rs}
                                {if $group_state==3 && $total_rs<$neednum}
                                    {for min="$total_rs" max="$neednum" var="j"}
                                    <li><img src="{sdcms[user_default_face]}">匿名<br><span>{date('Y-m-d H:i:s',($group_overdate-($neednum-$j)*10))}</span>参团</li>
                                    {/for}
                                {/if}
                            </ul>
                        </div>
                        
                        <div class="ui-text-center ui-p-30">
                            {if $group_state==1}
                                <div class="ui-mb">还差<span class="ui-text-red ui-pl-sm ui-pr-sm">{$neednum-$hasnum}</span>人，即可拼团成功{if $orderid>0 && $userid==USER_ID}　<a href="{N('myordershow','','id='.$orderid.'')}" class="ui-btn ui-btn-blue">查看订单</a>{/if}</div>
                                {if $userid==USER_ID}
                                <div class="ui-form-group">
                                    <div class="ui-input-group">
                                        <input value="{WEB_URL}{N('ordergroup','','id='.$groupid.'&type=1')}" id="copydata" class="ui-form-ip radius-right-none">
                                        <a class="after ui-copy" data-target="#copydata">邀请好友参团</a>
                                    </div>
                                </div>
                                {else}
                                <button class="join ui-btn ui-btn-blue" data-sku="{strlen($sku)}" data-url="{U('index/groupsku','tid='.$groupid.'')}">我要参团</button>
                                {/if}
                            {elseif $group_state==2}
                            	<div><span class="ui-text-blue">部分团员还未付款。</span></div>
                            {elseif $group_state==4}
                                <div><span class="ui-text-red">很遗憾，拼团未成功。</span></div>
                            {/if}
                            
                        </div>
    
                    </div>
                </div>
            </div>
            <!--拼团结束-->
            
        </div>
    </div>
    <!--中间部分结束-->
    
    
    
    {include file="foot.php"}
<script>
$(function()
{
	{if $group_state<=2}
	$(".ui-endtime").endtime(function(e)
	{
		$(e).html('已结束');
		$.ajax(
		{
		   type:"post",
		   dataType:'json',
		   url:url,
		   data:'token={$token}',
		   error:function(e){alert(e.responseText);},
		   success:function(d)
		   {
			   if(d.state=='error')
			   {
				   alert(d.msg)
			   }
			   location.href='{THIS_LOCAL}';
			}
		});
	});
	{/if}
	
	{if $userid!=USER_ID}
	$(".join").click(function()
	{
		var url=$(this).attr("data-url");
		var sku=$(this).attr("data-sku");
		$.dialogbox(
		{
			title:"我要参团",
			text:url,
			width:'600px',
			height:'440px',
			type:3,
			footer:false
		});
	});
	{/if}
});
</script>
</body>
</html>