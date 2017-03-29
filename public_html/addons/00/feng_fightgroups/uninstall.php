<?php
global $_W;
$sql = "
drop table if exists " . tablename('tg_address') . " ;
drop table if exists " . tablename('tg_adv') . " ;
drop table if exists " . tablename('tg_arealimit') . " ;
drop table if exists " . tablename('tg_category') . " ;
drop table if exists " . tablename('tg_collect') . " ;
drop table if exists " . tablename('tg_dispatch') . " ;
drop table if exists " . tablename('tg_goods') . " ;
drop table if exists " . tablename('tg_goods_atlas') . " ;
drop table if exists " . tablename('tg_goods_option') . " ;
drop table if exists " . tablename('tg_goods_param') . " ;
drop table if exists " . tablename('tg_group') . " ;
drop table if exists " . tablename('tg_member') . " ;
drop table if exists " . tablename('tg_order') . "; 
drop table if exists " . tablename('tg_order_print') . " ;
drop table if exists " . tablename('tg_print') . " ;
drop table if exists " . tablename('tg_refund_record') . " ;
drop table if exists " . tablename('tg_spec') . " ;
drop table if exists " . tablename('tg_spec_item') . " ;
drop table if exists " . tablename('tg_saler') . " ;
drop table if exists " . tablename('tg_store') . " ;
drop table if exists " . tablename('tg_user') . " ;
drop table if exists " . tablename('tg_merchant') . " ;
drop table if exists " . tablename('tg_merchant_account') . " ;
drop table if exists " . tablename('tg_merchant_record') . " ;
";
pdo_query($sql);