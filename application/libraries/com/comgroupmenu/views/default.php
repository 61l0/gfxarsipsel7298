<h3 class="grid-title"><i class="fa icon-th-list"></i>&nbsp;Group Menu</h3>


<script type="text/javascript">
$(document).ready(function () {
	var filter = $('<div></div>').addClass('toolbar-filter');
	setTimeout(function(){
		$('#FirstForm .button-box-skyblue')
		.removeClass('button-box-skyblue')
		.addClass('toolbar-filter').show().parent().addClass('toolbar-grid-cst-0');
	},300);	
})
</script>
<style type="text/css">
.button-box-skyblue,
#header_caption{display: none;}
/*.content .toolbar-grid{width: 187px,height:100px;}*/
/*.toolbar-filter{width: 187px; text-align: center;}*/
.toolbar-grid-cst-0 {
    margin: -3px auto;
    display: block;
    width: 200px;
}
#gbox_gridcomgroupmenu{
	width: auto !important;
	margin-left: 2%;
}


</style>