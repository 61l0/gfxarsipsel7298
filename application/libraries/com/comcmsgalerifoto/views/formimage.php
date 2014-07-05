<script type="text/javascript">  
jQuery(document).ready(function() { 
	 
	jQuery(function(){	
		var btnUpload=$('#galeri-uploader') , interval;
		var status=$('#notif-imggaleri');
		new AjaxUpload(btnUpload, {
			action: '<?=site_url('cms/com/cmsgalerifoto/saveupload');?>',
			name: 'img_file',
			data: {id_kategori:<?=$id_kategori;?>},
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('<font color="yellow">Hanya File dengan ext JPG, PNG or GIF yang dapat diupload !</font>');
					return false;
				}
				//status.text('Uploading...'); tambahan anim proses
				btnUpload.text('Uploading');
				interval = window.setInterval(function(){
					var text = btnUpload.text();
					if (text.length < 19){
						btnUpload.text(text + '.');					
					} else {
						btnUpload.text('Uploading');				
					}
				}, 200);
			},
			onComplete: function(file, response){
				//On completion clear the status
				btnUpload.text('Upload Gambar');
				status.html('');
				window.clearInterval(interval);
				status.text('');
				 var arr_result = response.split("-");
				//Add uploaded file to list
				if(arr_result[0]==="success"){
					status.removeClass('notification-error');
					file = file.replace(/%20/g, "");
					status.html("<font color='yellow'>"+file  + ", success di upload !</font>" ).addClass('notification-ok');
					
				} else{
					status.html("<font color='yellow'>"+file  + ", gagal di upload ! <br />" + arr_result[1] +"</font>").addClass('notification-error');					
				}
				<?=$class_name;?>grid.extra.loadFormImageEditingGaleri(<?=@$id_kategori;?>);
			}
		});
	
	});
	
	jQuery("#imgeditingGaleri-form").submit(function(){
		var status= $('#notif-imggaleri');
		var interval;
		jQuery.post($(this).attr('action'),$(this).serialize(),function(data){
			if(data=='sukses'){
				status.html('');
				status.removeClass('msg-box-false');
				status.addClass('msg-box-true');
				status.html('<font color="yellow">Data telah disimpan</font>');
			}else{
				status.html('');
				status.removeClass('msg-box-true');
				status.addClass('msg-box-false');
				status.html(data);
			}
		});
		return false;
    });

});
</script>

<div  style="background-color:#FFFFFF">
<div id="imggaleri_area" >
<div id="notif-imggaleri" style="background:#CC6600"></div>
   <div class="cclear"></div>
  <table width="100%" cellspacing="1" cellpadding="5" class="table-flat">
  <tr><th colspan="2">Upload Gambar </th></tr>
    <tr>
      <td colspan="2">
			<div id="form">
			<div id="galeri-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
				<span class="ui-icon ui-icon-image"></span><span>Upload Gambar</span> 
			</div>
          <span>Click tombol disamping untuk mengupload gambar terkait dengan kriteria, anda dapat mengupload lebih dari satu file.</span>
			</div>
			<form id="imgeditingGaleri-form" method="post" action="<?=site_url('cms/com/cmsgalerifoto');?>/saveimagedata" enctype="multipart/form-data">
			<input type="hidden" name="id_kategori" id="id_kategori" value="<?=@$id_kategori;?>"  />
			<? if($data){?>
			  <table width="100%" cellspacing="1" cellpadding="5" class="table-flat" id="table_form">
			  <tr><th colspan="2">Edit Data Gambar</th></tr>
			  <tr><td colspan="2"><input type="submit" name="save_data" value="Simpan Perubahan" />&nbsp;
				 <input type="button" value="Keluar" name="cancel" onclick="$('#dialogArea1').dialog('close');" /></td></tr>
			   <? foreach($data as $rowx){
					$path = PATH_BASE.'arsip/assets/media/file/galeri_foto/'.@$rowx->id_kategori.'/'.@$rowx->foto;
					$image_thumb = '';
					if(is_file($path)): 
						$path = BASE_URL.'assets/media/file/galeri_foto/'.@$rowx->id_kategori.'/'.@$rowx->foto;
						$image_thumb .= '<span id="image_'.@$rowx->id_galeri.'"><img src="'.$path.'" width="300">';
						$image_thumb .= '<br /><a onclick="'.$class_name.'grid.extra.remove_image({id_galeri:'.@$rowx->id_galeri.',id_kategori:'.@$rowx->id_kategori.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$rowx->id_kategori.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
					endif;
					
					if(@$rowx->foto_publish == 'show'){
						$slc_s = 'selected="selected"';
						$slc_h = '';
					}else{
						$slc_s = '';
						$slc_h = 'selected="selected"';
					}
					?>
					<tr id="tr_<?=@$rowx->id_galeri?>"><td width="25%" style="border-bottom:1px solid #C0D6ED"><?=@$image_thumb?></td>
						<td valign="top" style="border-bottom:1px solid #C0D6ED">
						<input type="hidden" name="id_galeri" value="<?=@$rowx->id_galeri?>"  />
						Judul Foto <input type="text" name="judul_foto_<?=@$rowx->id_galeri?>" id="judul_foto_<?=@$rowx->id_galeri?>" size="30" value="<?=@$rowx->judul_foto?>" /><br />
						Keterangan Gambar : <br />
						<textarea name="image_note_<?=@$rowx->id_galeri?>" id="image_note_<?=@$rowx->id_galeri?>" rows="3" cols="40"><?=@$rowx->ket_foto?></textarea><br />	
						Sumber Foto <input type="text" name="from_<?=@$rowx->id_galeri?>" id="from_<?=@$rowx->id_galeri?>" size="5" value="<?=@$rowx->foto_from?>" /><br />
						Fotografer <input type="text" name="fotografer_<?=@$rowx->id_galeri?>" id="fotografer_<?=@$rowx->id_galeri?>" size="5" value="<?=@$rowx->fotografer?>" /><br />
						Urutan <input type="text" name="urutan_<?=@$rowx->id_galeri?>" id="urutan_<?=@$rowx->id_galeri?>" size="5" value="<?=@$rowx->foto_urutan?>" /><br />
						Status <select name="status_<?=@$rowx->id_galeri?>">
						<option value="show" <?=@$slc_s?>>Show</option>
						<option value="hide" <?=@$slc_h?>>Hide</option>
						</select>
						</td>
					</tr>
				<?
					}
				?>
			  </table>
			 <? } ?>
			</form>
        </td>
    </tr>
    <tr><td colspan="2"><div id="form_editingimagegaleri"></div></td></tr>
    </table>
</div>
</div>

