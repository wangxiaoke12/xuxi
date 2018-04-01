<?php
namespace app\admin\Controller;
use think\Controller;
use think\Session;
class Menu extends Controller
{	
	public function _initialize(){
        $uid = Session::get('name');
        if($uid == null){
            return $this->redirect('Login/index');
        }
    }
    
	public function index()
    {	
    	return $this->fetch('Menu/index');
    }
}