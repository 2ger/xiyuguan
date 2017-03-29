<?php
if(!pdo_fieldexists('tg_dispatch', 'merchantid')) {
	pdo_query("ALTER TABLE ".tablename('tg_dispatch')." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'sameprice')) {
  pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `sameprice` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '同地拼价格';");
}
if(!pdo_fieldexists('tg_goods', 'group_level')) {
	pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `group_level` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'group_level_status')) {
	pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `group_level_status` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'merchantid')) {
  pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'share_title')) {
  pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `share_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'share_image')) {
  pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `share_image` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'share_desc')) {
  pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `share_desc` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'one_limit')) {
	pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `one_limit` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'many_limit')) {
	pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `many_limit` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_goods', 'firstdiscount')) {
	pdo_query("ALTER TABLE ".tablename('tg_goods')." ADD `firstdiscount` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('tg_group', 'grouptype')) {
	pdo_query("ALTER TABLE ".tablename('tg_group')." ADD `grouptype` int(11) NOT NULL COMMENT '1同2异3普通4单';");
}
if(!pdo_fieldexists('tg_group', 'isshare')) {
	pdo_query("ALTER TABLE ".tablename('tg_group')." ADD `isshare` int(11) NOT NULL COMMENT '1分享2不分享';");
}
if(!pdo_fieldexists('tg_group', 'merchantid')) {
	pdo_query("ALTER TABLE ".tablename('tg_group')." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_group', 'price')) {
	pdo_query("ALTER TABLE ".tablename('tg_group')." ADD `price` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_member', 'mobile')) {
	pdo_query("ALTER TABLE ".tablename('tg_member')." ADD `mobile` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_order', 'goodspricetest')) {
	pdo_query("ALTER TABLE ".tablename('tg_order')." ADD `goodspricetest` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_order', 'merchantid')) {
	pdo_query("ALTER TABLE ".tablename('tg_order')." ADD `merchantid` int(11) NOT NULL");
}
if(!pdo_fieldexists('tg_order', 'optionname')) {
	pdo_query("ALTER TABLE ".tablename('tg_order')." ADD `optionname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
}
if(!pdo_fieldexists('tg_refund_record', 'merchantid')) {
	pdo_query("ALTER TABLE ".tablename('tg_refund_record')." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_saler', 'merchantid')) {
	pdo_query("ALTER TABLE ".tablename('tg_saler')." ADD `merchantid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('tg_store', 'merchantid')) {
	pdo_query("ALTER TABLE ".tablename('tg_store')." ADD `merchantid` int(11) NOT NULL;");
}
$sql = "
CREATE TABLE IF NOT EXISTS ".tablename('tg_merchant'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`name`  varchar(145) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`logo`  varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`industry`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`address`  varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`linkman_name`  varchar(145) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`linkman_mobile`  varchar(145) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`uniacid`  int(11) NOT NULL ,
`createtime`  varchar(115) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`thumb`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`detail`  varchar(1222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`salenum`  int(11) NOT NULL COMMENT '商家销量' ,
`open`  int(11) NOT NULL COMMENT '是否分配商家权限' ,
`uname`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`password`  varchar(145) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`uid`  int(11) NOT NULL COMMENT '用户id' ,
`messageopenid`  varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`openid`  varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`goodsnum`  int(11) NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0;

CREATE TABLE IF NOT EXISTS ".tablename('tg_merchant_account'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`merchantid`  int(11) NOT NULL COMMENT '商家ID' ,
`uniacid`  int(11) NOT NULL ,
`uid`  int(11) NOT NULL COMMENT '操作员id' ,
`amount`  decimal(10,2) NOT NULL COMMENT '交易总金额' ,
`updatetime`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '上次结算时间' ,
`no_money`  decimal(10,2) NOT NULL COMMENT '目前未结算金额' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0;

CREATE TABLE IF NOT EXISTS ".tablename('tg_merchant_record'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`merchantid`  int(11) NOT NULL COMMENT '商家id' ,
`money`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '本次结算金额' ,
`uid`  int(11) NOT NULL COMMENT '操作员id' ,
`createtime`  varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '结算时间' ,
`uniacid`  int(11) NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
CHECKSUM=0
ROW_FORMAT=Dynamic
DELAY_KEY_WRITE=0;
";
pdo_query($sql);

?>