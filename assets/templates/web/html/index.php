<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.:e-Budgeting:.</title>
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/templates/web/resources/load.style.css';?>" />
<link rel="shortcut icon" href="<?=base_url().'assets/image/favicon.ico" type="image/x-icon';?>" />

<?=link_tag(CSS_PATH.'ui-themes/redmond/jquery-ui-1.7.1.custom.css');?>
<?=link_tag(CSS_PATH.'ui-themes/ui.jqgrid.css');?>
<?=link_tag(CSS_PATH.'ui-themes/ui.multiselect.css');?>

<?=script('jquery/jquery-1.6.2.min.js');?>
<?=script('jquery/jquery.formatCurrency-1.4.0.js');?>
<?=script('jquery/jquery.blockUI.js');?>
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
<style>
.ui-jqgrid tr.jqgrow td {white-space: normal}
ul#menu li ul li a {cursor:pointer;}
</style>

<style>
.ui-datepicker{z-index:999}
</style>

<?=script('thickbox.js');?>
<script type="text/javascript" src="<?=base_url().'assets/js/jquery.form.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/js/gf.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/web/resources/js/collapsed/menu-collapsed.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/web/resources/js/common/hint.js" type="text/javascript';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/web/resources/js/prettyGalery/jquery.prettyGallery.js';?>"></script>

<script type="text/javascript">  
$(document).ready(function(){ 
	link_active();
});	
function link_active(){
	$('.page-link').html('<ul><li><a class="active">Beranda</a></li></ul>');
}
function loadPage(container, url){
	jQuery('#'+container).load("<?=site_url('web/simpleajax');?>/"+url);
}

function loadFragment(elmContainer,url,postData){
	jQuery(elmContainer).html();
	jQuery(elmContainer).load(url,postData); 
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
</script>
</head>

<body>
<div class="header">

</div>
<div class="body">
	<div class="page">
		<div class="navigation">
			<? include('htmlvar/navigation.php');?>
		</div><!--navigation-->
		<div class="content-box">
			<div class="page-link">
			
			</div>
			<div class="content"id="main_panel_container">
				<? include('home/index.php');?>
			</div><!--content-->
		</div><!--content-box-->
	</div><!--page-->
</div><!--body-->
<div class="footer">
	<div class="footer-box">
        <div class="footer-left">
            Hak Cipta Pemerintah Kota Tangerang
        </div>
        <div class="footer-right">
            Copyright &copy; 2012<br />
            All Right Reserved
        </div>
    </div>
    
</div>
</body>
</html>
