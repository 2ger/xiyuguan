<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>mp3</title>
</head>
<body>
<audio id="myaudio" src="<?php echo RES;?>/mobile/<?php  echo $this->cur_tpl?>/assets/neworder.mp3" controls="controls" playcount="1" hidden="false" autoplay="true">
</audio>
<script language="JavaScript">
function myrefresh()
{
		window.parent.location.reload();
}
setTimeout('myrefresh()',4000); //指定1秒 = 1000刷新一次
</script>

</body>
</html>

