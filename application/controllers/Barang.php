<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Barang extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Barang';
		$this->content = 'barang'; 
		$this->plugins = ['datatables','formatrupiah'];
		$this->navigation = ['Barang'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if ($length == 0) {
			$length = 10;
		}
		$data 	= $this->barang->getAlldata($length, $start, $cari['value'])->result_array();
		$count 	= $this->barang->getAlldata(null,null, $cari['value'])->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$cari['value'], 'data'=>$data));
	}

	public function insert() {

		// Input values
		$code = $this->input->post('code');
		$id_kategori = $this->input->post('id_kategori');
		$nama = $this->input->post('nama');
		$keterangan = $this->input->post('keterangan');
		$status = $this->input->post('status');
		$stok = $this->input->post('stok');
		$satuan = $this->input->post('satuan');
		$harga = $this->input->post('harga');

		// Check values
		if(empty($code)) $this->output_json(['message' => 'code tidak boleh kosong']);
		if(empty($id_kategori)) $this->output_json(['message' => 'id kategori tidak boleh kosong']);
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'Keterangan tidak boleh kosong']);
		if(empty($stok)) $this->output_json(['message' => 'stok tidak boleh kosong']);
		if(empty($satuan)) $this->output_json(['message' => 'satuan tidak boleh kosong']);
		if(empty($harga)) $this->output_json(['message' => 'harga tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->barang->insert($code, $id_kategori, $nama, $keterangan, $status, $stok, $satuan, $harga);

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
		$id_kategori = $this->input->post('id_kategori');
		$nama = $this->input->post('nama');
		$keterangan = $this->input->post('keterangan');
		$status = $this->input->post('status');
		$stok = $this->input->post('stok');
		$satuan = $this->input->post('satuan');
		$harga = $this->input->post('harga');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'code tidak boleh kosong']);
		if(empty($id_kategori)) $this->output_json(['message' => 'id kategori tidak boleh kosong']);
		if(empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'Keterangan tidak boleh kosong']);
		if(empty($stok)) $this->output_json(['message' => 'stok tidak boleh kosong']);
		if(empty($satuan)) $this->output_json(['message' => 'satuan tidak boleh kosong']);
		if(empty($harga)) $this->output_json(['message' => 'harga tidak boleh kosong']);
		if(empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->barang->update($id, $id_kategori, $nama, $keterangan, $status, $stok, $satuan, $harga);

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

		$r = $this->barang->delete($id);

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
		$this->load->model('referensi/barang_model', 'barang');
		// cek session
		$this->sesion->cek_session();
	}
}