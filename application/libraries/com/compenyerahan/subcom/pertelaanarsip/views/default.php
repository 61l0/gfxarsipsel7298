<h3 class="grid-title"><i class="fa icon-exchange"></i>&nbsp;Arsip Pertelaan</h3>
<div class="toolbar-grid" style="width: 289px;">
	 <a onclick="loadFragment('#main_panel_container','admin/com/penyerahan/',{name:'gridcompenyerahan'});" href="javascript:;">
	 	<i class="fa icon-hand-left"></i>&nbsp;Kembali
	 </a>
	 <a onclick="<?=$class_name;?>grid.btn_grid_plus({id_ba:<?=$id_ba?>});" href="javascript:;">
	 	<i class="fa icon-plus-sign"></i>&nbsp;Tambah Data
	 </a>
	 <a href="javascript:;" onclick="$('#gridpertelaanarsip').trigger('reloadGrid')" style="float:right">
	 	<i class="fa icon-refresh"></i>&nbsp;Refresh
	 </a>
	 <div class="cb"></div>
</div>



<script type="text/javascript">
$(document).ready(function(){
	$(window).resize(function(){
		$('#gridpertelaanarsip').jqGrid('setGridWidth',$(window).width()-80)
	});

	setTimeout(function(){
		$(window).resize()
	},500)
});
</script>