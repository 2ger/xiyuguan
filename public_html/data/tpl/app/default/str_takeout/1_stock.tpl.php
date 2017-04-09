<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<style type="text/css">
	.but-post{display:block;height:30px;line-height:30px;border:none;width:640px;border-radius:3px;font-size:16px;font-weight:bold;color:#fff;background-color:#ff5f32;}
	.nav div{width:100%; color: #fff;text-align: center;}
</style>
<div class="container">
	<section>
	<header class="nav menu">
		<div><?php  echo $users['name'];?>库存信息</div>
	</header>
	    
		<style type="text/css">
			.my_menu_list th{width:0;}
			.tt h2 {
			    width: 100%;
			    -webkit-box-sizing: border-box;
			    height: 30px;
			    line-height: 30px;
			    padding-left: 15px;
			    font-size: 16px;
			    color: #919191;
			    background-color: #f8f8f8;
			    border-width: 0 0 1px;
			}
			.sou {
				width: 100%;
				-webkit-box-sizing: border-box;
				height: 60px;
				background-color: white;
			}
			.sou ul {
				padding: 10px;
			}
			.sou ul li {
				float: left;
				width: 50%;
				text-align: center;
			}
		</style>
		<!-- 按分类搜索 -->
	    <div class="sou">
	    	<ul>
	    		<li>
	    			<select class="comm_btn" style="width: 100%;" onchange="changeselect()" id="changeselect">

	    				<option value="">分类</option>
	    				<?php  if(is_array($category)) { foreach($category as $row) { ?>
	    				<option value="<?php  echo $row['id'];?>" <?php  if($cid==$row['id']) { ?> selected='selected'<?php  } ?>><?php  echo $row['name'];?></option>
	    				<?php  } } ?>
	    			</select>
	    		</li>
	    	</ul>
	    	<script type="text/javascript">
	    		function changeselect(){
				var id= $('#changeselect').val();
                window.location.href="index.php?i=3&c=entry&do=stock&logid=<?php  echo $logid;?>&storeid=<?php  echo $storeid;?>&m=str_takeout&cid="+id;
	    		}
	    	</script>
	    </div>
	    <!-- 搜索结束 -->
		<?php  if(is_array($category)) { foreach($category as $cate_row) { ?>
		<?php  if(!empty($cate_goods[$cate_row['id']])) { ?>
		<div class="tt cat<?php  echo $cate_row['id'];?>" id="cate-<?php  echo $cate_row['id'];?>">
		<h2 style="color:#ff510c"><?php  echo $cate_row['name'];?></h2></div>
		<table class="my_menu_list" style="margin-top: 0px;">
			<thead>
				<tr>
					<th style="width:30%">原材料</th>
					<th style="width:20%">规格</th>
					<th style="width:20%">库存</th>
					<th style="width:20%">单位</th>
				</tr>
			</thead>
			<tbody>
					<?php  if(is_array($cate_goods[$cate_row['id']])) { foreach($cate_goods[$cate_row['id']] as $da) { ?>
						<tr>
							<td><?php  echo $da['name'];?></td>
							<td><?php  echo $da['spec'];?></td>
							<td><?php  if(empty($da['costUnitId']))$da['costUnitId']=1?>
								<?php  if(($da['qty']*$da['costUnitId'])<=1) { ?>
								<span style="color: red;">
									<?php  echo $da['qty']*$da['costUnitId']?>
								</span>
								<?php  } else { ?>
								<?php  echo $da['qty']*$da['costUnitId']?>
								<?php  } ?>
							</td>
							<td><?php  if($da['costName']=='') { ?><?php  echo $da['unitName'];?><?php  } else { ?><?php  echo $da['costName'];?><?php  } ?></td>
						</tr>
					<?php  } } ?>
			</tbody>
		</table>
		<?php  } ?>
		<?php  } } ?>

	</section>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
