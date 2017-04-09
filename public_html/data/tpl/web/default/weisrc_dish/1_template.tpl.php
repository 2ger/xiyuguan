<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('template', array('op' => 'display'))?>">模版管理</a></li>
</ul>
<?php  if($operation == 'display') { ?>
<style>
    .f-card {
        box-shadow: 0 1px 3px rgba(50, 50, 50, 0.5);
    }
    .u-listShow {
        width: 222px;
        border-radius: 6px;
        overflow: hidden;
        float: left;
        margin: 10px;
    }
    .u-listShow .item-top {
        position: relative;
        height: 327px;
        width: 222px;
        overflow: hidden;
    }
    .u-listShow .item-top img {
        height: 327px;
        width: 222px;
    }
    .u-listShow .item-bottom {
        position: relative;
    }
    .u-listShow .item-bottom .tit {
        position: relative;
        height: auto;
        padding: 10px 10px 0;
    }
    .u-listShow .item-bottom .tit h4 {
        width: 170px;
        height: 20px;
        line-height: 20px;
        padding-bottom: 0px;
        overflow: hidden;
        margin-top: 8px;
    }
    .u-listShow .item-bottom .tit h4 a {
        font-size: 16px;
        color: #333;
    }
    .u-listShow .item-bottom .con {
        position: relative;
        width: 100%;
        height: 40px;
        overflow: hidden;
        border-top: 1px solid #f4f4f4;
    }
    .u-listShow .item-bottom .con strong {
        position: absolute;
        top: 12px;
        right: 10px;
        display: block;
        width: 175px;
        text-align: right;
    }
    .u-listShow .item-bottom .con p {
        width: 140px;
        padding-left: 10px;
        padding-top: 12px;
        line-height: 14px;
    }

    .on{
        border: 3px #009CD6 solid;
    }
</style>
<div id="ListBox">
    <?php  if(is_array($templates)) { foreach($templates as $item) { ?>
    <div class="item">
        <div class="u-listShow f-card <?php  if($templatename == $item) { ?>on<?php  } ?>">
            <div class="item-top">
                <a href="" style="color: #000;"><img alt="默认风格" src="../addons/weisrc_dish/template/mobile/<?php  echo $item;?>/preview.jpg" onerror=""></a>
            </div>
            <div class="item-bottom s-bg-fff" style="">
                <div class="tit">
                    <h4 title="默认风格"><a href="<?php  echo $this->createWebUrl('template', array('templatename' => $item));?>">设为默认</a></h4>
                </div>

            </div>
        </div>
    </div>
    <?php  } } ?>
    <!--<div class="item">-->
        <!--<div class="u-listShow f-card">-->
            <!--<div class="item-top">-->
                <!--<a href="" style="color: #000;"><img alt="默认风格" src="../addons/weisrc_dish/template/mobile/style1/preview.jpg" onerror=""></a>-->
            <!--</div>-->
            <!--<div class="item-bottom s-bg-fff" style="">-->
                <!--<div class="tit">-->
                    <!--<h4 title="默认风格"><a href="">默认风格</a></h4>-->
                <!--</div>-->
                <!--<div class="con">-->
                    <!--<p>by 国度</p>-->
                    <!--<strong class="f-tr">不可删除</strong>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
</div>
<?php  } else { ?>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>


