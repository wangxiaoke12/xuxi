<?php
namespace app\admin\Controller;
use think\Controller;
use think\Session;
class Index extends Controller
{   
    public function _initialize(){
        $uid = Session::get('name');
        if($uid == null){
            return $this->redirect('Login/index');
        }
    }
    
	public function index()
    {	
    	$uid = Session::get('name');
    	if($uid != null){
    		return $this->fetch('Index/index');
    	}
    	else{
    		return $this->redirect('Login/index');
    	}
    }
}