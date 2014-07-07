 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_template" name="id_template" value="<?=@$id_template?>">
	 <div id="notification-template" class="notification-error"  style="background:#CC6600"></div>
	<table class="table-flat" width="100%" height="100%">
		<tr>
			<td>Nama Template</td>
			<td>: <input type="text" name="template_name" id="template_name" value="<?=@$data->template_name?>" size="30"></td>
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
			<td>File</td>
			<td>
				: <div id="template-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-image"></span><span>Upload File</span>
				  </div>
				  <span id="file_view">
<? 
				$path = DOC_PATH_ROOT . 'assets/media/file/template/'.@$data->template_zip;
				$image_thumb = '';
				if(is_file($path)): 
					$path = BASE_URL.'assets/media/file/template/'.@$data->template_zip;
					
					$image_thumb .= '<span id="file_'.@$id_template.'"> '.@$data->template_zip;
					$image_thumb .= ' <a onclick="'.$class_name.'grid.extra.remove_file({id_template:'.@$id_template.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_template.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
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
			var btnUpload=$('#template-uploader') , interval;
			var status=$('#notification-template');	
			new AjaxUpload(btnUpload, {
				action: '<?=site_url($com_url);?>/saveupload',
				name: 'template_file',
				data: {id_template:<?=@$id_template;?>},
	 			onSubmit: function(file, ext){
					if (! (ext && /^(pdf|zip|rar|doc|xls|docx)$/.test(ext))){ 
						// extension is not allowed  
						status.text('Hanya File dengan ext PDF,ZIP,RAR.DOC, dan XLS yang dapat diupload !');
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
					btnUpload.text('Upload File');
					status.html('');
					window.clearInterval(interval);
					status.text('');
					var arr_result = response.split("#");
					//Add uploaded file to list
					if(arr_result[0]=="success"){
						jQuery('#id_template').val(arr_result[2]);
						jQuery('#oper').val('edit');
						status.removeClass('msg-box-false');
						status.addClass('msg-box-true');
						file = file.replace(/%20/g, "");
						status.html('<ul><li><font color="yellow">' + file  + ', success di upload !' + '</fornt></li></ul>' ).addClass('notification-ok');
						$('#file_view').append('<span class="image-list"> '+file+' <a onclick="<?=$class_name?>grid.extra.remove_file({id_template:<?=@$id_template?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_template?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
					} else{
						status.removeClass('msg-box-true');
						status.addClass('msg-box-false');
						status.html('<ul><li>' + file  + ', gagal di upload ! <br />' + arr_result[1] + '</li></ul>').addClass('notification-error');					
					}
		
				}
			});
			
		});
	
	});  
	
</script>
