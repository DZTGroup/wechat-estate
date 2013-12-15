<?php
/**
 * wechat php test
  */

  //define your token
  define("TOKEN", "weinxinfc_token");
  $wechatObj = new wechatCallbackapiTest();
  $wechatObj->valid();
  $wechatObj->responseMsg();

  class wechatCallbackapiTest
  {
  	public function valid()
	    {
	        $echoStr = $_GET["echostr"];

	        //valid signature , option
	        if($this->checkSignature()){
	            echo $echoStr;
	        }
	    }

	public function responseMsg()
	    {
		    //get post data, May be due to the different environments
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			//$postStr = file_get_contents("php://input");
			//extract post data
			if(!empty($postStr)){

			 $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			 $fromUsername = $postObj->FromUserName;
			 $toUsername = $postObj->ToUserName;
			 $userMsgType=$postObj->MsgType;
			 $time = time();
			 $textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";

                $estate_id=$_REQUEST['estate_id'];

				if($userMsgType=='image')
		    	{
		       		//db connection

					$con = mysql_connect("112.124.55.78","zunhao","655075d7dd");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error());
					}
					mysql_select_db("wxfc", $con);
					$query = "select app_id, app_key from Estate where id='".$estate_id."'";
			        $result = mysql_query($query);
					$app_id=null;
					$app_key=null;
					while($row = mysql_fetch_array($result))
					{
					  	//$estateId=$row[0];
						$app_id=$row[0];
						$app_key=$row[1];

					}
				    
					//mysql_close($con);
				    $url=$postObj->PicUrl;
					$wechatId=$this->getUserName($app_id,$app_key,$fromUsername);
					$insertSql = "insert into Picture_Wall (estate_id,wechat_id,url) values ('".$estate_id."','".$wechatId."','".$url."');";
					mysql_query($insertSql);
					mysql_close($con);
					
					$msgType = "text";
		       		$contentStr = "点击下方‘+’，发送您的位置，刚上传的图片即可展示在‘楼盘实景’，让更多的房友足不出户即可欣赏";
		       		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		       	    	
					echo $resultStr;


		    	}else if($userMsgType=='location'){
                    $location_x=$postObj->Location_X;
                    $location_y=$postObj->Location_Y;

                    $con = mysql_connect("112.124.55.78","zunhao","655075d7dd");
                    if (!$con)
                    {
                        die('Could not connect: ' . mysql_error());
                    }
                    mysql_select_db("wxfc", $con);
                    $query = "select content from Entity where estate_id='".$estate_id."' and status='1'";
                    $result = mysql_query($query);
                    while($row = mysql_fetch_array($result))
                    {
                        $entity_content=$row[0];

                    }

                    $estate_content=json_decode($entity_content, true);

                    $estate_location_lng=$estate_content['location_info']['lng'];
                    $estate_location_lat=$estate_content['location_info']['lat'];

                    $distance=$this->get_dist($location_x,$location_y, $estate_location_lat ,$estate_location_lng);

                    $msgType = "text";
                    if($distance<60){
                        $contentStr = "照片上传成功！";
                    }
                    else{
                        $contentStr="对不起，您不在楼盘的范围内，无法上传照片";
                    }


                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
				}
			}
			 else{
			 		echo "";
					exit;
			 }
		 }

		 private function checkSignature()
		 {
		      $signature = $_GET["signature"];
		      $timestamp = $_GET["timestamp"];
		      $nonce = $_GET["nonce"];

		      $token = TOKEN;
		      $tmpArr = array($token, $timestamp, $nonce);
		      sort($tmpArr);
		      $tmpStr = implode( $tmpArr );
		      $tmpStr = sha1( $tmpStr );
	         if( $tmpStr == $signature ){
	             return true;
	         }else{
	             return false;
	         }
	     
		 }

		 private function getUserName($app_id,$app_key,$open_id){

			$access_url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$app_key;  
			$access = file_get_contents($access_url);  

			$data=json_decode($access, true);

			$getUserInfoUrl="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$data['access_token']."&openid=".$open_id;

			$userInfo = file_get_contents($getUserInfoUrl);

			$user_data=json_decode($userInfo, true);

			return  $user_data['nickname'];


		 }

      private function rad($d)
      {
          return $d * 3.1415926535898 / 180.0;
      }
      private function get_dist($lat1, $lng1, $lat2, $lng2)
      {
          $EARTH_RADIUS = 6378.137;
          $radLat1 = $this->rad($lat1);
          //echo $radLat1;
          $radLat2 = $this->rad($lat2);
          $a = $radLat1 - $radLat2;
          $b = $this->rad($lng1) - $this->rad($lng2);
          $s = 2 * asin(sqrt(pow(sin($a/2),2) +
                  cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
          $s = $s *$EARTH_RADIUS;
          $s = round($s * 10000) / 10000;
          return $s;
      }

  }

?>
