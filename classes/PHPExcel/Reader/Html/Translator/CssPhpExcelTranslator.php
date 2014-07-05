<?php
require_once PHPEXCEL_ROOT . 'PHPExcel/Reader/Html/Parser/CssParser.php';
require_once PHPEXCEL_ROOT . 'PHPExcel/Reader/Html/Translator/StylePhpExcel.php';

class CssPhpExcelTranslator
{

    protected $dictionnary = array(
        'vertical-align' => 'vAlign',
        'phpexcel-number-format-code' => 'numberFormatCode',
        'phpexcel-number-format' => 'numberFormat',
        'text-indent' => 'textIndent'
    );
    public function convertRule($key,$rule)
    {
        $style = array();
        $border_style = array(
            'none'=>PHPExcel_Style_Border::BORDER_NONE,
            'dashDot' => PHPExcel_Style_Border::BORDER_DASHDOT,
            'dashDotDot' => PHPExcel_Style_Border::BORDER_DASHDOTDOT,
            'dashed' => PHPExcel_Style_Border::BORDER_DASHED,
            'dotted' => PHPExcel_Style_Border::BORDER_DOTTED,
            'double' => PHPExcel_Style_Border::BORDER_DOUBLE,
            'hair' => PHPExcel_Style_Border::BORDER_HAIR,
            'medium' => PHPExcel_Style_Border::BORDER_MEDIUM,
            'mediumDashDot' => PHPExcel_Style_Border::BORDER_MEDIUMDASHDOT,
            'mediumDashDotDot' => PHPExcel_Style_Border::BORDER_MEDIUMDASHDOTDOT,
            'mediumDashed' => PHPExcel_Style_Border::BORDER_MEDIUMDASHED,
            'slantDashDot' => PHPExcel_Style_Border::BORDER_SLANTDASHDOT,
            'thick' => PHPExcel_Style_Border::BORDER_THICK,
            'thin' => PHPExcel_Style_Border::BORDER_THIN,
        );
        switch ($key) {
            case 'color':
                $style['font'] = array('color' => array( 'rgb' => str_replace('#','', $rule)));
                break;
            
            case 'align':
            case 'text-align':
                $align = array(
                    'left' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                    'right' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                    'center' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                );
                $style['alignment'] = array('horizontal' => $align[$rule]);
                break;
            case 'valign':
                $align = array(
                    'top' => PHPExcel_Style_Alignment::VERTICAL_TOP,
                    'botom' => PHPExcel_Style_Alignment::VERTICAL_BOTTOM,
                    'middle' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                );
                $style['alignment'] = array('vertical' => $align[$rule]);
            case 'font-style' :
                if($rule == 'italic')
                {
                    $style['font'] = array( 'italic' => true);
                }
                break;
            case 'font-size' :
                $style['font'] = array( 'size' => str_replace('px', '', $rule));
                break;
            case 'font-weight' :
                if($rule=='bold')
                $style['font'] = array( 'bold' => true);
                break;
            case 'border':
                
                //$border = explode(' ', $rule);
                $style['borders'] = array(
                    'allborders' => array('style'=>$border_style[$rule],'color'=>PHPExcel_Style_Color::COLOR_BLACK)
                );
                break;
            case 'border-left':
                $style['borders'] = array(
                    'left' => array('style'=>$border_style[$rule])
                );
                break;
            case 'border-right':
                $style['borders'] = array(
                    'right' => array('style'=>$border_style[$rule])
                );
                break;
            case 'border-top':
                $style['borders'] = array(
                    'top' => array('style'=>$border_style[$rule])
                );
                break;
            case 'border-bottom':
                $style['borders'] = array(
                    'bottom' => array('style'=>$border_style[$rule])
                );
                break;
        }

        return $style;
    }
    /**
     * 
     * @param string $strCss
     * @return \Fuller\ReportBundle\Templating\Generator\PhpExcel\Reader\Html\Translator\StylePhpExcel
     */
    public function translate($strCss)
    {   
        

        $strCss = "element.style { $strCss }";
        
        $css = new CssParser();
        $css->ParseStr($strCss);

        $arr = $css->css;
        //return $arr['element.style'];
        // //print_r($arr['element.style']);
        // $styleAry = array();
        $stylePhpExcel = new StylePhpExcel();
        // foreach ($arr['element.style'] as $key => $rule) {
        //     //echo $key;
        //     // if (isset($this->dictionnary[$key])) 
        //     // {
        //         $styleAry = array_merge_recursive($styleAry,$this->convertRule($key,$rule));
        //     //}
        // };
        // //print_r($styleAry);

        $stylePhpExcel->setStyle( $arr['element.style']);

        return $stylePhpExcel;
    }

    protected function vAlign($rule)
    {
        $mValue = array(
            'top' => 'VERTICAL_TOP',
            'middle' => 'VERTICAL_CENTER',
            'bottom' => 'VERTICAL_BOTTOM',
            'phpexcel-justify' => 'VERTICAL_JUSTIFY',
        );

        $phpExcelStyleArray = array();
        switch (true) {
            case key_exists($rule, $mValue):
                $phpExcelStyleArray['alignment']['vertical'] = constant('\PHPExcel_Style_Alignment::' . $mValue[$rule]);
                break;

            default:
                $phpExcelStyleArray['alignment']['vertical'] = constant('\PHPExcel_Style_Alignment::' . $mValue['top']);
                break;
        }

        return $phpExcelStyleArray;
    }

    protected function numberFormatCode($rule)
    {
        $phpExcelStyleArray = array();
        $phpExcelStyleArray['numberformat']['code'] = $rule;

        return $phpExcelStyleArray;
    }

    protected function numberFormat($rule)
    {
        $mValue = array(
            'format_general' => 'FORMAT_GENERAL',
            'format_text' => 'FORMAT_TEXT',
            'format_number' => 'FORMAT_NUMBER',
            'format_number_00' => 'FORMAT_NUMBER_00',
            'format_number_comma_separated1' => 'FORMAT_NUMBER_COMMA_SEPARATED1',
            'format_number_comma_separated2' => 'FORMAT_NUMBER_COMMA_SEPARATED2',
            'format_percentage' => 'FORMAT_PERCENTAGE',
            'format_percentage_00' => 'FORMAT_PERCENTAGE_00',
            'format_date_yyyymmdd2' => 'FORMAT_DATE_YYYYMMDD2',
            'format_date_yyyymmdd' => 'FORMAT_DATE_YYYYMMDD',
            'format_date_ddmmyyyy' => 'FORMAT_DATE_DDMMYYYY',
            'format_date_dmyslash' => 'FORMAT_DATE_DMYSLASH',
            'format_date_dmyminus' => 'FORMAT_DATE_DMYMINUS',
            'format_date_dmminus' => 'FORMAT_DATE_DMMINUS',
            'format_date_myminus' => 'FORMAT_DATE_MYMINUS',
            'format_date_xlsx14' => 'FORMAT_DATE_XLSX14',
            'format_date_xlsx15' => 'FORMAT_DATE_XLSX15',
            'format_date_xlsx16' => 'FORMAT_DATE_XLSX16',
            'format_date_xlsx17' => 'FORMAT_DATE_XLSX17',
            'format_date_xlsx22' => 'FORMAT_DATE_XLSX22',
            'format_date_datetime' => 'FORMAT_DATE_DATETIME',
            'format_date_time1' => 'FORMAT_DATE_TIME1',
            'format_date_time2' => 'FORMAT_DATE_TIME2',
            'format_date_time3' => 'FORMAT_DATE_TIME3',
            'format_date_time4' => 'FORMAT_DATE_TIME4',
            'format_date_time5' => 'FORMAT_DATE_TIME5',
            'format_date_time6' => 'FORMAT_DATE_TIME6',
            'format_date_time7' => 'FORMAT_DATE_TIME7',
            'format_date_time8' => 'FORMAT_DATE_TIME8',
            'format_date_yyyymmddslash' => 'FORMAT_DATE_YYYYMMDDSLASH',
            'format_currency_usd_simple' => 'FORMAT_CURRENCY_USD_SIMPLE',
            'format_currency_usd' => 'FORMAT_CURRENCY_USD',
            'format_currency_eur_simple' => 'FORMAT_CURRENCY_EUR_SIMPLE',
        );

        $phpExcelStyleArray = array();
        switch (true) {
            case key_exists($rule, $mValue):
                $phpExcelStyleArray['numberformat']['format'] = constant('\PHPExcel_Style_NumberFormat::' . $mValue[strtolower($rule)]);
                break;
            default:
                $phpExcelStyleArray['numberformat']['format'] = constant('\PHPExcel_Style_NumberFormat::' . $mValue['format_general']);
                break;
        }

        return $phpExcelStyleArray;
    }

    protected function textIndent($rule)
    {
        $phpExcelStyleArray = array();
        $phpExcelStyleArray['alignment']['indent'] = (int)$rule/9;
        
        return $phpExcelStyleArray;
    }

}