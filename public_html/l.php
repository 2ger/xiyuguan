<?php
echo header("Access-Control-Allow-Origin:*");
?>
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
<title>phpStudy phpinfo</title>
 </head>
 <body>
<div class="center">
<table border="0" cellpadding="3" width="600">
<tr class="h"><td>
<a href="http://www.phpStudy.net/" target="_blank"><img border="0" height="32" src="http://www.phpstudy.net/php.gif" alt="phpStudy" /></a><h1 class="p">phpStudy phpinfo</h1>
</td></tr>
</table>
</div><br>
<script>
$.ajax({ 
data:{
    "student_pk":"9E1D5973-002D-4F92-9BBE-10FD49A70E02",
},
    type: "post", 
        url: "http://b00d.cn/info/getdata.aspx?com=get_student_info", 
        dataType: "json", 
        success: function (data) { 
            $("input#showTime").val(data[0].demoData); 
 }, 
 error: function (XMLHttpRequest, textStatus, errorThrown) { 
                                                alert(errorThrown); 
                                        } 
                                });
</script>
<input id="showTime" type="text"></input>
 <div class="center">
 <h2>phpStudy 2013</h2>
<table border="0" cellpadding="3" width="600">
<tr class="v"><td>
<p>　　phpStudy集成最新的Apache+Nginx+IIS+Lighttpd+PHP+MySQL+phpMyAdmin+SQL-Front+Zend Loader，一次性安装，无须配置即可使用，是非常方便、好用的PHP调试环境。该程序绿色小巧简易迷你，有专门的控制面板。总之学习PHP只需一个包。</p>
<p>　　对学习PHP的新手来说，WINDOWS下环境配置是一件很困难的事；对老手来说也是一件烦琐的事。因此无论你是新手还是老手，该程序包都是一个不错的选择。
</p>
<p>　　本程序纯绿色使用完全免费，自由复制传播。版权所有 <a href="http://www.phpstudy.net/" target="_blank">www.phpstudy.net</a></p>
</td></tr>
</table>
 </div>
</body></html>
