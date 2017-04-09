<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>易伙三商</title>
	<meta name="format-detection" content="telephone=no, address=no">
	<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="shortcut icon" href="http://yhs.xyj0772.com/attachment/images/global/wechat.jpg" />
    <link href="<?php  echo $_W['siteroot'];?>app/resource/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/animate.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/common.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/app.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/index.php?i=3&c=utility&a=style&" rel="stylesheet">
	<!-- <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> -->
    <!-- <script src="http://yhs.xyj0772.com/app/resource/js/require.js"></script> -->
	<!-- <script src="http://yhs.xyj0772.com/app/resource/js/app/config.js"></script> -->
	<!-- <script type="text/javascript" src="http://yhs.xyj0772.com/app/resource/js/lib/jquery-1.11.1.min.js"></script> -->
	
	
</head>
<body>
<div class="container container-fill">
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
    <script src="http://cdn1.lncld.net/static/js/av-min-1.5.0.js"></script>

<style type="text/css">
	.but-post{display:block;height:30px;line-height:30px;border:none;width:640px;border-radius:3px;font-size:16px;font-weight:bold;color:#fff;background-color:#ff5f32;}
	.nav div{width:100%; color: #fff;text-align: center;}
</style>
<div class="container">
	<section>
	<header class="nav menu">
		<div>订单详情</div>
	</header>

		<style type="text/css">
			.my_menu_list th{width:0;}
		</style>
		<table class="my_menu_list">
			<thead>
				<tr>
					<th style="width:30%">原材料</th>
					<th style="width:28%">规格</th>
					<th style="width:15%">数量</th>
					<th style="width:17%">单位</th>
				</tr>
			</thead>
			<tbody>
					<?php  if(is_array($order_info)) { foreach($order_info as $da) { ?>
						<tr>
							<td><?php  echo $da['name'];?></td>
							<td><?php  echo $da['spec'];?></td>
							<td><?php  echo $da['qty'];?></td>
							<td><?php  echo $da['unitName'];?></td>
						</tr>
					<?php  } } ?>
			</tbody>
		</table>
		<ul class="box pay_box">
			<li>订单编号：<?php  echo $order['billNo'];?></li>
			<li>联系人：<?php  echo $order['userName'];?></li>
			<li>下单时间：<?php  echo $order['modifyTime'];?></li>
			<li>总数量：<span class="text-strong"><?php  echo $order['totalQty'];?></span></li>
		</ul>
        <img src="<?php  echo $order['photo'];?>" id="image" width="100%">
		<form action="" id="myform" method="post" enctype="multipart/form-data"> 
		<input type="hidden" name="orderid" value="<?php  echo $order['id'];?>">
		<input type="hidden" name="imageurl"  id="imageurl">
		<ul class="box pay_box">
		    <li>图片上传</li>
			<li><input type="file" id="file_input"/></li>
			<li><input type="submit" name="submit" value="上传图片" class="comm_btn"></li>
		</ul>
<!-- 存储服务 -->
    <script type="text/javascript">
var APP_ID = 'HidnRWhsXILcVyjrsk88iPiq-gzGzoHsz';
var APP_KEY = 'LPrYuI4GaOJqmf5vvfYLhPcl';
AV.init({
    appId: APP_ID,
    appKey: APP_KEY
});


			var input = document.getElementById("file_input");
//文件域选择文件时, 执行readFile函数
input.addEventListener('change',readFile,false);
function readFile(){ 
    console.log('获得文件大小');
    var file = this.files[0]; 
  

    var fileUploadControl = this;
    if (fileUploadControl.files.length > 0) {
        var localFile = fileUploadControl.files[0];
        var name = 'avatar.png';
        var file = new AV.File(name, localFile);
        file.save().then(function(file) {
            // 文件保存成功
            document.getElementById('imageurl').value=file.url();
            document.getElementById('image').src=file.url();
            //document.getElementById('myform').submit();
            //alert('图片上传成功！');
			        //$("#imageurl").val(file.url());
            console.log(file.url());
        }, function(error) {
            // 异常处理
            console.error(error);
        });
    }
}

		</script>
		</form>
		<ul class="box pay_box">
			<li>备注</li>
			<li><?php  if($order['description']) { ?><?php  echo $order['description'];?><?php  } else { ?>无<?php  } ?></li>
		</ul>
		<!-- <div class="detail_tools">
				<div><a href="javascript:;" class="comm_btn" id="confirmBtn">退货</a></div>
		</div> -->

	</section>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>

<div class="dialog mask" style="display: none;">
	<div class="dialog_wrap">
		<div class="dialog_tt">确认删除订单</div>
		<div class="dialog_scroller"><div class="confirm_box dialog_content" id="confirmBox2" style="display: block;">
			<p>您确定要删除订单？</p>
		<div>
		<span><a href="javascript:void(0);" class="comm_btn disabled" id="cancelConfirmDelete">取消</a></span>
		<span><a href="" class="comm_btn" id="confirmDelete">确认删除</a></span>
	</div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
