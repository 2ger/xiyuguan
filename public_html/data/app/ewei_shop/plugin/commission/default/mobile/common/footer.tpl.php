<?php defined('IN_IA') or exit('Access Denied');?><?php  if($show_footer) { ?>
<div style='height:80px;width:100%'></div>
<footer id="footer-nav">
                <ul class="menu-list">
                    <li><a href="<?php  echo $this->createMobileUrl('shop')?>"><i class="fa fa-home"></i><span>首页</span></a></li>
                    <li class='active'><a href="<?php  echo $this->createPluginMobileUrl('commission')?>"><i class="fa fa-users"></i><span>分销中心</span></a></li>
                    <li><a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><i class="fa fa-shopping-cart"></i><span>购物车</span></a></li>
                    <li><a href="<?php  echo $this->createMobileUrl('member')?>"><i class="fa fa-user"></i><span>会员中心</span></a></li>
                </ul>
</footer>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>