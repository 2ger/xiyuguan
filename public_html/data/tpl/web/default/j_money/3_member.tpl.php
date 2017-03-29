<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
  <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('member', array('op' => 'post'))?>">添加员工</a></li>
  <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('member', array('op' => 'display'))?>">管理员工</a></li>
  <li><a href="<?php  echo $this->createWebUrl('group', array('op' => 'display'))?>">组别设置</a></li>
</ul>
<script>
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
      <div class="panel-heading"> 员工管理 </div>
      <div class="panel-body"> 
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
          <div class="col-sm-9 form-inline">
             <label class="radio-inline">
              <input type="radio" name="status" value="0" <?php  if($item['status'] == 0 ) { ?>checked<?php  } ?> />
              离职</label>
            <label class="radio-inline">
              <input type="radio" name="status" value="1" <?php  if($item['status'] == 1|| empty($item['status'])) { ?>checked<?php  } ?> />
              在职</label>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">工号</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="useracount" maxlength="10" class="form-control" value="<?php  echo $item['useracount'];?>" <?php  if($id) { ?>disabled<?php  } ?>/>
            <div class="help-block">【提交后不可更改】工号的作用是用于登录使用，不能以0开头。如果工号前面有是0，请在前面加上字母如“A01”</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">输入密码</label>
          <div class="col-sm-9 col-xs-12">
            <input type="password" name="password" class="form-control" />
            <div class="help-block">不少于6位英文、数字、符号</div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">确认密码</label>
          <div class="col-sm-9 col-xs-12">
            <input type="password" name="password2" class="form-control" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属店面</label>
          <div class="col-sm-9 col-xs-12 form-inline">

            <select name="store" class="form-control">
            	<option value="0">请选择</option>
                <?php  if(is_array($stores)) { foreach($stores as $row) { ?>
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$item['storeid']) { ?> selected<?php  } ?>><?php  echo $row['title'];?></option>
                <?php  } } ?>
            </select>
            <div class="help-block">此内容可用于多门店，或者是不同地区收款时，作为统计时使用</div>
          </div>
        </div><div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">所属组别</label>
          <div class="col-sm-9 col-xs-12 form-inline">
            <select name="pcate" class="form-control">
            	<option value="0">请选择</option>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id']==$item['pcate']) { ?> selected<?php  } ?>><?php  echo $row['companyname'];?></option>
                <?php  } } ?>
            </select>
            <div class="help-block">此内容可用于多门店，或者是不同地区收款时，作为统计时使用</div>
          </div>
        </div>
        <div class="form-group hidden">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">openid</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="openid" class="form-control" value="<?php  echo $item['openid'];?>" />
            <div class="help-block">请在粉丝列表中查找-<a href="./index.php?c=mc&a=fans">粉丝列表</a></div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">姓名</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="name" class="form-control" value="<?php  echo $item['realname'];?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
          <div class="col-sm-9 col-xs-12">
            <input type="text" name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" />
            <div class="help-block"></div>
          </div>
        </div>
        <div class="form-group hidden">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">权限设置</label>
          <div class="col-sm-9 form-inline">
             <label class="radio-inline">
              <input type="checkbox" name="login_pc" value="1" checked <?php  if($item['login_pc'] == 1) { ?>checked<?php  } ?> />
              电脑端登录</label>
            <label class="radio-inline">
              <input type="checkbox" name="login_m" value="1" checked <?php  if($item['login_m'] == 1) { ?>checked<?php  } ?> />
              手机登陆</label>
          </div>
        </div>
        <!-- 可打折扣权限 -->
        <div class="form-group">
          <label class="col-xs-12 col-sm-3 col-md-2 control-label">折扣权限设置</label>
          <div class="col-sm-9 form-inline">
          <?php  if(is_array($discount1)) { foreach($discount1 as $items) { ?>
             <label class="radio-inline">
              <input type="checkbox" name="discount[]" checked value="<?php  echo $items['id'];?>">
              <?php  echo $items['title'];?> - <?php  echo $items['discount'];?>折
          </label>
          <?php  } } ?>
          <br>
          <?php  if(is_array($discount0)) { foreach($discount0 as $items) { ?>
             <label class="radio-inline">
              <input type="checkbox" name="discount[]" value="<?php  echo $items['id'];?>">
              <?php  echo $items['title'];?> - <?php  echo $items['discount'];?>折
          </label>
          <?php  } } ?>
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
<script type="text/javascript">
function checkform(){
	var temp=$("input[name='useracount']").val();
	if(!temp){
		alert("请填写工号，且不能是0");
		return false;
	}
	temp=$("input[name='password']").val();
	if(temp.length<6 && temp.length>0){
		alert("密码不能少于6位");
		return false;
	}
	var temp2=$("input[name='password2']").val();
	if(temp!=temp2 && temp.length>0){
		alert("两次输入的密码不一样");
		return false;
	}
	return true;
}
</script> 

<?php  } else if($operation == 'display') { ?>
<div class="main">
  <div class="category">
  <div class="panel panel-default">
        <div class="panel-body table-responsive">
    <?php  if(is_array($stores)) { foreach($stores as $item) { ?>

      <a href="index.php?c=site&a=entry&op=display&do=member&m=j_money&sid=<?php  echo $item['id'];?>">
       <?php  echo $item['id'];?> -  <?php  echo $item['title'];?>
      </a> |
     
    <?php  } } ?>
</div></div>
    <form action="" method="post" onsubmit="return formcheck(this)">
      <div class="panel panel-default">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:30px;">#</th>
                <th>店面</th>
                <th>分组</th>
                <th>姓名</th>
                <th>工号</th>
                <th>电话</th>
                <!-- <th>权限</th> -->
                <th>状态</th>
                <!-- <th>最后登录</th> -->
                <th style="text-align:right">操作</th>
              </tr>
            </thead>
            <tbody>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
              <td></td>
              <td><?php  echo $row['title'];?></td>
              <td><?php  echo $row['companyname'];?></td>
              <td><?php  echo $row['realname'];?></td>
              <td><?php  echo $row['useracount'];?></td>
              <td><?php  echo $row['mobile'];?></td>
              <!-- <td><?php  if($row['login_pc']) { ?><span class="label label-info">电脑端</span><?php  } ?> <?php  if($row['login_m']) { ?><span class="label label-info">手机端</span><?php  } ?></td> -->
              <td><?php  if($row['status']) { ?><span class="label label-info">在职</span><?php  } else { ?><span class="label label-default">已离职</span><?php  } ?></td>
              <!-- <td><?php  if($row['lasttime']) { ?><?php  echo date("Y-m-d H:i",$row["lasttime"])?><?php  } ?></td> -->
              <td style="text-align:right">
              <!-- <a href="<?php  echo $this->createWebUrl('history',array('userid' => $row['id']))?>" class="btn btn-info btn-sm" title="收款记录"><i class="fa fa-bar-chart-o"></i></a>&nbsp;&nbsp; -->
              <a href="<?php  echo $this->createWebUrl('member', array('op' => 'post', 'id' => $row['id']))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="编辑"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
              <a href="<?php  echo $this->createWebUrl('member', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确实删除吗？');return false;"  class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php  } } ?>
            <tr>
            <tr>
              <td></td>
              <td colspan="4"><a href="<?php  echo $this->createWebUrl('member', array('op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加人员</a></td>
            </tr>
              </tbody>
          </table>
        </div>
      </div>
    </form>
    <!-- 添加员工考勤2016.10.25 -->
 <!--    <div class="panel panel-default ">
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            
            <?php  if(is_array($list)) { foreach($list as $rows) { ?>
            <tr>
              <td width="10%"><?php  echo $rows['realname'];?></td>
              <td>上月：<span style="margin-right: 18px;">正常<span class="label label-success"><?php  echo $rows['normal']['normal'];?></span></span>
              <span style="margin-right: 18px;">黄色<span class="label label-warning"><?php  echo $rows['warning']['warning'];?></span></span>
              <span style="margin-right: 18px;">黑色<span class="label label-danger"><?php  echo $rows['punish']['punish'];?></span></span></td>
              <td>本月：<span style="margin-right: 18px;">正常<span class="label label-success"><?php  echo $rows['normals']['normal'];?></span></span>
              <span style="margin-right: 18px;">黄色<span class="label label-warning"><?php  echo $rows['warnings']['warning'];?></span></span>
              <span style="margin-right: 18px;">黑色<span class="label label-danger"><?php  echo $rows['punishs']['punish'];?></span></span></td>
            </tr>
            <?php  } } ?>
              
          </table>
        </div>
      </div> -->
  </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?> 
