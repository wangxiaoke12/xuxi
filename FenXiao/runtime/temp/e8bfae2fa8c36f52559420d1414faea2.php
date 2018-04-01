<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\xampp\htdocs\public/../application/admin\view\Food\index.html";i:1510284014;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>商品</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
<link href="__STATIC__/fuxuan/styles.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/fuxuan/inserthtml.com.radios.css" rel="stylesheet" type="text/css" />
<script src="__STATIC__/fuxuan/modernizr.js"></script>
<script>
  function lay(id){
    layer.confirm(
      '确认删除？', 
      {btn: ['确定', '取消'],
      btn1:function(index, layero){window.location.href='/public/admin/food/del?id='+id}
     
      }
      );
    return false;
  }
</script>
<script type="text/javascript" src="https://cdn-hangzhou.goeasy.io/goeasy.js"></script>
<script type="text/javascript" src="/public/static/layer/layer.js"></script>
<style>
    .center label{
      display: flex;
      width:40px;
      line-height:22px;
      margin: 0 auto;
    }
    .center span{
      margin:0 auto;
    }
</style>
</head>
<body>
 <div class="wrap">
  <div class="page-title">
    <span class="modular fl"><i></i><em>商品</em></span>
    <span class="modular fr"><a href="/public/admin/food/add_show" class="pt-link-btn">+商品</a></span>
  </div>
  <table class="list-style Interlaced">
   <tr>
    <th>名字</th>
    <th>分类</th>
    <th>图片</th>
    <th>月销</th>
    <th>价格</th>
    <th>首页显示</th>
    <th>操作</th>
   </tr>
   <?php if(is_array($p->data) || $p->data instanceof \think\Collection || $p->data instanceof \think\Paginator): $i = 0; $__LIST__ = $p->data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($i % 2 );++$i;?>
      <tr class="trbgcolor">
        <td class="center">
          <span>
            <em><?php echo $x['food_name']; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['food_brand']; ?></em>
          </span>
        </td>

        <td class="center">
        <img style="width:120px;height:120px" src="__STATIC__/../uploads/<?php echo $x['food_pic']; ?>">
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['food_num']; ?></em>
          </span>
        </td>

        <td class="center">
          <span>
            <em><?php echo $x['food_money']/1000; ?>元</em>
          </span>
        </td> 
        
        <td class="center">
          <span>
            <div class="center">
              <input sytle="text-align:center" name="food_index_show"  type="checkbox" <?php echo $x['food_index_show']==1?'checked=1' : ''; ?> id="checkbox-8-<?php echo $x['id']*100; ?>" />
              <label setid=<?php echo $x['id']; ?> vvv="<?php echo $x['food_index_show']==1?'1' : '0'; ?>" for="checkbox-8-<?php echo $x['id']*100; ?>">
              </label>
            </div>   
          </span>
        </td>

      <td class="center">
      <a href="/public/admin/food/updata_show?id=<?php echo $x['id']; ?>" title="编辑"><img src="__STATIC__/admin/images/icon_edit.gif"/></a>
       <a title="删除" onClick="return lay(<?php echo $x['id']; ?>)"><img src="__STATIC__/admin/images/icon_drop.gif"/></a>
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

        $.post("/public/admin/food/updata_index_show",{'val':$(this).next().attr('vvv'),'id':$(this).next().attr('setid')},function(result){
              console.log(result);
            });
      });
});
</script>
</html>