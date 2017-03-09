<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use yii;
use api\controllers\BaseController;

class WechatsController extends ActiveController
{
	public $modelClass = '';

    protected $MSG_TEXT = 'text';
    protected $MSG_IMAGE = 'image';
    protected $MSG_VOICE = 'voice';
    protected $MSG_VIDEO = 'video';
    protected $MSG_SHORTVIDEO = 'shortvideo'; // 小视频消息
    protected $MSG_LOCATION = 'location'; // 地理位置信息
    protected $MSG_LINK = 'link'; // 链接消息


    protected $MSG_NEWS = 'news';

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


    public function beforeAction($action) {

        parent::beforeAction($action);
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

	public function actionValid() {

	    die('ssss');
		$token = Yii::$app->params['wechat']['token'];

		$signature = Yii::$app->getRequest()->get('signature');
		$timestamp = Yii::$app->getRequest()->get('timestamp');
		$nonce = Yii::$app->getRequest()->get('nonce');
		$echostr = Yii::$app->getRequest()->get('echostr');
		if (!$token) echo 'no has token';
		$tmpArr = array($token, $timestamp, $nonce);
		// use SORT_STRING rule
		sort($tmpArr, SORT_STRING);


		$tmpStr = sha1(implode($tmpArr));
		if ($tmpStr == $signature && $echostr) {
            Yii::info('00000000 \\n', 'wechat');
            echo $echostr;
        } elseif ($tmpStr == $signature && empty($echostr)) { // 这里才是我们开发的业务啊
            Yii::info('111111111111 \\n', 'wechat');
            // $this->look_reply(); // 自动回复关注被关注

			$this->worker(); // 开始实现自己的业务




        } else {
			echo "";
            Yii::info("未知的情况和数据 \n", 'wechat');
        }
	}

	/**
	 * 自己的工作业务
	 */
	public function worker() {

		$this->answer(); // 进行的消息回复
	}

	/**
	 * 各种消息的回复业务
	 */
	public function answer() {

        // Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        Yii::info("接受到的数据是: " . $xml . " \n", 'wechat');
		if ($xml) {
			$xml_obj = simplexml_load_string($xml);
			// 获取消息类型
			if (is_object($xml_obj)) {

				switch (strtolower($xml_obj->MsgType)) {
					case $this->MSG_TEXT:

						$this->_chat_robot($xml_obj);
						break;

                        $use_xml = BaseController::$notice_text;
                        $send_msg = "我也会说: " . $xml_obj->Content . "
                        呵呵哒";
                        $full_use_xml = sprintf($use_xml, $xml_obj->FromUserName, $xml_obj->ToUserName, time(), $this->MSG_TEXT, $send_msg);
                        // Yii::info('---------' . $full_use_xml . '-----------------------', 'wechat');
                        echo $full_use_xml;
                        break;
                    case $this->MSG_IMAGE:
                        $use_xml = BaseController::$notice_image;
                        $full_use_xml = sprintf($use_xml, $xml_obj->FromUserName, $xml_obj->ToUserName, time(), $this->MSG_IMAGE, $xml_obj->MediaId);
                        echo $full_use_xml;
						break;
					case $this->MSG_LOCATION:
						$use_xml = BaseController::$notice_text;
						$send_msg = "你当前所在的纬度是：{$xml_obj->Location_X} \n" .
							"你当前所在的经度是：{$xml_obj->Location_Y} \n" .
							"你当前所在的地址是: {$xml_obj->Label} \n";
						$full_use_xml = sprintf($use_xml, $xml_obj->FromUserName, $xml_obj->ToUserName, time(), $this->MSG_TEXT, $send_msg);
						echo $full_use_xml;
                    default:
                        echo "";
				}

			} else echo "";


		} else echo "";

	}

	/**
	 * 聊天机器人
	 */
	protected function _chat_robot($xml) {

		if (empty($xml->Content)) echo "";
		switch($xml->Content) {
			case '发个测试新闻':
				$use_xml = BaseController::$notice_news;
				$item_xml = <<<XML
<item>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<PicUrl><![CDATA[%s]]></PicUrl>
<Url><![CDATA[%s]]></Url>
</item>
XML;
				$item_data = [
					0 => [
						'title' => '摸金倒斗指南',
						'description' => '《十六字阴阳风水秘术》是一部货真价实的《摸金倒斗指南》',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=529399117,2650328369&fm=214&gp=0.jpg',
						'url' => 'https://github.com/ecomfe/echarts'
					],
					1 => [
						'title' => '摸金倒斗指南',
						'description' => '《十六字阴阳风水秘术》是一部货真价实的《摸金倒斗指南》',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=529399117,2650328369&fm=214&gp=0.jpg',
						'url' => 'https://github.com/ecomfe/echarts'
					],
					2 => [
						'title' => '摸金倒斗指南',
						'description' => '《十六字阴阳风水秘术》是一部货真价实的《摸金倒斗指南》',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=529399117,2650328369&fm=214&gp=0.jpg',
						'url' => 'https://github.com/ecomfe/echarts'
					],
					3 => [
						'title' => '摸金倒斗指南',
						'description' => '《十六字阴阳风水秘术》是一部货真价实的《摸金倒斗指南》',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=529399117,2650328369&fm=214&gp=0.jpg',
						'url' => 'https://github.com/ecomfe/echarts'
					],
					4 => [
						'title' => '摸金倒斗指南',
						'description' => '《十六字阴阳风水秘术》是一部货真价实的《摸金倒斗指南》',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=529399117,2650328369&fm=214&gp=0.jpg',
						'url' => 'https://github.com/ecomfe/echarts'
					],
				];

				$end_item_xml = '';
				foreach ($item_data as $v) {
					$end_item_xml .= sprintf($item_xml, $v['title'], $v['description'], $v['picurl'], $v['url']);
				}
				Yii::info("item数据是 \n" . $end_item_xml . " \n", 'wechat');
				$end_use_xml = sprintf($use_xml, $xml->FromUserName, $xml->ToUserName, time(), 'news', count($item_data), $end_item_xml);
				Yii::info("item数据是 \n" . $end_use_xml . " \n", 'wechat');
				echo $end_use_xml;
				break;
			default:
				echo '';


		}
	}


	public function actionAccesstoken() {

		$cache = Yii::$app->cache;
		if ($access_token = $cache->get('access_token')) {
			return $access_token;
		} else {
			$appid = Yii::$app->params['wechat']['appid'];
			$appsecret = Yii::$app->params['wechat']['appsecret'];
			$token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s";
			$token_url = sprintf($token_url, $appid, $appsecret);
			$data = json_decode(BaseController::CURL($token_url), true);
			if (!empty($data) && isset($data['access_token'])) {

            }
            return false;
		}

	}

	/**
	 * 获取服务器ip地址
	 * @return mixed
	 */
    public function actionServerip() {

        $access_token = $this->actionAccesstoken();
		$url = sprintf("https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=%s", $access_token);
		$ips = json_decode(BaseController::CURL($url), true);
        Yii::info($ips, 'wechat');
		return $ips;
    }

    public function look_reply() {

        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        // $xml = file_get_content('http://input');
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];

        Yii::info("接受到的数据是: " . $xml . " \n", 'wechat');
        $xml_obj = simplexml_load_string($xml);
        if (is_object($xml_obj) || 1) {
            $reply_templete = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
            $reply_templete  = sprintf($reply_templete, $xml_obj->FromUserName, $xml_obj->ToUserName, time(), 'text', "欢迎你关注，这里是小机器人!
呼呼呼");
            if ('event' == $xml_obj->MsgType) {
                echo $reply_templete;
            } else echo "";
        }
    }




}