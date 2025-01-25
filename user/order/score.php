<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>商品评价</title>
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
                    <li>商品评价</li>
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
                        <div class="ui-menu-name">商品评价</div>
                    </div>
                    
                    <div class="myordershow">
                        <h2>订单号：{$order_no}</h2>
                        <div class="goodslist">
                            <div class="goods_subject">
                                <span class="item name">商品</span>
                                <span class="score">评价</span>
                            </div>
                            <form class="ui-form" method="post">
                            {sdcms:rs top="0" table="sd_order_list" where="orderid=$id"}
                            {php $goodsid=$rs[goods_id];}
                            <div class="goods_item">
                                <span class="item name"><span class="pic"><img src="{$rs[goods_pic]}"></span><a href="{U('goodsshow','id='.$rs[goods_id].'')}" target="_blank">{$rs[goods_name]} {$rs[goods_skuname]}</a></span>
                                <span class="score">
                                    <div class="ui-star" data-max="5" data-num="0" data-target="#score_{$rs[aid]}" data-full='<i class="ui-icon-star-fill"></i>' data-empty='<i class="ui-icon-star"></i>'></div>
                                    <input type="hidden" name="goodsid[]" value="{$rs[goods_id]}">
                                    <input type="hidden" name="score[]" id="score_{$rs[aid]}" value="" maxlength="1" data-rule="评分:required;">
                                    <textarea name="evaluate[]" placeholder="请输入您的评价" data-rule="评价:required;"></textarea>
                                    <span class="imgbox ui-icon-camera dropzone ui-tips" data-name="piclist[{$i-1}]" data-target="piclist_{$rs[goods_id]}" url="{U('upload/upfile','type=1&orderid='.$id.'&goodsid='.$rs[goods_id].'')}" maxsize="{C('upload_image_max')}" title="晒图"></span>
                                    <span class="score-imglist" id="piclist_{$rs[goods_id]}">
                                        {sdcms:rf table="sd_order_score_file" where="orderid=$id and goodsid=$goodsid and state=0" auto="j"}
                                        <span num="{$j}"><input type="hidden" name="piclist[{$i-1}][{$j}]" value="{$rf[url]}"><img src="{$rf[url]}"><em class="ui-icon-delete" data-id="{$rf[id]}" data-orderid="{$id}"></em></span>
                                        {/sdcms:rf}
                                    </span>
                                </span>
                            </div>
                            {/sdcms:rs}
                            <div class="scorebtn">
                            	<input type="hidden" name="token" value="{$token}">
                                <input type="submit" value="提交评价" class="ui-btn ui-btn-blue">
                            </div>
                            </form>
                        </div>
                        
                    </div>
                    
                    <!--右侧结束-->
                </div>
            </div>
            <!--中间部分结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script src="{WEB_ROOT}public/js/dropzone.js"></script>
<script>
$(function()
{
	$(document).on("click",".ui-icon-delete",function()
	{
		var that=this;
		var id=$(this).attr("data-id");
		var orderid=$(this).attr("data-orderid");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要删除？",
			ok:function(e)
			{
				e.close();
				$.ajax(
				{
					url:'{U("delfile")}',
					type:'post',
					data:'token={$token}&id='+id+'&orderid='+orderid,
					dataType:'json',
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						if(d.state=='success')
						{
							$(that).parent().remove();
						}
						else
						{
							sdcms.error(d.msg)
						}
					}
				});
			}
		});
	});
	$(".ui-form").form(
	{
		type:2,
		hide:2,
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
						setTimeout(function(){location.href='{N("myorder")}';},1000);
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
$(".dropzone").dropzone(
{
	params:{token:"{$token}"},
	maxFiles:5,
	success:function(file,data,that)
	{
		data=jQuery.parseJSON(data);
		this.removeFile(file);
		if(data.state=="success")
		{
			var name=$(that).attr("data-name");
			var num=1;
			$("#"+$(that).attr("data-target")+" span").each(function()
			{
				var max=parseInt($(this).attr("num"));
				if(max>=num)
				{
					num=max+1;
				}
			});
			var html='<span num="'+num+'"><input type="hidden" name="'+name+'['+num+']" value="'+data.msg+'"><img src="'+data.msg+'" ><em class="ui-icon-delete" data-id="'+data.id+'" data-orderid="{$id}"></em></span>';
			$("#"+$(that).attr("data-target")).append(html);
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
</script>
</body>
</html>