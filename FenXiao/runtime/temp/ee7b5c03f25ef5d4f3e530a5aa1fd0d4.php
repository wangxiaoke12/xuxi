<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\xampp\htdocs\public/../application/admin\view\Order\index.html";i:1510365860;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>订单列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__STATIC__/admin/style/H-ui.css">
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
<style>
  .ajax_img_1,.ajax_img_2{
    width:32px;
    height:32px;
  }
  .goods{
    display: flex;
  }
  .goods div{
    width:100%;
  }
  .ajax_img_3{

  }
  .ajax_img_3:hover{
    transition:0.3s;
    transform: scale(1.2);
  }
</style>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>订单列表</em></span>
    <span class="modular fr"><a href="/public/admin/order/add_show" class="pt-link-btn">+添加订单</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>订单电话</th>
    <th>订单编号</th>
    <th>订单物品</th>
    <th>订单金额</th>
    <th>下单时间</th>
    <th>完成时间</th>
   </tr>
    <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">
        
        <td class="center">
          <span>
            <em><?php echo $x['dingdan_phone']; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['dingdan_num']; ?></em>
          </span>
        </td>

        <td class="center">
          <table><?php echo $x['con']; ?></table>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['dingdan_money']/1000; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['dingdan_time_s']; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['dingdan_time_e']; ?></em>
          </span>
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