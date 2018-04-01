<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\xampp\htdocs\public/../application/admin\view\Config\add.html";i:1506473591;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>添加新配置</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>添加配置</em></span>
  </div>
  <form action="/public/admin/config/add_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">配置名称：</td>
    <td><input type="text" class="textBox length-middle" name="config_name"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">车身尺寸：</td>
    <td><input type="text" class="textBox length-middle" name="config_text1"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">综合油耗：</td>
    <td><input type="text" class="textBox length-middle" name="config_text2"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">车身结构：</td>
    <td><input type="text" class="textBox length-middle" name="config_text3"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">整车质保：</td>
    <td><input type="text" class="textBox length-middle" name="config_text4"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">发动机：</td>
    <td><input type="text" class="textBox length-middle" name="config_text5"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">变速箱：</td>
    <td><input type="text" class="textBox length-middle" name="config_text6"/></td>
   </tr>

   <tr>
    <td style="width:15%;text-align:right;">驱动方式：</td>
    <td><input type="text" class="textBox length-middle" name="config_text7"/></td>
   </tr>

   <tr>
    <td style="text-align:right;"></td>
    <td><input type="submit" class="tdBtn" value="添加新配置"/></td>
   </tr>

  </table>
  </form>
 </div>
</body>
</html>