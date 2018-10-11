<?php
	
	Interface IMsg{
		function auth();
		function receiveMsg($msg);
		function receiveEvent($xml);
		function replyMsg($xml);
		/**
		function receiveVoice();
		function autoReply();
		function customerSend();
		function groupSend();
		function templateMsg();
		**/
	}