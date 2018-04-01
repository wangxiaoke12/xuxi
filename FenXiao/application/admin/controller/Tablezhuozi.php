<?php
namespace app\admin\Controller;
use think\Controller;
use think\Session;
use app\admin\model\TablezhuoziModel;
use lib\Page;
class Tablezhuozi extends Controller
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
        $data = db('table_zhuozi')->select();
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Tablezhuozi/index');
    }

    public function add_show(){
        return $this->fetch('Tablezhuozi/add');
    }

     public function add_insert(){
        $file = request()->file('tablezhuozi_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $data['table_name']=input('tablezhuozi_name');
            $data['table_pic']=$info->getSaveName();
            $data['table_renshu']=input('tablezhuozi_renshu');
            db('table_zhuozi')->insert($data);
            $this->redirect('tablezhuozi/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public function del(){
        $id=$_GET['id'];
        db('table_zhuozi')->where('id',$id)->delete();
        $this->redirect('tablezhuozi/index');
    }

     public function updata_show(){
        $id=input('id');
        $arr=db('table_zhuozi')->where('id',$id)->find();
        $this->assign('table_select',$arr);
        return $this->fetch('tablezhuozi/updata');  
    }

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('tablezhuozi_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $tablezhuozi_pic=$info->getSaveName();
        }else{
            $tablezhuozi_pic=db('table_zhuozi')->where('id',$id)->column('table_pic');
        }

        db('table_zhuozi')->where('id',input('id'))->update([
            'table_name' => input('tablezhuozi_name'),
            'table_pic' => $tablezhuozi_pic,
            'table_renshu'=>input('tablezhuozi_renshu'),
            ]);
        $this->redirect('tablezhuozi/index');
    }

}