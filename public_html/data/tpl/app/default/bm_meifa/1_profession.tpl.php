<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
    <link type="text/css" rel="stylesheet" href="<?php echo IMS_VERSION>=0.6?"../addons":"./source/modules"?>/bm_meifa/template/mobile/css/plugmenu.css">
    <link href="<?php echo IMS_VERSION>=0.6?"../addons":"./source/modules"?>/bm_meifa/template/mobile/css/listhome.css" rel="stylesheet" type="text/css" />
    <style>
.head{height:40px; line-height:40px; background:#fdfdfd; margin-bottom:5px; padding:0 5px; color:#FFF;}
.head .bn{display:inline-block; height:30px; line-height:30px; padding:0 10px; margin-top:4px; font-size:20px; border:1px #efefef solid; background:#efefef; color:#999999; text-decoration:none;}
.head .bn.pull-right{position:absolute; right:5px; top:0;}
.head .title{font-size:14pt;display:block;padding-left:10px;font-weight:bolder;margin-right:49px;text-align:center;height:40px;line-height:40px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden;color:#999999;}
.chatPanel a{
    text-decoration:none;
}
</style>





<body id="listhome3">
<div class="Listpage">
    <div class="head">
    <a href="javascript:history.go(-1);" class="bn pull-left"><i class="fa fa-mail-reply"></i></a>
    <span class="title"><?php  echo $title;?></span>
    </div>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('slide', TEMPLATE_INCLUDEPATH)) : (include template('slide', TEMPLATE_INCLUDEPATH));?>

</div>
	
<div class="list" id="list_rec">
		<div class="list-item img-rounded">
		<div class="thumbnail">
		<img src="<?php  echo $_W['attachurl'];?><?php  echo $info['picurl'];?>">
		</div>
			<div align="center">
				
				<span class="title"><?php  echo $info['ser_name'];?></span>
				<span class="price"><?php  echo $info['kbox'];?></span>	
			</div>
			<div class="entry">
				<?php  echo $info['project_info'];?>
			</div>
		</div>

	<a class="btn btn-block btn-primary" href="<?php  echo $this->createMobileUrl('reservation',array('id' => $info['id']))?>">立即预约</a>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>