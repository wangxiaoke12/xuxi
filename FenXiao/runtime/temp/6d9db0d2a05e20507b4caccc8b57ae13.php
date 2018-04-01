<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"D:\xampp\htdocs\public/../application/admin\view\Huodong\index.html";i:1506408885;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>活动列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__STATIC__/admin/style/H-ui.css">
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>活动列表</em></span>
    <span class="modular fr"><a href="/public/admin/huodong/add_show" class="pt-link-btn">+添加活动</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>活动名字</th>
    <th>活动图片</th>
    <th>活动显示</th>
    <th>活动显示顺序</th>
    <th>活动时间</th>
    <th>活动内容</th>
    <th>活动备注</th>
    <th>操作</th>
   </tr>
    <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">

      <td class="center">
        <span>
          <em><?php echo $x['huodong_name']; ?></em>
        </span>
      </td>

      <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../uploads/<?php echo $x['huodong_pic']; ?>">
      </td>

      <td class="center">
        <img
        <?php if('显示'==$x['huodong_show']): ?>src='__STATIC__/admin/images/yes.gif'<?php endif; if('不显示'==$x['huodong_show']): ?>src='__STATIC__/admin/images/no.gif'<?php endif; ?>
         />
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['huodong_num']; ?></em>
       </span>
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['huodong_time']; ?></em>
       </span>
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['huodong_text']; ?></em>
       </span>
      </td>  

      <td class="center">
       <span>
        <em><?php echo $x['huodong_remark']; ?></em>
       </span>
      </td>

      <td class="center">
       <a href="/public/admin/huodong/updata_show?id=<?php echo $x['id']; ?>" title="编辑"><img src="__STATIC__/admin/images/icon_edit.gif"/></a>
       <a title="删除" href="/public/admin/huodong/del?id=<?php echo $x['id']; ?>"><img src="__STATIC__/admin/images/icon_drop.gif"/></a>
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