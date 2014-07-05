<style>
.ui-datepicker{z-index:99999}
</style>
<script>
$('#typepilih1').click(function () {
	var cek = $('#typepilih1').val();
      if ($("#tr_personal").is(":hidden")) {
	  
		$("#tr_umum").hide();
        $("#tr_personal").slideDown("slow");
      }
    });

$('#typepilih2').click(function () {
	var cek = $('#typepilih2').val();
      if ($("#tr_umum").is(":hidden")) {
		
		
		$("#tr_personal").hide();
        $("#tr_umum").slideDown("slow");
      }
    });


</script>
<div id="responceArea" />
<form method="post" action="" id="formpeminjaman">
<?=form_hidden('oper',@$oper);?>
	<table border=0 class="table-flat" width='100%' height='100%'>
		<tr>
			<td>SKPD</td>
			<td>:</td>
			<td>
				<input type='radio' name='typepilih' id='typepilih1' value='personal' checked="checked">Pilih Skpd
				<input type='radio' name='typepilih' id='typepilih2'  value='umum'>Semua Skpd
		</tr>
		<tr id='tr_personal'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>	
						<td></td>
						<td></td>
						<td>Ditujukan</td><td>:</td>
						<td colspan=10>
							<input type='hidden' name='id_skpd' id='id_skpd'>
							<input type='text' name='instansi' id='instansi' disabled>
							<input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Judul</td><td>:</td><td><input type='text' name='judul' id='judul'></td>
					</tr>
						<td></td>
						<td></td>
						<td>Uraian</td><td>:</td><td>
							<textarea cols=60 rows=7 name='uraian' id='uraian'></textarea>
						</td>			
					</tr>	
				</table>	
			</td>	
		</tr>

		<tr id='tr_umum' style='display:none;'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>
						<td></td>
						<td></td>
						<td>Judul</td><td>:</td><td><input type='text' name='judul_umum' id='judul_umum'></td>
					</tr>
						<td></td>
						<td></td>
						<td>Uraian</td><td>:</td><td>
							<textarea cols=60 rows=7 name='uraian' id='uraian'></textarea>
						</td>			
					</tr>	
					
				</table>	
			</td>	
		</tr>
		<tr>
		<td colspan=3>
		<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data();" value='SIMPAN'>
		<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>
	</table>
</form>



	

