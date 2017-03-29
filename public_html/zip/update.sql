-- 0529
ALTER TABLE `ims_activity_coupon` 
add  `use_module` tinyint(3) unsigned NOT NULL;

ALTER TABLE `ims_core_wechats_attachment` 
 add `acid` int(10) unsigned NOT NULL,
 add `width` int(10) unsigned NOT NULL,
 add `height` int(10) unsigned NOT NULL,
 add `model` varchar(25) NOT NULL,
 add `tag` varchar(1000) NOT NULL;
 
ALTER TABLE `ims_modules` 
add  `iscard` tinyint(3) unsigned NOT NULL;