<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\xampp\htdocs\public/../application/admin\view\Config\index.html";i:1510295868;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>店铺信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__STATIC__/admin/style/H-ui.css">
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>店铺信息</em></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>店铺图片</th>
    <th>店铺名称</th>
    <th>店铺电话</th>
    <th>店铺地址</th>
    <th>操作</th>
   </tr>
    <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">
        <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../uploads/<?php echo $x['config_pic']; ?>">
      </td>

        <td class="center">
          <span>
            <em><?php echo $x['config_name']; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['config_phone']; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['config_dizhi']; ?></em>
          </span>
        </td>


      <td class="center">
       <a href="/public/admin/config/updata_show?id=<?php echo $x['id']; ?>" title="编辑"><img src="__STATIC__/admin/images/icon_edit.gif"/></a>
      </td>
      </tr>   
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  <!-- BatchOperation -->
  <div style="overflow:hidden;">
      <!-- Operation -->
	  <!-- turn page -->
  
    <div class="turnPage center fr">
      <?php echo $p->render; ?>  
    </div>
  </div>
 </div>
</body>
</html>