<style type="text/css">
textarea[name=isi_ringkas],
textarea[name=catatan]  {
    height: 67px;
    width: 322px;
}
input[name=instansi]{
	width:350px;
}

input[name=kode]{
	width:40px;
}
input[name=kode_masalah]{
	width:250px;
}
</style>

<?php echo form_open($form_action, array('id'=>'frmLapSkpd'))?>
<div id="responceArea"></div>
<?php echo form_hidden('type_surat',$type_surat)?>
<?php echo form_hidden('oper',$oper)?>

<?php if($oper=='edit'):?>
<?php echo form_hidden('id_lap_skpd',$r->id_lap_skpd)?>
<?php endif?>	
<table border="0" colspacing="2" cellpadding="2">
	<tr>
		<td class="lbl">Indeks</td>
		<td colspan="2"><?php echo form_input('indeks',set_value('indeks',$r->indeks))?></td>
		<td class="lbl">Kode</td>
		<td><?php echo form_input('kode',set_value('kode',$r->kode))?>&nbsp;<?php echo form_input('nama_masalah',set_value('nama_masalah',$r->nama_masalah))?> &nbsp; <input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'>&nbsp;&nbsp;&nbsp;</td>
		<td class="lbl">No. Urut</td>
		<td><?php echo form_input('no_urut',set_value('no_urut',$r->no_urut))?></td>
	</tr>
	<tr>
		<td class="lbl">Perihal</td>
		<td colspan="4"><?php echo form_input('perihal',set_value('perihal',$r->perihal))?></td>
		<td class="lbl">Nomor Surat</td>
		<td><?php echo form_input('no_surat',set_value('no_surat',$r->no_surat))?></td>

	</tr>
	<tr>
		<td rowspan="3" class="lbl">Isi Ringkas</td>
		<td colspan="4" rowspan="3"><?php echo form_textarea('isi_ringkas',set_value('isi_ringkas',$r->isi_ringkas))?></td>

	</tr>
	<tr>	
		<td class="lbl">Tanggal Surat</td>
		<td><?php echo form_input('tanggal_surat',set_value('tanggal_surat',$r->tanggal_surat))?></td>
	</tr>
	<tr>	
		<td class="lbl">Lampiran</td>
		<td><?php echo form_input('lampiran2',set_value('lampiran2',$r->lampiran2))?></td>
	</tr>
	
	<!-- <tr>
		<td></td>
		<td>
			<input type="radio" name="jenis" value="skpd"/><label>SKPD</label>
			<input type="radio" name="jenis"/><label>Lembaga</label>
			<input type="radio" name="jenis"/><label>Perorangan</label>
		</td>
	</tr> -->
	<tr>
		<td class="lbl"><?php echo $type_surat=='masuk'?'Dari':'Kepada'?></td>
		<td colspan="4"><?php echo form_hidden('id_skpd',set_value('id_skpd',$r->id_skpd),' id="id_skpd"')?><?php echo form_input('instansi',set_value('instansi',$r->instansi),'readonly id="instansi"')?><input type="button" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value="Pilih"/></td>
		<td class="lbl">Sistem Penyimpanan</td>
		<td><?php echo form_dropdown('sistem_penyimpanan',array('Seri'=>'Seri','Rubrik'=>'Rubrik','Dosir'=>'Dosir'),set_value('sistem_penyimpanan',$r->sistem_penyimpanan))?>
		</td>
	</tr>
	<!-- <tr>
		<td>Lembaga/Perorangan</td>
		<td></td>
	</tr> -->
	<tr>
		<td class="lbl">Pengolah</td>
		<td colspan="4"><?php echo form_input('pengolah',set_value('pengolah',$r->pengolah))?></td>
		<td class="lbl">Lokasi Penyimpanan&nbsp;&nbsp;</td>
		<td><?php echo form_dropdown('lokasi_penyimpanan',array('Cabinet'=>'Kabinet','Rak'=>'Rak','Boks'=>'Boks'),set_value('lokasi_penyimpanan',$r->lokasi_penyimpanan))?>
		</td>
	</tr>
	<tr>
		<td class="lbl">Tanggal Diteruskan&nbsp;&nbsp;</td>
		<td colspan="6"><?php echo form_input('tanggal_diteruskan',set_value('tanggal_diteruskan',$r->tanggal_diteruskan))?></td>
	</tr>
	<tr>
		<td class="lbl">Lampiran</td>
		<td colspan="6"><?php echo form_input('lampiran',set_value('lampiran',$r->lampiran))?></td>
	</tr>
	<tr>
		<td class="lbl">Catatan</td>
		<td colspan="6"><?php echo form_textarea('catatan',set_value('catatan',$r->catatan))?></td>
	</tr>
	<tr>
		<td colspan=7>
		<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data('<?php echo $oper?>');" value='SIMPAN'>
		<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>
</table>
<?php echo form_close() ?>
<script>
jQuery(document).ready(function(){
	jQuery( "input[name=tanggal_surat],input[name=tanggal_diteruskan]" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#tanggal'
		,changeMonth:true
		,changeYear:true
		,index: 0
	});

	$('input[name=kode],input[name=nama_masalah]').attr('readonly','readonly');
});
</script>