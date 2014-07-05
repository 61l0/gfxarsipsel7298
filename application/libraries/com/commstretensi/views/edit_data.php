<style>
.ui-datepicker{z-index:99999}
</style>
<script>
jQuery(document).ready(function(){
	jQuery( "#aktif_dari" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#aktif_dari'
		,changeMonth:true
		,changeYear:true
		,index: 0
	});
	jQuery( "#aktif_sampai" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#aktif_sampai'
		,changeMonth:true
		,changeYear:true
		,index: 0
	});
	jQuery( "#inaktif_dari" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#inaktif_dari'
		,changeMonth:true
		,changeYear:true
		,index: 0
	});
	jQuery( "#inaktif_sampai" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#inaktif_sampai'
		,changeMonth:true
		,changeYear:true
		,index: 0
	});
});
</script>
<div id="responceArea" />
<form method="post" action="" id="formretensi">

<input type='hidden' name='oper' id='oper' value='<?=$oper?>'>
<input type='hidden' name='id_retensi' id='id_retensi' value='<?=@$id_retensi?>'>
<input type='hidden' name='id_parent' id='id_parent' value='<?=@$id_parent?>'>
	<table border=0 class="table-flat">

	<? if($name_parent){?>	
		<tr>
			<td>Parent</td>
			<td>:</td>
			<td colspan=10><?=$name_parent?>
			</td>
		</tr>
	<? }?> 	
		<tr>
			<td>Deskripsi</td>
			<td>:</td>
			<td colspan=10><input type='text' name='deskripsi' id='deskripsi' value='<?=$data[0]->desc?>'>
			</td>
		</tr>

		<tr>
			<td>Aktif</td>	
			<td>:</td>
			<td colspan=10><input type='text' name='aktif_dari' id='aktif_dari' value='<?=date('d-m-Y',strtotime($data[0]->aktif_dari))?>'>sd<input type='text' name='aktif_sampai' id='aktif_sampai' value='<?=date('d-m-Y',strtotime($data[0]->aktif_sampai))?>'></td>
		</tr>
		<tr>
			<td>Inaktif</td>	
			<td>:</td>
			<td colspan=10><input type='text' name='inaktif_dari' id='inaktif_dari' value='<?=date('d-m-Y',strtotime($data[0]->inaktif_dari))?>'>sd<input type='text' name='inaktif_sampai' id='inaktif_sampai' value='<?=date('d-m-Y',strtotime($data[0]->inaktif_sampai))?>'></td>
		</tr>
		<tr>
			<td>Keterangan</td>	
			<td>:</td>
			<td colspan=10><textarea cols=45 rows=5 name='keterangan' id='keterangan' ><?=$data[0]->keterangan?></textarea></td>
		</tr>
		<tr>
		<td>
			<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>
	</table>
</form>


	
