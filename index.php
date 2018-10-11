<?php

	defined('DS') or define('DS',DIRECTORY_SEPARATOR);

	defined('ROOT') or define('ROOT',dirname(__FILE__));

	define('APPID',''); //appid
	define('APPSECRET',''); //appsecret

	//for dev convenient only...

	define('ACCESSTOKEN','');

	define('ACCOUNT',''); //your mp account

	define('AUTHTOKEN',''); //token for auth msg from wx...

	define('HOST','');//配置的域名

	include ROOT.DS.'xml.php';

	include ROOT.DS.'utils.php';

	include ROOT.DS.'route'.DS.'route.php';

	$control = include_once ROOT.DS.'control'.DS.$route['ctrl'].'.php';


	if(!$control || !method_exists($control,$route['act'])){

		exit('404 not found...');

	}else{
		call_user_func(array($control,$route['act']));
	}

	