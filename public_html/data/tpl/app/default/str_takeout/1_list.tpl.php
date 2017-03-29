<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/str_takeout/template/resource/css/main.css">
<script src="../addons/str_takeout/template/resource/js/dialog.js"></script>
<script src="../addons/str_takeout/template/resource/js/main.js"></script>
<script src="../addons/str_takeout/template/resource/js/menu.js"></script>
<script src="../addons/str_takeout/template/resource/js/common.js"></script>
<style type="text/css">
	.nav a{width:50%;}
	.select{
		width: 100%;height: 50px;background-color: #fff;
	}
	.select_btn{margin: 10px 15px; height: 30px; font-size: 18px;}
</style>
<div class="container" onselectstart="return true;" ondragstart="return false;">
	<header class="nav menu">
	    <div>
		    <a href="<?php  echo $this->createMobileUrl('list', array('status' => ''))?>" <?php  if($status == '') { ?>class="on"<?php  } ?>>进货</a>
		    <a href="<?php  echo $this->createMobileUrl('list', array('status' => '1'))?>" <?php  if($status == '1') { ?>class="on"<?php  } ?>>退货</a>
	    </div>	
	</header>
	<!-- <form name="form1" action="" method="post"> -->
	<div class="select">
	    <input type="text" name="selectname" id="searchstr" class="select_btn" placeholder="原材料名称">
	    <input type="button" name="submit" class="comm_btn" id="searchbtn" style="margin-left: 15px;" value="搜索">
	</div>
	<!-- </form> -->
	<form name="cart_form" action="<?php  echo $this->createMobileUrl('orderlist', array('status' => $status), true);?>" method="post">
		<input type="hidden" name="more" value="<?php  echo $_GPC['more'];?>">
		<input type="hidden" name="dish_str" value="<?php  echo $dish_str;?>">
		<section class="menu_wrap skin1" id="menuWrap">
			<div id="menuNav" class="menu_nav">
				<div class="ico_menu_wrap clearfix"><span class="ico_menu" id="icoMenu"><i></i></span></div>
				<div class="side_nav" id="sideNav">
					<ul>
						<?php  if(is_array($category)) { foreach($category as $cate) { ?>
							<?php  $i++;?>
						<!-- 	<li><a href="javascript:void(0);" data-cid="<?php  echo $cate['id'];?>"><?php  echo $cate['name'];?></a></li> -->
						<?php  } } ?>
						<?php  if(is_array($categorys)) { foreach($categorys as $cate_row) { ?>
							<li><a class="cat" data-cid="<?php  echo $cate_row['id'];?>" id="cat<?php  echo $cate_row['id'];?>"><?php  echo $cate_row['name'];?></a></li>
						<?php  } } ?>
					</ul>
				</div>
			</div>

			<style>
				.hidden{display:none;}
				.display{display:block;}
			</style>
					<script type="text/javascript">
					//搜索17.2.7
						$('#searchbtn').click(function(){
							 var str = $('#searchstr').val();
							 var obj = $("li:contains("+str+")");
								$(".catsearch").prepend(obj);
						})

						$('.cat').click(function(){
							 var cid = $(this).attr('id');
							 $('.menu_tt,.list0').addClass('hidden');
							 $('.'+cid).removeClass('hidden').addClass('display');
						})
			</script>
			<div class="menu_container"> 
			<!-- 搜索 -->
			<ul class="menu_list catsearch">
			</ul>
			<style type="text/css">
.hidden,.num{display: none!important}
.menu_list .btn_n, .menu_list .num{float:right;}
.goods{border-bottom: 1px dashed #333;}
			</style>
			<!-- 搜索 -->
				<?php  if(is_array($categorys)) { foreach($categorys as $cate_row) { ?>
					<div class="menu_tt cat<?php  echo $cate_row['id'];?>" id="cate-<?php  echo $cate_row['id'];?>" style="width:800px!important"><h2 style="color:#ff510c"><?php  echo $cate_row['name'];?></h2></div>
					<ul class="menu_list list0 cat<?php  echo $cate_row['id'];?>">
						<?php  if(is_array($cate_dish[$cate_row['id']])) { foreach($cate_dish[$cate_row['id']] as $ds) { ?>
							<li id="<?php  echo $ds['id'];?>" class="goods">
						<div class="hidden"></div>
								<div>
									<h3 style="color:red"><?php  echo $ds['name'];?></h3>
									<p>
										总部<span class="sale_num"><?php  echo $ds['qty'];?></span><span class="sale_unit"><?php  echo $ds['unitName'];?></span>/本店<span class="sale_num"><?php  echo $ds['now']['nowqty'];?></span><span class="sale_unit"><?php  echo $ds['unitName'];?></span>
										<?php  if($ds['qty'] == 0) { ?>
											<span class="text-danger">已售完</span>
										<?php  } ?>	
									</p>
									<?php  if($ds['spec']!='') { ?>
									规格：<?php  echo $ds['spec'];?>
									<?php  } ?>
									<!-- <div class="info"><?php  echo $ds['description'];?></div> -->
								</div>
								<div class="price_wrap">
									<?php  if($status == 1) { ?>
									<!-- 退 -->
									<?php  if($ds['now']['nowqty'] > 0) { ?>
										<div class="fr" max="<?php  echo $ds['qty'];?>">
											<input autocomplete="off" class="inputnum h_num" id="inputnum"  max="<?php  echo $ds['now']['nowqty'];?>" type="number" name="dish[<?php  echo $ds['id'];?>]" value="<?php  echo $cart['data'][$ds['id']];?>">
											<br style="clear:both">
											<a href="javascript:void(0);" class="btn_n add hidden" data-num="<?php  echo $cart['data'][$ds['id']];?>"></a>
										</div>

										<?php  } ?>
										<?php  } else { ?>
										<?php  if($ds['qty'] > 0) { ?>
										<div class="fr" max="<?php  echo $ds['qty'];?>">
											<input autocomplete="off" class="inputnum h_num" id="inputnum"  max="<?php  echo $ds['qty'];?>" type="number" name="dish[<?php  echo $ds['id'];?>]" value="<?php  echo $cart['data'][$ds['id']];?>">
											<br style="clear:both">
											<a href="javascript:void(0);" class="btn_n add hidden" data-num="<?php  echo $cart['data'][$ds['id']];?>"></a>
										</div>

										<?php  } ?>
										<?php  } ?>

									
								</div>
							</li>
						<?php  } } ?>
					</ul>
				<?php  } } ?>
			</div>
		</section>
		<style>
.hidden{display: none}
		.inputnum{width:50px;border:1px solid #535353;height:30px;float:right;}
		.menu_list .btn_n.del{float:left;}
		</style>
<script>
$('.inputnum').change(function(){
	var input = parseInt($(this).val());
	var max = parseInt($(this).attr('max'));
	if(input > max) {
		$(this).val('');
	alert(input+'总部库存量不足！'+max);
	}
})
		</script>
		<footer class="shopping_cart">
			<div class="fixed">
				<div class="cart_bg">
					<span class="cart_num" id="cartNum"></span>
				</div>
				<div><span id="totalPrice"></span></div>
				<div>
					<a id="settlement" href="javascript:document.cart_form.submit();" class="comm_btn" >确认订单</a>
				</div>
			</div>
		</footer>
	</form>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footerbar', TEMPLATE_INCLUDEPATH)) : (include template('footerbar', TEMPLATE_INCLUDEPATH));?>
	<!-- <div class="menu_detail" id="menuDetail">
		<img style="display: none;">
		<div class="nopic"><img src=""></div>
		<a href="javascript:void(0);" class="comm_btn" id="detailBtn">来一份</a>
		<dl>
			<dt>价格：</dt>
			<dd class="highlight">￥<span class="price"></span></dd>
		</dl>
		<p>库存<span class="sale_num"></span>份</p>
		<dl>
			<dt>介绍：</dt>
			<dd class="info"></dd>
		</dl>
	</div> -->
</div>

<script type="text/javascript">
var menu = {
	offsetAry: [0],
	_is_left_menu_addclass:true,
	init: function(id){
		var winH = $(window).height(),
			_this = this,			
			_icoMenu = $('#icoMenu'),
			_sideNav = $('#sideNav'),
			maxH = winH - (_icoMenu.parent().is(':visible') ? _icoMenu.outerHeight(true) : 0) - 45;

		this.el =  $(id);
		
		_sideNav.height(800);

		if(_sideNav.find('ul').height() > maxH)  new IScroll('#sideNav', { probeType: 3, mouseWheel: true ,click:true});

		$(window).bind('scroll', function(){
			_this.scroll.call(_this);
		});

		$('#icoMenu').click(function(){
			if(_sideNav.css('display') != 'none') {
				_sideNav.show();
			} else {
				_sideNav.hide();
			}
			if(_sideNav.find('ul').height() > maxH)  new IScroll('#sideNav', { probeType: 3, mouseWheel: true ,click:true});
		});

		$('.menu_tt h2').each(function(){
			_this.offsetAry.push($(this).offset().top);
		});

		this.el.find('a').click(function(){
			$(this).addClass('on').parent().siblings().find('a').removeClass('on');
			_this._is_left_menu_addclass=false;
			var t = $(window).scrollTop();
			var t1= _this.offsetAry[_this.el.find('a').index(this) + 1];
			var _t =Math.abs(t1-t);
			var _time =parseInt( Math.round(_t/3));
			$('html,body').animate({scrollTop: t1}, _time,"linear",function(){_this._is_left_menu_addclass=true;});
		});

		_this.offsetT = this.el.offset().top;	
	},
	getIndex: function(ary, value){
		var i = 0;
		for(; i < ary.length; i++){
			if(value >= ary[i] && value < ary[i + 1]){
				return i;
			}
		}
		return ary.length -1;
	},
	scroll: function(){
		var st = $(document).scrollTop(),
			index = this.getIndex(this.offsetAry, st),
			i = index - 1;

		if(this.curIndex !== index){ // 判断分类是否切换
			
			$('.menu_tt h2').removeClass('menu_fixed');
			if(this._is_left_menu_addclass==true)
				this.el.find('a').removeClass('on');
			if(i >= 0){
				this.el.addClass('menu_fixed');
				$('.menu_tt').eq(i).find('h2').addClass('menu_fixed');
				if(this._is_left_menu_addclass==true)
					this.el.find('a').eq(i).addClass('on');	
			}else{
				this.el.removeClass('menu_fixed');
			}
			this.curIndex = index;
		}
	}
}
	$(function(){
		menu.init('#menuNav');
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
