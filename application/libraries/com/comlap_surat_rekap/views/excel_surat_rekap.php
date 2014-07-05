<?php 
function is_seri($v)
{
	return $v=='Seri'?'V':'-';
}
function is_rubrik($v)
{
	return $v=='Rubrik'?'V':'-';
}
function is_dosir($v)
{
	return $v=='Dosir'?'V':'-';
}
function is_cabinet($v)
{
	return $v=='Cabinet'?'V':'-';
}
function is_rak($v)
{
	return $v=='Rak'?'V':'-';
}
function is_box($v)
{
	return $v=='Box'?'V':'-';
}
?><html>
<head>
	<title>REKAP INDEKS KLASIFIKASI</title>
	<meta content='setColumn {"0":3,"1":13,"2":13,"3":13,"4":9,"5":9,"6":9,"7":9,"8":9,"9":9,"10":7,"11":14}'/>
	<meta content='setRow {"0":30,"1":"30","5":"15","6":"15"}'/>
	<meta content=''/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
	
			<tr>
				<th colspan="12" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">REKAP INDEKS KLASIFIKASI</th>
			</tr>
			<tr>
				<th colspan="12" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">LAPORAN BULANAN PENATAAN ARSIP AKTIF</th>
			</tr>
			<tr>
				<th colspan="12" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter"><?php echo $mode=='admin'?'SEMUA INSTANSI':'INSTANSI : ' . $instansi ?></th>
			</tr>
			<tr>
				<th colspan="12" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter"> 
					BULAN : <?php echo bln_indo($bulan?$bulan:'ALL')?>, TAHUN : <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>
			<!-- <tr>
				<th colspan="12" style="border:none;font-weight:bold;text-align:left;font-size:16px;valign:vcenter">
				SURAT KELUAR
				</th>
			</tr> -->
		
			<tr>
				<th colspan="12" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">&nbsp;</th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>NO</b></th>
				<th style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>KODE</b></th>
				<th colspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>JUMLAH ARSIP/DOKUMEN</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>TAHUN</b></th>
				<th colspan="3" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>SISTEM PENYIMPANAN</b></th>
				<th colspan="3" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter"><b>LOKASI PENYIMPANAN</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:10px;valign:vcenter"><b>KET</b></th>
			</tr>
			<tr>
				<th style="border-left:thin;text-align:center;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">KLASIFIKASI</th>

				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">S.MASUK</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">S.KELUAR</th>
				
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">SERI</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">RUBRIK</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">DOSIR</th>

				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter;text-wraping:true">FILLING CABINET</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">RAK</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:10px;valign:vcenter">BOK</th>
			</tr>
			<tr class="idx">
				<th style="border-left:medium;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>1</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>2</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>3</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>4</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>5</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>6</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>7</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>8</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>9</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>10</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>11</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:medium;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>12</sup></th>
			</tr>	
	
		<tbody>
			<?php $count = count($surat_rekap_list); $i = 0; ?>
			<?php foreach($surat_rekap_list as $p_kode => $r):?>
			<?php $is_last = ($i==$count-1);$r = (object)$r;?>
			<?php ++$i?>
			<tr>
				<th style="border-left:medium;border-right:thin">&nbsp;</th>

				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:medium">&nbsp;</th>
			</tr>
			
			<tr>
				<th style="border-left:medium;border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $i ?></th>
				<th style="text-align:center;valign:vcenter;border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $p_kode ?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->jml_surat_masuk ?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->jml_surat_keluar ?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->tahun?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->is_seri ? 'V' : '-'?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->is_rubrik ? 'V' : '-'?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->is_dosir ? 'V' : '-'?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->is_cabinet ? 'V' : '-'?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->is_rak ? 'V' : '-'?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->is_boks ? 'V' : '-' ?></th>
				<th style="border-right:medium;text-align:center;valign:vcenter;<?php echo $is_last? 'border-bottom:medium':''?>">BAIK DAN ASLI</th>	
			</tr>
			
			<?php endforeach;?>
		</tbody>
	</table>

</body>
</html>