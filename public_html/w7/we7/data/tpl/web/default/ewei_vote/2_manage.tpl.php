<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <ul class="nav nav-tabs">
        <li<?php  if($_GPC['do'] == 'manage' || $_GPC['do'] == '' ) { ?> class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('manage');?>">微投票管理</a></li>
        <li<?php  if($_GPC['do'] == 'post') { ?> class="active"<?php  } ?>><a href="<?php  echo url('platform/reply/post',array('m'=>'ewei_vote'));?>">添加微投票规则</a></li>
    </ul>
    <div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
        	<input type="hidden" name="m" value="ewei_vote" />
        	<input type="hidden" name="do" value="manage" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
				<div class="col-sm-8 col-lg-9 col-xs-12">
					<input class="form-control" name="keywords" id="" type="text" value="<?php  echo $_GPC['keywords'];?>">
				</div>
                <div class=" col-xs-12 col-sm-2 col-lg-2">
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
					<th></th>
                    <th width="10%">活动名称</th>
                    <th width="10%">投票人数</th>
                    <th width="10%">总浏览数</th>
                    <th width="35%">投票限制</th>
                    <th width="10%">状态</th>
                    <th width="20%">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <tr>
                    <td class="with-checkbox">
                        <input type="checkbox" name="check" value="<?php  echo $row['id'];?>">
					</td>
                    <td><?php  echo $row['title'];?> </td>
                    <td><?php  echo $row['votenum'];?></td>
                    <td><?php  echo $row['viewnum'];?></td>
                    <td><?php  echo $row['limits'];?></td>
                    <td><?php  echo $row['status'];?></td>
                    <td >
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" href="<?php  echo url('platform/reply/post',array('m'=>'ewei_vote','rid'=>$row['id']));?>" title="编辑"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" href="<?php  echo $this->createWebUrl('votelist',array('id' => $row['id']))?>" title="投票名单"><i class="fa fa-list-alt"></i></a>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" href="<?php  echo $this->createWebUrl('result',array('op' => 'list', 'id' => $row['id']))?>" title="投票结果"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span></i></a>
                        <?php  if($row['show']==1) { ?>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="开始投票" href="#" onclick="drop_confirm('您确定要开始吗,设置中途可以随时修改!', '<?php  echo $this->createWebUrl('status',array('rid'=>$row['id'],'status'=>1))?>');"><i class="fa fa-play"></i></a>
                        <?php  } else if($row['show']==2) { ?>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="结束投票" href="#" onclick="drop_confirm('您确定要暂停吗,设置中途可以随时修改!', '<?php  echo $this->createWebUrl('status',array('rid'=>$row['id'],'status'=>0))?>');"><i class="fa fa-stop"></i></a>
                        <?php  } ?>
                        <a class="btn btn-default" data-toggle="tooltip" data-placement="bottom" href="#" onclick="drop_confirm('您确定要删除吗?', '<?php  echo $this->createWebUrl('delete',array('rid'=>$row['id']))?>');" title="删除"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>
                <?php  } } ?>
                <tr>
					<td><input type="checkbox" class="check_all" /></td>
                    <td colspan="6">
                        <input type="button" class="btn btn-primary" name="deleteall" value="删除选择的" />
                    </td>
                </tr>
            </tbody>
        </table>
	</div>
  </div>
	<?php  echo $pager;?>
</div>
<script>
	require(['bootstrap'],function($){
		$('.btn').tooltip();
	});
	$(function(){
		$(".check_all").click(function(){
			var checked = $(this).get(0).checked;
			$(':checkbox').each(function(){this.checked = checked});
		});
		$("input[name=deleteall]").click(function(){

			var check = $("input:checked");
			if (check.length < 1){
				err('请选择要删除的记录!');
				return false;
			}
			if (confirm("确认要删除选择的记录?")){
				var id = new Array();
				check.each(function(i){
					id[i] = $(this).val();
				});
				$.post('<?php  echo $this->createWebUrl("deleteAll")?>', {idArr:id}, function(data){
					if (data.errno == 0)
					{
						location.reload();
					} else {
						alert(data.error);
					}
				}, 'json');
			}
		});
    });
</script>
<script>
	function drop_confirm(msg, url){
		if (confirm(msg)){
			window.location = url;
		}
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>