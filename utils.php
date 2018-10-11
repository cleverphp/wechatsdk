<?php
	
	class Utils{

		static function http_get($url){

			$curl = curl_init();

			curl_setopt_array($curl,array(
				CURLOPT_URL=>$url,
				CURLOPT_RETURNTRANSFER=>true
			));

			$res = curl_exec($curl);

			curl_close($curl);

			return $res;

		}

		static function post($url,$data){

			$curl = curl_init();

			curl_setopt_array($curl,array(
				CURLOPT_URL=>$url,
				CURLOPT_POSTFIELDS=>$data,
				CURLOPT_RETURNTRANSFER=>true
			));

			$res = curl_exec($curl);

			curl_close($curl);

			return $res;

		}

		static function upload($url,$img){

			$curl = curl_init();

			$data = array('media' => $img);

			curl_setopt_array($curl,array(

				CURLOPT_URL=>$url,
				CURLOPT_POST=>1,
				CURLOPT_HTTPHEADER=>array('Content-type: multipart/form-data'),
				CURLOPT_SAFE_UPLOAD=>false,
				CURLOPT_POSTFIELDS=>http_build_query($data),
				CURLOPT_RETURNTRANSFER=>true
			));

			$res = curl_exec($curl);

			curl_close($curl);

			return $res;


		}

		static function save($ctn){

			file_put_contents('ctn',$ctn);
			
		}


	}


	function dd($msg){

		var_dump($msg);exit;

	}