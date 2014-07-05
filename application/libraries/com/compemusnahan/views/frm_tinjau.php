<style>
.ui-datepicker{z-index:99999}
textarea#keterangan{
	height: 29px !important;
	width: 726px !important;
}
.hide{
	display: none !important;
}
textarea[readonly],.grayed{
	background: #dedede;
	border: 1px solid #ABABAB;
}
div.overlay-depo {
    /*border: 1px solid #ABABAB;*/
    height: 155px;
    margin: 252px 0 0 161px;
    position: absolute;
    width: 191px;
}

div.overlay-bottom {
 /*   border: 1px solid #ABABAB;*/
    height: 67px;
    margin: 446px 0 0 166px;
    position: absolute;
    width: 191px;
}
label.lbl{
	display: block; float: left; line-height: 25px; width: 105px;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function(){

	$('table.frmTable textarea,table.frmTable select,table.frmTable input[type=text]').attr('readonly','readonly');
	$('#combobox_depo,#combobox_rak,#combobox_box,#combobox_folder,#jenis_arsip,#sifat_arsip').addClass('grayed');
});	
</script>

<div id="responceArea" />

<?=form_open('#',' id="form_nilai_kembali"');?>
<?=form_hidden('oper',@$oper);?>
<?=form_hidden('id_data',@$id_data);?>
<?=form_hidden('tgl_dinilai_kembali',date('d-m-Y'));?>
<?=form_hidden('jml_tinjauan',$data_edit[0]->jml_tinjauan?intval($data_edit[0]->jml_tinjauan) + 1:1);?>
<table border=0 class="table-flat frmTable">
	<tr>
		<td>Judul</td>
		<td>:</td>
		<td colspan="10"><input style="width:553px" type='text' name='judul' id='judul' value='<?=@$data_edit[0]->judul?>'></td>
	</tr>
	<tr>
		<td>Nomor Berkas</td>
		<td>:</td>
		<td colspan="10">
			<?php echo orminus( $data_edit[0]->no_arsip) .'/'.orminus($data_edit[0]->agenda).'.'.orminus($data_edit[0]->kode_komponen).'/'.orminus($data_edit[0]->tahun); ?>
		
		</td>
		
	</tr>
	<tr class="grayed">
			<td valign="top" width="80px">Retensi Arsip</td>
			<td valign="top">:</td>
			<td valign="top" align="left" colspan="10"> 
				<div style="padding:2px">
				<label class="lbl">Aktif</label>
				<select type='text' name='rt_aktif' id='rt_aktif'>
					<option value="">--Pilih--</option>
					<option value="1">1 Tahun</option>
					<option value="2">2 Tahun</option>
					<option value="3">3 Tahun</option>
					<option value="4">4 Tahun</option>
					<option value="5">5 Tahun</option>
				</select>
				<div class="aktif_sampai" style="display: block; margin: -21px 14px 6px 191px; position: absolute; font-style: italic;">
					<!-- <label>Aktif Sampai : </label> --><span></span>
				</div>
				</div>
				
				<div style="padding:2px">
					<label class="lbl">Inaktif</label>
					<select type='text' name='rt_inaktif' id='rt_inaktif'>
						<option value="">--Pilih--</option>
						<option value="1">1 Tahun</option>
						<option value="2">2 Tahun</option>
						<option value="3">3 Tahun</option>
						<option value="4">4 Tahun</option>
						<option value="5">5 Tahun</option>
					</select>
					<div class="inaktif_sampai" style="display: block; margin: -21px 14px 6px 191px; position: absolute; font-style: italic;">
						<!-- <label>Inaktif Sampai :</label> --><span></span>
					</div>
				</div>
				
			<div  style="padding:2px">
				<label class="lbl">Keterangan Retensi</label>
				<select type='text' name='rt_desc' id='rt_desc'>
					<option value="">--Pilih--</option>
					<option value="permanen">Permanen</option>
					<option value="dinilai_kembali">Dinilai Kembali</option>
					<option value="musnah">Musnah</option>
				</select>
			</div>	
			</td>
		</tr>
	<tr>
		<td colspan="12">
			<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>	
	</table>
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('select[name=rt_aktif],select[name=rt_inaktif]').change(function(){
		var target = $(this).attr('name').replace(/rt_/,'') + '_sampai'; 
		var tanggal= $('input[name=tgl_dinilai_kembali]').val();
		var max_th = $(this).val(); 
		// console.log(tanggal);
		// console.log($(this).attr('name'));

		if(!max_th.length || !tanggal.length)
			$('.'+target).hide();
		else
		{
			tanggal = tanggal.split('-');
			tanggal = tanggal[2]+'-'+tanggal[1]+'-'+tanggal[0];
			$.get('<?php echo site_url('calculate/retensi')?>/'+tanggal+'/'+ max_th + '/d-m-Y',function(r){
				$('.'+target + ' >  span').text(r);
				$('.'+target).show();
			});
		}
			
	}).trigger('change');

	//$('input#tanggal').change(function(){ $('select[name=rt_aktif],select[name=rt_inaktif]').trigger('change') })
});
</script>