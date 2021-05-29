<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Customers extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Customers';
		$this->content = 'customers'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Customers'];
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
		$data 	= $this->customers->getAllData($length, $start, $_cari)->result_array();
		$count 	= $this->customers->getAllData(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function insert() {

		// Input values
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$perusahaan = $this->input->post('perusahaan');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		// $status = $this->input->post('status');
		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->customers->insert($nama, $email, $perusahaan, $no_hp, $alamat);

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
		$email = $this->input->post('email');
		$perusahaan = $this->input->post('perusahaan');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		// $status = $this->input->post('status');
		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->customers->update($id, $nama, $email, $perusahaan, $no_hp, $alamat);

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

		$r = $this->customers->delete($id);

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
		$this->load->model('customersModel', 'customers');
		// cek session
		$this->sesion->cek_session();
	}
}