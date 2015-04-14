<script language="javascript">	
	$(document).ready(function(){
		$("#header_caption_content").html("<h3>Pengaturan Tampilan &raquo; Headline Manager</h3>");
	});
	jQuery("#set-form").submit(function(){
			var status= $('#notification');
			var interval;
            jQuery.post($(this).attr('action'),$(this).serialize(),function(data){
                if(data=='sukses'){
                  	status.html('');
					//status.removeClass('msg-box-false');
					//status.addClass('msg-box-true');
					status.html('<div class="success">Data telah disimpan</div>');
                }else{
					status.html('');
					//status.removeClass('msg-box-true');
					//status.addClass('msg-box-false');
					status.html('<div class="error">'+data+'</div>');
                }
            });
			return false;
    });

</script>
<div class="content">
<form id="set-form" method="post" action="<?=site_url($com_url);?>/save" enctype="multipart/form-data">
<div  style="background-color:#FFFFFF">
  <div id="notification" ></div>
  <table width="100%" cellspacing="1" cellpadding="5" class="table-flat">
  <tr><th colspan="2">General Public Manager</th></tr>
    <tr>
      <td width="13%">Headline Manager</td>
      <td width="87%"><select name="headline_menu" id="id_menu">
      	<option  value="">--Pilih Rubrik--</option>
        <?=$rubrik_options;?>
        </select></td>
    </tr>
    <tr >
      <td valign="top">Running Text</td>
      <td><textarea name="run_text" id="run_text" rows="4" cols="90" ><?=$running_text;?></textarea>
        </td>
    </tr>
     <tr >
      <td valign="top">Running Text Status</td>
      <td><label><input type="checkbox" name="run_status" value="on" <?=$runon_cek;?>/>On </label>
        </td>
    </tr>
    <tr >
      <td>&nbsp;</td>
      <td><input type="submit" class="bt-blue-common" name="save" value="Save" />
        </td>
    </tr>
  </table>
 </div>
</div>