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
            $number = $this->checknamestudent_model->totalPassCheckName($courseID, $studentID);
            $numberLateClass = $this->checknamestudent_model->totalPassCheckName_LateClass($courseID, $studentID);
            $numberMissClass = $this->checknamestudent_model->totalPassCheckName_MissClass($courseID, $studentID);
            $total = $this->checknamestudent_model->totalCheckNameByClass($courseID);

            $getname = $this->checknamestudent_model->getnamebystudentidmodle($studentID);
            foreach ($getname as $i => $v) {
                $prefix = $v->prefix;
                $fname = $v->firstName;
                $lname = $v->lastName;
            }
            
            $fullname = [
                'prefix' => $prefix,
                'fname' => $fname,
                'lname' => $lname
            ];

            $prefix = $fullname['prefix'];
            $fname = $fullname['fname'];
            $lname = $fullname['lname'];
            $fullnames = $fname.$lname;
            // $fullnames = [$prefix," ",$fname," ",$lname];

            // $percent = round(($number*100/$total),2);
            // $percentLateClass = round(($numberLateClass*100/$total),2);
            // // 'percentMissClass' => round((($total-($numberMissClass+$numberLateClass))*100)/$total,2),
            // $percentMissClass = round((100-(($total-($numberMissClass+$numberLateClass))*100)/$total));
            // $remainMissClass = round($total-(($total*80)/100));
            // $remain = round(($total-(($total*80)/100))-$numberMissClass);

            $number = $number;
            $percent = round(($number*100/$total),2);
            $percentLateClass = round(($numberLateClass*100/$total),2);
            // 'percentMissClass' = round((($total-($numberMissClass+$numberLateClass))*100)/$total,2),
            $percentMissClass = round((($numberMissClass*100)/$total),2);
            // 'percentMissClass' = round((100-(($total-($numberMissClass+$numberLateClass))*100)/$total),2),
            $remainMissClass = round($total-(($total*80)/100));
            $remain = round(($total-(($total*80)/100))-$numberMissClass);
            // 'remain' = (round(($total-(($total*80)/100))-$numberMissClass) > 0) ? round(($total-(($total*80)/100))-$numberMissClass) : 0,
            $total = $total;
            $perce = '%';

            $obj->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(10); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(30); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(10); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(25); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(20); 
            $obj->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(15); 
    
            $obj->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'ชื่อวิชา')->setCellValue('B1', 'รหัสวิชา')
                    ->setCellValue('C1', 'รหัสนักศึกษา')->setCellValue('D1', 'ชื่อนักศึกษา')
                    ->setCellValue('E1', 'วันที่')->setCellValue('F1', 'คาบเรียน')
                    ->setCellValue('G1', 'สถานะ');

            $col = 2;


            foreach ($result as $i => $v) {
                if($v->status == 1 ){
                    $statusset = "เข้าเรียน";
                }else if($v->status == 2){
                    $statusset = "เข้าเรียนสาย";
                }else{
                    $statusset = "ไม่เข้าเรียนสาย";
                }
                $obj->setActiveSheetIndex(0)
                        ->setCellValue('A'.$col, $v->courseCode)->setCellValue('B'.$col, $v->courseName)
                        ->setCellValue('C'.$col, $studentID)->setCellValue('D'.$col, $fullnames)
                        ->setCellValue('E'.$col,  date_format(date_create($v->datetime), 'd/m/Y'))
                        ->setCellValue('F'.$col, $i+1)->setCellValue('G'.$col, $statusset);
                $col++;
            }

            $obj->setActiveSheetIndex(0)
                    ->setCellValue('E'.($col+1), 'จำนวนที่เข้าเรียน')->setCellValue('F'.($col+1), $number)
                    ->setCellValue('E'.($col+2), 'จำนวนคาบทั้งหมด')->setCellValue('F'.($col+2), $total)
                    ->setCellValue('E'.($col+3), 'เปอร์เซ็นการเข้าเรียน')->setCellValue('F'.($col+3), $percent.$perce)
                    ->setCellValue('E'.($col+4), 'เปอร์เซ็นการเข้าเรียนสาย')->setCellValue('F'.($col+4), $percentLateClass.$perce)
                    ->setCellValue('E'.($col+5), 'เปอร์เซ็นการขาดเรียน')->setCellValue('F'.($col+5), $percentMissClass.$perce)
                    ;
            
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