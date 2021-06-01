<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Pengadaan extends Render_Controller
{

	public function index()
	{

		// Page config:
		$this->title = 'Laporan pengadaan';
		$this->content = 'laporan-pengadaan';
		$this->plugins = ['datatables', 'datetimepicker'];
		$this->navigation = ['Laporan'];
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');

		$cari 	= $this->input->post('search');
		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}
		$data 	= $this->pengadaan->getAllIsiLapor($length, $start, $_cari)->result_array();
		$count 	= $this->pengadaan->getAllIsiLapor(null, null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}


	private function output_json($data)
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	function __construct()
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('laporan/pengadaan_model', 'pengadaan');
		// cek session
		$this->sesion->cek_session();
	}
	public function cetak()
	{
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
		$config['filename'] = 'laporan-pengadaan-' . date('y-m-d');

		$this->pdf->render($config);
	}

	public function cetakPdf()
	{
		// $this->load->library('pdf');
		$filter_status_pembayaran = $this->session->userdata('filter_status_pembayaran');
		$filter_status_pengiriman = $this->session->userdata('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->session->userdata('filter_tanggal_akhir');
		$filter_sumber_penjualan = $this->session->userdata('filter_sumber_penjualan');
		$get_data = $this->getAllData();
		$data['pengadaan'] = $get_data;
		$this->load->view('templates/contents/cetak-laporan-pengadaan', $data);
	}

	public function getAllData()
	{
		$this->db->select(" a.*, b.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*, e.*");
		$this->db->from("pengadaan_detail a");
		$this->db->join('pengadaan b', 'b.peng_id = a.pend_peng_id');
		$this->db->join('kategori z', 'z.kate_id = a.pend_kate_id', 'left');
		$this->db->join('kategori x', 'x.kate_id = a.pend_kate_id_2', 'left');
		$this->db->join('kategori y', 'y.kate_id = a.pend_kate_id_3', 'left');
		$this->db->join('produk d', 'd.prod_id = a.pend_prod_id');
		$this->db->join('supplier e', 'e.supp_id = a.pend_supp_id', 'left');
		$this->db->order_by('a.pend_id', 'desc');
		$return = $this->db->get()->result_array();
		return $return;
	}
}
