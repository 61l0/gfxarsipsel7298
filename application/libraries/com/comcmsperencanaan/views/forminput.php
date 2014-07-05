 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_perencanaan" name="id_perencanaan" value="<?=@$id_perencanaan?>">
	 <div id="notification-perencanaan" class="notification-error" style="background:#CC6600"></div>
	<table class="table-flat" width="100%" height="100%">
		<tr>
			<td>Judul</td>
			<td>
				: <input type="text" name="judul" id="judul" value="<?=@$data->judul?>" size="30">
				&nbsp;&nbsp;&nbsp; 
			</td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td> : 
				<input type="text" name="tanggal" id="tanggal" size="10" value="<?=@$data->tanggal?>">
				Status : 
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
			<td>File</td>
			<td>
				: <div id="perencanaan-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-image"></span><span>Upload File</span>
				  </div>
				  <span id="file_view">
<? 
				$path = PATH_BASE.'arsip/assets/media/file/perencanaan/'.@$data->file;
				$image_thumb = '';
				if(is_file($path)): 
					$path = BASE_URL.'assets/media/file/perencanaan/'.@$data->file;
					
					$image_thumb .= '<span id="file_'.@$id_perencanaan.'"> '.@$data->file;
					$image_thumb .= ' <a onclick="'.$class_name.'grid.extra.remove_file({id_perencanaan:'.@$id_perencanaan.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_perencanaan.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
				endif;
?>
				<?=@$image_thumb;?>
				  </span>
			</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>: <textarea name="keterangan" id="keterangan" cols="50" rows="4"><?=@$data->keterangan?></textarea></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" class="bt-blue-common" value="Simpan" id="simpan_perhatian_lap">
				<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.btn_close_dialog()" value="Batal">
			</td>
		</tr>
	</table>
</form>
		
<script language="javascript">	 
	jQuery(document).ready(function() {
		<?=$class_name;?>grid.extra.btn_simpan();
		jQuery("#tanggal").datepicker({
			changeMonth: true
			,changeYear: true
			,buttonImage: '<?=BASE_URL;?>arsip/assets/image/icons/calendar.gif' 
			,buttonImageOnly: true
			,dateFormat: 'yy-mm-dd'
		}); 
		jQuery(function(){	
			var btnUpload=$('#perencanaan-uploader') , interval;
			var status=$('#notification-perencanaan');	
			new AjaxUpload(btnUpload, {
				action: '<?=site_url($com_url);?>/saveupload',
				name: 'perencanaan_file',
				data: {id_perencanaan:<?=@$id_perencanaan;?>},
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
						jQuery('#id_perencanaan').val(arr_result[2]);
						jQuery('#oper').val('edit');
						status.removeClass('msg-box-false');
						status.addClass('msg-box-true');
						file = file.replace(/%20/g, "");
						status.html('<ul><li><font color="yellow">' + file  + ', success di upload !' + '</font></li></ul>' ).addClass('notification-ok');
						$('#file_view').html('<span class="image-list"> '+file+' <a onclick="<?=$class_name?>grid.extra.remove_file({id_perencanaan:<?=@$id_perencanaan?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_perencanaan?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
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
