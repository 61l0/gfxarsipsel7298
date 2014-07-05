	<table border=0 class="table-flat" width='100%'>

		<tr>
			<td>Kode Klasifikasi</td>
			<td>:</td>
			<td><?= @$lihat_data[0]->kode_masalah .' - '.@$lihat_data[0]->nama_masalah ?></td>
			<td colspan=9></td>
			</td>
		</tr>

	
		
		<tr>
			<td>Judul</td>
			<td>:</td>
			<td colspan=10><?=@$lihat_data[0]->judul ?></td>
		</tr>
		
		<tr>
			<td>Nomor Berkas</td>
			<td>:</td>
			<td colspan="10">
				<?php echo orminus( $lihat_data[0]->no_arsip) .'/'.orminus($lihat_data[0]->agenda).'.'.orminus($lihat_data[0]->kode_komponen).'/'.orminus($lihat_data[0]->tahun); ?>
			
			</td>
			
		</tr>

		<tr>
			<td>Tanggal Berkas</td>
			<td>:</td>
			<td colspan=10><?
				$stamp = strtotime(@$lihat_data[0]->tanggal);
				$tanggal_pinjam = date("d-m-Y", $stamp);
				echo @$tanggal_pinjam ?></td>
		</tr>	
		<?php if($lihat_data[0]->status == 'tinjau'):?>
		<tr>
			<td>Tanggal Dinilai Kembali</td>
			<td>:</td>
			<td colspan="10"><?
				$stamp = strtotime(@$lihat_data[0]->tgl_dinilai_kembali);
				$tanggal_pinjam = date("d-m-Y", $stamp);
				echo @$tanggal_pinjam ?></td>
		</tr>
		<tr>
			<td>Dinilai kembali sebanyak</td>
			<td>:</td>
			<td>
			<?=@$lihat_data[0]->jml_tinjauan ?> kali.
			</td>
			<td colspan=9></td>
		</tr>
		<?php endif?>
		<tr>
			<td>Instansi</td>
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
			<td valign="top">Penyimpanan</td>
			<td valign="top" >:</td>
			<td colspan=10>
				<table class="storage-box">
				<? foreach($tree as $rowtree){ ?>
					<tr>	
						
						<td><?= ucfirst(@$rowtree->type == 'folder'? 'sampul': $rowtree->type) ?></td><td>:</td><td><?=@$rowtree->name ?></td>
					</tr>
				<? } ?>
				</table>	
			</td>	
		</tr>


		<tr>
			<td>Retensi</td>
			<td>:</td>
			<td><?php echo "Aktif &nbsp;&nbsp;   :".($lihat_data[0]->rt_aktif?$lihat_data[0]->rt_aktif . ' tahun':' belum ditentukan').".  &nbsp;&nbsp;<br/>Inaktif &nbsp;&nbsp;:".($lihat_data[0]->rt_inaktif?$lihat_data[0]->rt_inaktif . ' tahun':' belum ditentukan').". &nbsp;&nbsp;"?>
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
				$origpath = BASE_URL.'assets/media/file/arsip_galery/'.@$lihat_data[0]->id_data.'/'.@$rowx->foto;
				$path 	= BASE_URL.'assets/media/file/arsip_galery/'.@$lihat_data[0]->id_data.'/_thumbs/thumbs_'.@$rowx->foto;
				$fcpath = FCPATH . 'assets/media/file/arsip_galery/'.@$lihat_data[0]->id_data.'/_thumbs/thumbs_'.@$rowx->foto;
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
		<td colspan="10" style="padding:7px 25.8em 14px 4px;text-align:center;"><input type='button' class="bt-blue-common" id="aaa" onclick="<?=$class_name;?>grid.extra.cetak_pdf({id:'<?=@$lihat_data[0]->id_data ?>',id_lokasi_simpan:<?=@$lihat_data[0]->id_lokasisimpan ?>});" value='CETAK'></td>
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