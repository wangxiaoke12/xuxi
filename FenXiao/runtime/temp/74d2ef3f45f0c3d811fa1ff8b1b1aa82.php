<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"D:\xampp\htdocs\public/../application/admin\view\Car\index.html";i:1506418518;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>车辆列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__STATIC__/admin/style/H-ui.css">
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>车辆列表</em></span>
    <span class="modular fr"><a href="/public/admin/car/add_show" class="pt-link-btn">+添加车辆</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>标签</th>
    <th>名字</th>
    <th>图片</th>
    <th>首页显示</th>
    <th>首页显示顺序</th>
    <th>品牌</th>
    <th>级别</th>
    <th>车辆配置</th>
    <th>本店价</th>
    <th>商场价</th>
    <th>汽车备注</th>
    <th>操作</th>
   </tr>
    <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">

      <td class="center">
        <span>
          <em><?php echo $x['car_tag']; ?></em>
        </span>
      </td>

      <td class="center">
        <span>
          <em><?php echo $x['car_name']; ?></em>
        </span>
      </td>
      
      <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../uploads/<?php echo $x['car_pic']; ?>">
      </td>

      <td class="center">
        <img
        <?php if('显示'==$x['car_index_show']): ?>src='__STATIC__/admin/images/yes.gif'<?php endif; if('不显示'==$x['car_index_show']): ?>src='__STATIC__/admin/images/no.gif'<?php endif; ?>
         />
      </td>

      <td class="center">
        <span>
          <em><?php echo $x['car_index_show_num']; ?></em>
        </span>
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['brand']['brand_name']; ?></em>
       </span>
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['level']['level_name']; ?></em>
       </span>
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['config']['config_name']; ?></em>
       </span>
      </td>  

      <td class="center">
       <span>
        <em><?php echo $x['car_shop_price']; ?></em>
       </span>
      </td>

      <td class="center">
       <span>
        <em><?php echo $x['car_vender_price']; ?></em>
       </span>
      </td>


      <td class="center">
       <span>
        <em><?php echo $x['car_remark']; ?></em>
       </span>
      </td>

      <td class="center">
       <a href="/public/admin/car/updata_show?id=<?php echo $x['id']; ?>" title="编辑"><img src="__STATIC__/admin/images/icon_edit.gif"/></a>
       <a title="删除" href="/public/admin/car/del?id=<?php echo $x['id']; ?>"><img src="__STATIC__/admin/images/icon_drop.gif"/></a>
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