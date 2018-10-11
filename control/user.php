<?php
include_once ROOT.DS.'webservice'.DS.'User.class.php';

class User{

	public function info(){

		$user = new ChatUser;

		$user->get_info();

	}

	public function code(){

		$uri = ' https://api.weixin.qq.com/sns/oauth2/access_token?appid='.APPID.'&secret='.APPSECRET.'&code='.$_GET['code'].'&grant_type=authorization_code';

		$res = Utils::http_get($uri);

		dd($res);

	}



}

return new User;