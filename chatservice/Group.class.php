<?php

	include_once 'IGroup.php';

	class ChatGroup implements IGroup{

		function upImg(){

			$url = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token='.ACCESSTOKEN;

			$img = new \CURLFile('@/www/wxsdktest/timg.jpg');

			return Utils::upload($url,$img);

		}


	}