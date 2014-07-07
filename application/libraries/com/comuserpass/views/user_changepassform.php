<h3 class="grid-title"><i class="fa icon-user"></i>&nbsp;Ganti Password</h3>
<div class="toolbar-grid">
  <div class="cb"></div>
</div>
<style type="text/css">
.content .toolbar-grid{width: 243px}
#gbox_gridcomonline{
 /* width: auto !important;
  margin-left: 2%;*/
}

.content .toolbar-grid{
  height: 25px;
}
</style>
<script language="javascript">	
jQuery(document).ready(function() {
	jQuery("#useraccount-form").submit(function(){
			var status= $('#notification-useracc');
			var user_name = jQuery('#user_name').val();
			var pass = jQuery('#useracc_password').val();
			var pass2 = jQuery('#useracc_password_2').val();
			if(user_name == ''){
				alert('Username Harus diisi!');
				return false;
			}else if(user_name.length < 3){
				alert('Username minimal 3 karakter !');
				return false;
			}else if(pass == ''){
				alert('Password Harus diisi!');
				return false;
			}else if(pass2 == ''){
				alert('Password Ke 2 Harus diisi, untuk konfirmasi!');
				return false;
			}else if(pass.length < 6){
				alert('Password minimal 6 karakter!');
				return false;
			}else if(pass2.length < 6){
				alert('Password minimal 6 karakter!');
				return false;
			}else if(pass != pass2){
				alert('Password pertama dan ke 2 tidak sama!');
				return false;
			}
            jQuery.post($(this).attr('action'),$(this).serialize(),function(data){
				var arr_result = data.split("-");
                if(arr_result[0]=='sukses'){
                  	status.html('');
					status.removeClass('msg-box-false');
					status.addClass('msg-box-true');
					status.html('<ul><li>Data telah disimpan</li></ul>');
					
                }else{
					status.html('');
					status.removeClass('msg-box-true');
					status.addClass('msg-box-false');
					status.html('<ul><li>' + arr_result[1] + '</li></ul>');
					alert('Data gagal disimpan! ');
                }
            });
			return false;
    });
});	

var head_content = jQuery("#header_caption_content").hasClass('head-content');
if(! head_content){
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
}else{
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
}
</script>
<!--begin:content-->
<!-- <div class="content"> -->
<div id="dashboard">
  <div class="clearfix">
    <form id="useraccount-form" name="useraccount-form" method="post" action="<?=site_url($com_url.'saveaccount');?>" enctype="multipart/form-data">
    <input type="hidden" name="id_user" id="id_user" value="<?=$id_user;?>"  />
    <div style="statussave"></div>
    <div id="notification-useracc" class="notification-error"></div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-form-flat">
    <tr><th colspan="4">Ganti Password</th></tr>
    <tr>
      <td width="30%">Username</td>
      <td colspan="3"><input type="text" disabled="disabled" name="user_name" id="user_name" value="<?=$user_name;?>" size="50" class="text"/></td>
    </tr>
    <tr>
      <td width="30%">Password Baru</td>
      <td colspan="3"><input type="password" name="useracc_password" id="useracc_password"  size="50" class="text"/></td>
    </tr>
    <tr>
      <td>Masukkan Kembali Password</td>
      <td colspan="3"><input type="password" name="useracc_password_2" id="useracc_password_2"  size="50" class="text"/></td>
    </tr>
    <tr>
      <td width="30%">&nbsp;</td>
      <td colspan="3"><input id="save" type="submit" name="save" value="SIMPAN" class="bt-form-flat-submit" /></td>
    </tr>
    </table>    
    </form>
	</div>
  </div>	
<!-- </div> -->
<!--end:content-->
<style type="text/css">
  #useraccount-form{

    width: 79%;
    display: block;
    margin-left: 235px;
    border: 1px dashed #9dd53a;
    float: left;
    padding: 3px;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
  }
  .main-content{

  }
  table.table-form-flat{
    border:none;
  }

  table.table-form-flat th,.bt-form-flat-submit{
     background: #9dd53a; /* Old browsers */
background: -moz-linear-gradient(top,  #9dd53a 0%, #a1d54f 50%, #80c217 51%, #7cbc0a 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#9dd53a), color-stop(50%,#a1d54f), color-stop(51%,#80c217), color-stop(100%,#7cbc0a)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* IE10+ */
background: linear-gradient(to bottom,  #9dd53a 0%,#a1d54f 50%,#80c217 51%,#7cbc0a 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9dd53a', endColorstr='#7cbc0a',GradientType=0 ); /* IE6-9 */color: #fff;
  }
  #notification-useracc ul {
  	background: green;
  	 margin: 0;
    padding: 9px 25px;
  }
</style>