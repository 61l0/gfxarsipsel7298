<!doctype html>
<html>
<head>
	<title>KARTU PENERUS DISPOSISI</title>
	<style type="text/css">
	body{
		font-size: 12px;
	}
	@page { margin: 10px; }	
	body { margin: 10px; }
	.tbl-view > tbody > tr > td {
		padding: 4px;
	}
	.tbl-view > tbody > tr > td > span{
		font-weight: bold;
		padding: 4px 2px;
	}
	.tbl-print{
		/*display: none;*/
		border-collapse: collapse;
	}
	label{
		font-size: 12px;
	}
	b{
		font-weight: bold;
	}
	.bt{
		border-top:solid 1px #000;
	}
	.bb{
		border-bottom:solid 1px #000;
	}
	</style>
</head>
<body>
<h3 style="font-size:20px;text-align:center;text-decoration:underline">KARTU PENERUS DISPOSISI</h3>
<table border="0" width="100%"  class="tbl-view tbl-print switch" >

	<tr>
		<td width="55px" valign="top" class="bt"><b>INDEKS</b></td>
		<td width="5px" valign="top" class="bt">:</td>
		<td valign="top" width="" colspan="2" class="bt"><?php echo $data->indeks?></td>
	
		<td width=""   valign="top" class="bt"><div  align="right"><b>TANGGAL PENYELESAIAN</b></div><div align="right"><?php echo tgl_indo($data->tanggal_penyelesaian)?></div></td>
	</tr>
	<tr>
		<td valign="top" class="bt"><b>PERIHAL</b></td>
		<td valign="top" class="bt">:</td>
		<td valign="top" colspan="3" class="bt"><?php echo $data->perihal?></td>
	</tr>
	<tr>
		<td valign="top"><b>Tgl./No.</b></td>
		<td valign="top">:</td>
		<td valign="top" colspan="3"><?php echo date('d-m-Y',strtotime($data->tanggal_surat)) . '/' . $data->no_surat?></td>
	</tr>
	<tr style="border-bottom:solid 1px #000">
		<td valign="top"><b>Asal</b></td>
		<td valign="top">:</td>
		<td valign="top" colspan="3"><?php echo $data->skpd?></td>
	</tr>
	<tr>
		<td valign="top" colspan="5" class="bt" style="padding:0">
			<table border="0"  width="100%" class="tbl-print">
				<tr>
					<td valign="top" width="50%" style="padding:.5em;border-right:solid 1px #000;height:400px" class="bb">
						<div align="center"><b>INSTRUKSI / INFORMASI</b></div>
						<div style="padding:.5em">
							<?php echo $data->instruksi?>
						</div>
					</td>
					<td valign="top" width="50%" class="bb" style="padding:.5em;">
						<div align="center"><b>DITERUSKAN KEPADA</b></div>
						<div style="padding:.5em">
							<?php echo $data->diteruskan_kepada?>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top" colspan="5" class="bt" style="padding:0">
			<table border="0"  width="100%" class="tbl-print">
				<tr>
					<td width="50%" valign="top">
						<div style="margin:10px 0;"><b>Sesudah digunakan harap segera dikembalikan</b></div>
						<table border="0" width="100%" class="tbl-print" cellpadding="2" colspacing="0">
							<tr>
								<td width="10px">Kepada</td><td width="4px">:&nbsp;&nbsp;</td><td><?php echo $data->kepada?></td>
							</tr>
							<tr>
								<td>Tanggal</td><td>:&nbsp;&nbsp;</td><td><?php echo tgl_indo($data->tanggal_kembali)?></td>
							</tr>
						</table>
					</td>
					<td width="50%" valign="top">
						<ol>
				<li>Kepada Bawahan "Instruksi" dan atau "Informasi"</li>
				<li>Kepada Atasan "Informasi" coret "Instruksi"</li>
			</ol>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- <tr>
		<td valign="top" colspan="2" width="50%" style="border-right:solid 1px #000"><div align="center"><b>INSTRUKSI / INFORMASI</b></div></td>
		<td valign="top" colspan="2" width="50%"><div align="center"><b>DITERUSKAN KEPADA</b></div></td>
	</tr>
	<tr style="border-bottom:solid 1px #000">
		<td valign="top" colspan="2" width="50%"  style="border-right:solid 1px #000"><?php echo $data->instruksi?></td>
		<td valign="top" colspan="2" width="50%"><?php echo $data->diteruskan_kepada?></td>
	</tr> -->

	<!-- <tr>
		<td colspan="2" valign="top">
			<div style="margin:10px 0;"><b>Sesudah digunakan harap segera dikembalikan</b></div>
			<div>Kepada&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo $data->kepada?></div>
			<div>Tanggal&nbsp;&nbsp;:&nbsp;<?php echo tgl_indo($data->tanggal_kembali)?></div>
		</td>
		<td colspan="2" valign="top">
			<ol>
				<li>Kepada Bawahan "Instruksi" dan atau "Informasi"</li>
				<li>Kepada Atasan "Informasi" coret "Instruksi"</li>
			</ol>
		</td>
	</tr> -->	
</table>
</body>
</html>