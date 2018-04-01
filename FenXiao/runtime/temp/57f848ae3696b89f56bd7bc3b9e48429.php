<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\xampp\htdocs\public/../application/admin\view\login\index.html";i:1507360701;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台登陆</title>
</head>
<style>
	*{ margin:0; padding:0;}
	div{ overflow:hidden; margin:0 auto;}
	body{  background:#94a1cd; overflow:hidden;}
	#d1{ width:425px; height:455px; background:#fff; margin:10% auto;}
	#d2{ width:405px; height:435px; margin-top:10px; text-align:center; border:2px solid #2b4695;}
	#d2>p:first-child{ text-align:center; line-height:80px; font-size:50px; font-family:微软雅黑; font-weight:bold; color:#2a44a1;}
	#d2>fieldset{ width:80%; border:0; border-top:1px solid #000; margin:0 auto; text-align:center; margin-bottom:40px;}
	#d2>fieldset>legend{display: inline; margin:0;  padding:10px; }
	#d2 form input[type=submit]{ width:260px; height:40px; border:0; background:#2a4795; color:#fff; font-family:微软雅黑; cursor:pointer;}
	#d2 form input[type=text]{ outline:none; font-size:14px; font-weight:bold; width:200px; height:40px; padding-left:60px; border:1px solid #878787; line-height:40px;}
	#d2 form input[type=password]{ outline:none; font-size:14px; font-weight:bold; width:200px; height:40px; padding-left:60px; border:1px solid #878787; line-height:40px;}
	.tishi{ font-size:12px; color:#cacaca; line-height:40px; margin-top:20px;}
</style>
<body>
	<div id="d1">
    	<div id="d2">
        	<p>♨</p>
            <fieldset>
            	<legend><div>XXXX后台操作</div></legend>
            </fieldset>
            <form action="/public/admin/login/login" method="POST" enctype="multipart/form-data">
            	<div style=" position:relative;">
                <span style="position:absolute; top:11px; left:80px; font-size:14px; font-family:微软雅黑;">账号：</span>
            	<input type="text" name="user" /><br /><br />
                </div>
            	<div style=" position:relative;">
                <span style="position:absolute; top:11px; left:80px; font-size:14px; font-family:微软雅黑;">密码：</span>
            	<input type="password" name="user" /><br /><br />
                </div>
                <input type="submit" value="登录" /><br />
            </form>
            <p class="tishi">登录后台，请谨慎操作。</p>
        </div>
    </div>
</body>
</html>