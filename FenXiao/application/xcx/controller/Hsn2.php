<?php
namespace app\xcx\Controller;
use think\Controller;
use app\xcx\model\FoodModel;
use app\xcx\model\BrandModel;
use app\xcx\model\DingdanModel;
use app\xcx\model\LunboModel;
use app\xcx\model\ConfigModel;
use app\xcx\model\TablezhuoziModel;
class Hsn2 extends Controller
{	

	//轮播数据获取
	public function config(){
        $arr = ConfigModel::all(function($query){
            $query->where('id', '1');
        });
        echo json_encode($arr);
    }

	//轮播数据获取
	public function lunbo_show(){
        $arr = LunboModel::all(function($query){
            $query->where('lunbo_show', '1')->order('lunbo_num', 'desc');
        });
        $num=1;
        foreach($arr as $key=>$user){
            $arr_lunbo[$num]['lunbo_pic']="https://hsn.yuelei.net/hsn2/public/uploads/".
            strtr($user->lunbo_pic,"\\","/");
            $num++;
        }
        echo json_encode($arr_lunbo);
    }

    //获取所有商品
   public function wx_index_brand(){

        $arr = FoodModel::All();

        foreach($arr as $key=>$user){
        	$arr_food[$user->id]['id']=$user->id;
        	$arr_food[$user->id]['name']=$user->food_name;
            $arr_food[$user->id]['pic']="https://hsn.yuelei.net/hsn2/public/uploads/".
            strtr($user->food_pic,"\\","/");
            $arr_food[$user->id]['sold']=$user->food_num;
            $arr_food[$user->id]['price']=$user->food_money/1000;
            $arr_food[$user->id]['show']=$user->food_index_show;
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
        	$arr_brand[$num]['pic']="https://hsn.yuelei.net/hsn2/public/uploads/".
            strtr($user->brand_pic,"\\","/");
        	$arr_brand[$num]['classifyName']=$user->brand_name;
        	$arr_brand[$num]['goods']=json_decode(strtr($user->brand_goods,"\""," "));
        	$arr_brand[$num]['select_goods']=array();
        	$arr_brand[$num]['num']="";
            $num++;
        }
   
        //var_dump($arr_brand);
        echo json_encode($arr_brand);
    }


    //单个商品数据
    public function wx_space_show(){
    	$space_id=$_POST['space_id'];
       
        $Car = new FoodModel();
        $Car=$Car->where('id',$space_id)->find();

        $arr_car['id']=$Car->id;
        $brand=json_decode($Car->food_brand);
        $arr_car['brand']=$brand['0'];
        $arr_car['image']="https://hsn.yuelei.net/hsn2/public/uploads/".
        strtr($Car->food_pic,"\\","/");
        $arr_car['price']=$Car->food_money/1000;
        $arr_car['title']=$Car->food_name;
        $arr_car['detail']=$Car->food_con_peiliao;
        $arr_car['xiangqing']=$Car->food_con_jieshao;
        $arr_car['selected']='true';

        echo json_encode($arr_car);
    }


    //包房信息获取
    public function get_baofang(){
    	$arr =TablezhuoziModel::all();

		$num=0;
        foreach($arr as $key=>$user){
        	$arr_table[$num]['id']=$user->id;
			$arr_table[$num]['name']=$user->table_name;
			$arr_table[$num]['img']="https://hsn.yuelei.net/hsn2/public/uploads/".
	        strtr($user->table_pic,"\\","/");
			$arr_table[$num]['renshu']=$user->table_renshu;
			if($user->table_shiyong_ok==''){
				$shiyong_ok=0;
			}
			else{
				$shiyong_ok=$user->table_shiyong_ok;
			}
			$arr_table[$num]['shiyong_ok']=$shiyong_ok;
			$arr_table[$num]['select']='0';
            $num++;
        }

        echo json_encode($arr_table);
    }


    //订单添加数据库
    public function add_order(){

        //桌子号
        $table_num=input("coupon_money");
        if($table_num==""){
            $table_num=0;
        }
        //openid
        $openid=input('openid');
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
        $phone=input("phone");
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
        $data['dingdan_money']=$phone;
        $data['dingdan_buff']=$buff;
        $data['dingdan_time_s']=$time_s;
        $data['dingdan_time_e']=$time_e;
        //db('dingdan')->insert($data);
        $dingdan = new DingdanModel;

        //查看桌子号 是否有订单 没有结束，
        //没结束订单号不变，
        //结束订单号改变
        $buff2=DingdanModel::where('dingdan_phone',$phone)->value('dingdan_buff');
        if($buff2=='未完成'){
            //没有完成的订单号
            $order=DingdanModel::where('dingdan_phone',$phone)->value('dingdan_num');
            $table_num=DingdanModel::where('dingdan_phone',$phone)->value('dingdan_table');
            $dingdan->data([
                'dingdan_openid'  =>  $openid,
                'dingdan_phone'  =>  $phone,
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
                'dingdan_openid'  =>  $openid,
                'dingdan_phone'  =>  $phone,
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

            //更新包房状态
            if($table_num!=0){
                db('table_zhuozi')->where('id',$table_num)->update([
                    'table_shiyong_ok' => 1
                    ]);
                }
            
            
            }
        
        $dingdan->save();
    }




    //用户电话  是否为空
   public function phone(){
        $openid=input('openid');
        $ok=db('user')->where('openid',$openid)->value('user_phone_huoqu');
        //Phone为空
        if(!$ok){
            echo 'true';
        }
        else{
            echo $ok;
        }
   }
}