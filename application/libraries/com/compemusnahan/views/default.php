<script>
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}	
	$(document).ready(function(){
		$('select#filterGrid').change(function(){
			compemusnahangrid.extra.reloadGrid($(this).val());
		});//.change();
	});
</script>
<h3 class="grid-title"><i class="fa icon-trash"></i>&nbsp;Pemusnahan / Retensi</h3>

<div class="toolbar-grid">
	<label>Filter : &nbsp;</label>
	<select id="filterGrid">
		<option value="all" selected="selected">All</option>
		<option value="inaktif">Inaktif</option>
		<option value="musnahkan">Sudah Dimusnahkan</option>
		<option value="tinjau">Sudah Dinilai Kembali</option>
		<option value="permanen">Permanen</option>
	</select>
	<a style="float:right" onclick="<?=$class_name;?>grid.extra.reloadGrid($('select#filterGrid').val())" href="javascript:;">
	 	<i class="fa icon-refresh"></i>&nbsp;Refresh
	 </a>
	<!-- <a href="javascript:;" onclick="compemusnahangrid.extra.inaktif({data:'inaktif'});">
		<i class="fa icon-filter"></i>&nbsp;Masuk Masa Inaktif
	</a>
	<a href="javascript:;" onclick="compemusnahangrid.extra.musnahatautinjau({data:'musnahortinjau'});">
		<i class="fa icon-filter"></i>&nbsp;Sudah Dimusnahkan/Nilai Kembali
	</a> -->
	
	 <div class="cb"></div>
</div>
<style type="text/css">
.content .toolbar-grid{width: 308px;padding: 12px;}
#gview_gridcompemusnahan tr.jqg-first-row-header{
	display: none;
}
#gview_gridcompemusnahan .ui-pg-div.ui-inline-edit {
    border: 1px solid #DEDEDE;
    border-radius: 7px;
    margin: 0 2px;
    padding: 1px 0px 1px 4px;
    background:#dedede; 
}
#gview_gridcompemusnahan .ui-pg-div.ui-inline-edit:hover{
	
	background: orange;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$(window).resize(function(){
		$('#gridcompemusnahan').jqGrid('setGridWidth',$(window).width()-80)
	});

	setTimeout(function(){
		$(window).resize()
	},500)
});
 
</script>