<!doctype html>
<html>
<head><title></title></head>
<body>
<?php 
$lap = $data;
//print_r($data);
?>
<style type="text/css">
	.tbl-view {
		border-collapse: collapse;
	}
	.tbl-view > tbody > tr > td {
		padding: 4px;
/*		height: 65px;*/
	}
	.tbl-view > tbody > tr > td > span{
		font-weight: bold;
		/*padding: 4px 2px;*/
	}
	.tbl-print{
		/*display: none;*/
		margin-left: 75px;
		/*height: 600px;*/
	}
	.tbl-print tr td{
		/*height: 65px;*/
		padding: .5em 1em !important;
	}
	.rotate{
		/**/
		/*text-align: center;
		margin: 212px;
		height: 100px;
		width:300px;
		
		display: block;
		position: absolute;*/
		border:solid 1px #000;
		background: #dedede;
	/*	width: 200px;*/
	}
	h4.rt{
		-webkit-transform: rotate(-90deg);
		width: 470px;
		/*height:70px;*/
		text-align: center;
		position: absolute;
/*		background: red;*/
		margin-top:445px; 
		margin-left: -20px;
		/*padding: 4px;*/
		font-size: 25px;
	}
	td.instansi{
		/*height: 60px;*/
	}
	td.perihal,td.catatan{
		height: 76px;
	}
	.rt > .sm{
		font-size: 20px;
		font-weight: bold;
		/*line-height: 12px;*/
	}
</style>
<div>
<h4 class="rt"><div class="sm">PEMERINTAH KOTA TANGERANG SELATAN</div>KANTOR ARSIP DAERAH<br/>KARTU KENDALI SURAT <?php echo strtoupper($lap->type_surat)?></h4>
<table border="1" width="98%"  cellpadding="8" colspacing="8" class="tbl-view tbl-print">

	<tbody>

		<tr>
			<td valign="top" colspan="2">Indeks :&nbsp; <br/><span class="indeks"><?php echo $lap->indeks?></span></td>
			<td valign="top" >Kode : &nbsp; <br/><span class="kode"><?php echo $lap->kode?></span></td>
			<td valign="top" >No. Urut :&nbsp; <br/><span class="no_urut"><?php echo $lap->no_urut?></span></td>
		</tr>
		<tr>
			<td class="perihal" valign="top"  colspan="4">Perihal :&nbsp; <br/><span class="perihal"><?php echo $lap->perihal?></span></td>
		</tr>
		<tr>
			<td class="instansi" valign="top"  colspan="4"><?php echo $lap->type_surat=='masuk'?'Dari':'Kepada'?> :&nbsp;<br/> <span class="dari"><?php echo $lap->skpd?></span></td>
		</tr>
		<tr>
			<td valign="top" >Tanggal Surat :&nbsp; <br/><span class="tanggal_surat"><?php echo tgl_indo($lap->tanggal_surat)?></span></td>
			<td valign="top"  colspan="2">Nomor Surat : &nbsp; <br/><span class="no_surat"><?php echo $lap->no_surat?></span></td>
			<td valign="top" >Lampiran :&nbsp; <br/><span class="lampiran2"><?php echo $lap->lampiran2?></span></td>
		</tr>
		<tr>
			<td valign="top" >Pengolah :&nbsp; <br/><span class="pengolah"><?php echo $lap->pengolah?></span></td>
			<td valign="top" >Tgl. Diteruskan : &nbsp; <br/><span class="tanggal_diteruskan"><?php echo tgl_indo($lap->tanggal_diteruskan)?></span></td>
			<td valign="top"   colspan="2">Lampiran :&nbsp; <br/><span class="lampiran"><?php echo $lap->lampiran?></span></td>
		</tr>
		<tr>
			<td class="catatan"  valign="top" colspan="4">Catatan :&nbsp;<br/> <span class="catatan"><?php echo $lap->catatan?></span></td>
		</tr>
	</tbody>
</table>

</div>
</body>
