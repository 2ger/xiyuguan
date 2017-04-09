<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>供货商统计月报表</title>
	<link rel="stylesheet" href="http://shanghai.xyj0772.com/web/resource/css/bootstrap.min.css">
</head>
<body>
	<center>
		<div id="export">
<a class="Noprint btn btn-danger pull-left" onclick="window.history.back()">  返回  </a> 
<a class="Noprint btn btn-success " onclick="print()">  打印  </a>


		<a class="Noprint btn btn-success " data-type="xls" href="javascript:;">导出excel</a>

		<a class="Noprint btn btn-success " data-type="doc" href="javascript:;">导出word</a>

	</div>

	<h3>溪雨观 <?php  echo $store;?> 供货商统计月报表   <?php  echo date('Y年m月')?></h3>
	</center>
	<table class="table  table-bordered" id="table1">
		<!-- 一行开始 -->
		<tr>
			<td>供货商</td>

			<?php  if(is_array($gongying[0]['cost'])) { foreach($gongying[0]['cost'] as $index => $item) { ?>
			<td><?php  echo $index;?></td>
			<?php  } } ?>
			<td>合计</td>
		</tr>
		<!-- 一行结束 -->
		<!-- 一行开始 -->
		<?php  if(is_array($gongying)) { foreach($gongying as $index => $item) { ?>
		<tr>
		    <td><?php  echo $item['name'];?></td>
			<?php  if(is_array($item['cost'])) { foreach($item['cost'] as $item2) { ?>
			<td><?php  echo $item2['cost']['total'];?></td>
			<?php  } } ?>
			<td><?php  echo $item['total']['total'];?></td>
		</tr>
		<?php  } } ?>
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
			tableExport('table1', '溪雨观 <?php  echo $store;?> 供货商统计月报表   <?php  echo date('Y年m月')?>', e.target.getAttribute('data-type'));
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