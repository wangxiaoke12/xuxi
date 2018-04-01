<?php
namespace app\xcx\Controller;
use think\Controller;
class Bar extends Controller
{	
   
	public function index()
    {	
    	return $this->fetch('Bar/index');
    }
}