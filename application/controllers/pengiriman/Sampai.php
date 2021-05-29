<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Sampai extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengiriman - Sampai';
		$this->content = 'pengiriman-sampai'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Pengiriman'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');

		$data 	= $this->pengiriman->getAlldata($length, $start, $cari['value'])->result_array();
		$count 	= $this->pengiriman->getAlldata(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	private function output_json($data) {
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('pengiriman/sampai_model', 'pengiriman');
		// cek session
		$this->sesion->cek_session();
	}
}