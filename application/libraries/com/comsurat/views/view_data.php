<style type="text/css">
	.tbl-view > tbody > tr > td {
		padding: 4px;
	}
	.tbl-view > tbody > tr > td > span{
		font-weight: bold;
		padding: 4px 2px;
	}
	.tbl-print{
		/*display: none;*/
	}
	label{
		font-size: 12px;
	}
	b{
		font-weight: bold;
	}
</style>
<?php if($lap->type_surat=='masuk'):?>
<input type="radio" value="surat" name="switch" checked/><label> KARTU KENDALI SURAT <?php echo strtoupper($lap->type_surat)?></label>&nbsp;&nbsp;
<input type="radio" value="disposisi" name="switch"/><label>KARTU PENERUS DISPOSISI</label>
<h4 class="switch" style="text-align:center;display:none;text-decoration:underline">KARTU PENERUS DISPOSISI</h4>
<table border="0" width="100%" cellpadding="4" colspacing="4" class="tbl-view tbl-print switch" style="display:none">

	<tr style="border-top:solid 1px #000;border-bottom:solid 1px #000">
		<td width="10%" valign="top"><b>INDEKS&nbsp;&nbsp;&nbsp;:</b></td>
		<td valign="top" width="30%"><?php echo $lap->indeks?></td>
		<td width="20%" valign="top">&nbsp;</td>
		<td width="30%"  valign="top"><div  align="right"><b>TANGGAL PENYELESAIAN</b></div><div align="right"><?php echo tgl_indo($d->tanggal_penyelesaian)?></div></td>
	</tr>
	<tr>
		<td valign="top"><b>PERIHAL&nbsp;:</b></td>
		<td valign="top" colspan="3"><?php echo $lap->perihal?></td>
	</tr>
	<tr>
		<td valign="top"><b>Tgl./No.&nbsp;&nbsp;:</b></td>
		<td valign="top" colspan="3"><?php echo date('d-m-Y',strtotime($lap->tanggal_surat))  . '/' . $lap->no_surat?></td>
	</tr>
	<tr style="border-bottom:solid 1px #000">
		<td valign="top"><b>Asal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
		<td valign="top" colspan="3"><?php echo $lap->skpd?></td>
	</tr>
	<tr>
		<td valign="top" colspan="2" width="50%" style="border-right:solid 1px #000"><div align="center"><b>INSTRUKSI / INFORMASI</b></div></td>
		<td valign="top" colspan="2" width="50%"><div align="center"><b>DITERUSKAN KEPADA</b></div></td>
	</tr>
	<tr style="border-bottom:solid 1px #000">
		<td valign="top" colspan="2" width="50%"  style="border-right:solid 1px #000"><?php echo $d->instruksi?></td>
		<td valign="top" colspan="2" width="50%"><?php echo $d->diteruskan_kepada?></td>
	</tr>

	<tr>
		<td colspan="2" valign="top">
			<div style="margin:10px 0;"><b>Sesudah digunakan harap segera dikembalikan</b></div>
			<div>Kepada&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $d->kepada?></div>
			<div>Tanggal&nbsp;&nbsp;:&nbsp;<?php echo tgl_indo($d->tanggal_kembali)?></div>
		</td>
		<td colspan="2" valign="top">
			<ol>
				<li>Kepada Bawahan "Instruksi" dan atau "Informasi"</li>
				<li>Kepada Atasan "Informasi" coret "Instruksi"</li>
			</ol>
		</td>
	</tr>
	<tr>
			<td colspan="4" align="center"><input type="button" value="cetak" onclick="disposisi_pdf(<?php echo $d->id_disposisi?>)"/></td>
		</tr>	
</table>

<?php endif;?>


<h4 class="switch" style="text-align:center">KARTU KENDALI SURAT <?php echo strtoupper($lap->type_surat)?></h4>	
<table border="1" width="100%" cellpadding="2" colspacing="2" class="tbl-view tbl-print switch">
	<tbody>
		<tr>
			<td colspan="2">Indeks :&nbsp; <br/><span class="indeks"><?php echo $lap->indeks?></span></td>
			<td>Kode : &nbsp; <br/><span class="kode"><?php echo $lap->kode?></span></td>
			<td>No. Urut :&nbsp; <br/><span class="no_urut"><?php echo $lap->no_urut?></span></td>
		</tr>
		<tr>
			<td colspan="4">Perihal :&nbsp; <br/><span class="perihal"><?php echo $lap->perihal?></span></td>
		</tr>
		<tr>
			<td colspan="4"><?php echo $lap->type_surat=='masuk'?'Dari':'Kepada'?> :&nbsp;<br/> <span class="dari"><?php echo $lap->skpd?></span></td>
		</tr>
		<tr>
			<td>Tanggal Surat :&nbsp; <br/><span class="tanggal_surat"><?php echo tgl_indo($lap->tanggal_surat)?></span></td>
			<td colspan="2">Nomor Surat : &nbsp; <br/><span class="no_surat"><?php echo $lap->no_surat?></span></td>
			<td>Lampiran :&nbsp; <br/><span class="lampiran2"><?php echo $lap->lampiran2?></span></td>
		</tr>
		<tr>
			<td>Pengolah :&nbsp; <br/><span class="pengolah"><?php echo $lap->pengolah?></span></td>
			<td>Tgl. Diteruskan : &nbsp; <br/><span class="tanggal_diteruskan"><?php echo tgl_indo($lap->tanggal_diteruskan)?></span></td>
			<td  colspan="2">Lampiran :&nbsp; <br/><span class="lampiran"><?php echo $lap->lampiran?></span></td>
		</tr>
		<tr>
			<td colspan="4">Catatan :&nbsp;<br/> <span class="catatan"><?php echo $lap->catatan?></span></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><input type="button" value="cetak" onclick="surat_pdf(<?php echo $lap->id_lap_skpd?>)"/></td>
		</tr>
	</tbody>
</table>

<script type="text/javascript">
function surat_pdf(id) {
	var url = "<?php echo base_url()?>admin/com/surat/cetak/surat/<?php echo $lap->id_lap_skpd?>";
	window.open(url);
	//console.log(id)
}
function disposisi_pdf(id) {
	var url = "<?php echo base_url()?>admin/com/surat/cetak/disposisi/" + id;
	window.open(url);
	//console.log(id)
}
$('input[name=switch]').change(function(){
	$('.switch').toggle();
});
</script>