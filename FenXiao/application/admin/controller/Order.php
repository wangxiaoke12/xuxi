<?php
namespace app\admin\Controller;
use think\Controller;
use think\Session;
use app\admin\model\OrderModel;
use lib\Page;
class Order extends Controller
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
        $data = OrderModel::ALL();
        //$data：未分页的数据  2：每页显示的记录数
        $arr_1=array();
        $arr_2=array();
        $arr_3=array();
        foreach($data as $key=>$x){
            $x['dingdan_time_s']=date("Y-m-d H:i:s",$x['dingdan_time_s']);
            if($x['dingdan_time_e']>0){
                $x['dingdan_time_e']=date("Y-m-d H:i:s",$x['dingdan_time_e']);
            }
            $x['con']='';
            array_push($arr_1,json_decode($x['dingdan_goods'],true));
            array_push($arr_2,json_decode($x['dingdan_shops'],true));
            array_push($arr_3,json_decode($x['dingdan_moneys'],true));
        }
           
        foreach($arr_1 as $key=>$x){
            foreach($x as $key2=>$a){
                $data[$key]['con']=$data[$key]['con']."<div class='goods'><div><em>".$arr_1[$key][$key2]."</em></div><div><em>X".$arr_2[$key][$key2]."</em></div><div><em>".$arr_3[$key][$key2]."元</em></div></div>";
            }   
        }
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        
        return $this->fetch('Order/index');
    }
}