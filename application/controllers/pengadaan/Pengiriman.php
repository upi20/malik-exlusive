<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Pengiriman extends Render_Controller {

	public function index(){
		$peng_id 		= $this->uri->segment(4);
		$this->data['peng_id'] = null;
		$this->title 	= 'Transaksi Pembelian';
		if($this->level == "Admin O"){
			$this->content = 'pengadaan-data-pengiriman-o'; 			
		}else{
			$this->content = 'pengadaan-data-pengiriman'; 			
		}
		$this->plugins 	= ['datatables','formatrupiah'];
		$this->navigation = ['Pengadaan'];
		// Commit render:
		$this->render();

	}

	public function ajax_data_detail()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$peng_id 	= $this->input->post('peng_id');
		if(isset($cari['value'])){
			$_cari = $cari['value'];
		}else{
			$_cari = null;
		}
		$data 	= $this->pengadaan->getAllProdukPengiriman($length, $start, $_cari, $peng_id)->result_array();
		$count 	= $this->pengadaan->getAllProdukPengiriman(null,null, $_cari, $peng_id)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function ubahStatus(){
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$get_dt = $this->db->get_where('pengadaan_detail', array('pend_id' => $id))->row_array();
		$peng_id = $get_dt['pend_peng_id'];
		$upd1['pend_status_pengiriman'] = $status;
		$this->db->where('pend_id', $id);
		$this->db->update('pengadaan_detail', $upd1);

		if($status == "Selesai"){
			// $get = $this->db->where('pend_id', $id)->get('pengadaan_detail')->result_array();
			// foreach ($get as $q) {
			// 	$prod_id 			= $q['pend_prod_id'];
			// 	$get_stok = $this->db->get_where('produk', array('prod_id' => $prod_id))->row_array();

			// 	$data['prod_stok'] 	= $get_stok['prod_stok'] + $q['pend_jumlah'];
			// 	$data['prod_selisih_stok'] = ($get_stok['prod_stok'] + $q['pend_jumlah']) - $get_stok['prod_min_stok'];
			// 	$exe 				= $this->db->where('prod_id', $prod_id);
			// 	$exe 				= $this->db->update('produk', $data);
			// }
			$get_pengadaan_produk = $this->db->get_where('pengadaan_detail', array('pend_id' => $id))->result_array();
				foreach ($get_pengadaan_produk as $q) {
					$get_produk = $this->db->get_where('produk', array('prod_id' => $q['pend_prod_id']))->row_array();
					$jumlah_awal = $get_produk['prod_stok'];
					$upd['prod_stok'] = $q['pend_jumlah'] + $jumlah_awal;
					$upd['prod_selisih_stok'] = ($get_produk['prod_stok'] + $q['pend_jumlah']) - $get_produk['prod_min_stok'];
					$this->db->where('prod_id', $q['pend_prod_id']);
					$this->db->update('produk', $upd);
				}

				// $get_special = $this->db->get_where('pengadaan_produk_special', array('ppsp_peng_id' => $peng_id))->result_array();

				// foreach ($get_special as $q) {
				// 	$get_produk_special = $this->db->get_where('produk_special', array('pros_prod_id' => $q['ppsp_prod_id'], 'pros_spec_id' => $q['ppsp_spec_id']))->row_array();
				// 	$jumlah_awal_min = $get_produk_special['pros_min_stok'];
				// 	$insert['pros_min_stok'] = $q['ppsp_min_stok'] + $jumlah_awal_min;
				// 	$insert['pros_value'] = 0;
				// 	$this->db->where('pros_spec_id', $q['ppsp_spec_id']);
				// 	$this->db->where('pros_prod_id', $q['ppsp_prod_id']);
				// 	$this->db->update('produk_special', $insert);
				// }	
		}else{

		}


		$this->output_json(
			[
				'id' => $id,
			]
		);
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
		$this->load->model('pengadaan/data_model', 'pengadaan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}