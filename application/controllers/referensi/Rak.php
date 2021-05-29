<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Rak extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Referensi - Rak';
		$this->content = 'referensi-rak'; 
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

		$data 	= $this->rak->getAlldata($length, $start, $cari['value'])->result_array();
		$count 	= $this->rak->getAlldata(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$kode = $this->input->post('kode');
		$keterangan = $this->input->post('keterangan');

		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->rak->insert($kode, $keterangan);

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
		$keterangan = $this->input->post('keterangan');
		// Check values
		if(empty($kode)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

		$r = $this->rak->update($id, $kode, $keterangan);

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

		$r = $this->rak->delete($id);

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
		$this->load->model('referensi/rak_model', 'rak');
		// cek session
		$this->sesion->cek_session();
	}
}