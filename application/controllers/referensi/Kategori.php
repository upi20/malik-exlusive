<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Kategori extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Kategori';
		$this->content = 'referensi-kategori'; 
		$this->plugins = ['datatables','formatrupiah'];
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
		$data 	= $this->kategori->getAllData($length, $start, $_cari)->result_array();
		$count 	= $this->kategori->getAllData(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function insert() {

		// Input values

		$parent1 = $this->input->post('parent1');
		$parent2 = $this->input->post('parent2');
		$level = $this->input->post('level');
		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$status = $this->input->post('status');

		// Check values
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($deskripsi)) $this->output_json(['message' => 'Deskripsi tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->kategori->insert($parent1, $parent2, $level, $nama, $deskripsi, $status);

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
		$parent1 = $this->input->post('parent1');
		$parent2 = $this->input->post('parent2');
		$level = $this->input->post('level');
		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
		$status = $this->input->post('status');

		// Check values
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($deskripsi)) $this->output_json(['message' => 'Deskripsi tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->kategori->update($id, $parent1, $parent2, $level, $nama, $deskripsi, $status);

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

		$r = $this->kategori->delete($id);

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
		$this->load->model('referensi/kategori_model', 'kategori');
		// cek session
		$this->sesion->cek_session();
	}
}