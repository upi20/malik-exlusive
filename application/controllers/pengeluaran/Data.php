<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Pengeluaran - Data';
		$this->content = 'pengeluaran-data'; 
		$this->plugins = ['datatables','formatrupiah'];
		$this->navigation = ['Pengeluaran'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');

		$data 	= $this->pengeluaran->getAlldata($length, $start, $cari['value'])->result_array();
		$count 	= $this->pengeluaran->getAlldata(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$kategori = $this->input->post('kategori');
		$keterangan = $this->input->post('keterangan');
		$nominal = $this->input->post('nominal');
		$untuk 	= $this->input->post('untuk');
		$tanggal 	= $this->input->post('tanggal');

		// Check values
		if(empty($kategori)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'Deskripsi tidak boleh kosong']);
		if(empty($nominal)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->pengeluaran->insert($kategori, $keterangan, $nominal, $untuk, $tanggal);

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
		$kategori = $this->input->post('kategori');
		$keterangan = $this->input->post('keterangan');
		$nominal = $this->input->post('nominal');
		$untuk 	= $this->input->post('untuk');
		$tanggal = $this->input->post('tanggal');
		// Check values
		if(empty($kategori)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'Deskripsi tidak boleh kosong']);
		if(empty($nominal)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->pengeluaran->update($id, $kategori, $keterangan, $nominal, $untuk, $tanggal);

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

		$r = $this->pengeluaran->delete($id);

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
		$this->load->model('pengeluaran/data_model', 'pengeluaran');
		// cek session
		$this->sesion->cek_session();
	}
}