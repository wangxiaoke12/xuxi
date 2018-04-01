<?php
namespace app\xcx\Controller;
use think\Controller;
class Menu extends Controller
{	
   	public function index()
    {	
    	return $this->fetch('Menu/index');
    }
}