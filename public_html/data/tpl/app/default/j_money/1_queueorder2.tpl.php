<?php defined('IN_IA') or exit('Access Denied');?> <link rel="stylesheet" type="text/css" href="./resource/css/bootstrap.min.css"/>
<?php  if($operation == 'display') { ?>
<div class="main">
    <style>
        .header {
            line-height: 28px;
            margin-bottom: 16px;
            margin-top: 18px;
            padding-bottom: 4px;
            border-bottom: 1px solid #CCC
        }
        .block-gray{
            background-color: #555555;
            color: white;
        }
        .block-red{
            background-color: #ef4437;
            color: white;
        }
        .block-primary{
            background-color: #428bca;
            color: white;
        }
        .block-success{
            background-color: #5cb85c;
            color: white;
        }
        .block-orange{
            background-color: orange;
            color: white;
        }
        #guest-queue-index-body .queue_setting, #queue-setting-index-body .queue_setting {
            display: block;
            float: left;
            height: 100px;
            width: 31.3%;
            margin-right: 2%;
            margin-bottom: 20px;
            text-align: center
        }
        #queue-setting-index-body .queue_setting {
            width: 150px;
            height: 150px;
            border-radius: 1000px;
            margin-right: 20px
        }
        #guest-queue-index-body .queue_setting .name, #queue-setting-index-body .queue_setting .name{
            display: table-cell;
            font-size: 20px;
            font-weight: bold;
            line-height: 30px;
            vertical-align: middle;
            height: 60px
        }
        #queue-setting-index-body .queue_setting .name {
            height: 90px;
        }
        .table-display{
            display: table;
            width: 100%;
        }
    </style>
    <div class="panel panel-default">
        <!--/backend/shops/yezi/branches/20459/queue_settings/board-->
        <div class="panel-body">
            <div class="row">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="index.php?i=1&c=entry&op=display&do=queueorder2&m=j_money">客人队列</a>
                    </li>
                    <li>
                        <a href="index.php?i=1&c=entry&op=display&do=queuesetting2&m=j_money">队列设置</a>
                    </li>
                    <li>
                        <a href="index.php?i=1&c=entry&op=setting&do=queuesetting2&m=j_money">排号模式</a>
                    </li>
                </ul>
            </div>
            <div class="header">
                <h3>客人队列 列表</h3>
            </div>

        <div id="guest-queue-index-body">
            <?php  $itemindex = 1?>
            <?php  if(is_array($list)) { foreach($list as $item) { ?>
            <?php  if($itemindex%5==1) { ?><?php  $curcolor = 'block-gray';?><?php  } ?>
            <?php  if($itemindex%5==2) { ?><?php  $curcolor = 'block-red';?><?php  } ?>
            <?php  if($itemindex%5==3) { ?><?php  $curcolor = 'block-primary';?><?php  } ?>
            <?php  if($itemindex%5==4) { ?><?php  $curcolor = 'block-success';?><?php  } ?>
            <?php  if($itemindex%5==0) { ?><?php  $curcolor = 'block-orange';?><?php  } ?>
            <a class="<?php  echo $curcolor;?> queue_setting" href="index.php?i=1&c=entry&op=detail&do=queueorder2&storeid=<?php  echo $storeid;?>&queueid=<?php  echo $item['id'];?>&m=j_money">

                <div class="table-display">
                    <div class="name">当前排队人数：<?php  if($queue_count[$item['id']]['count']) { ?><?php  echo $queue_count[$item['id']]['count'];?><?php  } else { ?>0<?php  } ?></div>
                </div>
                <div class="table-display">
                    <div class="queue-enabled"><?php  echo $item['title'];?></div>
                </div>
            </a>
            <?php  $itemindex++;?>
            <?php  } } ?>
            <div class="clearfix"></div>
        </div>
        </div>
    </div>
</div>
<?php  } else if($operation == 'detail') { ?>
<style>
    .header {
        line-height: 28px;
        margin-bottom: 16px;
        margin-top: 18px;
        padding-bottom: 4px;
        border-bottom: 1px solid #CCC
    }
    .block-gray{
        background-color: #555555;
        color: white;
    }
    .block-red{
        background-color: #ef4437;
        color: white;
    }
    .block-primary{
        background-color: #428bca;
        color: white;
    }
    .block-success{
        background-color: #5cb85c;
        color: white;
    }
    .block-orange{
        background-color: orange;
        color: white;
    }
    #guest-queue-index-body .queue_setting, #queue-setting-index-body .queue_setting {
        display: block;
        float: left;
        height: 100px;
        width: 31.3%;
        margin-right: 2%;
        margin-bottom: 20px;
        text-align: center
    }
    #queue-setting-index-body .queue_setting {
        width: 150px;
        height: 150px;
        border-radius: 1000px;
        margin-right: 20px
    }
    #guest-queue-index-body .queue_setting .name, #queue-setting-index-body .queue_setting .name{
        display: table-cell;
        font-size: 20px;
        font-weight: bold;
        line-height: 30px;
        vertical-align: middle;
        height: 60px
    }
    #queue-setting-index-body .queue_setting .name {
        height: 90px;
    }
    .table-display{
        display: table;
        width: 100%;
    }
</style>
<div class="main">
    <div class="panel panel-default">
        <div class="table-responsive panel-body">
            <div class="row">
                <ul class="nav nav-pills" role="tablist">
                    <li class="active">
                        <a href="index.php?i=1&c=entry&op=display&do=queueorder2&m=j_money">客人队列</a>
                    </li>
                    <li>
                        <a href="index.php?i=1&c=entry&op=display&do=queuesetting2&m=j_money">队列设置</a>
                    </li>
                    <li>
                        <a href="index.php?i=1&c=entry&op=setting&do=queuesetting2&m=j_money">排号模式</a>
                    </li>
                </ul>
            </div>
            <div class="header">
                <h3>客人队列 列表</h3>
            </div>
            <div class="form-group">
                <a href="index.php?i=1&c=entry&op=detail&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&status=1&do=queueorder2&m=j_money" class="btn btn-sm btn-primary">
                    排队中
                </a>
                <a href="index.php?i=1&c=entry&op=detail&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&status=2&do=queueorder2&m=j_money" class="btn btn-sm btn-success">
                    已入号
                </a>
                <a href="index.php?i=1&c=entry&op=detail&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&status=-1&do=queueorder2&m=j_money" class="btn btn-sm btn-danger">
                    已取消
                </a>
                <a href="index.php?i=1&c=entry&op=detail&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&status=3&do=queueorder2&m=j_money" class="btn btn-sm btn-info">
                    已过号
                </a>
            </div>
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <td style="width:12%;">号码</td>
                        <td style="width:10%;">状态</td>
                        <td style="width:10%;">通知</td>
                        <td style="width:15%;">电话</td>
                        <td style="width:10%; text-align: center;">人数</td>
                        <td style="width:18%;">排队时间</td>
                        <td style="width:25%;text-align: center;">操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>
                        <td>
                            <?php  echo $item['num'];?>
                        </td>
                        <td>
                            <?php  if($item['status']==1) { ?>
                            <span class="label label-primary">排队中</span>
                            <?php  } else if($item['status']==2) { ?>
                            <span class="label label-success">已入号</span>
                            <?php  } else if($item['status']==3) { ?>
                            <span class="label label-info">已过号</span>
                            <?php  } else if($item['status']=-1) { ?>
                            <span class="label label-danger">已取消</span>
                            <?php  } ?>
                        </td>
                        <td>
                            <?php  if($item['isnotify']==1) { ?>
                            <span class="label label-success">已通知</span>
                            <?php  } else { ?>
                            <span class="label label-default">未通知</span>
                            <?php  } ?>
                        </td>
                        <td><?php  echo $item['mobile'];?></td>
                        <td style="text-align: center;">
                            <?php  echo $item['usercount'];?>
                        </td>
                        <td>
                            <?php  echo date('m-d H:i', $item['dateline'])?>
                        </td>
                        <td style="max-width:70px;text-align: center;">
                            <!-- <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=post&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&do=queueorder2&m=j_money" title="编辑">编辑</a> -->
                            <?php  if($item['status']==1) { ?>
                            <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=setstatus&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=2&do=queueorder2&m=j_money" title="接受" onclick="return confirm('确认操作吗？');return false;">接受</a>
                            <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=setstatus&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=3&do=queueorder2&m=j_money" title="过号" onclick="return confirm('确认操作吗？');return false;">过号</a>
                            <!-- <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=setstatus&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=-1&do=queueorder2&m=j_money" title="取消" onclick="return confirm('确认操作吗？');return false;">取消</a> -->
                            <?php  } else if($item['status']==2) { ?>
                            <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=setstatus&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=2&do=queueorder2&m=j_money" title="接受" onclick="return confirm('确认操作吗？');return false;">接受</a>
                            <a class="btn btn-warning btn-sm" href="index.php?i=1&c=entry&op=notice&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=2&do=queueorder2&m=j_money" title="通知" onclick="return confirm('确认操作吗？');return false;">通知</a>
                             
                             <?php  } else if($item['status']==-1) { ?>
                            <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=setstatus&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=2&do=queueorder2&m=j_money" title="接受" onclick="return confirm('确认操作吗？');return false;">接受</a>
                            
                            <?php  } else if($item['status']==3) { ?>
                            <a class="btn btn-default btn-sm" href="index.php?i=1&c=entry&op=setstatus&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=2&do=queueorder2&m=j_money" title="接受" onclick="return confirm('确认操作吗？');return false;">接受</a>
                             <?php  } ?>
                             <!-- <a class="btn btn-warning btn-sm" href="index.php?i=1&c=entry&op=notice&queueid=<?php  echo $queueid;?>&storeid=<?php  echo $storeid;?>&id=<?php  echo $item['id'];?>&status=2&do=queueorder2&m=j_money" title="通知" onclick="return confirm('确认操作吗？');return false;">通知</a> -->
                           
                           
                        </td>
                    </tr>
                    <?php  } } ?>
                    </tbody>
                    <tfoot>
                    <!--<tr>-->
                        <!--<td colspan="7">-->
                            <!--<input name="submit" type="submit" class="btn btn-primary" value="批量排序">-->
                            <!--<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />-->
                        <!--</td>-->
                    <!--</tr>-->
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    <?php  echo $pager;?>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $queueid;?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                编辑客人队列
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">号码</label>
                    <div class="col-sm-9">
                        <input type="text" name="num" class="form-control" value="<?php  echo $item['num'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9">
                        <input type="text" name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">客人数量</label>
                    <div class="col-sm-9">
                        <input type="text" name="usercount" class="form-control" value="<?php  echo $item['usercount'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="保存设置" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>