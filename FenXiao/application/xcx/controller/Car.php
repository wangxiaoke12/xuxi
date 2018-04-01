<?php
namespace app\xcx\Controller;
use think\Controller;
use app\xcx\model\CarModel;
use app\xcx\model\BrandModel;
use app\xcx\model\LevelModel;
use lib\Page;
class Car extends Controller
{   

    public function index()
    {
        //$data：array,通过select()查询未分页的数据，不能是已经分页的对象
        $data = CarModel::All();
        $this->assign('car_select',$data);
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Car/index');
    }

    public function add_show(){
    	$arr_brand=db('brand')->select();
    	$arr_level=db('level')->select();
    	$arr_config=db('config')->select();
    	$this->assign('car_brand_option',$arr_brand);
    	$this->assign('car_level_option',$arr_level);
    	$this->assign('car_config_option',$arr_config);
    	return $this->fetch('Car/add');
    }

    public function add_insert(){
        $file = request()->file('car_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $data['car_pic']=$info->getSaveName();
            $data['car_name']=input('car_name');
            $data['car_tag']=input('car_tag');
            $data['car_index_show']=input('car_index_show');
            $data['car_index_show_num']=input('car_index_show_num');
            $data['car_brand']=$_POST['car_brand'];
            $data['car_level']=$_POST['car_level'];
            $data['car_config']=$_POST['car_config'];
            $data['car_shop_price']=input('car_shop_price');
            $data['car_vender_price']=input('car_vender_price');
            $data['car_info']=input('car_info');
            $data['car_remark']=input('car_remark');
            db('car')->insert($data);
            $this->redirect('Car/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public function updata_show(){
        $id=input('id');

        $arr_brand=db('brand')->select();
        $arr_level=db('level')->select();
        $arr_config=db('config')->select();
        $this->assign('car_brand_option',$arr_brand);
        $this->assign('car_level_option',$arr_level);
        $this->assign('car_config_option',$arr_config);

        $arr=db('car')->where('id',$id)->find();
        $this->assign('car_select',$arr);
        return $this->fetch('Car/updata');
    }

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('car_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $car_pic=$info->getSaveName();
        }else{
            $car_pic=db('car')->where('id',$id)->column('car_pic');
        }

        db('car')->where('id',input('id'))->update([
            'car_tag' => input('car_tag'),
            'car_name' => input('car_name'),
            'car_index_show' => input('car_index_show'),
            'car_index_show_num' => input('car_index_show_num'),
            'car_pic' => $car_pic,
            'car_brand' =>$_POST['car_brand'],
            'car_level' =>$_POST['car_level'],
            'car_config' =>$_POST['car_config'],
            'car_shop_price' =>input('car_shop_price'),
            'car_vender_price' =>input('car_vender_price'),
            'car_info' =>input('car_info'),
            'car_remark' =>input('car_remark')

            ]);
        $this->redirect('Car/index');
    }

    public function del(){
    	$id=$_GET['id'];
    	db('car')->where('id',$id)->delete();
    	$this->redirect('Car/index');
    }

    public function wx_index_show(){
        //$arr=CarModel::All(['car_id','car_pic','car_name','car_tag','car_shop_price','car_index_show']);
        $arr = CarModel::all(function($query){
            $query->where('car_index_show', '显示')->order('car_index_show_num', 'desc');
        });

        /*$arr = CarModel::find()->all(function($query){
            $query->where('car_index_show', '显示')->order('car_index_show_num', 'desc');
        });*/

        //echo json_encode($arr);
        //var_dump($arr);
        $num=1;
        foreach($arr as $key=>$user){
            $arr_car[$num]['id']=$user->id;
            $arr_car[$num]['car_pic']="http://localhost/public/uploads/".
            strtr($user->car_pic,"\\","/");
            $arr_car[$num]['car_name']=$user->car_name;
            $arr_car[$num]['car_tag']=$user->car_tag;
            $arr_car[$num]['car_shop_price']=$user->car_shop_price;
            $num++;
        }
        //array_push($arr_car,'length');
        //$arr_car['length']=$num-1;
        echo json_encode($arr_car);
    }

    public function wx_space_show(){
        $space_id=$_POST['space_id'];
        //$Car = CarModel::where('id',3)->find()->all();
        $Car = new CarModel();
        $Car=$Car->where('id',$space_id)->find();
        //$lev=$Car->level->level_name;//获得具体级别名称
        //var_dump($Car);

        $arr_car['car_pic']="http://localhost/public/uploads/".
        strtr($Car->car_pic,"\\","/");
        $arr_car['car_name']=$Car->car_name;
        $arr_car['car_tag']=$Car->car_tag;
        $arr_car['car_shop_price']=$Car->car_shop_price;
        $arr_car['car_vender_price']=$Car->car_vender_price;
        $arr_car['car_info']=$Car->car_info;
        $arr_car['car_config_1']=$Car->Config->config_text1;
        $arr_car['car_config_2']=$Car->Config->config_text2;
        $arr_car['car_config_3']=$Car->Config->config_text3;
        $arr_car['car_config_4']=$Car->Config->config_text4;
        $arr_car['car_config_5']=$Car->Config->config_text5;
        $arr_car['car_config_6']=$Car->Config->config_text6;
        $arr_car['car_config_7']=$Car->Config->config_text7;

        echo json_encode($arr_car);
    }

    public function wx_shaixuan(){//获取所有筛选条件添加到前台
        $arr['brand']=BrandModel::column('brand_pic','id');
        $arr['level']=LevelModel::column('level_name','id');
        $num=1;
        foreach($arr['brand'] as $key=>$x){
            $arr['brand'][$num]="http://localhost/public/uploads/".
            strtr($arr['brand'][$num],"\\","/");
            $num++;
        }
        echo json_encode($arr);
    }

    public function wx_shaixuan_select(){//根据筛选条件 查询
        $page=$_POST['shaixuan_page'];//分页页数
        $shaixuan_gao=$_POST['shaixuan_gao'];//最高价
        $shaixuan_di=$_POST['shaixuan_di'];//最低价
        $shaixuan_brand=$_POST['shaixuan_brand'];//查询品牌 数组
        $shaixuan_brand_arr=explode(",",$shaixuan_brand);
        $shaixuan_level=$_POST['shaixuan_level'];//查询级别 数组
        $shaixuan_level_arr=explode(",",$shaixuan_level);
        $shaixuan_text=input("shaixuan_text");//关键字查询
        $Car = new CarModel();
        if($shaixuan_text){
             $arr = CarModel::where('car_name','like','%'.$shaixuan_text.'%','OR')->limit($page*10-10,$page*10)->select();
        }else{
            if($shaixuan_brand&&$shaixuan_level){
                $arr = CarModel::where('car_brand','in',$shaixuan_brand)->where('car_level','in',$shaixuan_level)->limit($page*10-10,$page*10)->select();
                //echo "brand level";
            }
            else if(!$shaixuan_brand&&$shaixuan_level){
                $arr = CarModel::where('car_level','in',$shaixuan_level)->limit($page*10-10,$page*10)->select();
                //echo "$page";
            }
            else if($shaixuan_brand&&!$shaixuan_level){
                $arr = CarModel::where('car_brand','in',$shaixuan_brand)->limit($page*10-10,$page*10)->select();
                //echo "brand";
            }
            else{
                $arr = CarModel::limit($page*10-10,$page*10)->select();
                //echo "全部";
            }
            //var_dump($Car);  
        }
        
        $num=0;
        foreach($arr as $key=>$x){
            $arr[$num]['car_pic']="http://localhost/public/uploads/".
            strtr($x->car_pic,"\\","/");
            $num++;
        }
        echo json_encode($arr);
    }

}
