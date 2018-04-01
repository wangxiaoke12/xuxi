<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/Applications/MAMP/htdocs/FenXiao/public/../application/admin/view/Main/index.html";i:1510569734;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>收银台</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__STATIC__/admin/style/adminStyle.css" rel="stylesheet" />
<script src="__STATIC__/admin/js/jquery.js"></script>
<script src="__STATIC__/admin/js/public.js"></script>
<script type="text/javascript" src="https://cdn-hangzhou.goeasy.io/goeasy.js"></script>
<script type="text/javascript" src="/public/static/layer/layer.js"></script>
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
    <span class="modular fl"><i></i><em>收银台</em></span>
  </div>
  <div class="wrap start-page" style="padding: 0px;">
  <dl style="height:15px;text-align: center;">
  <dd style="margin-top:0px;padding: 0px;">
   <ul>
    <li style="line-height: 15px;">
     <span>总营业额：</span>
     <span><?php echo $con_1/1000; ?>元</span>
    </li>
    <li style="line-height: 15px;">
     <span>今日营业额：</span>
     <span><?php echo $con_2/1000; ?>元</span>
    </li>
    <li style="line-height: 15px;">
     <span>今日成交订单：</span>
     <span><?php echo $con_3; ?></span>
    </li>
   </ul>
  </dd>
 </dl>
 </div>
  <table class="list-style Interlaced">
   <tr>
    <th>包房</th>
    <th>电话</th>
    <th>下单时间</th>
    <th>商品</th>
    <th>总价</th>
    <th>操作</th>
   </tr> 
  
     <?php if(is_array($dingdan_select) || $dingdan_select instanceof \think\Collection || $dingdan_select instanceof \think\Paginator): $k = 0; $__LIST__ = $dingdan_select;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$x): $mod = ($k % 2 );++$k;?>
      <tr class='trbgcolor'>

        <td class='center'>
          <span>
            <em>
              <?php echo $x['dingdan_table']; ?>
            </em>
          </span>
        </td>
        
        <td class='center'>
          <span>
            <em>
              <?php echo $x['dingdan_phone']; ?>
            </em>
          </span>
        </td>

        <td class='center'>
          <span>
            <em>
              <?php echo $x['dingdan_time_s']; ?>
            </em>
          </span>
        </td>

        <td class='center'>
          
            <table>
            <?php if(is_array($goods[$k-1]) || $goods[$k-1] instanceof \think\Collection || $goods[$k-1] instanceof \think\Paginator): $i = 0; $__LIST__ = $goods[$k-1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?>
              <div class="goods">
                <div>
                  <em><?php echo $a; ?></em>
                </div>
                <div>
                  <em>X<?php echo $shops[$k-1][$key]; ?></em>
                </div>
                <div>
                  <em><?php echo $moneys[$k-1][$key]; ?>元</em>
                </div>
              </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </table>        

        </td>
        <td class='center'>
          <span>
            <em><?php echo $x['dingdan_money']; ?>元</em>
          </span>
        </td>
        <td class='center' id="dianji">
          <img class="ajax_img_0 ajax_img_3" onclick='ajax_end0("<?php echo $x['id']; ?>")'  src='/public/static/admin/images/print.png'/>
          <img class="ajax_img_1 ajax_img_3" id="<?php echo $x['id']; ?>" src='/public/static/admin/images/ok.png'/>
          <img class="ajax_img_2 ajax_img_3" id="<?php echo $x['id']; ?>" src='/public/static/admin/images/no.png'/>
        </td>
      </tr>
     <?php endforeach; endif; else: echo "" ;endif; ?>

  </table>
  <!-- BatchOperation -->
  <div style="overflow:hidden;">
      <!-- Operation -->
	  <!-- turn page -->
  
  </div>

 </div>
 <script>

  var goEasy = new GoEasy({
             appkey:'BC-bb56f45238354d1996fd220dbe10c527'
        });

    goEasy.subscribe({
      channel: 'phone',
      onMessage: function(message){
        $(document).ready(function(){
            $.post("/public/admin/main/ajax",{num:message.content},function(result){
                $(".list-style tr:eq(0)").after(result);
            });
        });
      }
    });
    
    $(document).ready(function(){
      //提交订单
      $(".ajax_img_1").on("click",function(){
        var $that=$(this);
        $.post("/public/admin/main/update",{id:$(this).attr('id')},function(result){
                $that.parent().parent().remove();
              });
      });

      $(".ajax_img_2").on("click",function(){
         //删除订单
         var $that=$(this);
        layer.confirm('确认删除此订单？', {
          btn: ['确定','取消'] //按钮
        }, function(){
          aaa($that);
          
        }, function(){
          layer.msg('取消删除', {
            time: 600, //20s后自动关闭
          });
        });

        function aaa(a){
          $.post("/public/admin/main/del",{id:a.attr('id')},function(result){
              $that.parent().parent().remove();
              layer.msg('成功删除', {
                time: 600, //20s后自动关闭
              });
            });
        }

         
      });

    });

    function ajax_end1(a){

      $.post("/public/admin/main/update",{id:$(a).attr('id')},function(result){
                $(a).parent().parent().remove();
              });
    }

    function ajax_end2(a){
       var r=confirm("确认删除此订单？");
        if (r==true){
          $.post("/public/admin/main/del",{id:$(a).attr('id')},function(result){
              $(a).parent().parent().remove();
            });
        }   
    }

    function ajax_end0(id){
      layer.open({
          type: 2 //此处以iframe举例
          ,title: '小票打印'
          ,area: ['390px', '400px']
          ,shade: 0
          ,offset: [ 
            100
            ,200
          ]
          ,maxmin: true
          ,content: '/public/admin/main/dingdan_xinxi/id/'+id
          ,btn: [ '全部关闭'] //只是为了演示
          ,btn2: function(){
            layer.closeAll();
          }
          
          ,zIndex: layer.zIndex //重点1
          ,success: function(layero){
            layer.setTop(layero); //重点2
          }
        });
    }

 </script>
</body>
</html>