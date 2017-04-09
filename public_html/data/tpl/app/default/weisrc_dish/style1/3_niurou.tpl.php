<?php defined('IN_IA') or exit('Access Denied');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<title>牛肉间</title>
</style>
</head>

<body ontouchstart style="background-color: #f8f8f8;">
    <?php  include $this->template($this->cur_tpl.'/_menu2');?>
        <div class="weui-flex">
            <div class="weui-flex__item "><a class="weui-btn weui-btn_plain-primary" href="<?php  echo $this->createMobileUrl('niurou', array(), true)?>">未完成</a></div>
            <div class="weui-flex__item"><a href="<?php  echo $this->createMobileUrl('niurou', array('revoke' => 1), true)?>" class="weui-btn weui-btn_plain-default">已完成</a></div>
        </div>
        <div class="weui-cells weui-cells_checkbox"  id="list">
                <div class="weui-cell">
                    <div class="weui-cell__bd">
                     <p>
                       牛肉间 
                         <?php  if($revoke==1) { ?>
                      已完成 <i class="weui-icon-warn"></i>
                      <?php  } else { ?>
                        未完成 <i class="weui-icon-success"></i>
                     <?php  } ?>

                    </p>
                    </div>
                    <div class="weui-cell__ft">
                   <a class="weui-btn weui-btn_primary " onclick="submitIds2()">
                    提交</a> 
                    </div>
                </div>
        <!-- 列表 -->
        <?php  if(is_array($list)) { foreach($list as $items) { ?>
        <label class="weui-cell weui-check__label <?php  echo $items['change'];?>  <?php  if($revoke==1) { ?>tui<?php  } ?>  <?php  if($items['type']==2) { ?>tui f-gray<?php  } ?>" for="<?php  echo $items['id'];?>">
           <div class="weui-cell__hd">
            <input type="checkbox" class="weui-check"  name="r" id="<?php  echo $items['id'];?>">
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p>
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
        <style>
    .tui{text-decoration: line-through;color:#000;}
    </style>
</body>
</html>