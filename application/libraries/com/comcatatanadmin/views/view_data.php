
	<table border=0 class="table-flat" width=500>
		<tr>
			<td>pengirim</td>
			<td>:</td>
			<td>
			<?=@$data[0]->nama_pengirim?>
			</td>	
		</tr>
		
		<tr>
			<td>SKPD</td>
			<td>:</td>
			<td>
			<? if($data[0]->type =='personal'){echo @$data[0]->nama_penerima; }else{ echo 'ALL';}?>
			</td>	
		</tr>

		<tr>
			<td>Judul</td><td>:</td><td><?=@$data[0]->judul?></td>
		</tr>
			<td>Uraian</td><td>:</td><td><?=@$data[0]->uraian?></td>			
		</tr>	
			

	</table>




	

