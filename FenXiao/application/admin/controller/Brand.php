<?php
namespace app\admin\Controller;
use think\Controller;
use lib\Page;
use think\Session;
class Brand extends Controller
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
        $data = db('brand')->order('brand_num','ASC')->select();
        $this->assign('brand_select',$data);
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Brand/index');
    }

    public function add_show(){
        return $this->fetch('Brand/add');
    }

    public function add_insert(){
        $file = request()->file('brand_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            $data['brand_name']=input('brand_name');
            $data['brand_pic']=$info->getSaveName();
            $data['brand_num']=input('brand_num');
            $data['brand_goods']="[]";
            db('brand')->insert($data);
            $this->redirect('Brand/index');
    }

    public function del(){
        $id=$_GET['id'];
        db('brand')->where('id',$id)->delete();
        $this->redirect('Brand/index');
    }

    public function updata_show(){
        $id=input('id');
        $arr=db('brand')->where('id',$id)->find();
        $this->assign('brand_select',$arr);
        return $this->fetch('Brand/updata');
    }  

    public function updata_insert(){
        $id = input('id');

        if($file = request()->file('brand_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $car_pic=$info->getSaveName();
        }else{
            $car_pic=db('brand')->where('id',$id)->column('brand_pic');
        }

        db('brand')->where('id',input('id'))->update([
            'brand_name' => input('brand_name'),
            'brand_pic' => $car_pic,
            'brand_num' => input('brand_num')
            ]);
        $this->redirect('Brand/index');
    }

}