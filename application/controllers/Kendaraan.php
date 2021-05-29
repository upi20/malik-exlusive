<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Kendaraan extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Kendaraan';
		$this->content = 'kendaraan'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Kendaraan'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');

		if(isset($cari['value'])){
			$_cari = $cari['value'];
		}else{
			$_cari = null;
		}
		$data 	= $this->kendaraan->getAllData($length, $start, $_cari)->result_array();
		$count 	= $this->kendaraan->getAllData(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function insert() {

		// Input values
		$jenis = $this->input->post('jenis');
		$merk = $this->input->post('merk');
		$plat_nomor = $this->input->post('plat_nomor');

		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->kendaraan->insert($jenis,$merk, $plat_nomor);

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
		$jenis = $this->input->post('jenis');
		$merk = $this->input->post('merk');
		$plat_nomor = $this->input->post('plat_nomor');
		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->kendaraan->update($id, $jenis, $merk, $plat_nomor);

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

		$r = $this->kendaraan->delete($id);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
	}

	public function cetak($id) {
		$get 	= $this->kendaraan->getAllDataCetak($id);
		$this->data['kendaraan'] = $get;
		$this->data['id'] = $id;
		// Page config:
		$this->title 	= 'Bon Kendaraan';
		$this->content 	= 'cetak-struk-bon'; 
		$this->plugins 	= ['datatables','formatrupiah'];
		$this->navigation = ['Kendaraan'];
		// Commit render:
		$this->render();
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
		$this->load->model('kendaraanModel', 'kendaraan');
		// cek session
		$this->sesion->cek_session();
	}
}