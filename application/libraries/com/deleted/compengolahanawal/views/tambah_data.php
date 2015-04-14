<style>
.ui-datepicker{z-index:99999}
</style>
<script>

function loadData(type, parent_id){
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',
	{data_type:type, parent_id:parent_id},
	function(data){
	// console.log(data);
		// if(data.error==undifine){
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name));
			}
		// }else{
			// alert(data.error);
		// }
	},'json'
	);
}

$(function(){
	loadData('depo',0);
		
	$('#rdpilih1').click(function () {
		var cek = $('#rdpilih1').val();
		
		
		$('#combobox_depo').change(
			function(){
				if($('#combobox_depo option:selected').val() != ''){
					loadData('rak',$('#combobox_depo option:selected').val());
				}
			}
		);
		$('#combobox_rak').change(
			function(){
				if($('#combobox_rak option:selected').val() != ''){
					loadData('box',$('#combobox_rak option:selected').val());
				}
			}
		);	

		$('#combobox_box').change(
			function(){
				if($('#combobox_box option:selected').val() != ''){
					loadData('folder',$('#combobox_box option:selected').val());
				}
			}
		);		
		
	});
		//untuk kondisi rool
	$('#rdpilih2').click(function () {
		var cek = $('#rdpilih1').val();		
		// loadData('depo',0);	
		$('#combobox_depo').change(
			function(){
				if($('#combobox_depo option:selected').val() != ''){
					loadData('rool',$('#combobox_depo option:selected').val());
				}
			}
		);

		$('#combobox_rool').change(
			function(){
				if($('#combobox_rool option:selected').val() != ''){
					loadData('box_rool',$('#combobox_rool option:selected').val());
				}
			}
		);	

		$('#combobox_box_rool').change(
			function(){
				if($('#combobox_box_rool option:selected').val() != ''){
					loadData('folder_rool',$('#combobox_box_rool option:selected').val());
				}
			}
		);		
	});
	
	
});

$('#rdpilih1').click(function () {
	var cek = $('#rdpilih1').val();
      if ($("#tr_rak").is(":hidden")) {
		$("#rool").val("");
		$("#box_rool").val("");
		$("#folder_rool").val("");
	  
		$("#tr_rool").hide();
        $("#tr_rak").slideDown("slow");
      }
    });

$('#rdpilih2').click(function () {
	var cek = $('#rdpilih2').val();
      if ($("#tr_rool").is(":hidden")) {
		$("#rak").val("");
		$("#box").val("");
		$("#folder").val("");
		
		$("#tr_rak").hide();
        $("#tr_rool").slideDown("slow");
      }
    });

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

jQuery(function(){
	jQuery("#judul").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Judul Tidak Boleh Kosong"
	});	
	

});	

$(function(){
	$('#judul').autocomplete('<?=site_url('admin/com/pengolahan');?>/autocomplete_judularsip',
		{
			parse: function(data){ 
			var parsed = [];
				for (var i=0; i < data.length; i++) {
					parsed[i] = {
						data: data[i],
						value: data[i].judul 
					};
				}
				return parsed;				
			},
			formatItem: function(data,i,max){
				var str = '<div class="search_content">';
				
				str += '<u>'+data.judul+'</u>';
				str += '</div>';
				return str;
			},
			width: 270, 
			dataType: 'json' 	
			
			
		}
	
	).result(
			function(event,data,formated){
			
				$('#judul').val(data.judul); 
				
				
			}	
	);
});	
</script>
<div id="responceArea" />
 <form action="" method="post" id="formpengolahan" class="AdvancedForm">
<?=form_hidden('oper',@$oper);?>
	<table border=0 class="table-flat">

		
		<tr>
			<td>Nama Klasifikasi</td>
			<td>:</td>
			<td>
			<input type='hidden' name='kode_kls' id='kode_kls'>
			<input type='text' name='nama_kls' id='nama_kls' ></td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'></td>
			</td>
		</tr>

	
		
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><input type='text' name='judul' id='judul' ></td>
		</tr>
		
		<tr>
			<td>Nomor Arsip</td>
			<td>:</td>
			<td><input type='text' name='no_arsip' id='no_arsip' > </td>
			<td>Agenda  </td><td>: </td><td><input type='text' name='agenda' id='agenda' size=10></td>
			<td width=100>Kode Komponen  </td><td>: </td><td><input type='text' name='kode_komp' id='kode_komp' size=11></td>
			<td>Tahun  </td><td>: </td><td><select name='tahun' id='tahun'>
				<option value=''>--pilih--</option>
				<? foreach($tahun as $th){ ?>
				<option value=<?=$th?>><?=$th?></option>
				<? } ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td colspan=10><input type='text' name='tanggal' id='tanggal'></td>
		</tr>	

		<tr>
			<td>Unit Pengolah</td>
			<td>:</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' >
				<input type='text' name='unit_pengolah' id='unit_pengolah' >
			</td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>

		<tr>
			<td>Lokasi</td>
			<td>:</td>
			<td colspan=10><input type='text' name='lokasi' id='lokasi' ></td>
		</tr>

		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td colspan=10><textarea cols=40 rows=4 name='keterangan' id='keterangan' ></textarea></td>
		</tr>	
		<tr>
			<td>Type Penyimpanan</td>
			<td>:</td>
			<td colspan=10><input type='radio' name='rdpilih' id='rdpilih1' value='rak'>Rak<input type='radio' name='rdpilih' id='rdpilih2'  value='rool'>Rool O'Peek</td>
		</tr>
		<tr>
			<td width=150>Lokasi Penyimpanan</td>
			<td>:</td>
			<td colspan=10>
				<select name='lokasi_penyimpanan_depo' id='combobox_depo'>
				
				</select>
			</td>
		</tr>
		

		<tr id='tr_rak'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>	
						<td></td>
						<td></td>
						<td>Rak</td><td>:</td><td>
							<select name='rak' id='combobox_rak'>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Box</td><td>:</td><td>
							<select name='box' id='combobox_box'>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Folder</td><td>:</td><td>
							<select name='folder' id='combobox_folder'>
								<option></option>
							</select>
						</td>			
					</tr>	
				</table>	
			</td>	
		</tr>

		<tr id='tr_rool' style='display:none;'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>	
						<td></td>
						<td></td>
						<td>Rool Opeek</td><td>:</td><td>
							<select name='rool' id='combobox_rool'>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Box</td><td>:</td><td>
							<select name='box_rool' id='combobox_box_rool'>
								<option></option>
							</select>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Folder</td><td>:</td><td>
							<select name='folder_rool' id='combobox_folder_rool'>
								<option></option>
							</select>
						</td>			
					</tr>		
				</table>			
			</td>	
		</tr>	
		
		<tr>
			<td>Retensi</td>
			<td>:</td>
			<td>
				<input type='text' name='retensi' id='retensi' disabled="disabled">
				<input type='hidden' name='id_retensi' id='id_retensi'>
			</td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_retensi();" value='Pilih'></td>
		</tr>
		
		<tr>
			<td>Jenis Arsip</td>
			<td>:</td>
			<td colspan=10>
				<select name='jenis_arsip' id='jenis_arsip'>
					<option>--pilih--</option>
					<? foreach($jenis_arsip as $jenis) { ?>
						<option value='<?=$jenis->id_jenis?>'><?=$jenis->name?></option>
					<? } ?>	
				</select>
			</td>
		</tr>	

		<tr>
			<td>Sifat Arsip</td>
			<td>:</td>
			<td colspan=10>
				<select name='sifat_arsip' id='sifat_arsip'>
					<option>--pilih--</option>
					<? foreach($sifat_arsip as $sifat) { ?>
						<option value='<?=$sifat->id_sifat?>'><?=$sifat->name?></option>
					<? } ?>	
				</select>
			</td>
		</tr>	
	<tr>
		<td colspan=12>
			<input type='button' class="bt-blue-common" id="aaa" onclick="<?=$class_name;?>grid.extra.simpan_data({id:'1'});" value='SIMPAN'>
		
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>
	</table>
</form>


	
