<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>提现记录</title>
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
                    <li>提现记录</li>
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
                        <div class="ui-menu-name">提现记录</div>
                    </div>
                    
                    <div class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                        <a class="ui-btn-group-item{if $type==0} active{/if}" href="{N('mysharecashlist')}">全部</a>
                        <a class="ui-btn-group-item{if $type==1} active{/if}" href="{N('mysharecashlist','','type=1')}">处理中</a>
                        <a class="ui-btn-group-item{if $type==2} active{/if}" href="{N('mysharecashlist','','type=2')}">成功</a>
                        <a class="ui-btn-group-item{if $type==3} active{/if}" href="{N('mysharecashlist','','type=3')}">失败</a>
                    </div>
                    
                    <table class="ui-table ui-table-border ui-table-hover ui-mt-15">
                        <thead class="ui-thead-gray">
                            <tr>
                                <th width="100">提现到</th>
                                <th width="100">收款人</th>
                                <th>账户/卡号</th>
                                <th width="100">金额</th>
                                <th width="100">手续费</th>
                                <th width="100">实际到账</th>
                                <th width="100">状态</th>
                                <th width="120">申请日期</th>
                            </tr>
                        </thead>
                        <tbody>
                        {sdcms:rs pagesize="20" table="sd_user_share_cash" where="$where" order="aid desc" key="aid"}
                        {rs:eof}
                        <tr>
                            <td colspan="8">暂无记录</td>
                        </tr>
                        {/rs:eof}
                        <tr>
                            <td>{$rs[blankway]}</td>
                            <td>{$rs[truename]}</td>
                            <td class="ui-text-left">{if !isempty($rs[blankname])}<b>{$rs[blankname]}</b><br>{/if}{$rs[cardid]}</td>
                            <td>{getprice($rs[amount])}</td>
                            <td>{getprice($rs[charge])}</td>
                            <td>{getprice($rs[realmoney])}</td>
                            <td>{if $rs[islock]==1}成功{elseif $rs[islock]==0}处理中{else}失败　<a class="ui-tips text-gray" data-align="top" data-title="原因：{$rs[remark]}"><i class="ui-icon-read"></i></a>{/if}{if !isempty($rs[payurl])}　<a href="{$rs[payurl]}" class="lightbox" title="查看凭证"><i class="ui-icon-camera"></i></a>{/if}</td>
                            <td>{date('Y-m-d H:i',$rs[createdate])}</td>
                        </tr>
                        {/sdcms:rs}
                        </tbody>
                    </table>
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
</body>
</html>