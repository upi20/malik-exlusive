<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Stok_supplier extends Render_Controller {

	public function index() {

		// Page config:
		$this->title = 'Laporan stok supplier';
		$this->content = 'laporan-stok-supplier'; 
		$this->plugins = ['datatables'];
		$this->navigation = ['Laporan'];
		$this->data['data'] = $this->db->select('a.*, b.prod_nama, c.supp_nama')
		->from('produk_stok a')
		->join('produk b', 'b.prod_id = a.id_produk')
		->join('supplier c', 'c.supp_id = a.id_supplier')
		->get()
		->result_array();
		// Commit render:
		$this->render();
	}

	function __construct() {
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
	// public function cetak(){
	//   	$this->load->library('pdf');
	//   	$filter_status_pembayaran = $this->session->userdata('filter_status_pembayaran');
	// 	$filter_status_pengiriman = $this->session->userdata('filter_status_pengiriman');
	// 	$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
	// 	$filter_tanggal_akhir = $this->session->userdata('filter_tanggal_akhir');
	// 	$filter_sumber_penjualan = $this->session->userdata('filter_sumber_penjualan');
	// 	$get_data = $data 	= $this->penjualan->getAllIsiLaporExport($filter_status_pembayaran, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_sumber_penjualan);
	//  	$data = array( 
	//  		'title' => 'Laporan Penjualan',
	//  		'list' => $get_data
	//  	);       
	//     // Config PDF
	//     $config['html'] = 'templates/cetakpdf';
	//     $config['data'] = $data;
	//     $config['filename'] = 'laporan-pengadaan-' . date('y-m-d');

 //    	$this->pdf->render($config);
 //  	}

 //  	public function cetakPdf(){
 //  		// $this->load->library('pdf');
 //  		$filter_status_pembayaran = $this->session->userdata('filter_status_pembayaran');
	// 	$filter_status_pengiriman = $this->session->userdata('filter_status_pengiriman');
	// 	$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
	// 	$filter_tanggal_akhir = $this->session->userdata('filter_tanggal_akhir');
	// 	$filter_sumber_penjualan = $this->session->userdata('filter_sumber_penjualan');
	// 	$get_data = $this->getAllData();
	// 	$data['pengadaan'] = $get_data;
	// 	$this->load->view('templates/contents/cetak-laporan-pengadaan', $data);
 //  	}

  
}