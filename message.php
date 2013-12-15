<?php
/**
 * wechat php test
  */

  //define your token
  define("TOKEN", "weinxinfc_token");
  $wechatObj = new wechatCallbackapiTest();
//  $wechatObj->valid();
  $wechatObj->responseMsg();
  class wechatCallbackapiTest
  {
  	public function valid()
	    {
	        $echoStr = $_GET["echostr"];

	        //valid signature , option
	        if($this->checkSignature()){
	            echo $echoStr;
	            exit;
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
			 $keyword = trim($postObj->Content);
			 $time = time();
			 $textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
				if($userMsgType=='image')
		    	{
		       		//db connection

					$con = mysql_connect("112.124.55.78","zunhao","655075d7dd");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error());
					}
					mysql_select_db("wxfc", $con);
					$query = "select id from Estate where app_id='".$toUsername."'";
			        $result = mysql_query($query);
					$estateId=null;
					while($row = mysql_fetch_array($result))
					{
					  	$estateId=$row[0];
					}
					
		            mysql_close($con);
				    $url=$postObj->PicUrl;
					$wechatId=$fromUsername;
					$insertSql = "insert into Picture_Wall (estate_id,wechat_id,url) values (".$estateId.",".$wechatId.",".$url.");";
					mysql_query($insertSql);
					mysql_close($con);
					
					$msgType = "text";
		       		$contentStr = "点击下方‘+’，发送您的位置，刚上传的图片即可展示在‘楼盘实景’，让更多的房友足不出户即可欣赏";
		       		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
		       	    	
					$filename = 'log';
					$fh = fopen($filename, "w");
					echo fwrite($fh, $estateId);
					fclose($fh);
					
					echo $resultStr;
		    	}else{
		       		echo "Input something...";
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
}

?>
