<?php if(!defined('IN_B2C')) exit;?>{include file="top.php"}
<title>查看原因</title>
</head>

<body>

<div class="ui-p-20">
    <div class="myordershow">
        <div class="other">
            <h3>订单号：{$order_no}</h3>
            <ul>
                <li>退款方式：{if $refund['types']==1}仅退款{elseif  $refund['types']==2}退款退货{/if}</li>
                <li>退款金额：{$refund['refundmoney']}</li>
                <li>退款原因：{$refund['refundwhy']}</li>
                {if $refund['postcompany']!=''}<li>快递公司：{$refund['postcompany']}</li>
                <li>快递单号：{$refund['postno']}</li>{/if}
            </ul>
            <div class="ui-line"></div>
            <ul>
                <li>
                    拒绝原因：{$refund['backwhy']}
                </li>
            </ul>
        </div>
    </div>
</div>
    
</body>
</html>