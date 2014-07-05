<div id="content">
<script type="text/javascript">
<?=$class_name;?> = <?=convert_js_serialize($jsobj);?>;
<?=$class_name;?>.ubah = function(){
    jQuery("#simpan_kk").show();
    jQuery.each(this.inputmodel,function(i,val){
        if(val.editable == true){
            jQuery("input#"+i).attr('disabled',false);
        }
    });
};
<?=$class_name;?>.batal = function(){
    jQuery("#simpan_kk").hide();
    jQuery.each(this.inputmodel,function(i,val){
        if(val.editable == true){
            jQuery("input#"+i).attr('disabled',true);
        }
    });
};
<?=$class_name;?>.simpan = function(){
    var data = jQuery('#myForm').serializeArray();
    var conf = {
        url: '<?=site_url($editurl);?>',
        type: "POST",
        data: data,
        success: function(){
        }
    };
    $.ajax(conf);
};
</script>
<div class="head-content">
  <h3><a href="#">KK</a></h3>
<div class="tools">
    <ul>
     <li class="plus"><a href="javascript:void(0);" onclick="<?=$class_name;?>.ubah();">Ubah</a></li>
    </ul>
</div>
</div> 
<div id="responceArea" />
<form id="myForm" accept-charset="utf-8">
<?=form_hidden('oper','edit');?>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="3">
<?foreach($inputmodel as $key_model=>$row_model):?>
    <?foreach($data as $key=>$row):?>
        <?
        if(@$key==$key_model){
            if(@$row_model['key']){
                echo form_hidden($row_model['name'],$row,'id="'.$row_model['name'].'" size="30" disabled');
            }else{
                echo "<tr><td>".$row_model['label']."</td><td>:</td>";
                echo "<td>".form_input($row_model['name'],$row,'id="'.$row_model['name'].'" size="30" disabled')."</td>";
            }
        }
       
        if($key == 'no_kelompok'){
            if($key_model=='rw'){
                echo "<tr><td>".$row_model['label']."</td><td>:</td>";
                echo "<td>".form_input($row_model['name'],substr($row,5,-2),'id="'.$row_model['name'].'" size="5" disabled')."</td>";
            }
            if($key_model=='rt'){
                echo "<tr><td>".$row_model['label']."</td><td>:</td>";
                echo "<td>".form_input($row_model['name'],substr($row,7),'id="'.$row_model['name'].'" size="5" disabled')."</td>";
            }
        }
        ?>
    <?endforeach;?>
<?endforeach;?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div id="simpan_kk">
        <input type="button" name="submit" id="button" value="SIMPAN" class="bt-form-flat-submit" onclick="<?=$class_name;?>.simpan();return false;"/>
        <button class="bt-form-flat-submit" onclick="<?=$class_name;?>.batal();return false;"><span>Batal</span></button>
    </div></td>
</tr>
</table>
 </form>
 
<script type='text/javascript'>  
jQuery(document).ready(function() {  
    jQuery("#simpan_kk").hide();
});
</script>

