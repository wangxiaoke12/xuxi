<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\xampp\htdocs\public/../application/admin\view\huodong\add.html";i:1506411822;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>添加新活动</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/admin/ue/ueditor.config.js"></script>
  <script src="__STATIC__/admin/ue/ueditor.all.min.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i class="add_user"></i><em>添加活动</em></span>
  </div>
  <form action="/public/admin/huodong/add_insert" method="POST" enctype="multipart/form-data">
  <table class="list-style">

   <tr>
    <td style="width:15%;text-align:right;">活动名字：</td>
    <td><input type="text" class="textBox length-middle" name="huodong_name"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">活动图片：</td>
    <td><input type="file" name="huodong_pic"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">活动显示：</td>
    <td>
    显示：<input type="radio" name="huodong_show" value="显示">
    不显示：<input type="radio" name="huodong_show" value="不显示" checked="true">
    </td>
   </tr>

   <tr>
    <td style="text-align:right;">活动显示顺序：</td>
    <td><input type="text" class="textBox length-middle" name="huodong_num"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">活动时间：</td>
    <td><input type="text" class="textBox length-middle" name="huodong_time"/></td>
   </tr>

   <tr>
    <td style="text-align:right;">活动内容：</td>
    <td><textarea  name="huodong_text" id="ue"></textarea></td>
   </tr>
   <script>
    var ue=UE.getEditor('ue');
    //实例化ue编辑器
  </script>

   <tr>
    <td style="text-align:right;">活动备注：</td>
    <td><input type="text" class="textBox length-middle" name="huodong_remark"/></td>
   </tr>

   <tr>
    <td style="text-align:right;"></td>
    <td><input type="submit" class="tdBtn" value="添加新活动"/></td>
   </tr>
  
  </table>
  </form>
 </div>
</body>
</html>