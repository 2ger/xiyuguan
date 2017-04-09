<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div style="padding:15px;">
  <p>(本次收集订单总数：<span class="redamount"><?php  echo $total;?></span>个)</p>
  <table class="table table-hover">
    <thead class="navbar-inner">
      <tr>
        <th>序号</th>
        <th>真实姓名</th>
        <th>电话</th>
        <th>预约技师</th>
        <th>预约时间</th>
        <th>处理状态</th>
        <th>操作</th>
  </tr>
</thead>
<?php  if(is_array($orders)) { foreach($orders as $item) { ?>
<tr>
  <td><?php  echo $item['id'];?></td>
  <td><?php  echo $item['truename'];?></td>
  <td><?php  echo $item['mobile'];?></td>
  <td><?php  echo $item['ser_name'];?></td>
  <td><?php  echo date('Y-m-d',$item['createtime'])?></td>
  <td><?php  if($item['isdel']) { ?>
  <span class="label label-danger">客户已取消</span>
  <?php  } else { ?>
  <?php  if($item['remate'] == '0') { ?>
  <span class="label label-warning">待回复</span>
  <?php  } else if($item['remate'] == '1') { ?>
  <span class="label label-primary">确认</span>
  <?php  } else if($item['remate'] == '2') { ?>
  <span class="label label-default">拒绝</span>
  <?php  } else if($item['remate']=='3') { ?>
  <span class="label label-success">完成</span>
  <?php  } ?>
  <?php  } ?>
  </td>
  <td>
    <a href="<?php  echo $this->createWebUrl('detail',array('id' => $item['id']))?>">详细</a>
    <!--<a href="<?php  echo $this->createWebUrl('orders',array('id' => $item['id'],'op' => 'delete'))?>">删除-->
    </a>
  </td>
</tr>
<?php  } } ?>
</table>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>