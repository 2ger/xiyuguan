<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('extendbtn', array('op' => 'post'))?>">添加扩展按钮</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('extendbtn', array('op' => 'display'))?>">管理扩展按钮</a></li>
</ul>
<script language="javascript">
require(['bootstrap'],function($){
	$('.btn').hover(function(){
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
      <div class="panel-heading"> 扩展按钮管理 </div>
      <div class="panel-body"> 
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">扩展按钮名称</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="btnname" class="form-control" value="<?php  echo $category['btnname'];?>" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
          <div class="col-sm-9">
            <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($category['status'] == 0) { ?> checked<?php  } ?> />
              关闭</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="1" <?php  if($category['status'] == 1) { ?> checked<?php  } ?> />
              开启</label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">按钮连接</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="btnurl" class="form-control" value="<?php  echo $category['btnurl'];?>" />
            <div class="help-block">本内容是a标签中的onClick=""内容。可使用"函数名()"的形式涉及到</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">JS文件</label>
          <div class="col-sm-9">
            <button type="button" class="btn btn-default" onClick="$('#jsurl').click()"><?php  if($category['jsurl']) { ?>已上传<?php  echo $category['jsurl'];?>-点击修改<?php  } else { ?>请上传JS文件<?php  } ?></button>
            <input type="hidden" name="jsurl2" value="<?php  echo $category['jsurl'];?>"/>
            <input type="file" name="jsurl" id="jsurl"  style="display:none;">
            <div class="help-block">延伸JS文件</div>
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
                <th>名称</th>
                <th>连接</th>
                <th>文件</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td><?php  echo $row['btnname'];?></td>
              <td><?php  echo $row['btnurl'];?></td>
              <td><?php  echo $row['jsurl'];?></td>
              <td style="text-align:right">
              <a href="<?php  echo $this->createWebUrl('extendbtn',array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('extendbtn',array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
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