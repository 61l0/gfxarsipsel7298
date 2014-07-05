<?php if ( ! defined('BASEPATH')) exit('No Access script');
class Treegrid{
	function __construct(){
		$this->grid->opt->height = 200;
		$this->grid->opt->width = 900;
		$this->grid->opt->rownumbers = false;
		$this->grid->opt->mtype = "POST";
		$this->grid->opt->datatype = "json";
		$this->grid->opt->jsonReader->repeatitems = false;
		$this->grid->opt->jsonReader->subgrid->repeatitems = false;

		$this->grid->opt->treeGrid = true;
		$this->grid->opt->treeGridModel = "adjacency";
		$this->grid->opt->treeIcons = array(
			"leaf"=>"ui-icon-document-b"
		);

		// required opt
		$this->grid->opt->url = false;
		$this->grid->opt->caption = "Hirarki Grid";
		$this->grid->opt->ExpandColumn = "act";
		// $this->opt->pager = $this->pager;
	}
}
?>
