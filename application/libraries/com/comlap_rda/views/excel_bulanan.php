<html>
<head>
	<title>LAPORAN REKAPITULASI DATA ARSIP  : <?php echo bln_indo($bulan?$bulan:'ALL')?> , TAHUN : <?php echo $tahun?$tahun:'ALL'?></title>
	<meta content='setColumn {"0":15,"1":20,"2":20,"3":60,"4":10,"5":10,"6":10,"7":10}'/>
	<meta content='setRow {"0":25,"1":20,"9":20,"10":20}'/>
	
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
		<thead>
			<tr>
				<th colspan="8" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">KANTOR ARSIP DAERAH KOTA TANGERANG</th>
			</tr>
			<tr>
				<th colspan="8" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter">REKAPITULASI DATA ARSIP</th>
			</tr>
			<tr>
				<th colspan="8" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th  style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">DEPO </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $depo_text?$depo_text:'ALL'?>
				</th>
			</tr>
			<tr>
				<th  style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">BULAN </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $bulan?$bulan:'ALL'?>
				</th>
			</tr>
			<tr>
				<th  style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">TAHUN </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>
		
			<tr>
				<th  style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">KODE KLASIFIKASI </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $klasifikasi_text != 'ALL' ? strtoupper(str_replace(' - ',' / ',$klasifikasi_text)) : 'ALL'?>
				</th>
			</tr>
		
			
			<tr>
				<th  style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">INSTANSI </th>
				<th colspan="7" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">
				: <?php echo $unit_pengolah_text != 'ALL' ? strtoupper($unit_pengolah_text)  : 'SEMUA INSTANSI'?>
				</th>
			</tr>
		
			
			<tr>
				<th colspan="8" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter"> </th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>DEPO</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>TAHUN ARSIP</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>KLASIFIKASI</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>MASALAH</b></th>
				<th colspan="4" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter"><b>JUMLAH ARSIP</b></th>
			</tr>
			<tr>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">DATA ARSIP</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">RAK</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">BOKS</td>
				<td style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter">SAMPUL</td>

			</tr>	
		</thead>
		<tbody>
			<?php $count = count($rda_list); $i = 0; ?>
			<?php foreach($rda_list as $r):?>
			<?php $r=(object)$r;?>
			<?php  $bold = $klasifikasi_kode==$r->kode ;?>
			<tr>
				<?php if($i==0){ ?>
				<td rowspan="<?php echo $count ?>" style="border-left:medium;text-align:center;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->depo ?></td>
				<td rowspan="<?php echo $count ?>" style="text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->tahun?></td>
				<?php } ?>
				<td style="<?php echo $bold?'font-weight:bold':''?>;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->kode?></td>
				<td style="<?php echo $bold?'font-weight:bold':''?>;text-wraping:true;border-left:thin;text-align:left;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->masalah?></td>
				<td style="<?php echo $bold?'font-weight:bold':''?>;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->data?></td>
				<td style="<?php echo $bold?'font-weight:bold':''?>;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->rak?></td>
				<td style="<?php echo $bold?'font-weight:bold':''?>;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->boks?></td>
				<td style="<?php echo $bold?'font-weight:bold':''?>;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:medium;border-bottom:thin;font-size:10px;valign:vcenter"><?php echo $r->sampul?></td>
				
			</tr>

			
			<?php $i+=1; ?>
			<?php endforeach;?>
			<tr>
				<td colspan="4" style="font-weight:bold;text-wraping:true;border-left:thin;text-align:right;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter">JUMLAH</td>
				<td style="font-weight:bold;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $total_data?></td>
				<td style="font-weight:bold;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $total_rak?></td>
				<td style="font-weight:bold;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:thin;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $total_boks?></td>
				<td style="font-weight:bold;text-wraping:true;border-left:thin;text-align:center;border-top:thin;border-right:medium;border-bottom:medium;font-size:10px;valign:vcenter"><?php echo $total_sampul?></td>
			</tr>
		</tbody>
	</table>

</body>
</html>