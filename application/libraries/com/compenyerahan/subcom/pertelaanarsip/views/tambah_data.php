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
<style type="text/css">
.table-flat td, .table-flat th{
	/*border:solid 1px #dedede !important;*/
}
</style>
<div id="responceArea" />
<form method="post" action="" id="formpenyerahan">

<input type='hidden' name='oper' id='oper' value='<?=$oper?>'>
<input type='hidden' name='id_ba' id='id_ba' value='<?=$id_ba?>'>
	<table border="0" class="table-flat">
		<tr>
			<td>Kode Klasifikasi</td>
			<td>:</td>
			<td>
			<input type='hidden' name='kode_kls' id='kode_kls'>
			<input type='text' name='nama_kls' id='nama_kls' ></td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.btn_cari();" value='Pilih'></td>
			</td>
		</tr>
		
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><input type='text' name='judul' id='judul'></td>
		</tr>
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td><input type='text' name='no_arsip' id='no_arsip'></td>
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
			<td>Tanggal Berkas </td>
			<td>:</td>
			<td><input type='text' name='tanggal' id='tanggal' ></td>
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
				<input type='hidden' name='id_skpd' id='id_skpd' >
				<input type='text' name='unit_pengolah' id='unit_pengolah' readonly="readonly">
			</td>
			<td colspan="4"><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
			
			<?php endif?>
		</tr>

		<!-- <tr>
			<td>Unit Pengolah</td>
			<td>:</td>
			<td>
				<input type='hidden' name='id_skpd' id='id_skpd' >
				<input type='text' name='unit_pengolah' id='unit_pengolah' >
			</td>
			<td colspan=9><input type='button' class="bt-form-flat-reset" onclick="<?=@$class_name;?>grid.extra.pilih_skpd();" value='Pilih'></td>
		</tr> -->
		<!-- <tr>
			<td>Box</td>
			<td>:</td>
			<td colspan=10><input type='text' name='box' id='box' ></td>
		</tr>
		<tr>
			<td>Sampul</td>
			<td>:</td>
			<td colspan=10><input type='text' name='sampul' id='sampul'></td>
		</tr> -->	
		<tr>
			<td valign="top">Keterangan</td>
			<td valign="top">:</td>
			<td valign="top" colspan="1">
				<textarea style="width: 136px; height: 63px;" id="desc" name="desc" rows="7" cols="60"></textarea>
			</td>
			<td valign="top">Box</td>
			<td valign="top">:</td>
			<td valign="top" colspan="1"><input type="text" id="box" name="box" size="10"></td>
			<td valign="top">Sampul</td>
			<td valign="top">:</td>
			<td valign="top" colspan="4"><input type="text" id="sampul" name="sampul" size="10"></td>
		</tr>	
	<tr>
		<td colspan=12>
			<input type='button' class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.simpan_data();" value='SIMPAN'>
			<input type='button' class="bt-blue-common" onclick="jQuery('#dialogArea1').dialog('close');" value='KEMBALI'>
		</td>
	</tr>		
	</table>
</form>


	
