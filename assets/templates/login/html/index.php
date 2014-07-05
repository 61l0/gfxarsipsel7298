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
	$(window).resize(function(){
		var h = $(window).height();
		$('div.page').height(h-10);
	}).resize();
});
</script>

<style type="text/css">
.logo-img-wrap img{
	width: 100%;
	float: left;
}
.cb{
	clear: both;
}
.logo-img {
   /* float: left;*/
    width: 280px;/*margin: 0 auto;*/
    padding: 2em 0;
}

input {
    background: none repeat scroll 0 0 #0b3568;
    border: 1px inset #003366;
    border-radius: 4px;
    color: #ffffff;
    font-family: Verdana;
    font-size: 18px;
    letter-spacing: 1px;
    line-height: 25px;
    margin-bottom: 16px;
    padding: 11px;
    text-indent: 6px;
    width: 235px;
    text-shadow: 2px 2px 0 #010101;
}

input:focus { outline:none; }
.login-boks{
	width: 283px;
	display: block;
	float: right;
}
.login-boks form{
	display: block;
}
.page{width: 570px;margin-top: 10%;margin-bottom: 0;}
body{
	overflow: hidden;
}
</style>

<div class="page">
  <div class="logo-img">
  	<div class="logo-img-wrap">
  		<img src="<?php echo base_url()?>assets/templates/login/resources/images/light-icon_03.png">
  	</div>
  </div>		
  <div class="login-boks">
    <?=form_open(site_url('login/dologin'),' id="loginForm"');?>
      <table style="margin:0 auto" border="0" align="center" cellpadding="3" cellspacing="4">
      <!--   <tr>

          <td class="title">Login system</td>
        </tr> -->
        <tr>

          <td><input type="text" name="user_name" id="user_name" class="textbox" placeholder="Username"/></td>
        </tr>
        <tr>

          <td><input type="password" name="user_password" id="user_password" class="textbox" placeholder="Password"/></td>
        </tr>
        <tr>

          <td align="right"><input type="submit" name="Submit" id="button" value="" /></td>
        </tr>
      </table>
    <?=form_close();?>
    
    <div id="notification">
    	<div id="responceArea"></div>    	
    </div>
     
     </div>
     <div class="cb"></div>
</div>
<?=$this->load->view('htmlvar/closing_items');?>

