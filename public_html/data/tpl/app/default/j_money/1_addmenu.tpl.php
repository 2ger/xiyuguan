<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>后台下单-速配外卖 - </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="shortcut icon" href="http://o2o.xyj0772.com/attachment/images/global/wechat.jpg" />
<link href="http://o2o.xyj0772.com/web/resource/css/bootstrap.min.css" rel="stylesheet">
<link href="http://o2o.xyj0772.com/web/resource/css/font-awesome.min.css" rel="stylesheet">
<link href="http://o2o.xyj0772.com/web/resource/css/common.css" rel="stylesheet">
<link rel="stylesheet" href="http://o2o.xyj0772.com/addons/we7_wmall/resource/web/css/back.css">
<script>var require = {urlArgs: 'v=2017022410' };</script>
<script src="http://o2o.xyj0772.com/web/resource/js/lib/jquery-1.11.1.min.js"></script>
<script src="http://o2o.xyj0772.com/web/resource/js/app/util.js"></script>
<script src="http://o2o.xyj0772.com/web/resource/js/require.js"></script>
<script src="http://o2o.xyj0772.com/web/resource/js/app/config.js"></script>
<!--[if lt IE 9]>
        <script src="http://o2o.xyj0772.com/web/resource/js/html5shiv.min.js"></script>
        <script src="http://o2o.xyj0772.com/web/resource/js/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
if(navigator.appName == 'Microsoft Internet Explorer'){
    if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
        alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
    }
}

window.sysinfo = {
    'uniacid': '2',
    'acid': '2',
    'uid': '1',
    'siteroot': 'http://o2o.xyj0772.com/',
    'siteurl': 'http://o2o.xyj0772.com/web/index.php?c=site&a=entry&do=place&m=we7_wmall',
    'attachurl': 'http://o2o.xyj0772.com/attachment/',
    'attachurl_local': 'http://o2o.xyj0772.com/attachment/',
    'attachurl_remote': '',
    'MODULE_URL': 'http://o2o.xyj0772.com/addons/we7_wmall/',
    'cookie' : {'pre': '2a90_'}
};
</script>
<style>
#placeOrder .goods-content .goods-item .goods-block span {
    font-size: 8px;
    line-height: 13px;
}
.form-control{padding:0}
</style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-12" style="padding:0!important;margin:0!important">
            <div class="clearfix" id="placeOrder" ng-controller="placeOrder">
                <div class="pull-left col-md-4 col-xs-5 col-lg-3 cart-content">
                    <div class="panel panel-default" >
                        <!-- style="min-width:450px" -->
                        <nav role="navigation" class="navbar navbar-default navbar-static-top">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <a href="javascript:;" class="navbar-brand">已选菜品</a>
                                </div>
                            </div>
                        </nav>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form class="form-horizontal form" id="form1" action="<?php  echo $this->createWebUrl('manage', array('op' => 'back_submit'));?>" method="post" enctype="multipart/form-data">
                                    <table class="table table-hover table-bordered" style="max-width:500px">
                                        <thead>
                                            <tr>
                                                <th width="100">数量</th>
                                                <th width="150">菜名</th>
                                                <th width="60">单价</th>
                                                <th width="60">小计</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="goods-list">
                                        <table class="table table-hover table-bordered">
                                            <tr ng-repeat="goods in place.cart">
                                                <td width="100">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" ng-click="place.goodsCart(goods.good, goods.option, '-')">-</span>
                                                        <input type="text" class="form-control stat-num" value="{{goods.num}}" name="nums[]">
                                                        <span class="input-group-addon" ng-click="place.goodsCart(goods.good, goods.option, '+')">+</span>
                                                    </div>
                                                </td>
                                                <td width="150">{{goods.title}}</td>
                                                <td width="60">{{goods.price}}</td>
                                                <td width="60">{{goods.total_price}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th colspan="2">数量：<span class="text-high" ng-bind="place.totalNum + '份'"></span></th>
                                            <th colspan="2">总计：<span class="text-high" ng-bind="(place.totalPrice - 0 + (place.store.delivery_price - 0) + (place.store.pack_price - 0)).toFixed(2) + '元'"></span></th>
                                        </tr>
                                        <!-- <tr> -->
                                        <!-- <th colspan="4"> -->
                                        <!-- <input type="text" ng-model="place.user.mobile" class="form-control" style="margin-bottom:10px;" placeholder="手机号"> -->
                                        <!-- <input type="text" ng-model="place.user.username" class="form-control" style="margin-bottom:10px;" placeholder="收货人"> -->
                                        <!-- <input type="text" ng-model="place.user.address" class="form-control" placeholder="送餐地址"> -->
                                        <!-- </th> -->
                                        <!-- </tr> -->
                                        <!-- <tr> -->
                                        <!-- <th colspan="4"> -->
                                        <!-- <textarea ng-model="place.user.note" class="form-control" placeholder="备注"></textarea> -->
                                        <!-- </th> -->
                                        <!-- </tr> -->
                                        <!-- <tr> -->
                                        <!-- <td>菜品编号：</td> -->
                                        <!-- <td> <input type="text" id="goodCode" class="form-control" placeholder="菜品编号"></td> -->
                                        <!-- <td>  <a class="btn btn-success" id="codeAdd">确定</a></td> -->
                                        <!-- </tr> -->
                                        <script>
//代码加菜
                                        $('#codeAdd').click(function (){
                                            //    var good = {
                                            //   id:1,
                                            //   price:12,
                                            //   title:"好的"
                                            //    };
                                            //    place.goodsClick(good);
                                            var goodCode = $("#goodCode").val();
                                            $("div:contains('"+goodCode+"')").click();
                                        })
                                        </script>


                                        <tr>
                                            <td colspan="2"><a href="javascript:;" ng-click="place.submitCart()" class="btn btn-primary" ng-class="{'disabled': place.disabled == 1}" style="width:130px">提交</a></td>
                                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
                                            <td colspan="2"><a href="javascript:;" id="turncateCart" ng-click="place.turncateCart()" class="btn btn-danger" style="width:130px">清空</a></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-left col-md-8 col-xs-7 col-lg-9 goods-content">
                    <div class="pull-left col-lg-12">
                        <div class="panel panel-default">
                            <nav role="navigation" class="navbar navbar-default navbar-static-top">
                                <style>
.nav>li {
    float: left;
}
#placeOrder .table th, #placeOrder .table td {
    text-align: left;
    font-size: 10px;
}
                                </style>
                                <div class="container-fluid">
                             <!--        <div class="navbar-header">
                                        <a href="javascript:;" class="navbar-brand">商品</a>
                                    </div> -->
                                    <ul class="nav navbar-nav nav-btns">
                                        <li ng-click="place.toggleCategory(0);" ng-class="{'active': place.activeCategory == 0}"><a href="javascript:;">全部</a></li>
                                        <li ng-repeat="category in place.categorys" ng-click="place.toggleCategory(category.id);" ng-class="{'active': place.activeCategory == category.id}"><a href="javascript:;" ng-bind="category.title"></a></li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="panel-body">
                                <div class="goods-item" ng-repeat="good in place.goods" ng-show="good.cid == place.activeCategory || place.activeCategory == 0">
                                    <a href="javascript:;" class="goods-block" ng-click="place.goodsClick(good)" ng-class="{'active': good.totalNum > 0}">
                                        <span ng-bind="good.price + '元/份'"></span>
                                        <strong ng-bind="good.title"></strong>
                                        <i class="fa fa-check"></i>
                                        <span class="sku" ng-class="{'disabled': good.total == 0}" ng-bind="good.pcate.name"></span>
                                        <b class="num">{{good.totalNum}}</b>
                                    </a>
                                    <div ng-if="good.is_options == 1" ng-show="place.activeGoods.id == good.id" class="popover fade bottom" ng-class="{'in': place.activeGoods.id == good.id}">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title">{{good.title}}规格</h3>
                                        <div class="popover-content">
                                            <div class="list-group">
                                                <a href="javascript:;" class="list-group-item" ng-repeat="option in good.options" ng-init="option.num = 0" ng-click="place.goodsCart(good, option, '+');">{{option.name}}({{option.price}}元) <span class="badge" ng-show="option.num > 0">{{option.num}}</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
require(['angular', 'underscore'], function(angular, _){
    angular.module('app', []).controller('placeOrder', function($scope, $http){
        $scope.place = {
            orderid: {
                orderid: <?php  echo $orderid;?>,
                username: '',
                address: '',
                note: ''
            },
            //store: <?php  echo json_encode($store);?>,
            store: {"delivery_price":"0","delivery_free_price":"0","pack_price":"0.00","is_in_business_hours":null},

            categorys: <?php  echo json_encode($categorys);?>,
            goods: <?php  echo json_encode($goods);?>,
            activeCategory: 0,
            activeGoodsIndex: -1,
            activeGoods: {},
            activeOptionIndex: -1,
            activeOption: {},
            totalNum: 0,
            totalPrice: 0,
            cart: [],
            toggleCategory: function(id) {
                $scope.place.activeCategory = id;
            },
            disabled: 0,

            turncateCart: function() {
                    $scope.place.activeGoodsIndex = -1;
                    $scope.place.activeGoods = {};
                    $scope.place.activeOptionIndex = -1;
                    $scope.place.activeOption = {};
                    $scope.place.totalNum = 0;
                    $scope.place.totalPrice = 0;
                    $scope.place.cart = [];
                    angular.forEach($scope.place.goods, function(goods){
                        goods.totalNum = 0;
                        if(goods.is_options == 1 && goods.options) {
                            angular.forEach(goods.options, function(option){
                                option.num = 0;
                            });
                        }
                    });
                    //$scope.$apply();
            },
            submitCart: function() {
                var user = $scope.place.user;
                // 			if(!user.mobile) {
                // 				util.message('收货人手机号不能为空', '', 'info');
                // 				return false;
                // 			}
                // 			if(!user.username) {
                // 				util.message('收货人姓名不能为空', '', 'info');
                // 				return false;
                // 			}
                // 			if(!user.address) {
                // 				util.message('收货地址不能为空', '', 'info');
                // 				return false;
                // 			}
                var cart = $scope.place.cart;
                console.log(cart);
                if(cart.length == 0) {
                    alert('购物车不能为空', '', 'info');
                    return false;
                }
                $scope.place.disabled = 1;
                $http.post("<?php  echo $this->createMobileUrl('addmenu', array('op' => 'post','orderid' => $orderid,'tablesid' => $tablesid));?>", {cart: cart, method: 'save'}).success(function(dat){
                    console.log(dat);
                    if(dat.message.errno != 0) {
                        alert(dat.message.message, '', 'error');
                    } else {
                        // alert('下单成功', '', 'success');
                        $scope.place.turncateCart();
                        window.parent.location.reload();//刷新上层
                    }
                    $scope.place.disabled = 0;
                });
            },

            toggleActiveGoods: function(goods, option) {
                $scope.place.activeGoodsIndex = $.inArray(goods, $scope.place.goods);
                $scope.place.activeGoods = $scope.place.goods[$scope.place.activeGoodsIndex];
                if(option && $scope.place.activeGoods.is_options) {
                    $scope.place.activeOptionIndex = $.inArray(option, $scope.place.activeGoods.options);
                    if($scope.place.activeOptionIndex != -1) {
                        $scope.place.activeOption =  $scope.place.activeGoods.options[$scope.place.activeOptionIndex];
                    }
                }
            },
            goodsClick: function(good) {
                if(good.total == 0) {
                    // 				util.message('库存不足', '', 'error');
                    // 				return false;
                }
                if(good.is_options == 1) {
                    if($scope.place.activeGoods.id == good.id) {
                        $scope.place.activeGoodsIndex = -1;
                        $scope.place.activeGoods = {};
                        return false;
                    }
                    $scope.place.toggleActiveGoods(good);
                    return false;
                } else {
                    if($scope.place.activeGoods.is_options == 1) {
                        $scope.place.toggleActiveGoods(good);
                        return false;
                    }
                }
                $scope.place.toggleActiveGoods(good);
                $scope.place.goodsCart(good, {id: 0, title: '', price: good.price}, '+');
            },

            goodsCart: function(good, option, sign) {
                var cart = $scope.place.cart;
                $scope.place.toggleActiveGoods(good, option);
                var marks = 0;
                for(var n in cart) {
                    if (cart[n].goods_id == good.id) {
                        if(cart[n].option_id == option.id) {
                            if (sign == '+') {
                                if(good.total != -1 && cart[n].num >= good.total) {
                                    util.message('库存不足', '', 'error');
                                    return false;
                                }
                                $scope.place.activeGoods.totalNum++;
                                if(option.id > 0) {
                                    $scope.place.activeOption.num++;
                                }
                                cart[n].num += 1;
                                $scope.place.totalNum++;
                                $scope.place.totalPrice = $scope.place.totalPrice - 0 + (cart[n].price - 0);
                                $scope.place.totalPrice = $scope.place.totalPrice.toFixed(2);
                            } else {
                                $scope.place.activeGoods.totalNum--;
                                if(option.id > 0) {
                                    $scope.place.activeOption.num--;
                                }
                                cart[n].num -= 1;
                                $scope.place.totalNum--;
                                $scope.place.totalPrice = $scope.place.totalPrice - 0 - (cart[n].price - 0);
                                $scope.place.totalPrice = $scope.place.totalPrice.toFixed(2);
                            }
                            if(cart[n].num < 1) {
                                cart.splice(n, 1);
                            } else {
                                cart[n].total_price = (cart[n].num * cart[n].price).toFixed(2);
                            }
                            marks = 1;
                            break;
                        }
                    }
                }
                if (!marks) {
                    var goods = {
                        id: good.id,
                        goods_id: good.id,
                        option_id: option.id,
                        num: 1,
                        option_name: option.name,
                        price: option.price,
                        total_price: option.price,
                        good: good,
                        option: option
                    };
                    if(option.id > 0) {
                        goods.title = good.title + '(' + option.name + ')';
                    } else {
                        goods.title = good.title;
                    }
                    $scope.place.activeGoods.totalNum++;
                    if(option.id > 0) {
                        $scope.place.activeOption.num++;
                    }
                    cart.push(goods);
                    $scope.place.totalNum++;
                    $scope.place.totalPrice = $scope.place.totalPrice - 0 + (option.price - 0);
                    $scope.place.totalPrice = $scope.place.totalPrice.toFixed(2);
                }
            }
        };
    });
    angular.bootstrap($('#placeOrder')[0], ['app']);
});
            </script>
        </div>
    </div>
</div>
<script src="http://o2o.xyj0772.com/addons/we7_wmall/resource/web/js/laytpl.js"></script>
<script src="http://o2o.xyj0772.com/addons/we7_wmall/resource/web/js/common.js"></script>
<script src="http://o2o.xyj0772.com/addons/we7_wmall/resource/web/js/tiny.js"></script>

</body>
</html>
