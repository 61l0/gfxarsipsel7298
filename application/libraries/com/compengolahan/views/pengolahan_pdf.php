<?php $page=1;?>
<table id="A4" width="21cm" height="29.7cm" border="0" colspacing="2" cellpadding="2">
	<tbody>
		<!-- MARGIN TOP -->
		<tr>
			<td height="2px" colspan="3"></td>
		</tr>
		<!-- GAMBAR LOGO  -->
		<tr id="header" width="100%">
			<td class="logo" valign="bottom" align="center" width="135px">
				<img src="<?php echo $base_url?>assets/image/logo_kop.gif" height="105px"/>
			</td>
		<!-- COMPANY HEADER -->
			<td class="company"  valign="top" align="center" width="510px">
				<font face="helvetica" size="11">PEMERINTAH KOTA TANGERANG SELATAN</font>
				<h3><font face="times" size="25">KANTOR ARSIP DAERAH</font> </h3>
				<font face="helvetica" size="10">JL. Jend Ahmad Yani, No. 7  Tangerang 15112 (021) - 5589486</font><br/>
			</td>
			<td width="130px"></td>
		</tr>
		<!-- HORIZONTAL RULER -->
		<tr>
			<td colspan="3">
				<img src="assets/css/metro/images/hr.jpg"/>
			</td>
		</tr>
		<!-- MARGIN TOP -->
		<tr>
			<td height="20px"  colspan="3"></td>
		</tr>
		<!-- DETAIL DATA -->
		<tr id="content">
			<td valign="top" colspan="3" height="23cm">
				<table align="center" border="0" width="90%" colspacing="3" cellpadding="3">
					<tbody>
						<?php
							//storage
							$storage = '<table border="1" width="150px" cellpadding="3" colspacing="3">';
							foreach($tree as $rowtree){

								
								$storage .= "<tr>
												
												<td width='10px' align='left'>".ucfirst(@$rowtree->type == 'folder'? 'sampul': $rowtree->type)."</td>
												<td width='16px' align='left'>&nbsp; ".$rowtree->name."</td>
											</tr>";
								if($rowtree->type == 'folder')
									break;
							}
							$storage .= '</table>';
							$properties = array(
								'Kode Klasifikasi'	=> $lihat_data[0]->kode_masalah .' - '.@$lihat_data[0]->nama_masalah,
								'Judul Arsip'		=> $lihat_data[0]->judul,
								'Nomor Berkas'		=> orminus( $lihat_data[0]->no_arsip) .'/'.orminus($lihat_data[0]->agenda).'.'.orminus($lihat_data[0]->kode_komponen).'/'.orminus($lihat_data[0]->tahun),
								'Tanggal Berkas'	=> tgl_indo($lihat_data[0]->tanggal)
							);
							if($lihat_data[0]->status == 'tinjau'){
								$stamp = tgl_indo(@$lihat_data[0]->tgl_dinilai_kembali);
								$properties['Tanggal Dinilai Kembali'] = $stamp;
								$properties['Sudah Dinilai kembali sebanyak'] = $lihat_data[0]->jml_tinjauan . " kali.";
							}
	
							$properties2=array(	
								'Tahun Arsip'		=> $lihat_data[0]->tahun,
								"Instansi" => $lihat_data[0]->nama_lengkap,
								"Lokasi" => $lihat_data[0]->lokasi,
								"Keterangan" => $lihat_data[0]->keterangan,
								"Tempat Penyimpanan"	=> $storage,
								"Retensi" => "Aktif &nbsp;&nbsp;   :".($lihat_data[0]->rt_aktif?$lihat_data[0]->rt_aktif . ' tahun':' belum ditentukan').". &nbsp;&nbsp;<br/>Inaktif &nbsp;&nbsp;:".($lihat_data[0]->rt_inaktif?$lihat_data[0]->rt_inaktif . ' tahun':' belum ditentukan').". &nbsp;&nbsp;",
								"Jenis Arsip" => $lihat_data[0]->nama_jenis,
								"Sifat Arsip"=>$lihat_data[0]->nama_sifat,	

							);	
							$properties = array_merge($properties,$properties2);
						?>
						<?php foreach($properties as $prop => $value):?>
						<tr>
							<td width="20px"></td>
							<th align="left" 	valign="top" width="190px"><font size="10" face="helvetica"><?php echo $prop ?></font></th>
							<td align="center" 	valign="top" width="16px"><font size="10" face="helvetica">:</font></td>
							<td align="left" 	valign="top" width="465px"><font size="10" face="helvetica"><?php echo $value?></font></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr id="footer">
			<td valign="top" colspan="3">
				<hr width="20cm"/>
				<table border="0" width="20.5cm" cellpadding="3" colspacing="3">
					<tr>
						<td valign="middle" align="center" width="30px"><b><i><?php echo $page++?></i></b></td>
						<td align="left" width="12cm"><i>SISTEM INFORMASI ARSIP KOTA TANGERANG</i></td>
						<td align="right"><i><?php echo date('d/m/Y',time())?></i></td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<!-- IMAGE LIST -->
<table border="0"  colspacing="2" cellpadding="2">
	<?php if($image != ""):?>
		<?php foreach(@$image as $rowx): ?>
			<?php $img_path = 'assets/media/file/arsip_galery/'.$lihat_data[0]->id_data.'/'.$rowx->foto ; ?>
			<?php if(file_exists( $img_path )): ?>
			<tr>
				<td width="20.4cm" height="27.4cm" align="center" valign="top">
					<img src="<?php echo $img_path; ?>" width="20cm" />
				</td>
			</tr>
			<tr id="footer">
				<td valign="top">
					<hr width="20cm"/>
					<table border="0" width="20.5cm" cellpadding="3" colspacing="3">
						<tr>
							<td valign="middle" align="center" width="30px"><b><i><?php echo $page++?></i></b></td>
							<td align="left" width="12cm"><i>SISTEM INFORMASI ARSIP KOTA TANGERANG</i></td>
							<td align="right"><i><?php echo date('d/m/Y',time())?></i></td>
						</tr>
					</table>
				</td>
			</tr>
			<?php endif; ?>	
		<?php endforeach;?>
	<?php endif; ?>
</table>
