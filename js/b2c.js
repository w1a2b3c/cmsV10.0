/*搜索为空检查*/
function checksearch(that)
{
	if($.trim(that.keyword.value)=='')
	{
		sdcms.warn('请输入关键字');
		return false;
	}
}

$(function()
{
	/*导航菜单显示*/
	$(".leftnav").hover(function()
    {
        $(".home_nav").removeClass("ui-hide");
    },function()
    {
        $(".home_nav").addClass("ui-hide");
    });
	
	/*首页，列表页，购买链接*/
	$(".buyaction .action a").click(function()
	{
		var goods_id=$(this).parent().attr("data-id");
		var sku=$(this).parent().attr("data-sku");
		var skuurl=$(this).parent().attr("data-url");
		var size=['500px','300px'];
		if(sku!='0')
		{
			size=['500px','440px'];
		}
		$.dialogbox(
		{
			title:"商品规格",
			text:skuurl,
			width:size[0],
			height:size[1],
			type:3,
			footer:false
		});
	});
	
	/*付款方式*/
	if($("#orderpay").length>0)
	{
		$("#orderpay li").click(function()
		{
			var config=$(this).find("img").data("config");
			$("#payway").val(config);
			$(this).siblings().removeClass('active').end().addClass('active');
		})	
	}

	/*迷你购物车*/
	$(".mincart").hover(function()
	{
		var e=$(this);
		var url=e.attr("data-url");
		loadmincart(url);
	});
	
	/*迷你购物车删除*/
	$(document).on("click",".mincart-del",function()
	{
		var e=$(this);
		var url=e.attr("data-url");
		var id=e.attr("data-id");
		var token=e.attr("data-token");
		$.ajax(
		{
			type:'post',
			dataType:'json',
			url:url,
			data:"token="+token+"&id="+id,
			error:function(e){alert(e.responseText);},
			success:function(d)
			{
				if(d.state=='success')
				{
					loadmincart($(".mincart").attr("data-url"));
					get_cartnum($("#cartnum").attr("data-url"),token);
				}
			}
		});
	});
	
	/*游客查订单*/
	$(".ordersearch").click(function()
	{
		var url=$(this).data("url");
		var token=$(this).attr("data-token");
		$.dialogbox(
		{
			title:'订单查询',
			inputholder:'请输入订单号',
			inputval:"",
			maxlength:50,
			type:1,
			ok:function(e)
			{
				var val=e.inputval();
				if(val=='')
				{
					sdcms.error("请输入订单号")
					return;
				}
				$.ajax(
				{
					type:'post',
					cache:false,
					dataType:'json',
					url:url,
					data:'token='+token+'&keyword='+encodeURIComponent(val),
					error:function(e){alert(e.responseText);},
					success:function(d)
					{
						if(d.state=='success')
						{
							e.close();
							setTimeout(function(){location.href=d.msg;},600);
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
	/*分享点击*/
	$(".ui-show-share a").click(function()
	{
		var that=$(this);
		var type=that.data('share');
		var title=document.title;
		var desc=$('meta[name="description"]').length ? $('meta[name="description"]').attr("content"):"";
		var pic=$(".ui-show-body img:first").attr("src") || "";
		var url=document.URL;
		var gourl='';
		switch(type)
		{
			case "qq":
				gourl="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+url+"&title="+title+"&desc=&summary=&site=&pics="+pic;
				break;
			case "weibo":
				gourl="http://service.weibo.com/share/share.php?title="+title+"&url="+url+"&source=bookmark&pic="+pic;
				break;
		}
		if(gourl!='')
		{
			that.attr("href",gourl);
			that.attr("target","_blank");
		}
		else
		{
			$("#qrcode").remove();
			$.dialog(
			{
				title:"分享到微信",
				text:'<div class="ui-text-center"><div id="qrcode" style="width:300px;height:300px;margin:0 auto 15px auto;"></div><p>请打开【微信】，使用【扫一扫】完成分享。</p></div>',
				footer:false
			});
			$("#qrcode").qrcode({width:300,height:300,text:url}); 
		}
	});
});

/*获取迷你购物车数据*/
function loadmincart(url)
{
	$.ajax(
	{
		type:"get",
		url:url,
		cache:true,
		error:function(e){alert(e.responseText);},
		success:function(d)
		{
			$(".cart-detail").html(d);
		}
	});
}
	
/*更新购物车数量*/
function get_cartnum(url,token,type)
{
	$.ajax(
	{
		type:'post',
		url:url,
		data:'token='+token,
		success:function(d)
		{
			if(type=='0')
			{
				$("#cartnum").html(d);
			}
			else
			{
				parent.$("#cartnum").html(d);
			}
		}
	});
}

/*百度自动推送*/
(function()
{
    var bp=document.createElement('script');
    var curProtocol=window.location.protocol.split(':')[0];
    bp.src='https://zz.bdstatic.com/linksubmit/push.js';
    var s=document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp,s);
})();
