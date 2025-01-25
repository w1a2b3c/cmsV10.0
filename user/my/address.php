<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>收货地址</title>
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
                    <li><a href="{N('user')}">会员中心</a></li>
                    <li>收货地址</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--中间部分开始-->
            <div class="box-base box-user ui-row">
            	<div class="ui-col-2 border-right usernav">
                	<!--左侧开始-->
                    {include file="user/nav.php"}
                    <!--左侧结束-->
                </div>
                <div class="ui-col-10 ui-pl-30 ui-pr-30 ui-pb-15">
                	<!--右侧开始-->
                    <div class="ui-menu ui-menu-blue ui-mt-15 ui-mb-20">
                        <div class="ui-menu-name">收货地址</div>
                    </div>
                    {php $shop_address_list=explode(',',C("shop_address_list"))}
                    <div class="user_address">
                	<ul>
                        {sdcms:rs top="0" table="sd_user_address" where="userid=$userid" order="id"}
                        <li {if $rs[isdefault]==1}class="hover"{/if}>
                        	<div class="pd">
                            	<h4>{if $rs[isdefault]==1}<span class="am-icon-check"></span>{/if}{$rs[name]}</h4>
                                <p>
                                {if in_array(2,$shop_address_list)}{$rs[mobile]}<br>{/if}
                                {if in_array(3,$shop_address_list)}{$rs[qq]}<br>{/if}
                                {if in_array(4,$shop_address_list)}{$rs[email]}<br>{/if}
                                {if in_array(5,$shop_address_list)}{$rs[province]} {$rs[city]} {$rs[county]}<br>
                                {$rs[street]}{/if}
								{if in_array(6,$shop_address_list)}{$rs[idcard]}{/if}
                            </div>
                            <div class="bt"><a href="{U('myaddress',"id=".$rs[id]."")}"><span class="ui-icon-edit"></span> 编辑</a>　<a href="javascript:;" class="del" data-url="{N('myaddress','','act=del&id='.$rs[id].'')}"><span class="ui-icon-delete"></span> 删除</a></div>
                            <i class="ui-icon-home"></i>
                        </li>
                        {/sdcms:rs}
                        <li class="add">
                        	<a href="javascript:;" class="ui-modal-show" data-target="#mymodal-address"><span class="ui-icon-plus"></span>新增地址</a>
                        </li>
                    </ul>
                </div>
                    
                    <!--右侧结束-->
                </div>
            </div>
            <!--中间部分结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    <div class="ui-modal" id="mymodal-address">
        <div class="ui-modal-header">
            <div class="ui-modal-title">{if $id==0}新增{else}编辑{/if}收货地址</div>
            <div class="ui-modal-close rotate">×</div>
        </div>
        <div class="ui-modal-body">
        	<!---->
            
            <form class="ui-form" method="post">
            {if in_array(1,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-user"></span></span>
                    <input type="text" name="name" class="ui-form-ip radius-left-none" maxlength="20" value="{$name}" placeholder="请输入收货人" data-rule="收货人:required;">
                </div>
            </div>
            {/if}
            {if in_array(2,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-mobile"></span></span>
                    <input type="text" name="mobile" class="ui-form-ip radius-left-none" maxlength="11" value="{$mobile}" placeholder="请输入手机号码" data-rule="手机号码:required;mobile;">
                </div>
            </div>
            {/if}
            {if in_array(3,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-qq"></span></span>
                    <input type="text" name="qq" class="ui-form-ip radius-left-none" maxlength="20" value="{$qq}" placeholder="请输入QQ号码" data-rule="QQ号码:required;qq;">
                </div>
            </div>
            {/if}
            {if in_array(4,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-mail"></span></span>
                    <input type="text" name="email" class="ui-form-ip radius-left-none" maxlength="50" value="{$email}" placeholder="请输入邮箱" data-rule="邮箱:required;email;">
                </div>
            </div>
            {/if}
            {if in_array(5,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-contacts"></span></span>
                    <input type="hidden" name="province" id="province" value="{$province}">
                    <input type="hidden" name="city" id="city" value="{$city}">
                    <input type="hidden" name="county" id="county" value="{$county}">
                    <input type="text" name="area" class="ui-form-ip radius-left-none" readonly id="input-address" data-val="{$province}/{$city}/{$county}" value="{$province}{$city}{$county}" placeholder="请选择所在地区" data-rule="地区:required;">
                </div>
            </div>
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-location"></span></span>
                    <input type="text" name="street" class="ui-form-ip radius-left-none" value="{$street}" placeholder="请输入详细地址" data-rule="详细地址:required;">
                </div>
            </div>
            {/if}
			{if in_array(6,$shop_address_list)}
            <div class="ui-form-group">
                <div class="ui-input-group">
                    <span class="before"><span class="ui-icon-idcard"></span></span>
                    <input type="text" name="idcard" class="ui-form-ip radius-left-none" maxlength="50" value="{$idcard}" placeholder="请输入身份证" data-rule="身份证:required;idcard;">
                </div>
            </div>
            {/if}
            <div class="ui-form-group">
                <label class="ui-checkbox"><input type="checkbox" name="isdefault"{if $isdefault==1} checked{/if} value="1"><i></i>设为默认收货地址</label>
            </div>
            <div class="ui-form-group ui-text-center">
            	<input type="hidden" name="token" value="{$token}">
                <input type="submit" class="ui-btn ui-btn-blue" value="保存">
                <input type="button" class="ui-btn ui-modal-close" onClick="{if $id==0}$('.ui-form')[0].reset();{else}location.href='{U('myaddress')}'{/if}" value="取消">
            </div>
            </form>
            <!---->
        </div>

    </div>
    
    {include file="foot.php"}
<script src="{WEB_ROOT}public/js/address.js"></script> 
<script src="{WEB_ROOT}data/area.js"></script>
<script>
$(function()
{
	{if $id>0}
	$('#mymodal-address').modal('show');
	{/if}
	$("#input-address").address({'get':function(json)
	{
		$("#province").val(json.prov);
		$("#city").val(json.city);
		$("#county").val(json.district);
	}});
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
						sdcms.success(d.msg);
						setTimeout(function(){location.href='{N("myaddress")}';},600)
					}
					else
					{
						sdcms.error(d.msg);
					}
				}
			});
		}
	});
	$(".del").click(function()
	{
		var url=$(this).attr("data-url");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要删除？不可恢复！",
			ok:function(e)
			{
				$.ajax(
				{
					url:url,
					type:'get',
					dataType:'json',
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						e.close();
						if(d.state=='success')
						{
							sdcms.success(d.msg);
							setTimeout(function(){location.href='{THIS_LOCAL}';},1000);
						}
						else
						{
							sdcms.error(d.msg);
						}
					}
				});
			}
		});
	});
});
</script>
</body>
</html>