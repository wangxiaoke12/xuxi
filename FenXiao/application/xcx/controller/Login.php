<?php
namespace app\xcx\Controller;
use think\Controller;
use app\xcx\model\UserModel;
use think\Session;
class Login extends Controller
{    
	public function index()
    {	
    	return $this->fetch('Login/index');
    }

    public function login(){
    	$user=input('user');
    	$pwd=input('pwd');

    	if(UserModel::where('user_name','=',$user)->column('user_name')){
    		if(UserModel::where('openid','=',$pwd)->column('openid')){
    			Session::set('name','thinkphp','think');
    			$this->redirect('/public/admin/index');
    		}
    		else{
    			$this->error('用户名或密码错误！');
    		}
    	}else{
    		$this->error('用户名或密码错误！');
    	}
    	//$this->redirect('/public/admin/index');
    }
}