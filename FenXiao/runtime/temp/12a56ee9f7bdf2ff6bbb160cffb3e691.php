<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\xampp\htdocs\public/../application/admin\view\Level\updata.html";i:1506415196;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>编辑级别</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>编辑级别</em></span>
  </div>
  <form action="/public/admin/level/updata_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">
   <tr>
    <td style="width:15%;text-align:right;">级别名字：</td>
    <td>
      <input type="hidden" name="id" value="<?php echo $level_select['id']; ?>">
      <input type="text" class="textBox length-middle" name="level_name" value="<?php echo $level_select['level_name']; ?>"/>
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">级别图片：</td>
    <td><input type="file" name="level_pic" /></td>
   </tr>

   <tr>
    <td style="text-align:right;">级别备注：</td>
    <td><input type="text" class="textBox length-middle" name="level_remark" value="<?php echo $level_select['level_remark']; ?>"/></td>
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