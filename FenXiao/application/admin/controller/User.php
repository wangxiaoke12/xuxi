<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\UserModel;
class User extends Controller
{	
	public function user_add(){
		$openid=$_POST['openid'];
		$name=$_POST['name'];
		$sex=$_POST['sex'];
		$user = new UserModel;
		//$openid=2;
		$data = UserModel::where('openid',$openid)->value('openid');
		if($data){
			echo "用户已存在";
		}else{
			$user->openid = $openid;
			$user->user_name = $name;
			$user->user_sex = $sex;
			$user->user_time = time();
			$user->save();
		}
		
	}

	public function transTime($ustime){//判断时间 是否是今天 记录用户访问量
		$rtime = time();             
		$htime = date("H:i",$ustime);  	           
		$time = time() - $ustime;   	          
		$todaytime = strtotime("today"); 	            
		$time1 = time() - $todaytime;  	                           
		if($time < $time1){                    
			$str = 1;             
		}else{                    
			$str = $rtime;
		}                
		return $str;  
	}

	public function love_car(){//喜欢车型记录
		$openid=$_POST['openid'];
		$id=$_POST['id'];
		$user = new UserModel;
		$data = UserModel::where('openid',$openid)->value('user_love_car');
		$arr=json_decode($data,true);
		if($data){//第一次判断 记录是否为空
			if(@$arr[$id]>=1){
				$arr[$id]=$arr[$id]+1;
			}
			else{
			  	//array_push($arr,"yellow");
			  	$arr[$id]=1;
			}
		}else{//为空
			$arr[$id]=1;
		}
		$user->save(['user_love_car'  => json_encode($arr)]
			,['openid' => $openid]);
		
	} 
}

