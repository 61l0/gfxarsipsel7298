<html>
<head><title>.:e-Budgeting:.</title>
<?=link_tag(CSS_PATH.'dropdown/menu.css');?>
<script type="text/javascript" src="assets/css/dropdown/menu1.js"></script>
<script type="text/javascript" src="assets/css/dropdown/menu.js"></script>
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/templates/web/resources/css/table.css';?>" />
<link rel="stylesheet"  type="text/css" href="<?=base_url().'assets/templates/web/resources/css/button.css';?>" />
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
<script type="text/javascript" src="<?=base_url().'assets/templates/web/resources/js/collapsed/menu-collapsed.js';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/web/resources/js/common/hint.js" type="text/javascript';?>"></script>
<script type="text/javascript" src="<?=base_url().'assets/templates/web/resources/js/prettyGalery/jquery.prettyGallery.js';?>"></script>

<style>
.footer {
	height:100px;
	width:950px;
	border-top:solid 1px #e3e3e3;
	bottom:0;
	border-bottom::solid 1px #000;
	color:#D7D7D7;
	font-weight:bold;
	text-align:center;
}
.content {
	clear:both;

	overflow-y:auto;	
	overflow-x:hidden;
	padding:0px 14px;

}
.page-break {
	clear:both;
	height:10px;
}
.page {
	font-family:Calibri;
}
.header_caption {
	font-size:16px;
	/* height:35px;
	background-color: #8CBFEC;
	border-bottom-width: 2px;
	border-color:#5C9CCC;
	border-width:thin;
	border-style:solid; */
}
</style>
<script type="text/javascript"> 

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
}) 
function loadPage(container, url){
	// showloading('#'+container);
	jQuery('#'+container).load("<?=site_url('web/simpleajax');?>/"+url);
	// hideloading();
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
	// showloading('#'+container);
	$.address.value(container+'/'+url);
	$().autoscroll('#'+container);
	// hideloading();
}
jQuery(document).ready(function(){
	
});

</script>
</head>

<body bgcolor="#22485B">
<center>
<div class="body" style="width:950px;">
<div class="page">
	<table width="950" align="center" style="background-repeat: no-repeat;" background="<?=base_url().'assets/templates/web/resources/img/common/banner.png';?>" height="140">
    <tr><td colspan="2"><font color="white"><?=@$tanggal;?></font></td></tr>
		<tr>
			<td colspan="2" height="128"></td>
		</tr>
	</table>
	<div style="background-color:#FFFFFF;"><? include('htmlvar/navigation.php');?></div>
	<div class="content-box" style="background-color:#FFFFFF;">
		<div id="content" class="content" align="justify">
			<div id="main_panel_container" class="main_panel_container">
			<? include('home/index.php');?>
			</div>
			<div class="page-break" />
		</div> 
	</div>

</div>
</div>
<!--footer-->
	<div id="footer" class="footer">
		<img src="<?=base_url().'assets/templates/web/resources/img/common/footer.png';?>">
	</div>
<!--footer-->  
</body>
</html>
