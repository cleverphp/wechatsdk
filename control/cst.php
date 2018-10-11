<?php
include_once ROOT.DS.'chatservice'.DS.'Customer.class.php';

class Cst{

	function add(){

		$cst = new Customer;

		dd($cst->add());

	}

	function revise(){

		$cst = new Customer;

		dd($cst->revise());

	}

	function delete(){

		$cst = new Customer;

		dd($cst->delete());

	}

	function list(){

		$cst = new Customer;

		dd($cst->getAllCustomer());

	}

}

return new Cst;