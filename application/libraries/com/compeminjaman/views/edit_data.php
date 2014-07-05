<style>
.ui-datepicker{z-index:99999}
</style>
<script>
$('#klpilih1').click(function () {
	var cek = $('#klpilih1').val();
      if ($("#tr_instansi").is(":hidden")) {
		$("#rool").val("");
		$("#box_rool").val("");
		$("#folder_rool").val("");
	  
		$("#tr_lembaga").hide();
        $("#tr_instansi").slideDown("slow");
      }
    });

$('#klpilih2').click(function () {
	var cek = $('#klpilih2').val();
      if ($("#tr_lembaga").is(":hidden")) {
		
		
		$("#tr_instansi").hide();
        $("#tr_lembaga").slideDown("slow");
      }
    });

$('#klpilih3').click(function () {
	var cek = $('#klpilih3').val();
      if ($("#tr_lembaga").is(":hidden")) {
		$("#rak").val("");
		$("#box").val("");
		$("#folder").val("");
		
		$("#tr_instansi").hide();
        $("#tr_lembaga").slideDown("slow");
      }
    });
jQuery(document).ready(function(){
	jQuery( "#tgl_pinjam_skpd" ).datepicker({ 
	altFormat: 'dd-mm-yy'
	, dateFormat: 'dd-mm-yy'
	, altField:'#tgl_pinjam_skpd'
	,changeMonth:true
	,changeYear:true
	,index: 0
});
});
jQuery(document).ready(function(){
	jQuery( "#tgl_kembali_skpd" ).datepicker({ 
	altFormat: 'dd-mm-yy'
	, dateFormat: 'dd-mm-yy'
	, altField:'#tgl_kembali_skpd'
	,changeMonth:true
	,changeYear:true
	,index: 0
});
});
jQuery(document).ready(function(){
	jQuery( "#tgl_pinjam_lp" ).datepicker({ 
	altFormat: 'dd-mm-yy'
	, dateFormat: 'dd-mm-yy'
	, altField:'#tgl_pinjam_lp'
	,changeMonth:true
	,changeYear:true
	,index: 0
});
});
jQuery(document).ready(function(){
	jQuery( "#tgl_kembali_lp" ).datepicker({ 
	altFormat: 'dd-mm-yy'
	, dateFormat: 'dd-mm-yy'
	, altField:'#tgl_kembali_lp'
	,changeMonth:true
	,changeYear:true
	,index: 0
});
});
</script>
<? //dump($data_edit);?>
<div id="responceArea" />
<form method="post" action="" id="formpeminjaman">
<?=form_hidden('oper',@$oper);?>
<?=form_hidden('id_peminjaman',@$id_peminjaman);?>
	<table border=0 class="table-flat" width="98%">
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				<select name='status' id='status'>
						<option value='pinjam' <? if($data_edit[0]->status == 'pinjam') {?> selected='selected' <? } ?>>Pinjam</option>
						<option value='kembali' <? if($data_edit[0]->status == 'kembali') {?> selected='selected' <? } ?>>Kembali</option>
						<option value='duplikasi' <? if($data_edit[0]->status == 'duplikasi') {?> selected='selected' <? } ?>>Duplikasi</option>
				</select>
			</td>
			
		</tr>

		<tr>
			<td>Kode Arsip</td>
			<td>:</td>
			<td>
			<input type='text' name='kode_arsip' id='kode_arsip'  value='<?=$data_edit[0]->id_data?>'>
			<input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_arsip();" value='Pilih'>
			</td>
		</tr>
		
		<tr>
			<td>Judul Arsip</td>
			<td>:</td>
			<td><input type='text' name='judul_arsip' id='judul_arsip' size=50 disabled='disabled' value='<?=$data_edit[0]->judul?>'></td>
		</tr>
		

		
		<tr>
			<td></td>
			<td></td>
			<td >
				<input type='radio' name='klpilih' id='klpilih1' value='instansi' <? if($data_edit[0]->type_client == 'instansi') {?> checked="checked" <? } ?>>Instansi/Skpd
				<input type='radio' name='klpilih' id='klpilih2'  value='lembaga' <? if($data_edit[0]->type_client == 'lembaga') {?> checked="checked" <? } ?>>Lembaga
				<input type='radio' name='klpilih' id='klpilih3'  value='perorangan' <? if($data_edit[0]->type_client == 'perorangan') {?> checked="checked" <? } ?>>Perorangan</td>
		</tr>
		<tr id='tr_instansi' <? if($data_edit[0]->type_client == 'lembaga' || $data_edit[0]->type_client == 'perorangan' ){?> style='display:none;' <? } ?>>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>	
						<td></td>
						<td></td>
						<td>Instansi/Skpd</td><td>:</td><td>
							<input type='hidden' name='id_skpd' id='id_skpd' value='<?=$data_edit[0]->id_skpd?>'>
							<input type='text' name='instansi' id='instansi' value='<?=$data_edit[0]->nama_lengkap?>'>
						</td>
						<td><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Nama Klient</td><td>:</td><td><input type='text' name='nama_klient_skpd' id='nama_klient_skpd' value='<?=$data_edit[0]->nama_peminjam?>'></td>
					</tr>
						<td></td>
						<td></td>
						<td>Nama Pemberi Kuasa</td><td>:</td><td><input type='text' name='pemberi_kuasa_skpd' id='pemberi_kuasa_skpd' value='<?=$data_edit[0]->nama_pemberi_kuasa?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Identitas Pemberi Kuasa</td><td>:</td><td><input type='text' name='nipk_skpd' id='nipk_skpd' value='<?=$data_edit[0]->no_identitas_pemberi_kuasa?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Pinjam</td><td>:</td><td><input type='text' name='tgl_pinjam_skpd' id='tgl_pinjam_skpd' value='<?=date('d-m-Y',strtotime($data_edit[0]->tanggal_pinjam))?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Copy/Asli</td><td>:</td><td>
							<select name='copy_skpd' id='copy_skpd'>
								<option value=''>--pilih--</option>
								<option value='copy' <? if($data_edit[0]->type_arsip == 'copy') {?> selected='selected' <? } ?>>Copy</option>
								<option value='asli' <? if($data_edit[0]->type_arsip == 'asli') {?> selected='selected' <? } ?>>Asli</option>
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Jumlah Arsip</td><td>:</td><td><input type='text' name='jml_arsip_skpd' id='jml_arsip_skpd' value='<?=$data_edit[0]->jumlah_arsip?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Surat Permohonan</td><td>:</td><td><input type='text' name='nsp_skpd' id='nsp_skpd' value='<?=$data_edit[0]->no_surat?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Status Hasil</td><td>:</td><td>
							<select name='status_hasil_skpd' id='status_hasil_skpd'>
								<option value=''>--pilih--</option>
								<option value='ada' <? if($data_edit[0]->status_hasil == 'ada') {?> selected='selected' <? } ?>>Ada</option>
								<option value='tidakada' <? if($data_edit[0]->status_hasil == 'tidakada') {?> selected='selected' <? } ?>>Tida Ada</option>
								
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Kembali</td><td>:</td><td><input type='text' name='tgl_kembali_skpd' id='tgl_kembali_skpd' value='<?=date('d-m-Y',strtotime($data_edit[0]->tanggal_kembali))?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Nama Petugas</td><td>:</td><td><input type='text' name='nama_petugas_skpd' id='nama_petugas_skpd' value='<?=date('d-m-Y',strtotime($data_edit[0]->nama_petugas))?>'></td>			
					</tr>	
					
					
				</table>	
			</td>	
		</tr>

		<tr id='tr_lembaga' <? if($data_edit[0]->type_client == 'instansi'){?> style='display:none;' <? } ?>>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
						<td></td>
						<td></td>
						<td>Nama Klient</td><td>:</td><td><input type='text' name='nama_klient_lp' id='nama_klient_lp' value='<?=$data_edit[0]->nama_peminjam?>'></td>
					</tr>
					<tr>	
						<td></td>
						<td></td>
						<td>Alamat Klient</td><td>:</td><td><input type='text' name='alamat_klient' id='alamat_klient' value='<?=$data_edit[0]->alamat?>'></td>
					</tr>
					<tr>	
						<td></td>
						<td></td>
						<td>No Identitas Klient</td><td>:</td><td><input type='text' name='nik' id='nik' value='<?=$data_edit[0]->no_identitas?>'></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td>Nama Pemberi Kuasa</td><td>:</td><td><input type='text' name='pemberi_kuasa_lp' id='pemberi_kuasa_lp' value='<?=$data_edit[0]->nama_pemberi_kuasa?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Identitas Pemberi Kuasa</td><td>:</td><td><input type='text' name='nipk_lp' id='nipk_lp' value='<?=$data_edit[0]->no_identitas_pemberi_kuasa?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Pinjam</td><td>:</td><td><input type='text' name='tgl_pinjam_lp' id='tgl_pinjam_lp' value='<?=date('d-m-Y',strtotime($data_edit[0]->tanggal_pinjam))?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Copy/Asli</td><td>:</td><td>
							<select name='copy_lp' id='copy_lp'>
								<option value=''>--pilih--</option>
								<option value='copy' <? if($data_edit[0]->type_arsip == 'copy') {?> selected='selected' <? } ?>>Copy</option>
								<option value='asli' <? if($data_edit[0]->type_arsip == 'asli') {?> selected='selected' <? } ?>>Asli</option>
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Jumlah Arsip</td><td>:</td><td><input type='text' name='jml_arsip_lp' id='jml_arsip_lp' value='<?=$data_edit[0]->jumlah_arsip?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Surat Permohonan</td><td>:</td><td><input type='text' name='nsp_lp' id='nsp_lp' value='<?=$data_edit[0]->no_surat?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Bukti Verifikasi</td><td>:</td><td><input type='text' name='verifikasi' id='verifikasi' value='<?=$data_edit[0]->bukti_verifikasi?>'></td>			
					</tr>		
					</tr>
						<td></td>
						<td></td>
						<td>Keperluan</td><td>:</td><td><input type='text' name='keperluan' id='keperluan' value='<?=$data_edit[0]->keperluan?>'></td>			
					</tr>		
					
					</tr>
						<td></td>
						<td></td>
						<td>Status Hasil</td><td>:</td><td>
							<select name='status_hasil_lp' id='status_hasil_lp'>
								<option value=''>--pilih--</option>
								<option value='ada' <? if($data_edit[0]->status_hasil == 'ada') {?> selected='selected' <? } ?>>Ada</option>
								<option value='tidakada' <? if($data_edit[0]->status_hasil == 'tidakada') {?> selected='selected' <? } ?>>Tida Ada</option>
								
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Kembali</td><td>:</td><td><input type='text' name='tgl_kembali_lp' id='tgl_kembali_lp' value='<?=date('d-m-Y',strtotime($data_edit[0]->tanggal_kembali))?>'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Nama Petugas</td><td>:</td><td><input type='text' name='nama_petugas_lp' id='nama_petugas_lp' value='<?=$data_edit[0]->nama_petugas?>'></td>			
					</tr>	
					
					
				</table>	
			</td>	
		</tr>
		<tr>
		<td colspan=12>
			<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>
	</table>
</form>

<table>

</table>	


	

