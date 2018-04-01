<?php
namespace app\admin\Controller;
use think\Controller;
use lib\Page;
use think\Session;
class Config extends Controller
{   
    public function _initialize(){
        $uid = Session::get('name');
        if($uid == null){
            return $this->redirect('Login/index');
        }
    }
    
    public function index()
    {
        //$data：array,通过select()查询未分页的数据，不能是已经分页的对象
        $data = db('config')->select();
        $this->assign('config_select',$data);
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Config/index');
    }

    public function add_show(){
    	return $this->fetch('Config/add');
    }

    public function add_insert(){
        $data['config_name']=input('config_name');
        $data['config_text1']=input('config_text1');
        $data['config_text2']=input('config_text2');
        $data['config_text3']=input('config_text3');
        $data['config_text4']=input('config_text4');
        $data['config_text5']=input('config_text5');
        $data['config_text6']=input('config_text6');
        $data['config_text7']=input('config_text7');
        db('config')->insert($data);
        $this->redirect('Config/index');
    }

    public function updata_show(){
        $id=input('id');
        $arr=db('config')->where('id',$id)->find();
        $this->assign('config_select',$arr);
        return $this->fetch('Config/updata');
    }

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('config_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $config_pic=$info->getSaveName();
        }else{
            $config_pic=db('config')->where('id',$id)->column('config_pic');
        }

        db('config')->where('id',input('id'))->update([
            'config_pic' => $config_pic,
            'config_name' => input('config_name'),
            'config_phone' => input('config_phone'),
            'config_dizhi' => input('config_dizhi'),
            'config_jieshao' => input('config_jieshao')
            ]);
        /*db('config')->where('id',input('id'))->update([
            'config_text' => input('config_text')
            ]);*/
        $this->redirect('Config/index');
    }

    public function del(){
        $id=$_GET['id'];
        db('config')->where('id',$id)->delete();
        $this->redirect('Config/index');
    }

}
