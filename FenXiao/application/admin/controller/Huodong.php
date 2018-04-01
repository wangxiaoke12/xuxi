<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\HuodongModel;
use lib\Page;
use think\Session;
class Huodong extends Controller
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
        $data = db('huodong')->select();
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Huodong/index');
    }

    public function add_show(){
        return $this->fetch('huodong/add');
    }

    public function add_insert(){
        $file = request()->file('huodong_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $data['huodong_name']=input('huodong_name');
            $data['huodong_pic']=$info->getSaveName();
            $data['huodong_show']=input('huodong_show');
            $data['huodong_num']=input('huodong_num');
            $data['huodong_time']=input('huodong_time');
            $data['huodong_text']=input('huodong_text');
            $data['huodong_remark']=input('huodong_remark');
            db('huodong')->insert($data);
            $this->redirect('Huodong/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }   

    public function del(){
        $id=$_GET['id'];
        db('huodong')->where('id',$id)->delete();
        $this->redirect('Huodong/index');
    }

    public function updata_show(){
        $id=input('id');
        $arr=db('huodong')->where('id',$id)->find();
        $this->assign('huodong_select',$arr);
        return $this->fetch('Huodong/updata');
    }

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('huodong_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $huodong_pic=$info->getSaveName();
        }else{
            $huodong_pic=db('huodong')->where('id',$id)->column('huodong_pic');
        }

        db('huodong')->where('id',input('id'))->update([
            'huodong_name' => input('huodong_name'),
            'huodong_pic' => $huodong_pic,
            'huodong_show'=>input('huodong_show'),
            'huodong_num'=>input('huodong_num'),
            'huodong_time'=>input('huodong_time'),
            'huodong_text'=>input('huodong_text'),
            'huodong_remark' => input('huodong_remark')
            ]);
        $this->redirect('Huodong/index');
    }

    public function huodong_show(){
        $arr = huodongModel::all(function($query){
            $query->where('huodong_show', '显示')->order('huodong_num', 'desc');
        });

        //var_dump($arr);
        $num=0;
        foreach($arr as $key=>$user){
            $arr[$num]['huodong_pic']="http://47.95.114.183/public/uploads/".
            strtr($user->huodong_pic,"\\","/");
            $num++;
        }
        echo json_encode($arr);
    }

    public function wx_huodong_show(){
        $huodong_id=$_POST['huodong_id'];
        $huodong = new HuodongModel();
        $huodong=$huodong->where('id',$huodong_id)->find();

        $arr_huodong['huodong_name']=$huodong->huodong_name;
        $arr_huodong['huodong_pic']="http://47.95.114.183/public/uploads/".
        strtr($huodong->huodong_pic,"\\","/");
        $arr_huodong['huodong_time']=$huodong->huodong_time;
        $arr_huodong['huodong_text']=$huodong->huodong_text;
        
        echo json_encode($arr_huodong);
    }
}