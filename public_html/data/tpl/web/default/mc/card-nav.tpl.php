<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
	<li <?php  if($do == 'notice') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/card/notice');?>">通知管理</a></li>
	<li <?php  if($do == 'credit') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/card/credit');?>">积分策略</a></li>
	<li <?php  if($do == 'recommend') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/card/recommend');?>">每日推荐</a></li>
	<li <?php  if($do == 'sign') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/card/sign');?>">签到列表</a></li>
</ul>