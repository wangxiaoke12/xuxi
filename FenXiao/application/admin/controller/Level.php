<?php
namespace app\admin\Controller;
use think\Controller;
use lib\Page;
use think\Session;
class Level extends Controller
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
        $data = db('level')->select();
        $this->assign('level_select',$data);
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Level/index');
    }

    public function add_show(){
        return $this->fetch('Level/add');
    }

    public function add_insert(){
        $file = request()->file('level_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $data['level_pic']=$info->getSaveName();
            $data['level_name']=input('level_name');
            $data['level_remark']=input('level_remark');
            db('level')->insert($data);
            $this->redirect('Level/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public function del(){
        $id=$_GET['id'];
        db('level')->where('id',$id)->delete();
        $this->redirect('Level/index');
    }

    public function updata_show(){
        $id=input('id');
        $arr=db('level')->where('id',$id)->find();
        $this->assign('level_select',$arr);
        return $this->fetch('Level/updata');
    }  

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('level_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $level_pic=$info->getSaveName();
        }else{
            $level_pic=db('level')->where('id',$id)->column('level_pic');
        }

        db('level')->where('id',input('id'))->update([
            'level_name' => input('level_name'),
            'level_pic' => $level_pic,
            'level_remark' => input('level_remark')
            ]);
        $this->redirect('Level/index');
    }

}