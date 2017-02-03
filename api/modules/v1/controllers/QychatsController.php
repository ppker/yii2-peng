<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use yii;
use api\controllers\BaseController;
use api\controllers\EncoderController;

class QychatsController extends ActiveController
{
    public $modelClass = '';
    public static $CorpID = 'wx8d363a4644e7047b';
    public static $Secret = 'F5R5CTz8imJKh959Aj5qw1YwnPYWEu_cmSNRTq2MXs7uYuH-lDjzkAm6FL5UOhRh';


    // 企业号回调部分的参数
    public static $Token = 'OxS2KODXTjDSiKzj5y';
    public static $EncodingAESKey = 'lhxXx4SRPXlalrbOPQy1nyEW43ylsky9QoiWLEkL9cc';

    public function behaviors() {

        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }

    public function actions() {

        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function beforeAction($action) {

        parent::beforeAction($action);
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function get_access_token() {

        $cache = Yii::$app->cache;
        if ($access_token = $cache->get('qy_access_token')) return $access_token;
        else {
            $token_url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=%s&corpsecret=%s";
            $token_url = sprintf($token_url, self::$CorpID, self::$Secret);
            $data = json_decode(BaseController::CURL($token_url), true);
            $cache->set('qy_access_token', $data['access_token'], 7000);
            return $data['access_token'];
        }
    }


    /**
     * @return array|int
     * 企业号的入门部分
     */
    public function actionValid() {

        $end_echostr = '';
        $msg_signature = Yii::$app->getRequest()->get('msg_signature');
        $timestamp = (string)Yii::$app->getRequest()->get('timestamp');
        $nonce = Yii::$app->getRequest()->get('nonce');
        $echostr = Yii::$app->getRequest()->get('echostr');

        /*$msg_signature = '74c80b312c93911a2c73d116c1e731e123c374a7';
        $timestamp = '1484105238';
        $nonce = '337801885';
        $echostr = 'ZZGzN2fDLcHDSXKd9QeGw07wuAMHpBIPiABPX0wjj/dv5FRTgyCOe941IH95pJQD7xsQH1fiI/o9JQIs2AhpHw==';*/
        // Yii::info(var_export([$msg_signature, $timestamp, $nonce, $echostr], true), 'qychats');
        if (43 != strlen(self::$EncodingAESKey)) {
            Yii::info("EncodingAESKey是非法的 \n", 'qychats');
            return ['msg' => 'EncodingAESKey是非法的'];
        }

        $encode = new EncoderController(['EncodingAESKey' => self::$EncodingAESKey]);
        $array = $encode->getSHA1(self::$Token, $timestamp, $nonce, $echostr);

        if ($array[0] != 0) return $array[0];
        $signature = $array[1];
        // Yii::info("ggggggggggggggg---" . $signature . "------------{$msg_signature}"  . "--- \n");
        if ($signature != $msg_signature) {
            // return -40001;
        }
        Yii::info("6666666666---{$echostr}bbbbbbb", 'qychats');
        if (!empty($echostr)) {
            $result = $encode->decrypt($echostr, self::$CorpID);
            if ($result[0] != 0) return $result[0];
            echo $result[1];
        } else { // 公司的业务逻辑
            $this->worker();
        }
    }


    /**
     * @return mixed
     * 获取微信服务器ip地址
     */
    public function actionServerip() {

        $url = "https://qyapi.weixin.qq.com/cgi-bin/getcallbackip?access_token=%s";
        $url = sprintf($url, $this->get_access_token());
        $data = json_decode(BaseController::CURL($url), true);
        return $data;
    }

    public function worker() {

        Yii::info("6666666666", 'qychats');
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        if ($xml) {
            $xml_obj = simplexml_load_string($xml);

            Yii::info(is_object($xml_obj) . "fffffffffffffffffffffffffffffff\n");
            if (is_object($xml_obj)) {

                Yii::info($xml_obj->MsgType . "ddddddddddddddd\n");
                if ("text" == $xml_obj->MsgType) {
                    $xml = <<<XML
<xml>
   <ToUserName><![CDATA[%s]]></ToUserName>
   <FromUserName><![CDATA[%s]]></FromUserName>
   <CreateTime>%s</CreateTime>
   <MsgType><![CDATA[%s]]></MsgType>
   <Content><![CDATA[%s]]></Content>
</xml>
XML;
                    $send_msg = "我也会说: " . $xml_obj->Content . "
                        呵呵哒";
                    $end_xml =  sprintf($xml, $xml_obj->FromUserName, $xml_obj->ToUserName, time(), 'text', $send_msg);
                    Yii::info(">>>>{$end_xml}<<<\n");
                    echo $end_xml;

                }
            }
        }
    }

}