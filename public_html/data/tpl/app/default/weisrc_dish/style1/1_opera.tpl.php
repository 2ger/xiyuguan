<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
</head>

<body ontouchstart style="background-color: #f8f8f8;">
    <?php  include $this->template($this->cur_tpl.'/_menu2');?>

 <!-- <a class="icon icon-109 f-white" href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=operalist&m=weisrc_dish"></a> -->

    <!-- menu -->
    <div class="weui-flex">
            <div class="weui-flex__item "><a class="weui-btn weui-btn_plain-primary" href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=Look_tables&m=weisrc_dish">按桌号</a></div>
            <div class="weui-flex__item"><a onclick="input('leng')" class="weui-btn weui-btn_plain-default">传菜员</a></div>
            <div class="weui-flex__item"><a onclick="input('lou')"  class="weui-btn weui-btn_plain-primary">服务员</a></div>
        </div>
        <script>
function input(id){
    var html = document.getElementById(id).innerHTML;
    document.getElementById('list').innerHTML=html;
}
        </script>

<!-- list -->
  <div>
    <div class="weui-cells weui-cells_checkbox"  id="list">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                     <p>
                      <i class="weui-icon-warn"></i>    <?php  echo $title;?>
                    </p>
                    </div>
                    <div class="weui-cell__ft">
                     <?php  if($newOrder['id']>0) { ?> 
                          <a class="weui-btn  weui-btn_warn" href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=look_list&tables=<?php  echo $newOrder['tables'];?>&title=<?php  echo $newOrder['title'];?>&m=weisrc_dish">
                            有新订单请确认
                        </a> 
                     <audio id="myaudio" src="../addons/weisrc_dish/template/mobile/style1/assets/neworder.mp3" loop="1" playcount="1" hidden="false" autoplay="true">
                            <?php  } else { ?>
     <a class="weui-btn weui-btn_primary " onclick="submitIds()">
                    提交</a> <?php  } ?>
                    </div>
                </div>
        <!-- 列表 -->
        <?php  if(is_array($list)) { foreach($list as $items) { ?>
        <label class="weui-cell weui-check__label <?php  echo $items['change'];?> <?php  if($items['type']==2) { ?>tui f-gray<?php  } ?>" for="<?php  echo $items['id'];?>" >
           <div class="weui-cell__hd">
            <input type="checkbox" class="weui-check"  name="r" id="<?php  echo $items['id'];?>">
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p>
                <!-- 桌号 -->
                <span class="right f-blue"><?php  echo $items['sortname'];?>  - <?php  echo $items['tablesname'];?> </span>
                <?php  echo $items['title'];?><?php  if($items['flavor']!="") { ?>(<?php  echo $items['flavor'];?>)<?php  } ?> * <?php  echo $items['total'];?> <?php  echo $items['unitname'];?>  
                <?php  if($items['type']==2) { ?>(已退)<?php  } ?> 
                <br>
                <?php  if($items['content']!="") { ?>
                <span style="color:#fff;background:red"><?php  echo $items['content'];?></span>
                <?php  } ?>

                <span class="right">  <?php  echo date('H:i',$items['dateline'])?></span>

            </p>
        </div>
    </label>
    <?php  } } ?>
    </div>
</div>

<div id="leng">
 <div class="page__hd">
        <b>传菜员 按分类查看</b>
        <p class="page__desc">提示：小红点中为未上菜数量</p>
    </div>
    <div class="weui-grids">
        <?php  if($_W['uniacid'] ==3) { ?>
         <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=opera&m=weisrc_dish&cat=niurou" class="weui-grid">
                <div class="weui_grid_icon">
                    <span class="weui-badge" style="margin-left: 5px;"><?php  echo $niurou['num'];?></span>
                </div>
                <p class="weui_grid_label">
                    牛肉间
                </p>
            </a>
        <?php  } ?>
         <?php  if($_W['uniacid'] ==1) { ?>
         <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=opera&m=weisrc_dish&cat=leng" class="weui-grid">
                <div class="weui_grid_icon">
                    <span class="weui-badge" style="margin-left: 5px;"><?php  echo $leng['num'];?></span>
                </div>
                <p class="weui_grid_label">
                    冷菜间
                </p>
            </a>
        <?php  } ?>
            <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=opera&m=weisrc_dish&cat=pei" class="weui-grid">
                <div class="weui_grid_icon">
                    <span class="weui-badge" style="margin-left: 5px;"><?php  echo $pei['num'];?></span>
                </div>
                <p class="weui_grid_label">
                    配菜间
                </p>
            </a>
            <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=opera&m=weisrc_dish&cat=chu" class="weui-grid">
                <div class="weui_grid_icon">
                    <span class="weui-badge" style="margin-left: 5px;"><?php  echo $chu['num'];?></span>
                </div>
                <p class="weui_grid_label">
                    厨房间
                </p>
            </a>
    </div>
</div>

<div id="lou">
    <div class="page__hd" id="">
        <b>服务员 按楼层查看 </b>
        <p class="page__desc">提示：小红点中为未上菜数量</p>
    </div>
    <div class="weui-grids">

       <?php  if(is_array($tablelist)) { foreach($tablelist as $items) { ?>
            <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=opera&m=weisrc_dish&zone=<?php  echo $items['id'];?>" class="weui-grid">
                <div class="weui_grid_icon">
                    <span class="weui-badge" style="margin-left: 5px;"><?php  echo $items['goods']['num'];?></span>
                </div>
                <p class="weui_grid_label">
                    <?php  echo $items['title'];?>
                </p>
            </a>
        <?php  } } ?>
    </div>
</div>
</body>
</html>