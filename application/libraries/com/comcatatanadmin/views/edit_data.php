<style>
.ui-datepicker{z-index:99999}
</style>

<div id="responceArea" />
<form method="post" action="" id="formcatatan" enctype="multipart/form-data">
<?=form_hidden('oper',@$oper);?>
<?=form_hidden('id_catatan_admin',@$id_catatan_admin);?>
	<table border=0 class="table-flat" width='100%'>
		<tr>
			<td>SKPD</td>
			<td>:</td>
			<td>
				<input type='radio' name='typepilih' id='typepilih1' value='personal' <? if(@$data_edit[0]->type == 'personal'){?> checked="checked" <? } ?>>Pilih Skpd
				<input type='radio' name='typepilih' id='typepilih2'  value='umum'  <? if(@$data_edit[0]->type == 'umum'){?> checked="checked" <? } ?>>Semua Skpd
		</tr>
		<tr id='tr_personal'  <? if(@$data_edit[0]->type == 'umum'){?> style='display:none;' <? } ?>>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
					<tr>	
						<td></td>
						<td></td>
						<td>Ditujukan</td><td>:</td><td>
							<input type='hidden' name='id_skpd' id='id_skpd' value='<?=@$data_edit[0]->id_penerima?>'>
							<input type='text' name='instansi' id='instansi' disabled value='<?=@$data_edit[0]->nama_lengkap?>'>
						</td>
						<td><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Judul</td><td>:</td><td><input type='text' name='judul' id='judul' value='<?=@$data_edit[0]->judul?>'></td>
					</tr>
						<td></td>
						<td></td>
						<td>Uraian</td><td>:</td><td>
							<textarea cols=60 rows=7 name='uraian' id='uraian'><?=@$data_edit[0]->uraian?></textarea>
						</td>			
					</tr>	
				</table>	
			</td>	
		</tr>

		<tr id='tr_umum' <? if(@$data_edit[0]->type == 'personal'){?> style='display:none;' <? } ?>>
			<td></td>
			<td></td>
			<td colspan='10'>
				<table>
					<tr>
						<td></td>
						<td></td>
						<td>Judul</td><td>:</td><td><input type='text' name='judul_umum' id='judul_umum' value='<?=@$data_edit[0]->judul?>'></td>
					</tr>
						<td></td>
						<td></td>
						<td>Uraian</td><td>:</td><td>
							<textarea cols=60 rows=7 name='uraian_umum' id='uraian_umum'><?=@$data_edit[0]->uraian?></textarea>
						</td>			
					</tr>	
					
				</table>	
			</td>	
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td colspan='10'>
				
		
				<table><tr>
						<td></td>
						<td></td>
						<td valign="top">File</td><td valign="top">:</td><td>
							<? if(!empty($data_edit[0]->filename)){?>
							<a target="_blank" href="assets/media/file/attachments/<?=$data_edit[0]->path?>"><?=$data_edit[0]->filename?></a>
							<br/>
							<br/>
							<? } ?>
							<input type="file" name="attachment"/>
						</td>			
					</tr>	
					
				</table>	
			</td>			
		</tr>	
		<td colspan='12'>
		<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
		<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>
	</table>
</form>
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