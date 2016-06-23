<?php
    require_once '../conf/Config.php';
    require_once '../services/Services.php';
    /**
     * 
     * @author Jupiter
     * 
     * 查询接口类
     * 通过订单号查询支付结果情况
     * 说明:以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己的需要，按照技术文档编写，并非一定要使用该代码。该代码仅供参考
     */
    class QueryOrder {
        public function main() {
            $req=array();
            $req["funcode"]=Config::QUERY_FUNCODE;
            $req["appId"]=Config::$appId;
            $req["mhtOrderNo"]="";//商户欲查询交易订单号
            $req["mhtCharset"]=Config::TRADE_CHARSET;
            $req["mhtSignature"]=Services::buildSignature($req);
            $req["mhtSignType"]=Config::TRADE_SIGN_TYPE;
           
            $resp=array();
            Services::query($req, $resp);
            print_r($resp);
        }
    }
    $p=new QueryOrder();
    $p->main();