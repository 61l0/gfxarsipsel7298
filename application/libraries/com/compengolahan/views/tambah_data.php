<style>
.ui-datepicker{z-index:99999}
#tr_rool,#tr_loksim{
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
	$.post('<?=site_url('admin/com/pengolahan');?>/combobox',{data_type:type, parent_id:parent_id},	function(data){
			$('#combobox_'+type).empty();
			$('#combobox_'+type).append('<option>--pilih--</option>');
			for( var x=0; x<data.length; x++){
				$('#combobox_'+type).append($('<option></option>').val(data[x].id_lokasi_simpan).text(data[x].name));
			}
	},'json');
}

$(function(){

	$('input[name=rdpilih]').change(function(){
		var tipe = $(this).val();
		if(tipe=='rak')
		{
			$('#tr_rool').hide();
			$('#tr_rak').show();

			$('#combobox_depo').unbind('change').change(
				function(){
					if($('#combobox_depo option:selected').val() != ''){
						loadData('rak',$('#combobox_depo option:selected').val());
					}
				}
			);
			$('#combobox_rak').unbind('change').change(
				function(){
					if($('#combobox_rak option:selected').val() != ''){
						loadData('box',$('#combobox_rak option:selected').val());
					}
				}
			);	

			$('#combobox_box').unbind('change').change(
				function(){
					if($('#combobox_box option:selected').val() != ''){
						loadData('folder',$('#combobox_box option:selected').val());
					}
				}
			);		
		}
		else
		{
			$('#tr_rool').show();
			$('#tr_rak').hide();
			$('#combobox_depo').unbind('change').change(
				function(){
					if($('#combobox_depo option:selected').val() != ''){
						loadData('rool',$('#combobox_depo option:selected').val());
					}
				}
			);

			$('#combobox_rool').unbind('change').change(
				function(){
					if($('#combobox_rool option:selected').val() != ''){
						loadData('box_rool',$('#combobox_rool option:selected').val());
					}
				}
			);	

			$('#combobox_box_rool').unbind('change').change(
				function(){
					if($('#combobox_box_rool option:selected').val() != ''){
						loadData('folder_rool',$('#combobox_box_rool option:selected').val());
					}
				}
			);
		}
		if($('#tr_loksim').is(':hidden'))
		{
			loadData('depo',0);
			$('#tr_loksim').show();
		}
		$('select#combobox_depo').trigger('change');
		console.log($(this).val())
	})

	jQuery( "#tanggal" ).datepicker({ 
		altFormat: 'dd-mm-yy'
		, dateFormat: 'dd-mm-yy'
		, altField:'#tanggal'
		, minDate : new Date('1980-01-01')
		,changeMonth:true
		,changeYear:true
		,index: 0
	});

	jQuery("#judul").validate({
		expression: "if (VAL) return true; else return false;",
		message: "Judul Tidak Boleh Kosong"
	});	
	

	$('#judul').autocomplete('<?=site_url('admin/com/pengolahan');?>/autocomplete_judularsip',{
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
		}).result(
			function(event,data,formated){
			
				$('#judul').val(data.judul); 
				
				
			}	
	);
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

<?php
	$is_rool = ($lokasi_simpan[0]->type == 'rool');
?>

<input type='hidden' name='tgl_input' id='tgl_input' value="<?=date('Y-m-d')?>">
	<table border="0" class="table-flat">

		
		<tr>
			<td>Kode Klasifikasi</td>
			<td>:</td>
			<td colspan="4">
			<input type='hidden' name='kode_kls' id='kode_kls'>
			<input type='text' name='nama_kls' id='nama_kls'  style="width: 397px;" readonly></td>
			<td colspan="6"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'></td>
			</td>
		</tr>
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><input type='text' name='judul' id='judul' ></td>
		</tr>
		
		<tr>
			<td>Nomor Berkas</td>
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
			<td>Tanggal Berkas</td>
			<td>:</td>
			<td><input type='text' name='tanggal' id='tanggal'></td>
			<td>Lokasi</td>
			<td>:</td>
			<td><input type='text' name='lokasi' id='lokasi' ></td>
			<td>Instansi</td>
			<td>:</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' >
				<input type='text' name='unit_pengolah' id='unit_pengolah' >
			</td>
			<td colspan="3"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr>	

		<tr>
			<td valign="top">Keterangan</td>
			<td valign="top">:</td>
			<td valign="top"><textarea cols="40" rows="4" name='keterangan' id='keterangan' style="width: 139px;"></textarea></td>
			<td valign="top" width="54px">Jenis Arsip</td>
			<td valign="top">:</td>
			<td  valign="top">
				<select name='jenis_arsip' id='jenis_arsip'>
					<option>--pilih--</option>
					<? foreach($jenis_arsip as $jenis) { ?>
						<option value='<?=$jenis->id_jenis?>'><?=$jenis->name?></option>
					<? } ?>	
				</select>
			</td>
			<td valign="top">Sifat Arsip</td>
			<td valign="top">:</td>
			<td colspan="4"  valign="top">
				<select name='sifat_arsip' id='sifat_arsip'>
					<option>--pilih--</option>
					<? foreach($sifat_arsip as $sifat) { ?>
						<option value='<?=$sifat->id_sifat?>'><?=$sifat->name?></option>
					<? } ?>	
				</select>
			</td>
		</tr>	
		<tr>
			<td>Type Penyimpanan</td>
			<td>:</td>
			<td colspan=10><input type='radio' name='rdpilih' id='rdpilih1' value='rak'>Rak&nbsp;&nbsp;<input type='radio' name='rdpilih' id='rdpilih2'  value='rool'>Rool Opack</td>
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
				<select name='sistem_penyimpanan' id='sistem_penyimpanan'>
					<option value="">--Pilih--</option>
					<option value="seri">Seri</option>
					<option value="rubrik">Rubrik</option>
					<option value="dosir">Dosir</option>
				</select>
			</td>
		</tr>
		<tr class="grayed">
			<td valign="top">Retensi Arsip</td>
			<td valign="top">:</td>
			<td valign="top" align="right" colspan="2"> Aktif&nbsp;&nbsp;
				<select type='text' name='rt_aktif' id='rt_aktif'>
					<option value="">--Pilih--</option>
					<option value="1">1 Tahun</option>
					<option value="2">2 Tahun</option>
					<option value="3">3 Tahun</option>
					<option value="4">4 Tahun</option>
					<option value="5">5 Tahun</option>
				</select>
				<div class="aktif_sampai" style="display: block; padding: 6px 14px 6px 6px">
					<!-- <label>Aktif Sampai : </label> --><span></span>
				</div>
			</td>
			<td colspan="3" align="left"  valign="top">
				Inaktif&nbsp;&nbsp;
				<select type='text' name='rt_inaktif' id='rt_inaktif'>
					<option value="">--Pilih--</option>
					<option value="1">1 Tahun</option>
					<option value="2">2 Tahun</option>
					<option value="3">3 Tahun</option>
					<option value="4">4 Tahun</option>
					<option value="5">5 Tahun</option>
				</select>
				<div class="inaktif_sampai" style="display: block; padding: 6px 6px 6px 47px;">
					<!-- <label>Inaktif Sampai :</label> --><span></span>
				</div>
			</td>
			<td colspan="5" align="left"  valign="top">
				Keterangan Retensi&nbsp;&nbsp;
				<select type='text' name='rt_desc' id='rt_desc'>
					<option value="">--Pilih--</option>
					<option value="permanen">Permanen</option>
					<option value="dinilai_kembali">Dinilai Kembali</option>
					<option value="musnah">Musnah</option>
				</select>
			</td>
		</tr>	
	<tr>
		<td colspan="12">&nbsp;</td>
	</tr>	
	<tr>
		<td colspan="4">
			
		</td>
		<td colspan="8">
			<input type='button' class="bt-blue-common" id="aaa" onclick="<?=$class_name;?>grid.extra.simpan_data({id:'1'});" value='SIMPAN'>
		
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>	
		</td>
	</tr>
	</table>
</form>


	
<script type="text/javascript">
$(document).ready(function(){
	$('select[name=rt_aktif],select[name=rt_inaktif]').change(function(){
		var target = $(this).attr('name').replace(/rt_/,'') + '_sampai'; 
		var tanggal= $('input[name=tanggal]').val();
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
});
</script>