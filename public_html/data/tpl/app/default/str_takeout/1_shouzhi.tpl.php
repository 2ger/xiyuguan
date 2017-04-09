<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>溪雨观 <?php  echo $store;?> 收支统计表报表  <?php  echo $year;?>年<?php  echo $month;?>月</title>
	<link rel="stylesheet" href="http://shanghai.xyj0772.com/web/resource/css/bootstrap.min.css">
</head>
<body>
	<center>
<a class="Noprint btn btn-success" onclick="window.history.back()">  返回  </a>
<a class="Noprint btn btn-success" onclick="print()">  打印  </a>
<div id="export">

		<a class="Noprint btn btn-success " data-type="xls" href="javascript:;">导出excel</a>

		<a class="Noprint btn btn-success " data-type="doc" href="javascript:;">导出word</a>

	</div>
	
	<h3>溪雨观 <?php  echo $store;?> 收支统计表报表  <?php  echo $year;?>年<?php  echo $month;?>月</h3>
	</center>
	<table class="table table-bordered" id="table1">
		<!-- 一行开始 -->
		<tr>
			<td>日期</td>
			<td>现金</td>
			<td>刷卡</td>
			<td>美团网</td>
			<td>微信</td>
			<td>支付宝</td>
			<td>闪惠</td>
			<td>总营业额</td>
			<td>自采</td>
			<td>费用</td>
			<td>房租</td> 
			<td>贷款</td> <!-- 自填 -->
			<td>税金</td> <!-- 自填 -->
			<td>调拨</td>
			<td>现金余额</td>
			<td>酒水</td>
			<td>供货商</td>
			<td>上月库存</td>
			<td>本月库存</td>
			<td>房租分摊</td> <!-- 自填 -->
			<td>利润</td>
	        <td>酒水进货</td>
		</tr>
		<!-- 一行结束 -->
		<!-- 一行开始 -->
		<?php  if(is_array($list)) { foreach($list as $index => $item) { ?>
		<tr>
		    <td><?php  echo $item['day'];?></td>
			<td><?php  echo round($item['money']['cash']['total']/100)?></td>
			<td><?php  echo round($item['money']['paycard']['total']/100)?></td>
			<td><?php  echo round($item['money']['meituan']['total']/100)?></td>
			<td><?php  echo round($item['money']['weixin']['total']/100)?></td>
			<td><?php  echo round($item['money']['alipay']['total']/100)?></td>
			<td><?php  echo round($item['money']['shanhui']['total']/100)?></td>
			<td><?php  echo round($item['money']['all']['total']/100)?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>	
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
			tableExport('table1', '溪雨观 <?php  echo $store;?> 收支统计表报表  <?php  echo $year;?>年<?php  echo $month;?>月', e.target.getAttribute('data-type'));
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