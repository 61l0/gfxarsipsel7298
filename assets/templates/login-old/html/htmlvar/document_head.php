<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		
		<title>ARSIP</title>
		<base href="<?=base_url().'assets/';?>" />
		
		<!-- <link rel="stylesheet" type="text/css" href="css/all.css" media="screen">-->
		<?=link_tag(CSS_PATH.'ui-themes/ui.jqgrid.css');?>

		
        <link rel="stylesheet" type="text/css" href="<?=base_url().'assets/templates/login/resources/load.styles.css';?>" media="screen">

		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
			
		<!-- Load JQuery -->		
		<script type="text/javascript" src="js/jquery/jquery.1.5.1.min.js"></script>

		<!-- Load JQuery UI -->
		<script type="text/javascript" src="js/jquery/jquery-ui.1.8.min.js"></script>
		

		<!-- This file load the Ajax Form Plugin. -->
		<?=script('jquery.form.js');?>


<style>
.ui-jqgrid tr.jqgrow td {white-space: normal}
ul#menu li ul li a {cursor:pointer;}
.ui-pager-control{background-color:#222222;}
.ui-jqgrid .ui-jqgrid-hdiv {
    border-left: 0 none !important;
    border-right: 0 none !important;
    border-top: 0 none !important;
    margin: 0;
    overflow-x: hidden;
    overflow-y: auto;
    padding: 0;
    position: relative;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: url("images/ui-bg_glass_40_111111_1x400.png") repeat-x scroll 50% 50% #111111;
    border: 1px solid #777777;
    color: #E3E3E3;
    font-weight: normal;
}

.ui-jqgrid .ui-jqgrid-titlebar {
    border-left: 0 none;
    border-right: 0 none;
    border-top: 0 none;
    padding: 0.3em 0.2em 0.2em 0.3em;
    position: relative;
}
ui.jqgrid.css 
.ui-corner-top {
    -moz-border-radius-topleft: 4px;
    -moz-border-radius-topright: 4px;
}
.ui-widget-header {
    background: url("images/ui-bg_diagonals-thick_8_333333_40x40.png") repeat scroll 50% 50% #333333;
    border: 1px solid #A3A3A3;
    color: #EEEEEE;
    font-weight: bold;
}
.ui-helper-clearfix {
    display: block;
}
</style>

	</head>
	<body>
