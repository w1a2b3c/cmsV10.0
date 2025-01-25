<?php if(!defined('IN_B2C')) exit;?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>错误提示</title>
    <style>
       *{margin:0;padding:0}
	   html{font-size:10px;height:100%;}
	   body{font-family:Microsoft YaHei;background:#f0f1f3;font-size:1.4rem;display:flex;align-items:center;justify-content:center;height:100%;}
	   :focus{outline:0}
	   h3{font-weight:700}
	   a{color:#428bca;text-decoration:none}
	   a:hover{text-decoration:underline}
	   .page{background:#f0f1f3;}
	   .page-main{background:#f9f9f9;min-width:600px;padding:50px;box-shadow:0 10px 30px 0 #ccc}
	   .page-main h3{font-size:2.4rem;font-weight:400;border-bottom:1px solid #ddd;padding-bottom:20px;}
	   .page-actions{font-size:0;z-index:100}
	   .page-actions div{font-size:16px;display:block;padding:30px 0 0 10px;box-sizing:border-box;color:#333}
	   .page-actions b{color:#f30;}
	   .page-actions .go{color:#999;font-size:14px;}
	   @media screen and (max-width:640px)
	   {
		   .page-main{min-width:70%;}
		}
    </style>
</head>
<body>

<div class="page">
    <div class="page-main">
        <h3>抱歉，出错啦！</h3>
        <div class="page-actions">
            <div>{$data['msg']}</div>
            <div class="go">
                <b id="wait">10</b> 后页面自动跳转　<a id="href" href="{if $data['url']==''}javascript:history.back(-1);{else}{$data['url']}{/if}">立即跳转</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<script>
(function()
{
	var wait=document.getElementById('wait'),href=document.getElementById('href').href;
	var interval=setInterval(function()
	{
		var time=--wait.innerHTML;
		if(time<=0)
		{
			location.href=href;
			clearInterval(interval);
		};
	},1000);
})();
</script>
</body>
</html>