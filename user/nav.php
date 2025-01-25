<?php if(!defined('IN_B2C')) exit;?><ul>
    
    <li><div class="title"><span class="ui-icon-user"></span>会员中心</div></li>
    <li{if ACTION_NAME=='index'} class="hover"{/if}><a href="{N('user')}">个人中心</a></li>
    <li{if ACTION_NAME=='mycoupon'} class="hover"{/if}><a href="{N('mycoupon')}">我的优惠券</a></li>
    <li{if ACTION_NAME=='myfavorite'} class="hover"{/if}><a href="{N('myfavorite')}">我的收藏</a></li>
    <li{if ACTION_NAME=='myaddress'} class="hover"{/if}><a href="{N('myaddress')}">收货地址</a></li>
    <li{if ACTION_NAME=='editpass'} class="hover"{/if}><a href="{N('editpass')}">修改密码</a></li>
    <li><div class="title"><span class="ui-icon-shopping"></span>交易中心</div></li>
    <li{if in_array(ACTION_NAME,['myorder','myordershow','myorderscore'])} class="hover"{/if}><a href="{N('myorder')}">我的订单</a></li>
    <li{if ACTION_NAME=='mymoney'} class="hover"{/if}><a href="{N('mymoney')}">财务明细</a></li>
    <li{if ACTION_NAME=='mypoint'} class="hover"{/if}><a href="{N('mypoint')}">积分明细</a></li>
    {if C('shop_share')>0 && $site_isopen==1}
    <li><div class="title"><span class="ui-icon-moneycollect"></span>分销中心</div></li>
    <li{if in_array(ACTION_NAME,['mysharemoney','mysharecash','mysharecashlist'])} class="hover"{/if}><a href="{N('mysharemoney')}">我的佣金</a></li>
    <li{if ACTION_NAME=='myshare'} class="hover"{/if}><a href="{N('myshare')}">我的分销</a></li>
    {/if}
</ul>