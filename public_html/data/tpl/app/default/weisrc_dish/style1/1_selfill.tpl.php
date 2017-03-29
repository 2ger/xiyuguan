<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title> 成本自填表</title>
<link data-turbolinks-track="true" href="../addons/weisrc_dish/template//mobile/style1/assets/diandanbao/mui.min.css" media="all" rel="stylesheet">
<style>
html,
body {
    background-color: #efeff4;
}
.mui-views,
.mui-view,
.mui-pages,
.mui-page,
.mui-page-content {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    background-color: #efeff4;
}
.mui-pages {
    top: 46px;
    height: auto;
}
.mui-scroll-wrapper,
.mui-scroll {
    background-color: #efeff4;
}
.mui-page.mui-transitioning {
    -webkit-transition: -webkit-transform 300ms ease;
    transition: transform 300ms ease;
}
.mui-page-left {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
.mui-ios .mui-page-left {
    -webkit-transform: translate3d(-20%, 0, 0);
    transform: translate3d(-20%, 0, 0);
}
.mui-navbar {
    position: fixed;
    right: 0;
    left: 0;
    z-index: 10;
    height: 44px;
    background-color: #f7f7f8;
}
.mui-navbar .mui-bar {
    position: absolute;
    background: transparent;
    text-align: center;
}
.mui-android .mui-navbar-inner.mui-navbar-left {
    opacity: 0;
}
.mui-ios .mui-navbar-left .mui-left,
.mui-ios .mui-navbar-left .mui-center,
.mui-ios .mui-navbar-left .mui-right {
    opacity: 0;
}
.mui-navbar .mui-btn-nav {
    -webkit-transition: none;
    transition: none;
    -webkit-transition-duration: .0s;
    transition-duration: .0s;
}
.mui-navbar .mui-bar .mui-title {
    display: inline-block;
    width: auto;
}
.mui-page-shadow {
    position: absolute;
    right: 100%;
    top: 0;
    width: 16px;
    height: 100%;
    z-index: -1;
    content: '';
}
.mui-page-shadow {
    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
    background: linear-gradient(to right, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 10%, rgba(0, 0, 0, .01) 50%, rgba(0, 0, 0, .2) 100%);
}
.mui-navbar-inner.mui-transitioning,
.mui-navbar-inner .mui-transitioning {
    -webkit-transition: opacity 300ms ease, -webkit-transform 300ms ease;
    transition: opacity 300ms ease, transform 300ms ease;
}
.mui-pages .mui-page {
    display: block;
}
.mui-page .mui-table-view:first-child {
    margin-top: 60px;
}
.mui-page .mui-table-view:last-child {
    margin-bottom: 30px;
}
.mui-table-view {
    margin-top: 20px;
}

.mui-table-view span.mui-pull-right {
    color: #999;
}
.mui-table-view-divider {
    background-color: #efeff4;
    font-size: 14px;
}
.mui-table-view-divider:before,
.mui-table-view-divider:after {
    height: 0;
}
.head {
    height: 40px;
}
#head {
    line-height: 40px;
}
.head-img {
    width: 40px;
    height: 40px;
}
#head-img1 {
    position: absolute;
    bottom: 10px;
    right: 40px;
    width: 40px;
    height: 40px;
}
.update {
    font-style: normal;
    color: #999999;
    margin-right: -25px;
    font-size: 15px
}
.mui-fullscreen {
    position: fixed;
    z-index: 20;
    background-color: #000;
}
.mui-ios .mui-navbar .mui-bar .mui-title {
    position: static;
}
/*问题反馈在setting页面单独的css*/
#feedback .mui-popover{
    position: fixed;
}
#feedback .mui-table-view:last-child {
    margin-bottom: 0px;
}
#feedback .mui-table-view:first-child {
    margin-top: 0px;
}
.hidden{display:none}
<?php  echo $operalist;?>{display:block!important} 
</style>

</head>
<body>
<div id="setting" class="mui-page">
    <!--页面标题栏开始-->
    <div class="mui-navbar-inner mui-bar mui-bar-nav">
        <button type="button" class="mui-left mui-btn-positive mui-btn  mui-btn-nav mui-pull-left">
            <a href="<?php  echo $this->createMobileUrl('operalist', array(), true)?>"> 返回</a>
        </button>
        <h1 class="mui-center mui-title">成本自填表</h1>
        <button type="button" class="mui-right mui-action-back mui-btn  mui-btn-negative mui-btn-nav mui-pull-right">
            <a href="<?php  echo $this->createMobileUrl('logout', array(), true)?>"> 退出</a>
        </button>
    </div>
    <!--页面标题栏结束-->
    <!--页面主内容区开始-->
    <div class="mui-page-content">
        <div class="">
            <div class="mui-scroll">
                <div class="mui-table-view mui-table-view-chevron"></div>
                <style>
                    .bgred{
                        background-color: #d64c28;
                        color: #fff;
                    }
                    table {
                        display: table;
                        border-spacing: 2px;
                    }
                    table.dataintable {
                        margin-top: 10px;
                        border-collapse: collapse;
                        border: 1px solid #aaa;
                        width: 100%;
                    }
                    table,tr{
                        height: 50px;
                        border-bottom: 1px solid #ddd;
                        text-align:center;
                        line-height: 30px;
                    }
                   /* table,td{
                        width: 33%;
                    }*/
                </style>
                <div class="mui-table-view">
                <form method="POST" action="">
                    <table class="dataintable">
                            <tr>
                                <td colspan="3" ><input type="date" name="time" value="<?php  echo $time;?>"></td>
                            </tr>
                            <tr>
                                <td width="14%">日期</td>
                                <td width="43%">明细</td>
                                <td width="43%">支出</td>
                            </tr> 
                            <tr id="1">
                                <td>1</td>
                                <td><input type="text" name="list[1]" value="工资"></td>
                                <td><input type="text" name="power[1]" id="power1" class='ll'  value="0"></td>
                            </tr> 
                            <tr id="2">
                                <td>2</td>
                                <td><input type="text" name="list[2]" value="水费"></td>
                                <td><input type="text" name="power[2]" id="power2" class='ll' value="0"></td>
                            </tr>
                            <tr id="3">
                                <td>3</td>
                                <td><input type="text" name="list[3]" value="电费"></td>
                                <td><input type="text" name="power[3]" id="power3" class='ll' value="0"></td>
                            </tr>
                            <tr id="4">
                                <td>4</td>
                                <td><input type="text" name="list[4]" value="房租"></td>
                                <td><input type="text" name="power[4]" id="power4" class='ll' value="0"></td>
                            </tr>
                            <tr id="5">
                                <td>5</td>
                                <td><input type="text" name="list[5]" value="宿舍费用"></td>
                                <td><input type="text" name="power[5]" id="power5" class='ll' value="0"></td>
                            </tr>
                            <tr id="6">
                                <td>6</td>
                                <td><input type="text" name="list[6]" value="电话及网络费"></td>
                                <td><input type="text" name="power[6]" id="power6" class='ll' value="0"></td>
                            </tr>
                            <tr id="7">
                                <td>7</td>
                                <td><input type="text" name="list[7]" value="低易及厨具"></td>
                                <td><input type="text" name="power[7]" id="power7" class='ll' value="0"></td>
                            </tr>
                            <tr id="8">
                                <td>8</td>
                                <td><input type="text" name="list[8]" value="维修"></td>
                                <td><input type="text" name="power[8]" id="power8" class='ll' value="0"></td>
                            </tr>
                            <tr id="7">
                                <td>7</td>
                                <td><input type="text" name="list[7]" value="总部"></td>
                                <td><input type="text" name="power[7]" id="power7" class='ll' value="0"></td>
                            </tr>
                            <tr id="8">
                                <td>8</td>
                                <td><input type="text" name="list[8]" value="刷卡银行手续费"></td>
                                <td><input type="text" name="power[8]" id="power8" class='ll' value="0"></td>
                            </tr>
                            <tr id="9">
                                <td>9</td>
                                <td><input type="text" name="list[9]" value="折扣费"></td>
                                <td><input type="text" name="power[9]" id="power9" class='ll' value="0"></td>
                            </tr>
                            <tr id="10">
                                <td>10</td>
                                <td><input type="text" name="list[10]" value="职工餐"></td>
                                <td><input type="text" name="power[10]" id="power10" class='ll' value="0"></td>
                            </tr>
                            <tr id="11">
                                <td>11</td>
                                <td><input type="text" name="list[11]" value="其它"></td>
                                <td><input type="text" name="power[11]" id="power11" class='ll' value="0"></td>
                            </tr>
                            <tr id="12">
                                <td>12</td>
                                <td><input type="text" name="list[12]" value="广告菜单复印"></td>
                                <td><input type="text" name="power[12]" id="power12" class='ll' value="0"></td>
                            </tr>
                            <tr id="13">
                                <td>13</td>
                                <td><input type="text" name="list[13]" value="纯水"></td>
                                <td><input type="text" name="power[13]" id="power13" class='ll' value="0"></td>
                            </tr>
                            <tr id="14">
                                <td>14</td>
                                <td><input type="text" name="list[14]" value="办公财务费用"></td>
                                <td><input type="text" name="power[14]" id="power14" class='ll' value="0"></td>
                            </tr>
                            <tr id="15">
                                <td>15</td>
                                <td><input type="text" name="list[15]" value="业务费及香烟"></td>
                                <td><input type="text" name="power[15]" id="power15" class='ll' value="0"></td>
                            </tr>
                            <tr id="15">
                                <td>15</td>
                                <td><input type="text" name="list[15]" value="福利费"></td>
                                <td><input type="text" name="power[15]" id="power15" class='ll' value="0"></td>
                            </tr>

                            <tr id="16">
                                <td>16</td>
                                <td><input type="text" name="list[16]" value="清运费清洁干洗"></td>
                                <td><input type="text" name="power[16]" id="power16" class='ll' value="0"></td>
                            </tr>
                            <tr id="16">
                                <td>16</td>
                                <td><input type="text" name="list[16]" value="绿化装饰"></td>
                                <td><input type="text" name="power[16]" id="power16" class='ll' value="0"></td>
                            </tr>
                            <tr id="16">
                                <td>16</td>
                                <td><input type="text" name="list[16]" value="服装鞋帽化妆费"></td>
                                <td><input type="text" name="power[16]" id="power16" class='ll' value="0"></td>
                            </tr>

                            <tbody id="add">

                            </tbody>
                            <tr>
                                <td colspan="3"><a class="mui-btn mui-btn-primary" id="addtr">＋</a></td>
                            </tr>
                            <tr >
                                <td colspan="2" >总额:￥<span id="money">0.00</span></td>
                                <input type="hidden" name="count" id="count" value="">
                                <td><input class="mui-btn" type="submit" name="submit" value="提交"></td>
                            </tr> 
                            <span id="n" style="display: none;">2</span>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        var i=parseInt($('#n').html());
        $('#addtr').click(function (){
            i = i+1;
            var html="<tr id="+i+"><td>"+i+"</td><td><input type=text name='list["+i+"]'></td><td><input type=text name='power["+i+"]' id='power"+i+"' class='ll'  value='0'></td></tr>";

            $('#add').append(html);
            // $('#power'+i).focus();
            $('#n').text(i);
        });
        // console.log(i);
    </script>
    <script type="text/javascript">
    // var j = parseInt($('#n').text());
    $('body').on("keyup","input",function(){
        var input = $('.ll');
        var money = 0;
        console.log(input.length);
        for(var i=0;i<input.length;i++){ 
            money = money + parseFloat($('.ll:eq('+i+')').val());
        }
        $('#money').text(money);
        $('#count').val(money);
        console.log(money);
    })
    </script>
    <!--页面主内容区结束-->
</div>

</body>
</html>
