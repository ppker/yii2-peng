<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2016/12/29
 * Project: Cat Visual
 */

namespace api\controllers;

use Yii;

/**
 * Site controller
 */
class BaseController extends \yii\base\Controller {


    static public $notice_text = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>
XML;

    static public $notice_image = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
</xml>
XML;

    static public $notice_voice = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>
</xml>
XML;

    static public $notice_video = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Video>
<MediaId><![CDATA[%s]]></MediaId>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
</Video>
</xml>
XML;

    static public $notice_music = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Music>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
</Music>
</xml>
XML;

    static public $notice_news = <<<XML
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<ArticleCount>%s</ArticleCount>
<Articles>
%s
</Articles>
</xml>
XML;


    public static function CURL($url, $postData = '', $timeOut = 20, $proxy = '', $header = '') {

        $ch = curl_init();

        $options = array(
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36",
            // CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0",
            CURLOPT_TIMEOUT        => $timeOut,
            CURLOPT_RETURNTRANSFER => true, // 成功只返回结果，不自动输出内容
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1,
            // CURLOPT_FOLLOWLOCATION => true, 这个是关于重定向的
        );

        if ("https" == substr($url, 0, 5)) {
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            $options[CURLOPT_SSL_VERIFYHOST] = false;
        }

        //代理
        if ($proxy) {
            $options[CURLOPT_PROXY] = $proxy;
            $options[CURLOPT_PROXYTYPE] = CURLPROXY_SOCKS5;
        }

        //post
        if (!empty($postData)) {
            // 对$postData数据进行处理
            $postData = http_build_query($postData);
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $postData;
            $options[CURLOPT_HTTPHEADER] = ['Content-Type: application/x-www-form-urlencoded; charset=UTF-8', 'Content-Length: ' . strlen($postData)];

            // if (!empty($header)) $options[CURLOPT_HTTPHEADER] = $header; // 注入头部信息
            $options[CURLOPT_ENCODING] = 'gzip'; // 解码
        }
        if (!empty($header)) $options[CURLOPT_HTTPHEADER] = $header; // 注入头部信息
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);


        $info = curl_getinfo($ch);

        // var_dump($info);die;

        if ($info['http_code'] !== 200) {
            $err = curl_error($ch);
            // var_dump($err);die;
            Yii::info(var_export($err, true));
            Yii::info("哈哈哈，MR.Robot find some errors!");
        }
        curl_close($ch);
        return $info['http_code'] !== 200 ? false : $result;
    }

}