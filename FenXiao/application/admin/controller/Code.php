<?php
namespace app\admin\Controller;
use think\Controller;
use think\Session;
use app\admin\model\CodeModel;
use lib\Page;
use app\admin\model\TokenModel;
class Code extends Controller
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
        $data = db('code')->select();
        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);
        return $this->fetch('Code/index');
    }

    public function add_show(){
        return $this->fetch('Code/add');
    }

    public function add_insert(){

        //echo $aaa['access_token'];
        $token = new TokenModel();
        $data = $token->where('id', '1')->find();
        $nowtime=time();
        $zero1=strtotime (date('Y-m-d H:i:s',time()));
        $zero2=strtotime ($data['useful_time']);
        $shicha=ceil(($zero1-$zero2));
        if($shicha>=3600){
            //post 请求接口 获取新的Access_token
            $appid = "wxa104503bc7b7216c";
            $appsecret = "733e6b09895e5ebca63689d5e3cb0ad8";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);

            $jsoninfo = json_decode($output, true);
            $access_token = $jsoninfo["access_token"];

            $data->token=$access_token;
            $data->useful_time=$nowtime;
            $data->save();
            $access_token=$access_token;
        }
        else{
            $access_token=$data['token'];
        }

            
        $url = 'https://api.weixin.qq.com/wxa/getwxacode?access_token='.$access_token;
        $path="pages/index?query=".input('code_name');
        $width=430;
        $data='{"path":"'.$path.'","width":'.$width.'}';
        $ccc = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ccc, CURLOPT_URL, $url);
        curl_setopt($ccc, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ccc, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ccc, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ccc, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ccc, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ccc, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ccc, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ccc, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ccc, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ccc);
        //     var_dump($tmpInfo);
        //    exit;
        if (curl_errno($ccc)) {
          return false;
        }else{
          //var_dump($tmpInfo);
          
           
                $data_arr['code_name']=input('code_name');
                $data_arr['code_pic']="code/".input('code_name').".jpg";
                db('code')->insert($data_arr);

                $name_code=CodeModel::where('code_name',input('code_name'))->value('id');

            $url="code/".$name_code.".jpg";
            file_put_contents($url,$tmpInfo);
         //$this->redirect('Code/index');
          //return $tmpInfo;
        }
    }

    public function del(){
        $id=$_GET['id'];
        db('code')->where('id',$id)->delete();
        $this->redirect('Code/index');
    }
}