<style>
.ui-datepicker{z-index:99999}\
textarea#keterangan{
	height: 29px !important;
	width: 726px !important;
}
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

			// $('#combobox_'+type).change(function(){

			// })
		// }else{
			// alert(data.error);
		// }
			//if(type == 'depo')
			//	$('#rdpilih1').click();
			//else if(type == 'rool')
			//console.log(type)
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
		var cek = $('#rdpilih2').val();		
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

function loadDataedit(type, parent_id){
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',
	{data_type:type, parent_id:parent_id},
	function(data){
			var val_depo = $('#id_depo').val();
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name).attr("selected","selected"));
				$('#combobox_'+type).val(val_depo).Selected = true;
			}

	},'json'
	);
}
function loadDataeditrak(type, parent_id){
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',
	{data_type:type, parent_id:parent_id},
	function(data){
			var val_rak = $('#id_rak').val();
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name).attr("selected","selected"));
				$('#combobox_'+type).val(val_rak).Selected = true;
			}

	},'json'
	);
}
function loadDataeditbox(type, parent_id){
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',
	{data_type:type, parent_id:parent_id},
	function(data){
			var val_box = $('#id_box').val();
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name).attr("selected","selected"));
				$('#combobox_'+type).val(val_box).Selected = true;
			}

	},'json'
	);
}
function loadDataeditfolder(type, parent_id){
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',
	{data_type:type, parent_id:parent_id},
	function(data){
			var val_folder = $('#id_folder').val();
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name).attr("selected","selected"));
				$('#combobox_'+type).val(val_folder).Selected = true;
			}

	},'json'
	);
}
function loadDataeditrool(type, parent_id){
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',
	{data_type:type, parent_id:parent_id},
	function(data){
			var val_rool = $('#id_rool').val();
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name).attr("selected","selected"));
				$('#combobox_'+type).val(val_rool).Selected = true;
			}

	},'json'
	);
}

// untuk kondisi edit
if($("input[name='rdpilih']:checked").val() == 'rak'){
	
	loadDataedit('depo',0);
		
	if($('#id_depo').val() != ''){
		loadDataeditrak('rak',$('#id_depo').val());
	}
	if($('#id_rak').val() != ''){
		loadDataeditbox('box',$('#id_rak').val());
	}
	if($('#id_box').val() != ''){
		loadDataeditfolder('folder',$('#id_box').val());
	}
		
}else{
	loadDataedit('depo',0);
		
	if($('#id_depo').val() != ''){
		loadDataeditrak('rool',$('#id_depo').val());
	}
	if($('#id_rool').val() != ''){
		loadDataeditbox('box_rool',$('#id_rool').val());
	}
	if($('#id_box').val() != ''){
		loadDataeditfolder('folder_rool',$('#id_box').val());
	}
}
if($("input[name='rdpilih']:checked").val() == 'rool'){
     if ($("#tr_rool").is(":hidden")) {
		$("#rak").val("");
		$("#box").val("");
		$("#folder").val("");
		
		$("#tr_rak").hide();
        $("#tr_rool").slideDown("slow");
      }
}

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
	$("select[name='lokasi_penyimpanan_depo']").change();
	$("input[name='rdpilih1']").change();
});


jQuery(function(){
	jQuery("#judul").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Judul Tidak Boleh Kosong"
	});	
	

});	
</script>

<div id="responceArea" />

<?=form_open('#',' id="formpengolahan"');?>
<?=form_hidden('oper',@$oper);?>
<?=form_hidden('id_data',@$id_data);?>
<?php
	$is_rool = ($lokasi_simpan[0]->type == 'rool');
?>
<input type='hidden' name='id_depo' id='id_depo' value='<?=!$is_rool ? @$lokasi_simpan[0]->id_lokasisimpan : ""?>'>
<input type='hidden' name='id_rak' id='id_rak' value='<?=@$lokasi_simpan[1]->id_lokasisimpan?>'>
<input type='hidden' name='id_box' id='id_box' value='<?=@$lokasi_simpan[2]->id_lokasisimpan?>'>
<input type='hidden' name='id_folder' id='id_folder' value='<?=@$lokasi_simpan[3]->id_lokasisimpan?>'>
<input type='hidden' name='id_rool' id='id_rool' value='<?= $is_rool ? @$lokasi_simpan[0]->id_lokasisimpan :""?>'>
	<table border=0 class="table-flat">

		
		<tr>
			<td>Kode Klasifikasi</td>
			<td>:</td>
			<td>
			<input type='hidden' name='kode_kls' id='kode_kls' value='<?=@$data_edit[0]->id_kode_masalah?>'>
			<input type='text' name='nama_kls' id='nama_kls' value='<?=@$data_edit[0]->nama_masalah?>' disabled="disabled"></td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'></td>
			</td>
		</tr>

	
		
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><input type='text' name='judul' id='judul' value='<?=@$data_edit[0]->judul?>'></td>
		</tr>
		
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td><input type='text' name='no_arsip' id='no_arsip' value='<?=@$data_edit[0]->no_arsip?>'> </td>
			<td>Agenda  </td><td>: </td><td><input type='text' name='agenda' id='agenda' size=10 value='<?=@$data_edit[0]->agenda?>'></td>
			<td width=100>Kode Komponen  </td><td>: </td><td>
			<input type='text' name='kode_komp' id='kode_komp' size=11 value='<?=@$data_edit[0]->kode_komponen?>'></td>
			<td>Tahun  </td><td>: </td><td><select name='tahun' id='tahun'>
				<option>--pilih--</option>
				<? foreach($tahun as $th){ ?>
				<option value=<?=$th?> <? if($th==@$data_edit[0]->tahun){?> selected='selected' <? } ?>><?=$th?></option>
				<? } ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Tanggal Berkas</td>
			<td>:</td>
			<td colspan=10><input type='text' name='tanggal' id='tanggal' value='<?=date('d-m-Y',strtotime(@$data_edit[0]->tanggal))?>'></td>
		</tr>	

		<tr>
			<td>Unit Pengolah</td>
			<td>:</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' value='<?=@$data_edit[0]->id_skpd?>'>
				<input type='text' name='unit_pengolah' id='unit_pengolah' value='<?=@$data_edit[0]->nama_lengkap?>' disabled="disabled">
			</td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>

		<tr>
			<td>Lokasi</td>
			<td>:</td>
			<td colspan=10><input type='text' name='lokasi' id='lokasi' value='<?=@$data_edit[0]->lokasi?>'></td>
		</tr>

		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td colspan=10><textarea cols=40 rows="1" name='keterangan' id='keterangan' ><?=@$data_edit[0]->desc?></textarea></td>
		</tr>	
				
		<tr>
			<td>Type Penyimpanan</td>
			<td>:</td>
			<td colspan=10><input type='radio' name='rdpilih' id='rdpilih1' value='rak'  <? if(@$lokasi_simpan[1]->type == 'rak' || @$lokasi_simpan[1]->type == ''){ ?>checked="checked" <? } ?>>Rak&nbsp;&nbsp;<input type='radio' name='rdpilih' id='rdpilih2'  value='rool' <? if(@$lokasi_simpan[1]->type == 'rool' || @$lokasi_simpan[1]->type == ''){ ?>checked="checked" <? } ?>>Rool O'Pack</td>
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
				<input type='hidden' name='id_retensi' id='id_retensi' value='<?=@$data_edit[0]->id_retensi?>'>
				<input type='text' name='retensi' id='retensi' disabled="disabled" value='<?=@$data_edit[0]->nama_retensi?>'>
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
						<option value='<?=$jenis->id_jenis?>' <? if(@$jenis->id_jenis==@$data_edit[0]->id_jenis){?> selected='selected' <? } ?> ><?=$jenis->name?></option>
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
						<option value='<?=$sifat->id_sifat?>'  <? if(@$sifat->id_sifat==@$data_edit[0]->id_sifat){?> selected='selected' <? } ?>><?=$sifat->name?></option>
					<? } ?>	
				</select>
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


	
