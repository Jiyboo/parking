<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parking extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Parking';
		$this->load->model('model_parking');
		$this->load->model('model_category');
		$this->load->model('model_slots');
		$this->load->model('model_rates');
		$this->load->model('model_company');
	}

	public function index()
	{

		if(!in_array('viewParking', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$parking_data = $this->model_parking->getParkingData();
	
		$result = array();
		foreach ($parking_data as $k => $v) {
			$result[$k]['parking'] = $v;
			$category_data = $this->model_category->getCategoryData($v['vechile_cat_id']);
			$slot_data = $this->model_slots->getSlotData($v['slot_id']);
			$rate_data = $this->model_rates->getRateData($v['rate_id']);

			$result[$k]['category'] = $category_data;
			$result[$k]['slot'] = $slot_data;
			$result[$k]['rate'] = $rate_data;
		}

		$this->data['company_currency'] = $this->company_currency();
		$this->data['parking_data'] = $result;
		$this->render_template('parking/index', $this->data);
	}


	public function create()
	{
		if(!in_array('createParking', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('parking_slot', 'Slot', 'required');
		$this->form_validation->set_rules('vehicle_cat', 'Category', 'required');
		$this->form_validation->set_rules('vehicle_rate', 'Rate', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case

        	$parking_code = strtoupper('pa-'.substr(md5(uniqid(mt_rand(), true)), 0, 6));

        	$data = array(
        		'parking_code' => $parking_code,
        		'vechile_cat_id' => $this->input->post('vehicle_cat'),
        		'rate_id' => $this->input->post('vehicle_rate'),
        		'slot_id' => $this->input->post('parking_slot'),
        		'in_time' => strtotime('now'),
        		'paid_status' => 0
        	);

        	$create = $this->model_parking->create($data);
        	if($create == true) {

        		// now unavailable the slot
        		$slot_data = array(
        			'availability_status' => 1
        		);

        		$update_slot = $this->model_slots->updateSlotAvailability($slot_data, $this->input->post('parking_slot'));

        		if($create == true && $update_slot == true) {
        			$this->session->set_flashdata('success', 'Successfully created');
		    		redirect('parking', 'refresh');	
        		}
        		else {
        			$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('parking/create', 'refresh');
        		}
        		
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('parking/create', 'refresh');
        	}
        }
        else {
        	$vehicle_cat = $this->model_category->getActiveCategoryData();
        	
        	$this->data['vehicle_cat'] = $vehicle_cat;

        	$slots = $this->model_slots->getAvailableSlotData();
        	$this->data['slot_data'] = $slots;

			$this->render_template('parking/create', $this->data);
		}
	}

	public function edit($id = null)
	{
		if(!in_array('updateParking', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			$this->form_validation->set_rules('parking_slot', 'Slot', 'required');
			$this->form_validation->set_rules('vehicle_cat', 'Category', 'required');
			$this->form_validation->set_rules('vehicle_rate', 'Rate', 'required');

			if ($this->form_validation->run() == TRUE) {
            // true case
	        	$save_parking_data = $this->model_parking->getParkingData($id);
	        	$before_slot_id = $save_parking_data['slot_id'];

	        	// update the slot data
	        	$update_slot = array(
	        		'availability_status' => 1
	        	);
	        	$this->model_slots->updateSlotAvailability($update_slot, $before_slot_id);

	        	$data = array(
	        		'vechile_cat_id' => $this->input->post('vehicle_cat'),
	        		'rate_id' => $this->input->post('vehicle_rate'),
	        		'slot_id' => $this->input->post('parking_slot'),
	        	);

	        	$update_parking_data = $this->model_parking->edit($data, $id);
	        	if($update_parking_data == true) {

	        		// now unavailable the slot
	        		$slot_data = array(
	        			'availability_status' => 2
	        		);

	        		$update_slot = $this->model_slots->updateSlotAvailability($slot_data, $this->input->post('parking_slot'));

	        		if($update_parking_data == true && $update_slot == true) {
	        			$this->session->set_flashdata('success', 'Successfully created');
			    		redirect('parking/', 'refresh');	
	        		}
	        		else {
	        			$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('parking/create', 'refresh');
	        		}
	        		
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('parking/create', 'refresh');
	        	}
	        }
			else {
				$vehicle_cat = $this->model_category->getCategoryData();
	        	$this->data['vehicle_cat'] = $vehicle_cat;

	        	$slots = $this->model_slots->getAvailableSlotData();
	        	$this->data['slot_data'] = $slots;

	        	$save_parking_data = $this->model_parking->getParkingData($id);
	        	$this->data['save_parking_data'] = $save_parking_data;

	        	// used parking slot info
	        	$get_used_slot = $this->model_slots->getSlotData($save_parking_data['slot_id']);

	        	$get_used_rate = $this->model_rates->getCategoryRate($save_parking_data['vechile_cat_id']);

	        	$this->data['slot_data'][] = $get_used_slot;
	        	$this->data['get_used_rate_data'] = $get_used_rate;

	        	// echo "<pre>";
	        	// print_r($save_parking_data);
	        	// die;
	        	

				$this->render_template('parking/edit', $this->data);	
			}				
		}
		
	}

	public function delete($id = null)
	{
		if(!in_array('deleteParking', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {

				$delete = $this->model_parking->delete($id);
				if($delete == true) {
	        		$this->session->set_flashdata('success', 'Successfully removed');
	        		redirect('parking/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('error', 'Error occurred!!');
	        		redirect('parking/delete/'.$id, 'refresh');
	        	}	
			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('parking/delete', $this->data);	
			}	
			
			
		}	
	}

public function printInvoice($id)
{
    if (!in_array('viewParking', $this->permission)) {
        redirect('dashboard', 'refresh');
    }

    if ($id) {
        $this->load->library('ciqrcode'); // Panggil library QR Code

        $parking_data = $this->model_parking->getParkingData($id);
        $company_info = $this->model_company->getCompanyData(1);
        $vehicle_category = $this->model_category->getCategoryData($parking_data['vechile_cat_id']);
        $check_in_date = date("Y-m-d", $parking_data['in_time']);
        $check_in = date("h:i A", $parking_data['in_time']);
        $parking_code = $parking_data['parking_code'];

        // Konfigurasi QR Code
        $config['quality'] = true;
        $config['size'] = 256;
        $config['black'] = array(0, 0, 0);
        $config['white'] = array(255, 255, 255);
        $this->ciqrcode->initialize($config);

        $params['data'] = $parking_code;
        $params['level'] = 'H';
        $params['size'] = 5;
        $params['savename'] = FCPATH . 'assets/qrcode/temp_qr.png';

        $this->ciqrcode->generate($params);

        // Konversi QR Code ke base64
        $qr_base64 = base64_encode(file_get_contents(FCPATH . 'assets/qrcode/temp_qr.png'));
        $qr_src = 'data:image/png;base64,' . $qr_base64;

        // HTML untuk cetak kartu parkir dengan QR Code
        $html = '<html>
        <head>
            <title>Parking Slip</title>
            <style>
                @page { size: 80mm auto; margin: 5mm; }
                body { font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 10px; }
                .container { width: 100%; max-width: 80mm; margin: auto; padding: 10px; border: 2px solid #333; border-radius: 5px; }
                .company-info img { max-width: 50px; margin-bottom: 5px; }
                .company-name { font-size: 14px; font-weight: bold; }
                .company-address { font-size: 12px; margin-bottom: 8px; }
                .parking-slip { font-size: 16px; font-weight: bold; margin: 10px 0; border-bottom: 1px dashed #333; padding-bottom: 5px; }
                table { width: 100%; font-size: 12px; text-align: left; }
                table td { padding: 5px; }
                .note { font-size: 10px; font-style: italic; margin-top: 8px; }
                .footer-message { font-size: 10px; font-weight: bold; margin-top: 10px; }
                img.qrcode { width: 120px; height: 120px; display: block; margin: 10px auto; image-rendering: pixelated; }
            </style>
        </head>
        <body onload="setTimeout(() => { window.print(); }, 500);">
            <div class="container">
                <div class="company-info">
                    <img src="assets/images/logo.png" alt="Company Logo">
                    <div class="company-name">' . $company_info['name'] . '</div>
                    <div class="company-address">' . $company_info['address'] . '</div>
                </div>
                <div class="parking-slip">Parking Slip</div>
                <table>
                    <tr>
                        <td><strong>Date:</strong> ' . $check_in_date . '</td>
                        <td><strong>Time:</strong> ' . $check_in . '</td>
                    </tr>
                    <tr>
                        <td><strong>Vehicle Type:</strong> ' . ucwords($vehicle_category['name']) . '</td>
                        <td><strong>Parking No:</strong> ' . $parking_code . '</td>
                    </tr>
                </table>
                <br><br>
                <img class="qrcode" src="' . $qr_src . '" alt="QR Code">
                <div class="note">Simpan kartu parkir untuk bukti. Harap kunci ganda kendaraan Anda.</div>
                <div class="footer-message">' . $company_info['message'] . '</div>
            </div>
        </body>
        </html>';

        echo $html;
    }
}




	public function updatepayment() 
	{
		if(!in_array('updateParking', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$id = $this->input->post('parking_id');
		if($id) {
			// getting the parking data 
			$updatePayment = $this->model_parking->updatePayment($id, $this->input->post('payment_status'));
			if($updatePayment == true) {
    			$this->session->set_flashdata('success', 'Successfully updated');
	    		redirect('parking/', 'refresh');	
    		}
    		else {
    			$this->session->set_flashdata('payment_error', 'Error occurred!!');
        		redirect('parking/edit/'.$id, 'refresh');
    		}
		}
	}

	public function getCategoryRate($id) 
	{
		if($id) {
			$rate_data = $this->model_rates->getCategoryRate($id);
			$html = '';
			foreach ($rate_data as $k => $v) {
				$html .= '<option value="'.$v['id'].'">'.$v['rate_name'].'</option>';
			}
			
			echo json_encode($html);
		}
	}

}