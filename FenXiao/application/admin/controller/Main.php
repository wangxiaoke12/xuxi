<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\model\UserModel;
use think\Session;
use app\admin\model\DingdanModel;
use app\admin\model\TablezhuoziModel;
class Main extends Controller
{   
    public function _initialize(){
        $uid = Session::get('name');
        if($uid == null){
            return $this->redirect('Login/index');
        }
    }
    
	public function index()
    {	
		$data=DingdanModel::where('dingdan_buff','未完成')->order('dingdan_time_s','desc')->select();
        $data_code=TablezhuoziModel::ALL();
		$data_goods=array();
		$data_shops=array();
		$data_moneys=array();
		foreach($data as $key=>$x){
        	$x['dingdan_time_s']=date("Y-m-d H:i:s",$x['dingdan_time_s']);
        	$x['dingdan_money']=$x['dingdan_money']/1000;

            foreach ($data_code as $value) {
                if($x['dingdan_table']=$value->id){
                    $x['dingdan_table']=$value->table_name;
                }
            }
        	$x['con']='';
        	/*$arr_1=(array)json_decode($x['dingdan_goods']);
        	$arr_2=(array)json_decode($x['dingdan_shops']);
        	$arr_3=(array)json_decode($x['dingdan_moneys']);*/
        	$arr_1=json_decode($x['dingdan_goods'],true);
        	$arr_2=json_decode($x['dingdan_shops'],true);
        	$arr_3=json_decode($x['dingdan_moneys'],true);
        	array_push($data_goods,$arr_1);
        	array_push($data_shops,$arr_2);
        	array_push($data_moneys,$arr_3);
        }

		//总营业额
		$time_day = date('Y-m-d');
		$con_1=DingdanModel::where('dingdan_buff','=','完成')->sum('dingdan_money');;
		//今日营业额
		$con_2=DingdanModel::whereTime('dingdan_time_s','d')->where('dingdan_buff','=','完成')->sum('dingdan_money');
		//今日订单    
		$con_3=DingdanModel::whereTime('dingdan_time_s','d')->where('dingdan_buff','=','完成')->count();    
        $this->assign('goods',$data_goods);
        $this->assign('shops',$data_shops);
        $this->assign('moneys',$data_moneys);

        $this->assign('con_1',$con_1);
        $this->assign('con_2',$con_2);
        $this->assign('con_3',$con_3);

        $this->assign('dingdan_select',$data);
    	return $this->fetch('Main/index');
    }

    public function update(){
        $id=$_POST['id'];
        //db('dingdan')->where('id',$id)->delete();
        

        $arr = new DingdanModel();
        $arr = $arr->where('id','=',$id)->where('dingdan_buff','=','未完成')->order('dingdan_time_s','desc')->select();

        //通过订单 数据 更新包房状态
        if(count($arr)>1){
            //有错误信息存在 只删除信息 不更新包房
            db('dingdan')->where('id',$id)->update([
                'dingdan_time_e' => time(),
                'dingdan_buff' => '完成',
            ]);
        }else{
            //数据只有一条了 需要更新包房状态
            
            db('table_zhuozi')->where('id',$arr[0]['dingdan_table'])->update([
                    'table_shiyong_ok' => 0       
                    ]);

            db('dingdan')->where('id',$id)->update([
                'dingdan_time_e' => time(),
                'dingdan_buff' => '完成',
            ]);
        }

    }

    public function del(){
        $id=$_POST["id"];
        //db('dingdan')->where('id',$id)->delete();

        //获取当前订单的所有数据
        //要删除一个订单，需要判断，要删除的订单 肯定是未完成的
        //1.订单号是否是唯一 不唯一 不 释放包房
        //2.唯一 释放包房
        $arr = new DingdanModel();
        $arr = $arr->where('id','=',$id)->where('dingdan_buff','=','未完成')->order('dingdan_time_s','desc')->select();

        //通过订单 数据 更新包房状态
        if(count($arr)>1){
            //有错误信息存在 只删除信息 不更新包房
            db('dingdan')->where('id',$id)->delete();
        }else{
            //数据只有一条了 需要更新包房状态
            
            db('table_zhuozi')->where('id',$arr[0]['dingdan_table'])->update([
                    'table_shiyong_ok' => 0
                    ]);

            db('dingdan')->where('id',$id)->delete();
        }

    }

    public function ajax(){
    	//模拟数据
    	$num=$_POST['num'];
    	$arr = new DingdanModel();
		$arr = $arr->where('dingdan_phone','=',$num)
    ->where('dingdan_buff','=','未完成')->order('dingdan_time_s','desc')->find();

        $table_name=TablezhuoziModel::where('id',$arr['dingdan_table'])->value('table_name');

    	$arr_1=json_decode($arr['dingdan_goods'],true);
    	$arr_2=json_decode($arr['dingdan_shops'],true);
    	$arr_3=json_decode($arr['dingdan_moneys'],true);
    	$con="";
        //小票格式
    	foreach($arr_1 as $key=>$x){
    		$con=$con."<div class='goods'><div><em>".$x."</em></div><div><em>X".$arr_2[$key]."</em></div><div><em>".$arr_3[$key]."元</em></div></div>";
    	}
    	

    	printf("
			<tr class='trbgcolor'>
                <td class='center'>
                    <table>%s</table>
                </td>
                 <td class='center'>
                    <table>%s</table>
                </td>
				<td class='center'>
					<span>
		            	<em>%s</em>
		            	<audio src='/public/static/dingdan_tishi.mp3' autoplay>
           				</audio>
		          	</span>
				</td>
				<td class='center'>
					<table>%s</table>
				</td>
				<td class='center'>
					<span>
		            	<em>%s元</em>
		          	</span>
				</td>
				<td class='center' id='dianji'>
					
					<img class='ajax_img_0' onclick='ajax_end0(%s)' src='/public/static/admin/images/print.png'/>

					<img class='ajax_img_1' onclick='ajax_end1(this)' id=%s src='/public/static/admin/images/ok.png'/>

					<img class='ajax_img_2' onclick='ajax_end2(this)' id=%s src='/public/static/admin/images/no.png'/>
        			
				</td>
			</tr>",
            $table_name,
            $num,
			date("Y-m-d H:i:s",$arr['dingdan_time_s']),
			$con,
			$arr['dingdan_money']/1000,
			$arr['id'],
			$arr['id'],
			$arr['id']
			);
    }

    public function dingdan_xinxi($id){
    	$arr = new DingdanModel();
    	$arr = $arr->where('id','=',$id)->find();
    	
    	$arr_1=json_decode($arr['dingdan_goods'],true);
    	$arr_2=json_decode($arr['dingdan_shops'],true);
    	$arr_3=json_decode($arr['dingdan_moneys'],true);

    	$this->assign('money',$arr['dingdan_money']);
    	$this->assign('time',date("Y-m-d H:i:s",$arr['dingdan_time_s']));
    	$this->assign('goods',$arr_1);
        $this->assign('shops',$arr_2);
        $this->assign('moneys',$arr_3);

        return $this->fetch("Main/dingdan_xinxi");
    }

}