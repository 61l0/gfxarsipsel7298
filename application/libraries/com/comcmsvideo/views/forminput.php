 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_video" name="id_video" value="<?=@$id_video?>">
	<input type="hidden" id="id_kategori" name="id_kategori" value="<?=@$id_kategori?>">
	 <div id="notification" class="notification-error" style="background:#CC6600"></div>
	<table class="table-flat" width="100%">
		<tr>
			<td>Judul Video</td>
			<td colspan="2">: <input type="text" name="judul_video" id="judul_video" value="<?=@$data->judul_video?>" size="40">
			</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>: <input type="text" name="tanggal" id="tanggal" value="<?=@$data->tanggal?>"></td>
			<td>Urutan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <input type="text" size="5" name="urutan" id="urutan" value="<?=@$data->urutan;?>"></td>
		</tr>
		<tr>
			<td>Sumber</td>
			<td>: <input type="text" name="sumber" id="sumber" value="<?=@$data->sumber?>"></td>
			<td>Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 
				<select name="status" id="status">
					<? if(@$data->status=='publish'){?>
					<option value="publish" selected>Publish</option>
					<option value="pending">Pending</option>
					<? } else { ?>
					<option value="pending" selected>Pending</option>
					<option value="publish">Publish</option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Upload</td>
			<td>
				: <div id="video-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-video"></span><span>Upload Video</span>
				  </div>
			</td>
			<td>
<? 
				// $path = DOC_PATH_ROOT . 'assets/media/file/galeri_video/'.@$data->video_file;
				// $image_thumb = '';
				// if(is_file($path)): 
					// $path = BASE_URL.'assets/media/file/galeri_video/'.@$data->video_file;
					
					// $image_thumb .= '<br><span id="video_'.@$id_video.'"><img src="'.$path.'" width="200"><br>';
					// $image_thumb .= '<br /><br /><br /><br /><br /><br /><a onclick="'.$class_name.'grid.extra.remove_upload({id_video:'.@$id_video.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_video.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
				// endif;
?>
				<?//=@$image_thumb;?>
				  <div id="image-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-image"></span><span>Upload Gambar</span>
				  </div>
				  <span id="image_view">
<? 
				$path = DOC_PATH_ROOT . 'assets/media/file/galeri_video/foto/'.@$data->video_image;
				$image_thumb = '';
				if(is_file($path)): 
					$path = BASE_URL.'assets/media/file/galeri_video/foto/'.@$data->video_image;
					
					$image_thumb .= '<br><span id="image_'.@$id_video.'"><img src="'.$path.'" width="200"><br>';
					$image_thumb .= '<br /><br /><br /><br /><br /><br /><a onclick="'.$class_name.'grid.extra.remove_upload({id_video:'.@$id_video.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_video.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
				endif;
?>
				<?=@$image_thumb;?>
				  </span>
			</td>
		</tr>

		<tr>
			<td>Keterangan</td>
			<td colspan="2"><textarea name="keterangan" id="keterangan" rows="11" cols="90" ><?=@$data->keterangan?></textarea></td>
		</tr>
		<tr>
			<td colspan="3">
				<!--<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.btn_simpan();" value="Simpan" id="simpan_perhatian_lap">-->
				<input type="submit" class="bt-blue-common" value="Simpan" id="simpan">
				<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.btn_close_dialog()" value="Batal">
			</td>
		</tr>
	</table>
</form>
		
<script language="javascript">	  
	jQuery(document).ready(function() {
		tinyMCE.init({
			mode : "exact", 
			theme : "advanced", 
			theme_advanced_toolbar_location : "top", 
			elements : 'keterangan'
		}); 
		<?=$class_name;?>grid.extra.btn_simpan();
		jQuery("#tanggal").datepicker({
			changeMonth: true
			,changeYear: true
			,buttonImage: '<?=BASE_URL;?>arsip/assets/image/icons/calendar.gif' 
			,buttonImageOnly: true
			,dateFormat: 'yy-mm-dd'
		});  
 		// jQuery(function(){	
		// }); 
		jQuery("#video-uploader").click(function () { 	

				// var btnUploadImage=$('#image-uploader') , interval; 
				var btnUpload=$('#video-uploader') , interval;
				var status=$('#notification');	
				var id_kategori = $("#id_kategori").val();
				new AjaxUpload(btnUpload, {
					action: '<?=site_url('cms/com/cmsvideo/saveupload');?>',
					name: 'video_file',
					data: {id_video:<?=@$id_video;?>,id_kategori:id_kategori,type:'video'},
					onSubmit: function(file, ext){
						 if (! (ext && /^(flv|FLV|mp4)$/.test(ext))){ 
							/////////extension is not allowed 
							status.text('Hanya File dengan ext flv atau mp4 yang dapat diupload !');
							return false;
						}
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
						/////////On completion clear the status
						btnUpload.text('Upload Gambar');
						status.html('');
						window.clearInterval(interval);
						status.text('');
						var arr_result = response.split("#");
						
					if(arr_result[0]==="success"){
						status.removeClass('notification-error');
						status.html("<font color='yellow'> "+file  + ", success di upload !</font>" ).addClass('notification-ok');
					} else{
						status.html("<font color='yellow'> "+file  + ", gagal di upload ! </font><br />" + response ).addClass('notification-error');					
					}
			
					}
				}); //==========end script upload video=================
				////////==============start script upload foto================
			// alert('aaa'); 
		});
		jQuery("#image-uploader").click(function () { 	 
				var btnUploadImage=$('#image-uploader') , interval; 
				// var btnUpload=$('#video-uploader') , interval;
				var status=$('#notification');	
				var id_kategori = $("#id_kategori").val();
				new AjaxUpload(btnUploadImage, {
					action: '<?=site_url('cms/com/cmsvideo/saveupload');?>',
					name: 'video_image',
					data: {id_video:<?=@$id_video?>,id_kategori:id_kategori,type:'foto'},
					onSubmit: function(file, ext){
						 if (! (ext && /^(jpg|png|jpeg|gif|bmp)$/.test(ext))){ 
							status.text('Hanya File dengan ext JPG,PNG,GIF,BMP yang dapat diupload !');
							return false;
						}
						status.text('Uploading').addClass('notification-ok'); 
						interval = window.setInterval(function(){
							var text = status.text();
							if (text.length < 19){
								status.text(text + '.');					
							} else {
								status.text('Uploading');				
							}
						}, 200);
					},
					onComplete: function(file, response){
						/////////alert(response);
						window.clearInterval(interval);
						status.html('');
						status.text(''); 
						var arr_result = response.split("#");
						/////////===Add uploaded file to list===
						if(arr_result[0]=="success"){
							jQuery('#id_video').val(arr_result[2]);
							jQuery('#oper').val('edit');
							status.removeClass('msg-box-false');
							status.addClass('msg-box-true');
							$('#image_view').html('');
							$('#image_view').text('');
							file = file.replace(/%20/g, "");
							status.html('<ul><li><font color="yellow">' + file  + ', success di upload !</font>' + '</li></ul>' ).addClass('notification-ok');
							$('#image_view').append('<br><span class="image-list"><img src="<?=BASE_URL.'assets/media/file/galeri_video/foto/'?>' + file + '"  width="200" ><br /><br /><br /><br /><br /><br /><br /><a onclick="<?=$class_name?>grid.extra.remove_upload({id_video:<?=@$id_video?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_video?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
						} else{
							status.removeClass('msg-box-true');
							status.addClass('msg-box-false');
							status.html('<ul><li>' + file  + ', gagal di upload ! <br />' + arr_result[1] + '</li></ul>').addClass('notification-error');					
						} 
					}
				});//===============end image upload script
				 
			// alert('aaa');
		});
	
	});  
	</script>
	