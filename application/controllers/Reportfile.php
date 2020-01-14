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

            // $months = array("","มกราคม ","กุมภาพันธ์ ","มีนาคม ","เมษายน ","พฤษภาคม ","มิถุนายน ","กรกฎาคม ","สิงหาคม ","กันยายน ","ตุลาคม ","พฤศจิกายน ","ธันวาคม ");
            // $index = 0;
            // for ($month=$start; $month <= $end ; $month++) { 

            //     $obj->setActiveSheetIndex($index)->getColumnDimension('A')->setWidth(10); 
            //     $obj->setActiveSheetIndex($index)->getColumnDimension('B')->setWidth(10); 
            //     $obj->setActiveSheetIndex($index)->getColumnDimension('C')->setWidth(10); 
            //     $obj->setActiveSheetIndex($index)->getColumnDimension('D')->setWidth(30);
        
            //     $obj->setActiveSheetIndex($index)
            //             ->setCellValue('A1', 'คาบ')->setCellValue('B1', 'อาคารเรียน')
            //             ->setCellValue('C1', 'สถานะเข้าเรียน')->setCellValue('D1', 'เปอร์เซ็นการเข้าเรียน');
                
            //     $data = $this->checknamestudent_model->posthistorydata($courseID, $studentID);
            //     $col = 2;
            //     foreach ($data as $key => $row) {
            //         $wqi = calculateWqi($row->val1, $row->val2, $row->val3, $row->val4, $row->val5, $row->val6, $row->val7, $row->val8);
            //         $obj->setActiveSheetIndex($index)
            //             ->setCellValue('A'.$col, $key+1)->setCellValue('B'.$col, $buildingName)
            //             ->setCellValue('C'.$col, $status)->setCellValue('N'.$col, $row->result);
            //         $col++;
            //     }

                // $obj->getActiveSheet()->setTitle($months[$month]);
                // if($month != $end){
                //     $obj->createSheet();
                // }
            //     $index++;
            // }

            
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