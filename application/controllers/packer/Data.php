<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Packer Data';
		$this->content = 'packer-data'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Packer'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$status 	= $this->input->post('status');
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		if(isset($cari['value'])){
			$_cari = $cari['value'];
		}else{
			$_cari = null;
		}
		$data 	= $this->packer->getAllIsi($length, $start, $_cari, $status)->result_array();
		$count 	= $this->packer->getAllIsi(null,null, $_cari, $status)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function insert() {

		// Input values
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$alamat = $this->input->post('alamat');

		$r = $this->packer->insert($nama, $email, $telepon, $alamat);

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
		$telepon = $this->input->post('telepon');
		$alamat = $this->input->post('alamat');

		$r = $this->packer->update($id, $nama, $email, $telepon, $alamat);

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

		$r = $this->packer->delete($id);

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
		$this->load->model('packer/dataModel', 'packer');
		// cek session
		$this->sesion->cek_session();
	}
}