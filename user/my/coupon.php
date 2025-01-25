<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>我的优惠券</title>
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
                    <li>我的优惠券</li>
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
                        <div class="ui-menu-name">我的优惠券</div>
                    </div>
                    
                    <div class="ui-btn-group ui-btn-group-yellow ui-btn-group-bg">
                        <a class="ui-btn-group-item{if $types==1} active{/if}" href="{N('mycoupon','','types=1')}">未使用</a>
                        <a class="ui-btn-group-item{if $types==2} active{/if}" href="{N('mycoupon','','types=2')}">已使用</a>
                        <a class="ui-btn-group-item{if $types==3} active{/if}" href="{N('mycoupon','','types=3')}">已失效</a>
                    </div>
                    
                    <div class="coupon coupon-user">
                        {sdcms:rs pagesize="8" table="sd_user_coupon a left join sd_market_coupon b on a.cid=b.id" where="userid=$userid $where" order="aid desc" key="aid"}
                        {rs:eof}没有此类优惠券{/rs:eof}
                        <div class="coupon-item">
                            <div class="coupon-top">
                                <sub>￥</sub><span>{str_replace('.00','',$rs[amount])}</span>优惠券
                            </div>
                            <div class="coupon-body">
                                <div class="coupon-name">{$rs[name]}</div>
                                <div class="coupon-intro">截至：<span>{date('Y-m-d',$rs[begintime])}</span> 至 <span>{date('Y-m-d',$rs[endtime])}</span></div>
                            </div>
                        </div>
                       {/sdcms:rs}
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