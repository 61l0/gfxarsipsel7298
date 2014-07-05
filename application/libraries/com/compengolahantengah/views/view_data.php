	<table border=0 class="table-flat" width='100%'>

		<tr>
			<td>Nama Klasifikasi</td>
			<td>:</td>
			<td><?=@$lihat_data[0]->nama_masalah ?></td>
			<td colspan=9></td>
			</td>
		</tr>

	
		
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><?=@$lihat_data[0]->judul ?></td>
		</tr>
		
		<tr>
			<td>Nomor Arsip</td>
			<td>:</td>
			<td><?=@$lihat_data[0]->no_arsip ?></td>
			<td>Agenda  </td><td>: </td><td><?=@$lihat_data[0]->agenda ?></td>
			<td width=100>Kode Komponen  </td><td>: </td><td><?=@$lihat_data[0]->kode_komponen?></td>
			<td>Tahun  </td><td>: </td><td><?=@$lihat_data[0]->tahun ?>
			</td>
		</tr>

		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td colspan=10><?
				$stamp = strtotime(@$lihat_data[0]->tgl_input);
				$tanggal_pinjam = date("d-m-Y", $stamp);
				echo @$tanggal_pinjam ?></td>
		</tr>	

		<tr>
			<td>Unit Pengolah</td>
			<td>:</td>
			<td>
			<?=@$lihat_data[0]->nama_lengkap ?>
			</td>
			<td colspan=9></td>
		</tr>

		<tr>
			<td>Lokasi</td>
			<td>:</td>
			<td colspan=10><?=@$lihat_data[0]->lokasi ?></td>
		</tr>

		<tr>
			<td>Keterangan</td>
			<td>:</td>
			<td colspan=10><?=@$lihat_data[0]->desc?></td>
		</tr>	

	
		

		<tr id='tr_rak'>
			<td></td>
			<td></td>
			<td colspan=10>
				<table>
				<? foreach($tree as $rowtree){ ?>
					<tr>	
						<td></td>
						<td></td>
						<td><?=@$rowtree->type ?></td><td>:</td><td><?=@$rowtree->name ?></td>
					</tr>
				<? } ?>
				</table>	
			</td>	
		</tr>


		<tr>
			<td>Retensi</td>
			<td>:</td>
			<td>
				<?=@$lihat_data[0]->nama_retensi?>
			</td>
			<td colspan=9></td>
		</tr>
		
		<tr>
			<td>Jenis Arsip</td>
			<td>:</td>
			<td colspan=10>
			<?=@$lihat_data[0]->nama_jenis?>
			</td>
		</tr>	

		<tr>
			<td>Sifat Arsip</td>
			<td>:</td>
			<td colspan=10>
			<?=@$lihat_data[0]->nama_sifat?>
			</td>
		</tr>	
		<tr>
			<td>Image</td>
			<td>:</td>
			<td colspan=10>
				<form id='form-b'>
			 <? foreach($image as $rowx){
				 echo "<input type='checkbox' name='ctk_$rowx->id_galery' id='ctk_$rowx->id_galery' value='$rowx->id_galery'>";
					$path = BASE_URL.'assets/media/file/arsip_galery/'.@$lihat_data[0]->id_data.'/_thumbs/thumbs_'.@$rowx->foto;
					
					
				echo '<img src='.$path.' width=200></img>';				
				}
				
			?>
			</form>
			
			</td>
		</tr>	
		<tr>
		<td><input type='button' class="bt-blue-common" id="aaa" onclick="<?=$class_name;?>grid.extra.cetak_pdf({id:'<?=@$lihat_data[0]->id_data ?>',id_lokasi_simpan:<?=@$lihat_data[0]->id_lokasisimpan ?>});" value='CETAK'></td>
		</tr>		
	</table>
	
