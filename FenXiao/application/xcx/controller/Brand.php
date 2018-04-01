<?php
namespace app\xcx\Controller;
use think\Controller;
use lib\Page;
class Brand extends Controller
{     
    public function index()
    {

        //$data：array,通过select()查询未分页的数据，不能是已经分页的对象
        $data = db('brand')->select();
        $this->assign('brand_select',$data);
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        //return $this->fetch('Brand/index');
    }

    public function add_show(){
        return $this->fetch('Brand/add');
    }

    public function add_insert(){
        $file = request()->file('brand_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $data['brand_pic']=$info->getSaveName();
            $data['brand_name']=input('brand_name');
            $data['brand_remark']=input('brand_remark');
            db('brand')->insert($data);
            $this->redirect('Brand/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
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
            $brand_pic=$info->getSaveName();
        }else{
            $brand_pic=db('brand')->where('id',$id)->column('brand_pic');
        }

        db('brand')->where('id',input('id'))->update([
            'brand_name' => input('brand_name'),
            'brand_pic' => $brand_pic,
            'brand_remark' => input('brand_remark')
            ]);
        $this->redirect('Brand/index');
    }

}