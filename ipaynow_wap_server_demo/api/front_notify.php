<?php

    require_once '../utils/Log.php';
    require_once '../services/Services.php';
    /**
    * @author Jupiter
    *
    * 前台通知接口
    *
    * 用于被动接收中小开发者支付系统发过来的通知信息，并对通知进行验证签名，
    * 签名验证通过后，商户可对数据进行处理。(交易状态以后台通知为准)
    *
    * 说明:以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己的需要，按照技术文档编写，并非一定要使用该代码。该代码仅供参考
    */
    $response="";
    foreach($_GET as $key=>$value){
    $response.=$key."=".$value."&";
    }
    Log::outLog("网银前台通知接口", $response);
    if (Services::verifySignature($_GET)){
        $tradeStatus=$_GET['tradeStatus'];
        if($tradeStatus!=""&&$tradeStatus=="A001"){
            //支付成功
            echo "支付成功";
            /**
            * 在这里对数据进行处理
            */
        }else{
            //支付失败
            echo "支付失败";
        }
    }else{
        //验证签名失败
    }