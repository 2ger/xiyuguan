<?php

$sql =<<<EOF
DROP TABLE IF EXISTS `ims_weixin_awardlist`;
DROP TABLE IF EXISTS `ims_weixin_bahe_prize`;
DROP TABLE IF EXISTS `ims_weixin_bahe_team`;
DROP TABLE IF EXISTS `ims_weixin_cookie`;
DROP TABLE IF EXISTS `ims_weixin_flag`;
DROP TABLE IF EXISTS `ims_weixin_luckuser`;
DROP TABLE IF EXISTS `ims_weixin_mobile_manage`;
DROP TABLE IF EXISTS `ims_weixin_mobile_upload`;
DROP TABLE IF EXISTS `ims_weixin_modules`;
DROP TABLE IF EXISTS `ims_weixin_shake_data`;
DROP TABLE IF EXISTS `ims_weixin_shake_toshake`;
DROP TABLE IF EXISTS `ims_weixin_signs`;
DROP TABLE IF EXISTS `ims_weixin_vote`;
DROP TABLE IF EXISTS `ims_weixin_wall`;
DROP TABLE IF EXISTS `ims_weixin_wall_num`;
DROP TABLE IF EXISTS `ims_weixin_wall_reply`;
EOF;
pdo_run($sql);