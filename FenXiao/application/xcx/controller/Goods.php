<?php
namespace app\xcx\Controller;
use think\Controller;
use app\xcx\model\FoodModel;
use app\xcx\model\BrandModel;
use app\xcx\model\DingdanModel;
class Goods extends Controller
{	
	//左部滑动分类默认值
	public function brand_classifySeleted(){

		$arr = BrandModel::find();
		$arr_food['1']=$arr->id;

		$arr2 = new BrandModel();
		$arr2 = $arr2->order('id', 'desc')->find();
		$arr_food['2']=$arr2->id;
		//var_dump($arr_food);
        echo json_encode($arr_food);
	}

   //获取所有商品
   public function wx_index_brand(){

        $arr = FoodModel::All();

        foreach($arr as $key=>$user){
        	$arr_food[$user->id]['id']=$user->id;
        	$arr_food[$user->id]['name']=$user->food_name;
            $arr_food[$user->id]['pic']="http://localhost/public/uploads/".
            strtr($user->food_pic,"\\","/");
            $arr_food[$user->id]['sold']=$user->food_num;
            $arr_food[$user->id]['price']=$user->food_money/1000;
        }
   
        //var_dump($arr_food);
        echo json_encode($arr_food);
    }
    //获取所分类
    public function wx_index_goodsList(){

        $arr = new BrandModel();
		$arr = $arr->order('brand_num', 'asc')->select();

        $num=0;
        foreach($arr as $key=>$user){
        	$arr_brand[$num]['id']="dao".$user->id;
        	$arr_brand[$num]['classifyName']=$user->brand_name;
        	$arr_brand[$num]['goods']=json_decode(strtr($user->brand_goods,"\""," "));
        	$arr_brand[$num]['select_goods']=array();
        	$arr_brand[$num]['num']="";
            $num++;
        }
   
        //var_dump($arr_brand);
        echo json_encode($arr_brand);
    }


    //订单添加数据库
    public function add_order(){

        //桌子号
        $table_num=input("table_num");
        //订单号
        $order=time();
        //个数
        $shops_arr=input('shops_arr');
        //名称
        $goods_arr=input("goods_arr");
        //数量
        $moneys_arr=input("moneys_arr");
        //总价
        $money=input("money")*1000;
        //状态
        $buff="未完成";
        //下单时间
        $time_s=$order;
        //结单时间
        $time_e='0';

        $data['dingdan_table']=$table_num;
        $data['dingdan_num']=$order;
        $data['dingdan_shops']=$shops_arr;
        $data['dingdan_goods']=$goods_arr;
        $data['dingdan_moneys']=$moneys_arr;
        $data['dingdan_money']= $money;
        $data['dingdan_buff']=$buff;
        $data['dingdan_time_s']=$time_s;
        $data['dingdan_time_e']=$time_e;
        //db('dingdan')->insert($data);
        $dingdan = new DingdanModel;

        //查看桌子号 是否有订单 没有结束，
        //没结束订单号不变，
        //结束订单号改变
        $buff2=DingdanModel::where('dingdan_table',$table_num)->value('dingdan_buff');
        if($buff2=='未完成'){
            //没有完成的订单号
            $order=DingdanModel::where('dingdan_table',$table_num)->value('dingdan_num');
            $dingdan->data([
                'dingdan_table'  =>  $table_num,
                'dingdan_num'  =>  $order,
                'dingdan_shops'  =>  $shops_arr,
                'dingdan_goods'  =>  $goods_arr,
                'dingdan_moneys'  =>  $moneys_arr,
                'dingdan_money'  =>  $money,
                'dingdan_buff'  =>  $buff2,
                'dingdan_time_s'  =>  $time_s,
                'dingdan_time_e' =>  $time_e
            ]);
        }
        else{
            $dingdan->data([
                'dingdan_table'  =>  $table_num,
                'dingdan_num'  =>  $order,
                'dingdan_shops'  =>  $shops_arr,
                'dingdan_goods'  =>  $goods_arr,
                'dingdan_moneys'  =>  $moneys_arr,
                'dingdan_money'  =>  $money,
                'dingdan_buff'  =>  $buff,
                'dingdan_time_s'  =>  $time_s,
                'dingdan_time_e' =>  $time_e
            ]);
        }
        
        $dingdan->save();
    }
    
	
}