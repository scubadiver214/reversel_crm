<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */

/** Error reporting */
ini_set('memory_limit', '-1');
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
mysql_connect('localhost','root','');
mysql_select_db("pbexperiment");

  $campaignlist1=mysql_query("select * from bookingdetails");
		  $count =2;
		  while ($campaignlist = mysql_fetch_array($campaignlist1)) {
			  switch($$campaignlist['ctrl_status'])
			  {
				  case 1://All the Bookings from Archive Go here
				  break;
				  case 2://All the Bookings from Waiting Go here
				  break;
				  case 3://All the Bookings from In Process Go here
				  break;
				  case 4://All the Bookings from Completed Go here
				  break;
				  case 5://All the Bookings from On Hold Go here
				  break;
				  default://All the Bookings from Error Go here
				  break;
			  }
			  
			  
			  

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$count,$campaignlist['bookingdetails_id'] )
            ->setCellValue('B'.$count,$campaignlist['client_init'] )
            ->setCellValue('C'.$count,$campaignlist['client_name'] )
            ->setCellValue('D'.$count, $campaignlist['client_lname'])
			->setCellValue('E'.$count,$campaignlist['client_note'])
            ->setCellValue('F'.$count, $campaignlist['bookingdetails_join_date'])
            ->setCellValue('G'.$count,$campaignlist['bookingdetails_mobile_number'])
            ->setCellValue('H'.$count, $campaignlist['bookingdetails_address'])
			->setCellValue('I'.$count, $campaignlist['bookingdetails_city'])
            ->setCellValue('J'.$count,$campaignlist['bookingdetails_state'])
            ->setCellValue('K'.$count, $campaignlist['bookingdetails_zipcode'])
            ->setCellValue('L'.$count, $campaignlist['bookingdetails_servicedate'])
			->setCellValue('M'.$count, $campaignlist['bookingdetails_reqdocs'])
            ->setCellValue('N'.$count, $campaignlist['bookingdetails_consignment_No'])
            ->setCellValue('O'.$count, $campaignlist['bookingdetails_servicedate'])
            ->setCellValue('P'.$count, $campaignlist['booking_number_ofcases']);
			$count++;
		  }

/* Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');*/

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
