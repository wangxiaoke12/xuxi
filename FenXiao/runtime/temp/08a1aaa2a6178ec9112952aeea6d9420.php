<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\xampp\htdocs\hsn2\public/../application/admin\view\tablezhuozi\updata.html";i:1510294116;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>添加新包房</title>
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
    <span class="modular fl"><i class="add_user"></i><em>添加包房</em></span>
  </div>
  <form action="/public/admin/tablezhuozi/updata_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">包房名称：</td>
    <input type="hidden" name="id" value="<?php echo $table_select['id']; ?>">
    <td><input type="text" class="textBox length-middle" name="tablezhuozi_name" value="<?php echo $table_select['table_name']; ?>" /></td>
   </tr>
    
    <tr>
    <td style="text-align:right;">图片：</td>
    <td><div id="preview" ></div><input type="file" onchange="preview(this)" name="tablezhuozi_pic" value="<?php echo $table_select['table_pic']; ?>" /></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">包房人数：</td>
    <td><input type="number" class="textBox length-middle" name="tablezhuozi_renshu" value="<?php echo $table_select['table_renshu']; ?>"  /></td>
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