<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:: Control Panel::.</title>
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/templates/test/load.style.css';?>" />
<link rel="shortcut icon" href="<?=base_url().'assets/image/favicon.ico" type="image/x-icon';?>" />

<?//=link_tag(CSS_PATH.'ui-themes/lightness/jquery-ui-1.8.16.custom.css');?>
<?=link_tag(CSS_PATH.'ui-themes/redmond/jquery-ui-1.7.1.custom.css');?>
<?=link_tag(CSS_PATH.'ui-themes/ui.jqgrid.css');?>
<?=link_tag(CSS_PATH.'ui-themes/ui.multiselect.css');?>

<?=script('jquery/jquery-1.6.2.min.js');?>
<?//=script('jquery/jquery-ui-1.8.16.custom.min.js');?>
<?=script('jquery/jquery-ui-1.7.2.custom.min.js');?>

<?=script('jqGrid-4.1.2/js/i18n/grid.locale-id.js');?>
<?=script('jqGrid-4.1.2/js/jquery.jqGrid.min.js');?>
<?=script('jqGrid-4.1.2/js/jquery.contextmenu.js');?>
<?=script('jqGrid-4.1.2/src/grid.treegrid.js');?>
<?=script('jqGrid-4.1.2/src/grid.formedit.js');?>
<?=script('jqGrid-4.1.2/src/grid.postext.js');?>
<script type="text/javascript">
	$.jgrid.no_legacy_api = true;
	$.jgrid.useJSON = true;
</script>

<?=script('thickbox.js');?>
<?// =script('formjs.js');?>
<?=script('charts/jquery.fusioncharts.js');?>

<script type="text/javascript" src="<?=base_url().'assets/js/gf.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/test/js/collapsed/menu-collapsed.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/test/js/common/hint.js" type="text/javascript';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/test/js/prettyGalery/jquery.prettyGallery.js';?>"></script>
<script type="text/javascript">
//jQuery.extend(jQuery.jgrid.defaults, { viewPagerButtons:false });
function loadFragment(elmContainer,url,postData){
	if(url == '<?=site_url();?>'){
		// jQuery(elmContainer).html('Menu ini masih dalam masa konstruksi!');
		// jQuery(elmContainer).load('<?=site_url('application/views/pages/htmlvar/404.php');?>');
		jQuery(elmContainer).load('<?=site_url('admin/com/jqhome');?>');
	}else{
		jQuery(elmContainer).html('');
		jQuery(elmContainer).load(url,postData,function(){
		
			var hsidebar = $(window).height() - 200;
			$('.side-menu').height(hsidebar);
		
			if($(window).width() >= 1280){
				var hcontent = $(window).height() - 181;
				$('.content').height(hcontent);	
			
			}else if($(window).width() >= 1024){
				var hcontent = $(window).height() - 203;
				$('.content').height(hcontent);	
			
			}else if($(window).width() >= 800){
				var hcontent = $(window).height() - 230;
				$('.content').height(hcontent);								
			}	
			
		});
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
	// if($(window).width() >= 1280){
		// menu = 13;
		// $('.prettyGallery').width('100%');
	// }else if($(window).width() >= 1024){
		// menu = 10;
		// $('.prettyGallery').width('97%');
	// }else if($(window).width() >= 800){
		// menu = 8;
		// $('.prettyGallery').width('99%');
	// }else if($(window).width() < 800){
		// menu = 5;
		// $('.prettyGallery').width('100%');
	// }		
	
	// slider navigation
	// $('.prettyGallery:last').prettyGallery({
		// 'navigation':'bottom',
		// 'itemsPerPage':menu
	// });		
	
	// if($(window).width() >= 1280){
		// $('.prettyGallery').width('99%');
	// }else if($(window).width() >= 1024){
		// $('.prettyGallery').width('95%');
	// }else if($(window).width() >= 800){
		// $('.prettyGallery').width('99%');
	// }else if($(window).width() < 800){
		// $('.prettyGallery').width('100%');
	// }				
	
	// $('.pg_paging').width('100%');
	// $('.pg_paging').css("color","#5a5a5a");	
	
	// if ($('.pg_paging').length) {
		// var hcontent = $(window).height() - 170;
		// $('.content').height(hcontent);				
	// }	
	
	
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

</head>
<body onLoad="waktu()"  >
<div class="body">
  <div class="page">
    <div class="header">
      <div class="header-title"> Sikda Modul - Control Panel </div>
      <div class="header-status"> <a href="#">Login sebagai :
        <?=$user_name;?>
        | Group Akses :
        <?=$user_group;?>
        </a> |
        <?=loadCom('comsidebar/comsidebar','getDateToDay');?>
        / <strong id="output"></strong><a href="<?=site_url('login/out');?>" class="logout">Logout</a> </div>
    </div>
    <!--e:header-->
    <? include('htmlvar/head_menu.php');?>
    <!--e:navigation-->
    <? include('htmlvar/side_menu.php');?>
      <!--e:sidebar-->
      <div class="content-box">
          <div id="main_panel_container"> </div>
      </div>
      <!--e:content-box-->
    </div>
    <!--e:main-content-->
    <!--content-->
<?	include('htmlvar/footer.php'); //=htmlVar('footer');?>
