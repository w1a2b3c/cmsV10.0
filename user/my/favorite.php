<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>我的收藏</title>
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
                    <li>我的收藏</li>
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
                        <div class="ui-menu-name">我的收藏</div>
                    </div>
                    
                    <div class="ui-piclist ui-piclist-col-4 ui-piclist-1-1 ui-piclist-100 ui-piclist-top ui-mt-20">
                        {sdcms:rs pagesize="16" field="id,pic,title,a.createdate,aid,alias,classid" table="sd_user_favorite a left join sd_goods b on a.goodsid=b.id" where="userid=$userid" order="aid" key="aid"}
                        {rs:eof}<div class="ui-font-16 ui-ml">暂无收藏</div>{/rs:eof}
                        <div class="ui-piclist-item">
                            <div class="ui-piclist-image"><a href="{U('goodsshow','id='.$rs[id].'')}" target="_blank"><img src="{$rs[pic]}"></a></div>
                            <div class="ui-piclist-body">
                                <div class="ui-piclist-title ui-text-hide">{$rs[title]}</div>
                                    <div class="ui-piclist-flex">
                                        <div class="ui-piclist-price"><i class="ui-icon-reloadtime ui-text-gray ui-mr-sm"></i>{date('Y-m-d',$rs[createdate])}</div>
                                        <div class="action"><a href="javascript:;" class="ui-btn ui-btn-blue ui-btn-sm del" data-id="{$rs[aid]}">删除</a></div>
                                    </div>
                            </div>
                        </div>
                        {/sdcms:rs}
                    </div>
                    <div class="ui-page ui-page-center ui-mt-15">
                        <ul>{$showpage}</ul>
                    </div>
                    
                    <!--右侧结束-->
                </div>
            </div>
            <!--中间部分结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
<script>
$(function()
{
	$(".del").click(function()
	{
		var id=$(this).attr("data-id");
		$.dialog(
		{
			title:"操作提示",
			text:"确定要删除？不可恢复！",
			ok:function(e)
			{
				$.ajax(
				{
					url:'{THIS_LOCAL}',
					type:'post',
					dataType:'json',
					data:'token={$token}&id='+id,
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
})
</script>
</body>
</html>