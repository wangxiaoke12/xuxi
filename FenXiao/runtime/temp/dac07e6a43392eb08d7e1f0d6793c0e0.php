<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"D:\xampp\htdocs\public/../application/admin\view\Food\add.html";i:1510199234;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>添加新商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/fuxuan/styles.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/fuxuan/inserthtml.com.radios.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/fuxuan/modernizr.js"></script>
<script src="__STATIC__/admin/ue/ueditor.config.js"></script>
  <script src="__STATIC__/admin/ue/ueditor.all.min.js"></script>
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
    <span class="modular fl"><i class="add_user"></i><em>添加商品</em></span>
  </div>
  <form action="/public/admin/food/add_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">名称：</td>
    <td><input type="text" class="textBox length-middle" name="food_name"/></td>
   </tr>
    
    <tr>
    <td style="width:15%;text-align:right;">商品分类：</td>
    <td>
      <div class="center">
        <?php if(is_array($food_brand_option) || $food_brand_option instanceof \think\Collection || $food_brand_option instanceof \think\Paginator): $i = 0; $__LIST__ = $food_brand_option;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
            <input sytle="text-align:center" name="food_brand[]" value="<?php echo $x['id']; ?>" type="checkbox" id="checkbox-7-<?php echo $key*100; ?>" />
            <label for="checkbox-7-<?php echo $key*100; ?>">
              <span><?php echo $x['brand_name']; ?></span>
            </label>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">图片：</td>
    <td><div id="preview" ></div><input type="file" onchange="preview(this)" name="food_pic"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">月销：</td>
    <td><input type="text" class="textBox length-middle" name="food_num"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">价格：</td>
    <td><input type="text" class="textBox length-middle" name="food_money"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">首页显示：</td>
    <td>
      <div class="center">
            <input sytle="text-align:center" name="food_index_show" value="1" type="checkbox" id="checkbox-7-20" />
            <label for="checkbox-7-20">
              <span>显示</span>
            </label>
      </div>
    </td>
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
    var ue=UE.getEditor('ue1');
     var ue=UE.getEditor('ue2');
    //实例化ue编辑器
  </script>
  

   <tr>
    <td style="text-align:right;"></td>
    <td><input type="submit" class="tdBtn" value="添加新商品"/></td>
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