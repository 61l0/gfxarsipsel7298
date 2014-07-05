<?php
/*
Copyright Malink Corporation Inc
Simple Class for generating HTML table to Microsoft Office Excel BIFF Format
Credit : cristminix@gmail.com
*/
set_include_path(CLASSES_PATH . 'ExcelWriter');
require_once CLASSES_PATH . 'PHPExcel.php';
require_once 'Spreadsheet/Excel/Writer.php';

class HtmlExcel extends PHPExcel_Reader_HTML{
	var $_token = '';
	var $_filename = '';
	var $_count = 0;
	var $_i_count= 0;
	var $_update_every = 0;
	var $_table ='arsip_job';
    var $_title = '';
	var $_output_filename = '';
	var $_workbook = '';
	var $_worksheet = '';
	var $_php_excel_object = '';
    var $_custom_color = array();
    var $_color_index = 51;

	public function __construct($title,$token,$input_filename,$output_filename,$count,$extra_count=0,$update_every=100)
	{
		parent::__construct();
		$this->_token = $token;
		$this->_filename = $input_filename;
		$this->_count = $count + $extra_count;
		$this->_update_every = $update_every;
		$this->ci =& get_instance();
		$this->_output_filename = $output_filename;
        $this->_storePercentage(TRUE); 
		$this->_title = substr($title,0,30);

        $this->_init();
		

	}
    function _html2rgb($color)
    {
        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                                     $color[2].$color[3],
                                     $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;

        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

        return array($r, $g, $b);
    }
    function _createCustomColor($color_code)
    {
        if(!isset($this->_custom_color[$color_code]))
        {
            $rgb_color = $this->_html2rgb($color_code);

            $color_index = ($this->_color_index+=1);
            $this->_custom_color[$color_code] =  $color_index;
            $this->_workbook->setCustomColor($color_index, $rgb_color[0], $rgb_color[1], $rgb_color[2]);
        }
    }
    function _extractStyle($style)
    {
        $style_format  = $this->_workbook->addFormat();
        
        $style_format->setFontFamily('Calibri');
        $border = array(
            'none' => 0,
            'thin' => 1,
            'thick' => 5,
            'medium' => 2,
            'dashed' => 3,
            'dotted' => 4,
            'double' => 6,
            'hair' => 7,
        );
        foreach ($style as $key => $rule) {
            switch ($key) {
                case 'background':
                    $this->_createCustomColor($rule);
                    $style_format->setFgColor($this->_custom_color[$rule]);
                    break;
                case "text-wraping":
                    $style_format->setTextWrap();
                    break;
                case 'color':

                    $this->_createCustomColor($rule);
                    $style_format->setColor($this->_custom_color[$rule]); 
                    break;
                
                case 'align':
                case 'text-align':
                                    /*
                    top, vcenter, bottom, vjustify, vequal_space
                                    */
                    $style_format->setAlign($rule);
                    break;
                case 'valign':
                    $style_format->setVAlign($rule);
                case 'font-style' :
                    if($rule == 'italic')
                    {
                        $style_format->setItalic();
                    }
                    break;
                case 'font-size' :
                    $style_format->setSize(str_replace(array('px','pt','em'), '', $rule));
                    break;
                case 'font-weight' :
                    $style_format->setBold();
                    break;
                case 'border':
                    
                    //$border = explode(' ', $rule);
                    $style_format->setBorder($border[$rule]);
                    break;
                case 'border-left':
                    $style_format->setLeft($border[$rule]);
                    break;
                case 'border-right':
                    $style_format->setRight($border[$rule]);
                    break;
                case 'border-top':
                    $style_format->setTop($border[$rule]);
                    break;
                case 'border-bottom':
                    $style_format->setBottom($border[$rule]);
                    break;
            }
        }
        return $style_format;
    }
	function _init()
	{
		
		$this->_workbook = new Spreadsheet_Excel_Writer($this->_output_filename);
		$this->loadHtml();
	}
	function _mergeCells($column , $row , $columnTo , $rowEnd,$style=0)
	{
        //void Worksheet::setMerge ( integer $first_row , integer $first_col , integer $last_row , integer $last_col )
        $column = PHPExcel_Cell::columnIndexFromString($column) - 1;
        $columnTo = PHPExcel_Cell::columnIndexFromString($columnTo) - 1;
        $row = $row - 1;
        $rowEnd = $rowEnd -1;

        if($style)
        {
            if($row != $rowEnd)
            {
                $cpRow = $row;
                $cpRowEnd = $rowEnd;
                $cpColumn = $column;

                while ($cpRow<$cpRowEnd) {
                   // echo "$cpRow,$cpColumn <br/>";
                    $this->_worksheet->writeString($cpRow+1,$columnTo,'',$style);
                    ++$cpRow;
                }
            }
            else
            { 
                $cpColumn = $column;
                while ($cpColumn<$columnTo) {
                   // echo "$cpRow,$cpColumn <br/>";
                    $this->_worksheet->writeString($row,$cpColumn+1,'',$style);
                    ++$cpColumn;
                }
               //$this->_worksheet->writeString($row,$columnTo,'',$style);
            }
        }
        //echo "$row,$column,$rowEnd,$columnTo <br/>";
        $this->_worksheet->setMerge($row,$column,$rowEnd,$columnTo);
	}

    public function getPercentage()
    {
		return (int)( $this->_i_count/$this->_count * 100 );
    }
    public function _storePercentage($create=FALSE)
    {
    	if($create)
    	{
    		if($this->ci->db->where('token',$this->_token)->get($this->_table)->num_rows() <= 0)
    			$this->ci->db->insert( $this->_table,array(
    				'token'=>$this->_token,
    				'status'=>'IN_PROGRESS',
    				'date_started' => date('Y-m-d H:i:s'),
    				'progress'=>0));
    		else
    			$this->ci->db->where('token',$this->_token)
	    			 ->update($this->_table,array('status'=>'IN_PROGRESS','progress'=>0,'date_started' => date('Y-m-d H:i:s')));
    	}
    	else
    	{	
    	    	$this->ci->db->where('token',$this->_token)
    	    			 ->update($this->_table,array('date_ended' => date('Y-m-d H:i:s'),'status'=>'IN_PROGRESS','progress'=>$this->getPercentage()));
	    }
    }
    function _strToHex($string){
        $hex = '';
        for ($i=0; $i<strlen($string); $i++){
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0'.$hexCode, -2);
        }
        return strToUpper($hex);
    }
    public function _markComplete()
    {
    	$this->ci->db->where('token',$this->_token)->update($this->_table,array('date_ended'=>date('Y-m-d H:i:s'),'progress' => 100,'status'=>'COMPLETE'));
    }
    function _flushCell($sheet, $column, $row, &$cellContent, $style=0)
    {
    	//print_r($this);
        
        // if($cellContent == 'SERI')
        // {
            //print_r($this->rowspan);   
           // echo "$column,$row - " . $cellContent . '<br/>';    
        // }   
     
    	$column = PHPExcel_Cell::columnIndexFromString($column) - 1;
    	$row = $row -1;
       

        if (is_string($cellContent)) {
            //	Simple String content
            if (trim($cellContent) > '') {
            	//print_r($this->_worksheet);
            	if(is_numeric($cellContent) && substr($cellContent,0,1)!='0')
    	        	$sheet->writeNumber($row, $column, $cellContent,$style);
            	else
                {   

                    if($this->_strToHex($cellContent) == 'C2A0'){
                       // echo 'HERE <br/>'; 
                        $sheet->writeString($row, $column, '',$style);
                    }else
    	        	    $sheet->writeString($row, $column, $cellContent,$style);
                }
            }
        } else {
            //	We have a Rich Text run
            //	TODO
            //$this->_dataArray[$row][$column] = 'RICH TEXT: ' . $cellContent;
        }
        $cellContent = (string) '';
    }

    function _processDomElement(DOMNode $element, $sheet, &$row, &$column, &$cellContent, $format = null)
    {
    	if($element->nodeName == 'tr')
    	{
    		$this->_i_count += 1;
    		if($this->_i_count % $this->_update_every == 0)
    		{
    			$this->_storePercentage();
    		}
    		if( $this->_i_count == ($this->_count - 1))
            {
                $this->_markComplete();
            }
    	}

        foreach ($element->childNodes as $child) {
            if ($child instanceof DOMText) {
                $domText = preg_replace('/\s+/', ' ', trim($child->nodeValue));
                if (is_string($cellContent)) {
                    //	simply append the text if the cell content is a plain text string
                    $cellContent .= $domText;
                } else {
                    //	but if we have a rich text run instead, we need to append it correctly
                    //	TODO
                }
            } elseif ($child instanceof DOMElement) {
//				echo '<b>DOM ELEMENT: </b>' , strtoupper($child->nodeName) , '<br />';

                $attributeArray = array();
                foreach ($child->attributes as $attribute) {
//				echo '<b>ATTRIBUTE: </b>' , $attribute->name , ' => ' , $attribute->value , '<br />';
                    $attributeArray[$attribute->name] = $attribute->value;
                }

                switch ($child->nodeName) {
                    case 'meta' :
                        foreach ($attributeArray as $attributeName => $attributeValue) {
                            switch ($attributeName) {
                                case 'content':
                                    //	TODO
                                    //	Extract character set, so we can convert to UTF-8 if required
                                    if(preg_match('/setColumn/', $attributeValue))
                                    {
                                        //echo 'here';
                                        $oper = explode(' ',$attributeValue);
                                        $params = json_decode($oper[1],true);
                                       
                                        foreach ($params as $col => $width) {
                                            // print_r($col.','.$width.'<br/>');
                                            $sheet->setColumn($col,$col,$width);
                                        }
                                        
                                    }
                                    if(preg_match('/setRow/', $attributeValue))
                                    {
                                        //echo 'here';
                                        $oper = explode(' ',$attributeValue);
                                        $params = json_decode($oper[1],true);
                                       
                                        foreach ($params as $row => $height) {
                                            // print_r($col.','.$width.'<br/>');
                                            $sheet->setRow($row,$height);
                                        }
                                        
                                    }
                                    if(preg_match('/run/', $attributeValue))
                                    {
                                        
                                        $oper = explode(' ',$attributeValue);
                                        $params = json_decode($oper[1],true);
                                       // print_r($params);
                                        foreach ($params as $cmd) {
                                            // print_r($col.','.$width.'<br/>');
                                            //$sheet->setRow($row,$height);
                                          //  echo $cmd;
                                            eval($cmd);    
                                        }
                                        
                                    }
                                    break;
                            }
                        }
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                        break;
                    case 'title' :
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                        //$this->setTitle($cellContent);
                        $cellContent = '';
                        break;
                    case 'span' :
                    case 'div' :
                    case 'font' :
                    case 'i' :
                    case 'em' :
                    case 'strong':
                    case 'b' :
//						echo 'STYLING, SPAN OR DIV<br />';
                        if ($cellContent > '')
                            $cellContent .= ' ';
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                        if ($cellContent > '')
                            $cellContent .= ' ';
//						echo 'END OF STYLING, SPAN OR DIV<br />';
                        break;
                    case 'hr' :
                        $this->_flushCell($sheet, $column, $row, $cellContent);
                        ++$row;
                        if (isset($this->_formats[$child->nodeName])) {
                            //$this->getStyle($column . $row)->applyFromArray($this->_formats[$child->nodeName]);
                        } else {
                            $cellContent = '----------';
                            $this->_flushCell($sheet, $column, $row, $cellContent);
                        }
                        ++$row;
                    case 'br' :
                        if ($this->_tableLevel > 0) {
                            //	If we're inside a table, replace with a \n
                            $cellContent .= "\n";
                        } else {
                            //	Otherwise flush our existing content and move the row cursor on
                            $this->_flushCell($sheet, $column, $row, $cellContent);
                            ++$row;
                        }
//						echo 'HARD LINE BREAK: ' , '<br />';
                        break;
                    case 'a' :
//						echo 'START OF HYPERLINK: ' , '<br />';
                        foreach ($attributeArray as $attributeName => $attributeValue) {
                            switch ($attributeName) {
                                case 'href':
//									echo 'Link to ' , $attributeValue , '<br />';
                                   // $this->getCell($column . $row)->getHyperlink()->setUrl($attributeValue);
                                    if (isset($this->_formats[$child->nodeName])) {
                                        //$this->getStyle($column . $row)->applyFromArray($this->_formats[$child->nodeName]);
                                    }
                                    break;
                            }
                        }
                        $cellContent .= ' ';
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//						echo 'END OF HYPERLINK:' , '<br />';
                        break;
                    case 'h1' :
                    case 'h2' :
                    case 'h3' :
                    case 'h4' :
                    case 'h5' :
                    case 'h6' :
                    case 'ol' :
                    case 'ul' :
                    case 'p' :
                        if ($this->_tableLevel > 0) {
                            //	If we're inside a table, replace with a \n
                            $cellContent .= "\n";
//							echo 'LIST ENTRY: ' , '<br />';
                            $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//							echo 'END OF LIST ENTRY:' , '<br />';
                        } else {
                            if ($cellContent > '') {
                                $this->_flushCell($sheet, $column, $row, $cellContent);
                                $row++;
                            }
//							echo 'START OF PARAGRAPH: ' , '<br />';
                            $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//							echo 'END OF PARAGRAPH:' , '<br />';
                            $this->_flushCell($sheet, $column, $row, $cellContent);

                            if (isset($this->_formats[$child->nodeName])) {
                                //$this->getStyle($column . $row)->applyFromArray($this->_formats[$child->nodeName]);
                            }

                            $row++;
                            $column = 'A';
                        }
                        break;
                    case 'li' :
                        if ($this->_tableLevel > 0) {
                            //	If we're inside a table, replace with a \n
                            $cellContent .= "\n";
//							echo 'LIST ENTRY: ' , '<br />';
                            $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//							echo 'END OF LIST ENTRY:' , '<br />';
                        } else {
                            if ($cellContent > '') {
                                $this->_flushCell($sheet, $column, $row, $cellContent);
                            }
                            ++$row;
//							echo 'LIST ENTRY: ' , '<br />';
                            $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//							echo 'END OF LIST ENTRY:' , '<br />';
                            $this->_flushCell($sheet, $column, $row, $cellContent);
                            $column = 'A';
                        }
                        break;
                    case 'table' :
                        $this->_flushCell($sheet, $column, $row, $cellContent);
                        $column = $this->_setTableStartColumn($column);
//						echo 'START OF TABLE LEVEL ' , $this->_tableLevel , '<br />';
                        if ($this->_tableLevel > 1)
                            --$row;
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//						echo 'END OF TABLE LEVEL ' , $this->_tableLevel , '<br />';
                        $column = $this->_releaseTableStartColumn();
                        if ($this->_tableLevel > 1) {
                            ++$column;
                        } else {
                            ++$row;
                        }
                        break;
                    case 'thead' :
                    case 'tbody' :
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                        break;
                    case 'tr' :
                        $column = $this->_getTableStartColumn();
                        $cellContent = '';
//						echo 'START OF TABLE ' , $this->_tableLevel , ' ROW<br />';
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                        ++$row;
//						echo 'END OF TABLE ' , $this->_tableLevel , ' ROW<br />';
                        break;
                    case 'th' :
                    case 'td' :
//						echo 'START OF TABLE ' , $this->_tableLevel , ' CELL<br />';
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
//						echo 'END OF TABLE ' , $this->_tableLevel , ' CELL<br />';
                        //print_r($this->rowspan);
                        while (isset($this->rowspan[$column . $row])) {
                            
                            // for ($i = 0; $i <= $this->rowspan[$column . $row] ; $i++) {
                            //     ++$column;
                            // }
                            ++$column;
                        }
                        $virtual = FALSE;
                        foreach ($attributeArray as $attributeName => $attributeValue) {
                            switch ($attributeName) {
                                case 'virtual':
                                  $virtual = TRUE;
                                    break;
                            }
                        }
                        
                        //{}    
                        $style=0;
                        if (isset($attributeArray['style']) && !empty($attributeArray['style'])) {
                            $styleAry = $this->getPhpExcelStyleArray($attributeArray['style']);
  

                            if (!empty($styleAry)) {
                                $style = $this->_extractStyle($styleAry);
                                //$b = $cellContent;
                                //echo $column .',' . $row . '=' . $this->rowspan[$column . $row] . ' =>' . $cellContent . '<br/>';
                                if(!$virtual)
                                    $this->_flushCell($sheet, $column, $row, $cellContent,$style);
                                else
                                    $cellContent = (string) '';

                            }
                        }
                        else{
                            if(!$virtual)
                                $this->_flushCell($sheet, $column, $row, $cellContent);
                            else
                                $cellContent = (string) '';
                        }
                        //create merging rowspan
                        if (isset($attributeArray['rowspan'])) {

                            $range = $column . $row . ':' . $column . ($row + $attributeArray['rowspan'] - 1);
                            // /echo $range ."<br/>";
                            foreach (\PHPExcel_Cell::extractAllCellReferencesInRange($range) as $value) {
                                //echo "$value >";
                                $this->rowspan[$value] = true;
                                if (isset($attributeArray['colspan'])) {
                                    $columnTo = 0;
                                    for ($i = 0; $i < $attributeArray['colspan']; $i++) {
                                        ++$columnTo;
                                    }
                                    $this->rowspan[$value] = $columnTo;
                                    // $this->_mergeCells($column , $row , $columnTo , $row,$style);
                                    // $column = $columnTo;
                                }
                            }
                            $this->_mergeCells($column,$row,$column,($row + $attributeArray['rowspan'] - 1),$style);
                        }

                        //create merging colspan
                        if (isset($attributeArray['colspan'])) {
                            $columnTo = $column;
                            for ($i = 0; $i < $attributeArray['colspan'] - 1; $i++) {
                                ++$columnTo;
                            }

                            $this->_mergeCells($column , $row , $columnTo , $row,$style);
                            $column = $columnTo;
                        }
                        ++$column;
                        break;
                    case 'body' :
                        $row = 1;
                        $column = 'A';
                        $content = '';
                        $this->_tableLevel = 0;
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                        break;
                    default:
                        $this->_processDomElement($child, $sheet, $row, $column, $cellContent);
                }
            }
        }
    }
    protected function _setTableStartColumn($column)
    {
        if ($this->_tableLevel == 0)
            $column = 'A';
        ++$this->_tableLevel;
        $this->_nestedColumn[$this->_tableLevel] = $column;

        return $this->_nestedColumn[$this->_tableLevel];
    }
    public static function autosizeColumn(\PHPExcel $objPHPExcel)
    {

    }
    public function getSheetIndex()
    {
        return $this->_sheetIndex;
    }
    public function setSheetIndex($pValue = 0)
    {
        $this->_sheetIndex = $pValue;
        return $this;
    }
    public function loadHtml()
    {
        // Open file to validate
        $this->_openFile($this->_filename);
        if (!$this->_isValidFormat()) {
            fclose($this->_fileHandle);
            throw new PHPExcel_Reader_Exception($pFilename . " is an Invalid HTML file.");
        }
        //	Close after validating
        fclose($this->_fileHandle);


        //	Create a new DOM object
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->substituteEntities = TRUE;
        //	Reload the HTML file into the DOM object
        $loaded = $dom->loadHTMLFile($this->_filename);
        if ($loaded === FALSE) {
            throw new PHPExcel_Reader_Exception('Failed to load ', $pFilename, ' as a DOM Document');
        }

        //	Discard white space
        $dom->preserveWhiteSpace = false;


        $row = 0;
        $column = 'A';
        $content = '';


        $this->_worksheet = $this->_workbook->addWorksheet($this->_title);
        $this->_pageSetup();
        $this->_processDomElement($dom, $this->_worksheet, $row, $column, $content);

    }
    function _pageSetup()
    {
        $this->_worksheet->setLandscape();
        $this->_worksheet->setPaper(5);
        $this->_worksheet->hideGridLines();

    }
    public function generateFile()
    {
    	$this->_workbook->close();
    }
    public function getJobInfo()
    {
        return $this->ci->db->where('token',$this->_token)->get($this->_table)->row();
    }
    public function redirectDownload()
    {
        redirect(base_url().$this->_output_filename);
    }
    public function getDownloadUrl()
    {
        return base_url().$this->_output_filename;
    }
    public function redirectDownloadScript($echo=TRUE)
    { 
        $script = '<script>document.location.href="' .base_url().$this->_output_filename .'"</script>';
        if(!$echo)
            return $script;
        echo $script;
    }
}