<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Supplier extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Supplier';
		if($this->session->userdata('data')['level'] == 'Manager'){
			
			$this->content = 'referensi-supplier-manager'; 
		}else{
			$this->content = 'referensi-supplier'; 
		}
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

		if(isset($cari['value'])){
			$_cari = $cari['value'];
		}else{
			$_cari = null;
		}
		$data 	= $this->supplier->getAllData($length, $start, $_cari)->result_array();
		$count 	= $this->supplier->getAllData(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function insert() {

		// Input values
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$email = '';
		$telpon = '';
		$no_hp = '';
		$alamat = $this->input->post('alamat');
		$status = $this->input->post('status');
		$rating = $this->input->post('rating');
		$komen = $this->input->post('komen');

		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->supplier->insert($kode, $nama, $email, $telpon, $no_hp, $alamat, $status, $rating, $komen);

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
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$email = '';
		$telpon = '';
		$no_hp = '';
		$alamat = $this->input->post('alamat');
		$status = $this->input->post('status');
		$rating = $this->input->post('rating');
		$komen = $this->input->post('komen');
		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->supplier->update($id, $kode, $nama, $email, $telpon, $no_hp, $alamat, $status, $rating, $komen);

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

		$r = $this->supplier->delete($id);

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
		$this->load->model('referensi/supplier_model', 'supplier');
		// cek session
		$this->sesion->cek_session();
	}
}