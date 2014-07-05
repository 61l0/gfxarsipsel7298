<html>
<head><title>.:e-Budgeting:.</title></head>
<?=link_tag(CSS_PATH.'dropdown/menu.css');?>
<script type="text/javascript" src="assets/css/dropdown/menu1.js"></script>
<script type="text/javascript" src="assets/css/dropdown/menu.js"></script>
<link rel="stylesheet"  type="text/css" href="assets/css/admin-styles/load.style.css" />
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
<?// =script('formjs.js');?>
<?=script('charts/jquery.fusioncharts.js');?>

<script type="text/javascript" src="<?=base_url().'assets/js/jquery.form.js';?>"></script>

<script type="text/javascript" src="<?=base_url().'assets/js/gf.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/admin/resources/js/collapsed/menu-collapsed.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/admin/resources/js/common/hint.js" type="text/javascript';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/admin/resources/js/prettyGalery/jquery.prettyGallery.js';?>"></script>


<script type="text/javascript"> 

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
}) 
function loadPage(container, url){
	showloading('#'+container);
	jQuery('#'+container).load("<?=site_url('web/simpleajax');?>/"+url);
	hideloading();
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
function loadMenu(container,url){
	showloading('#'+container);
	$.address.value(container+'/'+url);
	$().autoscroll('#'+container);
	hideloading();
}
jQuery(document).ready(function(){
	// loadFragment('#main_panel_container', '<?=site_url('web/com/home');?>'); 
	// var down = '<img class="downarrowclass" style="border: 0pt none;" src="<?=base_url().'assets/css/dropdown/down.gif';?>">';
	// src="<?=base_url().'css/dropdown/down.gif';?>"
	// $(".ddsmoothmenu ul li a").append(down);
});

</script>
