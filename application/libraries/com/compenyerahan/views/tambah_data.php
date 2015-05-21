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
	<table border=0 class="table-flat">

		
		<!-- <tr>
			<td>Berita Acara</td>
			<td>:</td>
			<td colspan=10><input type='file' name='berita_acr' id='berita_acr'>
			</td>
		</tr> -->

		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td colspan=10><input type='text' name='tanggal' id='tanggal' ></td>
		</tr>
		
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td><input type='text' name='no' id='no'></td>
			<td>Agenda</td>
			<td>:</td>
			<td><input type='text' name='agenda' id='agenda'></td>
			<td>Kode Komponen</td>
			<td>:</td>
			<td><input type='text' name='kode_komponen' id='kode_komponen' size=10></td>
		
			<td>Tahun  </td><td>: </td><td><select name='tahun' id='tahun'>
				<option value=''>--pilih--</option>
				<? foreach($tahun as $th){ ?>
				<option value=<?=$th?>><?=$th?></option>
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
						<option value='ada'>Ada</option>
						<option value='tidakada'>Tidak Ada</option>
				</select>
			</td>
		</tr>	
	
		<tr <? if($group==6){?> style="display:none" <? } ?> >
			<td>Dari</td>
			<td>:</td>
			<td colspan="4">
				<input type='hidden' name='id_skpd' id='id_skpd' >
				<input type='text' name='instansi' id='instansi' style="width:450px">
			</td>
			<td colspan="6"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>		
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td  colspan=10>
				<input type='text' name='kepada' id='kepada' style="width:350px" <? if($group==6){?> readonly value="Kantor Arsip Daerah" <? } ?>>
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


	
