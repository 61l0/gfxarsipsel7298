
	<table border=0 class="table-flat" align='center' width='100%'>

		
		<!-- <tr>
			<td>Berita Acara</td>
			<td>:</td>
			<td>
			<?=@$data[0]->file?>
			</td>
		</tr> -->

		<tr>
			<td width="89px">Tanggal</td>
			<td width="3px">:</td>
			<td ><?=date('d-m-Y',strtotime($data[0]->tanggal_ba))?></td>
		</tr>
	<!-- 	<tr>
			<td>Agenda</td>
			<td>:</td>
			<td><?=@$data[0]->agenda?></td>
		</tr>
		<tr>
			<td>Kode Komponen</td>
			<td>:</td>
			<td><?=@$data[0]->komponen?></td>
		</tr>
		<tr>
			<td>Tahun  </td><td>: </td><td>
			<?=@$data[0]->tahun?>
			</td>
		</tr>
		
		<tr>
			<td>Nomor</td>
			<td>:</td>
			<td><?=@$data[0]->nomor_ba?></td>
		</tr> -->
		
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td>
				<?php echo orminus( $data[0]->nomor_ba) .'/'.orminus($data[0]->agenda).'.'.orminus($data[0]->komponen).'/'.orminus($data[0]->tahun); ?>
			
			</td>
			
		</tr>
		
		<tr>
			<td>Disertai Pertelaan</td>
			<td>:</td>
			<td>
				<?=@$data[0]->disertai_pertelaan == 'ada' ? 'Ya' : 'Tidak'?>
			</td>
		</tr>	

		<tr>
			<td>Dari</td>
			<td>:</td>
			<td>
				
					<?=@$data[0]->instansi?>	
			
			</td>
		</tr>		
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td><?=@$data[0]->kepada?></td>
		</tr>		
	</table>


	
