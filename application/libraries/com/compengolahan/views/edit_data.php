<style>
.ui-datepicker{z-index:99999}
#tr_rool/*,#tr_loksim*/{
	display: none;
}
.grayed{
	background: #1559b2; /* Old browsers */
background: -moz-linear-gradient(top,  #1559b2 0%, #1559b2 100%) !important; /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#1559b2), color-stop(100%,#1559b2)) !important; /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #1559b2 0%,#1559b2 100%) !important; /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #1559b2 0%,#1559b2 100%) !important; /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #1559b2 0%,#1559b2 100%) !important; /* IE10+ */
background: linear-gradient(to bottom,  #1559b2 0%,#1559b2 100%) !important; /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1559b2', endColorstr='#1559b2',GradientType=0 ) !important; /* IE6-9 */

}
tr.grayed td{
	color: #ffffff;
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
<style type="text/css">
.table-flat th,.table-flat td{
/*	border:solid 1px #dedede !important;*/
}
</style>
<div id="responceArea" />
 <form action="" method="post" id="formpengolahan" class="AdvancedForm">
<?=form_hidden('oper',@$oper);?>
<?=form_hidden('id_data',@$id_data);?>
<pre>
<?php
	$is_rool = ($lokasi_simpan[1]->type == 'rool');
	// print_r($lokasi_simpan);
?>
</pre>
<input type='hidden' name='id_depo' id='id_depo' value='<?=@$lokasi_simpan[0]->id_lokasisimpan ?>'>
<input type='hidden' name='id_rak' id='id_rak' value='<?=@$lokasi_simpan[1]->id_lokasisimpan?>'>
<input type='hidden' name='id_box' id='id_box' value='<?=@$lokasi_simpan[2]->id_lokasisimpan?>'>
<input type='hidden' name='id_folder' id='id_folder' value='<?=@$lokasi_simpan[3]->id_lokasisimpan?>'>
<input type='hidden' name='id_rool' id='id_rool' value='<?= $is_rool ? @$lokasi_simpan[1]->id_lokasisimpan :""?>'>

	<table border="0" class="table-flat">

		
		<tr>
			<td>Kode Klasifikasi</td>
			<td>:</td>
			<td colspan="4">
			<input type='hidden' name='kode_kls' id='kode_kls' value='<?=@$data_edit[0]->id_kode_masalah?>'>
			<input type='text' name='nama_kls' id='nama_kls' value='<?=@$data_edit[0]->nama_masalah?>' readonly="readonly"  style="width: 397px;"></td>
			<td colspan="6"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'></td>
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
			<td>Agenda  </td><td>: </td><td><input type='text' name='agenda' id='agenda' size="10" value='<?=@$data_edit[0]->agenda?>'></td>
			<td width=100>Kode Komponen  </td><td>: </td><td><input type='text' name='kode_komp' id='kode_komp' size="11" value='<?=@$data_edit[0]->kode_komponen?>'></td>
			<td>Tahun  </td><td>: </td><td><select name='tahun' id='tahun'>
				<option value=''>--pilih--</option>
				<? foreach($tahun as $th){ ?>
				<option value=<?=$th?> <? if($th==@$data_edit[0]->tahun){?> selected='selected' <? } ?>><?=$th?></option>
				<? } ?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Tanggal Berkas</td>
			<td>:</td>
			<td><input type='text' name='tanggal' id='tanggal' value='<?=date('d-m-Y',strtotime(@$data_edit[0]->tanggal))?>'></td>
			<td>Lokasi</td>
			<td>:</td>
			<td><input type='text' name='lokasi' id='lokasi' value='<?=@$data_edit[0]->lokasi?>'></td>
			<td>Instansi</td>
			<td>:</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' value='<?=@$data_edit[0]->id_skpd?>'>
				<input type='text' name='unit_pengolah' id='unit_pengolah' value='<?=@$data_edit[0]->nama_lengkap?>' disabled="disabled">
			</td>
			<td colspan="3"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>	

		<tr>
			<td valign="top">Keterangan</td>
			<td valign="top">:</td>
			<td valign="top"><textarea cols="40" rows="4" name='keterangan' id='keterangan' style="width: 139px;"><?=@$data_edit[0]->desc?></textarea></td>
			<td valign="top" width="54px">Jenis Arsip</td>
			<td valign="top">:</td>
			<td  valign="top">
				<select name='jenis_arsip' id='jenis_arsip'>
					<option>--pilih--</option>
					<? foreach($jenis_arsip as $jenis) { ?>
						<option value='<?=$jenis->id_jenis?>' <? if(@$jenis->id_jenis==@$data_edit[0]->id_jenis){?> selected='selected' <? } ?> ><?=$jenis->name?></option>
					<? } ?>	
				</select>
			</td>
			<td valign="top">Sifat Arsip</td>
			<td valign="top">:</td>
			<td colspan="4"  valign="top">
				<select name='sifat_arsip' id='sifat_arsip'>
					<option>--pilih--</option>
					<? foreach($sifat_arsip as $sifat) { ?>
						<option value='<?=$sifat->id_sifat?>'  <? if(@$sifat->id_sifat==@$data_edit[0]->id_sifat){?> selected='selected' <? } ?>><?=$sifat->name?></option>
					<? } ?>	
				</select>
			</td>
		</tr>	
		<tr>
			<td>Type Penyimpanan</td>
			<td>:</td>
			<td colspan="10">
				<?php if($lokasi_simpan[1]->type == 'rool'):?>
				<input type='radio' name='rdpilih' id='rdpilih1' value='rak'/>Rak&nbsp;&nbsp;<input  type='radio' name='rdpilih' id='rdpilih2'  value='rool' checked="checked"/>Rool Opack
				<?php elseif($lokasi_simpan[1]->type == 'rak'):?>
				<input type='radio' name='rdpilih' id='rdpilih1' value='rak' checked="checked"/>Rak&nbsp;&nbsp;<input type='radio' name='rdpilih' id='rdpilih2'  value='rool'/>Rool Opack
				<?php else:?>
				<input type='radio' name='rdpilih' id='rdpilih1' value='rak'/>Rak&nbsp;&nbsp;<input type='radio' name='rdpilih' id='rdpilih2'  value='rool'/>Rool Opack
				<?php endif?>
				
			</td>
		</tr>
		
		<tr id="tr_loksim" class="grayed">
			<td width="150">Lokasi Penyimpanan</td>
			<td>:</td>
			<td>
				<select name='lokasi_penyimpanan_depo' id='combobox_depo'></select>
			</td>
			<td colspan="9">
			<div id="tr_rak">	
				<i>Rak</i> &nbsp;:&nbsp;<select name='rak' id='combobox_rak'>
					<option>&nbsp;</option>
				</select>
			&nbsp;<i>Box</i> &nbsp;:&nbsp; 
				<select name='box' id='combobox_box'>
					<option>&nbsp;</option>
				</select>
			&nbsp;<i>Sampul</i>&nbsp;:&nbsp;
				<select name='folder' id='combobox_folder'>
					<option>&nbsp;</option>
				</select>
			</div>
			<div id="tr_rool" style="background:none">
				<i>Rak</i> &nbsp;:&nbsp;<select name='rool' id='combobox_rool'>
					<option>&nbsp;</option>
				</select>
			&nbsp;<i>Box</i> &nbsp;:&nbsp; 
				<select name='box_rool' id='combobox_box_rool'>
					<option>&nbsp;</option>
				</select>
			&nbsp;<i>Sampul</i>&nbsp;:&nbsp;
				<select name='folder_rool' id='combobox_folder_rool'>
					<option>&nbsp;</option>
				</select>
			</div>	
			</td>
		</tr>
		<tr>
			<td>Sistem Penyimpanan</td>
			<td>:</td>
			<td colspan="10">
				<?php echo form_dropdown('sistem_penyimpanan',array(''=>'--Pilih--','seri'=>'Seri','rubrik'=>'Rubrik','dosir'=>'Dosir'),$data_edit[0]->sistem_penyimpanan)?>
				<!-- <select name='sistem_penyimpanan' id='sistem_penyimpanan'>
					<option value="">--Pilih--</option>
					<option value="seri">Seri</option>
					<option value="rubrik">Rubrik</option>
					<option value="dosir">Dosir</option>
				</select> -->
			</td>
		</tr>
		<?php if($data_edit[0]->status == 'tinjau'):?>
		<tr>
			<td>Tanggal Dinilai Kembali</td>
			<td>:</td>
			<td colspan="10"><?
				$stamp = strtotime(@$data_edit[0]->tgl_dinilai_kembali);
				$tanggal_pinjam = date("d-m-Y", $stamp);
				echo @$tanggal_pinjam ?> <?php echo form_hidden('tgl_dinilai_kembali', $data_edit[0]->tgl_dinilai_kembali);?></td>
		</tr>
		<tr>
			<td>Dinilai Kembali Sebanyak</td>
			<td>:</td>
			<td>
			<?=@$data_edit[0]->jml_tinjauan ?> kali.
			<?php echo form_hidden('status', 'tinjau');?>
			</td>
			<td colspan=9></td>
		</tr>
		<?php endif?>
		<tr class="grayed">
			<td>Retensi Arsip</td>
			<td>:</td>
			<td align="right" colspan="2"> Aktif&nbsp;&nbsp;
				<?php echo form_dropdown('rt_aktif',array( ''=>'--Pilih--','1'=>'1 Tahun',
															 '2'=>'2 Tahun',
															 '3'=>'3 Tahun',
															 '4'=>'4 Tahun',
															 '5'=>'5 Tahun'),$data_edit[0]->rt_aktif)?>
				<!-- <select type='text' name='rt_aktif' id='rt_aktif'>
					<option value="">--Pilih--</option>
					<option value="1">1 Tahun</option>
					<option value="2">2 Tahun</option>
					<option value="3">3 Tahun</option>
					<option value="4">4 Tahun</option>
					<option value="5">5 Tahun</option>
				</select> -->
				<div class="aktif_sampai" style="display: block; padding: 6px 14px 6px 6px">
					<!-- <label>Aktif Sampai : </label> --><span></span>
				</div>
			</td>
			<td colspan="3" align="left">
				Inaktif&nbsp;&nbsp;
				<!-- <select type='text' name='rt_inaktif' id='rt_inaktif'>
					<option value="">--Pilih--</option>
					<option value="1">1 Tahun</option>
					<option value="2">2 Tahun</option>
					<option value="3">3 Tahun</option>
					<option value="4">4 Tahun</option>
					<option value="5">5 Tahun</option>
				</select> -->
				<?php echo form_dropdown('rt_inaktif',array( ''=>'--Pilih--', '1'=>'1 Tahun',
															 '2'=>'2 Tahun',
															 '3'=>'3 Tahun',
															 '4'=>'4 Tahun',
															 '5'=>'5 Tahun'),$data_edit[0]->rt_inaktif)?>
				<div class="inaktif_sampai" style="display: block; padding: 6px 6px 6px 47px;">
					<!-- <label>Inaktif Sampai :</label> --><span></span>
				</div>
			</td>
			<td colspan="5" align="left">
				Keterangan Retensi&nbsp;&nbsp;
				<?php echo form_dropdown('rt_desc',array(''=>'--Pilih--','permanen'=>'Permanen','dinilai_kembali'=>'Dinilai Kembali','musnah'=>'Musnah'),$data_edit[0]->rt_desc)?>
			</td>
		</tr>	
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="12">
			<input type='button' class="bt-blue-common" id="aaa" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>
	</table>
</form>


	
<script type="text/javascript">
$(document).ready(function(){
	$('select[name=rt_aktif],select[name=rt_inaktif]').change(function(){
		var target = $(this).attr('name').replace(/rt_/,'') + '_sampai'; 
		<?php if($data_edit[0]->status == 'tinjau'):?>
		var tanggal = '<?php echo date('d-m-Y',strtotime($data_edit[0]->tgl_dinilai_kembali))?>';
		<?php else:?>
		var tanggal= $('input[name=tanggal]').val();

		<?php endif;?>
		var max_th = $(this).val(); 
		//console.log(tanggal);
		//console.log($(this).attr('name'));

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

	$('input#tanggal').change(function(){ $('select[name=rt_aktif],select[name=rt_inaktif]').trigger('change') })

	var loksim_type = '<?php echo $lokasi_simpan[1]->type?>';

	if(loksim_type.length)
	{
		//var id_radio = 
		if(loksim_type=='rool'){
			$('#rdpilih2').attr('checked',true).trigger('click');
		}else if(loksim_type=='rak'){
			//$('#rdpilih1').attr('checked',true).trigger('click');
		}
	}
});
</script>