<?php

include_once ROOT.DS.'chatservice'.DS.'Base.class.php';



class Base{

	function token(){

		$base = new ChatBase;

		$token = $base->getToken();

		var_dump($token); //actually we will store access token for using long time as request limited...

	}

	function ip(){

		$base = new ChatBase;

		$ip = $base->getWxIP(ACCESSTOKEN);

		var_dump($ip);

	}


}

return new Base;