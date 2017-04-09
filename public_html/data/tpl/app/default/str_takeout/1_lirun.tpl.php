<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>利润表</title>
	<link rel="stylesheet" href="http://shanghai.xyj0772.com/web/resource/css/bootstrap.min.css">
</head>
<body>
	<center>

<div id="export">
<a class="Noprint btn btn-success" onclick="window.history.back()">  返回  </a>
<a class="Noprint btn btn-success" onclick="print()">  打印  </a>


		<a class="Noprint btn btn-success " data-type="xls" href="javascript:;">导出excel</a>

		<a class="Noprint btn btn-success " data-type="doc" href="javascript:;">导出word</a>

	</div>
	
	<h3>溪雨观 <?php  echo $store;?> 利润表 <?php  echo $year;?>年</h3>
	</center>
	
	<table class="table table-bordered" id="table1">
		<!-- 一行开始 -->
		<thead>
			<th>项目</th>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<th><?php  echo $index;?>月</th>
			<?php  } } ?>
			<th>本年累计数</th>
		</thead>
		<!-- 一行结束 -->
		<!-- 一行开始 -->
		<tr>
		    <td>主营业务收入</td>
		    <?php  $lirunall =0?>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td> <b><?php  echo round($item['shou']['total'])?></b>
			<?php  $lirunall +=round($item['shou']['total'])?>
		</td>
			<?php  } } ?>
			<td> <b><?php  echo $lirunall;?></b></td>
		</tr>
		<tr>
		    <td>减：成本</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
				
		</tr>
		<tr>
		    <td>减：燃气</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
		</tr>
		<tr>
		    <td>减：酒水饮料成本</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
				
		</tr>
		<tr>
		    <td>营业利润</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
				
		</tr>
		<tr>
		    <td>毛利率</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
		</tr>
		<tr>
		    <td>减：税金</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
		</tr>
		<tr>
			<td>
	<table class="table">
			<tr>
<td>
 <b>减：营业费用：</b>	
</td>
		</tr>
			<?php  if(is_array($lirun[1]['title'])) { foreach($lirun[1]['title'] as $title) { ?>
		<tr>
			<td><?php  echo $title['title'];?> <br></td>
		</tr>
			<?php  } } ?>
	</table>
			</td>
			<?php  $feiall = 0?>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td>
	<table class="table">
		<tr>
			<?php  $feiall += $item['feiyong']['all']['total']?>
		<td> <b><?php  echo $item['feiyong']['all']['total'];?></b></td>
		</tr>
			<?php  if(is_array($item['feiyong'])) { foreach($item['feiyong'] as $price) { ?> 
		<tr>
			<td><?php  echo $price['price'];?> <br></td>
		</tr>
			<?php  } } ?>
	</table>
			</td>
			<?php  } } ?>
			<td> <b><?php  echo $feiall;?></b></td>
				
		</tr>
		<tr>
		    <td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
		    <td>净利润</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
		</tr>
		<tr>
		    <td>净利率</td>
			<?php  if(is_array($lirun)) { foreach($lirun as $index => $item) { ?>
			<td></td>
			<?php  } } ?>
			<td></td>
		</tr>
				<!-- 一行结束 -->
	</table>

	<script src="http://shanghai.xyj0772.com/html2excel/Blob.js"></script>
	<script src="http://shanghai.xyj0772.com/html2excel/FileSaver.js"></script>
	<script src="http://shanghai.xyj0772.com/html2excel/tableExport.js"></script>
	<script>
	var $exportLink = document.getElementById('export');
	$exportLink.addEventListener('click', function(e){
		e.preventDefault();
		if(e.target.nodeName === "A"){
			tableExport('table1', '溪雨观 <?php  echo $store;?> 利润表 <?php  echo $year;?>年', e.target.getAttribute('data-type'));
		}
	}, false);
	</script>

<style>

          body{font-size:12px}

          *,input,td,tr,table,h3{text-align: center!important;padding:0!important;margin:0!important}

ul.list li{width:50%;float:left;margin:0;padding:0;font-weight:700}

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {

    border: 1px solid #000!important;

}

</style>

<style media="print">

.Noprint

{

    display: none;

}

.PageNext

{

    page-break-after: always;

}

.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {

    border: 1px solid #000!important;

}

</style>
</body>
</html>