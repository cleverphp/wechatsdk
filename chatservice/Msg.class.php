<?php

	include_once 'IMsg.php';

	class ChatMsg implements IMsg{

		//when receive msg from client,this func must be executed...
		public function auth(){

			$token = AUTHTOKEN; //Your Token
			$tmpArr = array($_GET['timestamp'],$_GET['nonce'],$token);
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );

			//if not reply within 5s,wx will retry...for example large scale visiting,so reply empty string first to prevent retry...
			if($tmpStr == $_GET['signature']){ //authed from wx...
				
				//echo ''; for reply test...
				//echo $_GET['echostr'];
				//
				$msgStr = file_get_contents("php://input");

				//if in large scale,we can use 客服消息接口 then...
				
				$this->receiveMsg($msgStr);
				
			}

		}

		public function receiveMsg($msg){

				$xml = simplexml_load_string($msg,'SimpleXMLElement',LIBXML_NOCDATA); //take cdata as text...

				if(!is_object($xml) or !property_exists($xml,'MsgType')){
					return false;
				}

				switch($xml->MsgType){

					//this is ordinary msg...
					case 'text':
						$this->receiveText($xml);
						break;
					case 'image':
						$this->receiveImg($xml);
						break;
					case 'voice':
						$this->receiveVoice($xml);
						break;
					case 'video':
						$this->receiveVideo($xml);
						break;
					case 'shortvideo':
						$this->receiveShortVideo($xml);
						break;
					case 'location':
						$this->receiveLocation($xml);
						break;
					case 'link':
						$this->receiveLink($xml);
						break;
					//this is event msg
					case 'event':
						$this->receiveEvent($xml);
					default:
						break;

				}

		}

		public function receiveEvent($xml){

			switch($xml->Event){

					//this is ordinary msg...
					case 'subscribe':
						$this->receiveEsubscribe($xml);//分为二维码事件和非二维码事件
						break;
					case 'unsubscribe':
						$this->receiveEunsubscribe($xml);
						break;
					case 'SCAN':
						$this->receiveEscan($xml);
						break;
					case 'LOCATION':
						$this->receiveElocation($xml);
						break;
					case 'CLICK':
						$this->receiveEclick($xml);
						break;
					default:
						break;

			}

		}

		//just for implements...
		public function replyMsg($xml){
			//use private func...
			$this->replyTextMsg($xml->FromUserName);//you can directly use private reply func...
			//others too similar,just ignore...
		}

		//@param string $toUser $xml->FromUserName
		private function replyTextMsg($toUser){

			$xml = new CDATAXML('<xml/>');

			$xml->ToUserName = NULL; 
			$xml->ToUserName->addCData($toUser);

			$xml->FromUserName = NULL; 
			$xml->FromUserName->addCData(ACCOUNT);

			$xml->CreateTime = NULL; 
			$xml->CreateTime->addCData(time());

			$xml->MsgType = NULL; 
			$xml->MsgType->addCData("text");

			$xml->Content = NULL; 
			$xml->Content->addCData("消息已收到..."); //回复的内容

			Header('Content-type: text/xml');
			echo $xml->asXML();

		}

		private function receiveEscan($xml){
			/**
			 * ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	消息类型，event
				Event	事件类型，SCAN
				EventKey	事件KEY值，是一个32位无符号整数，即创建二维码时的二维码scene_id
				Ticket	二维码的ticket，可用来换取二维码图片
			 */

		}

		private function receiveElocation($xml){
			/**
			 * ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	消息类型，event
				Event	事件类型，LOCATION
				Latitude	地理位置纬度
				Longitude	地理位置经度
				Precision	地理位置精度
			 */
			
		}

		private function receiveEclick($xml){
			/**
			 *  ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	消息类型，event
				Event	事件类型，CLICK
				EventKey	事件KEY值，与自定义菜单接口中KEY值对应
			 */
			
		}

		private function receiveEunsubscribe($xml){

			/**
			 * ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	消息类型，event
				Event	事件类型，subscribe(订阅)、unsubscribe(取消订阅)
			 */

		}

		private function receiveEsubscribe($xml){

			if(property_exists($xml,'Ticket')){

				//二维码关注事件
				
				/**
				 *  ToUserName	开发者微信号
					FromUserName	发送方帐号（一个OpenID）
					CreateTime	消息创建时间 （整型）
					MsgType	消息类型，event
					Event	事件类型，subscribe
					EventKey	事件KEY值，qrscene_为前缀，后面为二维码的参数值
					Ticket	二维码的ticket，可用来换取二维码图片
				 */

			}else{

				//非二维码关注事件
				
				/**
				 *  ToUserName	开发者微信号
					FromUserName	发送方帐号（一个OpenID）
					CreateTime	消息创建时间 （整型）
					MsgType	消息类型，event
					Event	事件类型，subscribe(订阅)、unsubscribe(取消订阅)
				 */
				
				//Utils::save($xml->FromUserName);

			}



		}

		private function receiveText($xml){

			/**
			 * ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	text
				Content	文本消息内容
				MsgId	消息id，64位整型
			 */
			
			 $this->replyMsg($xml); //for test only...

		}

		private function receiveImg($xml){

			/**
			 * ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	image
				PicUrl	图片链接（由系统生成）
				MediaId	图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
				MsgId	消息id，64位整型
			 */
			

			
		}

		private function receiveVoice($xml){

			/**
			 * 	ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	语音为voice
				MediaId	语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
				Format	语音格式，如amr，speex等
				MsgID	消息id，64位整型
			 */
			
			
		}

		private function receiveVideo($xml){

			/**
			 * ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	视频为video
				MediaId	视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
				ThumbMediaId	视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
				MsgId	消息id，64位整型
			 */
			
			
		}

		

		private function receiveShortVideo($xml){

			/**
			 *  ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	小视频为shortvideo
				MediaId	视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
				ThumbMediaId	视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
				MsgId	消息id，64位整型
			*/
			
		}

		private function receiveLocation($xml){

			/**
			 * 	ToUserName	开发者微信号
				FromUserName	发送方帐号（一个OpenID）
				CreateTime	消息创建时间 （整型）
				MsgType	location
				Location_X	地理位置维度
				Location_Y	地理位置经度
				Scale	地图缩放大小
				Label	地理位置信息
				MsgId	消息id，64位整型
			 */
			
			
		}

		private function receiveLink($xml){

			/**
			 *  ToUserName	接收方微信号
				FromUserName	发送方微信号，若为普通用户，则是一个OpenID
				CreateTime	消息创建时间
				MsgType	消息类型，link
				Title	消息标题
				Description	消息描述
				Url	消息链接
				MsgId	消息id，64位整型
			 */
			

		
			
		}




	}