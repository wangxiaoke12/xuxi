<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\xampp\htdocs\public/../application/admin\view\huodong\updata.html";i:1506409901;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>编辑轮播</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
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
    <td><input type="file" name="lunbo_pic" value="<?php echo $lunbo_select['lunbo_pic']; ?>"/></td>
   </tr>
   <tr>
    <td style="text-align:right;">轮播显示：</td>
    <td>
    显示：<input type="radio" name="lunbo_show" value="显示" <?php if('显示'==$lunbo_select['lunbo_show']): ?> checked="true" <?php endif; ?>>
    不显示：<input type="radio" name="lunbo_show" value="不显示" <?php if('不显示'==$lunbo_select['lunbo_show']): ?> checked="true" <?php endif; ?>>
    </td>
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
</html>