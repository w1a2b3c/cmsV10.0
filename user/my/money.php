<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>财务明细</title>
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
                    <li>财务明细</li>
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
                        <div class="ui-menu-name">财务明细</div>
                    </div>
                    
                    <div class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                        <a class="ui-btn-group-item{if $type==0} active{/if}" href="{N('mymoney')}">全部</a>
                        <a class="ui-btn-group-item{if $type==1} active{/if}" href="{N('mymoney','','type=1')}">收入</a>
                        <a class="ui-btn-group-item{if $type==2} active{/if}" href="{N('mymoney','','type=2')}">支出</a>
                    </div>
                    
                    <table class="ui-table ui-table-border ui-table-hover ui-mt-15">
                        <thead class="ui-thead-gray">
                            <tr>
                                <th>名称|流水号</th>
                                <th width="100">性质</th>
                                <th width="100">变动前</th>
                                <th width="100">金额</th>
                                <th width="100">变动后</th>
                                <th width="180">日期</th>
                            </tr>
                        </thead>
                        <tbody>
                        {sdcms:rs pagesize="20" table="sd_user_money" where="$where" order="aid desc" key="aid"}
                        {rs:eof}
                        <tr>
                            <td colspan="6">暂无记录</td>
                        </tr>
                        {/rs:eof}
                        <tr>
                            <td class="ui-text-left">{$rs[title]}</td>
                            <td>{iif($rs[types]==1,'收入','<span class="ui-text-gray">支出</span>')}</td>
                            <td>{getprice($rs[oldmoney])}</td>
                            <td>{iif($rs[types]==1,'+','<span>-</span>')} {getprice($rs[amount])}</td>
                            <td>{getprice($rs[newmoney])}</td>
                            <td>{date('Y-m-d H:i:s',$rs[createdate])}</td>
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