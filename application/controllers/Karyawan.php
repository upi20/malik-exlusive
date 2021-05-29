<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Karyawan extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Karyawan';
		$this->content = 'karyawan'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Karyawan'];
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
		$data 	= $this->karyawan->getAllData($length, $start, $_cari)->result_array();
		$count 	= $this->karyawan->getAllData(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function insert() {

		// Input values
		$nama = $this->input->post('nama');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		$driver = $this->input->post('driver');

		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->karyawan->insert($nama,$no_hp, $alamat, $driver);

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
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		$driver = $this->input->post('driver');

		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->karyawan->update($id, $nama, $no_hp, $alamat, $driver);

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

		$r = $this->karyawan->delete($id);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
	}

	public function hutang() {

		// Input values
		$id = $this->input->post('id');
		$jumlah = $this->input->post('jumlah');

		// Check values
		$r = $this->karyawan->hutang($id, $jumlah);
		$this->output_json(
				[
					'id' => $id,
				]
			);
	}

	public function bayar() {

		// Input values
		$id = $this->input->post('id');
		$jumlah = $this->input->post('jumlah');

		// Check values
		$r = $this->karyawan->bayar($id, $jumlah);
		$this->output_json(
				[
					'id' => $id,
				]
			);
	}

	public function cetak($id) {
		$get 	= $this->karyawan->getAllDataCetak($id);
		$this->data['karyawan'] = $get;
		$this->data['id'] = $id;
		// Page config:
		$this->title 	= 'Bon Karyawan';
		$this->content 	= 'cetak-struk-bon'; 
		$this->plugins 	= ['datatables','formatrupiah'];
		$this->navigation = ['Karyawan'];
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
		$this->load->model('karyawanModel', 'karyawan');
		// cek session
		$this->sesion->cek_session();
	}
}