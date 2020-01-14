<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Reportfile extends BaseController {
    
    function __construct(){
        parent::__construct();
        $this->load->model('checknamestudent_model');

    }

    function export($courseID = null , $studentID = null){

        if(!empty($courseID) && !empty($studentID)){
            $courseID = $courseID;
            $studentID = $studentID;
            $this->load->library('excel');
            $obj = new PHPExcel();
            $obj->getDefaultStyle()->getFont()->setName('Angsana New');
            $obj->getDefaultStyle()->getFont()->setSize(14);

            $result = $this->checknamestudent_model->posthistorydata($courseID, $studentID);
            $obj->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(10); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(10); 
    
            $obj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'คาบ')->setCellValue('B1', 'อาคารเรียน')
                    ->setCellValue('C1', 'สถานะเข้าเรียน');

            $col = 2;
            foreach ($result as $i => $v) {
                $obj->setActiveSheetIndex(0)
                        ->setCellValue('A'.$col, $i+1)->setCellValue('B'.$col, $v->buildingName)
                        ->setCellValue('C'.$col, $v->status);
                $col++;
            }

            
            $obj->setActiveSheetIndex(0);

            header("last-modefied: ".gmdate("D, d M Y H:i:s"));
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="checkname_'.$studentID.'.xlsx"');

            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
            $objWriter->save('php://output');
        }
    }


    
}