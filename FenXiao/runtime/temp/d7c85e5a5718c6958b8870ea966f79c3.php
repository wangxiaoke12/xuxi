<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\xampp\htdocs\public/../application/admin\view\Config\updata.html";i:1510296447;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>编辑店铺</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/admin/ue/ueditor.config.js"></script>
  <script src="__STATIC__/admin/ue/ueditor.all.min.js"></script>
<style>
#preview, .img, img  
{  
  width:150px;  
  height:150px;  
}  
#preview  
{  
  border:1px solid #000;  
}  
</style>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>编辑店铺</em></span>
  </div>
  <form action="/public/admin/config/updata_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">店铺图片：</td>
    <td>
      <input type="hidden" name="id" value="<?php echo $config_select['id']; ?>">
      <div id="preview" ></div><input type="file" onchange="preview(this)" name="config_pic"/>
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">店铺名字：</td>
    <td><input type="text" class="textBox length-middle" name="config_name" value="<?php echo $config_select['config_name']; ?>"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">店铺电话：</td>
    <td><input type="number" class="textBox length-middle" name="config_phone" value="<?php echo $config_select['config_phone']; ?>"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">店铺地址：</td>
    <td><input type="text" class="textBox length-middle" name="config_dizhi" value="<?php echo $config_select['config_dizhi']; ?>"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">店铺介绍：</td>
    <td><textarea  name="config_jieshao" id="ue1"></textarea></td>
   </tr>
   <script>
    var ue1=UE.getEditor('ue1');
    //实例化ue编辑器
    ue1.ready(function() {
        ue1.setContent('<?php echo $config_select['config_jieshao']; ?>');
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