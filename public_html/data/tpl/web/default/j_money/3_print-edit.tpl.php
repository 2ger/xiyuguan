<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<script type='text/javascript' src='../addons/j_money/template/js/jquery-2.1.1.min.js'></script> 
<script language="javascript" src="../addons/j_money/template/js/LodopFuncs.js"></script>
<style>
#page1{padding:5px; border:1px solid #CCC; display:inline-block}
#pager{ width:300px;position:relative; width:290px; z-index:999999; min-height:600px;}
.m_title{position:absolute; z-index:1;border:1px dashed #CCC; background:#FFF;}
.edit-class{ background:#09F;}
</style>
<div style="padding:10px;">
  <ul class="nav nav-tabs">
    <li <?php  if($operation == 'post') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('print', array('op' => 'post'))?>">添加打印模板</a></li>
    <li <?php  if($operation == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createWebUrl('print', array('op' => 'display'))?>">管理打印模板</a></li>
  </ul>
  <div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php  echo $id?>" />
      <div class="panel panel-default">
        <div class="panel-heading"> 打印模板 </div>
        <div class="panel-body" id="editbox">
          <div class="form-group"> </div>
          <div id="btngroup" class="form-inline">
            <div style="margin-bottom:5px">
              <div class="input-group"> <span class="input-group-addon">模板标题</span>
                <input type="text" name="title" class="form-control" value="<?php  echo $item['title'];?>" placeholder="请填写模板标题" />
              </div>
            </div>
            <select class="form-control" name="pcate">
              <option value="0" <?php  if($item['pcate']==0) { ?>selected<?php  } ?>>收银小票</option>
              <option value="1" <?php  if($item['pcate']==1) { ?>selected<?php  } ?>>卡券小票</option>
            </select>
            <select class="form-control" onChange="AddThis(this)" id="normaltxt">
              <option value="0">添加</option>
              <option value="1">添加普通文本</option>
              <option value="2">添加图片</option>
            </select>
            <select class="form-control" onChange="AddSysThis(this)" id="systxt">
              <option value="0">添加系统内容</option>
              <optgroup label="收银小票内容">
                <option value="t1-|#收银员姓名#|">添加-收银员姓名</option>
                <option value="t2-|#收银时间#|">添加-收银时间</option>
                <option value="t3-|#总金额#|">添加-总金额</option>
                <option value="t4-|#优惠金额#|">添加-优惠金额</option>
                <option value="t5-|#实收金额#|">添加-实收金额</option>
                <option value="t6-|#付款银行#|">添加-付款银行</option>
                <option value="t7-|#单号#|">添加-单号</option>
                <option value="t8-|#原单号#|">添加-原单号</option>
              </optgroup>
              <optgroup label="卡券小票内容">
                <option value="a1-|#收银员姓名#|">添加-收银员姓名</option>
                <option value="a2-|#兑换时间#|">添加-兑换时间</option>
                <option value="a3-|#卡券内容#|">添加-卡券内容</option>
                <option value="a4-|#卡券标题#|">添加-卡券标题</option>
                <option value="a5-|#卡券副标题#|">添加-卡券副标题</option>
                <option value="a6-|#卡券类型#|">添加-卡券类型</option>
                <option value="a7-|#卡券优惠#|">添加-卡券优惠</option>
              </optgroup>
            </select>
            <button type="button" class="btn btn-danger" onClick="delText()">删除所选</button>
          </div>
        </div>
        <div class="panel-body" id="editbox">
          <Div style="max-width:850px; position:relative;" class="form-inline">
            <object id="LODOP" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=800 height=600>
              <param name="Caption" value="内嵌显示区域">
              <param name="Border" value="1">
              <param name="Color" value="#C0C0C0">
              <embed id="LODOP_EM2" TYPE="application/x-print-lodop" width=300 height=550 PLUGINSPAGE="install_lodop.exe">
            </object>
          </Div>
        </div>
      </div>
      <div class="form-group col-xs-12">
        <input type="hidden" name="content"/>
        <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  onclick="return updateForm();return false" />
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#LODOP_EM2").css({'width':"100%","height":"650px"});
	DisplayDesign();
});
var LODOP;
//58mm=186px ，1mm=3.2069px
function Moditify(item){
	LODOP=getLodop(document.getElementById('LODOP'),document.getElementById('LODOP_EM2')); 	
	if ((LODOP.GET_VALUE("ItemIsAdded",item))){
		LODOP.SET_PRINT_STYLEA(item,'Deleted');
		return false;
	}
	return true;
}
function CreatePage(){
	LODOP=getLodop(document.getElementById('LODOP'),document.getElementById('LODOP_EM2'));
	<?php  if(!$id || !$item['content']) { ?> 
	LODOP.PRINT_INITA(0,0,186,550,"小票打印设置");
	<?php  } else { ?>
	<?php  echo $item['content'];?>
	<?php  } ?>
};	
function DisplayDesign() {		
	CreatePage();
	LODOP.SET_SHOW_MODE("DESIGN_IN_BROWSE",1);
	LODOP.SET_SHOW_MODE("SETUP_ENABLESS","11111111000000");//隐藏关闭(叉)按钮
	LODOP.SET_SHOW_MODE("HIDE_GROUND_LOCK",true);//隐藏纸钉按钮
	LODOP.PRINT_DESIGN();
};
var i=0;
function addText(){
	var temp='txt_'+i;
	if(arguments.length){
		if(Moditify(arguments[0])){
			LODOP.ADD_PRINT_TEXTA(arguments[0],0,0,120,18,arguments[1]);
		}
	}else{
		LODOP.ADD_PRINT_TEXTA(temp,0,0,120,18,'文本内容');
		i++;
	}
}

function addImage(){
	showImageDialog();
}
function delText(){
	if(confirm('确认要删除所选内容？')){
		LODOP.SET_PRINT_STYLEA('Selected','Deleted',true);
	}
}
function preview(){
	LODOP.PREVIEW();
}
function AddThis(obj){
	var temp=parseInt($(obj).val());
	if(!temp)return;
	if(temp==1){
		addText();
	}else{
		addImage();
	}
	$("#normaltxt option").eq(0).prop("selected",true);
}
function AddSysThis(obj){
	var temp=$(obj).val();
	if(temp=="0")return;
	var tempary=temp.split("-");
	addText(tempary[0],tempary[1]);
	$("#systxt option").eq(0).prop("selected",true);
}
function updateForm(){
	LODOP=getLodop(document.getElementById('LODOP'),document.getElementById('LODOP_EM2'));
	$("input[name='content']").val(LODOP.GET_VALUE("ProgramCodes",0));
	return true;
}

function showImageDialog() {
	$("#LODOP").css('visibility',"hidden");
	require(["util"], function(util){
		options = {'global':false,'class_extra':'','direct':true,'multiple':false};
		var val='';
		util.image(val, function(url){
			$("#LODOP").css("visibility","");
			if(url.url){
				LODOP.ADD_PRINT_IMAGE(0,0,100,100,"<img border='0' src='"+url.url+"' style='width:100%' />");
			}
			if(url.media_id){
				LODOP.ADD_PRINT_IMAGE(0,0,100,100,"<img border='0' src='"+url.media_id+"' style='width:100%' />");
			}
		}, null, options);
	});
}
</script>