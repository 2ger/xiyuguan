<?php $this->load->view('header');?>
 
<script type="text/javascript">
var DOMAIN = document.domain;
var WDURL = "";
var SCHEME= "<?php echo sys_skin()?>";
try{
	document.domain = '<?php echo base_url()?>';
}catch(e){
}
//ctrl+F5 增加版本号来清空iframe的缓存的
$(document).keydown(function(event) {
	/* Act on the event */
	if(event.keyCode === 116 && event.ctrlKey){
		var defaultPage = Public.getDefaultPage();
		var href = defaultPage.location.href.split('?')[0] + '?';
		var params = Public.urlParam();
		params['version'] = Date.parse((new Date()));
		for(i in params){
			if(i && typeof i != 'function'){
				href += i + '=' + params[i] + '&';
			}
		}
		defaultPage.location.href = href;
		event.preventDefault();
	}
});
</script>



<link href="<?php echo base_url()?>statics/css/<?php echo sys_skin()?>/bills.css?ver=20150522" rel="stylesheet" type="text/css">
<style>
#barCodeInsert{margin-left: 10px;font-weight: 100;font-size: 12px;color: #fff;background-color: #B1B1B1;padding: 0 5px;border-radius: 2px;line-height: 19px;height: 20px;display: inline-block;}
#barCodeInsert.active{background-color: #23B317;}
</style>

<script type="text/javascript">
  $(document).ready(function(){
    $("#yesterday").click(function(){
      $("table[id^='content1']").show();
      $("table[id^='content2']").hide();
      $("table[id^='content3']").hide();
    });
    $("#lastweek").click(function(){
      $("table[id^='content1']").hide();
      $("table[id^='content2']").show();
      $("table[id^='content3']").hide();
    });
    $("#lastmonth").click(function(){
      $("table[id^='content1']").hide();
      $("table[id^='content2']").hide();
      $("table[id^='content3']").show();
    });
  });
</script>

</head>

<body>
<div class="wrapper">
  <span id="config" class="ui-icon ui-state-default ui-icon-config"></span>
  <div class="mod-toolbar-top mr0 cf dn" id="toolTop"></div>
  <div class="bills cf">
    <div class="con-header">
      <dl class="cf">
        <dd class="pct25">
          <label>客户:</label>
          <span class="ui-combo-wrap" id="customer">
          <input type="text" name="" class="input-txt" autocomplete="off" value="" data-ref="date">
          <i class="ui-icon-ellipsis"></i></span></dd>
        <dd id="identifier" class="pct20 tc">
          <label>销售人员:</label>
          <span class="ui-combo-wrap" id="sales">
              <input type="text" class="input-txt" autocomplete="off">
          <i class="trigger"></i></span>
        </dd>
        <dd class="pct20 tc">
        <label>单据日期:</label>
          <input type="text" id="date" onchange="choose_date()" class="ui-input ui-datepicker-input" value="2015-06-08">
<script type="text/javascript">

Date.prototype.Format = function (fmt) { //javascript时间日期函数
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
};
function choose_date(){
    var choose = document.getElementById('date').value;
var time1 = new Date().Format("yyyy-MM-dd");
    if(choose != time1){
    window.location.href="invSa?action=initSale&date="+choose;
}
}
</script>
        </dd>
        <dd id="identifier" class="pct20 tc">
          <label>单据编号:</label>
          <span id="number"><?php echo str_no('XS');?></span></dd>
        <!-- <dd id="classes" class="pct15 tr">
          <label class="radio">
            <input type="radio" name="classes" value="150601">
            销货</label>
          <label class="radio">
            <input type="radio" name="classes" value="150602">
            退货</label>
        </dd> -->
      </dl>
    </div>
    <div class="grid-wrap">
<div class="ui-jqgrid-hbox">
<button id="yesterday" type="button">昨天店面销售量参考</button>
<button id="lastweek" type="button">上周店面销售量参考</button>
<button id="lastmonth" type="button">上个月店面销售量参考</button>
<table width="100%" class="ui-jqgrid-btable" id="content1">
        <tr><td class='h' align="center" colspan="10"><h3>昨天店面销售量参考</h3></td></tr>
      </table>
    <table class="ui-jqgrid-btable" width="100%" border=1 cellspacing="0" cellpadding="0" id="content1">
      <thead>
        <tr class="ui-state-default ui-th-column ui-th-ltr">
            <th width=50 align=center class="ui-state-default ui-th-column ui-th-ltr">编号</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">名称</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">单价</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">单位</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">销量</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">转换【数量】</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">转换【销售单价】</th>
        </tr>
      </thead>
      <tbody>
         <?php 
          foreach($result as $arr=>$row) {
        ?>
        <tr class="ui-widget-content jqgrow ui-row-ltr selected-row">
          <td align=center ><?php echo $row['id']?></td>
          <td align=center ><?php echo $row['title']?></td>
          <td align=center ><?php echo $row['marketprice']?></td>
          <td align=center ><?php echo $row['unitname']?></td>
          <td align=center ><?php echo $row['count']['count']?></td>
          <td align=center ><?php echo (int) $row['count']['count']*(int) $row['productprice'] ?></td>
          <td align=center ><?php echo $row['marketprice']*$row['productprice'] ?></td>
        </tr>
        <?php }?>
 </tbody>
</table>
<!-- 按周计算 -->
<table width="100%" class="ui-jqgrid-btable" id="content2" style="display:none;">
        <tr><td class='h' align="center" colspan="10"><h3>上周店面销售量参考</h3></td></tr>
      </table>
    <table class="ui-jqgrid-btable" width="100%" border=1 cellspacing="0" cellpadding="0" id="content2" style="display:none;">
      <thead>
        <tr class="ui-state-default ui-th-column ui-th-ltr">
            <th width=50 align=center class="ui-state-default ui-th-column ui-th-ltr">编号</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">名称</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">单价</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">单位</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">销量</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">转换【数量】</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">转换【销售单价】</th>
        </tr>
      </thead>
      <tbody>
         <?php 
          foreach($result as $arr=>$row) {
        ?>
        <tr class="ui-widget-content jqgrow ui-row-ltr selected-row">
          <td align=center ><?php echo $row['id']?></td>
          <td align=center ><?php echo $row['title']?></td>
          <td align=center ><?php echo $row['marketprice']?></td>
          <td align=center ><?php echo $row['unitname']?></td>
          <td align=center ><?php echo $row['countweek']['count']?></td>
          <td align=center ><?php echo (int) $row['countweek']['count']*(int) $row['productprice'] ?></td>
          <td align=center ><?php echo $row['marketprice']*$row['productprice'] ?></td>
        </tr>
        <?php }?>
 </tbody>
</table>
<!-- 按月计算 -->
<table width="100%" class="ui-jqgrid-btable" id="content3" style="display:none;">
        <tr><td class='h' align="center" colspan="10"><h3>上个月店面销售量参考</h3></td></tr>
      </table>
    <table class="ui-jqgrid-btable" width="100%" border=1 cellspacing="0" cellpadding="0" id="content3" style="display:none;">
      <thead>
        <tr class="ui-state-default ui-th-column ui-th-ltr">
            <th width=50 align=center class="ui-state-default ui-th-column ui-th-ltr">编号</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">名称</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">单价</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">单位</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">销量</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">转换【数量】</th>
            <th class="ui-state-default ui-th-column ui-th-ltr">转换【销售单价】</th>
        </tr>
      </thead>
      <tbody>
         <?php 
          foreach($result as $arr=>$row) {
        ?>
        <tr class="ui-widget-content jqgrow ui-row-ltr selected-row">
          <td align=center ><?php echo $row['id']?></td>
          <td align=center ><?php echo $row['title']?></td>
          <td align=center ><?php echo $row['marketprice']?></td>
          <td align=center ><?php echo $row['unitname']?></td>
          <td align=center ><?php echo $row['countmonth']['count']?></td>
          <td align=center ><?php echo (int) $row['countmonth']['count']*(int) $row['productprice'] ?></td>
          <td align=center ><?php echo $row['marketprice']*$row['productprice'] ?></td>
        </tr>
        <?php }?>
 </tbody>
</table>

 </div>
<hr><br><br><br>


      <table id="grid">
      </table>
      <div id="page"></div>
    </div>
    <div class="con-footer cf">
      <div class="mb10">
        	<textarea type="text" id="note" class="ui-input ui-input-ph">暂无备注信息</textarea>
      </div>
      <ul id="amountArea" class="cf">
        <li>
          <label>优惠率:</label>
          <input type="text" id="discountRate" class="ui-input" data-ref="deduction">%
        </li>
        <li>
          <label>优惠金额:</label>
          <input type="text" id="deduction" class="ui-input" data-ref="payment">
        </li>
        <li>
          <label>优惠后金额:</label>
          <input type="text" id="discount" class="ui-input ui-input-dis" data-ref="discountRate" disabled>
        </li>
        <li>
          <label>客户承担费用:</label>
          <input type="text" id="customerFree" class="ui-input" data-ref="customerFree">
        </li>
        <li>
          <label id="paymentTxt">本次收款:</label>
          <input type="text" id="payment" class="ui-input">&emsp;
        </li>
        <li id="accountWrap" class="dn">
          <label>结算账户:</label>
          <span class="ui-combo-wrap" id="account" style="padding:0;">
          <input type="text" class="input-txt" autocomplete="off">
          <i class="trigger"></i></span><a id="accountInfo" class="ui-icon ui-icon-folder-open" style="display:none;"></a>
        </li>
        <li>
          <label>本次欠款:</label>
          <input type="text" id="arrears" class="ui-input ui-input-dis" disabled>
        </li>
        <li class="dn">
          <label>累计欠款:</label>
          <input type="text" id="totalArrears" class="ui-input ui-input-dis" disabled>
        </li>
      </ul>
      <ul class="c999 cf">
        <li>
          <label>制单人:</label>
          <span id="userName"></span>
        </li>
        <li>
          <label>审核人:</label>
          <span id="checkName"></span>
        </li>
		<li>
          <label>录单时间:</label>
          <span id="createTime"></span>
        </li>
        <li>
          <label>最后修改时间:</label>
          <span id="modifyTime"></span>
        </li>
      </ul>
    </div>
    <div class="cf" id="bottomField">
    	<div class="fr" id="toolBottom"></div>
    </div>
    <div id="mark"></div>
  </div>
  
  <div id="initCombo" class="dn">
    <input type="text" class="textbox goodsAuto" name="goods" autocomplete="off">
    <input type="text" class="textbox storageAuto" name="storage" autocomplete="off">
    <input type="text" class="textbox unitAuto" name="unit" autocomplete="off">
    <input type="text" class="textbox batchAuto" name="batch" autocomplete="off">
    <input type="text" class="textbox dateAuto" name="date" autocomplete="off">
    <input type="text" class="textbox priceAuto" name="price" autocomplete="off">
  </div>
  <div id="storageBox" class="shadow target_box dn">
  </div>
</div>
<script src="<?php echo base_url()?>statics/js/dist/sales.js?ver=20151022"></script>
</body>
</html>



