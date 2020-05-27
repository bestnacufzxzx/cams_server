<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class ReportfileTe extends BaseController {
    
    function __construct(){
        parent::__construct();
        $this->load->model('checknamestudent_model');
        $this->load->model('lecturers_model');

    }

    function export($courseID = null){

        if(!empty($courseID)){
            $courseID = $courseID;
            $this->load->library('excel');
            $obj = new PHPExcel();
            $obj->getDefaultStyle()->getFont()->setName('Angsana New');
            $obj->getDefaultStyle()->getFont()->setSize(14);


            $AtoZ = $this->getA_Zarray();
            $result = [];
            $schedule = [];
            $schedule = $this->get_couresbyclass($courseID);
            $student = $this->get_studentsincoures($courseID);
            $studentRatting = [];

            foreach ($student as $key => $v) {
                $studentRatting[$v->studentID] = $this->get_idstudentandcoures($courseID, $v->studentID);
            }
            $checkArray = [];
            foreach ($student as $key => $v) {
                $checkArray[$v->studentID] = $this->receive_idstudentandcouresgetclassteaching($courseID, $v->studentID);
            }
            $result['student'] = $student;


        
            $obj->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(10); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(10); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(23); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(8); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(8); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(8); 

            $obj->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(8); 
    
            $obj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ชื่อวิชา')
                    ->setCellValue('B1', 'รหัสวิชา')
                    ->setCellValue('C1', 'รหัสนักศึกษา')
                    ->setCellValue('D1', 'ชื่อนักศึกษา')
                    ->setCellValue('E1', 'เข้าเรียน')
                    ->setCellValue('F1', 'มาสาย')
                    ->setCellValue('G1', 'ขาดเรียน')
                    // ->setCellValue('H1', 'ค 1')
                    // ->setCellValue('E1', 'สถานะ')->setCellValue('F1', 'วันที่')
                    // ->setCellValue('G1', 'คาบเรียน')
                    ;

            $col = 2;


            foreach ($student as $i => $v) {
                $obj->setActiveSheetIndex(0)
                        ->setCellValue('A'.$col, $v->courseCode)
                        ->setCellValue('B'.$col, $v->courseName)
                        ->setCellValue('C'.$col, $v->studentID)
                        ->setCellValue('D'.$col, $v->prefix." ".$v->firstName." ".$v->lastName)
                        // ->setCellValue('E'.$col,  date_format(date_create($v->datetime), 'd/m/Y'))
                        // ->setCellValue('F'.$col, $i+1)
                        // ->setCellValue('G'.$col, $statusset)
                        ;

                $col++;
            };

            $col = 2;
            foreach ($studentRatting as $i => $v) {
                $percentattendclass = $v["percentattendclass"];
                $percentLateClass = $v["percentLateClass"];
                $percentMissClass = $v["percentMissClass"];
                $obj->setActiveSheetIndex(0)
                    ->setCellValue('E'.$col, $percentattendclass."%")
                    ->setCellValue('F'.$col, $percentLateClass."%")
                    ->setCellValue('G'.$col, $percentMissClass."%")
                ;
                $col++;

            };


            $col = 2;
            foreach ($checkArray as $i => $v) {
                foreach ($v as $i => $e) {
                    $statusstudent = $e->status;
                    if($statusstudent == NULL){
                        $st = "ไม่เข้าเรียน";
                    }else if ($statusstudent == 2){
                        $st = "เข้าเรียนสาย";
                    }else{
                        $st = "เข้าเรียน";
                    }
                }
                // foreach ($AtoZ as $i => $v) {
                //     if($i <= 25){
                //         $obj->setActiveSheetIndex(0)
                //             ->setCellValue($v.$col, $st)
                //         ;
                //     }
                // }
                $col++;
            }

            // foreach ($result as $i => $v) {
            //     if($v->status == 1 ){
            //         $statusset = "เข้าเรียน";
            //     }else if($v->status == 2){
            //         $statusset = "เข้าเรียนสาย";
            //     }else{
            //         $statusset = "ไม่เข้าเรียนสาย";
            //     }
                // $obj->setActiveSheetIndex(0)
                //         ->setCellValue('A'.$col, $v->courseCode)->setCellValue('B'.$col, $v->courseName)
                //         ->setCellValue('C'.$col, $studentID)->setCellValue('D'.$col, $fullnames)
                //         ->setCellValue('E'.$col,  date_format(date_create($v->datetime), 'd/m/Y'))
                //         ->setCellValue('F'.$col, $i+1)->setCellValue('G'.$col, $statusset);
                // $col++;
            // }

            // $obj->setActiveSheetIndex(0)
            //         ->setCellValue('E'.($col+1), 'จำนวนที่เข้าเรียน')
                    // ->setCellValue('F'.($col+1), $number)
                    // ->setCellValue('E'.($col+2), 'จำนวนคาบทั้งหมด')->setCellValue('F'.($col+2), $total)
                    // ->setCellValue('E'.($col+3), 'เปอร์เซ็นการเข้าเรียน')->setCellValue('F'.($col+3), $percent.$perce)
                    // ->setCellValue('E'.($col+4), 'เปอร์เซ็นการเข้าเรียนสาย')->setCellValue('F'.($col+4), $percentLateClass.$perce)
                    // ->setCellValue('E'.($col+5), 'เปอร์เซ็นการขาดเรียน')->setCellValue('F'.($col+5), $percentMissClass.$perce)
                    // ;
            
            // $obj->setActiveSheetIndex(0);

            header("last-modefied: ".gmdate("D, d M Y H:i:s"));
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="checkname_'."สรุปการเข้าเรียนของนักศึกษา".'.xlsx"');

            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
            $objWriter->save('php://output');
        }
    }

    // starttime 20/5/62
    // รับค่า id นักศึกษา กับรายวิชา => เข้าเรียน มาสาย ขาดเรียน
    function get_idstudentandcoures($courseID,$studentID){
        // $courseID = $this->get("courseID");
        // $studentID = $this->get("studentID");
        $number = $this->checknamestudent_model->totalPassCheckName($courseID, $studentID);
        $numberLateClass = $this->checknamestudent_model->totalPassCheckName_LateClass($courseID, $studentID);
        $numberMissClass = $this->checknamestudent_model->totalPassCheckName_MissClass($courseID, $studentID);
        $total = $this->checknamestudent_model->totalCheckNameByClass($courseID);
        $percent = [
            'percentattendclass' => round(($number*100/$total),2),
            'percentLateClass' => round(($numberLateClass*100/$total),2),
            'percentMissClass' => round((($numberMissClass*100)/$total),2),
        ];
        return $percent;
    }

    function receive_idstudentandcouresgetclassteaching($courseID,$studentID){
        $result = $this->lecturers_model->receive_idstudentandcouresgetclassteaching_model($courseID,$studentID);
        return $result;
    }

    function get_studentsincoures($courseID){
        $result = $this->lecturers_model->get_studentsincoures_model($courseID);
        return $result;
    }
    function get_couresbyclass($courseID){
        $result = $this->lecturers_model->get_couresbyclass_model($courseID);
        return $result;
    }

    function getA_Zarray(){
        $alphabets = range('H', 'Z');
        $doubleAlphabets = array();
        $count = 0;
        foreach($alphabets as $key => $alphabet)
        {
            $count++;
            $letter = $alphabet;
            while ($letter <= 'Z') 
            {
                $doubleAlphabets[] = $letter;

                ++$letter;
            }
        }
        return $doubleAlphabets;
    }
    // endtime
    
}