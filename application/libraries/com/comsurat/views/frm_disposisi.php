<style type="text/css">
textarea[name=instruksi],
textarea[name=diteruskan_kepada]  {
    height: 68px;
    width: 209px;
}
input[name=tanggal_no]{
	width: 208px;
}
input[name=asal],input[name=perihal]{
	width: 208px;
}
input[name=tanggal_penyelesaian],input[name=tanggal_kembali]{
	width: 73px;
	text-align: center;
}
b{
	font-weight: bold;
}
</style>

<?php echo form_open($form_action, array('id'=>'frmLapSkpd'))?>
<?php echo form_hidden('id_disposisi',$d->id_disposisi)?>
<table border="0" colspacing="2" cellpadding="2">
	<tr>
		<td class="lbl">Indeks&nbsp;</td>
		<td colspan="2"><?php echo form_input('indeks',$r->indeks,'readonly')?></td>
		<td class="sep" >&nbsp;</td>
		<td class="lbl">Perihal&nbsp;</td>
		<td colspan="2"><?php echo form_input('perihal',$r->perihal,'readonly')?></td>
	</tr>
	<tr>
		<td class="lbl">Tanggal/No&nbsp;</td>
		<td colspan="2"><?php echo form_input('tanggal_no',$r->tanggal_surat . '/' . $r->no_surat,'readonly')?></td>
		<td class="sep">&nbsp;</td>
		<td class="lbl">Asal&nbsp;</td>
		<td colspan="2"><?php echo form_input('asal',$r->instansi,'readonly')?></td>

	</tr>
	<tr>
		<td class="lbl">Tanggal Penyelesaian&nbsp;</td>
		<td colspan="2"><?php echo form_input('tanggal_penyelesaian',set_value('tanggal_penyelesaian',$d->tanggal_penyelesaian))?></td>
		<td class="lbl" colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td rowspan="4" class="lbl">Instruksi&nbsp;</td>
		<td colspan="2" rowspan="4"><?php echo form_textarea('instruksi',set_value('instruksi',$d->instruksi))?></td>


	</tr>
	<tr>	
		<td class="sep"></td><td class="lbl" colspan="7"><b>Sesudah digunakan harap segera dikembalikan</b></td>
	</tr>
	<tr>	
		<td class="sep"></td><td class="lbl">Kepada&nbsp;</td>
		<td colspan="7"><?php echo form_input('kepada',set_value('kepada',$d->kepada))?></td>
	</tr>
	<tr>	
		<td class="sep"></td><td class="lbl">Tanggal Dikembaikan&nbsp;</td>
		<td colspan="7"><?php echo form_input('tanggal_kembali',set_value('tanggal_kembali',$d->tanggal_kembali))?></td>
	</tr>
	<tr>
		<td  class="lbl">Diteruskan Kepada&nbsp;</td>
		<td colspan="2" ><?php echo form_textarea('diteruskan_kepada',set_value('diteruskan_kepada',$d->diteruskan_kepada))?></td>
	</tr>
	
	<tr>
		<td colspan=7>
		<input type='button' class="bt-blue-common" onclick="save_disposisi();" value='SIMPAN'>
		<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>
</table>
<?php echo form_close() ?>
<script>
jQuery(document).ready(function(){
	jQuery( "input[name=tanggal_penyelesaian],input[name=tanggal_kembali]" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#tanggal'
		,changeMonth:true
		,changeYear:true
		,index: 0
	});
	window.save_disposisi = function(data,settings){

	var str = $("form").serialize();	
	$.ajax({
		url : '<?=site_url('admin/com/surat')?>/update_disposisi',
		data : str,
		type : 'POST',
		dataType : 'json',
		success : function(msg){
			if(msg.result=='failed'){
				$('#responceArea').html(msg.message).css("color","red");
;	
			}else{
				jQuery('#dialogArea1').dialog('close');
				jQuery("#gridcomsurat").trigger('reloadGrid');	
			}
			
		}
	});

}	
});
</script>