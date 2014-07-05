 <?=form_open($com_url.'formaction',' id="myForm"');?>
	<input type="hidden" id="oper" name="oper" value="<?=@$oper?>">
	<input type="hidden" id="id_berita" name="id_berita" value="<?=@$id_berita?>">
	<input type="hidden" id="id_menu" name="id_menu" value="<?//=@$id_menu?>">
	 <div id="notification-pengumuman" class="notification-error"></div>
	<table class="table-flat" width="100%" height="100%">
		<tr>
			<td>Judul Artikel</td>
			<td colspan="3">: <input type="text" name="judul" id="judul" value="<?=@$data->judul?>" size="30">
			</td>
		</tr>
		<tr>
			<td>Rubrik *</td>
			<td>
				<?//=form_dropdown('id_rubrik',@$arrrubrik['options'],@$idrubrik['default'],'id="id_rubrik"');?>
				<?//=form_dropdown('id_rubrik',@$arrrubrik['options'],@$idrubrik['default'],' id="id_rubrik"');?>
				<?=form_dropdown('id_rubrik',@$arrrubrik,@$idrubrik,' id="id_rubrik"');?>
			</td>
			<td>Penulis *</td>
			<td><?=form_dropdown('id_penulis',@$arrpenulis,@$idpenulis,' id="id_penulis"');?></td>
		</tr>
		<tr>
			<td width="30%">Sub Judul</td>
			<td width="30%">: <input type="text" name="sub_judul" id="sub_judul" value="<?=@$data->sub_judul?>" size="30"></td>
			<td width="20%">Status</td>
			<td width="20%">: <select name="status" id="status">
					<? if(@$data->status=='publish'){ ?>
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
			<td>Tanggal</td>
			<td>: <input type="text" size="10" name="tanggal" id="tanggal" value="<?=@$data->tanggal;?>" class="dpicker-artikel" readonly="readonly" /></td>
			<td>Urutan</td>
			<td>: <input type="text" size="5" name="urutan" id="urutan" value="<?=@$data->urutan;?>" /></td>
		</tr>
		<tr>
          <td valign="top">Isi Artikel</td>
          <td colspan="3">: <textarea name="isi_berita" id="isi_berita" rows="20" cols="90" ><?=@$data->isi_berita;?></textarea></td>
		</tr>
		<tr>
			<td colspan="4">
				<input type="submit" class="bt-blue-common" value="Simpan" id="simpan_perhatian_lap">
				<input type="button" class="bt-blue-common" onclick="<?=$class_name;?>grid.btn_close_dialog()" value="Batal">
			</td>
		</tr>
	</table>
</form>
		
<script language="javascript">	 
	jQuery(document).ready(function() {
		// tinyMCE.idCounter=0;
		// tinyMCE.execCommand('mceAddControl', true, 'isi_berita');	
		tinyMCE.init({
			mode : "exact", 
			theme : "advanced", 
			theme_advanced_toolbar_location : "top", 
			elements : 'isi_berita'
		}); 
		<?=$class_name;?>grid.extra.btn_simpan();
		jQuery("#tanggal").datepicker({
			changeMonth: true
			,changeYear: true
			,buttonImage: '<?=BASE_URL;?>arsip/assets/image/icons/calendar.gif' 
			,buttonImageOnly: true
			,dateFormat: 'yy-mm-dd'
		}); 
		jQuery(function(){	
			var btnUpload=$('#pengumuman-uploader') , interval;
			var status=$('#notification-pengumuman');	
			new AjaxUpload(btnUpload, {
				action: '<?=site_url('cms/com/cmspengumuman/saveupload');?>',
				name: 'pengumuman_file',
				data: {id_berita:<?=@$id_berita;?>},
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
						jQuery('#id_berita').val(arr_result[2]);
						jQuery('#oper').val('edit');
						status.removeClass('msg-box-false');
						status.addClass('msg-box-true');
						file = file.replace(/%20/g, "");
						status.html('<ul><li>' + file  + ', success di upload !' + '</li></ul>' ).addClass('notification-ok');
						$('#file_view').append('<span class="image-list"> '+file+' <a onclick="<?=$class_name?>grid.extra.remove_file({id_berita:<?=@$id_berita?>}); <?=$class_name?>grid.extra.loadFormImageEditingGaleri(<?=@$id_berita?>); return false;" class="fm-button ui-state-default ui-corner-all fm-button-icon-left"><span class="ui-icon ui-icon-trash"></span>Hapus</a></span>');
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
