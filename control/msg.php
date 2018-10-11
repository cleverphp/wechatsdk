<?php
include_once ROOT.DS.'chatservice'.DS.'Msg.class.php';

class Msg{

	function auth(){

		$msg = new ChatMsg;

		$msg->auth();

	}

}

return new Msg;