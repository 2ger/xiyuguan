<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>微投票</title>
    <?php  echo register_jssdk();?>
    <link type="text/css" rel="stylesheet" href="../addons/ewei_vote/style/vote.css"/>
    <script type="text/javascript" src="../addons/ewei_vote/style/js/jquery.js"></script>
    <script type="text/javascript" src="../addons/ewei_vote/style/js/alert.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        // 微投票分享
        wx.ready(function () {
            sharedata = {
                title: "<?php  echo $sharetitle;?>",
                desc: "<?php  echo $sharedesc;?>",
                link: "<?php  echo $sharelink;?>",
                imgUrl: "<?php  echo $shareimg;?>"
            };
            wx.onMenuShareAppMessage(sharedata);
            wx.onMenuShareTimeline(sharedata);
        });

        var votetype = "<?php  echo $reply['votetype'];?>";
        function divClick(obj) {
            obj = $(obj);
            if (votetype == '0') {
                //单选
                $(".oimg").show();
                $(".oimg-sel").hide();
                $(".option").attr("sel", "false");
            }
            var sel = obj.attr("sel");
            if (sel == "false") {
                obj.attr("sel", "true");
                $(".oimg-sel", obj).show();
                $(".oimg", obj).hide();
            }
            else {
                obj.attr("sel", "false");
                $(".oimg-sel", obj).hide();
                $(".oimg", obj).show();
            }
        }
        function submit() {
            var ids = "";
            $(".option").each(function () {
                if ($(this).attr("sel") === "true") {
                    if (ids !== "") {
                        ids += ",";
                    }
                    ids += $(this).attr("val");
                }
            });
            if (ids == '') {
                alert('请选择投票选项!');
                return;
            }
            $.ajax({
                url: "<?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('submit', array('id' => $rid))?>",
                data: {
                    ids: ids,
                    id: "<?php  echo $rid;?>"
                },
                beforeSend: function () {
                    $(".submit").attr("disabled", "true");
                },
                success: function (data) {
                    if (data != '') {
                        alert(data);
                        return;
                    }
                    alert("投票成功!");
                    $(".submit").removeAttr("disabled");
                    setTimeout(function () {
                        location.href = "<?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('result', array('id' => $rid))?>";
                    }, 500);
                },
                error: function () {
                },
                timeout: 15000
            });
        }
    </script>
</head>
<body>
<div class="wrapper" style="margin-top:-8px;">
    <img class="bg" src="../addons/ewei_vote/style/images/bg.jpg">
    <input type='hidden' name='select_id'/>
    <div class="top fn-clear">
        <div class="title-cont">
            <p class="title"><?php  echo $reply['title'];?></p>
            <p class="timeout" style='padding-left:15px;'>
                <img class="clock" src="../addons/ewei_vote/style/images/clock.png">
                <span class="text"><?php  echo $limits;?></span>
            </p>
            <p>&nbsp;</p>
        </div>
    </div>
    <?php  if(!empty($reply['thumb'])) { ?>
    <div class="cover">
        <img class="line" src="../addons/ewei_vote/style/images/ctline.jpg">
        <img class="cimg" src="<?php  echo tomedia($reply['thumb'])?>">
        <img class="line" src="../addons/ewei_vote/style/images/cbline.jpg">
    </div>
    <?php  } ?>
    <?php  if($isshare == 1) { ?>
    <div class="summary">参与方法:</div>
    <div class="tip-cont"><?php  echo htmlspecialchars_decode($reply['share_txt'])?></div>
    <?php  } else { ?>
    <div class="summary"><?php  echo $reply['description'];?></div>
    <div class="tip-cont">
        <img class="icon" src="../addons/ewei_vote/style/images/tip_icon.png">
        投票后才能看到结果 ( <?php  echo $selects;?> <?php  if(!empty($reply['votetimes'])) { ?>),
        您还可以投票 <?php  echo $canvotetimes;?> 次<?php  } ?>
    </div>
    <div class="option-cont">
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <div class="option" val="<?php  echo $row['id'];?>" onclick="divClick(this)" sel="false">
            <?php  if(!empty($row['thumb']) && $reply['isimg']==1) { ?>
            <div>
                <image src="<?php  echo tomedia($row['thumb'])?>" style="width:95%;margin:10px;"/>
            </div>
            <?php  } ?>
            <img id="img<?php  echo $row['id'];?>" class="oimg" src="../addons/ewei_vote/style/images/checkimg.png">
            <img id="img<?php  echo $row['id'];?>_sel" class="oimg-sel" src="../addons/ewei_vote/style/images/checkimg_check.png">
            <div><?php  echo $row['title'];?></div>
        </div>
        <img class="sep" src="../addons/ewei_vote/style/images/option_sep.jpg">
        <?php  } } ?>
    </div>
    <div class="vote-cont">
        <div style="height: 10px;"></div>
        <img class="vote-btn" src="../addons/ewei_vote/style/images/vote.png" onclick="submit()"/>
        <div style="height: 10px;"></div>
    </div>
    <?php  } ?>
    <p class="page-url"></p>
</div>
</body>
</html>
