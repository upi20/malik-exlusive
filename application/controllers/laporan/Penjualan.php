<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Penjualan extends Render_Controller {

	public function index() {

		$session = array('filter_status_pembayaran','filter_status_pengiriman', 'filter_tanggal_mulai', 'filter_tanggal_akhir', 'filter_sumber_penjualan');
		$this->session->unset_userdata($session);

		// Page config:
		$this->title = 'Laporan Penjualan';
		$this->content = 'laporan-penjualan-pemilik'; 
		// $this->content = 'laporan-penjualan'; 
		$this->plugins = ['datatables','datetimepicker'];
		$this->navigation = ['Laporan'];



		// Commit render:
		$this->render();
	}

	public function pemilik() {

		$session = array('filter_status_pembayaran','filter_status_pengiriman', 'filter_tanggal_mulai', 'filter_tanggal_akhir', 'filter_sumber_penjualan');
		$this->session->unset_userdata($session);

		// Page config:
		$this->title = 'Laporan Penjualan';
		$this->content = 'laporan-penjualan-pemilik'; 
		// $this->content = 'laporan-penjualan'; 
		$this->plugins = ['datatables','datetimepicker'];
		$this->navigation = ['Laporan'];

		$get = $this->db->get_where('laporan', array('lapo_status' => 'pending', 'lapo_kategori' => 'penjualan', 'lapo_bulan' => date('m'), 'lapo_tahun' => date('Y')));
		$this->data['cek'] = $get->num_rows();
		if($get->num_rows() > 0){
			$this->data['status'] = $get->row_array()['lapo_status'];			
			$this->data['nominal'] = $this->libs->rupiah($get->row_array()['lapo_nominal']);			
		}else{
			$this->data['status'] = "";			
			$this->data['nominal'] = "";			
		}

		$status = $this->input->get('proses');
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');
		$kategori = $this->input->get('kategori');

		$upd['lapo_status'] = $status;
		$this->db->where('lapo_bulan', $bulan);
		$this->db->where('lapo_tahun', $tahun);
		$this->db->where('lapo_kategori', $kategori);
		$this->db->update('laporan', $upd);

		echo "<script>alert('Berhasil')</script>";
		redirect('laporan/penjualan', 'refresh');
		// Commit render:
		$this->render();
	}

	public function kasir() {

		$session = array('filter_status_pembayaran','filter_status_pengiriman', 'filter_tanggal_mulai', 'filter_tanggal_akhir', 'filter_sumber_penjualan');
		$this->session->unset_userdata($session);

		// Page config:
		$this->title = 'Laporan Penjualan';
		$this->content = 'laporan-penjualan-kasir'; 
		$this->plugins = ['datatables','datetimepicker'];
		$this->navigation = ['Laporan'];
		$get = $this->db->get_where('laporan', array('lapo_kategori' => 'penjualan', 'lapo_bulan' => date('m'), 'lapo_tahun' => date('Y')));
		$this->data['cek'] = $get->num_rows();
		if($get->num_rows() > 0){
			$this->data['status'] = $get->row_array()['lapo_status'];			
			$this->data['nominal'] = $this->libs->rupiah($get->row_array()['lapo_nominal']);			
		}else{
			$this->data['status'] = "";			
			$this->data['nominal'] = "";			
		}
		// Commit render:
		$this->render();
	}

	public function kasirKirim(){
		$bulan = date('m');
		$tahun = date('Y');

		
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');
		$filter_status_pembayaran = $this->input->post('filter_status_pembayaran');
		$filter_status_pengiriman = $this->input->post('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->input->post('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->input->post('filter_tanggal_akhir');
		$filter_sumber_penjualan = $this->input->post('filter_sumber_penjualan');

		$get 	= $this->penjualan->getAllIsiLaporNominal($length, $start, $cari['value'], $filter_status_pembayaran, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_sumber_penjualan, $bulan, $tahun)->row_array();

		$data['lapo_kategori'] = "Penjualan";
		$data['lapo_bulan'] = $bulan;
		$data['lapo_tahun'] = $tahun;
		$data['lapo_nominal'] = $get['penj_total_harga'];
		$data['lapo_status'] = "pending";
		$data['lapo_keterangan'] = "";
		$exe = $this->db->insert('laporan', $data);
		echo "<script>alert('Berhasil')</script>";
		redirect('laporan/penjualan/kasir', 'refresh');
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');

		$filter_status_pembayaran = $this->input->post('filter_status_pembayaran');
		$filter_status_pengiriman = $this->input->post('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->input->post('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->input->post('filter_tanggal_akhir');
		$filter_vendor = $this->input->post('filter_sumber_penjualan');

		
		$cari 	= $this->input->post('search');

		if(isset($cari['value'])){
			$_cari = $cari['value'];
		}else{
			$_cari = null;
		}
		
		$data 	= $this->penjualan->getAllIsiLapor($length, $start, $_cari, $filter_status_pembayaran, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_vendor)->result_array();
		$count 	= $this->penjualan->getAllIsiLapor(null,null, $_cari, $filter_status_pembayaran, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_vendor)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
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
		$this->load->model('laporan/penjualan_model', 'penjualan');
		// cek session
		$this->sesion->cek_session();
	}

	public function export_excel(){
		
		$filter_status_pembayaran = $this->session->userdata('filter_status_pembayaran');
		$filter_status_pengiriman = $this->session->userdata('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->session->userdata('filter_tanggal_akhir');
		$filter_sumber_penjualan = $this->session->userdata('filter_sumber_penjualan');
		$get_data = $data 	= $this->penjualan->getAllIsiLaporExport($filter_status_pembayaran, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_sumber_penjualan);
	 	$data = array( 
	 		'title' => 'Laporan Penjualan',
	 		'list' => $get_data
	 	);
	 	$this->load->view('templates/cetak/laporan_penjualan',$data);
	}

	public function cetak(){
  	$this->load->library('pdf');
  	$filter_status_pembayaran = $this->session->userdata('filter_status_pembayaran');
		$filter_status_pengiriman = $this->session->userdata('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->session->userdata('filter_tanggal_akhir');
		$filter_sumber_penjualan = $this->session->userdata('filter_sumber_penjualan');
		$get_data = $data 	= $this->penjualan->getAllIsiLaporExport($filter_status_pembayaran, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_sumber_penjualan);
	 	$data = array( 
	 		'title' => 'Laporan Penjualan',
	 		'list' => $get_data
	 	);       
    // Config PDF
    $config['html'] = 'templates/cetakpdf';
    $config['data'] = $data;
    $config['filename'] = 'LAPORAN_PAKET_' . date('y-m-d');

    $this->pdf->render($config);
  }

  public function cetakPdf(){
  	// $this->load->library('pdf');
  	$filter_status_pembayaran = $this->session->userdata('filter_status_pembayaran');
		$filter_status_pengiriman = $this->session->userdata('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->session->userdata('filter_tanggal_akhir');
		$filter_sumber_penjualan = $this->session->userdata('filter_sumber_penjualan');
		$get_data = $this->getAllData();
		$data['penjualan'] = $get_data;
		$this->load->view('templates/contents/cetak-laporan-penjualan', $data);
  }

  public function getAllData($show=null, $start=null, $cari=null, $filter_status_pembayaran=null, $filter_status_pengiriman=null, $filter_tanggal_mulai=null, $filter_tanggal_akhir=null, $filter_sumber_penjualan=null){
		$this->db->select(" a.*, b.* ,u.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*");

		$this->db->from("penjualan_detail b");
		$this->db->join("penjualan a", 'b.pede_penj_id = a.penj_id');

		$this->db->join('kategori z','z.kate_id = b.pede_kate_id','left');
		$this->db->join('kategori x','x.kate_id = b.pede_kate_id_2','left');
		$this->db->join('kategori y','y.kate_id = b.pede_kate_id_3','left');
		$this->db->join('produk d','d.prod_id = b.pede_prod_id');

		$this->db->join("users u", "a.penj_user_id = u.user_id");
		// $this->db->join("sumber_penjualan sp", "sp.supe_id = a.penj_supe_id");
		$this->db->order_by('b.pede_id', 'asc');

		$return = $this->db->get()->result_array();
		return $return;
	}

}