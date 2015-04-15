<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: ARSIP ::.</title>
<!-- Le styles -->

<style type="text/css">
#ui-datepicker-div{
	border: none !important;
}
</style>

<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/templates/admin/resources/load.style.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/js/validate/jquery.validate.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/css/fonts/raleway/font.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/css/fonts/roboto/font.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/js/validate/style.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/js/jquery.autocomplete.css';?>" />
<link rel="shortcut icon" href="<?=base_url().'assets/image/favicon.ico" type="image/x-icon';?>" />
<script type="text/javascript">
function base_url () {
	return "<?php echo base_url()?>";
}
</script>

<?=link_tag(CSS_PATH.'ui-themes/jquery-ui.css');?>
<?=link_tag(CSS_PATH.'ui-themes/ui.jqgrid.css');?>
<?=link_tag(CSS_PATH.'ui-themes/ui.multiselect.css');?>
<?=link_tag(JS_PATH.'jquery/jquery.jscrollpane.css');?>
<?php //script('jquery/jquery-1.6.2.min.js');?>
<?=script('jquery/jquery-1.6.2.min.js');?>

<?=script('jquery/jquery.formatCurrency-1.4.0.js');?>
<?=script('jquery/jquery.blockUI.js');?>

<?php //script('jquery/jquery-ui-1.7.2.custom.min.js');?>
<?=script('jquery/jquery-ui-1.8.16.custom.min.js');?>

<?=script('jquery/jquery.mousewheel.js');?>



<?=script('jqGrid-4.5.4__/js/i18n/grid.locale-id.js');?>
<?=script('jqGrid-4.5.4__/js/jquery.jqGrid.min.js');?>
<?=script('jqGrid-4.5.4__/js/jquery.contextmenu.js');?>
<?=script('jqGrid-4.5.4__/src/grid.treegrid.js');?>
<?=script('jqGrid-4.5.4__/src/grid.formedit.js');?>
<?=script('jqGrid-4.5.4__/src/grid.postext.js');?>

<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/css/metro/font-awesome.min.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/css/metro/theme.css';?>" />
<script type="text/javascript" src="<?=base_url().'assets/css/metro/theme.js';?>"></script>
<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>
<style>
.ui-jqgrid tr.jqgrow td {white-space: normal}
ul#menu li ul li a {cursor:pointer;}
</style>

<style>
.ui-datepicker{z-index:999}
</style>

<?=script('thickbox.js');?>
<?// =script('formjs.js');?>
<?=script('charts/jquery.fusioncharts.js');?>

<script type="text/javascript" src="<?=base_url().'assets/js/jquery.form.js';?>"></script>

<script type="text/javascript" src="<?=base_url().'assets/js/gf.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/jquery.autocomplete.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/ajaxfilemanager_c.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/ajaxupload.3.5.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/admin/resources/js/collapsed/menu-collapsed.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/admin/resources/js/common/hint.js" type="text/javascript';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/admin/resources/js/prettyGalery/jquery.prettyGallery.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/formvalidate/jquery.validate.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/angular.min.js';?>"></script>

         


<script type="text/javascript">
//jQuery.extend(jQuery.jgrid.defaults, { viewPagerButtons:false });
function loadFragment(elmContainer,url,postData){
	var $base_url = '<?=base_url();?>';

	if(url == '-' || url == ($base_url + '-'))
	{
		return;
	}
	var $default = true;

	if(url == '<?=site_url();?>'){
		// jQuery(elmContainer).html('Menu ini masih dalam masa konstruksi!');
		// jQuery(elmContainer).load('<?=site_url('application/views/pages/htmlvar/404.php');?>');
		jQuery(elmContainer).load('<?=site_url('admin/com/jqhome');?>');
	}else{
		$default = false;
		jQuery(elmContainer).html('');
		jQuery(elmContainer).load(url,postData,function(){
		
			// var hsidebar = $(window).height() - 200;
			// $('.side-menu').height(hsidebar);
		
			// if($(window).width() >= 1280){
			// 	var hcontent = $(window).height() - 176;
			// 	$(".content").height(hcontent);	
						
			// }else if($(window).width() >= 1024){
			// 	var hcontent = $(window).height() - 177;
			// 	$(".content").height(hcontent);	
			// }else if($(window).width() >= 800){
			// 	var hcontent = $(window).height() - 145;
			// 	$(".content").height(hcontent);								
			// }	
			
		});
	}

	if(!$default)
	{
		//var rgxp = new RegExp('/'+base_url+'/','g');
		var route = '/'+url.split($base_url)[1];
		//console.log(url);
		document.location.hash = route;
	}
}

function getActiveNav(id){
	$("#top-menu ul li div").removeClass("active");
	$("#top-menu ul li div").addClass("pasive");
	$("#m"+id).addClass("active");
}

function getActiveSidebar(id){
	$("#menu li ul a").removeClass("active");
	$("#m"+id).addClass("active");
}		

function loadsidebar(idmenu){
	jQuery('#menu').html('');
	jQuery('#menu').load('<?=site_url('admin/com/sidebar/index');?>/'+idmenu, function(){
		initMenu();
		$("#menu li ul a:first").addClass("active");
	});		
}		


function loadDialog(url,postData,settings){
	jQuery("#dialogArea").length || jQuery('<div id="dialogArea" />').appendTo('body').css('display','none');
	var dialog = jQuery("#dialogArea");
	dialog.dialog('destroy').html('');
	
	dialog
		.load(url,postData);
	if(settings){
		settings.modal = true;
		dialog.dialog(settings);
	}else{
		dialog.dialog({
			modal:true
			,title: 'title'
			,width: 500
			,height: 300
		});

	}
	dialog.dialog('open');
	return false;
}
function loadDialogLink(elem,postDat,settingsa){
	jQuery("#dialogArea").length || jQuery('<div id="dialogArea" />').appendTo('body').css('display','none');
	var dialog = jQuery("#dialogArea");
	settings.modal = true;
	dialog.dialog('destroy').html('');

	var goTo = elem.href;
		
	if(settings){
		settings.modal = true;
		dialog.dialog(settings);
	}else{
		dialog
			.load(goTo,postData)
			.dialog({
				title: 'title',
				width: 500,
				height: 300
		});
	}
	dialog.dialog('open');
	return false;
}

jQuery(document).ready(function(){
	loadsidebar(100);
	loadFragment('#main_panel_container', '<?=site_url('admin/com/jqhome');?>');
	
	$("#top-menu > ul li div:first").addClass("active");

	var menu = 13;
});


window.setTimeout("waktu()",1000);  
function waktu() {   
	var waktu = new Date();
	var jam = waktu.getHours();
	var menit = waktu.getMinutes();
	var detik = waktu.getSeconds();
	var teksjam = new String();
	if ( menit <= 9 )
		menit = "0" + menit;
	if ( detik <= 9 )
		detik = "0" + detik;
	teksjam = jam + ":" + menit + ":" + detik;
	setTimeout("waktu()",1000);  
	document.getElementById("output").innerHTML = teksjam;
}


</script>
<style type="text/css">
.cb{
	clear: both;
}
.h{
	 height: 121px;
    margin-top:-12px !important;
    min-width: 1000px;
    overflow: hidden;
	background: transparent url(<?php echo base_url()?>assets/css/metro/images/bg-mnu_04.png) repeat-x -15px 5px;
}
.h > .hl {
	/*float: left;*/
	position: absolute;
	width: 361px;
	height: 121px;
	background: transparent url(<?php echo base_url()?>assets/css/metro/images/bg-mnu_03.png) no-repeat -15px 5px;
}
.h > .hl > .ov-title{
	background: #DC3229;
	height:37px;
	width: 380px;
	border-bottom-right-radius: 30px;

}
.h > .hl > .ov-title > .ov-text{
	padding-top: 15px;
	padding-left: 109px;
}
.h > .hl > .ov-sub-title{
	height: 36px;
	width: 380px;
}
.h > .hl > .ov-sub-title > .ov-text{
	padding-left: 110px;
    padding-top: 15px;
}
.h > .hr{
	/*float: right;*/
	margin-left: 380px;
/*	border: solid 1px #dedede;*/
	/*width: 65%;*/
}
.h > .hl > .ov-logo{
	width: 115px;
	height: 119px;
	position: absolute;
	margin-top: 12px;
	margin-left: 4px;
}
#navigation{
	width:100%;
}
div.line {
    margin-left: 127px;
    margin-top: -2px;
}
div.hv{
	height: 121px;
}
div.h{
	position: fixed;
	margin: 0;
	top: 0;
	z-index: 3;
	width: 100%;
}
</style>
</head>
<body onLoad="waktu()" >
<div class="body clearfix">
<div class="hv"></div>
  <div class="h">
  	<div class="hl">
  		<div class="ov-logo">
  			<img src="<?php echo base_url()?>assets/css/metro/images/lg-tangsel.png"/>
  		</div>
  		<div class="ov-title">
  			<div class="ov-text">
  				<img src="<?php echo base_url()?>assets/css/metro/images/app-text.png"/>
  			</div>
  		</div>
  		<div class="ov-sub-title">
  			<div class="ov-text">
  				<img src="<?php echo base_url()?>assets/css/metro/images/app-company.png"/>
  			</div>
  		</div>
  		<div class="line">
  			<img src="<?php echo base_url()?>assets/css/metro/images/bg-mark.png"/>
  		</div>
  	</div>
  	<div class="hr">
  		<div class="calendar">
  			<i class="fa icon-calendar"></i>&nbsp;<?=loadCom('comsidebar/comsidebar','getDateToDay');?>&nbsp;<span id="output"></span>
  		</div>
  		  <div class="profileNav ">
  		  	<a href="javascript:;">
  		  		<i class="fa icon-user"></i>&nbsp;<?=$_SESSION['nama_pengguna'];?>&nbsp;(<?=$group_name;?>)
  		  	</a>
  		  	&nbsp;
  		  	<a href="<?=site_url('login/out');?>" class="logout"><i class="fa icon-hand-right">&nbsp;</i>Logout</a> 
    	  </div>
    
  		<div id="navigation" >
		  <ul class="paging">    
		    <?=$menu_list;?>
		  </ul>
		</div>
  	</div>
  	<div class="bgg"></div>
  	<div class="cb">
  	</div>
  </div>	
  <div class="page" style="min-height:495px">
  	<!-- <div class="banner">
  		<img src="<?php echo base_url();?>assets/css/metro/images/banner.jpg"/>
  	</div> -->
    <div class="header" style="display:none;">
    		
      <div class="header-title"> Arsip Kota Tangerang Selatan - Control Panel </div>
    </div>
       <!--e:header-->
    <? include('htmlvar/head_menu.php');?>
    <!--e:navigation-->
    <?//include('htmlvar/side_menu.php');?>
      <!--e:sidebar-->
	  <div class="content">
		<div id="header_caption_content"></div>
		<div class="main-content">			
			<div id="main_panel_container" class="content-box"></div>
		</div>
      </div>
      <!--e:content-box-->
    </div>
    <div class="ajaxl">
    	
    </div>
    <!--e:main-content-->
    <!--content-->
<?	include('htmlvar/footer.php'); //=htmlVar('footer');?>

<script type="text/javascript" src="<?php echo BASE_URL?>assets/js/jquery/jquery.lightbox-0.5.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>assets/js/jquery/jquery.lightbox-0.5.css">

<script type="text/javascript">
	$('.ajaxl').ajaxStart(function(){
		// console.log(arguments)
		$('.loading').show()
	});
	$('.ajaxl').ajaxStop(function(){
		// console.log(arguments)
		$('.loading').hide()

	});
	// $('.ajaxl').ajaxStart(function(){

	// });
</script>