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
				<img src="<?php echo $base_url?>assets/css/metro/images/lg-tangsel-big.png" height="105px"/>
			</td>
		<!-- COMPANY HEADER -->
			<td class="company"  valign="top" align="center" width="510px">
				<font face="helvetica" size="11">PEMERINTAH KOTA TANGERANG SELATAN</font>
				<h3><font face="times" size="25">KANTOR ARSIP DAERAH</font> </h3>
				<font face="helvetica" size="10">Jl. Siliwangi No. 1 Pamulang Tangerang 15112 Tlp. (021)-7470395</font><br/>
			</td>
			<td width="130px"></td>
		</tr>
		<!-- HORIZONTAL RULER -->
		<tr>
			<td colspan="3" height="5px">
				<img src="assets/css/metro/images/hr.jpg"/>
			</td>
		</tr>
		<!-- MARGIN TOP -->
		<tr>
			<td height="5px"  colspan="3"></td>
		</tr>
		<tr>
			<td height="5px"  colspan="2" align="right" width="700px"><font size="11">Nomor :       /         -Pelayanan</font></td>
			<td width="10px"></td>
		</tr>
		<!-- TITLE -->
		<tr>
			<td height="5px"  colspan="3"></td>
		</tr>
		<tr>
			<td height="5px"  colspan="2" align="center" width="700px">
				<font size="14" face="times">FORMULIR<br/>PERMOHONAN INFORMASI ARSIP</font>
			</td>
			<td width="10px"></td>
		</tr>
		<tr>
			<td height="5px"  colspan="3"></td>
		</tr>
		<tr>
			<td width="60px"></td>
			<td  colspan="2" align="left" width="700px">
				<font size="11">Yang bertanda tangan dibawah ini, mengajukan permintaan informasi arsip :</font>
			</td>
			
		</tr>
		<tr>
			<td height="5px"  colspan="3"></td>
		</tr>
		<!-- DETAIL DATA -->
		<tr id="content">
			<td valign="top" colspan="3" height="6cm">
				<table align="center" border="0" width="90%" colspacing="3" cellpadding="3">
					<tbody>
						<?php
							//storage
							$storage = '<table border="1" width="150px" cellpadding="3" colspacing="3">';
							foreach($tree as $rowtree){

								
								$storage .= "<tr>
												
												<td width='10px' align='left'>".ucfirst($rowtree->type)."</td>
												<td width='16px' align='left'>&nbsp; ".$rowtree->name."</td>
											</tr>";
								if($rowtree->type == 'folder')
									break;
							}
							$storage .= '</table>';
							$p = $p[0];
							$properties = array(
								'Nama Pemohon'	=> orminus($p->nama_peminjam),
								'Nama Pemberi Kuasa' => orminus($p->nama_pemberi_kuasa),
								'Nomor Identitas'		=> orminus($p->no_identitas),
								'Alamat Pemohon'	=> orminus($p->alamat),
								'Nomor Surat Pemohon'		=> orminus($p->no_surat),
								"Informasi/Arsip yang dibutuhkan" => orminus($lihat_data[0]->judul),
								"Keperluan" => orminus($p->lokasi),
								"Tanggal Pinjam" => tgl_indo($p->tanggal_pinjam,1),
								"Tanggal Kembali"	=> tgl_indo($p->tanggal_kembali,1),
							);	
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
		<tr>
			<td width="24px"></td>
			<td  colspan="2" align="left" width="700px">
				<font size="11">Data dan informasi yang kami peroleh, kami gunakan sesuai dengan ketentuan perundang-undangan yang berlaku.</font>
			</td>
			
		</tr>
		<tr>
			<td height="40px"  colspan="3"></td>
		</tr>
		<tr>
			<td width="24px"></td>
			<td  colspan="2" align="right" width="556px">
				<font size="11"><?php echo tgl_indo($p->tanggal_pinjam,true)?></font>
			</td>
			
		</tr>
		<tr>
			<td height="20px"  colspan="3"></td>
		</tr>
		<tr>
			<td width="240px" align="center" valign="top">
				<font size="11">Pemohon Informasi</font>
			</td>
			<td   align="right" width="175px">
				
			</td>
			<td width="240px" align="center" valign="top">
				<font size="11">Petugas Arsip</font>
			</td>
		</tr>
		<tr>
			<td height="50px"  colspan="3"></td>
		</tr>
		<tr>
			<td width="240px" align="center" valign="middle">
				<font size="11"><b>( <?php echo orminus(strtoupper($p->nama_peminjam)) ?> )</b></font>
			</td>
			<td   align="right" width="175px">
				
			</td>
			<td width="240px" align="center" valign="middle">
				<font size="11"><b>( <?php echo orminus(strtoupper($p->nama_petugas))?> )</b></font>
			</td>
		</tr>
		
		</tr>
		<tr>
			<td height="230px"  colspan="3"></td>
		</tr>
		<tr id="footer">
			<td valign="top" colspan="3">
				<hr width="20cm"/>
				<table border="0" width="20.5cm" cellpadding="3" colspacing="3">
					<tr>
						<td valign="middle" align="center" width="1px"><b><i><?php echo ''?></i></b></td>
						<td align="left" width="13cm"><i>SISTEM INFORMASI ARSIP KOTA TANGERANG</i></td>
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
