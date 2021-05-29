<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class SumberPenjualan extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Referensi - Sumber Penjualan';
		$this->content = 'referensi-sumber-penjualan'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Referensi'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');

		$data 	= $this->sumberPenjualan->getAlldata($length, $start, $cari['value'])->result_array();
		$count 	= $this->sumberPenjualan->getAlldata(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');

		// Check values
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->sumberPenjualan->insert($nama, $jenis);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function update() {

		// Input values
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');

		// Check values
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->sumberPenjualan->update($id, $nama, $jenis);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $r,
				]
			);
		}
	}

	public function delete() {

		$id = $this->input->post('id');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->sumberPenjualan->delete($id);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
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
		$this->load->model('referensi/sumberPenjualan_model', 'sumberPenjualan');
		// cek session
		$this->sesion->cek_session();
	}
}