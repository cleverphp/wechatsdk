<?php
	
	//default route is /home/index

	$uri = substr($_SERVER['REQUEST_URI'],1);

	$uri = explode('/',$uri);

	$ctrl = (isset($uri[0]) && strlen($uri[0]) > 0) ? $uri[0] : 'home';

	$act = (isset($uri[1]) && strlen($uri[1]) > 0) ? $uri[1] : 'index';

	$route = [

		'ctrl' => $ctrl,
		'act' => $act

	];
