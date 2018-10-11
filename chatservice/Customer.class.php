<?php

	include_once 'ICustomer.php';

	class Customer implements ICustomer{

		public function add(){

			$url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=".ACCESSTOKEN;

			$data = [

				 "kf_account" => "test1@test",
			     "nickname" => "客服11",
			     "password" => "pswmd5",

			];

			return Utils::post($url,$data);

		}

		public function revise(){

			$url = "https://api.weixin.qq.com/customservice/kfaccount/update?access_token=".ACCESSTOKEN;

			$data = [

				 "kf_account" => "test1@test",
			     "nickname" => "客服11",
			     "password" => "pswmd5",

			];

			return Utils::post($url,$data);
			
		}

		public function delete(){

			$url = "https://api.weixin.qq.com/customservice/kfaccount/del?access_token=".ACCESSTOKEN;

			$data = [

				 "kf_account" => "test1@test",
			     "nickname" => "客服11",
			     "password" => "pswmd5",

			];

			return Utils::post($url,$data);
			
		}

		public function getAllCustomer(){

			$url = "https://api.weixin.qq.com/customservice/kfaccount/getkflist?access_token=".ACCESSTOKEN;

			return Utils::http_get($url);

		}


	}