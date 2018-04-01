<?php
namespace app\xcx\Controller;
use think\Controller;
class Top extends Controller
{	
   	public function index()
    {	
    	return $this->fetch('Top/index');  
    }
}