<?=$class_name;?>grid.btn_grid_plus=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow","new",<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_grid_edit=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_row,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_grid_view=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_row,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_grid_del=function(params){
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_row,<?=$class_name;?>grid.formprop);
}
