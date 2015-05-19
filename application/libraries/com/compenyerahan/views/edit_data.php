<style>
.ui-datepicker{z-index:99999}
</style>
<script>
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
</script>
<div id="responceArea" />
<form method="post" action="" id="formpenyerahan">
<input type='hidden' name='oper' id='oper' value='<?=$oper?>'>
<input type='hidden' name='file1' id='file1' value='<?=@$data[0]->file?>'>
<input type='hidden' name='id_ba' id='id_ba' value='<?=$id_ba?>'>
	<table border=0 class="table-flat">

		
		<!-- <tr>
			<td>Berita Acara</td>
			<td>:</td>
			<td colspan=10><input type='file' name='berita_acr' id='berita_acr' value='<?=@$data[0]->file?>'>
			<?=@$data[0]->file?>
			</td>
		</tr> -->

		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td colspan=10><input type='text' name='tanggal' id='tanggal' value='<?=date('d-m-Y',strtotime($data[0]->tanggal_ba))?>'></td>
		</tr>
		
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td><input type='text' name='no' id='no' value='<?=@$data[0]->nomor_ba?>'></td>
			<td>Agenda</td>
			<td>:</td>
			<td><input type='text' name='agenda' id='agenda' value='<?=@$data[0]->agenda?>'></td>
			<td>Kode Komponen</td>
			<td>:</td>
			<td><input type='text' name='kode_komponen' id='kode_komponen' size=10 value='<?=@$data[0]->komponen?>'></td>
		
			<td>Tahun  </td><td>: </td><td><select name='tahun' id='tahun'>
				<option value=''>--pilih--</option>
				<? foreach($tahun as $th){ ?>
				<option value=<?=$th?> <? if(@$data[0]->tahun == $th){ ?> selected='selected' <? } ?>><?=$th?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		

		
		<tr>
			<td>Disertai Pertelaan</td>
			<td>:</td>
			<td  colspan=10>
				<select name='pertelaan' id='pertelaan'>
						<option value=''>--pilih--</option>
						<option value='ada' <? if(@$data[0]->disertai_pertelaan == 'ada'){ ?> selected='selected' <? } ?>>Ada</option>
						<option value='tidakada' <? if(@$data[0]->disertai_pertelaan == 'tidakada'){ ?> selected='selected' <? } ?>>Tidak Ada</option>
				</select>
			</td>
		</tr>	

		<!-- <tr>
			<td>Instansi</td>
			<td>:</td>
			<td><input type='hidden' name='id_skpd' id='id_skpd' value='<?=@$data[0]->id_skpd?>'><input type='text' name='instansi' id='instansi' disabled='disabled' value='<?=@$data[0]->nama_lengkap?>'></td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>		
		<tr>
			<td>Uraian</td>
			<td>:</td>
			<td  colspan=10>
				<textarea cols=60 rows=7 name='uraian' id='uraian'><?=@$data[0]->uraian?></textarea>
			</td>
		</tr> -->
		<tr <? if($group==6){?> style="display:none" <? } ?> >
			<td>Dari</td>
			<td>:</td>
			<td colspan="4">
				<input type='hidden' name='id_skpd' id='id_skpd' value="<?=@$data[0]->id_skpd?>">
				<input type='text' name='instansi' id='instansi' style="width:450px" value="<?=@$data[0]->instansi?>">
			</td>
			<td colspan="6"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>		
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td  colspan="10">
				<input type='text' name='kepada' id='kepada' style="width:350px" value="<?=@$data[0]->kepada?>">
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


	
