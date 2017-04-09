<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<title>自动打印</title>
</head>
<body>
<script language="JavaScript">
function myrefresh()
{
       window.location.reload();
}
setTimeout('myrefresh()',10000); //指定1秒 = 1000刷新一次
</script>

自动打印
<?php  if(is_array($good)) { foreach($good as $item) { ?>
<iframe src="" frameborder="0" id="box<?php  echo $item['id'];?>"  name="box<?php  echo $item['id'];?>"></iframe>
<script>
     var url ="index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=printfei&m=j_money&goodsid="+<?php  echo $item['goodsid'];?>+"&tablesid="+<?php  echo $item['tablesid'];?>+"&total="+<?php  echo $item['total'];?>+"&id="+<?php  echo $item['id'];?>+"";
console.log(url);
window.open (url, "box<?php  echo $item['id'];?>", "height=600, width=400, toolbar=no, menubar=no, scrollbars=yes, resizable=no, location=no, status=no"); 
</script>
<?php  } } ?>
</body>
</html>