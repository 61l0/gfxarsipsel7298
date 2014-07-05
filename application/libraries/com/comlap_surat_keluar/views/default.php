<h3 class="grid-title"><i class="fa icon-tasks"></i>&nbsp;Laporan Surat Keluar</h3>

<div class="toolbar-grid">
	 
	 <div class="cb"></div>
</div>
<div class="toolbar-filter">
	<span>Bulan Entri : &nbsp;</span>
	<select name='pilihbulan' id='pilihbulan'>
		<option value=''>ALL</option>
		<? foreach($bulan as $row){?>
		<option value='<?=$row?>'><?=$row?></option>
		<? } ?>
	</select><br/><br/>

	<span>Tahun Entri : &nbsp;</span>
	<select name='pilihtahun' id='pilihtahun'>
		<option value=''>ALL</option>
		<? foreach($tahun as $row){?>
		<option value='<?=$row?>'><?=$row?></option>
		<? } ?>
	</select><br/>
	<div>
	<form id="myForm" action="<?=site_url('admin/com/lap_surat_keluar');?>/rptsuratkeluar/" target="_blank" method="post">
			<input type="hidden" id="pengolah" name="pengolah" >
			<input type="hidden" id="bulan" name="bulan" >
			<input type="hidden" id="tahun" name="tahun" >
			<input type="submit" class="bt-blue-common" value="PROSES">
		</form>
	</div>
</div>
<style type="text/css">
.content .toolbar-grid{width: 243px}
#gbox_gridcomonline{
	width: auto !important;
	margin-left: 2%;
}
.toolbar-filter{
	display: block !important;
	padding: 29px;
	text-align: center;

	border: solid 1px orange;
	border-radius: 4px; 
}
.content .toolbar-grid{
	height: 25px;
}
#myForm > select{
	cursor: pointer;
}
#myForm{
	height: 33px;
	padding: 18px;
	text-align: center;
}
#myForm > .bt-blue-common{
	float: none;
}
</style>
<script>

	$('#pilihbulan').change(function(){
		var bulan = $(this).val()
		$('#bulan').val(bulan);
	});
	$('#pilihtahun').change(function(){
		var tahun = $(this).val()
		$('#tahun').val(tahun);
	});

	
var head_content = jQuery("#header_caption_content").hasClass('head-content');
if(! head_content){
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
}else{
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
}
		
</script>