<?php if ( ! defined('BASEPATH')) exit('No Access script');
require_once(DOC_PATH_GRID.'treegrid.php');
class Treegrid_sys_menu extends Treegrid{
	function __construct(){
		parent::__construct();
		$this->grid->id = "treegrid_sys_menu";
		$this->grid->pager = $this->grid->id."Pager";
		$this->grid->opt->pager = $this->grid->pager;
		$this->grid->opt->gridView = false;

		// required opt
		$this->grid->opt->url = false;
		$this->grid->opt->ExpandColumn = "menu_name";
		$this->grid->opt->tree_root_level = 1;
		
		$this->grid->opt->jsonReader->repeatitems = false;
		$this->grid->opt->jsonReader->subgrid->repeatitems = false;
		$this->grid->opt->jsonReader->id  = 'id_menu';

		$this->grid->opt->treeReader  = array(
			'level_field'=>"n_level",
			'parent_id_field'=>"id_parent",
			'leaf_field'=>"isLeaf",
			'expanded_field'=>"expanded",
			'parent_id_value'=>"0",
		);

		$this->grid->opt->prmNames = array('id'=>'id_menu');
		$this->grid->opt->toolbar = array(true,'top');

		// form properties
		$this->grid->formprop->width = 900;
		$this->grid->formprop->closeOnEscape = true;
		$this->grid->formprop->bottominfo = "(*) harus diisi";
		$this->grid->formprop->savekey = array(true,13);
		$this->grid->formprop->reloadAfterSubmit = false;
		$this->grid->formprop->closeAfterAdd = true;
		$this->grid->formprop->closeAfterEdit = true;

		$this->arr_colModel["id_menu"] = array(
			'name'=>"id_menu",
			'index'=>"id_menu",
			'hidden'=>true,
			'key'=>true,
			'editable'=>true,
			);
			
		$this->arr_colModel["ins"] = array(
			'name'=>"ins",
			'index'=>"ins",
			'label'=>"+",
			'align'=>"center",
			'width'=>10,
			);
		$this->arr_colModel["act"] = array(
			'name'=>"act",
			'index'=>"act",
			'label'=>"PROSES",
			'align'=>"center",
			'formatter'=>"actions",
			'formatoptions'=>array(
				"keys"=>false,
				"editformbutton"=>true,
				"editOptions"=>$this->grid->formprop,
				"delOptions"=>$this->grid->formprop,
				),
			'width'=>30,
			);
			
		$this->arr_colModel["menu_name"] = array(
			'name'=>"menu_name",
			'index'=>"menu_name",
			'label'=>"Nama Menu",
			'width'=>100,
			'editable'=>true,
			'edittype'=>'text',
			'editoptions'=>array('size'=>50), 
			'editrules'=>array('required'=>true), 
			'formoptions'=>array('label'=>'<strong>Nama Menu (*)</strong>','colpos'=>1,'rowpos'=>2)
			);
		$this->arr_colModel["menu_path"] = array(
			'name'=>"menu_path",
			'index'=>"menu_path",
			'label'=>"Path",
			'width'=>100,
			'editable'=>true,
			'edittype'=>'text',
			'editoptions'=>array('size'=>50), 
			// 'editrules'=>array(), 
			'formoptions'=>array('colpos'=>2,'rowpos'=>2)
			);
		$this->arr_colModel["icon_menu"] = array(
			'name'=>"icon_menu",
			'index'=>"icon_menu",
			'label'=>"Icon",
			'width'=>100,
			'editable'=>true,
			'edittype'=>'text',
			'editoptions'=>array('size'=>50), 
			'editrules'=>array('required'=>true), 
			);
		$this->arr_colModel["menu_index"] = array(
			'name'=>"menu_index",
			'index'=>"menu_index",
			'label'=>"index",
			'width'=>20,
			'editable'=>true,
			'edittype'=>'text',
			'editoptions'=>array('size'=>10), 
			'editrules'=>array('required'=>true,'number'=>true), 
			'formoptions'=>array('label'=>'<strong>index (*)</strong>','colpos'=>1,'rowpos'=>3)
			);
		$this->arr_colModel["status"] = array(
			'name'=>"status",
			'index'=>"status",
			'label'=>"status",
			'width'=>20,
			'editable'=>true,
			'edittype'=>'checkbox',
			'editoptions'=>array("value"=>"on:off"), 
			'editrules'=>array('required'=>true), 
			'formoptions'=>array('label'=>'status','elmsuffix'=>'ON','colpos'=>2,'rowpos'=>3)
			);


		
	}
}
?>
