<?=$this->load->view('htmlvar/document_head');?>
<script type='text/javascript'>   
userpage =  {
	form:{
		init: function(settings){
			var options = { 
				// target:'#responceArea',
				dataType: 'json',
				type:      'POST',
				success : function(content) { 
					if(content.result == 'succes'){
						location.href = '<?=site_url();?>' + content.section;
					}
					
					var msg;
					msg = '<div class="error-box"></div>';
					msg += '<div class="error-msg" >'+content.message+'</div>';
					jQuery('#responceArea').html(msg);
				} 
			};
			jQuery.extend(options,settings);
			jQuery('#loginForm').ajaxForm(options); 
		}
	},
	auth:{
		init:function(){
			// alert("<?=@$_SESSION['nama'];?>");
				
					 if("<?=@$_SESSION['nama'];?>"){
							location.href = '<?=site_url();?>' + '<?=@$_SESSION['nama'];?>';
							jQuery('#button').hide()
					 }else{
					 	userpage.form.init(); 	
					 }

		}
	}
}
</script>

<script type='text/javascript'>  
jQuery(document).ready(function() {  
	userpage.auth.init(); 	
	
});
</script>



<div class="page">
  <div class="login-box">
    <?=form_open(site_url('login/dologin'),' id="loginForm"');?>
      <table width="147%" border="0" align="center" cellpadding="3" cellspacing="4">
        <tr>
          <td>&nbsp;</td>
          <td class="title">Login system</td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input type="text" name="user_name" id="user_name" class="textbox" /></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="user_password" id="user_password" class="textbox" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" id="button" value="" /></td>
        </tr>
      </table>
    <?=form_close();?>
    
    <div id="notification">
    	<div id="responceArea"></div>    	
    </div>
     
     </div>
</div>
<?=$this->load->view('htmlvar/closing_items');?>
