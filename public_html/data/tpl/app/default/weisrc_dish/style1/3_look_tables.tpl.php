<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<title>按桌号查看</title>
</head>
<body>
    <?php  include $this->template($this->cur_tpl.'/_menu2');?>
<div class="page grid ">
     <p class='page__hd'><a href="javascript:window.history.back();" class="weui-btn weui-btn_plain-primary" id="p1" >关闭</a></p>

    <div class="page__hd">
        <b>按桌号查看</b>
        <p class="page__desc">提示：小红点中为未上菜数量</p>
    </div>
    <div class="weui-grids">
       <?php  if(is_array($tableAll)) { foreach($tableAll as $items) { ?>
            <a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=look_list&tables=<?php  echo $items['id'];?>&zone=<?php  echo $items['name']['title'];?>&title=<?php  echo $items['title'];?>&m=weisrc_dish" class="weui-grid">
                <div class="weui_grid_icon">
                    <span class="weui-badge" style="margin-left: 5px;"><?php  echo $items['goods']['num'];?></span>
                </div>
                <p class="weui_grid_label">
                    <?php  echo $items['name']['title'];?>-<?php  echo $items['title'];?>
                </p>
            </a>
        <?php  } } ?>
    </div>

</div>
  
</body>
</html>
