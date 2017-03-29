<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('slide', TEMPLATE_INCLUDEPATH)) : (include template('slide', TEMPLATE_INCLUDEPATH));?>
<style>
body{
font:<?php  echo $_W['styles']['fontsize'];?> <?php  echo $_W['styles']['fontfamily'];?>;
color:<?php  echo $_W['styles']['fontcolor'];?>;
padding:0;
margin:0;
background-image:url('<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } ?>');
background-size:cover;
background-color:<?php  if(empty($_W['styles']['indexbgcolor'])) { ?>#ccc<?php  } else { ?><?php  echo $_W['styles']['indexbgcolor'];?><?php  } ?>;
<?php  echo $_W['styles']['indexbgextra'];?>
}
a{color:<?php  echo $_W['styles']['linkcolor'];?>; text-decoration:none;}
.box{overflow:hidden;}
.box .box-item{float:left;text-align:center;display:block;text-decoration:none;outline:none;width:100%;height:60px; background:#d47314;position:relative; color:#FFF;}
.box .box-item .icon{display:inline-block; position:absolute; left:10px; top:22px; font-size:16px; color:rgba(0, 0, 0,0.30); overflow:hidden;}
.box .box-item .angle{display:inline-block; position:absolute; right:10px; top:22px; font-size:20px; color:#fff; overflow:hidden;}
.box .box-item span{color:<?php  echo $_W['styles']['fontnavcolor'];?>; font-size:16px; display:block; position:absolute; left:35px; top:18px; text-align:left;}
<?php  echo $_W['styles']['css'];?>
.footer{display:none!imoprtant;    height: 1px;
    overflow: hidden;}
</style>
<div class="box">
	<?php  $num = 0;?>
	<?php  if(is_array($navs)) { foreach($navs as $nav) { ?>
	<?php  if($num == 0) $bg = '#F46756';?>
	<?php  if($num == 1) $bg = '#F69D4B';?>
	<?php  if($num == 2) $bg = '#45CAEB';?>
	<?php  if($num == 3) $bg = '#57D492';?>
	<?php  if($num == 4) $bg = '#7B60B1';?>
	<a href="<?php  echo $nav['url'];?>" class="box-item" style="background:<?php  echo $bg;?>;">
		<i class="<?php  echo $nav['css']['icon']['icon'];?> icon"></i>
		<i class="icon-angle-right angle"></i>
		<span style="<?php  echo $nav['css']['name'];?>"><?php  echo $nav['name'];?></span>
	</a>
	<?php  $num++; if($num > 4) $num = 0;?>
	<?php  } } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
