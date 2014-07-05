<h3 class="grid-title"><i class="fa icon-user"></i>&nbsp;Informasi Pengguna</h3>
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
<script type='text/javascript'>
jQuery(document).ready(function () {	
	$("#list_menu > li a").removeClass("active");
	$("#list_menu > li a").addClass("pasive");
	$("#m25").addClass("active");	
});

<?=$class_name;?> =  {
	initForm : function(){
		var options = {
			
			url:  '<?=site_url($com_url.'proses_confirm');?>', 
			type : 'POST',
			data: {
					user_id:'<?=@$data['user_id']?>',
					user_name:jQuery('input#user_name').val(),
					nama:jQuery('input#nama').val(),
					nama_pengguna:jQuery('input#nama_pengguna').val(),
					group_name:jQuery('input#group_name').val()
				  },
			success:function() {
          $('div.w.profileNav > a').html('<i class="fa icon-user"></i>&nbsp;'+$('input[name=nama_pengguna]').val());
        //  var hs = $('div.header-status > a');input[name=nama_pengguna]').val()
         // hs.text('')
					alert('Proses Penyimpanan berhasil dilakukan !');
					}
				}
		jQuery('#form_confirm').ajaxForm(options);
		}
			
};
var head_content = jQuery("#header_caption_content").hasClass('head-content');
if(! head_content){
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>').addClass('head-content');
}else{
	jQuery("#header_caption_content").html('<h3>'+"<?=$header_caption;?>"+'</h3>');
}
</script>
<style type="text/css">
  #form_confirm{

    width: 79%;
    display: block;
    margin-left: 235px;
    border: solid 1px orange;
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
    background: linear-gradient(to bottom, #FFB76B 0%, #FFA73D 50%, #FF7C00 54%, #E86704 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
    color: #fff;
  }
</style>
<!--begin:content-->
<div id="dashboard">
  <div class="clearfix">
    <div>
      <form id="form_confirm">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-form-flat">
          <tr class="head">
            <th colspan="2" class="head-l"><div class="head-r">Informasi Pengguna</div></th>
          </tr>
          <tr>
            <td width="25%">Username</td>
            <td width="73%">
			<? //=form_input('user_name',set_value('user_name',@$data['user_name']),'disabled');?>
			<input type='text' name='user_name' size='50' disabled='disabled' value='<?=@$data['user_name']?>' class='text'>
			</td>
          </tr>
          <tr>
            <td width="25%">SKPD</td>
            <td width="73%">
			<?//=form_input('nama',set_value('nama',@$data['nama']),'size=40','disabled');?>
			<input type='text' name='nama' size='50' disabled='disabled' value='<?=@$data['nama']?>' class='text'>
			</td>
          </tr>
		 <tr>
            <td width="25%">Nama</td>
            <td width="73%">
			<?//=form_input('nama_pengguna',set_value('nama_pengguna',@$data['nama_pengguna']),'size=40');?>
			<input type='text' name='nama_pengguna' size='50'  value='<?=@$data['nama_pengguna']?>' class='text'>
			</td>
          </tr>
          <tr>
            <td>Kategori Pengguna</td>
            <td><input type="text" disabled="disabled" name="group_name" id="group_name" value="<?=@$data['group_name']?>" /></td>
          </tr>
          <tr>
            <td width="25%">&nbsp;</td>
            <td width="73%"><input id="confirmButton" type="submit" name="confirmButton" value="SIMPAN" class="bt-form-flat-submit" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <script type='text/javascript'>  
  jQuery(document).ready(function() {  
      <?=@$js;?> 	
      <?=$class_name;?>.initForm();
  });
  </script>
<!--end:content-->
