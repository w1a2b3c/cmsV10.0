{include file="top.php"}
    <title>订单提交_{sdcms[web_name]}</title>
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
                    <li>订单提交</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--订单开始-->
            <div class="cart_order">
                <form class="ui-form" method="post">
                {php $shop_address_list=explode(',',C("shop_address_list"))}
                {if $type==2}
                <div class="ui-p">
                    <div class="ui-step-wrap ui-step-{C('theme_color')}">
                        <div class="ui-step-bg"></div>
                        <div class="ui-step-progress"></div>
                        <div class="ui-step">
                            <div class="ui-step-item active">
                                <div class="ui-step-num">1</div>
                                <div class="ui-step-title">选择商品开团</div>
                            </div>
                            <div class="ui-step-item">
                                <div class="ui-step-num">2</div>
                                <div class="ui-step-title">邀请好友参团</div>
                            </div>
                            <div class="ui-step-item">
                                <div class="ui-step-num">3</div>
                                <div class="ui-step-title">人满成团</div>
                            </div>
                        </div>
                    </div>
                </div>
                {/if}
                {if $shop_address_open==1}
                
                <!--自提修改开始-->
                <div class="ui-tabs">
                    <div class="ui-tabs-header-nav">
                        <ul class="ui-tabs-nav" id="postway">
                            <li class="active" data-type="1"><a href="javascript:;">{if count($store)>0}快递发货{else}收货地址{/if}</a></li>
                             {if count($store)>0}<li data-type="2"><a href="javascript:;">门店自提</a></li>{/if}
                        </ul>
                    </div>
                    <div class="ui-tabs-body ui-p">
                        <div class="ui-tabs-content">
                            <div class="ui-tabs-pane active">
                                <!--11111-->
                                <input type="hidden" name="add_id" id="add_id" value="{$add_id}" data-rule="收货地址:required;">
                                <div class="address">
                                    <ul>
                                        {foreach $myaddress as $key=>$rs}
                                        <li{if $id==0}{if $rs['isdefault']==1} class="hover"{/if}{else}{if $rs['id']==$id} class="hover"{/if}{/if} data-url="{N('order','','id='.$rs['id'].'&type='.$type.'&tid='.$tid.'')}">
                                            <div class="pd">
                                                <h4>{$rs['name']}</h4>
                                                <p>
                                                {if in_array(2,$shop_address_list)}{$rs['mobile']}<br>{/if}
                                                {if in_array(3,$shop_address_list)}{$rs['qq']}<br>{/if}
                                                {if in_array(4,$shop_address_list)}{$rs['email']}<br>{/if}
                                                {if in_array(5,$shop_address_list)}{$rs['province']} {$rs['city']} {$rs['county']}<br>
                                                {$rs['street']}{/if}
                                                {if in_array(6,$shop_address_list)}{$rs['idcard']}{/if}
                                            </div>
                                            <i class="ui-icon-home"></i>
                                        </li>
                                        {/foreach}
                                        <li class="add">
                                            <a href="javascript:;" class="ui-modal-show" data-target="#my-address"><span class="ui-icon-plus"></span>添加地址</a>
                                        </li>
                                    </ul>
                                </div>
                                <!--11111-->
                            </div>
                            {if count($store)>0}
                            <div class="ui-tabs-pane">
                                <!--2222-->
                                <input type="hidden" name="store_id" id="store_id" value="" data-rule="自提点:required;">
                                <div class="store">
                                    <ul>
                                        {foreach $store as $key=>$rs}
                                        <li data-id="{$rs['id']}">
                                            <div class="pd">
                                                <h4>{$rs['title']}</h4>
                                                <p><!--{$rs['mobile']}<br>-->
                                                {$rs['province']} {$rs['city']} {$rs['county']}<br>
                                                {$rs['street']}
                                            </div>
                                            <i class="ui-icon-check"></i>
                                        </li>
                                        {/foreach}
                                    </ul>
                                </div>
                                <!--2222-->
                            </div>
                            {/if}
                        </div>
                   </div>
                </div>
                <!--自提修改结束-->
                {/if}
                
				{if $shop_address_open==0}
				{php $shop_other_address=explode(',',C("shop_other_address"))}
				{if strlen(C("shop_other_address"))}
					<div class="ui-menu ui-menu-blue ui-mb-15">
						<div class="ui-menu-name">收货信息</div>
					</div>
					{if in_array(1,$shop_other_address)}
					<div class="ui-form-group ui-row">
						<span class="ui-col-1 ui-col-form-label ui-mt-10">手机号码：</span>
						<div class="ui-col-4 ui-col-form-label">
							<input type="text" name="mobile" class="ui-form-ip" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;" maxlength="11">
						</div>
					</div>
					{/if}
					{if in_array(2,$shop_other_address)}
					<div class="ui-form-group ui-row">
						<span class="ui-col-1 col-form-label mt-10">QQ号码：</span>
						<div class="ui-col-4 col-form-label">
							<input type="text" name="qq" class="ui-form-ip" placeholder="请输入QQ号码" data-rule="QQ号码:required;qq;" maxlength="20">
						</div>
					</div>
					{/if}
					{if in_array(3,$shop_other_address)}
					<div class="ui-form-group ui-row">
						<span class="ui-col-1 col-form-label mt-10">邮箱：</span>
						<div class="ui-col-4 col-form-label">
							<input type="text" name="email" class="ui-form-ip" placeholder="请输入邮箱" data-rule="邮箱:required;email;" maxlength="50">
						</div>
					</div>
					{/if}
					{if in_array(4,$shop_other_address)}
					<div class="ui-form-group ui-row">
						<span class="ui-col-1 col-form-label mt-10">身份证：</span>
						<div class="ui-col-4 col-form-label">
							<input type="text" name="idcard" class="ui-form-ip" placeholder="请输入身份证号码" data-rule="身份证:required;idcard;" maxlength="18">
						</div>
					</div>
					{/if}
				{/if}
				{/if}
                <div class="ui-menu ui-menu-blue ui-mb">
                    <div class="ui-menu-name">付款方式</div>
                </div>
                <div class="ui-form-group ui-row">
                    <span class="ui-col-1 ui-col-form-label">付款方式：</span>
                    <div class="ui-col-4 ui-mt">
                        <label class="ui-radio"><input type="radio" name="payway" id="payway_1" value="1" checked><i></i>在线支付</label>
                        {if sdcms[shop_paycash]==1 && $type!=2 && $goods_pre_total==0 && $autopost==0 && ($goods_freight>0 || $order_total>0)}
						{php $paycash=sdcms[shop_paycash_percent]*100}
                        <label class="ui-radio"><input type="radio" name="payway" id="payway_2" value="2"><i></i>货到付款{if sdcms[shop_paycash_percent]>0}（手续费：<span class="ui-text-red">{$paycash}%</span>）{/if}</label>
                        {/if}
                    </div>
                </div>
                {if sdcms[shop_invoice]==1}	
                <div class="ui-menu ui-menu-blue mb">
                    <div class="ui-menu-name">发票信息</div>
                </div>
                <div class="ui-form-group ui-row">
                    <span class="ui-col-1 ui-col-form-label">是否开票：</span>
                    <div class="ui-col-4 ui-mt">
                    	<label class="ui-radio"><input type="radio" name="invoice_type" value="0" checked><i></i>不要发票</label>
                        <label class="ui-radio"><input type="radio" name="invoice_type" value="1"><i></i>纸质发票</label>
                        {if sdcms[shop_einvoice_open]==1}	
                        <label class="ui-radio"><input type="radio" name="invoice_type" value="2"><i></i>电子发票</label>
                        {/if}
                    </div>
                </div>
                <div class="ui-form-group ui-row invoice ui-hide">
                    <span class="ui-col-1 ui-col-form-label">发票类型：</span>
                    <div class="ui-col-4 ui-mt">
                        <label class="ui-radio"><input type="radio" name="invoice_rise" value="1" checked><i></i>个人</label>
                        <label class="ui-radio"><input type="radio" name="invoice_rise" value="2"><i></i>单位</label>
                    </div>
                </div>
                <div class="ui-form-group ui-row invoice ui-hide">
                    <span class="ui-col-1 ui-col-form-label">发票抬头：</span>
                    <div class="ui-col-4">
                        <div class="invoice-personal">
                        	<input type="text" name="company_personal" class="ui-form-ip ui-mt" placeholder="请输入姓名" data-rule="姓名:required;" >
                        </div>
                        <div class="invoice-company ui-hide">
                        	<input type="text" name="company_name" class="ui-form-ip ui-mt" placeholder="请输入公司名称" data-rule="公司名称:required;" >
                            <input type="text" name="company_no" class="ui-form-ip ui-mt" placeholder="请输入纳税识别号" data-rule="纳税识别号:required;" >
                        </div>
                    </div>
                </div>
                {/if}
                <div class="ui-menu ui-menu-blue ui-mb-15">
                    <div class="ui-menu-name">商品信息</div>
                    {if $type==0}<div class="ui-menu-more"><a href="{N('cart')}">返回购物车修改</a></div>{/if}
                </div>
                <div id="order_goods">
                    <table class="ui-table ui-table-border ui-table-hover">
                    	<thead class="ui-thead-gray">
                        <tr>
                            <th>商品</th>
                            <th width="100">数量</th>
                            <th width="120">单价</th>
                            {if sdcms[shop_freight_mode]==0}<th width="100">运费</th>{/if}
                            <th width="120">小计</th>
                        </tr>
                        </thead>
                        {foreach $cart as $key=>$rs}
                        {if $rs['issuit']==0}
                        <tr>
                            <td class="ui-text-left">
                                <img src="{thumb($rs['pic'],100,100)}" class="pic" width="80">
                                <a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank">{$rs['title']}</a><br><span class="ui-text-gray ui-mt-sm">{$rs['skuname']}</span>
                                {if $rs['isgift']!=0}<br><span class="ui-btn ui-btn-yellow ui-btn-lt ui-mt-sm">赠品</span>{/if}
                            </td>
                            <td>{$rs['buynum']}</td>
                            <td>
                                {if $rs['price']>0 || $rs['isgift']!=0}<div>￥{getprice($rs['price'])}</div>{/if}
                                {if $rs['ispresale']==1 && $rs['presalemode']==2}<span class="ui-badge ui-badge-red">定金</span>￥{$rs['pprice']}{/if}
                                {if $rs['point']>0}<div class="ui-text-gray">{$rs['point']} 积分</div>{/if}
                            </td>
                            {if sdcms[shop_freight_mode]==0}<td>￥{getprice($rs['freight'])}</td>{/if}
                            <td>
                                {if $rs['price']>0 || $rs['freight']>0 || $rs['isgift']!=0}<div>￥<span class="ui-text-red">{getprice($rs['price']*$rs['buynum']+$rs['freight'])}</span></div>{/if}
                                {if $rs['point']>0}<div class="ui-text-gray">{$rs['point']*$rs['buynum']} 积分</div>{/if}
                            </td>
                        </tr>
                        {else}
                        <tr>
                            <td class="ui-text-left">
                                <a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank"><strong>{$rs['suitname']}</strong></a>
                                <ul>
                                	<li><a href="{showurl($rs['goodsid'],$rs['alias'],$rs['classid'])}" target="_blank">{$rs['title']} {$rs['skuname']}</a></li>
                                {foreach $rs['suitdata'] as $aa=>$bb}
                                    <li><a href="{$bb['url']}" target="_blank" title="{$bb['title']}">{$bb['title']} {$bb['skuname']}</a></li>
                                {/foreach}
                                </ul>
                            </td>
                            <td>{$rs['buynum']}</td>
                            <td>
                            {if $rs['price']>0 || $rs['isgift']!=0}<div>￥{getprice($rs['price'])}</div>{/if}
                            {if $rs['point']>0}<div class="ui-text-gray">{$rs['point']} 积分</div>{/if}
                            </td>
                            {if sdcms[shop_freight_mode]==0}<td>￥{getprice($rs['freight'])}</td>{/if}
                            <td>
                                {if $rs['price']>0 || $rs['freight']>0 || $rs['isgift']!=0}<div>￥<span class="ui-text-red">{getprice($rs['price']*$rs['buynum']+$rs['freight'])}</span></div>{/if}
                                {if $rs['point']>0}<div>{$rs['point']*$rs['buynum']} 积分</div>{/if}
                            </td>
                        </tr>
                        {/if}
                        {/foreach}
                    </table>
                    <div class="feel_total">
                        <div class="coupon">
                            <select name="couponid" class="ui-form-ip{if $order_total==0} ui-hide{/if}">
                                <option value="0" data-rule="0">{if count($coupon)==0}暂无可用优惠券{else}我的优惠券{/if}</option>
                                {foreach $coupon as $key=>$rs}
                                <option value="{$rs['aid']}" data-rule="{$rs['amount']}">{$rs['name']}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="message">
                            <input name="message" class="ui-form-ip" placeholder="买家留言（可选）">
                        </div>
                        <div class="total">
                            <span>商品总计：</span>￥<em>{getprice($goods_total)}</em><br>
                            {if $goods_pre_total>0}<span>商品定金：</span>￥<em>{getprice($goods_pre_total)}</em><br>{/if}
                            {if $goods_point>0}<span>积分总计：</span><em>{$goods_point}</em><br>{/if}
                            {if $goods_freight>0}<span>运费：</span>￥<em id="freight">{getprice($goods_freight)}</em><br>{/if}
                            <span>优惠：</span>-￥<em id="discount">{$goods_discount}</em>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="action">
                        应付{if $goods_pre_total==0}总计{else}定金{/if}：{if $order_total>0}￥<span id="order_total">{getprice($order_total+$goods_freight-$goods_discount)}</span>　{/if}{if $goods_point>0}<span>{$goods_point}</span> 积分{/if}
						<em class="ui-text-gray ui-hide" id="shop_paycash_percent">（不含手续费）</em>
                        <input type="hidden" name="token" value="{$token}">
                        <button type="submit" class="ui-btn ui-btn-blue ui-ml">提交订单</button>
                    </div>
                </div>
                </form>
            </div>
            <!--订单结束-->
        </div>
    </div>
    <!--中间部分结束-->
    {if $shop_address_open==1}
    <div class="ui-modal" id="my-address">
        <div class="ui-modal-header">
            <div class="ui-modal-title">新增收货地址</div>
            <div class="ui-modal-close ui-rotate">×</div>
        </div>
        <div class="ui-modal-body">
        	<!---->
            <form class="ui-form-address" method="post">
            {if in_array(1,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-user"></span></span>
                    <input type="text" name="name" class="ui-form-ip radius-left-none" maxlength="20" placeholder="请输入收货人" data-rule="收货人:required;">
                </div>
            </div>
            {/if}
            {if in_array(2,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-mobile"></span></span>
                    <input type="text" name="mobile" class="ui-form-ip radius-left-none" maxlength="11" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;">
                </div>
            </div>
            {/if}
            {if in_array(3,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-qq"></span></span>
                    <input type="text" name="qq" class="ui-form-ip radius-left-none" maxlength="20" placeholder="请输入QQ号码" data-rule="QQ号码:required;qq;">
                </div>
            </div>
            {/if}
            {if in_array(4,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-mail"></span></span>
                    <input type="text" name="email" class="ui-form-ip radius-left-none" maxlength="50" placeholder="请输入邮箱" data-rule="邮箱:required;email;">
                </div>
            </div>
            {/if}
            {if in_array(5,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-contacts"></span></span>
                    <input type="hidden" name="province" id="province" value="">
                    <input type="hidden" name="city" id="city" value="">
                    <input type="hidden" name="county" id="county" value="">
                    <input type="text" name="area" class="ui-form-ip radius-left-none" readonly id="input-address" data-val="//" value="" placeholder="请选择所在地区" data-rule="地区:required;">
                </div>
            </div>
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-location"></span></span>
                    <input type="text" name="street" class="ui-form-ip radius-left-none" placeholder="请输入详细地址" data-rule="详细地址:required;">
                </div>
            </div>
            {/if}
			{if in_array(6,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-idcard"></span></span>
                    <input type="text" name="idcard" class="ui-form-ip radius-left-none" maxlength="50" placeholder="请输入身份证" data-rule="身份证:required;idcard;">
                </div>
            </div>
            {/if}
            <div class="ui-form-group">
                <label class="ui-checkbox"><input type="checkbox" name="isdefault" checked value="1"><i></i>设为默认收货地址</label>
            </div>
            <div class="ui-form-group ui-text-center">
            	<input type="hidden" name="token" value="{$token}">
                <input type="submit" class="ui-btn ui-btn-blue" value="保存">
                <input type="button" class="ui-btn ui-modal-close" onClick="{if $add_total>0}$('.ui-form')[0].reset();{/if}" value="取消">
            </div>
            </form>
            <!---->
        </div>

    </div>
    {/if}
    
    {include file="foot.php"}
{if $shop_address_open==1}
<script src="{WEB_ROOT}data/area.js"></script>
<script src="{WEB_ROOT}public/js/address.js"></script>
{/if}
<script>
$(function()
{
	$("#postway li").click(function()
	{
		var type=$(this).attr("data-type");
		var freight={$goods_freight};
		var discount=parseFloat(Number(($("select[name=couponid]").find("option:selected").attr("data-rule"))))+{$goods_discount};

		if(type==1)
		{
			$("#store_id").val('');
			$(".store ul li").each(function()
			{
				$(this).removeClass('hover');
			});
			$("#freight").html({$goods_freight});
			var total={$order_total+$goods_freight};
			var result=parseFloat(Number(total-discount).toFixed(2))
		}
		else
		{
			$("#add_id").val('');
			$(".address ul li").each(function()
			{
				$(this).removeClass('hover');
			});
			$("#freight").html(0);
			var total={$order_total};
			var result=parseFloat(Number(total-discount).toFixed(2))
		}
		$("#order_total").html(result);
	});
	$(".store ul li").click(function()
	{
		var id=$(this).attr("data-id");
		$("#store_id").val(id);
		$(this).siblings().removeClass('hover').end().addClass('hover');
	});
	{if sdcms[shop_paycash_percent]>0}
	$("#payway_1").click(function()
	{
		$("#shop_paycash_percent").addClass("ui-hide");
	});
	$("#payway_2").click(function()
	{
		$("#shop_paycash_percent").removeClass("ui-hide");
	});
	{/if}
	{if $shop_address_open==1}
	$(".address ul li").click(function()
	{
		var url=$(this).attr("data-url");
		if($(this).attr("class")!='add')
		{
			location.href=url;
		}
	});
	{if $add_total==0}
	//没有收货地址时弹出新增
	$('#my-address').modal('show');
	{/if}
	$("#input-address").address({'get':function(json)
	{
		$("#province").val(json.prov);
		$("#city").val(json.city);
		$("#county").val(json.district);
	}});
	$(".ui-form-address").form(
	{
		type:2,
		align:'center',
		result:function(form)
		{
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:'{N("myaddress")}',
				data:$(form).serialize(),
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success(d.msg);
						setTimeout(function(){location.href='{THIS_LOCAL}';},600)
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		}
	});
	{/if}
	//发票类型
	$("input[name=invoice_type]").click(function()
	{
		if($(this).val()==0)
		{
			$(".invoice").addClass("ui-hide");
			
		}
		else
		{
			$(".invoice").removeClass("ui-hide");
		}
	});
	//发票抬头
	$("input[name=invoice_rise]").click(function()
	{
		if($(this).val()==2)
		{
			$(".invoice-company").removeClass("ui-hide");
			$(".invoice-personal").addClass("ui-hide");
		}
		else
		{
			$(".invoice-personal").removeClass("ui-hide");
			$(".invoice-company").addClass("ui-hide");
		}
	});
	//选择优惠券
	$("select[name=couponid]").change(function()
	{
		var discount=parseFloat(Number(($(this).find("option:selected").attr("data-rule"))))+{$goods_discount};
		if($("#postway").find(".active").data("type")==1)
		{
			var total={$order_total+$goods_freight};
		}
		else
		{
			var total={$order_total};
		}
		$("#discount").html(parseFloat(Number(discount).toFixed(2)));
		$("#order_total").html(parseFloat(Number(total-discount).toFixed(2)));
	});

	$(".ui-form").form(
	{
		type:2,
		align:'center',
		result:function(form)
		{
			$.ajax(
			{
				type:'post',
				cache:false,
				dataType:'json',
				url:'{THIS_LOCAL}',
				data:$(form).serialize(),
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success('提交成功');
						setTimeout(function(){location.href=d.msg;},1000)
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		}
	});
})
</script>
</body>
</html>