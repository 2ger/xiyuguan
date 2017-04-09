<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('daijin', array('op' => 'post'))?>">添加代金券</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('daijin', array('op' => 'display'))?>">管理代金券</a></li>
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
<?php  if($operation == 'post') { ?>
<div class="main">
  <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $id?>" />
    <div class="panel panel-default">
      <div class="panel-heading"> 折扣代金券管理</div>
      <div class="panel-body"> 
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">代金券标题</label>
          <div class="col-sm-9">
            <input type="text" value="<?php  echo $reply['title'];?>" class="form-control" name="title" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">代金券状态</label>
          <div class="col-sm-9">
            <label class="radio-inline">
              <input type="radio" name="status" value="1" <?php  if($reply['status']==1 or empty($reply['status'])) { ?> checked<?php  } ?> />
              开启</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($reply['status']==0) { ?> checked<?php  } ?> />
              关闭</label>
          </div>
        </div>

        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">金额</label>
          <div class="col-sm-9 form-inline"><input type="text" name="daijin" value="<?php  echo $reply['daijin'];?>">
            <div class="help-block">例：50</div>
          </div>
        </div>
        
      </div>
      </div>
    </div>
    <div class="form-group col-xs-12">
      <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return checkform();return false" />
      <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
  </form>
</div>
<style>
.awardrow input{ width:90px;}
.awardrow input.mtxt {width:60px;}
</style>

<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>代金券名称</th>
                <th>金额</th>
                <th>状态</th>
                <th>添加时间</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td><?php  echo $row['title'];?></td>
              <td><span class="label label-default"><?php  echo $row['daijin'];?></span></td>
              <td><?php  if($row['status']==1 ) { ?><span class="label label-success">开启</span><?php  } else { ?><span class="label label-default">关闭</span><?php  } ?></td>
              
              <td><span class="label label-default"><?php  echo date("Y-m-d H:i:s",$row['createtime'])?></span>
              </td>
              <td style="text-align:right">
              <a href="<?php  echo $this->createWebUrl('daijin',array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('daijin',array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php  } } ?>
            <tr>
              </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
