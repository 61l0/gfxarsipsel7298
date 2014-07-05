<html>
<head>
	<title>LAPORAN RETENSI ARSIP BULAN : <?php echo bln_indo($bulan?$bulan:'ALL')?> , TAHUN : <?php echo $tahun?$tahun:'ALL'?></title>
	<meta content='setColumn {"0":5,"1":14,"2":20,"3":50,"4":8,"5":9,"6":9,"7":16,"8":16}'/>
	<meta content='setRow {"0":30,"1":30}'/>
	
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
		<thead>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">KANTOR ARSIP DAERAH KOTA TANGERANG SELATAN</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter">RETENSI ARSIP </th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				BULAN : <?php echo bln_indo($bulan?$bulan:'ALL')?>
				</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				TAHUN : <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				STATUS : <?php echo $status?$status:'ALL'?>
				</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NO</b></th>
				<th style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>KODE</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>MASALAH</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>DESKRIPSI/URAIAN MASALAH</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>TAHUN</b></th>
				<th colspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>RETENSI ARSIP</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>STATUS</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter"><b>KETERANGAN</b></th>
			</tr>
			<tr>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">KLASIFIKASI</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">AKTIF</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">INAKTIF</td>
			</tr>
			<tr class="idx">
				<th style="border-left:medium;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>1</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>2</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>3</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>4</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>5</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>6</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>7</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:double;border-bottom:double;valign:vcenter"><sup>8</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:medium;border-top:double;border-bottom:double;valign:vcenter"><sup>9</sup></th>
			</tr>	
		</thead>
		<tbody>
			<?php $count = count($retensi_list); $i = 0; ?>
			<?php foreach($retensi_list as $r):?>
			<?php ++$i?>
			<?php if($i==$count):?>
			<tr>
				<td style="border-left:medium;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $no++?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->kode_masalah?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo strtoupper($klasifikasi_l[$r->kode_masalah])?></td>
				<td style="text-wraping:true;border-left:thin;font-style:italic;text-align:left;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->judul?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->tahun?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->rt_aktif?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->rt_inaktif?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->rt_desc?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:medium;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $r->status?></td>
			</tr>
			<?php else:?>
			<tr>
				<td style="border-left:medium;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $no++?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $r->kode_masalah?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo strtoupper($klasifikasi_l[$r->kode_masalah])?></td>
				<td style="text-wraping:true;border-left:thin;font-style:italic;text-align:left;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $r->judul?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $r->tahun?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $r->rt_aktif?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $r->rt_inaktif?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;font-size:10px;valign:vcenter"><?php echo $r->rt_desc?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:medium;font-size:10px;valign:vcenter"><?php echo $r->status?></td>
			</tr>
			<?php endif?>
			<?php endforeach;?>
		</tbody>
	</table>

</body>
</html>