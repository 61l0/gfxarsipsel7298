<html>
<head>
	<title>LAPORAN PENYERAHAN DAFTAR ARSIP  : <?php echo bln_indo($bulan?$bulan:'ALL')?> , TAHUN : <?php echo $tahun?$tahun:'ALL'?></title>
	<meta content='setColumn {"0":3,"1":10,"2":20,"3":50,"4":8,"5":9,"6":9,"7":9,"8":10,"9":10,"10":9,"11":9,"11":9,"12":20,"13":14}'/>
	<meta content='setRow {"0":25,"1":20,"6":20,"7":20}'/>
	
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
		<thead>
			<tr>
				<th colspan="14" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">KANTOR ARSIP DAERAH KOTA TANGERANG</th>
			</tr>
			<tr>
				<th colspan="14" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter">PENYERAHAN DAFTAR ARSIP</th>
			</tr>
			<tr>
				<th colspan="14" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th colspan="2" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">KODE KLASIFIKASI </th>
				<th colspan="12" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $klasifikasi_text != 'ALL' ? $klasifikasi_kode . ' / '. $klasifikasi_text : 'ALL'?>
				</th>
			</tr>
			<tr>
				<th colspan="2" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">TAHUN </th>
				<th colspan="12" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>
			<tr>
				<th colspan="14" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NO</b></th>
				<th style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>KODE</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>MASALAH</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>DESKRIPSI/URAIAN MASALAH</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>TAHUN</b></th>
				<th colspan="3" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>SISTEM PENYIMPANAN</b></th>
				<th colspan="4" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>LOKASI PENYIMPANAN</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>INSTANSI</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter"><b>KETERANGAN</b></th>
			</tr>
			<tr>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">KLASIFIKASI</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">SERI</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">RUBRIK</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">DOSIR</td>

				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">NO. SAMPUL</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">NO. BOKS</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">RAK</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">ROOL</td>

			</tr>
			<tr class="idx">
				<th style="border-left:medium;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>1</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>2</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>3</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>4</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>5</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>6</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>7</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>8</sup></th>

				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>9</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>10</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>11</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>12</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>13</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:medium;border-top:double;border-bottom:double;valign:vcenter"><sup>14</sup></th>
			</tr>	
		</thead>
		<tbody>
			<?php $count = count($ba_list); $i = 0; ?>
			<?php foreach($ba_list as $r):?>
			<?php ++$i?>
			<?php $is_last = ($i==$count) ;?>
			<tr>
				<td style="border-left:medium;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $no++?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->kode_masalah?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo strtoupper($klasifikasi_l[$r->kode_masalah])?></td>
				<td style="text-wraping:true;border-left:thin;font-style:italic;text-align:left;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->judul?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->tahun?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->sistem_penyimpanan=='seri'?'V':'-'?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->sistem_penyimpanan=='rubrik'?'V':'-'?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->sistem_penyimpanan=='dosir'?'V':'-'?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->sampul ? $r->sampul : '-'?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->boks ? $r->boks :'-'?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->type=='rak' ? $r->rak : '-' ?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->type=='rool' ? $r->rak : '-' ?></td>

				<td style="text-wraping:true;border-left:thin;text-align:left;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->instansi ? $r->instansi :'-'?></td>
				<td style="text-wraping:true;border-left:thin;text-align:left;border-top:thin;border-right:medium;border-bottom:<?php echo $is_last ? 'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->keterangan ? $r->keterangan :'-'?></td>
				
			</tr>
		
			<?php endforeach;?>
		</tbody>
	</table>

</body>
</html>