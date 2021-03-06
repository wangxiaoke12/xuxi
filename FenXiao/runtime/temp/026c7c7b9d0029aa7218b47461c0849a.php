<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\xampp\htdocs\public/../application/admin\view\Car\add.html";i:1506417734;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>添加新车辆</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/admin/ue/ueditor.config.js"></script>
  <script src="__STATIC__/admin/ue/ueditor.all.min.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>添加车辆</em></span>
  </div>
  <form action="/public/admin/car/add_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">车辆名字：</td>
    <td><input type="text" class="textBox length-middle" name="car_name"/></td>
   </tr>
  
   <tr>
    <td style="width:15%;text-align:right;">车辆标签：</td>
    <td><input type="text" class="textBox length-middle" name="car_tag"/></td>
   </tr>
  
   <tr>
    <td style="text-align:right;">车辆图片：</td>
    <td><input type="file" name="car_pic"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">车辆显示：</td>
    <td>
    显示：<input type="radio" name="car_index_show" value="显示">
    不显示：<input type="radio" name="car_index_show" value="不显示" checked="true">
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">车辆显示顺序：</td>
    <td><input type="text" class="textBox length-middle" name="car_index_show_num"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">车辆品牌：</td>
    <td>
      <select name="car_brand">
        <?php if(is_array($car_brand_option) || $car_brand_option instanceof \think\Collection || $car_brand_option instanceof \think\Paginator): $i = 0; $__LIST__ = $car_brand_option;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $x['id']; ?>"><?php echo $x['brand_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>
   </tr>
  
  <tr>
    <td style="width:15%;text-align:right;">车辆级别：</td>
    <td>
      <select name="car_level">
        <?php if(is_array($car_level_option) || $car_level_option instanceof \think\Collection || $car_level_option instanceof \think\Paginator): $i = 0; $__LIST__ = $car_level_option;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $x['id']; ?>"><?php echo $x['level_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>
  </tr>

  <tr>
    <td style="width:15%;text-align:right;">车辆配置：</td>
    <td>
      <select name="car_config">
        <?php if(is_array($car_config_option) || $car_config_option instanceof \think\Collection || $car_config_option instanceof \think\Paginator): $i = 0; $__LIST__ = $car_config_option;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
          <option value="<?php echo $x['id']; ?>"><?php echo $x['config_name']; ?></option>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </td>
   </tr>
    
  <tr>
    <td style="width:15%;text-align:right;">本店价格：</td>
    <td><input type="text" class="textBox length-middle" name="car_shop_price"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">厂家价格：</td>
    <td><input type="text" class="textBox length-middle" name="car_vender_price"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">车辆详情介绍：</td>
    <td><textarea  name="car_info" id="ue"></textarea></td>
   </tr>
   <script>
    var ue=UE.getEditor('ue');
    //实例化ue编辑器
  </script>

   <tr>
    <td style="text-align:right;">车辆备注：</td>
    <td><input type="text" class="textBox length-middle" name="car_remark"/></td>
   </tr>

   <tr>
    <td style="text-align:right;"></td>
    <td><input type="submit" class="tdBtn" value="添加新车辆"/></td>
   </tr>
  
  </table>
  </form>
 </div>
</body>
</html>