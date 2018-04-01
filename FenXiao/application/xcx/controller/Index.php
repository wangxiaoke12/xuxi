<?php
namespace app\xcx\Controller;
use think\Controller;
class Index extends Controller
{     
	public function index()
    {	
    	$uid = Session::get('name');
    	if($uid != null){
    		return $this->fetch('Index/index');
    	}
    	else{
    		return $this->redirect('/public/admin/Login');
    	}
    }
}