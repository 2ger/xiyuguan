<?php defined('IN_IA') or exit('Access Denied');?><?php  $config = get_config();?>
<footer data-role="footer" id="footer_role">
	<nav class="nav_common">
		<ul class="box_nav">
	    <li>
				<a href="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=operalist&m=weisrc_dish">
					<!-- <span class="introx">&nbsp;</span> -->
				<label> 返回个人中心</label>
				</a>
			</li>
	<!-- 		<li class="more <?php  if($_GPC['do'] == 'list') { ?>on<?php  } ?>">
				<a href="<?php  echo $this->createMobileUrl('list', array('uid' => $_GPC['uid']));?>">
		  		 <label> 商品预订</label>
				</a>
			</li> -->
			<li class="more <?php  if($_GPC['do'] == 'myorders' || $_GPC['do'] == 'orderdetails') { ?>on<?php  } ?>">
				<a href="<?php  echo $this->createMobileUrl('myorders', array('uid' => $_GPC['uid']));?>">
				<label> 我的订单</label>
			</a>
			</li>
		
		</ul>
	</nav>
</footer>
<script src="../addons/str_takeout/template/resource/js/nav.js"></script>

