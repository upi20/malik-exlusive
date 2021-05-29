<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class PenjualanKeuangan extends Render_Controller {

	public function index() {
		// Page config:
		$this->title 				= 'Laporan Keuangan';
		$this->data['supplier'] 		= $this->db->get('supplier')->result_array();	
		$where = array('a.penj_status_pengiriman' => 'kirim');
		$get = $this->db->select_sum('b.pede_total_harga')->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')->get_where('penjualan a', $where)->row_array();
		$this->data['total_harga'] 	= $get['pede_total_harga'];

		$this->content 			= 'laporan-penjualan-keuangan'; 			
		$this->plugins 			= ['datatables','datetimepicker'];
		$this->navigation 		= ['Laporan'];
		$this->data['level'] 	= $this->session->userdata('data')['level'];
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
		$filter_tanggal_mulai 	= $this->input->post('filter_tanggal_mulai');
		$filter_tanggal_akhir 	= $this->input->post('filter_tanggal_akhir');
		$filter_supplier 		= $this->input->post('filter_supplier');

		$data 	= $this->keuangan->getAllData($length, $start, $_cari, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_supplier)->result_array();
		$count 	= $this->keuangan->getAllData(null,null, $_cari, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_supplier)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	function getTotalHarga(){
		$where = array();
		
		$supplier 		= $this->input->post('filter_supplier');
		$tanggal_mulai 	= $this->input->post('filter_tanggal_mulai');
		$tanggal_akhir 	= $this->input->post('filter_tanggal_akhir');

		if($tanggal_mulai != null){
			$where += array('a.penj_tanggal >= ' => date('Y-m-d', strtotime($tanggal_mulai)));
		}
		if($tanggal_akhir != null){
			$where += array('a.penj_tanggal <= ' => date('Y-m-d', strtotime($tanggal_akhir)));
		}

		if($supplier != null){
			$where += array('b.pede_supp_id' => $supplier);
		}


		$get = $this->db->select_sum('b.pede_total_harga')->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')->get_where('penjualan a', $where)->row_array();

		$this->output_json($get['pede_total_harga']);
	}

	public function getSupplier(){
		$get = $this->db->select('*')->get('supplier a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
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
		$this->load->model('laporan/penjualanKeuanganModel', 'keuangan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}