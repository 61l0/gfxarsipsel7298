<script>
	var head_content = jQuery("#header_caption_content").hasClass('head-content');
	if(! head_content){
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
	}else{
		jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
	}		
</script>


<h3 class="grid-title"><i class="fa icon-hdd"></i>&nbsp;Master Retensi</h3>

<div class="toolbar-grid">
	 <a href="javascript:;" onclick="<?=$class_name;?>grid.extra.tambah({});">
	 	<i class="fa icon-plus-sign"></i>&nbsp;Tambah Data
	 </a>
	 <div class="cb"></div>
</div>
<style type="text/css">
.content .toolbar-grid{width: 123px}
.ui-jqgrid-view .ui-userdata.ui-state-default{
	display: none;
}
</style>