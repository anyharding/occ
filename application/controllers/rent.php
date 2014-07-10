<?php

class Rent extends CI_Controller {

    private $limit = 20;

    function __construct() {
        parent::__construct();
        $this->load->model('rent_model');
        $this->load->model('household_model');
        $this->load->model('user_model');
        $this->load->model('house_model');
        $this->load->model('welcome_model', 'Welcome');
        $this->load->library('pagination');
        $this->load->library('Jquery_pagination');

        if ($this->session->userdata('role') <> 'poweruser') {
            $this->session->set_flashdata('message', "You don't have permission to access this page ");
            redirect('applicant/');
        }
        if ($this->session->userdata('visaDays')) {
            $this->session->unset_userdata('visaDays');
        }
        if ($this->session->userdata('day')) {
            $this->session->unset_userdata('day');
        }
    }

    function loginCheck($str) {
        if (!$this->session->userdata('userId')) {
            $this->session->set_userdata('returnURL', $str);
            redirect('welcome/login');
        }
    }

    public function index($worksite = 0, $old = "gold", $offset = 0) {
        $this->loginCheck("rent/index/" . $worksite);
        ob_start();
        $this->ajax_rent(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['worksites'] = $this->user_model->get_worksites();
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $data['title'] = "Rent Payment List";
        $this->template->load('front', 'rent/index', $data);
    }

    function ajax_rent($worksite = 0, $old = "gold", $offset = 0) {
        $config['base_url'] = site_url('rent/ajax_rent/' . $worksite . "/" . $old);
        $config['div'] = '#middle-content';
        $config['total_rows'] = $this->rent_model->countRent($worksite, $old);
        $config['loadingId'] = 'loading-image';
        $config['uri_segment'] = 5;
        if ($this->session->userdata('record') == '400') {
            $config['per_page'] = 400;
            $data['rents'] = $this->rent_model->rentListLatest($worksite, $config['per_page'], $offset, $old);
        } else {
            $config['per_page'] = $this->limit;
            $data['rents'] = $this->rent_model->rentList($worksite, $config['per_page'], $offset, $old);
        }
        if ($old == 'old') {
            $config['per_page'] = 140;
            $data['rents'] = $this->rent_model->rentList($worksite, $config['per_page'], $offset, $old);
        }
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Rent Payment List";
//         echo count($data['rents'])." ".$config['total_rows'];
        if ($old == 'gold')
            $this->load->view('rent/ajax_rent', $data);
        else
            $this->load->view('rent/ajax_rent_old', $data);
    }

    public function batchPayments($worksite = 0, $offset = 0) {
        $this->loginCheck("rent/index/" . $worksite);
        ob_start();
        $this->ajax_batchPayments(0);
        $initial_content = ob_get_contents();
        ob_end_clean();
        $data['worksites'] = $this->user_model->get_worksites();
        $data['ajax_content'] = $initial_content; //'<div class="login_btm" id="middle-content">' . $initial_content . '<div>';
        $data['title'] = "Rent Batch Payment List";
        $this->template->load('front', 'rent/batchPayments', $data);
    }

    function ajax_batchPayments($worksite = 0, $offset = 0) {
        $config['base_url'] = site_url('rent/ajax_batchPayments/' . $worksite . "/");
        $config['div'] = '#middle-content';
        $config['total_rows'] = $this->rent_model->countRent($worksite);
        $config['loadingId'] = 'loading-image';
        $config['uri_segment'] = 4;
        if ($this->session->userdata('record') == '400') {
            $config['per_page'] = 400;
            $data['rents'] = $this->rent_model->rentListLatest($worksite, $config['per_page'], $offset);
        } else {
            $config['per_page'] = $this->limit;
            $data['rents'] = $this->rent_model->rentList($worksite, $config['per_page'], $offset);
        }
//        echo count($data['rents'])." ".$config['total_rows'];
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Single Payment List";
        $this->load->view('rent/ajax_batchPayments', $data);
    }

    function ajax_batchPaymentsBatch($worksite = 0, $offset = 0) {
        $config['base_url'] = site_url('rent/ajax_batchPaymentsBatch/' . $worksite . "/");
        $config['div'] = '#middle-content';
        $config['total_rows'] = $this->rent_model->countRentBatch($worksite);
        $config['loadingId'] = 'loading-image';
        $config['uri_segment'] = 4;
        $config['per_page'] = NULL;
        $data['rents'] = $this->rent_model->rentListBatch($worksite, $config['per_page'], $offset);
        
        $this->jquery_pagination->initialize($config);
        $data['title'] = "Batch Payment List";
        $this->load->view('rent/ajax_batchPaymentsBatch', $data);
    }

    function paidstatus() {

        $rent_id = $this->input->post('check');
        foreach ($rent_id as $key => $val) {
            $this->rent_model->editRent(array('paid' => 'yes'), $val);
        }
        $this->session->set_flashdata('smessage', 'Selected rent payments successfully updated to paid.');
        redirect('rent');
    }

    public function generateExcelFile() {
//        print_r($_POST['house_id']);die;
        $rent_id = $this->input->post('check');
        $houses_id = $this->input->post('house_id');
//        $amounts = $this->input->post('amount');
        $amounts = array();
        $paid = $this->input->post('paid') ? 1 : 0;
        foreach ($rent_id as $key => $val) {
            $rent_detail = $this->rent_model->rentDetail($val, $paid);
            if (!empty($rent_detail)) {
                $amounts[] = $rent_detail[0]['amount'];
            }
        }

        $this->load->helper('download');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                ->setDescription("description");

        $objPHPExcel->getSheet(0)->setTitle('Rent Batch Payment');
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Rent Payment Transfer List ');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 18,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );

        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $styleArray = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '4F81BD'),
                ),
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Rent Payment Date');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', date('M d, Y'));
        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Total Number of houses');
        $check = array();
        foreach ($rent_id as $key => $val) {
            $rent_detail = $this->rent_model->rentDetail($val, $paid);
            if (!empty($rent_detail))
                $check[] = $rent_detail[0]['house_id'];
            $check = array_unique($check);
        }
        $objPHPExcel->getActiveSheet()->setCellValue('B4', count($check));

        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Batch Payment ID');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 1);

        $objPHPExcel->getActiveSheet()->setCellValue('A6', 'Total Payments');
        $objPHPExcel->getActiveSheet()->setCellValue('B6', "$" . number_format(array_sum($amounts), 2));
        $array = array(
            'name' => 'Calibri',
            'bold' => true,
            'size' => 11,
            'italic' => false,
            'color' => array(
                'rgb' => '1F4981'
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A4:B4')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A6:B6')->getFont()->applyFromArray($array);


        $objPHPExcel->getActiveSheet()->setCellValue('A9', "Realtor Company Name");
        $objPHPExcel->getActiveSheet()->setCellValue('B9', "Bank");
        $objPHPExcel->getActiveSheet()->setCellValue('C9', "Acc Number");
        $objPHPExcel->getActiveSheet()->setCellValue('D9', "BSB");
        $objPHPExcel->getActiveSheet()->setCellValue('E9', "Net Rent");
        $objPHPExcel->getActiveSheet()->setCellValue('G9', "House Address");

        $objPHPExcel->getActiveSheet()->getStyle('A9:G9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $styleArray = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '95B3D7'),
                ),
            ),
        );

        $objPHPExcel->getActiveSheet()->getStyle('A9:E9')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('G9:G9')->applyFromArray($styleArray);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(2);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(37);

        $objPHPExcel->getActiveSheet()->getStyle('A9:E9')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 12,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );
        $objPHPExcel->getActiveSheet()->getStyle('G9:G9')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 12,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );

        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
//        $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(20);
        $i = 9;
        foreach ($rent_id as $key => $val) {
            $rent_detail = $this->rent_model->rentDetail($val, $paid);
            if (!empty($rent_detail)) {
                $row = $this->rent_model->house_detail($rent_detail[0]['house_id']);
                $i +=1;

                $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(27);
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, ($row[0]->company_name ? " " . $row[0]->company_name : "N/A"));
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, ($row[0]->realtor_bank ? $row[0]->realtor_bank : "N/A"));
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, ($row[0]->realtor_account ? $row[0]->realtor_account : "N/A"));
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, ($row[0]->realtor_account_bsb ? $row[0]->realtor_account_bsb : "N/A"));
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, ($amounts[$key] ? "$" . number_format($amounts[$key], 2) : "N/A"));
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, ($row[0]->address ? $row[0]->address : "N/A"));
                $styleArray0 = array(
                    'borders' => array(
                        'right' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        ),
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'DCE6F2')
                    )
                );
                $styleArray = array(
                    'borders' => array(
                        'right' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        ),
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'B9CDE5')
                    )
                );
                $styleArray_left = array(
                    'borders' => array(
                        'left' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        ),
                    )
                );
                $styleArray1 = array(
                    'borders' => array(
                        'bottom' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array('argb' => '000000'),
                        ),
                    ),
                );

                if ($i % 2 == 0) {
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray0);
                    $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray0);
                    $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray0);
                    $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray0);
                    $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray0);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray0);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray_left);
                } else {
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray_left);
                }

                if (count($rent_id) == ($i - 9)) {
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray1);
                    $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray1);
                    $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray1);
                    $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray1);
                    $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray1);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray1);
                }
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue('D' . ($i + 2), "Total");
        $objPHPExcel->getActiveSheet()->setCellValue('G' . ($i + 2), "$" . number_format(array_sum($amounts), 2));

        $styleArray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '4F81BD')
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('D' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('F' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getRowDimension($i + 2)->setRowHeight(25);

        $filename = $this->hideSpecialChar("rent_batch_payment") . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("php://output");
    }

    public function generateExcelFileBatch() {
//        echo "<pre>";
//        print_r($_POST);
        $rent_id = $this->input->post('check');
        $houses_id = $this->input->post('house_id');
        $amounts = $this->input->post('amount');
        $due_date = $this->input->post('due_date');

//        $amounts = array();
        foreach ($rent_id as $key => $val) {
            $due_date_select = $due_date[$val][0];
            $amount_select = $amounts[$val][0];
            $data_update = array(
                'amount' => $amount_select,
                'payment_due_date' => $due_date_select
            );
            $this->rent_model->editRent($data_update, $val);
        }


        $amounts = array();
        foreach ($rent_id as $key => $val) {
            $rent_detail = $this->rent_model->rentDetail($val);
            $amounts[] = $rent_detail[0]['amount'];
        }
//        die;
        $this->load->helper('download');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                ->setDescription("description");

        $objPHPExcel->getSheet(0)->setTitle('Rent Batch Payment');
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Rent Payment Transfer List ');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 18,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );

        $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $styleArray = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => '4F81BD'),
                ),
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Rent Payment Date');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', date('M d, Y'));
        $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Total Number of houses');

        $check = array();
        foreach ($rent_id as $key => $val) {
            $rent_detail = $this->rent_model->rentDetail($val);
            $check[] = $rent_detail[0]['house_id'];
            $check = array_unique($check);
        }
        $objPHPExcel->getActiveSheet()->setCellValue('B4', count($check));

        $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Batch Payment ID');
        $objPHPExcel->getActiveSheet()->setCellValue('B5', 1);

        $objPHPExcel->getActiveSheet()->setCellValue('A6', 'Total Payments');
        $objPHPExcel->getActiveSheet()->setCellValue('B6', "$" . number_format(array_sum($amounts), 2));
        $array = array(
            'name' => 'Calibri',
            'bold' => true,
            'size' => 11,
            'italic' => false,
            'color' => array(
                'rgb' => '1F4981'
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A4:B4')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A5:B5')->getFont()->applyFromArray($array);

        $objPHPExcel->getActiveSheet()->getStyle('A6:B6')->getFont()->applyFromArray($array);


        $objPHPExcel->getActiveSheet()->setCellValue('A9', "Realtor Company Name");
        $objPHPExcel->getActiveSheet()->setCellValue('B9', "Bank");
        $objPHPExcel->getActiveSheet()->setCellValue('C9', "Acc Number");
        $objPHPExcel->getActiveSheet()->setCellValue('D9', "BSB");
        $objPHPExcel->getActiveSheet()->setCellValue('E9', "Net Rent");
        $objPHPExcel->getActiveSheet()->setCellValue('G9', "House Address");

        $objPHPExcel->getActiveSheet()->getStyle('A9:G9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B4:B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle('B5:B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $styleArray = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '95B3D7'),
                ),
            ),
        );

        $objPHPExcel->getActiveSheet()->getStyle('A9:E9')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('G9:G9')->applyFromArray($styleArray);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(2);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(37);

        $objPHPExcel->getActiveSheet()->getStyle('A9:E9')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 12,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );
        $objPHPExcel->getActiveSheet()->getStyle('G9:G9')->getFont()->applyFromArray(
                array(
                    'name' => 'Calibri',
                    'bold' => true,
                    'size' => 12,
                    'italic' => false,
                    'color' => array(
                        'rgb' => '1F4981'
                    )
                )
        );

        $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);
//        $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(20);
        $i = 9;
        foreach ($rent_id as $key => $val) {
            $rent_detail = $this->rent_model->rentDetail($val);
            $row = $this->rent_model->house_detail($rent_detail[0]['house_id']);
            $i +=1;

            $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(27);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, ($row[0]->company_name ? " " . $row[0]->company_name : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, ($row[0]->realtor_bank ? $row[0]->realtor_bank : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, ($row[0]->realtor_account ? $row[0]->realtor_account : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, ($row[0]->realtor_account_bsb ? $row[0]->realtor_account_bsb : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, ($amounts[$key] ? "$" . number_format($amounts[$key], 2) : "N/A"));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, ($row[0]->address ? $row[0]->address : "N/A"));
            $styleArray0 = array(
                'borders' => array(
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'DCE6F2')
                )
            );
            $styleArray = array(
                'borders' => array(
                    'right' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'B9CDE5')
                )
            );
            $styleArray_left = array(
                'borders' => array(
                    'left' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                )
            );
            $styleArray1 = array(
                'borders' => array(
                    'bottom' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
            );

            if ($i % 2 == 0) {
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray0);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray_left);
            } else {
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray_left);
            }

            if (count($rent_id) == ($i - 9)) {
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('B' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('C' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->applyFromArray($styleArray1);
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue('D' . ($i + 2), "Total");
        $objPHPExcel->getActiveSheet()->setCellValue('G' . ($i + 2), "$" . number_format(array_sum($amounts), 2));

        $styleArray = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '4F81BD')
            )
        );
        $objPHPExcel->getActiveSheet()->getStyle('D' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('E' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('F' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('G' . ($i + 2))->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getRowDimension($i + 2)->setRowHeight(25);

        $filename = $this->hideSpecialChar("rent_batch_payment") . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("php://output");
    }

    public function most200($worksite = 0) {
        $this->session->set_userdata('record', '400');
        $this->ajax_rent($worksite);
    }

    public function hideSpecialChar($string) {
        $old_pattern = array("/[^a-zA-Z0-9]/", "/_+/", "/_$/");
        $new_pattern = array("_", "_", "");
        return strtolower(preg_replace($old_pattern, $new_pattern, $string));
    }

    public function revertMost200($worksite = 0) {
        $this->session->unset_userdata('record');
        $this->ajax_rent($worksite);
    }

    public function addRent() {
        $this->loginCheck("rent/addRent/");
        $redirect = '/rent/';
        $data['get_worksite'] = $this->rent_model->get_worksites();
        $data['get_houses'] = $this->household_model->get_houses();
        $data['users'] = $this->rent_model->get_users();
        $data['title'] = "Add Rent Payment";

        $this->form_validation->set_rules('house', 'Select House', 'trim|required');
        $this->form_validation->set_rules('amount', 'Payment Amount', 'trim|required|numeric');
        // $this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required');
        //$this->form_validation->set_rules('due_date', 'Rent Due Date', 'trim|required');
        $this->form_validation->set_rules('paid', 'Paid', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'rent/addRent', $data);
        } else {
            $house = $this->input->post('house');
            $amount = $this->input->post('amount');
            $payment_date = $this->input->post('payment_date');
            $due_date = $this->input->post('due_date');

            $data = array(
                'house_id' => $house,
                'amount' => $amount,
                'payment_date' => $payment_date,
                'payment_due_date' => $due_date,
                'paid' => $this->input->post('paid'),
                'created' => time(),
                'status' => '1'
            );
            $data1 = array(
                'payment_date' => $payment_date,
            );
            $house_status = $this->user_model->getHouseStatus($house);
            if ($house_status == '0') {
                $data1['rent_due_date'] = $this->user_model->calculaterentDueDate($payment_date, $house);
            }
            if ($house_status == '1') {
                $data1['rent_due_date'] = $due_date;
            }
            $this->rent_model->rentRegistration($data);
            $this->house_model->edithouse($data1, $house);
            $this->session->set_flashdata('smessage', 'Rent Successfully added');
            redirect($redirect);
        }
    }

    public function editRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("rent/editRent/" . $id);
        $data['users'] = $this->rent_model->get_users();
        $edit_rent = $this->rent_model->rentDetail($id);
        $data['get_worksite'] = $this->rent_model->get_worksites();
        $data['get_houses'] = $this->household_model->get_houses();
        $data['edit_rent'] = $edit_rent;
        $data['title'] = "Edit Rent Payment";
        //print_r($house_detail);
//        $this->form_validation->set_rules('house', 'Select House', 'trim|required');
        $this->form_validation->set_rules('amount', 'Payment Amount', 'trim|required|numeric');
        $this->form_validation->set_rules('payment_date', 'Payment Date', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('front', 'rent/editRent', $data);
        } else {
            $house = $this->input->post('house');
            $amount = $this->input->post('amount');
            $payment_date = $this->input->post('payment_date');
            $due_date = $this->input->post('due_date');
            $due_date = $this->input->post('due_date');
            $data = array(
                'amount' => $amount,
                'payment_date' => $payment_date,
                'payment_due_date' => $due_date,
                'created' => time(),
                'paid' => $this->input->post('paid'),
                'status' => '1'
            );
            $this->rent_model->editRent($data, $id);
            $this->session->set_flashdata('smessage', 'Rent Successfully updated');
            redirect('/rent/index/');
        }
    }

    public function deleteRent() {
        $id = $this->uri->segment(3);
        $this->loginCheck("rent/deleteRent/" . $id);
//            $worksite_detail = $this->rent_model->worksiteDetail($id);
//            if(file_exists('worksite_images/'.$worksite_detail[0]['image'])){
//                unlink('worksite_images/'.$worksite_detail[0]['image']);}
        $this->rent_model->deleteRent($id);
        $this->session->set_flashdata('smessage', 'Rent Successfully deleted');
        redirect('/rent/');
    }

    public function activateallRent() {
        $id = $this->uri->segment(3);
        $this->rent_model->activateRent($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/rent/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->rent_model->activateRent($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Rents successfully activated');
        redirect('/rent/');
    }

    public function deactivateallRent() {
        $id = $this->uri->segment(3);
        $this->rent_model->activateRent($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/rent/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->rent_model->deactivateRent($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Rents successfully deactivated');
        redirect('/rent/');
    }

    public function deleteallRent() {
        $id = $this->uri->segment(3);
        $this->rent_model->activateRent($id);
        $checked = $this->input->post('check');
        if (empty($checked)) {
            $this->session->set_flashdata('message', 'Please select atleast one Worksite');
            redirect('/rent/');
        } else {
            for ($i = 0; $i < count($checked); $i++)
                $this->rent_model->deleteRent($checked[$i]);
        }
        $this->session->set_flashdata('smessage', 'Selected Rents successfully deleted');
        redirect('/rent/');
    }

    public function deactivateRent() {
        $id = $this->uri->segment(3);
        $this->rent_model->deactivateRent($id);
        $this->session->set_flashdata('smessage', 'Rent successfully deactivated');
        redirect('/rent/');
    }

    public function activateRent() {
        $id = $this->uri->segment(3);
        $this->rent_model->activateRent($id);
        $this->session->set_flashdata('smessage', 'Rent successfully activated');
        redirect('/rent/');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
