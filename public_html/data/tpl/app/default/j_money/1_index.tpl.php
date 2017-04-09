<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>收银台</title>
    <meta name="format-detection" content="telephone=no, address=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <link href="./resource/css/bootstrap.min.css" rel="stylesheet">
    <link href="./resource/css/font-awesome.min.css" rel="stylesheet">
    <link href="./resource/css/animate.css" rel="stylesheet">
    <link href="./resource/css/common.css" rel="stylesheet">
    <script src="<?php echo MODULE_URL;?>template/js/jquery-2.1.1.min.js"></script>
    <script src="<?php echo MODULE_URL;?>template/js/sweetalert.min.js"></script>

    <link type="text/css" rel="stylesheet" href="<?php echo MODULE_URL;?>template/js/sweetalert.css"/>

    <!-- 虚拟键盘 -->
    <link href="<?php echo MODULE_URL;?>template/extension/keyboard/docs/css/jquery-ui.min.css" rel="stylesheet">
    <script src="<?php echo MODULE_URL;?>template/extension/keyboard/docs/js/jquery-ui.min.js"></script>
    <link href="<?php echo MODULE_URL;?>template/extension/keyboard/css/keyboard.css" rel="stylesheet">
    <script src="<?php echo MODULE_URL;?>template/extension/keyboard/js/jquery.keyboard.js"></script>
    <!-- 虚拟键盘 -->

</head>
<body>


    <style>
    .btn-type{
        margin: 2px 0;
        padding: 40px 10px;
        font-size: 24px;
        font-weight: 700;
        width: 100%;
    }
    .fa-times{
        font-size: 21px;
        color: #f00;
        float: right;
        margin-right: 20px;
    }
    </style>
    <?php  if($operation=='display') { ?>
    <style>
    html{ height:100%;}
    body{height:100%; overflow:hidden; background:url(<?php  echo tomedia($cfg['bg'])?>); background-size:100% 100%;}
    .login_body{ display:table; width:80%; margin:0 auto; max-width:300px;height:100%;}
    .row{ display:table-row;}
    .cell{ display:table-cell; width:100%;vertical-align:middle; text-align:center}
    .logo{border-radius:50%;width:80px;margin:10px auto}
    .form-control{ margin-bottom:10px;}
    .btn-type{
        margin: 10px;
        padding: 40px;
        font-size: 34px;
        font-weight: 700;
    }
    </style>
    <!--登录-->
    <div class="login_body">
        <div class="row">
            <div class="cell">
                <img src="<?php  echo tomedia($cfg['logo'])?>" class="logo" alt="">
                <form  onSubmit="return false;">
                    <div class="input-group" style="margin-bottom:10px;"> <span class="input-group-addon" ><i class="fa fa-user" style="width:40px"></i></span>
                        <input type="number" name="userid"  class="form-control <?php  echo $ismobile;?> <?php  if(!$ismobile) { ?>num<?php  } ?>" placeholder="用户名" required  style="cursor:auto;">
                        <!-- autofocus autocomplete="off" -->
                    </div>
                    <div class="input-group" style="margin-bottom:10px;"> <span class="input-group-addon" ><i class="fa fa-key" style="width:40px"></i></span>
                        <input type="password"  name="pwd" class="form-control <?php  if(!$ismobile) { ?>num<?php  } ?>" placeholder="密码" required >
                        <!-- autocomplete="off" -->
                    </div>
                    <button class="btn btn-warning btn-block" type="submit" onClick="return checkUpdate();return false;"><i class="fa fa-sign-in"></i> 登录</button>
                </form>
            </div>
        </div>
    </div>
    <script language="javascript">
    $(document).ready(function(e) {
        var _h=$(document).height();
        $(".cell").height(_h*0.8);
    });

// 虚拟键盘
$('.num')
.keyboard({
    layout : 'num',
        restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
        preventPaste : true,  // prevent ctrl-v and right click
        autoAccept : true
    });

function checkUpdate(){
    var userid=$("input[name='userid']").val();
    var pwd=$("input[name='pwd']").val();
    if(userid.length<1){
        swal("用户名不能为空");
        return false;
    }
    if(pwd.length<6){
        swal("密码长度不正确");
        return false;
    }
    $.ajax({ 
        url: "<?php  echo $this->createMobileUrl('ajax',array('op'=>'login'))?>",
        type: "POST",
        data: {"userid":userid,"pwd":pwd},
        dataType:'json', 
        success: function(data){
            if(data.success){
                location.href="<?php  echo $this->createMobileUrl('index',array('op'=>'in'))?>";
            }else if(data.success2){
                location.href="/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=login&m=weisrc_dish&logid="+userid;
                // }else if(data.success3){
                //   location.href="http://shanghai.xyj0772.com/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=login&m=weisrc_dish&logid=4";
            }else{
                swal(data.msg);
            }
        },
        error:function(event,request,settings){
            alert("error");
        }
    })
    return false;
}
</script>
<?php  } else { ?> 
<!--登录成功-->
<style>

.jrow{ display:table-row;}
.jcell{ display:table-cell}
.valignM{ vertical-align:middle;}
.main_top{height:50px; background:#18BB9C; display:table; width:100%;}
.top_logo{width:180px; text-indent:30px; background:#1F232C; line-height:40px; padding:5px;}
.top_menu{line-height:50px;text-align:right; padding:0 30px 0 0;color:#FFF;}
.top_menu a{color:#FFF; display:inline-block; text-decoration:none; line-height:50px; padding:0 10px}
.top_menu a:hover{ background:#FFF; color:#18BB9C}
.main_body{display:table;width:100%;}
.body_left{width:180px;vertical-align:top;color:#FFF;background:#2F3541;}
.body_left_userinfobox{ background:#2F3541; padding:5px;}
.body_left_menu{ background:#2F3541;}
.body_left_menu ul,.body_left_menu ul li{ list-style:none; margin:0; padding:0;}
.body_left_menu ul li{padding:10px; line-height:24px; cursor:pointer;}
.body_left_menu ul li:hover{ background:#18BB9C}
.body_left_menu ul li.jlabel{background:#18BB9C}
.body_left_menu ul li span{ float:right;}
.body_left_menu ul li b{ margin-right:10px;}
.body_right{vertical-align:top;padding:20px;}
.body_right_meneybox{ text-align:center;}
.body_right_meneybox h2{ border-top-left-radius:4px;border-top-right-radius:4px;color:#FFF; font-size:40px; line-height:70px; margin:0}
.body_right_moneybox_btm{border-bottom-left-radius:4px;border-bottom-right-radius:4px;background:#FFF;border:1px solid #CCC;border-top:none;color:#999; padding:10px 0;}
.body_right_moneybox_btm .col-md-6:first-child{ border-right:1px solid #CCC;}
.body_right_moneybox_btm span{ font-size:22px; color:#666; display:block}
.body_right_main{ margin-top:20px;}
.bg_yellow{background:#F5AB35}
.bg_green{background:#2ECC71}
.bg_red{background:#F22613}
.bg_blue{background:#3498DB}
.bg_black{background:#2F3541}
.color_grade{color:#999}
.btn_sumitcss{line-height:40px; font-size:20px;}
#j_counter_btn input[type='button']{line-height:40px; font-size:20px;}
#j_counter_btn .row{ margin-bottom:15px;}
#j_counter_btn .row:last-child{margin-bottom:0;}
.extend_box{position:absolute; background:rgba(0,0,0,0.6); left:0; top:0; right:0; bottom:0; display:none; z-index:2}
.extend_innerbox{ width:98%; margin:0 auto; padding-top:10px; }
</style>
<div class="main_top">
    <div class="jrow">
        <div class="jcell top_logo" style="width:80px;padding:0;margin:0;text-indent:0;text-align:center">
           <img onclick="Wreload()" src="<?php  echo tomedia($cfg['logo'])?>" style="height:50px;" onerror="this.style.display='none'"/>
       </div>
       <div class="jcell top_menu">
        <span class="pull-left" style="font-size:24px;font-weight">&nbsp;&nbsp;&nbsp;&nbsp;
       <a onclick="c(1)">
         <?php  echo $storeinfo['title'];?>  
       </a> >  
         <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money&tablesid=<?php  echo $tablesid;?>"><?php  echo $tableinfo['zone'];?>-<?php  echo $tableinfo['id'];?></a>
     </span>

     
   <!--   <img src="<?php echo MODULE_URL;?>template/img/head.jpg"  style="max-height:40px;" class="img-circle img-thumbnail"/> -->
     <?php  echo $user['realname'];?>
     <span class="label label-info"><?php  echo $group;?></span>
     <a href="javascript:logout()"><i class="fa fa-sign-out"></i> 退出</a>

     <span class="alert alert-danger printCat">
        <b>打印机：</b> 

          <?php  if(is_array($printCat)) { foreach($printCat as $row) { ?>
                <label>
                <input type="checkbox" id="<?php  echo $row['id'];?>" value="<?php  echo $row['name'];?>" <?php  if($row['checked']) { ?>checked<?php  } ?> style="width:25px;height:25px">
                <?php  echo $row['name'];?>
                </label>
            <?php  } } ?> 
            <input type="submit" class="btn btn-mini btn-danger print-sub" value="修改">
            <script>
            $('.print-sub').click(function(){
                   var str = "";
                    $('.printCat input:checked').each(function(i){
                         if(0==i){
                            str = $(this).attr('id');
                        }else{
                            str += (","+$(this).attr('id'));
                        }
                    });
                       if(str ==""){
                        str = "000";
                    }
                $.post("<?php  echo $this->createMobileUrl('printsetting')?>",{"str":str,},function(data){
                    console.log('传过去:'+str);
                 console.log('收到:'+data);
                 swal({   title: "操作成功！", type:'success',  timer: 800,   showConfirmButton: false });
                 window.location.reload();
                });
            })
            </script>
     </span>
 </div>
</div>
</div>
<!---->
<div class="main_body">
    <div class="jrow">
        <div class="jcell body_left" style="width:80px">
            <!-- <div class="body_left_userinfobox"></div> -->
            <div class="body_left_menu">
                <style>
                .body_left_menu ul li {
                    padding: 30px 10px;
                }
                </style>
                <script>
                var showtable = 0;
//显示餐桌
function c(){
    $("#a0").css("display","none");
    $("#a1").css("display","block");
    // $('#reload').html('<li id="showtable" href="http://shanghai.xyj0772.com/app/index.php?i=1&c=entry&op=in&do=index&m=j_money" class="bg_yellow text-center"> 刷新</li>');
    console.log('显示餐桌 ');
    showtable = 1;
    console.log(showtable);
} 
<?php  if($tablesid=='') { ?>
//alert('没有桌号');
c(1);
<?php  } ?>
function Wreload(){
    console.log(showtable);
    if(showtable){
        window.location.href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money";
    }else{
        window.location.reload();
    }
}
</script>
<ul>
    <li class="jlabel"  onclick="c(1);">餐桌管理</li>
    <li onClick="extendFun(1);" class="bg_blue <?php  echo $ischeng;?>"> 交班记录</li>
    <li onClick="extendFun(2);" class="bg_red <?php  echo $ischeng;?>"> 收款记录</li>
    <div id="reload">
      <li onclick="Wreload()"  class="bg_yellow text-center"> 刷新</li>
  </div>
  <!-- 添加排号管理、预定管理 -->
  <!-- <li onClick="extendFun(3);" class="<?php  echo $ischeng;?>"> 排号管理</li> -->
  <!-- <li onClick="extendFun(4);" class="<?php  echo $ischeng;?>"> 预订管理</li> -->
  <?php  if(count($btnlist)) { ?>
  <!-- <li class="jlabel">扩展</li> -->
  <?php  if(is_array($btnlist)) { foreach($btnlist as $row) { ?>
  <li onClick="<?php  echo $row['btnurl'];?>"><?php  echo $row['btnname'];?></li>
  <?php  } } ?>
  <?php  } ?>

  <li class="jlabel" style="padding: 5px 3px;">
     总桌数：<?php  echo $tableall['total'];?><br>
     已结账：<?php  echo $tabledone['total'];?> <br>
     未结账：<?php  echo $tableopen['total'];?>
 </li>
</ul>
<br>
<?php  if($ischeng!="hidden") { ?><?php  } ?>
<!-- 只有前台 自动打印酒水，飞饼 -->
<iframe src="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=isfei&m=j_money"  style="width:0px; height:0px;  border: 0;"></iframe>

</div>
</div>

<div class="jcell body_right" id="a0" style="display:<?php  if($tablesid>0 ) { ?>block<?php  } else { ?>none<?php  } ?>">

    <!-- 加菜 -->
    <div class="panel panel-info hidden">
        <div class="panel-heading">加菜</div>
        <div class="row">
            <div class="col-xs-3"> 
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>名称</th>
                            <th>单价</th>
                            <th>重量</th>
                            <th>口味</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" action="" name="form3">
                            <script>
                    function price2(){//设置价格
                        var price =$("#addclick option:selected");  //获取选中的项
                        $('#oneprice2').val(price.attr('price'));
                        $('#addcai').text("已选："+$("#addclick option:selected").attr('name'));
                        // $("#addclick option").attr("name":$("#addclick option:selected").attr('name'));
                        console.log($("#addclick option:selected").val('name'));
                    }
                    </script>
                </form>
            </tbody> 
        </table>


    </div>
    <div class="col-xs-9">
        <div class="row">
            <div class="col-xs-3">
                <div class="panel  panel-primary">
                  <div class="panel-heading">鱼</div>
                  <!-- Table -->
                  <!-- List group -->
                  <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <div class="list-group">
          <a href="#" class="list-group-item active">
            <h4 class="list-group-item-heading">鱼</h4>
        </a>
        <a href="#" class="list-group-item ">
            <h4 class="list-group-item-heading">鱼</h4>
            <p class="list-group-item-text">asdfasfdasdf</p>
        </a>
    </div>
</div>





</div>

</div>
</div>


<!-- <div class="<?php  echo $ischeng;?> body_right_menu row ">
    <div class="col-xs-2">
        <div class="body_right_meneybox">
            <h2 class="bg_green"><img src="<?php echo MODULE_URL;?>template/img/wechart.gif" height="50"/></h2>
            <div class="body_right_moneybox_btm row">
                <div class="col-md-12"><span>￥<?php  echo $weixin;?></span>微信</div>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="body_right_meneybox">
            <h2 class="bg_blue"><img src="<?php echo MODULE_URL;?>template/img/alipay.gif" height="50"/></h2>
            <div class="body_right_moneybox_btm row">
                <div class="col-md-12"><span>￥<?php  echo $zfb;?></span>支付宝</div>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="body_right_meneybox">
            <h2 class="bg_yellow"><img src="<?php echo MODULE_URL;?>template/img/card.png" height="50"/></h2>
            <div class="body_right_moneybox_btm row">
                <div class="col-md-12"><span>闪惠：￥<?php  echo $shanhui;?></span>美团:￥<?php  echo $meituan;?></div>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="body_right_meneybox">
            <h2 class="bg_green"><img src="<?php echo MODULE_URL;?>template/img/cash.png" height="50"/></h2>
            <div class="body_right_moneybox_btm row">
                <div class="col-md-12"><span>￥<?php  echo $xianjin;?></span>现金</div>
            </div>
        </div>
    </div>
    <div class="col-xs-2">
        <div class="body_right_meneybox">
            <h2 class="bg_blue"><img src="<?php echo MODULE_URL;?>template/img/shuka.png" height="50"/></h2>
            <div class="body_right_moneybox_btm row">
                <div class="col-md-12"><span>￥<?php  echo $shuaka;?></span>刷卡</div>
            </div>
        </div>
    </div>

    <div class="col-xs-2">
        <div class="body_right_meneybox">
            <h2 class="bg_red"><img src="<?php echo MODULE_URL;?>template/img/money.png" height="50"/></h2>
            <div class="body_right_moneybox_btm row">
                <div class="col-md-12"><span>￥<?php  echo $today;?></span>总营业额</div>
            </div>
        </div>
    </div>
</div> -->
<!---->
<table class="table table-bordered">
    <tr class="success">
        <th>日期</th>
        <th>总人数</th>
        <th>人均</th>
        <th>现金</th>
        <th>刷卡</th>
        <th>支付宝</th>
        <th>微信</th>
        <th>美团</th>
        <th>闪惠+外卖</th>
        <th>总金额</th>
    </tr>
    <tr>
        <td><?php  echo date("Y-m-d",time())?></td>
        <td><?php  echo round($tongji['people']['total'])?></td>
        <td><?php  echo round(round(($tongji['all']['total']/100))/round($tongji['people']['total']))?></td>
        <td><?php  echo sprintf('%.2f',($tongji['cash']['total']/100))?> </td>
        <td>  <?php  echo sprintf('%.2f',($tongji['paycard']['total']/100))?> </td>
        <td><?php  echo sprintf('%.2f',($tongji['alipay']['total']/100))?></td>
        <td><?php  echo sprintf('%.2f',($tongji['weixin']['total']/100))?> </td>
        <td><?php  echo sprintf('%.2f',($tongji['meituan']['total']/100))?></td>
        <td><?php  echo sprintf('%.2f',($tongji['shanhui']['total']/100))?></td>
        <td><?php  echo sprintf('%.2f',($tongji['all']['total']/100))?> </td>
    </tr>
</table>
<style>
.sweet-alert{width:800px; margin-left: -400px;}
</style>
<div class="body_right_main row">
    <div class="body_right_main_left <?php  if($ischeng!="") { ?>col-md-12<?php  } else { ?>col-md-6<?php  } ?> ">

        <div class="panel panel-info">
            <div class="panel-heading"><?php  if($typeid['typeid']==1) { ?>称鱼 /<?php  } ?> 加菜

              <!-- <a class="btn btn-info changetable btn-block" tablesid="<?php  echo $item['id'];?>"  status="<?php  echo $item['status'];?>" >转台到</a> -->
              <!-- <a class="btn btn-warning andtable btn-block" tablesid="<?php  echo $item['id'];?>" orderid="<?php  echo $item['orderid']['id'];?>" status="<?php  echo $item['status'];?>" >并台到</a> -->

              <a class="btn btn-sm btn-success changetable pull-right" style="margin-top:-5px; margin-left:10px;" tablesid="<?php  echo $tablesid;?>" orderid="<?php  echo $orderid;?>">转台</a>
              <a class="btn btn-sm btn-warning andtable pull-right" style="margin-top:-5px; margin-left:10px;"  orderid="<?php  echo $orderid;?>" tablesid="<?php  echo $tablesid;?>">并台</a>
              <a class="btn btn-sm btn-danger pull-right" style="margin-top:-5px; margin-left:10px;" onclick="cancletable()">消台</a>
          </div>
          <div class="">
<?php  if($typeid['typeid']==3) { ?>
<center>
            <a class="btn btn-lg  btn-danger " id="addbtn" style="margin:5px auto" onclick="extendFun(5)"><i class="fa fa-plus"></i> 点击加菜</a>

<?php  } ?>
            <table class="table table-hover">
         <!--        <thead>
                    <tr>
                        <th width="350">名称</th>
                        <th>重量</th>
                        <th>口味</th>
                        <th>操作</th>
                    </tr>
                </thead> -->
                <tbody>

                   <?php  if($typeid['typeid']==1) { ?>
                    <form method="post" action="" name="form2">
                        <style>
                        .input-group,select{min-width:100px} 
                        </style>
                        <tr>
                            <td scope="row">
                                <!-- <div class="btn-group"> -->
                                <a type="button" class="btn btn-default btn-success btn-lg" id="shuan">酸菜鱼</a>
                                <a type="button" class="btn btn-lg btn-default"  id="qing">青花椒鱼</a>
                                <!-- </div> -->
                                <div id="selectfish" style=""></div>

                            </td>
                            <!-- <td> -->
                            <!-- <div id="selectfish" style="font-size:24px;font-weight:700"></div> -->
                            <input id="oneprice" name="oneprice" type="hidden" placeholder="单价" value="42">
                            <input id="fishid" name="fishid" type="hidden" placeholder="菜品id" value="<?php  echo $fish1['id'];?>">
                            <input id="goodstype" name="goodstype" type="hidden" placeholder="菜品类别" value="<?php  echo $fish1['pcate'];?>">
                            <td>
                                <div class="input-group " style="width:120px">
                                    <input class="form-control num input-lg" name="weight" size="2" type="text" placeholder="输入重量" value="">
                                    <div class="input-group-addon">斤</div>
                                </div>
                            </td>
                            <td>
                                <select id="flavor" name="flavor" class="form-control btn-success input-lg">
                                    <div id="shuanf">
                                        <option class="shuanf" value="不辣">酸菜鱼-不辣</option>
                                        <option  class="shuanf" value="微辣少辣">微辣少辣</option>
                                        <option  class="shuanf" value="微辣中辣">微辣中辣</option>
                                        <option class="shuanf"  value="微辣">微辣</option>
                                        <option class="shuanf"  value="中辣">中辣</option>
                                        <option class="shuanf"  value="重辣">重辣</option>
                                        <option  class="shuanf"  value="砂锅打包">砂锅打包</option>
                                        <option  class="shuanf"  value="打包盒打包">打包盒打包</option>
                                    </div>
                                    <div id="qingf">
                                        <option class="qingf"  value="青花椒鱼-微麻微辣">青花椒鱼-微麻微辣</option>
                                        <option class="qingf"   value="青花椒鱼-微辣中辣">青花椒鱼-微辣中辣</option>
                                        <option class="qingf"   value="青花椒鱼-中麻中辣">青花椒鱼-中麻中辣</option>
                                        <option class="qingf"   value="青花椒鱼-重麻重辣">青花椒鱼-重麻重辣</option>
                                        <option  class="qingf"   value="青花椒鱼-砂锅打包">青花椒鱼-砂锅打包</option>
                                        <option  class="qingf"   value="青花椒鱼-打包盒打包">青花椒鱼-打包盒打包</option>
                                    </div>
                                        <option  class=""  value="等叫">等叫</option>
                                </select>
                                <!-- <select name="flavor" class="form-control"> -->
                                <?php  if(is_array($taste)) { foreach($taste as $item) { ?>
                                <!-- <option value="<?php  echo $item['name'];?>"><?php  echo $item['name'];?></option> -->
                                <?php  } } ?>
                                <!-- </select> -->
                            </td>
                            <td>
                                <input type="hidden" name="tablesid" value="<?php  echo $tablesid;?>" />
                                <input type="submit" class="btn btn-danger btn-lg" name="fishclik" value="提交" />
                            </td>
                        </tr>
                    </form>
                    <script>
                    $('.qingf').attr('disabled',true);
                    $('#shuan').click(function(){
                        $('#shuan').addClass('btn-success');
                        $('#qing').removeClass('btn-success');
    $('#selectfish').addClass('text-success').removeClass('text-danger').html('酸菜鱼');//修改文字显示
    $('#oneprice').val(42);//修改价格
    $('#fishid').val(<?php  echo $fish1['id'];?>);//菜品id
    $('#goodstype').val(<?php  echo $fish1['pcate'];?>);//菜品类别
    $('.qingf').attr('disabled',true);//设置口味可选
    $('.shuanf').attr('disabled',false);//设置青花的口味不可选 
    $('#flavor option').attr('selected',false);
    $('#flavor option:eq(0)').attr('selected','selected');//选中第一个
})
                    $('#qing').click(function(){
                        $('#qing').addClass('btn-success');
                        $('#shuan').removeClass('btn-success');
                        $('#selectfish').addClass('text-danger').removeClass('text-success').html('青花椒鱼');
                        $('#oneprice').val(45);
    $('#fishid').val(<?php  echo $fish2['id'];?>);//菜品id
    $('#goodstype').val(<?php  echo $fish2['pcate'];?>);//菜品类别
    $('.shuanf').attr('disabled',true);
    $('.qingf').attr('disabled',false);
    $('#flavor option').attr('selected',false);
    $('#flavor option:eq(7)').attr('selected','selected');//选中第8个
})
                    </script>  <script>
//检查输入是否为数字
$('[type="text"]').change(function(){
    var val =$(this).val();
    if(isNaN(val)){
        alert("请输入数字");
        $(this).val(1);
    }
})    
</script>
<?php  } ?>
<!-- <form method="post" action="" name="form2"> -->
<!-- <tr> -->
<!-- <td scope="row">特殊菜</td> -->
<!-- <td> -->
<!-- <div class="input-group"> -->
<!-- <input class="form-control num" size="2" name="oneprice1" type="text" placeholder="请输入价格" value="1"> -->
<!-- <div class="input-group-addon">元</div> -->
<!-- </div> -->
<!-- </td> -->
<!-- <td> -->
<!-- <div class="input-group"> -->
<!-- <input class="form-control num" name="weight1" size="2" type="number" placeholder="输入份数" value="1"> -->
<!-- <div class="input-group-addon">份</div> -->
<!-- </div> -->
<!-- </td> -->
<!-- <td> -->
<!-- <select name="flavor1" class="form-control"> -->
<!-- <option value="微辣">微辣</option> -->
<!-- <option value="中辣">中辣</option> -->
<!-- <option value="重辣">重辣</option> -->
<!-- </select> -->
<!-- </td> -->
<!-- <td> -->
<!-- <input type="hidden" name="tablesid" value="<?php  echo $tablesid;?>" /> -->
<!-- <input type="submit" class="btn btn-danger btn-large" name="specialclik" value="提交" /> -->
<!-- </td> -->
<!-- </tr> -->
<!-- </form> -->
</tbody> 
</table>
</div>
</div>

<!-- 菜单列表  -->
<div class="panel panel-info">
    <div class="panel-heading">
        <input type="hidden" id="orderid" value="<?php  echo $orderid;?>" />
        <b><?php  echo $tableinfo['zone'];?>-<?php  echo $tableinfo['id'];?> 
         <span class="text-danger">
             <input type="hidden" id="status" value="<?php  echo $order['status'];?>" />
             订单号:<?php  echo $orderid;?> 
<?php  if($tablesid >0) { ?>
<?php  if($orderid < 0) { ?>
<script>
 swal({   title: "桌台已买单！正在为您刷新状态！", type:'error',  timer: 1000,   showConfirmButton: false });
 window.location.href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&tablesid=<?php  echo $tablesid;?>&orderid=1&do=xiaotai&m=j_money";
// window.location.href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money";
             </script>
<?php  } ?>
<?php  } ?>

         </span>
     </b>
     <script>
            function cancletable(){//消台
                var tempstatus=$("#status").val();
                if(tempstatus>0){
                    // alert("订单已确认，不能进行消台操作！");
                    // return;
                }
                var url = "<?php  echo $this->createMobileUrl('xiaotai', array('tablesid' => $tablesid,'orderid' => $orderid))?>";
                swal({   title: " 确定要消台吗",  
                    type: "error", 
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,   closeOnConfirm: false,   
                    showLoaderOnConfirm: true, }, function(){  
                        window.location.href=url;
                    });
            }
            //取消订单
            function cancleorder(){
                var url = "<?php  echo $this->createMobileUrl('cancelorder', array('orderid' => $orders['id'],'tablesid' => $tablesid))?>";
                swal({   title: " 确定要取消订单吗",  
                    type: "error", 
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,   closeOnConfirm: false,   
                    showLoaderOnConfirm: true, }, function(){  
                        window.location.href=url;
                    });
            }
//打印菜单
function dayin(i){
    var comment ="";
    // var kdz = "<li>可打折金额："+parseInt($('#kdz').text())+"</li>";
    var bkdz = "<li>不可打折金额："+ parseInt($('#bkdz').text())+"</li>";
    var zhekou = "<li>总打折金额："+parseInt($('#zhekou').text())+"</li>";
    var daijinquan ="<li>代金劵："+ parseInt($('#daijinquan').text())+"</li>";
    var mian ="<li>免单金额："+ parseInt($('#mian').text())+"</li>";
    var dz ="<li>打折金额："+parseInt($('#dz').text())+"</li>";
        var mj= "<li>满减金额："+parseInt($('#mj').text())+"</li>";//可打折2016.10.28
    var ys= "<li style=clear:both><h5>应收金额："+parseInt($('#ys').text())+"</h5></li>";//可打折2016.10.28
    comment =bkdz+zhekou+daijinquan+mian+dz+mj+ys; //
    console.log(comment);

    var url ="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&orderid=<?php  echo $orderid;?>&tablesid=<?php  echo $tablesid;?>&comment="+comment+"&do=print&m=j_money&type="+i;//0为点菜单 1预打
    console.log(url);
    window.open (url, "printbox", "height=600, width=400, toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, status=no"); 
//window.location.href=url;
}
</script>

<style>
.panel-heading {
    padding: 10px 15px;
    font-size: 16px;
}
</style>

<a class="btn btn-sm btn-danger pull-right" id="addbtn" style="margin-top:-5px; margin-left:10px;" onclick="extendFun(5)"><i class="fa fa-plus"></i> 点击加菜</a>

<?php  if($orders['id']!="") { ?>
<a class="btn btn-sm btn-danger pull-right" style="margin-top:-5px; margin-right:5px;" onclick="cancleorder()">取消订单</a>
<a class="btn btn-sm btn-success pull-right" style="margin-top:-5px; margin-right:5px;" href="<?php  echo $this->createMobileUrl('confirmorder', array('orderid' => $orders['id'],'tablesid' => $tablesid))?>">确认订单</a>
<?php  } else { ?>
<a class="btn btn-sm btn-warning pull-right" style="margin-top:-5px;margin-left:10px;" onclick="dayin(1)" target="printbox"><i class="fa fa-check"></i> 预打单</a>
<a class="btn btn-sm btn-info pull-right" style="margin-top:-5px;margin-left:10px;" onclick="dayin(0)" target="printbox"><i class="fa fa-list"></i> 点菜单</a>
<?php  } ?>



</div>
<div class="">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>数量</th>
                <th>单价</th>
                <th>总价</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>
            <?php  $i=1;?>
            <?php  if(is_array($order_goods)) { foreach($order_goods as $item) { ?>
            <?php  if($item['type']==1) { ?>
            <tr style="text-decoration:line-through" class="success">
                <?php  } else if($item['type']==2) { ?>
                <tr style="text-decoration:line-through" class="danger">
                    <?php  } else { ?>
                    <tr class="<?php  if($item['stepnow']==5) { ?>success<?php  } else if($item['stepnow']==1) { ?>warning<?php  } ?>" >
                        <?php  } ?>

                        <th scope="row"><?php  echo $i?></th>
                        <th>

                            <?php  if($item['stepnow']==0 and $item['type']==0) { ?>
                            <a class="btn btn-success shang"  id="<?php  echo $item['id'];?>">上桌</a>
                            <?php  } ?>


                            <?php  echo $item['title'];?>   <?php  echo $item['flavor'];?> 
                            <?php  if($item['stepnow']==5) { ?>
                            <span class="text-success">已上桌</span> 
                            <?php  } else if($item['stepnow']==1) { ?>
                            <span class="text-danger">正在传菜</span> 
                            <?php  } ?>
                            <span class="text-success" id="goodsid<?php  echo $item['goodsid'];?>">
                                <?php  if($item['type']==1) { ?>送<?php  } else if($item['type']==2) { ?>退<?php  } ?>
                            </span></th>
                            <td> <?php  echo $item['total'];?></td>
                            <td><?php  echo $item['price'];?></td>
                            <td><?php  echo round($item['ttprice'],2);?></td>
                            <td>

<?php  if($typeid['typeid'] ==1) { ?>
                                               
 
                                <a class="btn btn-success gai" total="<?php  echo $item['total'];?>" orderid="<?php  echo $item['orderid'];?>" goodsid="<?php  echo $item['goodsid'];?>"  price="<?php  echo round($item['ttprice'],2);?>"  tablesid="<?php  echo $item['tablesid'];?>" id="<?php  echo $item['id'];?>">改</a>
<?php  } ?>
                                <?php  if($ischeng!="hidden") { ?>
                                <a class="btn btn-success song" total="<?php  echo $item['total'];?>" orderid="<?php  echo $item['orderid'];?>" goodsid="<?php  echo $item['goodsid'];?>"  price="<?php  echo round($item['ttprice'],2);?>"  id="<?php  echo $item['id'];?>">送</a>
                                <a class="btn btn-danger tui" total="<?php  echo $item['total'];?>" orderid="<?php  echo $item['orderid'];?>" tablesid="<?php  echo $tablesid;?>" goodsid="<?php  echo $item['goodsid'];?>" price="<?php  echo round($item['price'],2);?>" id="<?php  echo $item['id'];?>">退</a>
                                <?php  } ?>

                                <a class="btn btn-info" target="printbox" tablesid="<?php  echo $tablesid;?>" href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=printfei&m=j_money&goodsid=<?php  echo $item['goodsid'];?>&tablesid=<?php  echo $tablesid;?>&total=<?php  echo $item['total'];?>&id=<?php  echo $item['id'];?>" >印</a>
                                <a class="btn btn-warning zhuan" total="<?php  echo $item['total'];?>" orderid="<?php  echo $item['orderid'];?>" goodsid="<?php  echo $item['goodsid'];?>" taste="<?php  echo $item['flavor'];?>" price="<?php  echo round($item['price'],2);?>" tablesid="<?php  echo $tablesid;?>" id="<?php  echo $item['id'];?>" >转</a>
                            </td>
                        </tr>
                        <?php  $i++?>
                        <?php  } } ?>


                        <script>
                        function settaste(i){
                            $("[tabindex='3']").val(i);
                        }
//修改做法
$('.gai').click(function(){
    var id = $(this).attr('id');
    var goodsid = $(this).attr('goodsid');
    var tablesid = $(this).attr('tablesid');
    var total = $(this).attr('total');
    var orderid = $(this).attr('orderid');
    var btns = '';
    btns += '<div class="row">';
    <?php  if(is_array($taste)) { foreach($taste as $item) { ?>
    btns += '<div class="col-xs-4"> <a type="a" class="btn btn-success" onclick=settaste("<?php  echo $item["name"];?>")><?php  echo $item["name"];?></a></div>';
    <?php  } } ?>
    btns += ' </div> ';
        swal({// 用户支付   16.9.14  
            title: "修改做法",   
            text: btns,   
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认",
            cancelButtonText: "关闭",  
            inputPlaceholder: "请选择做法" 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请选择做法");     
                return false
            }
            $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'gai'))?>",{"id":id,"total":total,"tablesid":tablesid,"goodsid":goodsid,"orderid":orderid,"taste":inputValue},function(data){
                 //console.log(data);
                 var feedback=eval("("+data+")");
                 swal({   title: "操作成功,按F5刷新页面可见！", type:'success',  timer: 500,   showConfirmButton: false });
                 window.location.reload();
             });
        });
});
//菜品转台
$('.zhuan').click(function(){
    var id = $(this).attr('id');
    var goodsid = $(this).attr('goodsid');
    var tablesid = $(this).attr('tablesid');
    var total = $(this).attr('total');
    var price = $(this).attr('price');
    var orderid = $(this).attr('orderid');
    var taste = $(this).attr('taste');
    var btns = '';
    btns += '<div class="row">';
    <?php  if(is_array($list)) { foreach($list as $item) { ?>
         if (tablesid!=<?php  echo $item['id'];?> && <?php  echo $item['status'];?>==1){ //非自己，已开台
            btns += '<div class="col-xs-3"  style="margin:2px 0;"> <a type="a" class="btn btn-info" onclick=settaste("<?php  echo $item["id"];?>")><?php  echo $item["zone"];?>-<?php  echo $item["title"];?></a></div>';
        }
        <?php  } } ?>
        btns += ' </div> ';
        swal({// 菜品转台 17.2.27 
            title: "菜品转台",
            text: btns,   
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认",
            cancelButtonText: "关闭",  
            inputPlaceholder: "请选择做法" 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请选择目标桌");     
                return false
            }
            $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'zhuan'))?>",{"id":id,"total":total,"tablesid":tablesid,"price":price,"goodsid":goodsid,"taste":taste,"orderid":orderid,"tabletg":inputValue},function(data){
                 //console.log(data);
                 var feedback=eval("("+data+")");
                 swal({   title: "操作成功,按F5刷新页面可见！", type:'success',  timer: 500,   showConfirmButton: false });
                 window.location.reload();
             });
        });
});

$('.tui').click(function(){
    var zhekou = parseInt($('#zhekou').text());
    var fee = parseInt($('#fee').text());
    var orderid = $(this).attr('orderid');
    var goodsid = $(this).attr('goodsid');
    var tablesid = $(this).attr('tablesid');
    var id = $(this).attr('id');
    var total = parseFloat($(this).attr('total'));
    var price = parseInt($(this).attr('price'));
    var allzhekou =zhekou+price;
    var divid ="divid"+goodsid;
    var left =0;
    swal({   title: " 请输入要退的份数？",  
       type: "input", 
       confirmButtonText: "确定",
       cancelButtonText: "取消",
       showCancelButton: true,   closeOnConfirm: false,   
       showLoaderOnConfirm: true, 
       inputPlaceholder: "份数" },
       function(inputValue){   
        inputValue = inputValue;
        if (inputValue === false) return false;
        if (inputValue === "" || inputValue > total) {     
            swal.showInputError("请输入正确的份数!");
            return false   
        }else if(inputValue<total){
                    left = total-inputValue;// 只减部份，不全退
                }  
                // alert(inputValue);
                $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'tui'))?>",{"orderid":orderid,"goodsid":goodsid,"tablesid":tablesid,"price":price,"total":total,"left":left,"id":id},function(data){
                   console.log(data);
                   var feedback=eval("("+data+")");
                   console.log(feedback);
                   $("#fee").val(feedback.totalprice);
                   $("#ys").text(feedback.totalprice);
                 //$('#zhekou').text(allzhekou); // 退菜不属于折扣
                 $('#'+divid).text('退');
                 swal({   title: "操作成功", type:'success',  timer: 500,   showConfirmButton: false });
                 window.location.reload();

             });
   //      function(){  // 直接退操作
   //          //post 操作  
   //          $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'tui'))?>",{"orderid":orderid,"goodsid":goodsid,"tablesid":tablesid,"price":price},function(data){
   //              console.log(data);
   //               var feedback=eval("("+data+")");
   //              $("#fee").val(feedback.totalprice);
   //              $("#ys").text(feedback.totalprice);
   //              $('#zhekou').text(allzhekou);
   //              $('#'+divid).text('退');
   //              swal({   title: "操作成功", type:'success',  timer: 500,   showConfirmButton: false });
   //          });
});
}) 
$('.song').click(function(){
    var zhekou = parseInt($('#zhekou').text());
    var fee = parseInt($('#fee').text());
    var orderid = $(this).attr('orderid');
    var id = $(this).attr('id');
    var goodsid = $(this).attr('goodsid');
    var price = parseInt($(this).attr('price'));
    var allzhekou =zhekou+price;
    var divid ="divid"+goodsid;
    swal({   title: " 确定要送菜吗",  
       type: "success", 
       confirmButtonText: "确定",
       cancelButtonText: "取消",
       showCancelButton: true,   closeOnConfirm: false,   
       showLoaderOnConfirm: true, }, function(){  
             //post 操作  
             $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'song'))?>",{"orderid":orderid,"goodsid":goodsid,"price":price,"id":id},function(data){
               console.log(data);
               var feedback=eval("("+data+")");
               $("#fee").val(feedback.totalprice);
               $("#ys").text(feedback.totalprice);
               $('#zhekou').text(allzhekou);
               $('#'+divid).text('送');
               swal({   title: "操作成功", type:'success',  timer: 500,   showConfirmButton: false });
               window.location.reload();
           });
         });
}) 
$('.shang').click(function(){
    console.log('dd');
    var id = $(this).attr('id');
    swal({   title: " 确定已上桌吗",  
       type: "success", 
       confirmButtonText: "确定",
       cancelButtonText: "取消",
       showCancelButton: true,   closeOnConfirm: false,   
       showLoaderOnConfirm: true, }, function(){  
             //post 操作  
             $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'shang'))?>",{"id":id},function(data){
               console.log(data);
               var feedback=eval("("+data+")");
               swal({   title: "操作成功", type:'success',  timer: 2000,   showConfirmButton: false });
               window.location.reload();
           });
         });
}) 
</script>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>总金额</td>
    <td><?php  echo $xiaofei['ys'];?> 元</td>
    <td></td>
</tr>
<!-- 未确认订单16.12.5 --> 
<?php  if($orders['id']!="") { ?>                             
<?php  if(is_array($orders_goods)) { foreach($orders_goods as $items) { ?>
<tr class="danger">

    <th scope="row"><?php  echo $i?></th>
    <th> <?php  echo $items['title'];?>   <?php  echo $items['flavor'];?> </th>
    <td> <?php  echo $items['total'];?></td>
    <td><?php  echo $items['price'];?></td>
    <td><?php  echo round($items['ttprice'],2);?></td>
    <td> </td>
</tr>
<?php  $i++?>
<?php  } } ?>
<tr class="danger">
    <td></td>
    <td></td>
    <td></td>
    <td>总金额</td>
    <td><?php  echo $addprice;?> 元</td>
    <td></td>
</tr>
<?php  } ?>
<!-- 未确认订单结束 -->
</tbody>

</table>
</div>
</div>

<div class="panel panel-success hidden">
    <div class="panel-heading">消费记录(最近10条记录)</div>
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>消费方式</th>
                    <th>金额</th>
                    <th>优惠金额</th>
                    <th>实际支付</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody id="j_getrecord">
            </tbody>
        </table>
    </div>
</div>



</div>
<div class="<?php  echo $ischeng;?>  col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">优惠活动</div>
        <div class="">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>营销对象</th>
                        <th>优惠</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>代金券</td>
                        <td>
                            <select class="form-control" id="daijin" name="daijin">
                                <?php  if(is_array($daijin)) { foreach($daijin as $row) { ?>
                                <option value="<?php  echo $row['daijin'];?>"><?php  echo $row['title'];?></option>
                                <?php  } } ?>
                            </select>

                        </td>
                        <td>
                            <div class="input-group" style="width:100px">
                                <input class="form-control num" id="daijinnum" size="1" type="number" placeholder="输入数量" value="1">
                                <div class="input-group-addon">张</div>
                            </div>
                        </td>
                        <td>
                          <a class="btn btn-success" id="daijinbtn" href="#">使用</a>
                      </td>
                  </tr>
                  <script>
//代金券功能
$('#daijinbtn').click(function(){
 var jine = parseInt($('#daijin option:selected').val());//金额
 var num = parseInt($('#daijinnum').val());//数量
 var all = parseInt(jine*num);
 // var kdz = parseInt($('#kdz').text());
 var kdz = parseInt($('#kdz').text())-parseInt($('#daijinquan').text())-parseInt($('#mian').text())-parseInt($('#dz').text())-parseInt($('#mj').text());//可打折2016.10.28
 console.log('可打折还有'+kdz);
 var bkdz = parseInt($('#bkdz').text());
 var daijinquan = parseInt($('#daijinquan').text());
 var manjian = parseInt($('#mj').text());
 var ys = kdz-all+bkdz;// 应收 = 可打折 - 满减 - （this）+ 不可打折
 var jiae = kdz-all+bkdz;// 应收 = 可打折 - x(不应)满减 - （this）+ 不可打折
 var fee =  parseInt($('#fee').val());
  //alert(kdz+'--'+manjian+' -- 代金'+all+' +不可'+bkdz);
    <?php  if($typeid['typeid'] ==1) { ?>
         if(ys < bkdz){                                             
     <?php  } ?>
     <?php  if($typeid['typeid'] ==3) { ?>
        if(fee < all){                                             
     <?php  } ?>
   swal({   title: "金额不足", type:'error',  text: "无法使用",   timer: 500,   showConfirmButton: false });
}else{
     // $('#kdz').text(kdz-all);// 多次使用不同面额代金券2016.10.28注释
     $('#daijinquan').text(daijinquan+all);
     swal({   title: "使用成功", type:'success',  text: "使用了"+num+"张"+jine+"的代金券！",   timer: 500,   showConfirmButton: false });
     $('#ds,#ys').text(ys);
     var zhekou = parseInt($('#daijinquan').text())+parseInt($('#mj').text())+parseInt($('#mian').text())+parseInt($('#dz').text());//总折总2016.10.28
     // var zhekou = parseInt($('#daijinquan').text())+parseInt($('#mj').text());// 总折总
     $('#zhekou').text(zhekou);
     $('#fee').val(ys);
 }
}) 
</script>
<tr>
    <td>2</td>
    <td>满减活动</td>
    <td colspan="2">
        <?php  if(is_array($manjian)) { foreach($manjian as $row) { ?>
        <a class="btn btn-info manjian " man="<?php  echo $row['title'];?>" jian="<?php  echo $row['manjian'];?>" href="#">满<?php  echo $row['title'];?>减<?php  echo $row['manjian'];?>元</a>
        <?php  } } ?>
    </td>
    <td><a class="btn btn-warning  " onClick="checkMdan()" href="#">免单</a></td>
</tr>
<script>
//只能用一次
$('a.manjian').click(function(){
  var man = parseInt($(this).attr('man'));
  var jian = parseInt($(this).attr('jian'));

  var fee = parseInt($('#fee').val());
 //var kdz = parseInt($('#kdz').text());
 var daijinquan = parseInt($('#daijinquan').text());
 // var kdz=parseInt('<?php  echo $kedazhe;?>'); // 可折金额
 var kdz = parseInt($('#kdz').text())-parseInt($('#daijinquan').text())-parseInt($('#mian').text())-parseInt($('#dz').text())-parseInt($('#mj').text());//可打折2016.10.28
 var bkdz = parseInt($('#bkdz').text());
 // var isman = kdz-man-daijinquan;//是否符合条件
 var isman = kdz-man;//是否符合条件2016.10.28
  //alert(isman);
// var manjian = parseInt(kdz-daijinquan);//2016.10.28
var manjian = parseInt(kdz);
if(isman< 0){
   swal({   title: "金额不足", type:'error',  text: "无法使用",   timer: 500,   showConfirmButton: false });
}else{
 var all = parseInt(parseInt(manjian/man)*jian);//计算可减金额
 var ys = manjian-all+bkdz;
     // $('#kdz').text(kdz-all-daijinquan);// 多次使用不同面额代金券
     $('#mj').text(all);
     var zhekou = parseInt($('#daijinquan').text())+parseInt($('#mj').text())+parseInt($('#mian').text())+parseInt($('#dz').text());//总折总2016.10.28
     // var zhekou = parseInt($('#daijinquan').text())+parseInt($('#mj').text());// 总折总
     $('#zhekou').text(zhekou);
     $('#ds').text(ys);
     $('#ys').text(ys);
     $('#fee').val(ys);
     swal({   title: "使用成功", type:'success',  text: "满"+man+"减"+jian+"元！",   timer: 500,   showConfirmButton: false });
 }
}) 

</script>
</tbody>
</table>
</div>
</div>
<!-- 添加支付方式 -->
<div class="panel panel-warning">
    <div class="panel-heading">添加收银方式</div>
    <div class="">
        <table class="table table-hover">
            <tr>
                <th style="line-height: 40px;text-align: center; width: 18%">收银方式</th>
                <td>
                    <select class="form-control" id="addpay" name="addpay">   
                        <option value="1">微信</option>
                        <option value="2">支付宝</option>
                        <option value="3">现金</option>
                        <option value="4">刷卡</option>   
                    </select> 
                </td>
                <td>
                    <div class="input-group" style="width:100px">
                        <input class="form-control num" id="addpaynum" size="2" type="text" placeholder="输入金额" value="">
                        <div class="input-group-addon">元</div>
                    </div>
                </td>
                <td>
                  <a class="btn btn-success" id="addpaybtn" href="#">添加</a>
              </td>
          </tr>

      </table>
  </div>
</div>
<script type="text/javascript">
$('#addpaybtn').click(function(){
    var addpayname= $('#addpay option:selected').text();
                             var addpaytype= parseInt($('#addpay option:selected').val());//添加方式
                             var addpaynum = $('#addpaynum').val();//金额
                             var fee = parseInt($('#fee').val());//付款金额
                             // console.log(addpayname);
                             // console.log(addpaynum);
                             var reduce = fee-addpaynum;
                             if(reduce<0){
                                swal({   title: "金额大于订单总额", type:'error',  text: "请重新确认",   timer: 500,   showConfirmButton: false });
                            }
                            $('#fee').val(reduce);
                            $('#ds').text(reduce);
                            $('#addname').text(addpayname+'：');
                            $('#addnum').text(addpaynum);
                            $('#addtype').val(addpaytype);
                            swal({   title: "添加支付成功", type:'success',  text: addpayname+"支付"+addpaynum+"元！",   timer: 500,   showConfirmButton: false });

                        });
</script>
<!-- 添加支付方式end -->
<div class="panel panel-warning">
    <div class="panel-heading">
        <div class="input-group"> 
            <span class="input-group-addon" id="sizing-addon2">￥</span>
            <input type="text" name="fee" id="fee" value="<?php  if($xiaofei['ys']!='') { ?><?php  echo $xiaofei['ys'];?><?php  } else { ?>0<?php  } ?>" maxlength="8" class="form-control" style="line-height:60px; height:60px; font-size:40px; padding-top:10px; text-align:right" readonly/>
            <span class="input-group-addon" id="sizing-addon2">元</span> </div>
            <table class="table table-condensed">
                <tr>
                    <td>消费： 
                        <span id="xf"><?php  if($xiaofei["total0"]!="") { ?><?php  echo $xiaofei["total0"];?><?php  } else { ?>0.00<?php  } ?></span> 元 </td>
                        <td>总折扣： 
                            <span id="zhekou"><?php  if($xiaofei["song"]!="") { ?><?php  echo $xiaofei["song"];?><?php  } else { ?>0.00<?php  } ?></span> 元  </td>
                            <td>应收：
                                <span id="ys"><?php  if($xiaofei["ys"]!="") { ?><?php  echo $xiaofei["ys"];?><?php  } else { ?>0.00<?php  } ?></span> 元  </td>
                            </tr>
                            <tr>
                                <td>低消差：  
                                    <span id="dxc"><?php  if($dixiao!="") { ?><?php  echo $dixiao;?><?php  } else { ?>0.00<?php  } ?></span> 元  </td>
                                    <td>不可打折： 
                                        <span id="bkdz"><?php  if($buzhekou['price'] !="") { ?><?php  echo $buzhekou['price'];?><?php  } else { ?>0.00<?php  } ?></span> 元  </td>
                                        <td>可打折：  
                                            <span id="kdz"><?php  if($kedazhe!="") { ?><?php  echo $kedazhe;?><?php  } else { ?>0.00<?php  } ?></span> 元  </td>
                                        </tr>
                                        <tr>
                                            <td>代金券： 
                                                <span id="daijinquan">0.00</span> 元  </td>
                                                <td>满减： 
                                                    <span id="mj">0.00</span> 元  </td>
                                                    <td>免单： 
                                                        <span id="mian">0.00</span>元  </td>
                                                    </tr>

                                                    <tr class="danger">
                                                        <td>活动打折： 
                                                            <span id="dz">0.00</span> 元  </td>
                                                            <td>待收： 
                                                                <span id="ds"><?php  echo $xiaofei["ys"];?></span>元  </td>
                                                                <td><span id="addname">合并支付：</span><span id="addnum">0.00</span> 元</psan><input type="hidden" name="addtype" id="addtype"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="panel-body hidden" id="j_counter_btn">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="button" value="7" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="8" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="9" class="btn btn-info btn-block"/>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="button" value="4" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="5" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="6" class="btn btn-info btn-block"/>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="button" value="1" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="2" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="3" class="btn btn-info btn-block"/>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <input type="button" value="0" class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="." class="btn btn-info btn-block"/>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="button" value="清除" class="btn btn-block btn-danger"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-footer">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-info btn-block btn_sumitcss" onClick="checkCard()"><i class=""></i> 打折</button>
                                                                <!-- <button type="button" class="btn btn-info <?php  if($kedazhe<50) { ?>disabled<?php  } ?> btn-block btn_sumitcss" onClick="checkCard()"><i class=""></i> 打折</button> -->
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button type="button" id="paybtn" class="btn btn-success btn-block btn_sumitcss" onClick="payMobile()"><i class=""></i> 收款</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-info hidden">
                                                    <div class="panel-heading">当前营销内容</div>
                                                    <div class="">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>名称</th>
                                                                    <th>营销对象</th>
                                                                    <th>优惠</th>
                                                                    <th>效果</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php  $i=1;?>
                                                                <?php  if(is_array($marketing)) { foreach($marketing as $row) { ?>
                                                                <tr>
                                                                    <th scope="row"><?php  echo $i?></th>
                                                                    <th><?php  echo $row['title'];?></th>
                                                                    <td> <?php  if($row['num']) { ?>
                                                                        <?php  if($row['isallnum']) { ?>
                                                                        <b style="color:#F00"><?php  echo $row['num'];?></b>名
                                                                        <?php  } else { ?>
                                                                        每天前<b style="color:#F00"><?php  echo $row['num'];?></b>名
                                                                        <?php  } ?>
                                                                        <?php  } ?>
                                                                        <?php  if($row['condition']==1) { ?>
                                                                        所有人
                                                                        <?php  } else if($row['condition']==2) { ?>
                                                                        $grouplist= @pdo_fetchall("SELECT title FROM ".tablename("mc_groups")." WHERE groupid in(".$row['condition_member'].") ORDER BY `orderlist` asc");
                                                                        <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
                                                                        <?php  echo $row['title'];?>,
                                                                        <?php  } } ?>
                                                                        <?php  } else if($row['condition']==3) { ?>
                                                                        首次使用微支付
                                                                        <?php  } else if($row['condition']==4) { ?>
                                                                        首次关注公众号
                                                                        <?php  } else if($row['condition']==5) { ?>
                                                                        关注公众号时长<?php  echo $row['condition_attendtime'];?>天
                                                                        <?php  } ?> </td>
                                                                        <td><?php  echo $row['description'];?></td>
                                                                        <td><?php  echo pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE marketing=:a and status=1 and createdate=:b ",array(':a'=>$row['id'],':b'=>date('Y-m-d')))?>/<?php  echo pdo_fetchcolumn("SELECT count(*) FROM ".tablename('j_money_trade')." WHERE marketing=:a and status=1  ",array(':a'=>$row['id']))?></td>
                                                                    </tr>
                                                                    <?php  $i++?>
                                                                    <?php  } } ?>
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div  id="a1" style="display:<?php  if($tablesid=='' ) { ?>block<?php  } else { ?>none<?php  } ?>">
                                            <!-- 餐桌管理 -->
                                            <style>.table-item{margin:5px 2px;height:110px;min-width: 105px}
                                            .table-item a{color:#fff;}</style>
                                            <br>
                                            <div class="col-xs-12">
                                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <?php  if($item['status']==0) { ?>
                                                <?php  $status = 'success';?>
                                                <?php  $title = '空闲';?>
                                                <?php  $kaitai = 'kaitai';?>
                                                <?php  } else if($item['status']==1) { ?>
                                                <?php  $status = 'danger';?>
                                                <?php  $title = '开台';?>
                                                    <?php  if($item['dian']) { ?>
                                                        <?php  //$status = 'info';?>
                                                    <?php  } ?> 
                                                    <?php  if($item['yu']) { ?>
                                                        <?php  $status = 'warning';?>
                                                    <?php  } ?>
                                                <?php  } ?>
                                                <?php  if($item['status']==0) { ?>
                                                <div class="col-xs-1 kaitai img-thumbnail btn btn-<?php  echo $status;?> table-item " tablesid="<?php  echo $item['id'];?>" order="-1">
                                                    <div class="<?php  echo $status;?> round">
                                                      <h4> <?php  echo $item['zone'];?>-<?php  echo $item['title'];?> </h4>
                                                        <div class="state">
                                                        <?php  echo $title;?>
                                                     <a class="btn btn-success btn-block" >点击开台</a>
                                                    </div>  
                                                     </div>
                                                     <?php  } else { ?>
                                                     <div class="col-xs-1 img-thumbnail btn btn-<?php  echo $status;?> table-item " tablesid="<?php  echo $item['id'];?>"   order="<?php  echo $item['order']['id'];?>">
                                                       <a class="<?php  echo $status;?> round" href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money&tablesid=<?php  echo $item['id'];?>">
                                                        <h4><?php  echo $item['zone'];?>-<?php  echo $item['title'];?></h4>
                                                        <div class="state">
                                                            <!-- <?php  echo round($item['totalprice'])?>元 -->
                                                            <?php  echo round($item['price']['total'])?>元
                                                            <br>
                                                            <?php  echo date('H:i',$item['order']['dateline'])?>
                                                            <?php  echo $title;?>
                                                            <br>
                                                            <?php  if($item['dian']) { ?>
                                                            <i class="dian fa fa-check-square"></i>
                                                            <?php  } ?>
                                                            <?php  if($item['yu']) { ?>
                                                            <i class="yu fa fa-list"></i>
                                                            <?php  } ?>
                                                        </div>  
                                                    </a>
                                                    <?php  } ?>
                                                </div>
                                                <?php  } } ?>
                                            </div>
                                        </div>
                                        <iframe src="" id="printbox" name="printbox" style="width:0px; height:0px; border: 0;"></iframe>
                                    </div>
                                </div>
                                <div class="extend_box" id="extend_box">
                                    <div class="extend_innerbox">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"> <span class="pull-right"><a href="javascript:extendFun(0);"><i class="fa fa-times"></i></a></span><b>弹出</b> </div>
                                            <div class="panel-body table-responsive" style="min-height:500px; overflow-y:scroll"> </div>
                                            <div class="panel-footer" style="text-align:center;"> </div>
                                        </div>
                                    </div>
                                </div>
                                <textarea id="debug" style="display:none;"></textarea>
                                <input type="hidden" id="tradeno" />
                                <script type="text/javascript">

//开台
$('#a1').on('click','.kaitai',function(){
    console.log(<?php  echo $storeid;?>);
    var tablesid = $(this).attr('tablesid');
    var btns = '';
    btns += '<div class="row">';
    for(var i=1;i<=20;i++){
        btns += '<div class="col-xs-3"  style="margin:2px 0;"> <a type="a" class="btn btn-info btn-lg btn-block" onclick=settaste("'+i+'")>'+i+'人</a></div>';
    }
    btns += ' </div> ';
    swal({
        title: "选择开台人数",
        text: btns,   
        type: "input",
        html:true,
        showLoaderOnConfirm: true,
        showCancelButton: true,   
        closeOnConfirm: false,
        confirmButtonText: "开台",
        cancelButtonText: "取消",  
        inputPlaceholder: "选择开台人数" 
    }, function(inputValue){
        if (inputValue === false) return false;      
        if (inputValue === "") {
            swal.showInputError("选择开台人数");     
            return false
        }
        $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'kaitai'))?>",{"tablesid":tablesid,"people":inputValue},function(data){
           console.log(data);
           var feedback=eval("("+data+")");
           swal({   title: "开台成功！", type:'success',  timer: 500,   showConfirmButton: false });
                   // window.location.reload();
                   var url ="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money&tablesid="+tablesid;
                   window.location.href=url;
               });
    });
});
    //全桌转台17.4.9
    $('.changetable').click(function(){
        var tablesid = $(this).attr('tablesid');
        var orderid = $(this).attr('orderid');
        var btns = '';
        btns += '<div class="row">';
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        if (<?php  echo $item['status'];?>==0){
            btns += '<div class="col-xs-2" style="margin:5px 0;"> <a type="a" class="btn btn-info btn-lg  btn-block" onclick=settaste("<?php  echo $item["id"];?>")><?php  echo $item["zone"];?>-<?php  echo $item["title"];?></a></div>';
        }
        <?php  } } ?>
        btns += ' </div> ';
        swal({// 转台 17.2.27 
            title: "转台",
            text: btns,   
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认",
            cancelButtonText: "关闭",  
            inputPlaceholder: "请选择目标桌" 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请选择目标桌");     
                return false
            }
            $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'changetable'))?>",{"tablesid":tablesid,"orderid":orderid,"tableTo":inputValue},function(data){
                  swal({   title: "操作成功了！", type:'success',  timer: 500,   showConfirmButton: false });
                   // window.location.reload();
                  var url="index.php?i=<?php  echo $weid;?>&c=entry&op=in&do=index&m=j_money&tablesid="+inputValue;
                  console.log(url);
                  window.location.href =  url;
               });
        });
});
    //并台17.3.3
    $('.andtable').click(function(){
        var tablesid = $(this).attr('tablesid');
        var orderid = $(this).attr('orderid');
        var btns = '';
        btns += '<div class="row">';
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        if (<?php  echo $item['status'];?>==1 && <?php  echo $item['id'];?>!=tablesid){
            btns += '<div class="col-xs-2" style="margin:2px 0;"> <a type="a" class="btn btn-info btn-lg  btn-block" onclick=settaste("<?php  echo $item["order"]["id"];?>") tablesid=<?php  echo $item["id"];?> orderid=<?php  echo $item["order"]["id"];?> ><?php  echo $item["zone"];?>-<?php  echo $item["title"];?> </a></div>';
        }
        <?php  } } ?>
        btns += ' </div> ';
        swal({
            title: "并台",
            text: btns,   
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认",
            cancelButtonText: "关闭",  
            inputPlaceholder: "请选择做法" 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请选择目标桌");     
                return false
            }
            $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'andtable'))?>",{"orderid":orderid,"tablesid":tablesid,"ToOrderid":inputValue},function(data){
              var feedback=eval("("+data+")");
                  // console.log(feedback.tables);
                  console.log(data.tables);
                  swal({   title: "操作成功！", type:'success',  timer: 500,   showConfirmButton: false });
                  window.location.href="index.php?i=<?php  echo $weid;?>&c=entry&op=in&do=index&m=j_money";
              });
        });
});
</script>

<script>
// 虚拟键盘
$('.num')
.keyboard({
  layout : 'num',
		restrictInput : true, // Prevent keys not in the displayed keyboard from being typed in
		preventPaste : true,  // prevent ctrl-v and right click
		autoAccept : true
	});
</script>
<script>
var keyCodeAry1=[96,97,98,99,100,101,102,103,104,105,110];
var keyCodeAry2=["0","1","2","3","4","5","6","7","8","9","."];
var keyCodeAry=[];
var old_orderid='';
var isPaying=false;
var printDoc=parseInt("<?php  echo $printDoc;?>");
var needtable=parseInt("<?php  echo $cfg['needtable']?>");
var printDoc2=parseInt("<?php  echo $printDoc2;?>");
for(i=0;i<keyCodeAry1.length;i++){
    keyCodeAry[keyCodeAry1[i]]=keyCodeAry2[i];
}
var checkTimeout;
$(document).ready(function(e){
    if($(document).width()<1100){
        //location.href='<?php  echo $this->createMobileUrl(index,array("small"=>1,"op"=>"login"))?>';
    }
    var _dh=$(document).height()>=$(window).height() ? $(document).height():$(window).height();
    var _wh=$(window).height();
    _h=_wh>=_dh ? _wh :_dh;
    $(".body_left").css('height',(_h-50)+"px");
    $("#tableslist").css('height',(_h-50)+"px");
    getCounterRecord();
});
function logout(){
    swal({
      title: "确认退出登录？",
  // text: "Your will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "确定",
  cancelButtonText: "取消",
  closeOnConfirm: false
},
function(){
  location.href="<?php  echo $this->createMobileUrl('index')?>";
});

}
//---计算器---//
$(document).keydown(function (event) {
    //alert(event.keyCode);
//    switch(event.keyCode){
//        case 96 : case 97 : case 98 : case 99 : case 100 : case 101 : case 102 : case 103 : case 104 : case 105 : case 110 :
//            if(isPaying)return;
//        Counter(keyCodeAry[event.keyCode]);
//        //$("#paybtn").focus();
//        break;
//        case 81://q
//            case 109://-
//            if(isPaying==false){
//            checkCard();
//        }
//        break;
//        case 111://0
//            refundorder();
//        break;
//
//        case 27://0
//            $("#fee").val(0);
//        break;
//    }
});
function Counter(obj){
    var vTecla=obj;
    var salida=$("#fee");
    if(salida.val().length>8 && vTecla!='清除'){
        return false;	
    }
    if(vTecla=='.'){
        if(salida.val().indexOf('.')>-1){
            salida.val(salida.val());
        }else{
            salida.val(salida.val()+vTecla);
        }
    }else if(vTecla=='清除'){
        salida.val(0);
    }else if(vTecla=='0'){
        if(salida.val()==0 && salida.val().length==1){
            salida.val(0);
        }else{
            salida.val(salida.val()+vTecla);
        }
    }else{
        if((salida.val()==0 && salida.val().length==1)){
            salida.val(vTecla);
        }else{
            salida.val(salida.val()+vTecla);
        } 
    }
    var temp=salida.val();
    if(temp.indexOf('.')>-1){
        var float=temp.split('.');
        if(float[1].length>2){
            salida.val(float[0]+'.'+float[1].substr(0,2));
        }
    }
}
$("#j_counter_btn input").on('click',function(){
 //   var vTecla=$(this).val();
 //   Counter(vTecla);
});

//手动输入金额免单2016.10.27
function checkMdan(){
    var temp=parseFloat($("#fee").val());
    var xf=parseFloat($("#xf").html());
    if(temp*100==0){
        if(xf*100==0){
           swal("请输入金额");
           return; 
       }     
   }
   var btns = '';
        swal({// 用户手动输入免单金额   16.10.27  
            title: "免单",   
            text: "收款金额为<span style='color:#F00'>￥"+temp+"元</span><br> "+btns,   
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认",
            cancelButtonText: "关闭",  
            inputPlaceholder: "10元以下"//请输入免单金额 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请输入免单金额");     
                return false
            }
            var mian=parseFloat(inputValue);//免单金额
            var zhekou=parseFloat($("#zhekou").html());
            var kdz=parseFloat($("#kdz").html());
            var bkdz=parseFloat($("#bkdz").html());
            //限制金额10元17.2.27
            <?php  if($typeid['typeid']==1) { ?>
            max =10;
            <?php  } ?>
            <?php  if($typeid['typeid']==3) { ?>
            max =18;
            <?php  } ?>
            if(mian > max){//原价： temp 金额不足
             swal({   title: "免单仅可低于10元!", type:'error',  timer: 1000,   showConfirmButton: false });
         }else{
          var price = temp-mian;
          zhekou = zhekou+mian;
          $("#zhekou").html(zhekou);
          if(kdz-mian>0){
// $("#kdz").html(kdz-mian);
$("#kdz").html(kdz);//可打折2016.10.28
}else{
    $("#kdz").html('0.00');
    $("#bkdz").html(price);
}
$("#fee").val(price);
$("#mian").html(mian);
$("#ds,#ys").html(price);
swal({   title: "操作成功", type:'success',  timer: 500,   showConfirmButton: false });

}
});
}

function payMobile(){
    isPaying=false;
    var temp=parseFloat($("#fee").val());
    var xf=parseFloat($("#xf").html());
    var temporder=$("#orderid").val();
    // alert(temporder);
    if(temporder==-1){
        alert("订单号不能为空");
        return;
    }
    // if(temp*100==0){
    //     if(xf*100==0){
//             swal("请输入金额");
//           return; 
    //     }     
    // }
    if(needtable){
        if(isPaying)return;
        isPaying=true;
        var tablenum='';
        swal({ 
            title: "请输入原订单号/台号", 
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认",
            cancelButtonText: "关闭",
            inputPlaceholder: "可扫描或者手动输入" 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请输入原订单号/台号");     
                return false
            }
            tablenum=inputValue;
            swal({ 
                title: "客户买单",   
                text: "<h3>收款金额为<span style='color:#F00'>￥"+temp+"元</span></h3>",   
                type: "input",
                html:true,
                showLoaderOnConfirm: true,
                showCancelButton: true,   
                closeOnConfirm: false,
                confirmButtonText: "确认收款",
                cancelButtonText: "关闭",  
                inputPlaceholder: "请扫描客户的付款二维码" 
            }, function(inputValue){
                if (inputValue === false) return false;      
                if (inputValue === "") {
                    swal.showInputError("请扫描客户的付款二维码");     
                    return false
                }
                swal({title:"请稍后",showConfirmButton:false });
                if(inputValue.substr(0,1)=="1"){
                    console.log("客户使用【微信】支付");
                    paywechat(inputValue,temp,tablenum);
                }else{
                    console.log("客户使用【支付宝】支付");
                    payali(inputValue,temp,tablenum);
                }
            });
}
);
}else{
    var btns = '';
    btns += '<div class="row">';
    btns += '<div class="col-xs-4"> <a type="a" class="btn btn-type btn-success" onclick="paytype(0)">微信</div></a>';
    btns += '<div class="col-xs-4">  <a type="a" class="btn btn-type  btn-info" onclick="paytype(1)">支付宝</div></a>';
    btns += '<div class="col-xs-4">  <a type="a" class="btn  btn-type btn-warning" onclick="paytype(2)">美团</div></a>';
    btns += '<div class="col-xs-4">  <a type="a" class="btn  btn-type btn-warning" onclick="paytype(5)">美团闪惠</div></a>';
    btns += '<div class="col-xs-4"> <a type="a" class="btn btn-type  btn-success" onclick="paytype(3)">现金</div></a>';
    btns += '<div class="col-xs-4"> <a type="a" class="btn  btn-type btn-info" onclick="paytype(4)">刷卡</div></a>';
    btns += '     <br><br/><br/>   </div> ';
        swal({// 用户支付   16.9.14  
            title: "<?php  echo $tableinfo['zone'];?>--<?php  echo $tableinfo['id'];?> 客户买单",   
            text: "<h3>收款金额为<span style='color:#F00'>￥"+temp+"元</span>            <br>            收款方式 :<span id='paytype' style='color:#f00'></span></h3> <br> "+btns,   
            type: "input",
            html:true,
            showLoaderOnConfirm: true,
            showCancelButton: true,   
            closeOnConfirm: false,
            confirmButtonText: "确认收款",
            cancelButtonText: "关闭",  
            inputPlaceholder: "请选择收银方式" 
        }, function(inputValue){
            if (inputValue === false) return false;      
            if (inputValue === "") {
                swal.showInputError("请选择收银方式");     
                return false
            }
            if(isPaying)return;
            isPaying=true;
            swal({title:"请稍后",showConfirmButton:false });
            //增加 莫 9.14 
            console.log("客户支付");
            ispay(inputValue,temp,'');//用户支付 9.14
        });
}
}
function paytype(i){
    var str ="现金";
    var temp=parseFloat($("#fee").val());
    if(i==2){
        str ="美团";
    }
    if(i==0){
        str ="微信支付";
    }if(i==1){
        str ="支付宝支付";
    }if(i==5){
        str ="美团闪惠";
        swal({   
            title: "美团闪惠",
            text: "实收金额：<input type=text class='' id='payno' name='payno' value=''> 凭证单号：",
            type: "input",
            html:true,
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "确认收款",
            cancelButtonText: "关闭",  
            inputPlaceholder: "凭证号：" },
            function(inputValue){   
                if (inputValue === false) return false;
                if (inputValue === "") {     
                    swal.showInputError("请输入实收金额!");
                    return false   }  
                    var payno =  $("[tabindex='3']").val();//取得凭证单号
                    ispay(5,inputValue,payno);//美团支付
                });
    }if(i==3){
        str ="现金支付";
    }if(i==4){
        str ="刷卡支付";
    }
    $("#paytype").html(str);
    $("#payno").val(temp);
    $("[tabindex='3']").val(i);//取得授权密码
}

//付款
function ispay(paytype,fee,tableno){
    if(paytype.length==0){
        swal("请选择收银方式！");
        return;
    }
    var zhekou = $('#zhekou').text();//总折扣
//2016-11-22 添加以下
    var kdz = parseInt($('#kdz').text());//可打折金额
    var bkdz = parseInt($('#bkdz').text());
    var daijinquan =parseInt($('#daijinquan').text());
    var mian =parseInt($('#mian').text());
    var mj= parseInt($('#mj').text());//满减
    var dz =parseInt($('#dz').text());//打折减去的
    // 2017-1-11 添加
    var addtype = $('#addtype').val();//合并付款方式
    var addnum = $('#addnum').text();//合并付款金额
    // 2017-1-11 end
    
    //var ys= parseInt($('#ys').text());
 //   alert(tableno);
 //   return false;
 $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'ispay'))?>",{"paytype":paytype,"userid":"<?php  echo $user['id'];?>","fee":fee,"zhekou":zhekou,"old_trade_no":tableno,"totalfee":"<?php  echo $xiaofei['total0'];?>","orderid":"<?php  echo $orderid;?>","tablesid":"<?php  echo $tablesid;?>","discount":discount1,"kdz":kdz,"bkdz":bkdz,"daijinquan":daijinquan,"mian":mian,"mj":mj,"dz":dz,"addtype":addtype,"addnum":addnum},function(data){
    isPaying=false;
    var feedback=eval("("+data+")");
    checktime=0;
    console.log(feedback.success);
    if(feedback.success){
        var temp=feedback.items;
        $("#tradeno").val(temp['out_trade_no']);
        if(temp['result_code']=="SUCCESS"){
            paySuccess(temp['out_trade_no']);

        }else{
            if(temp['err_code']=="USERPAYING"){
                setTimeout("checkpay()",5000);
                swal({
                    title: "温馨提示",   
                    text: "等待客户输入支付密码",
                    confirmButtonText: "关闭订单",
                }, function(isConfirm){
                    if (isConfirm) {
                        deleteOrder(temp['out_trade_no']);
                    }
                }
                );
            }
        }
    }else{
        swal(feedback.msg);
    }
})
}
function paywechat(qrcode,fee,tableno){
    if(qrcode.length==0){
        swal("请先扫描");
        return;
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'paywechat'))?>",{"qrcode":qrcode,"userid":"<?php  echo $user['id'];?>","fee":fee,"old_trade_no":tableno},function(data){
        isPaying=false;
        //alert(data);
        //$("#debug").val(data);
        var feedback=eval("("+data+")");
        checktime=0;
        if(feedback.success){
            var temp=feedback.items;
            $("#tradeno").val(temp['out_trade_no']);
            if(temp['result_code']=="SUCCESS"){
                paySuccess(temp['out_trade_no']);
            }else{
                if(temp['err_code']=="USERPAYING"){
                    setTimeout("checkpay()",5000);
                    swal({
                        title: "温馨提示",   
                        text: "等待客户输入支付密码",
                        confirmButtonText: "关闭订单",
                    }, function(isConfirm){
                        if (isConfirm) {
                            deleteOrder(temp['out_trade_no']);
                        }
                    }
                    );
                }
            }
        }else{
            swal(feedback.msg);
        }
    })
}
function payali(qrcode,fee,tableno){
    if(qrcode.length==0){
        swal("请先扫描");
        return;
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'payalipay'))?>",{"qrcode":qrcode,"userid":"<?php  echo $user['id'];?>","fee":fee,"old_trade_no":tableno},function(data){
        isPaying=false;
        console.log(data);
        //alert(data);
        var feedback=eval("("+data+")");
        checktime=0;
        if(feedback.success){
            if(feedback.result){
                $("#tradeno").val(feedback.out_trade_no);
                checkTimeout=setTimeout("checkAlipay()",5000);
                swal({
                    title: "温馨提示",   
                    text: "等待客户输入支付密码",
                    confirmButtonText: "关闭订单",
                }, function(isConfirm){
                    if (isConfirm) {
                        clearTimeout(checkTimeout);
                        //deleteOrder(temp['out_trade_no']);
                    }
                }
                );
            }else{
                var temp=feedback.items;
                $("#tradeno").val(temp['out_trade_no']);
                paySuccess(temp['out_trade_no']);
            }
        }else{
            swal(feedback.msg);
        }
    })
}
//支付成功；
function paySuccess(order){
    $("#tradeno").val('');
    $("#fee").val(0);
    var printNum=parseInt("<?php  echo $cfg['printnum'];?>") ? parseInt("<?php  echo $cfg['printnum'];?>") :0;
    if(printNum>1){
        swal({title:"收款成功"},
           function(){  

              var url ="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&orderid=<?php  echo $orderid;?>&comment=&do=print&m=j_money";
              console.log(url);

window.open (url, "printbox", ""); //先打印
window.location.href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money";}
);

    }else{

      var url ="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&orderid=<?php  echo $orderid;?>&comment=&do=print&m=j_money";
      console.log(url);
window.open (url, "printbox", ""); //先打印
c(1);
swal({title:"收款成功了",timer:500,},
   function(){  
    window.location.href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&op=in&do=index&m=j_money";}
    );
}
    //$("#micalc input[type='text']").val(0);
    if(printDoc && order && printNum){
        $("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer',array('id'=>$printDoc))?>&tradeid="+order);
        if(printNum>1){
            swal({
                title: "再打一张小票？",   
                showCancelButton: true,
                cancelButtonText: "取消",
                confirmButtonText: "打印",
            }, function(isConfirm){
                if (isConfirm) {
                    $("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer',array('id'=>$printDoc))?>&tradeid="+order);
                }
            }
            );
        }
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'marketing'))?>",{"orderid":order},function(data){
        console.log(data);
        $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'tempmsg'))?>",{"orderid":order},function(data2){
            console.log(data2);
        });
    });
    getCounterRecord();
}
function checkpay(){
    var temporder=$("#tradeno").val();
    if(!temporder){
        alert("订单号不能为空");
        return;
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'checwechatkpay'))?>",{"orderid":temporder},function(data){
        var feedback=eval("("+data+")");
        //$("#debug").val(data);
        if(feedback.success){
            var temp=feedback.items;
            if(temp['trade_state']=="SUCCESS"){
                paySuccess(temporder);
            }else if(temp['trade_state']=="NOTPAY"){
                swal("用户自动取消支付");
            }else if(temp['trade_state']=="USERPAYING"){
                setTimeout("checkpay()",5000);
            }else{
                swal("支付失败，未知错误!");
            }
        }else{
            swal(feedback.msg);
        }
    });
}

function checkAlipay(orderid){
    var temporder=orderid ? orderid : $("#tradeno").val();
    if(!temporder){
        alert("订单号不能为空");
        return;
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'checkalipay'))?>",{"orderid":temporder},function(data){
        console.log(data);
        //alert(data);
        var feedback=eval("("+data+")");
        checktime=0;
        if(feedback.success){
            if(feedback.result){
                $("#tradeno").val(feedback.out_trade_no);
                checkTimeout=setTimeout("checkAlipay()",5000);
                swal({
                    title: "温馨提示",   
                    text: "等待客户输入支付密码",
                    confirmButtonText: "关闭订单",
                }, function(isConfirm){
                    if (isConfirm) {
                        clearTimeout(checkTimeout);
                        //deleteOrder(temp['out_trade_no']);
                    }
                }
                );
            }else{
                var temp=feedback.items;
                $("#tradeno").val(temp['out_trade_no']);
                paySuccess(temp['out_trade_no']);
            }
        }else{
            swal(feedback.msg);
        }
    });
}
/*
 * 调取收银员的收银记录
 */
 function getCounterRecord(){
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'getcounterrecord'))?>",{},function(data){
        console.log(data);
        //alert(data);
        var feedback=eval("("+data+")");
        var record=feedback.item;
        $("#wechat_cash span").text("￥"+feedback.cash_fee_w);
        $("#ali_cash span").text("￥"+feedback.cash_fee_a);
        $("#wechat_card span").text(feedback.num);
        $("#j_getrecord").empty();
        for(i in record){
            var i = record[i]['paytype'];
            var str ="";
            if(i==0){
                str ="微信";
            }if(i==1){
                str ="支付宝";
            }if(i==2){
                str ="美团支付";
            }if(i==3){
                str ="现金";
            }if(i==4){
                str ="刷卡";
            }

            var temp='<tr><td scope="row">'+record[i]['createtime']+'</td><td>'+str+'</td><td>'+record[i]['total_fee']+'</td><td>'+record[i]['coupon_fee']+'</td><td>'+record[i]['cash_fee']+'</td><td>';
            temp+=parseInt(record[i]['status']) ? '<span class="label label-success"><i class="fa fa-check"></i></span>' : '<span class="label label-danger"><i class="fa fa-exclamation-triangle"></i></span>';
            if(parseInt(record[i]['status'])){
                temp+=parseInt(record[i]['isprint']) ? '' : ' <a href="javascript:reprint(\''+record[i]["out_trade_no"]+'\')"><i class="fa fa-print"></i></a>';
            }
            temp+='</td></tr>';
            $("#j_getrecord").append(temp);
        }
    });
}
function reprint(orderid){
    var temp=0;
    if(arguments.length>1)temp=arguments[1];
    if(printDoc && orderid){
        $("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer',array('id'=>$printDoc))?>&tradeid="+orderid+"&ismodal="+temp);
    }
}
//退款
function refundorder(){
    isPaying=true;
    swal({   
        title: "退款申请",   
        text: "请扫描或者输入客户的退款码",   
        type: "input",
        html:true,
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "确认退款",
        cancelButtonText: "关闭",  
        inputPlaceholder: "请扫描或者输入客户的退款码" 
    }, function(inputValue){
        if (inputValue === false)return false;
        if (inputValue === "") {
            swal.showInputError("请扫描或者输入客户的退款码");     
            return false
        }
        swal({title:"等待主管审核退款",showConfirmButton:false});
        $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'refundorder'))?>",{"orderid":inputValue},function(data){
            //$("#debug").val(data).show();
            if(data.success){
                setTimeout(function(){checkrefundorder(inputValue)},5000);
            }else{
                swal(data.msg);
            }
        },'json');
    }
    );
}

function checkrefundorder(orderid){
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'checkrefundorder'))?>",{"orderid":orderid},function(data){
        var feedback=eval("("+data+")");
        if(feedback.success){
            if(feedback.status==1){
                swal("退款成功");
            }else{
                setTimeout(function(){checkrefundorder(orderid)},5000);
            }
        }else{
            swal(feedback.msg);
        }
    });
}

//卡券核销
function checkCard(){
	var kdz = $('#kdz').text()-$('#mian').text()-$('#daijinquan').text()-$('#mj').text();
	if(kdz<0){
       swal("没有可打折金额");
       return; 
   }
   var cards = '';
   cards += '<div class="btn-group">';
   cards += ' <a type="a" class="btn btn-info" onclick="discount(10)">不打折</a>';
   <?php  if(is_array($discount)) { foreach($discount as $row) { ?>
   <?php  if($row['jdiction']==1) { ?>//只显示自已可打折的
     cards += ' <a type="a" class="btn btn-success" <?php  if($row['jdiction']==1) { ?> onclick="discount(<?php  echo $row['discount'];?>)"<?php  } else { ?>onclick="discount(<?php  echo $row['discount'];?><?php  echo $row['jdiction'];?>)"<?php  } ?>><?php  echo $row['discount'];?>折</a>';
     <?php  } ?>
   // cards += ' <a type="a" class="btn btn-success" <?php  if($row['jdiction']==1) { ?> onclick="discount(<?php  echo $row['discount'];?>)"<?php  } else { ?>onclick="discount(<?php  echo $row['discount'];?><?php  echo $row['jdiction'];?>)"<?php  } ?>><?php  echo $row['discount'];?>折</a>';
   <?php  } } ?>
    cards += '        </div> ';
    
    swal({   
        title: "活动打折",   
        text: "可打折金额："+kdz+"<br>折扣率：<span id='discount'></span><br>"+cards,   
        //text: "可打折金额：<?php  echo $kedazhe;?><br>折扣率：<span id='discount'></span><br>"+cards,   
        type: "input",
        html:true,
        showLoaderOnConfirm: true,
        showCancelButton: false,   
        closeOnConfirm: false,
        confirmButtonText: "确认打折",
        cancelButtonText: "关闭",  
        inputPlaceholder: "请选择折扣率" 
    }, function(inputValue){
        if (inputValue === false) return false;      
        if (inputValue === "") {
            swal.showInputError("请选择折扣率");
            return false
        }
        swal({   title: "折成功!", type:'success',  timer: 500,   showConfirmButton: false });
        swal(
            '折成功!',
            '打折成功.',
            'success'
            );
        // swal({title:"查询中",text: "计算折扣中",showConfirmButton: true});
        // $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'checkcard'))?>",{"code":inputValue},function(data){
        // 	console.log(data);
        // 	var temp=eval("("+data+")");

        // 	if(temp.success){
        // 		//cardConsume(temp.item);
        // 		var coupon=temp.item;
        // 		swal({
        // 			title: "卡券核销",
        // 			text: "卡券类型:"+coupon['typestr']+"<br>优惠:"+coupon['msg']+"<br>是否使用此卡券?",
        // 			html:true,
        // 			showLoaderOnConfirm: true,
        // 			showCancelButton: true,   
        // 			closeOnConfirm: false,
        // 			confirmButtonText: "确认核销",
        // 			cancelButtonText: "关闭",
        // 			}, function(isConfirm){
        // 				if (isConfirm) {
        // 					$.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'cardcheck'))?>",{"code":coupon['code']},function(data){
        // 						//$("#debug").val(data).show();
        // 						var temp=eval("("+data+")");
        // 						if(temp.success){
        // 							swal("核销成功");
        // 							if(printDoc2 && temp.item.id)$("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer',array('id'=>$printDoc2,'cid'=>1))?>&tradeid="+temp.item.id);
        // 						}else{
        // 							swal(temp.msg);
        // 						}
        // 					});
        // 				}
        // 		});
        // 	}else{
        // 		swal(temp.msg);
        // 	}
        // });
});
}
// 打折功能
var discount1=1;
function discount(i){
    var daijinquan = parseInt($('#daijinquan').text());
    var manjian = parseInt($('#mj').text());
    var mian = parseInt($('#mian').text());//免单金额
    var kedazhe = parseInt($('#kdz').text());
    // var total=kedazhe-daijinquan-manjian; // 不可折上折
    var total=kedazhe-daijinquan-manjian-mian;//折扣金额2016.10.28
    //var total=parseFloat($('#fee').val());
    var buzekou = parseInt($('#bkdz').text());
    //alert(total);
    var str ="折扣率";
    

    if(i==10){
        str ="不打折";
    }
    <?php  if(is_array($discount)) { foreach($discount as $rows) { ?>
    if(i==<?php  echo $rows['discount'];?>){//可打折
        str ="<?php  echo $rows['title'];?><?php  echo $rows['discount'];?>折";
    }
    if(i==<?php  echo $rows['discount'];?><?php  echo $rows['jdiction'];?>){ //授权
        str ="美团支付";
        swal({   
            title: "店长授权",
            text: "授权账号：<input type='text' id='owner' name='owner' value=''> 授权密码：",
            type: "input",
            html:true,
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "确认授权",
            cancelButtonText: "关闭"  
            // inputPlaceholder: "凭证号：" 
        },
        function(inputValue){   
                    var owner =  inputValue;//取得授权账号
                    var ownerpwd =  $("[tabindex='3']").val();//取得授权密码
                    // if (inputValue === false) return false;
                    if (inputValue === false) { //取消
                       i =10;
                         if(buzekou>0){// 如果有不可打折的，先减掉，再打折
                                //total = ds-buzekou;
                                $("#fee").val((total*i/10+buzekou).toFixed(0));
                                $("#ds").html((total*i/10+buzekou).toFixed(0));
                                $("#ys").html((total*i/10+buzekou).toFixed(0));
                            }else{
                               $("#fee").val((total*i/10).toFixed(0));
                               $("#ds").html((total*i/10).toFixed(0)); 
                               $("#ys").html((total*i/10).toFixed(0)); 
                           }
                         // alert(total*i/10+buzekou);
                         $("#zhekou").html((total-(total*i/10)+daijinquan+manjian+mian).toFixed(0));
                         $("#dz").html(0.0);
                         return false
                     };  
                     if (owner !== "" && ownerpwd !="") {   

                    //判断 及 打折
                    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'souquan'))?>",{"owner":owner,"ownerpwd":ownerpwd},function(data){
                       console.log(data);
                       var temp=eval("("+data+")");
                       if(temp.success){
                        swal("授权成功");
                    }else{
                       i =10;
                         if(buzekou>0){// 如果有不可打折的，先减掉，再打折
                                //total = ds-buzekou;
                                $("#fee").val((total*i/10+buzekou).toFixed(0));
                                $("#ds").html((total*i/10+buzekou).toFixed(0));
                                $("#ys").html((total*i/10+buzekou).toFixed(0));
                            }else{
                               $("#fee").val((total*i/10).toFixed(0));
                               $("#ds").html((total*i/10).toFixed(0)); 
                               $("#ys").html((total*i/10).toFixed(0)); 
                           }
                         // alert(total*i/10+buzekou);
                         $("#zhekou").html((total-(total*i/10)+daijinquan+manjian+mian).toFixed(0));
                         $("#dz").html(0.0);

                         swal("账号密码错误！");
                         return false;
                     }


                 });
}else{
    swal.showInputError("请输入授权账号!");
    return false 
}
                    //checkCard(3,inputValue,owner,ownerpwd);
                });
}
<?php  } } ?>

    if(buzekou>0){// 如果有不可打折的，先减掉，再打折
        //total = ds-buzekou;
        $("#fee").val((total*i/10+buzekou).toFixed(0));
        $("#ds").html((total*i/10+buzekou).toFixed(0));
        $("#ys").html((total*i/10+buzekou).toFixed(0));//应收10.28
    }else{
     $("#fee").val((total*i/10).toFixed(0));
     $("#ds").html((total*i/10).toFixed(0));
       $("#ys").html((total*i/10).toFixed(0));//应收10.28
   }

   $("#zhekou").html((total-(total*i/10)+daijinquan+manjian+mian).toFixed(0));
   $("#discount").html(str);
    $("#dz").html((total-(total*i/10)).toFixed(0));//活动折扣2016.10.28
    $("[tabindex='3']").val(i);
}
//卡券核销
function cardConsume(coupon){
    swal({   
        title: "卡券核销",
        text: "卡券类型:"+coupon['typestr']+"<br>优惠:"+coupon['msg']+"<br>是否使用此卡券?",
        html:true,
        showLoaderOnConfirm: true,
        showCancelButton: true,   
        closeOnConfirm: false,
        confirmButtonText: "确认核销",
        cancelButtonText: "关闭",
    }, function(isConfirm){
        if (isConfirm) {
            $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'cardcheck'))?>",{"code":coupon['code']},function(data){
                //$("#debug").val(data).show();
                var temp=eval("("+data+")");
                if(temp.success){
                    swal("核销成功");
                    if(printDoc2 && temp.item.id)$("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer',array('id'=>$printDoc2,'cid'=>1))?>&tradeid="+temp.item.id);
                }else{
                    swal(temp.msg);
                }
            });
        }
    });
}

function extendFun(obj){
    if(obj==0){
        $('#extend_box').hide();
        isPaying=false;
        return;
    }
    isPaying=true;
    var _h=$(document).height();
    var _w=$(window).width();
    $('#extend_box').css('height',_h);
    $('#extend_box .panel-body').empty().css('height',_h-280);
    $('#extend_box .panel-footer').empty();
    $('#extend_box .panel-heading b').empty();
    switch(obj){
        case 1:
        $('#extend_box .panel-heading b').html("交班记录");
        $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'getcounternoprintrecord','storeid'=>$storeid))?>",{"storeid":"<?php  echo $storeid;?>"},function(data){
            //alert(data);
            var feedback=eval("("+data+")");
            var record=feedback.item;
            var temp='<table class="table table-hover text-center"><thead><tr><th>开始时间</th><th>交班时间</th><th>收银员</th><th>总金额</th><th>实际营收</th><th>打印</th></tr></thead><tbody>';
            for(i in record){
                temp+='<tr><td scope="row">'+record[i]['starttime']+'</td>';
                temp+='<td scope="row">'+record[i]['endtime']+'</td>';
                temp+='<td scope="row">'+record[i]['realname']['realname']+'</td>';
                console.log(record[i]['realname']);
                temp+='<td scope="row">'+record[i]['totalprice']+'</td>';
                temp+='<td scope="row">'+record[i]['revenue']+'</td>';
                <!--temp+='<td scope="row">'+record[i]['createtime']+'</td>';-->
                temp+='<td scope="row">';

                temp+='<a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&cat=<?php  echo $jiushuiId["id"];?>&starttime=';
                temp+= record[i]['starttime2'];
                temp+= '&endtime='
                temp+= record[i]['endtime2'];
                temp+='&do=printcat&m=j_money&username=';
                temp+= record[i]['realname']['realname'];
                temp+='" class="btn btn-danger" target="printbox">酒水</a> ';

                temp+=' <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&cat=<?php  echo $feibingId["id"];?>&starttime=';
                temp+= record[i]['starttime2'];
                temp+= '&endtime='
                temp+= record[i]['endtime2'];
                temp+='&do=printcat&m=j_money&username=';
                temp+=record[i]['realname']['realname'];
                temp+='" class="btn btn-info" target="printbox">飞饼</a> ';

                temp+=' <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&starttime=';
                temp+= record[i]['starttime2'];
                temp+= '&endtime='
                temp+= record[i]['endtime2'];
                temp+='&do=printrijie&m=j_money&username=';
                temp+=record[i]['realname']['realname'];
                temp+='" class="btn btn-success" target="printbox">对账单</a>';


                temp+=' <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&starttime=';
                temp+= record[i]['starttime2'];
                temp+= '&endtime='
                temp+= record[i]['endtime2'];
                temp+='&do=printtong&m=j_money&username=';
                temp+=record[i]['realname']['realname'];
                temp+='" class="btn btn-danger" target="_blank">消费统计表</a>';


                temp+='</td>';

                // temp+='<td  scope="row">'+record[i]['totalprice']+'</td><td  scope="row">'+record[i]['revenue']+'</td><td  scope="row">'+record[i]['createtime']+'</td><td>';
                // if(parseInt(record[i]['status'])){
                //     temp+=parseInt(record[i]['isprint']) ? '':'<a href="javascript:reprint(\''+record[i]["out_trade_no"]+'\',1)"><i class="fa fa-print"></i></a>';
                // }
                temp+='</tr>';
            }
            temp+='</tbody></table>';
            $("#extend_box .panel-body").append(temp);
            // $("#extend_box .panel-footer").html("交班记录共 <b>"+feedback.num+"</b>条");
        });
break;
case 2:
$('#extend_box .panel-heading b').html("收款成功记录");
var temp='<iframe src="<?php  echo $this->createMobileUrl("counthistory")?>" id="historybox" name="historybox" style="width:98%;"></iframe>';
$("#extend_box .panel-body").append(temp);
        //$("#extend_box .panel-footer").append('<a href="javascript:resetHeight(\'historybox\')" class="btn btn-info">更新</a>');
        $("#extend_box .panel-body").height();
        break;
        // 添加排号管理、预定管理2016.10.26
        case 3:
        $('#extend_box .panel-heading b').html("排号管理");
        var temp='<iframe src="<?php  echo $this->createMobileUrl("queueorder2")?>" id="historybox" name="historybox" style="width:100%;height:470px"></iframe>';
        $("#extend_box .panel-body").append(temp);
        $("#extend_box .panel-body").height();
        break;
        case 4:
        $('#extend_box .panel-heading b').html("预定管理");
        var temp='<iframe src="<?php  echo $this->createMobileUrl("reservation")?>" id="historybox" name="historybox" style="width:100%;height:470px"></iframe>';
        $("#extend_box .panel-body").append(temp);
        $("#extend_box .panel-body").height();
        break;
        // case 5:
        //     $('#extend_box .panel-heading b').html("<?php  echo $tableinfo['zone'];?>--<?php  echo $tableinfo['id'];?>号桌 NO.<?php  echo $orderid;?> 加菜");
        //     var temp='<iframe src="<?php  echo $this->createMobileUrl("addmenu",array("storeid"=>$storeid,"tablesid" => $tablesid,"orderid" => $orderid))?>" id="addmenu" name="addmenu" style="width:100%;height:600px!important;overflow-y:hidden"></iframe>';
        //     $("#extend_box .panel-body").append(temp);
        //      // $("#extend_box .panel-footer").append('<button type="submit" class="addsubmit btn btn-lg btn-success" >提交</button> ');
        //     $("#extend_box .panel-body").height();
        //     break;
        case 5:
        $('#extend_box .panel-heading b').html("<?php  echo $tableinfo['zone'];?>--<?php  echo $tableinfo['id'];?>号桌 NO.<?php  echo $orderid;?> 加菜");
        var temp='<iframe src="<?php  echo $this->createMobileUrl("addmenu",array("storeid"=>$storeid,"tablesid" => $tablesid,"orderid" => $orderid))?>" id="addmenu" name="addmenu" style="width:100%;height:600px!important;overflow-y:hidden"></iframe>';
        $("#extend_box .panel-body").append(temp);
             // $("#extend_box .panel-footer").append('<button type="submit" class="addsubmit btn btn-lg btn-success" >提交</button> ');
             $("#extend_box .panel-body").height();
             break;
         }
         $('#extend_box').show();
     }
     function resetHeight(obj){
        var _h=$("#"+obj).contents().find("body").height();
        $("#"+obj).height(_h);
    }
//----------扩展专用-----------//
function extendPay(osn,fee,callback,printid){
    isPaying=false;
    if(printid)printDoc=printid;
    var temp=parseFloat(fee);
    if(temp*100==0){
//        swal("请输入金额");
//        return;
}
console.log("支付开始");
swal({
    title: "刷卡支付", 
    text: "收款金额为<span style='color:#F00'>￥"+temp+"元</span>",   
    type: "input",
    html:true,
    showLoaderOnConfirm: true,
    showCancelButton: true,   
    closeOnConfirm: false,
    confirmButtonText: "确认收款",
    cancelButtonText: "关闭",  
    inputPlaceholder: "请扫描客户的付款二维码" 
}, function(inputValue){
    if (inputValue === false) return false;      
    if (inputValue === "") {
        swal.showInputError("请扫描客户的付款二维码");     
        return false
    }
    if(isPaying)return;
    isPaying=true;
    swal({title:"请稍后",showConfirmButton:false });
    if(inputValue.substr(0,1)=="1"){
        console.log("客户使用【微信】支付");
        $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'paywechat'))?>",{"qrcode":inputValue,"userid":"<?php  echo $user['id'];?>","fee":temp,"old_trade_no":osn},function(data){
            isPaying=false;
            var feedback=eval("("+data+")");
            if(feedback.success){
                var _item=feedback.items;
                $("#tradeno").val(_item['out_trade_no']);
                if(_item['result_code']=="SUCCESS"){
                    extendPaySuccess(callback);
                }else{
                    if(_item['err_code']=="USERPAYING"){
                        setTimeout(function(){extendCheckpay(_item['out_trade_no'])},5000);
                        swal({
                            title: "温馨提示",   
                            text: "等待客户输入支付密码",
                            confirmButtonText: "关闭订单",
                        }, function(isConfirm){
                            if (isConfirm) {
                                deleteOrder(_item['out_trade_no']);
                            }
                        }
                        );
                    }
                }
            }else{
                swal(feedback.msg);
                return;
            }
        })
}else{
    console.log("客户使用【支付宝】支付");
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'payalipay'))?>",{"qrcode":inputValue,"userid":"<?php  echo $user['id'];?>","fee":temp,"old_trade_no":osn},function(data){
        var feedback=eval("("+data+")");
        if(feedback.success){
            if(feedback.result){
                $("#tradeno").val(feedback.out_trade_no);
                checkTimeout=setTimeout(function(){extendCheckAlipay(callback)},5000);
                swal({
                    title: "温馨提示",   
                    text: "等待客户输入支付密码",
                    confirmButtonText: "关闭订单",
                }, function(isConfirm){
                    if (isConfirm) {
                        clearTimeout(checkTimeout);
                    }
                }
                );
            }else{
                var _item=feedback.items;
                $("#tradeno").val(_item['out_trade_no']);
                extendPaySuccess(callback);
            }
        }else{
            swal(feedback.msg);
            return;
        }
    })
}
});
}
function extendCheckpay(callback){
    var temporder=$("#tradeno").val();
    if(!temporder){
        swal("订单号不能为空");
        return;
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'checwechatkpay'))?>",{"orderid":temporder},function(data){
        var feedback=eval("("+data+")");
        if(feedback.success){
            var temp=feedback.items;
            if(temp['trade_state']=="SUCCESS"){
                extendPaySuccess(callback);
            }else if(temp['trade_state']=="NOTPAY"){
                swal("用户自动取消支付");
            }else if(temp['trade_state']=="USERPAYING"){
                setTimeout(function(){extendCheckpay(callback)},5000);
            }else{
                swal("支付失败，未知错误!");
            }
        }else{
            swal(feedback.msg);
        }
    });
}

function extendCheckAlipay(callback){
    var temporder=$("#tradeno").val();
    if(!temporder){
        swal("订单号不能为空");
        return;
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'checkalipay'))?>",{"orderid":temporder},function(data){
        var feedback=eval("("+data+")");
        if(feedback.success){
            if(feedback.result){
                checkTimeout=setTimeout(function(){checkAlipay(callback)},5000);
                swal({
                    title: "温馨提示",   
                    text: "等待客户输入支付密码",
                    confirmButtonText: "关闭订单",
                }, function(isConfirm){
                    if (isConfirm) {
                        clearTimeout(checkTimeout);
                    }
                }
                );
            }else{
                extendPaySuccess(callback);
            }
        }else{
            swal(feedback.msg);
        }
    });
}
//支付成功；
function extendPaySuccess(callback){
    var temporder=$("#tradeno").val();
    if(!temporder){swal("订单号不能为空");return;}
    $("#tradeno").val("");
    $("#fee").val(0);
    var printNum=parseInt("<?php  echo $cfg['printnum'];?>") ? parseInt("<?php  echo $cfg['printnum'];?>") :0;
    if(printNum>1){
        swal({title:"收款成功"});
    }else{
        swal({title:"收款成功",timer:500});
    }
    if(undefined!=callback)callback(old_orderid);
    if(printDoc && temporder && printNum){
        $("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer')?>&id="+printDoc+"&tradeid="+temporder);
        if(printNum>1){
            swal({
                title: "再打一张小票？",   
                showCancelButton: true,
                cancelButtonText: "取消",
                confirmButtonText: "打印",
            }, function(isConfirm){
                if (isConfirm) {
                    $("#printbox").attr("src","<?php  echo $this->createMobileUrl('printer')?>&id="+printDoc+"&tradeid="+temporder);
                }
            }
            );
        }
    }
    $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'marketing'))?>",{"orderid":temporder},function(data){
        console.log(data);
        $.post("<?php  echo $this->createMobileUrl('ajax',array('op'=>'tempmsg'))?>",{"orderid":temporder},function(data2){
            console.log(data2);
        });
    });
    getCounterRecord();
}

//api 
function getTables(){
    $.post("./index.php?i=<?php  echo $weid;?>&c=entry&do=gettables&m=j_money",{"storeid":<?php  echo $weid;?>},function(data){
        //console.log(data);
        var feedback=eval("("+data+")");
        console.log(feedback.data.length);
        var tablesid = 0;
        var price = 0;
        var time = '';
        var orderid = -1;
    var tables = '';
    tables += '<div class="row">';
    for(var i=0;i<feedback.data.length;i++){
        var statusHtml = '';
        //tables += '<div class="col-xs-3"  style="margin:2px 0;"> <a type="a" class="btn btn-info btn-lg btn-block" onclick=settaste("'+i+'")>'+i+'人</a></div>';
        //console.log(feedback.data[i].title);
        tablesid = feedback.data[i].id;
        orderid = parseInt(feedback.data[i].order.id);
        if(orderid > 0){
            $('[tablesid='+tablesid+']').removeClass('btn-success').addClass('btn-danger');        
            price = parseInt(feedback.data[i].order.totalprice);
            var dateTime = new Date(parseInt(feedback.data[i].order.dateline) * 1000);
            var time = dateTime.getHours()+':'+dateTime.getMinutes();

            statusHtml += price+' 元 <br>'; 
            statusHtml += time+' 开台 <br>'; 
        }else{
            $('[tablesid='+tablesid+']').removeClass('btn-danger').addClass('btn-success kaitai');        
            $('[tablesid='+tablesid+']').find('a').attr('href','#');        
            statusHtml = ' 空闲 <br> <a class="btn btn-success btn-block" >点击开台</a>'; 
        }
        $('[tablesid='+tablesid+']').find('.state').html(statusHtml);        
    }
       
    });
}
window.setInterval(getTables, 5000); 
</script>

<?php  if(is_array($btnlist)) { foreach($btnlist as $row) { ?>
<?php  if($row['jsurl']) { ?>
<!--
<?php  echo $row['btnname'];?>--<?php  echo $row['btnurl'];?>
-->
<script src="../attachment/j_money/js/<?php  echo $_W['uniacid']?>/<?php  echo $row['jsurl'];?>"></script>
<?php  } ?>
<?php  } } ?>
<?php  } ?> 
