<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  echo $this -> set_tabbar($action, $storeid);?>
<?php  if($operation == 'display') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/main.css"/>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <ul class="nav nav-pills" role="tablist">
                    <li>
                        <a href="<?php  echo $this->createWebUrl('materialzones', array('op' => 'display', 'storeid' => $storeid))?>">类型</a>
                    </li>
                    <li class="active">
                        <a href="<?php  echo $this->createWebUrl('materials', array('op' => 'display', 'storeid' => $storeid))?>">物资管理</a>
                    </li>
                </ul>
            </div>
            <div class="header">
                <h3>物资 列表</h3>
            </div>
            <div class="form-group">
                <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('materials', array('op' => 'display', 'storeid' => $storeid, 'type' => 'state'))?>"> 当前门店物资列表</a>
                <!-- <a class="btn btn-success btn-sm" href="<?php  echo $this->createWebUrl('materials', array('op' => 'display', 'storeid' => $storeid, 'type' => 'qrcode'))?>"><i class="fa fa-qrcode"></i> 二维码</a> -->
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('materials', array('op' => 'post', 'storeid' => $storeid))?>">新建 物资</a>
                <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('materials', array('op' => 'batch', 'storeid' => $storeid))?>">批量新建</a>
                <div class="form-group inline-form" style="display: inline-block;">
                    <form accept-charset="UTF-8" action="./index.php" class="form-inline" id="diandanbao/table_search" method="get" role="form">
                        <div style="margin:0;padding:0;display:inline">
                        <input name="utf8" type="hidden" value="✓"></div>
                        <input type="hidden" name="c" value="site" />
                        <input type="hidden" name="a" value="entry" />
                        <input type="hidden" name="m" value="weisrc_dish" />
                        <input type="hidden" name="do" value="materials" />
                        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
                        <div class="form-group">
                            <label class="sr-only" for="q_name">物资</label>
                            <input class="form-control" id="keyword" name="keyword" placeholder="物资" type="search">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="q_table_zone_id_eq">Table zone 等于</label>
                            <select id="tablezonesid" name="tablezonesid" class="form-control-excel">
                                <option value="">物资类型</option>
                                <?php  if(is_array($tablezones)) { foreach($tablezones as $row) { ?>
                                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tablezonesid'] || $row['id'] == $tablezonesid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                                <?php  } } ?>
                            </select>
                        </div>
                        <input class="btn btn-sm btn-success" name="commit" type="submit" value="搜索">
                        <!--<a class="btn btn-success btn-sm" data-remote="true" href="">批量导出物资二维码供打印(横版)</a>-->
                        <!--<a class="btn btn-primary btn-sm" data-remote="true" href="">批量导出物资二维码供打印(竖版)</a>-->
                    </form>
                </div>
            </div>
            <div id="queue-setting-index-body">
            <?php  if($type == 'state') { ?>
            <div class="table-state-tables">
                <div class="col-xs-12">
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                   
                    <div class="state-table" data-id="<?php  echo $item['id'];?>">
                      
                        <div class="name overflow-ellipsis">
                            <span> <a  href="<?php  echo $this->createWebUrl('materials', array('op' => 'detail', 'storeid' => $storeid, 'tablesid' => $item['id']))?>" ><?php  echo $item['title'];?></a></span>
                        </div>
                       <!--  添加数量、单位2016.10.26 -->
                        <div class="name overflow-ellipsis">
                            <?php  echo $item['number'];?><?php  echo $item['unit'];?>
                        </div>

                    </div>
                    <?php  } } ?>
                </div>
                <div class="col-xs-4">
                    <div class="table-order"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php  } else { ?>
            <div class="alert alert-success">
                将如下物资二维码打印并分别贴在对应物资上，即可实现扫码下单的功能。微信用户到店后只需拿起微信轻轻一扫，即可实现全自动点菜下单。
            </div>
            <div class="qr-code-table">
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <?php  if($item['status']==0) { ?>
                <?php  $status = 'idle';?>
                <?php  $title = '空闲';?>
                <?php  } else if($item['status']==1) { ?>
                <?php  $status = 'opened';?>
                <?php  $title = '已开台';?>
                <?php  } else if($item['status']==2) { ?>
                <?php  $status = 'ordered';?>
                <?php  $title = '已下单';?>
                <?php  } else if($item['status']==3) { ?>
                <?php  $status = 'paid';?>
                <?php  $title = '已支付';?>
                <?php  } ?>
                    <div class="qr-code-item">
                        <div class="qr-code-op">
                            <a data-rel="tooltip" href="<?php  echo $this->createWebUrl('materials', array('id' => $item['id'], 'storeid' => $storeid, 'op' => 'post'))?>" title="编辑"><icon class="fa fa-edit"></icon></a>
                            <a data-confirm="确定删除?" data-method="delete" data-rel="tooltip" href="<?php  echo $this->createWebUrl('materials', array('id' => $item['id'], 'storeid' => $storeid, 'op' => 'delete'))?>" onclick="return confirm('确认操作吗？');return false;" rel="nofollow" title="删除"><icon class="fa fa-trash-o"></icon></a>
                        </div>
                        <a href="<?php  echo $this->createWebUrl('materials', array('op' => 'detail', 'storeid' => $storeid, 'tablesid' => $item['id']))?>">
                            <div class="qr-code-box">
                                <div class="qr-code-item-image">
                                    <img alt="<?php  echo $item['title'];?>" src="<?php echo $this->fm_qrcode($_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&mode=1&storeid=' . $storeid . '&tablesid=' . $item['id'] . '&do=waplist&m=weisrc_dish', 'qrcode_' . $item['id'], '', $logo);?>" width="100%">
                                </div>
                                <div class="qr-code-item-info">
                                    <?php  echo $item['title'];?>
                                </div>
                            </div>
                            <div class="qr-code-item-footer">
                                扫描次数: <?php  if(empty($tablesorder[$item['id']]['count'])) { ?>0<?php  } else { ?><?php  echo $tablesorder[$item['id']]['count'];?><?php  } ?>
                                <br>
                                当前状态
                                :
                                <span class="label label-info"><?php  echo $title;?></span>
                                <br>
                                物资类型: <?php  echo $tablezones[$item['tablezonesid']]['title'];?>
                            </div>
                        </a>
                    </div>
                <?php  } } ?>
                <div class="space"></div>
                </div>
            <?php  } ?>
            <div class="clearfix"></div>
        </div>
        </div>
    </div>
</div>
<?php  } else if($operation == 'batch') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                批量创建物资
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">起始编号</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>"  placeholder=""/>
                        <span class="help-block">例如：C001</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格(元)</label>
                    <div class="col-sm-9">
                        <input type="number" name="user_count" class="form-control" value="<?php  echo $item['user_count'];?>" placeholder=""/>
                        <span class="help-block">
                            <!-- 设置为自动排号时，当排号客户的用餐人数少于等于此人数时，系统将自动为排号客户分配此队列 -->
                        </span>
                    </div>
                </div>
                <!-- 添加数量、单位2016.10.26 -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="number" name="numbers" class="form-control" value="<?php  echo $item['number'];?>" placeholder=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">单位</label>
                    <div class="col-sm-9">
                        <input type="text" name="unit" class="form-control" value="<?php  echo $item['unit'];?>" placeholder="张、个"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">物资类型</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="tablezonesid" autocomplete="off" class="form-control">
                            <?php  if(is_array($tablezones)) { foreach($tablezones as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tablezonesid'] || $row['id'] == $tablezonesid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">创建物资数量</label>
                    <div class="col-sm-9">
                        <input type="number" name="table_count" class="form-control" value="<?php  echo $item['table_count'];?>" placeholder=""/>
                        <span class="help-block">
                            根据创建的物资数量，系统会自动依据起始物资号依次递增,<br/> 例如C001, C002, C003, C004.....,一次最多创建10张物资
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="创建" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } else if($operation == 'post') { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <input type="hidden" name="storeid" value="<?php  echo $storeid;?>" />
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
        <div class="panel panel-default">
            <div class="panel-heading">
                物资 详情
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">物资</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>"  placeholder=""/>
                        <span class="help-block">例如：物资</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">价格(元)</label>
                    <div class="col-sm-9">
                        <input type="number" name="user_count" class="form-control" value="<?php  echo $item['user_count'];?>" placeholder=""/>
                        <span class="help-block">
                            物资估值
                        </span>
                    </div>
                </div>
                <!-- 添加数量、单位 2016.10.25 -->
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">数量</label>
                    <div class="col-sm-9">
                        <input type="number" name="numbers" class="form-control" value="<?php  echo $item['number'];?>" placeholder=""/>
                        <span class="help-block">
                            物资数量
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">单位</label>
                    <div class="col-sm-9">
                        <input type="text" name="unit" class="form-control" value="<?php  echo $item['unit'];?>" placeholder="张、个"/>
                        <span class="help-block">
                            物资单位
                        </span>
                    </div>
                </div>
                <!-- end -->

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">物资类型</label>
                    <div class="col-sm-9">
                        <select class="form-control" style="margin-right:15px;" name="tablezonesid" autocomplete="off" class="form-control">
                            <?php  if(is_array($tablezones)) { foreach($tablezones as $row) { ?>
                            <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['tablezonesid'] || $row['id'] == $tablezonesid) { ?> selected="selected"<?php  } ?>><?php  echo $row['title'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">排序</label>
                    <div class="col-sm-9">
                        <input type="text" name="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
        </div>
    </form>
</div>
<?php  } else if($operation == 'detail') { ?>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/main.css"/>
<div class="main">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="header">
                <h3>物资 详情</h3>
            </div>
            <div class="model-show">
                <p>
                    <b>
                        物资
                        :
                    </b>
                    <?php  echo $item['title'];?>
                </p>
                <p>
                    <b>
                        物资类型
                        :
                    </b>
                    <?php  echo $cate['title'];?>
                </p>
                <p>
                    <b>
                        价格(元)
                        :
                    </b>
                    <?php  echo $item['user_count'];?>
                </p>
                <p>
                    <b>
                        所属门店
                        :
                    </b>
                    <?php  echo $store['title'];?>
                </p>
                <!-- 添加数量、单位2016.10.26 -->
                <p>
                    <b>
                        数量(<?php  echo $item['unit'];?>)
                        :
                    </b>
                    <?php  echo $item['number'];?>
                </p>
                


                
                
                
                <div class="space"></div>
            </div>
           <div class="well">
            <a class="btn btn-primary btn-sm" href="<?php  echo $this->createWebUrl('materials', array('op' => 'post', 'storeid' => $storeid, 'id' => $tablesid))?>">编辑</a>
            <a class="btn btn-default btn-sm" href="<?php  echo $this->createWebUrl('materials', array('op' => 'display', 'storeid' => $storeid))?>">返回</a>
           </div> 
        </div>
    </div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>