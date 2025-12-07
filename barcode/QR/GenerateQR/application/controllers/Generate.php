<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {

	public function index()
	{
		$this->load->library('ciqrcode'); //untuk pemanggilan library qrcode

		$config['cacheable'] = true;
		$config['cachedir'] = './assets';
		$config['errorlog'] = './assets';
		$config['imagedir'] = './assets/QRCODE/'; //penyimpaan qrcode
		$config['quality'] = true; //boolean true/false
		$config['size'] = '1024';
		$config['black'] = array(224,255,255);
		$config['white'] = array(70,130,180);

		$this->ciqrcode->initialize($config);

		$image_name = random_string('alnum', 16).'.png'; //untuk memberi nama pada qrcode
		$params['data'] = random_string('alnum', 16); //untuk data pada qrcode
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //untuk simpan gambar di directory assets/qrcode
		$this->ciqrcode->generate($params);

		$data['title'] = 'Halaman Generate';
		$data['img'] = $image_name;
		$this->load->view('generate', $data);

	}

}

/* End of file Generate.php */
/* Location: ./application/controllers/Generate.php */