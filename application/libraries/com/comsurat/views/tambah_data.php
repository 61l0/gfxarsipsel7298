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
	<table border="1" class="table-flat" width="100%">
		<tr>
			<td colspan=10>
				<input type='radio' name='typesurat' id='typesurat' value='masuk' checked="checked">Surat Masuk
				<input type='radio' name='typesurat' id='typesurat'  value='keluar'>Surat Keluar
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
							<input type='hidden' name='kode_kls' id='kode_kls'>
							<input type='text' name='nama_kls' id='nama_kls' >
						</td>
						<td>
							<input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'>
						</td>
					</tr>
					<tr>
						<td>No Surat</td><td>:</td><td colspan=2><input type='text' name='no_surat' id='no_surat'></td>
					</tr>
					<tr>
						<td>Tanggal</td><td>:</td><td colspan=2><input type='text' name='tanggal' id='tanggal'></td>			
					</tr>
					<tr>
						<td>Perihal</td><td>:</td><td colspan=2><input type='text' name='perihal' id='perihal'></td>			
					</tr>	
					<tr>
						<td>Sistem Penyimpanan</td><td>:</td><td colspan=2>
							<select name='sp' id='sp'>
								<option value='Seri'>Seri</option>
								<option value='Rubrik'>Rubrik</option>
								<option value='Dosir'>Dosir</option>
							</select>
						</td>			
					</tr>	
					<tr>
						<td>Lokasi Penyimpanan</td><td>:</td><td colspan=2>
						<select name='lp' id='lp'>
								<option value='Cabinet'>Cabinet</option>
								<option value='Rak'>Rak</option>
								<option value='Boks'>Boks</option>
							</select>
						</td>			
					</tr>	
					<tr>
						<td>Keterangan</td><td>:</td><td colspan=2><textarea name='keterangan' id='keterangan' cols=35 rows=4></textarea></td>			
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



	

