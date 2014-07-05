<style type="text/css" media="print">
.style_lembar {
    font-size: 40px
}
.style_head {
	background:#fff;
	font-family:calibri,arial;
	font-size:40px;
	margin: 0px;
	margin-top: 0px;
	margin-bottom: 0px;
}
.style_body {
	background:#fff;
	font-family:calibri,arial;
	font-size:16px;
	margin: 0px;
	margin-top: 0px;
	margin-bottom: 0px;
}

</style>
<br />&nbsp;<br />
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="style_body">
<tr>
<td width="13%" align="center" valign="middle"><img src="assets/image/logo_kop.gif" alt="corner" style="float:left" width="55" height="55"  /></td>
<td width="73%" align="center"><strong>PEMERINTAH KOTA TANGERANG SELATAN  <br />
 KANTOR ARSIP </strong><br />
	Jl. Jend Ahmad Yani, No. 7  Tangerang 15112 (0)21 5589486</td>

</tr>
</table>
<hr  />
<hr  />
<br />
<table border="0" align="center" width="100%" bordercolor="#000000" class="style_body">
<tr>
<td width="4%" align="center"></td>
<td colspan="6" align="left"></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Nama Klasifikasi</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->nama_masalah ?></span></td>

</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Judul Arsip</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->judul ?></span></td>

</tr>

<tr align="left">
<td width="4%"></td>
<td width="17%">Nomor Arsip</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->no_arsip ?></span></td>
</tr>

<tr align="left">
<td width="4%"></td>
<td width="17%">Agenda</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->agenda ?></span></td>
</tr>

<tr align="left">
<td width="4%"></td>
<td width="17%">Kode Komponen</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->kode_komponen?></span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Tahun</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->tahun ?></span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Tanggal</td>
<td width="2%">:</td>
<td width="23%"><span >
<?
				$stamp = strtotime(@$lihat_data[0]->tgl_input);
				$tanggal_pinjam = date("d-m-Y", $stamp);
				echo @$tanggal_pinjam ?>
</span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Unit Pengolah</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->nama_lengkap ?></span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Lokasi</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->lokasi ?></span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Keterangan</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->desc?></span></td>
</tr>

<? foreach($tree as $rowtree){ ?>
	<tr align="left">
	<td width="4%"></td>
	<td width="17%"><?=@$rowtree->type ?></td>
	<td width="2%">:</td>
	<td width="23%"><span ><?=@$rowtree->name ?></span></td>
	</tr>	
<? } ?>

<tr align="left">
<td width="4%"></td>
<td width="17%">Retensi</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->nama_retensi?></span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Jenis Arsip</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->nama_jenis?></span></td>
</tr>
<tr align="left">
<td width="4%"></td>
<td width="17%">Sifat Arsip</td>
<td width="2%">:</td>
<td width="23%"><span ><?=@$lihat_data[0]->nama_sifat?></span></td>
</tr>

</table>

<br />

<? if($image != ""){ foreach(@$image as $rowx){?>
	
	<span ><img src="assets/media/file/arsip_galery/<?=@$lihat_data[0]->id_data?>/<?=@$rowx->foto?>"/></span>
				 
<?php 
}}
?>  			
