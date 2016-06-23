<?php 
    require_once '../conf/Config.php';
    require_once '../services/Services.php';
    /**
     * 
     * @author Jupiter
     *
     * 消费接口类:
     * 用于对支付信息进行重组和签名，并将请求发往现在支付
     * 
     */
    class Pay{
        public function main(){
            $req=array();
            
            $req["mhtOrderName"]=$_GET["mhtOrderName"];
            $req["mhtOrderAmt"]=$_GET["mhtOrderAmt"];
            $req["mhtOrderDetail"]=$_GET["mhtOrderDetail"];
            $req["funcode"]=Config::TRADE_FUNCODE;
            $req["appId"]=Config::$appId;//应用ID
            $req["mhtOrderNo"]=date("YmdHis");
            $req["mhtOrderType"]=Config::TRADE_TYPE;
            $req["mhtCurrencyType"]=Config::TRADE_CURRENCYTYPE;
            $req["mhtOrderTimeOut"]=Config::$trade_time_out;
            $req["mhtOrderStartTime"]=date("YmdHis");
            $req["notifyUrl"]=Config::$back_notify_url;
            $req["frontNotifyUrl"]=Config::$front_notify_url;
            $req["mhtCharset"]=Config::TRADE_CHARSET;
            $req["deviceType"]=Config::TRADE_DEVICE_TYPE;
            $req["mhtReserved"]="test";
            $req["mhtSignature"]=Services::buildSignature($req);
            $req["mhtSignType"]=Config::TRADE_SIGN_TYPE;
            
            
            $req_str=Services::trade($req);
            header("Location:".Config::TRADE_URL."?".$req_str);
        }
    }
    $p=new Pay();
    $p->main();