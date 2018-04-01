<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\xampp\htdocs\hsn2\public/../application/admin\view\Top\index.html";i:1509416654;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>header</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/admin/js/jquery.js"></script>
</head>
<body>
<div class="header">
 <div class="logo">
  <img src="__STATIC__/admin/images/admin_logo.png" title="1002158476"/>
 </div>
 <div class="fr top-link">
  <a target="mainCont" title="DeathGhost"><i class="adminIcon"></i><span>管理员：admin</span></a>
  <a href="/public/admin/pwd" target="mainCont" title="修改密码"><i class="revisepwdIcon"></i><span>修改密码</span></a>
  <a id="end"  target="index" title="安全退出" style="background:rgb(60,60,60);"><i class="quitIcon"></i><span>安全退出</span></a>
 </div>
</div>
</body>
<script>
 $(document).ready(function(){
 	$("#end").on("click",function(){
        $.post("/public/admin/login/del_huancun",function(result){
                 parent.location.reload();
              });
      });
 });
	//href="/public/admin/login/del_huancun"
</script>
</html>