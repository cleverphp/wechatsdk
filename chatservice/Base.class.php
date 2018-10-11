<?php

	include_once 'IBase.php';

	class ChatBase implements IBase{

		function getToken(){

			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;

			$res = Utils::http_get($url);

			return json_decode($res,true);

		}

		function getWxIP($token){

			$url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$token;

			$res = Utils::http_get($url);

			return json_decode($res,true);

		}


	}