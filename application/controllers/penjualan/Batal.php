<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Batal extends Render_Controller {

	public function index() {
		// Page config:
		$this->title = 'Penjualan';
		$this->content = 'penjualan-batal'; 
		$this->plugins = ['datatables','formatrupiah'];
		$this->navigation = ['Penjualan'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		// if ($length == null) {
		// 	$length = 10;
		// }
		$data 	= $this->penjualan->getAllDataBatal($length, $start, $cari['value'])->result_array();
		$count 	= $this->penjualan->getAllDataBatal(null,null, $cari['value'])->num_rows();
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
		$this->load->model('penjualan/data_model', 'penjualan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}