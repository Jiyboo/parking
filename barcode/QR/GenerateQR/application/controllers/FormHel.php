<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormHel extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Form Helper Page';
		$this->load->view('form', $data);
	}

}

/* End of file FormHel.php */
/* Location: ./application/controllers/FormHel.php */