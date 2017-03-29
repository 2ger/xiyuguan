<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<title>投票结束</title>
	<?php  echo register_jssdk();?>
	<link type="text/css" rel="stylesheet" href="../addons/ewei_vote/style/vote.css" />
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body>
<div class="wrapper" style="margin-top:-8px;">
	<img class="bg" src="../addons/ewei_vote/style/images/bg.jpg">
	<div class="top fn-clear">
		<div class="title-cont">
			<p class="title"><?php  echo $reply['title'];?></p>
			<p class="timeout" style='padding-left:15px;'><img class="clock" src="../addons/ewei_vote/style/images/clock.png"><span class="text"><?php  echo $limits;?></span></p>
			<p>&nbsp;</p>
		</div>
	</div>
	<?php  if(!empty($reply['thumb'])) { ?>
	<div class="cover">
		<img class="line" src="../addons/ewei_vote/style/images/ctline.jpg">
		<img class="cimg" src="<?php  echo tomedia($reply['thumb'])?>">
		<img class="line" src="../addons/ewei_vote/style/images/cbline.jpg">
	</div>
	<?php  } ?>
	<div class="summary"><?php  echo $reply['title'];?> -- 投票结果</div>
	<div class="option-cont">
		<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<div class="option fn-clear option-statis" data-value="0">
			<?php  if(!empty($row['thumb']) && $reply['isimg']==1) { ?>
			<div>
				<image src="<?php  echo tomedia($row['thumb'])?>" style="width:95%;margin:10px;" />
			</div>
			<?php  } ?>
			<div style="overflow:hidden;">
				<div style="float:left"><?php  echo $row['title'];?></div>
				<div style="float:right"><?php  echo $row['vote_num'];?>票</div>
			</div>
			<div class="progress">
				<div data-per="<?php  echo $row['percent'];?>" class="bar bar0" style="width: <?php  echo $row['percent'];?>%;"></div>
			</div>
			<span class="per" style="margin-left:15px;"><?php  echo $row['num'];?>(<?php  echo $row['percent'];?>%)</span>
		</div>
		<img class="sep" src="../addons/ewei_vote/style/images/option_sep.jpg">
		<?php  } } ?>
	</div>
	<p class="page-url">
	</p>
</div>
</body>
<script type="text/javascript">
	// 大转盘分享
	wx.ready(function () {
		sharedata = {
			title: "<?php  echo $sharetitle;?>",
			desc: "<?php  echo $sharedesc;?>",
			link: "<?php  echo $sharelink;?>",
			imgUrl: "<?php  echo $shareimg;?>"
		};
		wx.onMenuShareAppMessage(sharedata);
		wx.onMenuShareTimeline(sharedata);
	});
</script>
</html>
