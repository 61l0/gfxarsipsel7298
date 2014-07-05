<style>
.ui-datepicker{z-index:99999}
</style>
<script>
jQuery(document).ready(function(){
	jQuery( "#tanggal" ).datepicker({ 
	altFormat: 'dd-mm-yy'
	, dateFormat: 'dd-mm-yy'
	, altField:'#tanggal'
	,changeMonth:true
	,changeYear:true
	,index: 0
});
});
</script>
<div id="responceArea" />
<form method="post" action="" id="formpeminjaman">
<?=form_hidden('oper',@$oper);?>
<?=form_hidden('id_surat',@$id_surat);?>
	<table border=0 class="table-flat" width='100%'>
		<tr>
			<td colspan=10>
				<input type='radio' name='typesurat' id='typesurat' value='masuk'  <? if(@$data_edit[0]->type_surat == 'masuk'){?>checked="checked" <? } ?>>Surat Masuk
				<input type='radio' name='typesurat' id='typesurat'  value='keluar' <? if(@$data_edit[0]->type_surat == 'keluar'){?>checked="checked" <? } ?>>Surat Keluar
		</tr>
		<tr id='tr_masuk'>
			<td></td>
			<td></td>
			<td>
				<table>
					<tr>	
					
						<td>Nama Klasifikasi</td>
						<td>:</td>
						<td>
							<input type='hidden' name='kode_kls' id='kode_kls' value='<?=@$data_edit[0]->id_kode_masalah ?>'>
							<input type='text' name='nama_kls' id='nama_kls' value='<?=@$data_edit[0]->klasifikasi ?>' >
						</td>
						<td>
							<input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'>
						</td>
					</tr>
					<tr>
						<td>No Surat</td><td>:</td><td colspan=2><input type='text' name='no_surat' id='no_surat' value='<?=@$data_edit[0]->no_surat ?>'></td>
					</tr>
					<tr>
						<td>Tanggal</td><td>:</td><td colspan=2><input type='text' name='tanggal' id='tanggal' value='<?=@$data_edit[0]->tanggal ?>'> </td>			
					</tr>
					<tr>
						<td>Perihal</td><td>:</td><td colspan=2><input type='text' name='perihal' id='perihal' value='<?=@$data_edit[0]->perihal ?>'></td>			
					</tr>	
					<tr>
						<td>Sistem Penyimpanan</td><td>:</td><td colspan=2>
							<select name='sp' id='sp'>
								<option value='Seri' <? if(@$data_edit[0]->sistem_penyimpanan == 'Seri'){?> selected <? } ?>>Seri</option>
								<option value='Rubrik' <? if(@$data_edit[0]->sistem_penyimpanan == 'Rubrik'){?> selected <? } ?>>Rubrik</option>
								<option value='Dosir' <? if(@$data_edit[0]->sistem_penyimpanan == 'Dosir'){?> selected <? } ?>>Dosir</option>
							</select>
						</td>			
					</tr>	
					<tr>
						<td>Lokasi Penyimpanan</td><td>:</td><td colspan=2>
						<select name='lp' id='lp'>
								<option value='Cabinet' <? if(@$data_edit[0]->sistem_penyimpanan == 'Cabinet'){?> selected <? } ?>>Cabinet</option>
								<option value='Rak' <? if(@$data_edit[0]->sistem_penyimpanan == 'Rak'){?> selected <? } ?>>Rak</option>
								<option value='Boks' <? if(@$data_edit[0]->sistem_penyimpanan == 'Boks'){?> selected <? } ?>>Boks</option>
							</select>
						</td>			
					</tr>	
					<tr>
						<td>Keterangan</td><td>:</td><td colspan=2><textarea name='keterangan' id='keterangan' cols=35 rows=4><?=@$data_edit[0]->keterangan ?></textarea></td>			
					</tr>	
				</table>	
			</td>	
		</tr>
		<tr>
		<td colspan=12>
		<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data();" value='SIMPAN'>
		<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>
	</table>
</form>



	

