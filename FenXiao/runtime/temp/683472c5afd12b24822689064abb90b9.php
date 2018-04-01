<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\xampp\htdocs\public/../application/admin\view\Level\add.html";i:1506415176;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>添加新级别</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>添加级别</em></span>
  </div>
  <form action="/public/admin/level/add_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">
  
   <tr>
    <td style="width:15%;text-align:right;">级别名字：</td>
    <td><input type="text" class="textBox length-middle" name="level_name"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">级别图片：</td>
    <td><input type="file" name="level_pic"/></td>
   </tr>
   
   <tr>
    <td style="text-align:right;">级别备注：</td>
    <td><input type="text" class="textBox length-middle" name="level_remark"/></td>
   </tr>

   <tr>
    <td style="text-align:right;"></td>
    <td><input type="submit" class="tdBtn" value="添加新级别"/></td>
   </tr>

  </table>
  </form>
 </div>
</body>
</html>