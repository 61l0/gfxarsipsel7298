 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_agenda" name="id_agenda" value="<?=@$id_agenda?>">
	 <div id="notification-agenda" class="notification-error" style="background:#CC6600"></div>
	<table class="table-flat" width="100%">
		<tr>
			<td>Judul Agenda</td>
			<td>
				: <input type="text" name="judul_agenda" id="judul_agenda" value="<?=@$data->judul_agenda?>" size="30">
				&nbsp;&nbsp;&nbsp; Lokasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
				<input type="text" name="lokasi" id="lokasi" value="<?=@$data->lokasi?>" size="30">
			</td>
		</tr>
		<tr>
			<td>Tgl. Mulai</td>
			<td> : 
				<input type="text" name="tanggal_mulai" id="tanggal_mulai" value="<?=@$data->tanggal_mulai?>">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Tgl. Selesai :
				<input type="text" name="tanggal_selesai" id="tanggal_selesai" value="<?=@$data->tanggal_selesai?>">
			</td>
		</tr>
		<tr>
			<td>Penyelenggara</td>
			<td>
				: <input type="text" name="penyelenggara" id="penyelenggara" value="<?=@$data->penyelenggara?>">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 
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
			<td>Gambar</td>
			<td>
				: <div id="agenda-uploader" class="fm-button ui-state-default ui-corner-all fm-button-icon-left">
					<span class="ui-icon ui-icon-image"></span><span>Upload Gambar</span>
				  </div><br>
				  <span id="image_view">
<? 
				$path = PATH_BASE.'arsip/assets/media/file/agenda/'.@$data->file_image;
				$image_thumb = '';
				if(is_file($path)): 
					$path = BASE_URL.'assets/media/file/agenda/'.@$data->file_image;
					
					$image_thumb .= '<span id="image_'.@$id_agenda.'"><img src="'.$path.'" width="200"><br>';
					$image_thumb .= '<br /><br /><br /><br /><br /><br /><a onclick="'.$class_name.'grid.extra.remove_image({id_agenda:'.@$id_agenda.'}); '.$class_name.'grid.extra.loadFormImageEditingGaleri('.@$id_agenda.'); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>';
				endif;
?>
				<?=@$image_thumb;?>
				  </span>
			</td>
		</tr>

		<tr>
			<td>Keterangan</td>
			<td><textarea name="keterangan" id="keterangan" rows="11" cols="90" ><?=@$data->keterangan?></textarea></td>
		</tr>
		<tr>
			<td colspan="2">
				<!--<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.extra.btn_simpan();" value="Simpan" id="simpan_perhatian_lap">-->
				<input type="submit" class="bt-blue-common" value="Simpan" id="simpan_perhatian_lap">
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
		jQuery("#tanggal_mulai,#tanggal_selesai").datepicker({
			changeMonth: true
			,changeYear: true
			,buttonImage: '<?=BASE_URL;?>arsip/assets/image/icons/calendar.gif' 
			,buttonImageOnly: true
			,dateFormat: 'yy-mm-dd'
		}); 
		jQuery(function(){	
			var btnUpload=$('#agenda-uploader') , interval;
			var status=$('#notification-agenda');	
			new AjaxUpload(btnUpload, {
				action: '<?=site_url('cms/com/cmsagenda/saveupload');?>',
				name: 'agenda_file',
				data: {id_agenda:<?=@$id_agenda;?>},
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
						jQuery('#id_agenda').val(arr_result[2]);
						jQuery('#oper').val('edit');
						status.removeClass('msg-box-false');
						status.addClass('msg-box-true');
						$('#image_view').html('');
						$('#image_view').text('');
						file = file.replace(/%20/g, "");
						status.html('<ul><li><font color="yellow">' + file  + ', success di upload !' + '</font></li></ul>' ).addClass('notification-ok');
						$('#image_view').append('<span class="image-list"><img src="<?=BASE_URL.'assets/media/file/agenda/'?>' + file + '"  width="200" ><br /><a onclick="<?=$class_name?>grid.extra.remove_image({id_agenda:<?=@$id_agenda?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_agenda?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
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
