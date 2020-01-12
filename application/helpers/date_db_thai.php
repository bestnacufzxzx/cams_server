<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('date_db_thai'))
{
	function date_db_thai($origDate)
	{
		$dic_month = ["","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
		$d = explode( '-', $origDate );
		$year = $d[0]+543;
		$month = (int)$d[1];
		$day = $d[2];
		$thai_month = $dic_month[$month];
        return $day." ".$thai_month." ".$year;
	}
}
