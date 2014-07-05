<html>
<head>
	<title>LAPORAN RETENSI ARSIP BULAN : <?php echo bln_indo($bulan?$bulan:'ALL')?> , TAHUN : <?php echo $tahun?$tahun:'ALL'?></title>
	<meta content='setColumn {"0":5,"1":34,"2":30,"3":50,"4":10,"5":12,"6":12,"7":16,"8":16}'/>
	<meta content='setRow {"0":30,"1":30}'/>
	
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
		<thead>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">KANTOR ARSIP DAERAH KOTA TANGERANG SELATAN</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter">DATA PELAYANAN ARSIP </th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				LAYANAN BULAN : <?php echo bln_indo($bulan?$bulan:'ALL')?>
				</th>
			</tr>
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				LAYANAN TAHUN : <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>
			
			<tr>
				<th colspan="9" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NO</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NAMA/ALAMAT/STATUS KLIEN</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NOMOR BERKAS</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>JUDUL ARSIP</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>COPY/ASLI</b></th>
				<th colspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>HASIL LAYANAN</b></th>
				<th colspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter"><b>TANGGAL</b></th>
			</tr>
			<tr>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">ADA</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">TIDAK ADA</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">PINJAM</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter">KEMBALI</td>
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
			<?php $count = count($pelayanan_list); $i = 0; ?>
			<?php foreach($pelayanan_list as $r):?>
			<?php ++$i;$is_last=($i==$count);?>

			<tr>
				<td style="border-left:medium;text-align:center;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $no++?></td>
				<td style="text-wraping:true;border-left:thin;text-align:left;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->nama_alamat_status?></td>
				<td style="text-wraping:true;border-left:thin;text-align:left;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->no_berkas?></td>
				<td style="text-wraping:true;border-left:thin;font-style:italic;text-align:left;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->judul?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo strtoupper($r->type_arsip)?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->status_ada?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->status_tidak_ada?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->tanggal_pinjam?></td>
				<td style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:medium;<?php echo $is_last? 'border-bottom:medium;':''?>font-size:10px;valign:vcenter"><?php echo $r->tanggal_kembali?></td>
			</tr>

			<?php endforeach;?>
		</tbody>
	</table>

</body>
</html>