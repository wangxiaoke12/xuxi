<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\TokenModel;
class Test extends Controller
{	    
	public function index()
    {	
    
	    //echo $aaa['access_token'];
    	$token = new TokenModel();
    	$data = $token->where('id', '1')->find();
    	$nowtime=time();
	   	$zero1=strtotime (date('Y-m-d H:i:s',time()));
	    $zero2=strtotime ($data['useful_time']);
	    $shicha=ceil(($zero1-$zero2));
	 	if($shicha>=3600){
	    	//post 请求接口 获取新的Access_token
	    	$appid = "wxa104503bc7b7216c";
			$appsecret = "733e6b09895e5ebca63689d5e3cb0ad8";
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			$jsoninfo = json_decode($output, true);
			$access_token = $jsoninfo["access_token"];

			$data->token=$access_token;
			$data->useful_time=$nowtime;
	    	$data->save();
			$access_token=$access_token;
	    }
	    else{
	    	$access_token=$data['token'];
	    }

	       	
    	$url = 'https://api.weixin.qq.com/wxa/getwxacode?access_token='.$access_token;
    	$path="pages/index?query=1";
    	$width=430;
    	$data='{"path":"'.$path.'","width":'.$width.'}';
    	$ccc = curl_init();
	    $header = "Accept-Charset: utf-8";
	    curl_setopt($ccc, CURLOPT_URL, $url);
	    curl_setopt($ccc, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ccc, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ccc, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ccc, CURLOPT_HEADER, 0);//设置header
	    curl_setopt($ccc, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	    curl_setopt($ccc, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ccc, CURLOPT_AUTOREFERER, 1);
	    curl_setopt($ccc, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($ccc, CURLOPT_RETURNTRANSFER, true);
	    $tmpInfo = curl_exec($ccc);
	    //     var_dump($tmpInfo);
	    //    exit;
	    if (curl_errno($ccc)) {
	      return false;
	    }else{
	      //var_dump($tmpInfo);
	      file_put_contents("test.jpg",$tmpInfo);
	     
	      //return $tmpInfo;
	    }

	}

}   