<? if(isset($form)): ?>
<?=$class_name;?>form ={
    init:function(){
        <?=$class_name;?>form =  <?=convert_js_serialize($form)?>;
        $.each(<?=$class_name;?>form.inputModel,function(i,item){
             <?=$class_name;?>form.inputModel[i].event = {};
				<?=$class_name;?>form.inputModel[i].event.change = function(){
					id_parent_val = jQuery("select#"+i).val();
					<?=$class_name;?>grid.formprop.editData[i] = id_parent_val;
					var dataPost = {};
					dataPost[i] = id_parent_val;
					<?=$class_name;?>grid.opt.postData[i] = id_parent_val;
					jQuery("#"+<?=$class_name;?>grid.id).jqGrid("setGridParam",{postData:dataPost});
					if(item.extra){
						if(item.extra.relation){
							id_child = item.extra.relation.name;
							$.ajax({
								type: "POST",
								url : "<?php echo site_url($com_url.'get_dropdown_option')?>",
								data: dataPost,
								dataType:'json',
								success: function(jsondata){
									$('#'+id_child).html('');
									$.each(jsondata.options,function(v,l){
										var attr = {value:v};
										// if(v == jsondata)
										var opt = $('<option />').attr(attr).text(l);
										$('#'+item.extra.relation.name).append(opt);
									});
									$('#'+item.extra.relation.name).val(jsondata.default);
									var set_child = {};
									set_child[id_child] = jsondata.default;
									jQuery("#"+<?=$class_name;?>grid.id).jqGrid("setGridParam",{postData:set_child});
									<?=$class_name;?>grid.opt.postData[id_child] = jsondata.default;
									<?=$class_name;?>grid.formprop.editData[id_child] = jsondata.default;
									jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");
								}
							});
						}
					}else{
					    if(<?=$class_name;?>grid.opt.treeGrid){
					        var set_key = {};
					        var id_key = <?=$class_name;?>grid.opt.prmNames.id;
					        set_key[id_key] = '';
						    jQuery("#"+<?=$class_name;?>grid.id).jqGrid("setGridParam",{postData:set_key});
						}
						jQuery("#"+<?=$class_name;?>grid.id).trigger("reloadGrid");	
					}
				};
        })
        jQuery("#FirstForm").gfForm(<?=$class_name;?>form);
        $.each(<?=$class_name;?>form.inputModel,function(i,item){
            if(!<?=$class_name;?>grid.opt.postData){
                <?=$class_name;?>grid.opt.postData = {};
            }
            if(!<?=$class_name;?>grid.formprop.editData){
                <?=$class_name;?>grid.formprop.editData = {};
            }
            <?=$class_name;?>grid.opt.postData[i] = jQuery("select#"+i).val();
            <?=$class_name;?>grid.formprop.editData[i] = jQuery("select#"+i).val();
        })
    }
};
<?endif;?>

