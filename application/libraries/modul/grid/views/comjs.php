<?=@$formjs;?>
<script type='text/javascript'> 
// tambahan
	var header_caption = jQuery("#header_caption").text();
	if(header_caption){
		jQuery("div.main-content div#header_caption_content").html('<h3>'+header_caption+'</h3>').addClass('head-content');
		jQuery("#header_caption").hide();
	}

// ============================================================================================================  
<?=$class_name;?>grid = <?=convert_js_serialize($grid);?>;
<? foreach($comjs_features as $features_key=>$features_string){
    echo $features_string;
    };
?>
<?=$class_name;?>grid.init = function(){
			// 20111123 check if exist act
			if(<?=$class_name;?>grid.colModel.act){
				<?=$class_name;?>grid.colModel.act.formatoptions.editOptions =  <?=$class_name;?>grid.formprop;
				<?=$class_name;?>grid.colModel.act.formatoptions.delOptions =  <?=$class_name;?>grid.formprop;
			} 
			// 20111123 END
		    if(<?=$class_name;?>grid.opt.colModel.length == 0){
		        $.each(<?=$class_name;?>grid.colModel,function(i,colModel){
		            <?=$class_name;?>grid.opt.colModel.push(colModel);
		        });
		    }
            
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid( <?=$class_name;?>grid.opt );
			jQuery("#"+<?=$class_name;?>grid.id).jqGrid("navGrid",
				"#"+<?=$class_name;?>grid.pager,
				{
					edit:false,
					add:false,
					del:false,
					search:false,
					refresh:false
					}
			); 	
			if(<?=$class_name;?>grid.mymethod){
				if(<?=$class_name;?>grid.toolbar_ext){
					<?=$class_name;?>grid.toolbar = <?=$class_name;?>grid.toolbar_ext;
				}
					<?=$class_name;?>grid.mymethod.toolbar(<?=$class_name;?>grid.toolbar);
			}
			var test = jQuery("#dialog_print").length;
			if(test == 0){
				var prnt = jQuery("<div />").attr("id","dialog_print"); 
				$("#t_"+<?=$class_name;?>grid.id).append(prnt);
			}
			
};

<?=$class_name;?>view = function(id){
    jQuery("#"+<?=$class_name;?>grid.id).jqGrid('viewGridRow',id.id_parent,<?=$class_name;?>grid.fromprop);
};
<?=$class_name;?> =  {
	main:{
		init:function(){
		    jQuery.extend(true,<?=$class_name;?>grid.opt,<?=$class_name;?>grid.opt_ext);
		    jQuery.extend(true,<?=$class_name;?>grid.formprop,<?=$class_name;?>grid.formprop_ext);
		    <?=$class_name;?>grid.first;
	    
		    <? if(isset($form)): ?>
                <?=$class_name;?>form.init();
            <? endif; ?>
            <?=$class_name;?>grid.init();
         }
	}
};
</script>
