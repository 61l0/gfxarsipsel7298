
	<table border=0 class="table-flat" width=500>
		<tr>
			<td>Pengirim</td>
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
		</tr>
			<td>File</td><td>:</td><td><a target="_blank" href="admin/com/proxyurl/load/attachments/<?php echo base64_encode($data[0]->path)?>"><?= @$data[0]->filename?></a></td>			
		</tr>		

	</table>




	

