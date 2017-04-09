<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  echo $this -> set_tabbar($action, $storeid);?>

<?php  if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">
                添加做法
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">做法</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value=""  placeholder=""/>
                        <span class="help-block">例如：微辣</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">说明</label>
                    <div class="col-sm-9">
                        <input type="text" name="detail" class="form-control" value="" placeholder=""/>
                        <span class="help-block">
                            做法说明
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
    <table class="table table-hover">
        <thead class="navbar-inner">
            <tr>
                <th style="width:35%;">做法</th>
                <th style="width:35%;">说明</th>
                <th style="width:30%;text-align: center;">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <tr>
                <td><?php  echo $row['name'];?></td>
                <td><?php  echo $row['detail'];?></td>
                <td style="max-width:70px;text-align: center;">
                <a class="btn btn-danger btn-sm" href="./index.php?c=site&a=entry&id=<?php  echo $row['id'];?>&do=taste&op=delete&m=weisrc_dish" onclick="return confirm('确认操作吗？');return false;" title="删除">删除</a>
                </td>
             </tr>
        <?php  } } ?>
        </tbody>
    </table>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>