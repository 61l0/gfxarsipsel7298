 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_footer" name="id_footer" value="<?=@$id_footer?>">
	 <div id="notification-footer" class="notification-error" style="background:#CC6600"></div>
	<table class="table-flat" width="100%">
		<tr>
			<td>Link</td>
			<td>: <input type="text" name="footer_link" id="footer_link" value="<?=@$data->footer_link?>" size="30"></td>
		</tr>
		<tr>
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
			<td>Gambar</td>
			<td> 
				: <div id="footer-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-image"></span><span>Upload Gambar</span>
				  </div><br>
				  <span id="image_view">
<? 
				$path = DOC_PATH_ROOT . 'assets/media/file/footer/'.@$data->footer_image;
				$image_thumb = '';
				if(is_file($path)): 
					$path = BASE_URL.'assets/media/file/footer/'.@$data->footer_image;
					
					$image_thumb .= '<span id="image_'.@$id_footer.'"><img src="'.$path.'" width="900">';
					$image_thumb .= '<a onclick="'.$class_name.'grid.extra.remove_image({id_footer:'.@$id_footer.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_footer.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
				endif;
?>
				<?=@$image_thumb;?>
				  </span>
			</td>
		</tr>
		<tr>
			<td colspan="2">
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
			var btnUpload=$('#footer-uploader') , interval;
			var status=$('#notification-footer');	
			new AjaxUpload(btnUpload, {
				action: '<?=site_url($com_url);?>/saveupload',
				name: 'footer_file',
				data: {id_footer:<?=@$id_footer;?>},
				onSubmit: function(file, ext){
					 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
						// extension is not allowed 
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
						jQuery('#id_footer').val(arr_result[2]);
						jQuery('#oper').val('edit');
						status.removeClass('msg-box-false');
						status.addClass('msg-box-true');
						$('#image_view').html('');
						$('#image_view').text('');
						file = file.replace(/%20/g, "");
						status.html('<ul><li><font color="yellow">' + file  + ', success di upload !' + '</font></li></ul>' ).addClass('notification-ok');
						$('#image_view').append('<span class="image-list"><img src="<?=BASE_URL.'assets/media/file/footer/'?>' + file + '"  width="200" ><br /><a onclick="<?=$class_name?>grid.extra.remove_image({id_footer:<?=@$id_footer?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_footer?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
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
