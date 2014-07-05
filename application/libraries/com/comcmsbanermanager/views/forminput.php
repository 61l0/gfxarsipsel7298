 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_banner" name="id_banner" value="<?=@$id_banner?>">
	 <div id="notification-banner" class="notification-error" style="background:#CC6600"></div>
	<table class="table-flat" width="100%" height="100%">
		<tr>
			<td>Nama Banner</td>
			<td colspan="3">: <input type="text" name="banner_judul" id="banner_judul" value="<?=@$data->banner_judul?>" size="30"></td>
		</tr>
		<tr>
			<td>Gambar</td>
			<td colspan="3">
				: <div id="banner-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-image"></span><span>Upload Gambar</span>
				  </div><br>
				  <span id="image_view">
<? 
				$path = PATH_BASE.'arsip/assets/media/file/banner/'.@$data->banner_image;
				$image_thumb = '';
				if(is_file($path)): 
					$path = BASE_URL.'assets/media/file/banner/'.@$data->banner_image;
					
					$image_thumb .= '<span id="image_'.@$id_banner.'"><img src="'.$path.'" width="200"><br>';
					$image_thumb .= '<br /><br /><br /><br /><br /><br /><a onclick="'.$class_name.'grid.extra.remove_image({id_banner:'.@$id_banner.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_banner.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
				endif;
?>
				<?=@$image_thumb;?>
				  </span>
			</td>
		</tr>
		<tr>
			<td>Link</td>
			<td colspan="3">: <input type="text" name="link" id="banner_judul" value="<?=@$data->banner_judul?>" size="30"></td>
		</tr>
		<tr>
			<td>Kanal</td>
			<td>: <?=form_dropdown('id_kanal',@$arrkanal['options'],@$idkanal['default'],' id="id_kanal"');?></td>
			<td>Flash Height</td>
			<td>: <input type="text" name="height" id="height" value="<?=@$data->height?>" size="5"></td>
		</tr>
		<tr>
			<td>Urutan</td>
			<td>: <input type="text" name="urutan" id="urutan" value="<?=@$data->urutan?>" size="5"></td>
			<td>Status</td>
			<td>: <select name="status" id="status">
					<? if(@$data->status=='on'){?>
					<option value="on" selected>On</option>
					<option value="off">Off</option>
					<? } else { ?>
					<option value="off" selected>Off</option>
					<option value="on">On</option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<!--<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.btn_simpan();" value="Simpan" id="simpan_perhatian_lap">-->
				<input type="submit" class="bt-blue-common" value="Simpan" id="simpan">
				<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.btn_close_dialog()" value="Batal">
			</td>
		</tr>
	</table>
</form>
		
<script language="javascript">	 
	jQuery(document).ready(function() {
		
		<?=$class_name;?>grid.extra.btn_simpan();
		 
		jQuery(function(){	
			var btnUpload=$('#banner-uploader') , interval;
			var status=$('#notification-banner');	
			var id_kanal = $("#id_kanal").val();
			new AjaxUpload(btnUpload, {
				action: '<?=site_url($com_url);?>/saveupload',
				name: 'banner_file',
				data: {id_banner:<?=@$id_banner;?>,id_kanal:id_kanal},
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
						///////// extension is not allowed 
						status.text('Hanya File dengan ext JPG, PNG or GIF yang dapat diupload !');
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
					//On completion clear the status
					btnUpload.text('Upload Gambar');
					status.html('');
					window.clearInterval(interval);
					status.text('');
					var arr_result = response.split("#");
					//Add uploaded file to list
					if(arr_result[0]=="success"){
						jQuery('#id_banner').val(arr_result[2]);
						jQuery('#oper').val('edit');
						status.removeClass('msg-box-false');
						status.addClass('msg-box-true');
						$('#image_view').html('');
						$('#image_view').text('');
						file = file.replace(/%20/g, "");
						status.html('<ul><li><font color="yellow">' + file  + ', success di upload !' + '</font></li></ul>' ).addClass('notification-ok');
						$('#image_view').append('<span class="image-list"><img src="<?=BASE_URL.'assets/media/file/banner/'?>' + file + '"  width="200" ><br /><a onclick="<?=$class_name?>grid.extra.remove_image({id_banner:<?=@$id_banner?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_banner?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
					} else{
						status.removeClass('msg-box-true');
						status.addClass('msg-box-false');
						status.html('<ul><li><font color="yellow">' + file  + ', gagal di upload ! <br />' + arr_result[1] + '</font></li></ul>').addClass('notification-error');					
					}
		
				}
			});
			
		});
	
	});  
	
</script>
