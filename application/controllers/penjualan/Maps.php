<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {

	public function index(){}

	public function detail($id)
	{
		$data['id']	= $id;

		$this->load->view('googleMaps', $data);
	}

	public function setMaps()
	{
		$penj_awal 					= $this->input->post('kiri');
		$penj_akhir 				= $this->input->post('kanan');
		
		$id 						= $this->input->post('id');
		$data['penj_awal'] 			= $this->input->post('tempatAkhir');
		$data['penj_akhir'] 		= $this->input->post('tempatAwal');

		$exe 					= $this->db->where('penj_id', $id);
		$exe 					= $this->db->update('penjualan', $data);

		redirect('penjualan/data','refresh');
	}

	public function lihatMaps($id)
	{
		$exe 					= $this->db->get_where('penjualan', array('penj_id' => $id))->result_array();

		$data['tampil'] 		= $exe;

		$this->load->view('lihatMaps', $data);
	}
}

/* End of file Maps.php */
/* Location: ./application/controllers/penjualan/Maps.php */