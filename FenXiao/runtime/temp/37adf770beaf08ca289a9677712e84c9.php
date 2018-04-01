<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\xampp\htdocs\public/../application/admin\view\Food\updata.html";i:1510206843;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>编辑商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
  <script src="__STATIC__/admin/ue/ueditor.config.js"></script>
  <script src="__STATIC__/admin/ue/ueditor.all.min.js"></script>
  <link href="__STATIC__/fuxuan/styles.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/fuxuan/inserthtml.com.radios.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/fuxuan/modernizr.js"></script>
<style>
    .center{
      display: flex;
    }
    .center label{
      display: flex;
      line-height: 17px;
    }
    .center span{
      margin:0 auto;
    }

    #preview, .img, img  
     {  
     width:150px;  
     height:150px;  
     }  
     #preview  
     {  
    border:1px solid #000;  
    }  
    .center{
      display: flex;
    }
    .center label{
      display: flex;
      line-height: 17px;
    }
    .center span{
      margin:0 auto;
    }
</style>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>编辑商品</em></span>
  </div>
  <form action="/public/admin/food/updata_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">商品名字：</td>
    <td>
      <input type="hidden" name="id" value="<?php echo $food_select['id']; ?>">
      <input type="text" class="textBox length-middle" name="food_name" value="<?php echo $food_select['food_name']; ?>"/>
    </td>
   </tr>
  
    <tr>
    <td style="width:15%;text-align:right;">商品品牌：</td>
    <td>
      <div class="center">
        <?php echo $con; ?>
      </div>
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">图片：</td>
    <td><div id="preview" ></div><input type="file" onchange="preview(this)" name="food_pic"/></td>
   </tr>
    
  <tr>
    <td style="width:15%;text-align:right;">月销：</td>
    <td><input type="text" class="textBox length-middle" name="food_num" value="<?php echo $food_select['food_num']; ?>"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">价格：</td>
    <td><input type="text" class="textBox length-middle" name="food_money" value="<?php echo $food_select['food_money']/1000; ?>"/></td>
   </tr>
  
  <tr>
    <td style="width:15%;text-align:right;">配料信息：</td>
    <td><textarea  name="food_con_peiliao" id="ue1"></textarea></td>
  </tr>

   <tr>
    <td style="width:15%;text-align:right;">详细介绍：</td>
    <td><textarea  name="food_con_jieshao" id="ue2"></textarea></td>
   </tr>
    
    <script>
    var ue1=UE.getEditor('ue1');
    var ue2=UE.getEditor('ue2');
    //实例化ue编辑器
    ue1.ready(function() {
        ue1.setContent('<?php echo $food_select['food_con_peiliao']; ?>');
    });
    ue2.ready(function() {
        ue2.setContent('<?php echo $food_select['food_con_jieshao']; ?>');
    });
  </script>

   <tr>
    <td style="text-align:right;"></td>
    <td><input type="submit" class="tdBtn" value="保存编辑"/></td>
   </tr>

  </table>
  </form>
 </div>
</body>
<script type="text/javascript">    
     function preview(file)  
     {  
     var prevDiv = document.getElementById('preview');  
     if (file.files && file.files[0])  
     {  
     var reader = new FileReader();  
     reader.onload = function(evt){  
     prevDiv.innerHTML = '<img src="' + evt.target.result + '" />';  
    }    
     reader.readAsDataURL(file.files[0]);  
    }  
     else    
     {  
     prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';  
     }  
     }  
</script> 
</html>