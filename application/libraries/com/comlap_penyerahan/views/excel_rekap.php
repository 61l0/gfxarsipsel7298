<html>
<head>
	<title>LAPORAN REKAP PENYERAHAN ARSIP TAHUN : <?php echo $tahun?$tahun:'ALL'?></title>
	<meta content='setColumn {"0":5,"1":12,"2":25,"3":10,"4":15,"5":15,"6":30,"7":16,"8":16}'/>
	<meta content='setRow {"0":30,"1":30,"7":20,"8":20}'/>
	
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
		<thead>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">KANTOR ARSIP DAERAH KOTA TANGERANG SELATAN</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter">LAPORAN REKAP PENYERAHAN ARSIP </th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>

			<tr>
				<th colspan="2" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">KODE KLASIFIKASI </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $klasifikasi_kode ? strtoupper(str_replace('-', '/', $klasifikasi_text )) :'ALL' ?>
				</th>
			</tr>
			<tr>
				<th colspan="2" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">TAHUN ARSIP</th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>

			<tr>
				<th colspan="2" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">INSTANSI </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $id_unit_pengolah?strtoupper($unit_pengolah_text):'SEMUA INSTANSI'?>
				</th>
			</tr>

			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NO</b></th>
				<th style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>KODE</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>MASALAH</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>TAHUN</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>JUMLAH ARSIP</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>JUMLAH BOKS</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>INSTANSI</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter"><b>KETERANGAN</b></th>
			</tr>
			<tr>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">KLASIFIKASI</td>
				
			</tr>
			<tr class="idx">
				<th style="border-left:medium;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>1</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>2</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>3</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>4</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>5</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>6</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>7</sup></th>
				<th style="border-left:thin;text-align:center;font-weight:bold;font-size:8px;border-right:medium;border-top:double;border-bottom:double;valign:vcenter"><sup>8</sup></th>
			</tr>	
		</thead>
		<tbody>
			<?php $count = count($ba_list); $i = 0; ?>
			<?php foreach($ba_list as $r):?>
			<?php ++$i?>
			<?php $is_last = ($i==$count);?>
			<tr>
				<td style="border-left:medium;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $no++?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->klasifikasi_kode?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo strtoupper($r->klasifikasi_text)?></td>
				
				<td style="text-wraping:true;border-left:thin;font-weight:bold;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->tahun?></td>
				
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->jumlah_arsip?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->jumlah_box?></td>
				<td style="text-wraping:true;border-left:thin;text-align:left;border-top:thin;border-right:thin;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo $r->instansi?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:medium;border-bottom:<?php echo $is_last?'medium':'thin'?>;font-size:10px;valign:vcenter"><?php echo 'BAIK DAN ASLI'?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</body>
</html>