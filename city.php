<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
    <title>城市选择_{sdcms[web_name]}</title>
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
                    <li>城市选择</li>
                </ul>
            </div>
            <!--面包屑导航结束-->
            
            <!--城市选择开始-->
            <div class="ui-filter ui-mt-15">
            	
                <div class="ui-row">
                    <div class="ui-col-1 ui-filter-left">全国：</div>
                    <div class="ui-col-11 ui-filter-right">
                        <a href="{WEB_URL}"{if $city==''} class="active"{/if}>进入全国站</a>
                    </div>
                </div>
                {sdcms:rp top="0" table="sd_city" where="site_open=1 and followid=0" order="ordnum,cateid"}
                {php $fid=$rp[cateid]}
                <div class="ui-row">
                    <div class="ui-col-1 ui-filter-left"><a href="{if $rp[site_domain]==1}{C('city_http')}{$rp[site_root]}.{C('city_domain')}{else}{N($rp[site_root],0,'',1)}{/if}">{$rp[name]}</a>：</div>
                    <div class="ui-col-11 ui-filter-right">
                        {sdcms:rs top="0" table="sd_city" where="site_open=1 and followid=$fid" order="ordnum,cateid"}
                            <a href="{if $rs[site_domain]==1}{C('city_http')}{$rs[site_root]}.{C('city_domain')}{else}{N($rs[site_root],0,'',1)}{/if}"{if $city==$rs[site_root]} class="active"{/if}>{$rs[name]}</a>
                        {/sdcms:rs}
                    </div>
                </div>
                {/sdcms:rp}
            </div>
            <!--城市选择结束-->
        </div>
    </div>
    <!--中间部分结束-->
    
    {include file="foot.php"}
</body>
</html>