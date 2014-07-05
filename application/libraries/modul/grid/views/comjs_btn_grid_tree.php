<?=$class_name;?>grid.btn_grid_plus=function(params){
	if(!<?=$class_name;?>grid.formprop.editData){
		<?=$class_name;?>grid.formprop.editData = {};
	}
	if(params.id_parent == 0){ // untuk menambahkan root node, maka terlebih dahulu reset row yang terpilih
		jQuery("#"+<?=$class_name;?>grid.id).jqGrid("resetSelection");
		<?=$class_name;?>grid.formprop.editData.formAct = 'add';
	}else{
		<?=$class_name;?>grid.formprop.editData.formAct = 'ins';
	}
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow","new",<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_grid_edit=function(params){
	if(!<?=$class_name;?>grid.formprop.editData){
		<?=$class_name;?>grid.formprop.editData = {};
	}
	<?=$class_name;?>grid.formprop.editData.formAct = 'edit';
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("editGridRow",params.id_row,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_grid_view=function(params){
	if(!<?=$class_name;?>grid.formprop.editData){
		<?=$class_name;?>grid.formprop.editData = {};
	}
	<?=$class_name;?>grid.formprop.editData.formAct = 'view';
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("viewGridRow",params.id_row,<?=$class_name;?>grid.formprop);
}
<?=$class_name;?>grid.btn_grid_del=function(params){
	if(!<?=$class_name;?>grid.formprop.editData){
		<?=$class_name;?>grid.formprop.editData = {};
	}
	<?=$class_name;?>grid.formprop.editData.formAct = 'del';
	jQuery("#"+<?=$class_name;?>grid.id).jqGrid("delGridRow",params.id_row,<?=$class_name;?>grid.formprop);
}
