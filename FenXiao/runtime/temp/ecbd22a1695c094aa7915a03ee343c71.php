<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"D:\xampp\htdocs\hsn2\public/../application/admin\view\Lunbo\index.html";i:1510390211;}*/ ?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
<title>轮播列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
<link href="__STATIC__/fuxuan/styles.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/fuxuan/inserthtml.com.radios.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/fuxuan/modernizr.js"></script>
<script type="text/javascript" src="/public/static/layer/layer.js"></script>
<script>
  function lay(id){
    layer.confirm(
      '确认删除？', 
      {btn: ['确定', '取消'],
      btn1:function(index, layero){window.location.href='lunbo/del?id='+id}
      }
      );
    return false;
  }
</script>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>轮播列表</em></span>
    <span class="modular fr"><a href="lunbo/add_show" class="pt-link-btn">+添加轮播</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>轮播名字</th>
    <th>轮播图片</th>
    <th>轮播显示</th>
    <th>轮播显示位置</th>
    <th>轮播备注</th>
    <th>操作</th>
   </tr>
    <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">
        <td class="center">
          <span>
            <em><?php echo $x['lunbo_name']; ?></em>
          </span>
        </td>
      <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../uploads/<?php echo $x['lunbo_pic']; ?>">
      </td>
        

      <td class="center">
          <span>
            <div class="center">
              <input sytle="text-align:center" name="lunbo_show"  type="checkbox" <?php echo $x['lunbo_show']==1?'checked=1' : ''; ?> id="checkbox-8-<?php echo $x['id']*100; ?>" />
              <label setid=<?php echo $x['id']; ?> vvv="<?php echo $x['lunbo_show']==1?'1' : '0'; ?>" for="checkbox-8-<?php echo $x['id']*100; ?>">
              </label>
            </div>   
          </span>
      </td>  


      <td class="center">
       <span>
        <em><?php echo $x['lunbo_num']; ?></em>
       </span>
      </td>        
      <td class="center">
       <span>
        <em><?php echo $x['lunbo_remark']; ?></em>
       </span>
      </td>
      <td class="center">
       <a href="lunbo/updata_show?id=<?php echo $x['id']; ?>" title="编辑"><img src="__STATIC__/admin/images/icon_edit.gif"/></a>
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
<script>
$(document).ready(function(){
  $("input").on("click",function(){
        

       if($(this).next().attr("vvv")==1)
           $(this).next().attr("vvv",0);
      else
          $(this).next().attr("vvv",1);

        $.post("/hsn2/public/admin/lunbo/updata_index_show",{'val':$(this).next().attr('vvv'),'id':$(this).next().attr('setid')},function(result){
              console.log(result);
            });
      });
});
</script>
</html>