<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\UserModel;
use think\Session;
class Pwd extends Controller
{    
	public function index()
    {	
    	return $this->fetch('Pwd/index');
    }

    public function updata(){
    	$pwd1=input('pwd1');
    	$pwd2=input('pwd2');
        $pwd3=input('pwd3');



        if($pwd1&&$pwd2&&$pwd3&&UserModel::where('openid','=',$pwd1)->column('openid')){
            if($pwd2==$pwd3){
                //Session::delete('name');
                $this->redirect('hsn2/public/admin/main/index');
            }
            else{
                $this->error('新密码不一致！');
            }
        }else{
            $this->error('不可为空或旧密码错误！');
        }
    }

}