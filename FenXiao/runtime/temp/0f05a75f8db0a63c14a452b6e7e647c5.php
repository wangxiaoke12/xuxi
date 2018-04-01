<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\xampp\htdocs\public/../application/admin\view\Level\index.html";i:1506415214;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>级别列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__STATIC__/admin/style/H-ui.css">
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>级别列表</em></span>
    <span class="modular fr"><a href="/public/admin/level/add_show" class="pt-link-btn">+添加级别</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>级别名字</th>
    <th>级别图片</th>
    <th>级别备注</th>
    <th>操作</th>
   </tr>
    <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">
        <td class="center">
          <span>
            <em><?php echo $x['level_name']; ?></em>
          </span>
        </td>
      <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../uploads/<?php echo $x['level_pic']; ?>">
      </td>      
      <td class="center">
       <span>
        <em><?php echo $x['level_remark']; ?></em>
       </span>
      </td>
      <td class="center">
       <a href="/public/admin/level/updata_show?id=<?php echo $x['id']; ?>" title="编辑"><img src="__STATIC__/admin/images/icon_edit.gif"/></a>
       <a title="删除" href="/public/admin/level/del?id=<?php echo $x['id']; ?>"><img src="__STATIC__/admin/images/icon_drop.gif"/></a>
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