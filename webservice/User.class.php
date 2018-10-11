<?php

	include_once 'IUser.php';

	//url /user/info --- request to user auth...

	class ChatUser implements IUser{

		const REDIRECT_URI = HOST.'/user/code';
		const SCOPE = 'snsapi_base';//snsapi_userinfo 弹出界面... //snsapi_base 不弹出界面
		const STATE = 'state'; //请求时非必须

		public function get_info(){

			$uri = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.APPID.'&redirect_uri='.urlencode(self::REDIRECT_URI).'&response_type=code&scope='.self::SCOPE.'&state='.self::STATE.'#wechat_redirect';

			header("location:$uri");

		}

		


	}