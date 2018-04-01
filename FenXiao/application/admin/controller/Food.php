<?php
namespace app\admin\Controller;
use think\Controller;
use think\Session;
use app\admin\model\FoodModel;
use app\admin\model\BrandModel;
use lib\Page;
class Food extends Controller
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
        $data = FoodModel::All();
        $data_brand = BrandModel::All();

        //循环所有菜品
        foreach ($data as $value){
            $con_brnad="";
            //拿到菜品中的 类型json 转 数组 循环改变 
            foreach (json_decode($value->food_brand) as $value2){
                $brand = BrandModel::where('id',$value2)->value('brand_name');
                $con_brnad= $con_brnad.$brand."&nbsp&nbsp";
            }
            $value->food_brand=$con_brnad;
        }


        //$data：未分页的数据  2：每页显示的记录数
        $p = new Page($data,5);
        //把分页后的对象$p渲染到模板
        $this->assign([
            'p' => $p,
        ]);

        return $this->fetch('Food/index');
    }

    public function add_show(){ 
        $arr=BrandModel::select();
        $this->assign('food_brand_option',$arr);
        
        return $this->fetch('Food/add');
    }

    public function add_insert(){
        $file = request()->file('food_pic');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        //商品所属的类
        $brand_goods=input('food_brand/a');

        if($info){
            $data['food_name']=input('food_name');
            $data['food_brand']=json_encode(input('food_brand/a'));
            $data['food_pic']=$info->getSaveName();
            $data['food_money']=input('food_money')*1000;
            $data['food_num']=input('food_num');
            $data['food_index_show']=input('food_index_show')||0;
            $data['food_con_peiliao']=input('food_con_peiliao');
            $data['food_con_jieshao']=input('food_con_jieshao');
            db('food')->insert($data);
            //返回插入字段的 自增id
            $food_id = db('food')->getLastInsID();

            //所有类
            $data_brand = BrandModel::All();

            foreach ($data_brand as $value){
                $data_brand2 = new BrandModel();
                $arr_goods=BrandModel::where('id',$value->id)->value('brand_goods');

                foreach ($brand_goods as $value1){
                    if($value->id==$value1){
                        //列的id=选择的id值 列的brand_goods转数组，加入该物品id
                        //拿到 已拥有的数据
                        $arr_goods=json_decode($arr_goods);
                        array_push($arr_goods,$food_id);
                    }
                }
                $data_brand2->save([
                    'brand_goods'  => preg_replace('# #', '',strtr(json_encode($arr_goods),"\""," "))
                ],['id' => $value->id]);
            }

            $this->redirect('Food/index');
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    public function del(){
        $id=$_GET['id'];
        //商品所属的类
        $food_brand=db('food')->where('id',$id)->value('food_brand');
        $food_brand=json_decode($food_brand);
        //所有的类
        $data_brand = BrandModel::All();
        //循环所有类 拿到所有类id
        foreach($data_brand as $value1){
            $data_brand2 = new BrandModel();//循环生成对象
            //商品所属类 =类id 物品存在于之中该删除
            if(in_array($value1->id,$food_brand)){
                //数组化 类中 所包含的 所有物品d
                $arr1=json_decode($value1->brand_goods);
                //再次判断 数组话类中确实有 此物品id 确认删除
                if(in_array($id,$arr1)){
                    $arr_key=array_search($id,$arr1);
                    array_splice($arr1, $arr_key,1); 
                }
                //更改数据库
                $data_brand2->save([
                    'brand_goods'  => preg_replace('# #', '',strtr(json_encode($arr1),"\""," "))
                ],['id' => $value1->id]);
            }  
        }
        db('food')->where('id',$id)->delete();
        $this->redirect('Food/index');
    }

    public function updata_show(){
        $id=input('id');
        $arr_brand=BrandModel::select();
        $this->assign('food_brand_option',$arr_brand);

        $arr=db('food')->where('id',$id)->find();
        //获取商品 所属的分类数组
        $food_brand=json_decode($arr['food_brand']);

        $con='';
        foreach($arr_brand as $value){
            $checked='';
            $arr_goods=json_decode($value->brand_goods);
            //var_dump($arr_goods);
            foreach($arr_goods as $value2){
                if($arr['id']==$value2){
                    $checked='checked';
                }
                else{//避免 上一个存在下一个不存在 而把上一个替换成不存在
                    if($checked=='checked'){
                        $checked='checked';
                    }else{
                        $checked="";
                    }               
                }
            }
            //echo $checked."<br />";
            $num="checkbox-7-".$value->id*100;
            $con=$con."<input sytle='text-align:center' name='food_brand[]' value='$value->id' type='checkbox' id='$num' $checked />  <label for='$num'>
              <span>$value->brand_name</span>
            </label>";
        }
        $this->assign('con',$con);
        $this->assign('food_select',$arr);

        return $this->fetch('Food/updata');
    }

    public function updata_insert(){
        $id = input('id');
        if($file = request()->file('food_pic')){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $car_pic=$info->getSaveName();
        }else{
            $car_pic=db('food')->where('id',$id)->column('food_pic');
        }

        db('Food')->where('id',input('id'))->update([
            'food_name' => input('food_name'),
            'food_brand' => json_encode(input('food_brand/a')),
            'food_pic' => $car_pic,
            'food_money' => input('food_money')*1000,
            'food_num' => input('food_num'),
            'food_con_peiliao' =>input('food_con_peiliao'),
            'food_con_jieshao' =>input('food_con_jieshao')
            ]);

        //返回插入字段的 自增id
        $food_id = input('id');

        //所有类
        $input_goods=input('food_brand/a');
        //print_r($input_goods);
        $data_brand = BrandModel::All();
        //循环所有类 列
        foreach ($data_brand as $value1){

            //把类中 所包含的商品 数组化
            $arr1=json_decode($value1->brand_goods);

            $data_brand2 = new BrandModel();//循环生成对象

            //判断 更新时 是否选择了这个类
            //选择 看看 数组化中 是否存在商品id 不存在push
            //没有选择 看看 数组化中 是否存在商品id 存在删除
            if(in_array($value1->id,$input_goods)){
               if(!in_array($food_id,$arr1)){
                    array_push($arr1,$food_id);
                    //更改数据库
                    $data_brand2->save([
                        'brand_goods'  => preg_replace('# #', '',strtr(json_encode($arr1),"\""," "))
                    ],['id' => $value1->id]);
               }
            }else{
               if(in_array($food_id,$arr1)){
                    //搜索 值 返回键值
                    $arr_key=array_search($food_id,$arr1);
                    //删除键值
                    array_splice($arr1, $arr_key,1);
                    //更改数据库
                    $data_brand2->save([
                        'brand_goods'  => preg_replace('# #', '',strtr(json_encode($arr1),"\""," "))
                    ],['id' => $value1->id]);
               }
            }  
        }

        $this->redirect('Food/index');
    }

    public function updata_index_show(){
        $val=input('val');
        $id=input('id');
        if($val==1){
             db('Food')->where('id',$id)->update([
                'food_index_show' =>1
            ]);
            echo '1';
        }else{
            db('Food')->where('id',$id)->update([
                'food_index_show' =>0
            ]);
            echo '0';
        }
    }
}