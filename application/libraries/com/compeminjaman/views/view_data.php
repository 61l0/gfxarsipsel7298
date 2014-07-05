
	<table border=0 class="table-flat" width="100%">
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				<?=ucfirst(@$data[0]->status)?>
			</td>
			
		</tr>
		<tr>
			<td>Judul Arsip</td>
			<td>:</td>
			<td><?=@$data[0]->judul?></td>
		</tr>

		<tr>
		
			<td>Nama Klient</td><td>:</td><td><?=$data[0]->nama_peminjam?></td>
		</tr>
		<tr>
		
			<td>Tipe Klient</td><td>:</td><td><?=ucfirst($data[0]->type_client)?></td>
		</tr>
		<? if($data[0]->type_client == 'instansi'){?>
		<tr>	
		
			<td>Instansi/Skpd</td><td>:</td><td>
			
			<?=$data[0]->id_skpd?>
			</td>
		</tr>
		<? }else{?>
		<tr>
			<td>Alamat Klient</td><td>:</td><td><?=$data[0]->alamat?></td>
		</tr>
		<tr>
			<td>Bukti Verifikasi</td><td>:</td><td><?=$data[0]->bukti_verifikasi?></td>
		</tr>	
		<tr>
			<td>Keperluan</td><td>:</td><td><?=$data[0]->keperluan?></td>
		</tr>		
		<? } ?>		
			<td>Nama Pemberi Kuasa</td><td>:</td><td><?=$data[0]->nama_pemberi_kuasa?></td>			
		</tr>	
		</tr>
			
			<td>No Identitas Pemberi Kuasa</td><td>:</td><td><?=$data[0]->no_identitas_pemberi_kuasa?></td>			
		</tr>	
		</tr>
			
			<td>Tanggal Pinjam</td><td>:</td><td><?=preg_replace('/^0/','',tgl_indo($data[0]->tanggal_pinjam));?></td>			
		</tr>	
		</tr>
			
			<td>Copy/Asli</td><td>:</td>
			<td>
			<?=ucfirst($data[0]->type_arsip)?>
			</td>			
		</tr>	
		</tr>
			
			<td>Jumlah Arsip</td><td>:</td><td><?=$data[0]->jumlah_arsip?></td>			
		</tr>	
		</tr>
			
			<td>No Surat Permohonan</td><td>:</td><td><?=$data[0]->no_surat?></td>			
		</tr>	
		</tr>
			
			<td>Status Hasil</td><td>:</td><td>
				<?= ucfirst($data[0]->status_hasil)?>
			</td>			
		</tr>	
		</tr>
			
			<td>Tanggal Kembali</td><td>:</td><td>
 <?=preg_replace('/^0/','',tgl_indo($data[0]->tanggal_kembali));?> </td>			
		</tr>	
		</tr>
			
			<td>Nama Petugas</td><td>:</td><td><?=ucfirst($data[0]->nama_petugas)?></td>			
		</tr>	
		<tr >
			<td valign="top">Gambar</td>
			<td valign="top">:</td>
			<td colspan=10 valign="top">
				<form id='form-b'>
			<div class="arsip-image-list">

			<?php if(count($image) > 0): ?>	
			<div class="tb1">
				<input id="ck_toggle_all" type="checkbox" onchange="toggle_select_all_gbr();"/> <label>Pilih Semua</label>	
				<br/>
			</div>
			<?php foreach($image as $rowx): ?>
			<?php 
				$origpath = BASE_URL.'assets/media/file/arsip_galery/'.@$data[0]->id_data.'/'.@$rowx->foto;
				$path 	= BASE_URL.'assets/media/file/arsip_galery/'.@$data[0]->id_data.'/_thumbs/thumbs_'.@$rowx->foto;
				$fcpath = FCPATH . 'assets/media/file/arsip_galery/'.@$data[0]->id_data.'/_thumbs/thumbs_'.@$rowx->foto;
				if( !file_exists($fcpath) )
				{
					$path = BASE_URL.'assets/css/metro/images/image-404.jpg';
				}
			?>
				<div class="pick-img">
					<div class="tb">
						<input type="checkbox" name="ctk_<?php echo $rowx->id_galer?>" value="<?php echo $rowx->id_galery?>">
					</div>	
					<div class="ic" style="background:transparent url(<?php echo $path?>) center center;cursor:pointer" onclick="preview_img(this,'<?php echo $origpath?>')">
<!-- 						<img src="<?php echo $path?>">	 -->
					</div>		
				</div>
				

			<?php endforeach;?>
			<?php else :?>
			<div class="non-existent-image">Arsip ini tidak memiliki gambar.</div>

			<?php endif?>
			<div class="cb"></div>
			</div>
			</form>
			
			</td>
		</tr>		
		<tr>

		<td><input type='button' class="bt-blue-common" id="aaa" onclick="<?=$class_name;?>grid.extra.cetak_pdf({id:'<?=@$data[0]->id_data ?>',id_lokasi_simpan:<?=@$data[0]->id_lokasisimpan ?>,idp:<?php echo $data[0]->id_peminjaman ?>});" value='CETAK'></td>
		</tr>				

	</table>
<script type="text/javascript">
function toggle_select_all_gbr()
{
	var checked = $('#ck_toggle_all').is(':checked');
	$('.arsip-image-list > .pick-img > .tb > input[type=checkbox]').prop('checked',checked);
	//console.log(checked)
}
function preview_img (el,url) {
	$('div.img-previewer-ok').remove();
	var dlg = $('<div></div>').addClass('img-previewer-ok').css('width','400px');
	var img = $('<img/>').attr('src',url);//.css('width','80%');
	var loading = $('<img/>').attr('src','<?php echo BASE_URL ?>assets/image/loading.gif').addClass('loading-b');
	
	img.load(function  () {
		$('.loading-b').remove();
		console.log('image loaded');
		if($(this).width() >= 800)
		{
			$(this).css('width','800px');	
		}
		//dlg.css({'margin':'0 auto'});
	})
	dlg.append(loading);
	dlg.append(img);
	$('body').append(dlg);
	$(dlg).dialog({ 
		 	//dialogClass: 'noTitleStuff',
		 	center: true, 
	        modal: true, 
	        width: 'auto',
	        height: 'auto',
		 }); 
}
</script>