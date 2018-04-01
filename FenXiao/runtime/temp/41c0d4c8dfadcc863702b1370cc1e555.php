<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\xampp\htdocs\public/../application/admin\view\Lunbo\updata.html";i:1510294778;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>编辑轮播</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">  
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
    <span class="modular fl"><i class="add_user"></i><em>编辑轮播</em></span>
  </div>
  <form action="/public/admin/lunbo/updata_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">
   <tr>
    <td style="width:15%;text-align:right;">轮播名字：</td>
    <td>
      <input type="hidden" name="id" value="<?php echo $lunbo_select['id']; ?>">
      <input type="text" class="textBox length-middle" name="lunbo_name" value="<?php echo $lunbo_select['lunbo_name']; ?>"/>
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">轮播图片：</td>
    <td><div id="preview" ></div><input type="file" value="<?php echo $lunbo_select['lunbo_pic']; ?>"/ onchange="preview(this)" name="lunbo_pic"/></td>
  </tr>

   <tr>
    <td style="text-align:right;">轮播显示位置：</td>
    <td><input type="text" class="textBox length-middle" name="lunbo_num" value="<?php echo $lunbo_select['lunbo_num']; ?>"/></td>
   </tr>
   <tr>
    <td style="text-align:right;">轮播备注：</td>
    <td><input type="text" class="textBox length-middle" name="lunbo_remark" value="<?php echo $lunbo_select['lunbo_remark']; ?>"/></td>
   </tr>
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