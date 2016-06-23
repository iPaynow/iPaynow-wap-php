<?php
    require_once '../utils/Log.php';
    require_once '../services/Services.php';
    /**
    * @author Jupiter
    *
    * 通知接口
    *
    * 用于被动接收中小开发者支付系统发过来的通知信息，并对通知进行验证签名，
    * 签名验证通过后，商户可对数据进行处理。
    *
    * 通知频率:2min、10min、30min、1h、2h、6h、10h、15h
    * 说明:以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己的需要，按照技术文档编写，并非一定要使用该代码。该代码仅供参考
    */
    $request=file_get_contents('php://input');
    Log::outLog("网银通知接口", $request);
    parse_str($request,$request_form);
    if (Services::verifySignature($request_form)){
        $tradeStatus=$request_form['tradeStatus'];
        echo "success=Y";
        if($tradeStatus!=""&&$tradeStatus=="A001"){
            /**
            * 在这里对数据进行处理
            */
        }
        //支付失败
    }
    //验证签名失败