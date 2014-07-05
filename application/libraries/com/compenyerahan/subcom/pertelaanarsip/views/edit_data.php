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
$(function(){

	$('#judul').autocomplete('<?=site_url('admin/com/pengolahan');?>/autocomplete',
		{
			
			extraParams: {
				type_cari : function() { return 'judul'},					  
			 },
			parse: function(data){ 
				
			var parsed = [];
				for (var i=0; i < data.length; i++) {
					parsed[i] = {
						data: data[i],
						value: data[i].hasil 
					};
				}
				return parsed;				
			},
			formatItem: function(data,i,max){
				
				var str = '<div class="search_content">';
				
				str += '<u>'+data.hasil+'</u>';
				str += '</div>';
				return str;
			},
			width: 270, 
			dataType: 'json' 	
			
			
		}
	
	).result(
			function(event,data,formated){
			
				$('#judul').val(data.hasil); 
				
				
			}	
	);
	
});
</script>

<div id="responceArea" />
<form method="post" action="" id="formpenyerahan">
<input type='hidden' name='oper' id='oper' value='<?=$oper?>'>

<input type='hidden' name='id_ba' id='id_ba' value='<?=$id_ba?>'>
<input type='hidden' name='id_data' id='id_data' value='<?=$id_data?>'>
	<table border=0 class="table-flat">
		<tr>
			<td>Kode Klasifikasi</td>
			<td>:</td>
			<td>
			<input type='hidden' name='kode_kls' id='kode_kls' value='<?=@$data[0]->id_kode_masalah?>'>
			<input type='text' name='nama_kls' id='nama_kls' value='<?=@$data[0]->nama_masalah?>' disabled="disabled"></td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'></td>
			</td>
		</tr>
		
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><input type='text' name='judul' id='judul' value='<?=@$data[0]->judul?>'></td>
		</tr>

		
		
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td><input type='text' name='no_arsip' id='no_arsip' value='<?=@$data[0]->no_arsip?>'></td>
			<td>Agenda</td>
			<td>:</td>
			<td><input type='text' name='agenda' id='agenda' value='<?=@$data[0]->agenda?>'></td>
			<td>Kode Komponen</td>
			<td>:</td>
			<td><input type='text' name='kode_komponen' id='kode_komponen' size=10 value='<?=@$data[0]->kode_komponen?>'></td>
		
			<td>Tahun  </td><td>: </td><td><select name='tahun' id='tahun'>
				<option value=''>--pilih--</option>
				<? foreach($tahun as $th){ ?>
				<option value=<?=$th?> <? if(@$data[0]->tahun == $th){ ?> selected='selected' <? } ?>><?=$th?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			

			<td>Tanggal Berkas</td>
			<td>:</td>
			<td><input type='text' name='tanggal' id='tanggal' value='<?=date('d-m-Y',strtotime($data[0]->tanggal))?>'></td>
			

			<?php if($_SESSION['user_group'] == 3 ):?>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' value="<?php echo $_SESSION['id_skpd']?>">
			<!-- 	<input type='text' name='unit_pengolah' id='unit_pengolah' > -->
			</td>
			<td colspan="4">&nbsp;</td>
			<?php else: ?>
			<td>Instansi</td>
			<td>:</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' value='<?=@$data[0]->id_skpd?>'>
				<input type='text' name='unit_pengolah' id='unit_pengolah' value='<?=@$data[0]->unit_pengolah?>' readonly="readonly">
			</td>
			<td colspan="4"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
			<?php endif?>
		</tr>
		<tr>
			<td valign="top">Keterangan</td>
			<td valign="top">:</td>
			<td valign="top" colspan="1">
				<textarea style="width: 136px; height: 63px;" id="desc" name="desc" rows="7" cols="60"><?=@$data[0]->desc?></textarea>
			</td>
			<td valign="top">Box</td>
			<td valign="top">:</td>
			<td valign="top" colspan="1"><input type="text" id="box" name="box" size="10" value='<?=@$data[0]->box?>'></td>
			<td valign="top">Sampul</td>
			<td valign="top">:</td>
			<td valign="top" colspan="4"><input type="text" id="sampul" name="sampul" size="10" value='<?=@$data[0]->sampul?>'></td>
		</tr>		
	<tr>
		<td colspan=12>
			<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data_edit();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>		
	</table>
</form>


	
