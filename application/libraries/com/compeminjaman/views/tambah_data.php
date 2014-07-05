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
<div id="responceArea" />
<form method="post" action="" id="formpeminjaman">
<?=form_hidden('oper',@$oper);?>
	<table border=0 class="table-flat" width="98%">
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				<select name='status' id='status'>
						<option value='pinjam'>Pinjam</option>
						<option value='kembali'>Kembali</option>
						<option value='duplikasi'>Duplikasi</option>
				</select>
			</td>
			
		</tr>

		<tr>
			<td>Daftar Arsip</td>
			<td>:</td>
			<td>
			<input type="text" id="ac_kode_arsip"/>	
			<input type='hidden' name='kode_arsip' id='kode_arsip' >
			<input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_arsip({term:$('#ac_kode_arsip').val()});" value='Cari'>
			</td>
		</tr>
		
		<tr>
			<td>Judul Arsip</td>
			<td>:</td>
			<td><input type='text' name='judul_arsip' id='judul_arsip' size=50 disabled='disabled'></td>
		</tr>
		

		
		<tr>
			<td></td>
			<td></td>
			<td >
				<input type='radio' name='klpilih' id='klpilih1' value='instansi' checked="checked">Instansi/Skpd
				<input type='radio' name='klpilih' id='klpilih2'  value='lembaga'>Lembaga
				<input type='radio' name='klpilih' id='klpilih3'  value='perorangan'>Perorangan</td>
		</tr>
		<tr id='tr_instansi'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>	
						<td></td>
						<td></td>
						<td>Instansi/Skpd</td><td>:</td><td>
							<input type='hidden' name='id_skpd' id='id_skpd'>
							<input type='text' name='instansi' id='instansi'>
						</td>
						<td><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Nama Klient</td><td>:</td><td><input type='text' name='nama_klient_skpd' id='nama_klient_skpd'></td>
					</tr>
						<td></td>
						<td></td>
						<td>Nama Pemberi Kuasa</td><td>:</td><td><input type='text' name='pemberi_kuasa_skpd' id='pemberi_kuasa_skpd'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Identitas Pemberi Kuasa</td><td>:</td><td><input type='text' name='nipk_skpd' id='nipk_skpd'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Pinjam</td><td>:</td><td><input type='text' name='tgl_pinjam_skpd' id='tgl_pinjam_skpd'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Copy/Asli</td><td>:</td><td>
							<select name='copy_skpd' id='copy_skpd'>
								<option value=''>--pilih--</option>
								<option value='copy'>Copy</option>
								<option value='asli'>Asli</option>
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Jumlah Arsip</td><td>:</td><td><input type='text' name='jml_arsip_skpd' id='jml_arsip_skpd'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Surat Permohonan</td><td>:</td><td><input type='text' name='nsp_skpd' id='nsp_skpd'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Status Hasil</td><td>:</td><td>
							<select name='status_hasil_skpd' id='status_hasil_skpd'>
								<option value=''>--pilih--</option>
								<option value='ada'>Ada</option>
								<option value='tidakada'>Tida Ada</option>
								
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Kembali</td><td>:</td><td><input type='text' name='tgl_kembali_skpd' id='tgl_kembali_skpd'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Nama Petugas</td><td>:</td><td><input type='text' name='nama_petugas_skpd' id='nama_petugas_skpd'></td>			
					</tr>	
					
					
				</table>	
			</td>	
		</tr>

		<tr id='tr_lembaga' style='display:none;'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
						<td></td>
						<td></td>
						<td>Nama Klient</td><td>:</td><td><input type='text' name='nama_klient_lp' id='nama_klient_lp'></td>
					</tr>
					<tr>	
						<td></td>
						<td></td>
						<td>Alamat Klient</td><td>:</td><td><input type='text' name='alamat_klient' id='alamat_klient'></td>
					</tr>
					<tr>	
						<td></td>
						<td></td>
						<td>No Identitas Klient</td><td>:</td><td><input type='text' name='nik' id='nik'></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td>Nama Pemberi Kuasa</td><td>:</td><td><input type='text' name='pemberi_kuasa_lp' id='pemberi_kuasa_lp'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Identitas Pemberi Kuasa</td><td>:</td><td><input type='text' name='nipk_lp' id='nipk_lp'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Pinjam</td><td>:</td><td><input type='text' name='tgl_pinjam_lp' id='tgl_pinjam_lp'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Copy/Asli</td><td>:</td><td>
							<select name='copy_lp' id='copy_lp'>
								<option value=''>--pilih--</option>
								<option value='copy'>Copy</option>
								<option value='asli'>Asli</option>
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Jumlah Arsip</td><td>:</td><td><input type='text' name='jml_arsip_lp' id='jml_arsip_lp'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>No Surat Permohonan</td><td>:</td><td><input type='text' name='nsp_lp' id='nsp_lp'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Bukti Verifikasi</td><td>:</td><td><input type='text' name='verifikasi' id='verifikasi'></td>			
					</tr>		
					</tr>
						<td></td>
						<td></td>
						<td>Keperluan</td><td>:</td><td><input type='text' name='keperluan' id='keperluan'></td>			
					</tr>		
					
					</tr>
						<td></td>
						<td></td>
						<td>Status Hasil</td><td>:</td><td>
							<select name='status_hasil_lp' id='status_hasil_lp'>
								<option value=''>--pilih--</option>
								<option value='ada'>Ada</option>
								<option value='tidakada'>Tida Ada</option>
								
							</select>
						</td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Tanggal Kembali</td><td>:</td><td><input type='text' name='tgl_kembali_lp' id='tgl_kembali_lp'></td>			
					</tr>	
					</tr>
						<td></td>
						<td></td>
						<td>Nama Petugas</td><td>:</td><td><input type='text' name='nama_petugas_lp' id='nama_petugas_lp'></td>			
					</tr>	
					
					
				</table>	
			</td>	
		</tr>
	<tr>
		<td colspan=12>
			<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_peminjaman();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>		
	</table>
</form>

<table>

</table>	
<script type="text/javascript">
$(document).ready(function(){

	// AUTOCOMPLETE CARI ARSIP DATA

	var keys= ['judul','no_arsip','tahun','lokasi'];
	var url = "<?php echo site_url('admin/com/peminjaman');?>/autocomplete_daftar_arsip";
	$('#ac_kode_arsip').keyup(function(){
		var val = $(this).val();
		if(val.length)
			$(this).data('val',val);
	})
	$('#ac_kode_arsip').autocomplete(url,{
		extraParams: {
			// type_cari : function() { 
			// 	return $('#pilih_cari option:selected').val()
			// },					  
		},
		parse: function(data){ 
			//console.log(data);
			var term   = $('#ac_kode_arsip').val();
			// var parsed = [];
			// $.each(data,function(k,obj){
			// 	// $.each(keys,function(l,p){
			var regex = new RegExp('('+term+')','ig');
			// 	if(obj.hasil.match( regex ) ){
			// 	 		obj.hasil= obj.hasil.replace(regex,'<b>$1</b>');// = '<b>' + obj[p] + '</b>'; 
			// 	}
			// 	// });
			// 	parsed.push(obj);
			// });

			// //console.log(parsed);
			// parsed = data;
			// return parsed;				
			var parsed = [];
			for (var i=0; i < data.length; i++) {
				var properties = data[i].hasil.split(':=:');
				var keys ="judul,no_arsip,tahun,lokasi".split(',');
				var ndata={ hasil : ''};
				$.each(properties,function(i,obj){
					if(obj.match( regex ) ){
					 		ndata.hasil= keys[i-1].replace(/no_arsip/,'no._berkas').toUpperCase().replace(/_/,' ') + ' : ' +obj;// = '<b>' + obj[p] + '</b>'; 
							ndata.id = properties[0];
							ndata.judul = properties[1];
					}
					//console.log(obj)
					//hasil = obj.replace(regex,'<b>$1</b>');
				});
				
				parsed[i] = {
					data: ndata,
					value: ndata.hasil
					//id:
				};
			}
			//console.log(parsed);
			return parsed;
		},
		formatItem: function(data,i,max){
			var str = '<div class="search_content">';
			str += '<u>'+data.hasil+'</u>';
			str += '</div>';
			return str;
		},
		width: 270, 
		dataType: 'json' 	
	}).result(function(event,data,formated){
		//console.log();
		$('#ac_kode_arsip').val(data.hasil.split(' : ')[1]); 
		$('#kode_arsip').val(data.id);
		$('#judul_arsip').val(data.judul);
	});
});			

</script>