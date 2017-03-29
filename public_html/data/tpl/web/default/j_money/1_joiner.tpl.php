<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('joiner', array('op' => 'display','id'=>$id))?>">抽奖名单</a></li>
</ul>
<style>
.control-label{text-align:right;}
</style>
<?php  if($operation == 'display') { ?>
<div class="main">
  <form action="" method="get" class="form-horizontal form" enctype="multipart/form-data">
    <div class="panel panel-default">
      <input type="hidden" name="c" value="site" />
      <input type="hidden" name="a" value="entry" />
      <input type="hidden" name="do" value="joiner" />
      <input type="hidden" name="m" value="j_money" />
      <input type="hidden" name="id" value="<?php  echo $id;?>" />
      <div class="panel-heading"> 搜索 </div>
      <div class="panel-body">
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">个人信息</label>
          <div class="col-sm-9 form-inline">
          
          <input type="text" name="sncode" value="<?php  echo $_GPC['sncode'];?>" class="form-control" />
            <select name="prizeid" class="form-control">
            	<option value="0" >选择奖品</option>
            	<?php  if(is_array($prizelist)) { foreach($prizelist as $row) { ?>
            	<option value="<?php  echo $row['id'];?>"><?php  echo $row['level'];?></option>
                <?php  } } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">&nbsp;</label>
          <div class="col-sm-9">
            <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="main">
  <div class="category">
    <form action="" method="post" onsubmit="">
      <div class="panel panel-default">
      
      <div class="panel-heading">抽奖总次数：<?php  echo $alljoin;?> 中奖人次：<?php  echo $total;?></div>
        <div class="panel-body table-responsive">
          <table class="table table-hover" id="table-list">
            <thead>
              <tr>
                <th>#</th>
                <th>奖品名称</th>
                <th>兑奖码</th>
                <th>抽奖时间</th>
                <th>领奖时间</th>
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td class="row-first"><input type="checkbox" name="select[]" value="<?php  echo $row['id'];?>" /></td>
              <td><?php  echo $row['award'];?></td>
              <td><?php  if(!$row["prizetype"]) { ?><?php  echo $row['sncode'];?><?php  } ?></td>
              <td><span class="label label-default"><?php  echo date('Y-m-d G:i:s',$row['createtime']);?></span></td>
              <td><?php  if($row['gettime']) { ?><span class="label label-info"><?php  echo date('Y-m-d G:i:s',$row['gettime']);?></span><?php  } ?></td>
              <td style="text-align:right">
              <?php  if(!$row["prizetype"]) { ?>
              <?php  if($row['status']==0) { ?><a href="<?php  echo $this->createWebUrl('joiner', array('id' => $id, 'wid' => $row['id'], 'status' => 1))?>" class="btn btn-info">标记领奖</a><?php  } else if($row['status'] == 1) { ?><a href="<?php  echo $this->createWebUrl('joiner', array('id' => $id, 'wid' => $row['id'], 'status' => 0))?>" class="btn btn-default">取消领奖</a><?php  } ?><?php  } ?>
              
              </td>
            </tr>
            <?php  } } ?>
            <tr>
              <td style="width:60px;" class="row-first"><input type="checkbox" onclick="selectall(this)"/></td>
              <td colspan="5"><!--<input type="submit" onclick="return confirm('确认删除吗？');return false;" name="delete" value="删除" class="btn btn-primary" />-->
              <input type="submit" onclick="return confirm('全部标记为领奖吗？');return false;" name="getprize" value="标记领奖" class="btn btn-info" />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" /></td>
            </tr>
          </table>
        </div>
      </div>
    </form>
    <?php  echo $pager;?> </div>
</div>
<script>
function selectall(obj){
	if(obj.checked==true){
	   $("input[name^='select']").each(function(){
		  $(this).prop("checked",true);
	   });
	}else{
		$("input[name^='select']").each(function(){
		  $(this).prop("checked",false);
	    });
	}
}
</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 