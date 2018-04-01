<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\xampp\htdocs\public/../application/admin\view\Code\index.html";i:1509935735;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>二维码</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="__STATIC__/admin/style/H-ui.css">
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
<script>
  function lay(id){
    layer.confirm(
      '确认删除？', 
      {btn: ['确定', '取消'],
      btn1:function(index, layero){window.location.href='/public/admin/code/del?id='+id}
     
      }
      );
    return false;
  }
</script>
<script type="text/javascript" src="https://cdn-hangzhou.goeasy.io/goeasy.js"></script>
<script type="text/javascript" src="/public/static/layer/layer.js"></script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>二维码</em></span>
    <span class="modular fr"><a href="/public/admin/code/add_show" class="pt-link-btn">+二维码</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>桌号</th>
    <th>二维码</th>
    <th>操作</th>
   </tr>
   <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">
        <td class="center">
          <span>
            <em><?php echo $x['code_name']; ?></em>
          </span>
        </td>

        <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../code/<?php echo $x['id']; ?>.jpg">
        </td>
     
      <td class="center">
       <a title="删除" onClick="return lay(<?php echo $x['id']; ?>)" ><img src="__STATIC__/admin/images/icon_drop.gif"/></a>
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