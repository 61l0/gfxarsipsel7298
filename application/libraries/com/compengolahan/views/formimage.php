<script type="text/javascript">  
jQuery(document).ready(function() { 
	 
	jQuery(function(){	
		var btnUpload=$('#galeri-uploader');
		var interval;
		var status=$('#statusuploadgaleri');
		new AjaxUpload(btnUpload, {
			action: '<?=site_url('admin/com/pengolahan/saveupload');?>',
			name: 'img_file',
			data: {id_data:<?=$id_data;?>},
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Hanya File dengan ext JPG, PNG or GIF yang dapat diupload !');
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
					status.html(file  + ", success di upload !" ).addClass('notification-ok');
					
				} else{
					status.html(file  + ", gagal di uploadxx ! <br />" + arr_result[1] ).addClass('notification-error');					
				}
				loadFormImageEditingGaleri();
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
				status.html('<ul><li>Data telah disimpan</li></ul>');
			}else{
				status.html('');
				status.removeClass('msg-box-true');
				status.addClass('msg-box-false');
				status.html(data);
			}
		});
		return false;
    });

	function loadFormImageEditingGaleri(){
		loadFragment('#table_form','<?=site_url('admin/com/pengolahan/formeditingimage');?>',{id_data:<?=@$id_data;?>});
	} 
	
});
	function Remove_Image(id){
		jQuery.post('<?=site_url('admin/com/pengolahan/removeimage');?>', {id_galery: id},function(data){
			var status= $('#notif-imggaleri');
			if(data=='sukses'){
				status.html('');
				status.removeClass('msg-box-false');
				status.addClass('msg-box-true');
				status.html('<ul><li>Gambar telah di hapus</li></ul>');
				$('#image_' + id ).html(''); 
				loadFragment('#table_form','<?=site_url('admin/com/pengolahan/formeditingimage');?>',{id_data:<?=@$id_data;?>});
			}else{
				status.html('');
				status.removeClass('msg-box-true');
				status.addClass('msg-box-false');
				status.html(data);
			}
			
		});
		return false;
	}
</script>
<?//=@$com_url?>
<div  style="background-color:#FFFFFF">
<div id="imggaleri_area" >
<div id="notif-imggaleri"></div>
   <div class="cclear"></div>
  <table width="100%" cellspacing="1" cellpadding="5" class="table-form">
  <tr><th colspan="2">Upload Gambar</th></tr>
    <tr><td colspan="2"><div id="statusuploadgaleri"></div></td></tr>
    <tr>
      <td colspan="2">
			<div id="form">
			<button id="galeri-uploader" class="fm-button-icon-left">
				<i class="ui-icon ui-icon-image"></i><span>Upload Gambar</span> 
				
			</button>
          <span>Click tombol disamping untuk mengupload gambar-gambar terkait dengan komoditi, anda dapat mengupload lebih dari satu file.</span>
			</div>
			<form id="imgeditingGaleri-form" method="post" action="<?=site_url('admin/com/pengolahan');?>/saveimagedata" enctype="multipart/form-data">
			<input type="hidden" name="id_data" id="id_data" value="<?=@$id_data;?>"  />
			  <table width="100%" cellspacing="1" cellpadding="5" class="table-form" id="table_form">
			  <tr><th colspan="2">Edit Data Gambar</th></tr>
			  <tr><td colspan="2"><input type="submit" name="save_data" value="Simpan Perubahan" />&nbsp;
				 <input type="button" value="Keluar" name="cancel" onclick="$('#dialogArea1').dialog('close');" /></td></tr>
			   <? foreach($data as $rowx){
					$path = DOC_PATH_ROOT . 'assets/media/file/arsip_galery/'.@$rowx->id_data.'/'.@$rowx->foto;
					//echo $path;
					$image_thumb = '';
					if(1): 
						$path = BASE_URL.'assets/media/file/arsip_galery/'.@$rowx->id_data.'/'.@$rowx->foto;
						
						$image_thumb .= '<span id="image_'.@$rowx->id_galery.'"><img src="'.(is_file($path)?$path:'assets/image/no_image_preview.jpg').'" width="300">';
						$image_thumb .= '<br /><a onclick="Remove_Image('.@$rowx->id_galery.');" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
					endif;
					
					if(@$rowx->status == 'on'){
						$slc_s = 'selected="selected"';
						$slc_h = '';
					}else{
						$slc_s = '';
						$slc_h = 'selected="selected"';
					}
					?>
					<tr id="tr_<?=@$rowx->id_galery?>"><td width="25%" style="border-bottom:1px solid #C0D6ED"><?=@$image_thumb?></td>
						<td valign="top" style="border-bottom:1px solid #C0D6ED">
						<input type="hidden" name="id_galery" value="<?=@$rowx->id_galery?>"  />
						Judul Foto <input type="text" name="judul_foto_<?=@$rowx->id_galery?>" id="judul_foto_<?=@$rowx->id_galery?>" size="30" value="<?=@$rowx->judul?>" /><br />
						Keterangan Gambar : <br />
						<textarea name="image_note_<?=@$rowx->id_galery?>" id="image_note_<?=@$rowx->id_galery?>" rows="3" cols="40"><?=@$rowx->keterangan?></textarea><br />	
					
						
						Tanggal <input type="text" size="10" name="tanggal_<?=@$rowx->id_galery?>" id="tanggal_<?=@$rowx->id_galery?>" value="<?=@$rowx->tgl_buat?>" class="dpicker-galerifoto" readonly="readonly" />
						</td>
					</tr>
				<?
					}
				?>
			  </table>
			</form>
        </td>
    </tr>
    <tr><td colspan="2"><div id="form_editingimagegaleri"></div></td></tr>
    </table>
</div>
</div>

<style type="text/css">
	#form > span {
		float: right;
		margin: -2px 7px 6px 10px;
		width:78%;
	}
</style>