<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Goutput {
    function __construct(){
		$this->CI =& get_instance();
	}
	function excel($params=false){
	    if(isset($params->treeGrid)){
	        $this->CI->load->modul('goutput','model',array('name'=>'print_excel_tree','alias'=>'excel') );
		    $this->CI->excel->index($params);
	    }else{
		    $this->CI->load->modul('goutput','model',array('name'=>'print_excel','alias'=>'excel') );
		    $this->CI->excel->index($params);
	    }
	}
	function word($params=false){
	    if(isset($params->treeGrid)){
	        $this->CI->load->modul('goutput','model',array('name'=>'print_word_tree','alias'=>'word') );
		    $this->CI->word->index($params);	    
	    }else{
		    $this->CI->load->modul('goutput','model',array('name'=>'print_word','alias'=>'word') );
		    $this->CI->word->index($params);
	    }
	}
	function pdf($params=false){
	    if(isset($params->treeGrid)){	    
	        $this->CI->load->modul('goutput','model',array('name'=>'print_pdf_tree','alias'=>'pdf') );
		    $this->CI->pdf->index($params);	    
	    }else{
		    $this->CI->load->modul('goutput','model',array('name'=>'print_pdf','alias'=>'pdf') );
		    $this->CI->pdf->index($params);	    
	    }

	}
}	
?>
