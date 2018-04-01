<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\UserModel;
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

    			$this->redirect('/FenXiao/public/admin/index');
    		}
    		else{
    			$this->error('用户名或密码错误！');
    		}
    	}else{
    		$this->error('用户名或密码错误！');
    	}
    	//$this->redirect('/public/admin/index');
    }

    public function del_huancun(){
        //清除session
        Session::delete('name');
    }
}