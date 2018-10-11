<?php
include_once ROOT.DS.'chatservice'.DS.'Group.class.php';

class Group{

	function up_img(){

		$gp = new ChatGroup;

		dd($gp->upImg());

	}

}

return new Group;