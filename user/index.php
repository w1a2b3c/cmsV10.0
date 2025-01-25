<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>会员中心</title>
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
                    <li>会员中心</li>
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
                        <div class="ui-menu-name">个人中心</div>
                    </div>
                    <div class="user_info">
                        {sdcms:rs top="1" table="sd_user left join sd_user_group on sd_user.uid=sd_user_group.gid" where="id=$userid"}
                        <div class="face"><img src="{$rs[uface]}" width="120" height="120" class="dropzone ui-tips" data-align="bottom" data-title="更换头像" config="uface" url="{U('face','','',1)}" maxsize="{sdcms[upload_image_max]}"></div>
                        <div class="info">
                            <p><span>{get_user_info('umobile')}</span>　{hello_world()}　{if isempty(get_user_info('umobile'))}<a href="javascript:;" class="ui-text-blue edit_mobile">【设置手机号】</a>{/if}</p>
                            <ul>
                                <li><em>级别：</em>{$rs[gname]}</li>
                                <li><em>昵称：</em>{$rs[uname]}<a href="javascript:;" data-title="修改昵称" class="edit_nickname ui-tips"><span class="ui-icon-edit"></span></a></li>
                                <li><em>余额：</em><span>{getprice($rs[umoney])}</span><a class="ui-btn ui-btn-blue ui-btn-sm fr ui-mt-sm" href="{N('pay')}">充值</a></li>
                                <li><em>积分：</em><span>{$rs[upoint]}</span></li>
                                <li><em>折扣：</em><span>{$rs[grate]*100}%</span></li>
                                <li><em>登录：</em><span>{$rs[logintimes]}</span> 次</li>
                            </ul>
                        </div>
                        {/sdcms:rs}
                        <div class="clear"></div>
                    </div>
                    
                    <div class="ui-row">
                        <div class="ui-col-7 ui-pr-20">
                        	<div class="ui-menu ui-menu-blue ui-mb-20">
                                <div class="ui-menu-name">打卡签到</div>
                                <div class="ui-menu-more"><a href="javascript:;" class="ui-modal-show" data-target="#my-modal-sign">签到规则</a></div>
                            </div>
                            <div id="step-1" class="ui-mt-30"></div>
                            <div class="step-bottom ui-row ui-align-items-center"><div class="ui-col-6">{if $sign_result==0}今日签到，将获得<code>{$sign_day}</code>积分。{else}今日已签到{/if}</div><div class="ui-col-6 ui-text-right">{if $sign_result==0}<a href="javascript:;" class="ui-btn ui-btn-blue ui-btn-outline-blue sign">签到</a>{/if}</div></div>
                        </div>
                        <div class="ui-col-5 ui-pl-20">
                        	<div class="ui-menu ui-menu-blue ui-mb-20">
                                <div class="ui-menu-name">充值卡兑换</div>
                            </div>
                            <!---->
                            <form method="post" class="ui-mt-30 ui-post">
                                <div class="ui-form-group">
                                    <div class="ui-input-group">
                                        <span class="before">卡号：</span>
                                        <input type="text" name="cardid" class="ui-form-ip radius-left-none" placeholder="请输入卡号" data-rule="卡号:required;">
                                    </div>
                                </div>
                                <div class="ui-form-group">
                                    <div class="ui-input-group">
                                        <span class="before">密码：</span>
                                        <input type="text" name="cardpass" class="ui-form-ip radius-left-none" placeholder="请输入密码" data-rule="密码:required;">
                                    </div>
                                </div>
                                <div class="ui-form-group">
                                	<input type="hidden" name="token" value="{$token}">
                                	<button type="submit" class="ui-btn ui-btn-block ui-btn-blue">确认兑换</button>
                                </div>
                            </form>
                            <!---->
                        </div>
                    </div>

                    <!--右侧结束-->
                </div>
            </div>
            <!--中间部分结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
	<div class="ui-modal ui-dialog-in" id="my-modal-sign">
        <div class="ui-modal-header">
            <div class="ui-modal-title">签到规则</div>
            <div class="ui-modal-close">×</div>
        </div>
        <div class="ui-modal-body">
        	<ul class="ui-list ui-mb-20">
                <li><div>1、连续签到可以获得对应的天数积分；</div></li>
                <li><div>2、连续<code>7</code>天及以上，最多可获得<code>7</code>分；</div></li>
                <li><div>3、中途断签后，从第<code>1</code>天开始算起。</div></li>
            </ul>
        </div>
        <div class="ui-modal-footer">
            <button class="ui-btn ui-btn-blue ui-modal-close">确定</button>
        </div>
    </div>
    
    {include file="foot.php"}
<script src="{WEB_ROOT}public/js/dropzone.js"></script>
<script>
$(".dropzone").dropzone(
{
	params:{token:"{$token}"},
	maxFiles:1,
	acceptedFiles:".jpg,.jpeg,.gif,.png",
	success:function(file,data,that)
	{
		data=jQuery.parseJSON(data);
		this.removeFile(file);
		if(data.state=="success")
		{
			sdcms.success("上传成功");
			$(that).attr("src",data.msg);
		}
		else
		{
			sdcms.error("上传失败："+data.msg);
		}
	},
	sending:function(file)
	{
		sdcms.loading("正在上传，请稍等");
	},
	totaluploadprogress:function(progress)
	{
		$.progress((Math.round(progress*100)/100)+"%");
	},
	queuecomplete:function(progress)
	{
		$.progress('close');
	},
	error:function(file,msg)
	{
		sdcms.error(msg);
	}
});
$(function()
{
	$("#step-1").step({data:{$sign_data},index:{$sign_day},theme:'{C('theme_color')}',align:'bottom','arrow':true});
	{if isempty(get_user_info('umobile'))}
	$(".edit_mobile").click(function()
	{
		$.dialogbox(
		{
			title:"输入手机号",
			inputval:"",
			maxlength:11,
			type:1,
			ok:function(e)
			{
				var val=e.inputval();
				if(val=='')
				{
					sdcms.error("请输入手机号")
					return;
				}
				$.ajax(
				{
					type:'post',
					cache:false,
					dataType:'json',
					url:'{U("editmobile")}',
					data:'token={$token}&mobile='+encodeURIComponent(val),
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						if(d.state=='success')
						{
							e.close();
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
	{/if}
	$(".edit_nickname").click(function()
	{
		$.dialogbox(
		{
			title:"修改昵称",
			inputval:"{get_user_info('uname')}",
			type:1,
			ok:function(e)
			{
				var val=e.inputval();
				if(val=='{get_user_info('uname')}')
				{
					e.close();
					return;
				}
				$.ajax(
				{
					type:'post',
					cache:false,
					dataType:'json',
					url:'{THIS_LOCAL}',
					data:'token={$token}&nickname='+encodeURIComponent(val),
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
	$(".sign").click(function()
	{
		var that=this;
		$.ajax(
		{
			type:'post',
			cache:false,
			dataType:'json',
			url:'{U("sign")}',
			data:'token={$token}',
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					$(that).css({"display":"none"});
					sdcms.success(d.msg);
					setTimeout(function(){location.href='{THIS_LOCAL}';},1500);
				}
				else
				{
					sdcms.error(d.msg);
				}  
			}
		});
	});
	$(".ui-post").form(
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
				url:'{U("index/change")}',
				data:$(form).serialize(),
				error:function(e){alert(e.responseText);},
				success:function(d)
				{
					if(d.state=='success')
					{
						sdcms.success(d.msg);
						setTimeout(function(){location.href='{THIS_LOCAL}';},1500);
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
</script> 
</body>
</html>