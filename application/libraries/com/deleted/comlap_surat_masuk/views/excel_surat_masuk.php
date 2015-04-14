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
	<title>LAPORAN BULANAN PENATAAN ARSIP AKTIF</title>
	<meta content='setColumn {"0":3,"1":5,"2":5,"3":20,"4":10,"5":2,"6":50,"7":8,"8":12,"9":12,"10":12,"11":12,"12":12,"13":12}'/>
	<meta content='setRow {"0":30,"1":30}'/>
	<meta content='run {"0":"$this->_worksheet->setMerge(5,1,6,2);","1":"$this->_worksheet->setMerge(5,4,6,6);"}'/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

	<table border="1" align="center" class="tb-excel" cellpadding="4" colspacing="4" style="border-collapse:collapse" width="98%">
	
			<tr>
				<th colspan="15" style="border:none;font-weight:bold;text-align:center;font-size:18px;valign:vcenter">LAPORAN BULANAN PENATAAN ARSIP AKTIF</th>
			</tr>
			<tr>
				<th colspan="15" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter"><?php echo $mode=='admin'?'SEMUA INSTANSI':'INSTANSI : ' . $instansi ?></th>
			</tr>
			<tr>
				<th colspan="15" style="border:none;font-weight:bold;text-align:center;font-size:14px;valign:vcenter"> 
					BULAN : <?php echo bln_indo($bulan?$bulan:'ALL')?>, TAHUN : <?php echo $tahun?$tahun:'ALL'?>
				</th>
			</tr>
			<tr>
				<th colspan="15" style="border:none;font-weight:bold;text-align:left;font-size:16px;valign:vcenter">
				SURAT MASUK
				</th>
			</tr>
		
			<tr>
				<th colspan="15" style="border:none;font-weight:bold;text-align:left;font-size:10px;valign:vcenter">&nbsp;</th>
			</tr>
			<tr>
				<th rowspan="2" style="border-left:medium;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>NO</b></th>
				<th colspan="2" rowspan="2"style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>KODE</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>KLASIFIKASI</b></th>
				<th colspan="3" rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>DESKRIPSI/URAIAN MASALAH</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>TAHUN</b></th>
				<th colspan="3" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>SISTEM PENYIMPANAN</b></th>
				<th colspan="3" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter"><b>LOKASI PENYIMPANAN</b></th>
				<th rowspan="2" style="border-left:thin;text-align:center;border-top:medium;font-weight:bold;border-right:medium;font-size:12px;valign:vcenter"><b>KET</b></th>
			</tr>
			<tr>
				<th virtual="true" style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">&nbsp;</th>
				<th  virtual="true" style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">&nbsp;</th>
				<th  virtual="true" style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">&nbsp;</th>

				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">SERI</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">RUBRIK</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">DOSIR</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">CABINET</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">RAK</th>
				<th style="border-left:thin;text-align:center;border-top:thin;font-weight:bold;border-right:thin;font-size:12px;valign:vcenter">BOK</th>
			</tr>
			<tr class="idx">
				<th style="border-left:medium;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>1</sup></th>
				<th colspan="2" style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>2</sup></th>
				<th style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>3</sup></th>
				<th colspan="3" style="border-left:thin;text-align:center;font-style:italic;font-size:8px;border-right:thin;border-top:thin;border-bottom:double;valign:vcenter;background:#dedede"><sup>4</sup></th>
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
			<?php $count = count($surat_masuk_list); $i = 0; ?>
			<?php foreach($surat_masuk_list as $r):?>
			<?php $is_last = ($i==$count-1)?>
			<?php ++$i?>
			<tr>
				<th style="border-left:medium;border-right:thin">&nbsp;</th>
				<th>&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th><th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:medium">&nbsp;</th>
			</tr>
			
			<tr>
				<th style="border-left:medium;border-right:thin;text-align:center;valign:vcenter"><?php echo $i ?></th>
				<th style="text-align:center;valign:vcenter"><?php echo $r->p_kode ?></th>
				<th style="border-right:thin">&nbsp;</th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo $r->p_masalah ?></th>
				<th style="">Tanggal</th>
				<th style="">:</th>
				<th style="border-right:thin"><?php echo $r->tanggal_surat?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo $r->tahun?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo is_seri($r->sistem_penyimpanan)?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo is_rubrik($r->sistem_penyimpanan)?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo is_dosir($r->sistem_penyimpanan)?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo is_cabinet($r->lokasi_penyimpanan)?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo is_rak($r->lokasi_penyimpanan)?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo is_box($r->lokasi_penyimpanan)?></th>
				<th style="border-right:medium;text-align:center;valign:vcenter">&nbsp;</th>	
			</tr>
			<tr>
				<th style="border-left:medium;border-right:thin;">&nbsp;</th>
				<th style="">&nbsp;</th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo $r->s_kode ?></th>
				<th style="border-right:thin;text-align:center;valign:vcenter"><?php echo $r->s_masalah ?></th>
				<th style="">No. Surat</th>
				<th style="">:</th>
				<th style="border-right:thin;"><?php echo $r->no_surat?></th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:medium;">&nbsp;</th>	
			</tr>
			<tr>
				<th style="border-left:medium;border-right:thin;">&nbsp;</th>
				<th style="">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="">Perihal</th>
				<th style="">:</th>
				<th style="border-right:thin;"><?php echo $r->perihal?></th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:thin;">&nbsp;</th>
				<th style="border-right:medium;">&nbsp;</th>	
			</tr>
			<tr>
				<th style="border-left:medium;border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="<?php echo $is_last? 'border-bottom:medium':''?>">Dari</th>
				<th style="<?php echo $is_last? 'border-bottom:medium':''?>">:</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>"><?php echo $r->instansi?></th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:thin;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>
				<th style="border-right:medium;<?php echo $is_last? 'border-bottom:medium':''?>">&nbsp;</th>	
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>

</body>
</html>