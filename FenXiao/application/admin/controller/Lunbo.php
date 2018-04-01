<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\LunboModel;
use lib\Page;
use think\Session;
class Lunbo extends Controller
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
        $data = db('lunbo')->select();
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Lunbo/index');
    }

    public function add_show(){
    	return $this->fetch('Lunbo/add');
    }

    public function add_insert(){
	    $file = request()->file('lunbo_pic');
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info){
            $data['lunbo_name']=input('lunbo_name');
	        $data['lunbo_pic']=$info->getSaveName();
	        $data['lunbo_show']=input('lunbo_show');
            $data['lunbo_num']=input('lunbo_num');
	        $data['lunbo_remark']=input('lunbo_remark');
	        db('lunbo')->insert($data);
	        $this->redirect('Lunbo/index');
	    }else{
	        // 上传失败获取错误信息
	        echo $file->getError();
	    }
    }

    public function del(){
    	$id=$_GET['id'];
    	db('lunbo')->where('id',$id)->delete();
    	$this->redirect('Lunbo/index');
    }

    public function updata_show(){
    	$id=input('id');
        $arr=db('lunbo')->where('id',$id)->find();
        $this->assign('lunbo_select',$arr);
        return $this->fetch('Lunbo/updata');
    }

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('lunbo_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $lunbo_pic=$info->getSaveName();
        }else{
            $lunbo_pic=db('lunbo')->where('id',$id)->column('lunbo_pic');
        }

        db('lunbo')->where('id',input('id'))->update([
            'lunbo_name' => input('lunbo_name'),
            'lunbo_pic' => $lunbo_pic,
            'lunbo_num' => input('lunbo_num'),
            'lunbo_remark' => input('lunbo_remark')
            ]);
        $this->redirect('Lunbo/index');
    }

    public function lunbo_show(){
        //$arr=LunboModel::All();

        //$arr = LunboModel::where('lunbo_show','显示')->column('lunbo_pic','lunbo_num');

        $arr = LunboModel::all(function($query){
            $query->where('lunbo_show', '显示')->order('lunbo_num', 'desc');
        });

        //var_dump($arr);
        $num=1;
        foreach($arr as $key=>$user){
            $arr_lunbo[$num]['lunbo_pic']="http://47.95.114.183/public/uploads/".
            strtr($user->lunbo_pic,"\\","/");
            $num++;
        }
        /*array_push($arr_lunbo,'length');//一维数组 最后位置记录 一维数组长度
        $arr_lunbo['length']=$num-1;*/
        echo json_encode($arr_lunbo);
    }



    public function updata_index_show(){
        $val=input('val');
        $id=input('id');
        if($val==1){
             db('lunbo')->where('id',$id)->update([
                'lunbo_show' =>1
            ]);
            echo '1';
        }else{
            db('lunbo')->where('id',$id)->update([
                'lunbo_show' =>0
            ]);
            echo '0';
        }
    }
    
}