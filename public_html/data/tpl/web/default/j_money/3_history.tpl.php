<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<script language="javascript" src="../addons/j_money/template/js/highcharts.js"></script> 
<script language="javascript" src="../addons/j_money/template/js/bootstrap-tooltip.js"></script> 
<script language="javascript" src="../addons/j_money/template/js/bootstrap-popover.js"></script> 
<script>
$(function () {
  $('[data-toggle="popover"]').popover();
})
</script>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('history', array('op' => 'display'))?>">收银记录</a></li>
  <li <?php  if($operation == 'card') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('history', array('op' => 'card'))?>">卡券记录</a></li>
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('history', array('op' => 'post'))?>">图表</a></li>
</ul>
<script>
require(['bootstrap'],function($){
	$('.btn,.tips').hover(function(){
		$(this).tooltip('show');
	},function(){
		$(this).tooltip('hide');
	});
});
</script> 
<?php  if($operation == 'card') { ?>
<div class="main">
  <form action="" class="form-horizontal form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="j_money" />
    <input type="hidden" name="do" value="history" />
    <input type="hidden" name="op" value="card" />
    <div class="panel panel-info">
      <div class="panel-body table-responsive">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9 form-inline"> <?php  echo tpl_form_field_daterange('search', array('start'=>$start,'end'=>$end),false)?>
            <input type="submit" class="btn btn-info" value="搜索"/>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">查询时间：<?php  echo $start?>-<?php  echo $end?></div>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th style="width:30px;">#</th>
              <th>标题</th>
              <th>副标题</th>
              <th>类型</th>
              <th>描述</th>
              <th>用/领</th>
              <th>使用率</th>
            </tr>
          </thead>
          <tbody>
          
          <?php  if(is_array($couponList)) { foreach($couponList as $row) { ?>
          <tr>
            <td></td>
            <td><?php  echo $row['title'];?></td>
            <td><?php  echo $row['sub_title'];?></td>
            <td><span class="label label-warning"><?php  echo $couponType[$row['type']]?></span> <span class="label label-default"><?php  echo $row['quantity'];?></span></td>
            <td> <?php  if($row['type']=="discount") { ?>
              <?php  echo $row['extra'];?>折
              <?php  } else if($row['type']=="cash") { ?>
              <?php  $extra=iunserializer($row['extra'])?>
              满<?php  echo $extra['least_cost']?>元减<?php  echo $extra['reduce_cost']?>元
              <?php  } else if($row['type']=="gift" || $row['type']=="groupon" || $row['type']=="general_coupon") { ?>
              <?php  echo $row['extra'];?>
              <?php  } ?> </td>
            <td><span class="label label-info"><?php  echo $recordary[$row['card_id']]['used']?></span> <span class="label label-primary"><?php  echo $recordary[$row['card_id']]['total']?></span></td>
            <td><span class="label label-info"><?php  echo sprintf('%.2f',($recordary[$row['card_id']]['used']/$recordary[$row['card_id']]['total']*100))?> %</span></td>
          </tr>
          <?php  } } ?>
            </tbody>
          
          <tr>
            <td colspan="5">合计</td>
            <td><span class="label label-info"><?php  echo $totalAll['"used"']?></span> <span class="label label-primary"><?php  echo $totalAll['"total"']?></span></td>
            <td><span class="label label-danger"><?php  echo sprintf('%.2f',($totalAll['"used"']/$totalAll['"total"']*100))?> %</span></td>
          </tr>
          <tr>
            <td colspan="7">5%以下效果不大，10%效果一般，20%有一定的效果，30%效果不错，40%以上效果非常好</td>
          </tr>
        </table>
      </div>
    </div>
  </form>
</div>
<script>

</script> 
<?php  } else if($operation == 'post') { ?>
<div class="main">
  <form action="" class="form-horizontal form">
    <input type="hidden" name="c" value="site" />
    <input type="hidden" name="a" value="entry" />
    <input type="hidden" name="m" value="j_money" />
    <input type="hidden" name="do" value="history" />
    <input type="hidden" name="op" value="post" />
    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    <div class="panel panel-info">
      <div class="panel-body table-responsive">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9 form-inline">
            <select name="groupid" id="groupid"  class="form-control" onChange="changeGroup(1)">
              <option value="0">全部团队</option>  
                  <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
              <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$_GPC['groupid']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                  <?php  } } ?>
            </select>
            <select name="userid" id="userid" class="form-control" onChange="changeGroup(2)">
              <option value="0">全部人员</option>
                <?php  if(is_array($userList)) { foreach($userList as $id => $val) { ?>
              <option value="<?php  echo $id;?>" <?php  if($id==$_GPC['userid']) { ?>selected<?php  } ?>><?php  echo $val;?></option>
                <?php  } } ?>
            </select>
            <?php  echo tpl_form_field_daterange('search', array('start'=>$start,'end'=>$end),false)?> </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9">
            <input type="submit" class="btn btn-info" value="搜索"/>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">情况分析</div>
      <div class="panel-body">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">解释</label>
          <div class="col-sm-9"> 【时间区间】建议为一周，一月。以月作为周期计算某个时间区间的数据有利于比较和筹划活动。<br/>
            【活动周期】建议1个月不多于2个活动。活动过多除了宣传周期短外，也让店面人员应接不暇。<br/>
            【平均客单价】某段时间内，客户愿意在此消费金额的客观反映。该数值反映此段时间经营的效果。注意：此数值必须建立在总消费金额和消费人数的比较上。<br/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">金额</label>
          <div class="col-sm-9"> <a href="#" class="btn btn-default">总金额：￥<?php  echo sprintf('%.2f',($totalary['total']*0.01))?>元</a> - <a href="#" class="btn btn-default">优惠金额：￥<?php  echo sprintf('%.2f',($totalary['coupon']*0.01))?>元</a> = <a href="#" class="btn btn-info">实收金额：￥<?php  echo sprintf('%.2f',($totalary['cash']*0.01))?>元</a>
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">客单价</label>
          <div class="col-sm-9"> <a href="#" class="btn btn-default">总金额：￥<?php  echo sprintf('%.2f',($totalary['total']*0.01))?>元</a> ÷ <a href="#" class="btn btn-default">消费人数：<?php  echo $totalary['num']?>人</a> = <a href="#" class="btn btn-info">平均客单价：￥<?php  echo sprintf('%.2f',($totalary['total']/$totalary['num']*0.01))?>元/单</a>
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">营销活动指导价格</label>
          <div class="col-sm-9"> <a href="#" class="btn btn-default">平均客单价：￥<?php  echo sprintf('%.2f',($totalary['total']/$totalary['num']*0.01))?>元/人</a> × <a href="#" class="btn btn-default">恒定基数：0.8(0.5-0.8间)</a> = <a href="#" class="btn btn-danger">营销活动价格：￥<?php  echo sprintf('%.2f',($totalary['total']/$totalary['num']*0.01*0.8))?>元</a>
            <div class="help-block">下次活动价格可以以上述价格作为参考，结合商品销售情况开展活动。</div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">收银情况</div>
      <div class="panel-body">
        <div id="container"></div>
      </div>
    </div>
  </form>
</div>
<script>
$(function () {
    $('#container').highcharts({
        chart: {},
        title: {text: '<?php  echo $start?>-<?php  echo $end?>总表'},
        xAxis: {categories: ['<?php  echo $dateary_str?>']},
        yAxis: {
            min: 0,
            title: {text: '单位-元'}
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} 元</b></td></tr>',
            footerFormat: '</table>',
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
			type: 'column', 
            name: '支付宝',
            data: [<?php  echo $fee_ali_str?>]
        }, {
			type: 'column', 
            name: '总收入',
            data: [<?php  echo $fee_total_str?>]
        }, {
			type: 'column',
            name: '微信',
            data: [<?php  echo $fee_wechat_str?>]
        },{                                                              
            type: 'spline',                                               
            name: '曲线值',                                              
            data: [<?php  echo $fee_total_str?>],                               
            marker: {                                                     
            	lineWidth: 2,                                               
            	lineColor: Highcharts.getOptions().colors[3],               
            	fillColor: 'white'                                          
            }                                                             
        }]
    });
});

</script> 
<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" class="form-horizontal form">
      <input type="hidden" name="c" value="site" />
      <input type="hidden" name="a" value="entry" />
      <input type="hidden" name="m" value="j_money" />
      <input type="hidden" name="do" value="history" />
      <input type="hidden" name="isexplode" id="isexplode" value="0" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      <div class="panel panel-info">
      <div class="panel-heading"><?php  if($_GPC['userid']) { ?>收银员：<b><?php  echo $userList[$_GPC['userid']]?></b>的收银记录<?php  } else { ?>总记录<?php  } ?></div>
      <div class="panel-body table-responsive">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
          <div class="col-sm-9 form-inline">
            <div class="input-group"> <span class="input-group-addon">关键字</span>
              <!-- <input type="text" name="keyword" class="form-control" value="<?php  echo $_GPC['keyword'];?>" /> -->
              <span class="input-group-btn">
              <input type="datetime-local" name="start" class="form-control">
              </span>
              <span class="input-group-btn">
                 <input type="datetime-local" name="end" class="form-control">
               </span>
              <span class="input-group-btn">
              <input type="submit" class="btn btn-info" value="搜索"/>
              </span> </div>
          </div>
          </div>
<!--           <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9 form-inline">
              <div class="input-group"> <span class="input-group-addon">筛选条件</span> <span class="input-group-btn">
                <select name="groupid" id="groupid"  class="form-control" onChange="changeGroup(1)">
                  <option value="0">全部团队</option>
                    <?php  if(is_array($grouplist)) { foreach($grouplist as $row) { ?>
                  <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$_GPC['groupid']) { ?>selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                    <?php  } } ?>
                </select>
                </span> <span class="input-group-btn">
                <select name="userid" id="userid" class="form-control" onChange="changeGroup(2)">
                  <option value="0">全部人员</option>
                    <?php  if(is_array($userList)) { foreach($userList as $id => $val) { ?>
                  <option value="<?php  echo $id;?>" <?php  if($id==$_GPC['userid']) { ?>selected<?php  } ?>><?php  echo $val;?></option>
                    <?php  } } ?>
                </select>
                </span> <span class="input-group-btn">
                <select name="year" class="form-control">
                  <option value="0">全部年份</option>
                  
                    <?php  if(is_array($year)) { foreach($year as $row) { ?>
                  
                  <option value="<?php  echo $row['y'];?>" <?php  if($row['y']==$_GPC['year']) { ?>selected<?php  } ?>><?php  echo $row['y'];?>年</option>
                  
                    <?php  } } ?>
                
                </select>
                </span> <span class="input-group-btn">
                <select name="month" class="form-control">
                  <option value="0">全部月份</option>
                  
                    <?php  if(is_array($month)) { foreach($month as $row) { ?>
                  
                  <option value="<?php  echo $row;?>" <?php  if($row==$_GPC['month']) { ?>selected<?php  } ?>><?php  echo $row;?>月</option>
                  
                    <?php  } } ?>
                
                </select>
                </span> <span class="input-group-btn">
                <select name="day" class="form-control">
                  <option value="0">全部日期</option>
                    <?php  if(is_array($day)) { foreach($day as $row) { ?>
                  <option value="<?php  echo $row;?>" <?php  if($row==$_GPC['day']) { ?>selected<?php  } ?>><?php  echo $row;?>号</option>
                    <?php  } } ?>
                </select>
                </span> 
              </div>
            </div>
             </div> -->
            <div class="form-group">
              <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
              <div class="col-sm-9 form-inline">
                <input type="submit" class="btn btn-danger" onClick="$('#isexplode').val(1)" name="explode" value="导出数据"/>
              </div>
            </div>
          
          <table class="table table-hover">
            <thead>
              <tr>
                <th>类型</th>
                <th>总金额</th>
                <th>优惠金额</th>
                <th>实收金额</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>微信</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['wechart']['all']/100))?>元 | <?php  echo $payAry['wechart']['all-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['wechart']['coupon']/100))?>元 | <?php  echo $payAry['wechart']['coupon-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['wechart']['cash_fee']/100))?>元 | <?php  echo $payAry['wechart']['cash_fee-count']?>笔</td>
              </tr>
              <tr>
                <td>支付宝</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['alipay']['all']/100))?>元 | <?php  echo $payAry['alipay']['all-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['alipay']['coupon']/100))?>元 | <?php  echo $payAry['alipay']['coupon-count']?>笔</td>
                <td>￥<?php  echo sprintf('%.2f',($payAry['alipay']['cash_fee']/100))?>元 | <?php  echo $payAry['alipay']['cash_fee-count']?>笔</td>
              </tr>
              <tr>
                  <td>美团</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['meituan']['all']/100))?>元 | <?php  echo $payAry['meituan']['all-count']?>笔</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['meituan']['coupon']/100))?>元 | <?php  echo $payAry['meituan']['coupon-count']?>笔</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['meituan']['cash_fee']/100))?>元 | <?php  echo $payAry['meituan']['cash_fee-count']?>笔</td>
                </tr>
                <tr>
                  <td>现金</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['xianjin']['all']/100))?>元 | <?php  echo $payAry['xianjin']['all-count']?>笔</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['xianjin']['coupon']/100))?>元 | <?php  echo $payAry['xianjin']['coupon-count']?>笔</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['xianjin']['cash_fee']/100))?>元 | <?php  echo $payAry['xianjin']['cash_fee-count']?>笔</td>
                </tr>
                <tr>
                  <td>刷卡</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['shuaka']['all']/100))?>元 | <?php  echo $payAry['shuaka']['all-count']?>笔</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['shuaka']['coupon']/100))?>元 | <?php  echo $payAry['shuaka']['coupon-count']?>笔</td>
                    <td>￥<?php  echo sprintf('%.2f',($payAry['shuaka']['cash_fee']/100))?>元 | <?php  echo $payAry['shuaka']['cash_fee-count']?>笔</td>
                </tr>
              <tr>
                <td><strong>合计</strong></td>
                <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['all']+$payAry['wechart']['all']+$payAry['meituan']['all']+$payAry['xianjin']['all']+$payAry['shuaka']['all'])/100))?>元 | <?php  echo $payAry['alipay']['all-count']+$payAry['wechart']['all-count']+$payAry['meituan']['all-count']+$payAry['xianjin']['all-count']+$payAry['shuaka']['all-count']?>笔</td>
                    <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['coupon']+$payAry['wechart']['coupon']+$payAry['meituan']['coupon']+$payAry['xianjin']['coupon']+$payAry['shuaka']['coupon'])/100))?>元 | <?php  echo $payAry['alipay']['coupon-count']+$payAry['wechart']['coupon-count']+$payAry['meituan']['coupon-count']+$payAry['xianjin']['coupon-count']+$payAry['shuaka']['coupon-count']?>笔</td>
                    <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['cash_fee']+$payAry['wechart']['cash_fee']+$payAry['meituan']['cash_fee']+$payAry['xianjin']['cash_fee']+$payAry['shuaka']['cash_fee'])/100))?>元 | <?php  echo $payAry['alipay']['cash_fee-count']+$payAry['wechart']['cash_fee-count']+$payAry['meituan']['cash_fee-count']+$payAry['xianjin']['cash_fee-count']+$payAry['shuaka']['cash_fee-count']?>笔</td>
                <!-- <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['all']+$payAry['wechart']['all'])/100))?>元 | <?php  echo $payAry['alipay']['all-count']+$payAry['wechart']['all-count']?>笔</td>
                <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['coupon']+$payAry['wechart']['coupon'])/100))?>元 | <?php  echo $payAry['alipay']['coupon-count']+$payAry['wechart']['coupon-count']?>笔</td>
                <td style="color:#F00">￥<?php  echo sprintf('%.2f',(($payAry['alipay']['cash_fee']+$payAry['wechart']['cash_fee'])/100))?>元 | <?php  echo $payAry['alipay']['cash_fee-count']+$payAry['wechart']['cash_fee-count']?>笔</td> -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:140px;">单号</th>
                <th>收银员</th>
                <th>订单金额</th>
                <th>优惠金额</th>
                <th>实际支付</th>
                <th>支付方式</th>
                <th>优惠方案</th>
                <th>状态|打印</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td> <?php  if($row['old_trade_no']) { ?><span class="label label-info" style="margin-bottom:2px;">原:<?php  echo $row['old_trade_no'];?></span><br>
                <?php  } ?> <span class="label label-success"><?php  echo $row['out_trade_no'];?></span></td>
              <td><?php  echo $userList[$row['userid']]?></td>
              <td>￥<?php  echo sprintf('%.2f',($row['total_fee']/100))?></td>
              <td>￥<?php  echo sprintf('%.2f',($row['coupon_fee']/100))?></td>
              <td>￥<?php  echo sprintf('%.2f',($row['cash_fee']/100))?></td>
              <td><?php  if($row['attach']=='-' || $row['attach']=='PC') { ?><span class="label label-info"><i class="fa fa-desktop"/></i></span><?php  } else { ?><span class="label label-danger"><i class="fa fa-mobile"/></i></span><?php  } ?>
              <?php  if($row['paytype']==0) { ?> <!-- <img src="<?php echo MODULE_URL;?>template/img/wechart.gif" width="21"/> -->微信 <?php  echo $data[$row['bank_type']]?><?php  } else if($row['paytype']==1) { ?>支付宝<?php  } else if($row['paytype']==2) { ?> 美团<?php  } else if($row['paytype']==3) { ?> 现金<?php  } else if($row['paytype']==4) { ?> 刷卡<?php  } ?>
              <!-- <?php  if($row['paytype']==0) { ?> <img src="<?php echo MODULE_URL;?>template/img/wechart.gif" width="21"/> <?php  echo $data[$row['bank_type']]?><?php  } else { ?> <img src="<?php echo MODULE_URL;?>template/img/alipay.gif" width="21"/> <?php  } ?> -->
              </td>
              <td><?php  echo $row['marketing_log'];?></td>
              <td><?php  if($row['status']==1) { ?> <span class="label label-success"><i class="fa fa-check"/></i></span> <?php  if($row['isprint']>0) { ?><a class="tips" href="javascript:" data-toggle="tooltip" data-placement="bottom" title="已打印<?php  echo $row['isprint'];?>份"><i class="fa fa-print"/></i></a><?php  } else { ?><a class="tips" href="javascript:" data-toggle="tooltip" data-placement="bottom" title="未打印" style="color:#F00"><i class="fa fa-print"/></i></a><?php  } ?>
                <?php  } else { ?> <span class="label label-danger" data-toggle="popover" data-placement="top" data-content="<?php  echo $row['log'];?>"><i class="fa fa-info"/></i></span><?php  } ?> </td>
              <td style="text-align:right"> <?php  if($row['log']) { ?><span class="label label-danger" data-toggle="popover" data-placement="left" data-content="<?php  echo $row['log'];?>"><i class="fa fa-exclamation-circle"/></i></span><?php  } ?>
                <?php  if($row['status']==1) { ?> <!--<a href="<?php  echo $this->createWebUrl('history', array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="退款"><i class="fa fa-edit"></i></a>--> <?php  } ?>
                <?php  if($row['status']==0) { ?> <a href="<?php  echo $this->createWebUrl('history', array('op' => 'delete', 'id' => $row['id']))?>" onClick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a> <?php  } ?> </td>
            </tr>
            <?php  } } ?>
            <tr>
            <tr>
              <td colspan="9" style="text-align:center"><?php  echo $pager;?></td>
            </tr>
            <tr>
              <td colspan="9"><a href="<?php  echo $this->createWebUrl('history',array('op'=>'clear'))?>" class="btn btn-danger">清空无效支付数据</a></td>
            </tr>
              </tbody>
            
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?> 
<script language="javascript">
function changeGroup(id){
	if(id==1){
		$("#userid").find("option[value='0']").prop("selected",true);
	}else{
		$("#groupid").find("option[value='0']").prop("selected",true);
	}
}
</script> 
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
