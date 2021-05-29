<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Dashboard extends Render_Controller
{

	public function index()
	{
		// Page Settings
		$this->title = 'Dashboard';
		$this->navigation = ['Dashboard'];
		$this->plugins = ['chart', 'datetimepicker', 'datatables'];
		$this->data['menu_home'] = TRUE;

		$session_id = $this->session->userdata('data')['id'];
		// $this->data['tampil'] = $this->model->getAllData()->	result_array();
		$this->data['keuntungan'] = $this->model->getAllDataKeuntungan();
		if ($this->session->userdata('data')['level'] == "Admin I") {
			// stok etalase | stok rak | total stok | total nominal pengadaan | total nominal penjualan | total jumlah pesanan
			$this->data['total_stok'] = $this->model->total_stok();
			$this->data['total_etalase'] = $this->model->total_etalase();
			$this->data['total_rak'] = $this->model->total_rak();
			$this->data['total_nominal_pengadaan'] = $this->model->total_nominal_pengadaan();
			$this->data['total_nominal_penjualan'] = $this->model->total_nominal_penjualan();
			$this->data['total_barang_terjual'] = $this->model->total_barang_terjual();
			$this->content = 'home-1';
		} elseif ($this->session->userdata('data')['level'] == "Admin O") {
			// total produk | total stok | total posting facebook | total posting tokopedia | total posting bukalapak | total posting shopee
			$this->data['total_produk'] = $this->model->total_produk();
			$this->data['total_stok'] = $this->model->total_stok();
			// $this->data['total_posting_facebook'] = $this->model->total_posting_facebook();
			// $this->data['total_posting_tokopedia'] = $this->model->total_posting_tokopedia();
			// $this->data['total_posting_bukalapak'] = $this->model->total_posting_bukalapak();
			$this->data['total_nominal_penjualan'] = $this->model->total_nominal_penjualan();
			// $this->data['total_posting_shopee'] = $this->model->total_posting_shopee();
			$this->content = 'home-2';
		} elseif ($this->session->userdata('data')['level'] == "Manager") {
			// manager : total produk | total stok | total nominal pengadaan | total nominal penjualan | total laba | total rugi | total pesanan barang | total piutang | total hutang
			$this->data['total_produk'] = $this->model->total_produk();
			$this->data['total_stok'] = $this->model->total_stok();
			$this->data['total_nominal_pengadaan'] = $this->model->total_nominal_pengadaan();
			$this->data['total_nominal_penjualan'] = $this->model->total_nominal_penjualan();
			$this->data['total_laba'] = $this->model->total_laba();
			$this->data['total_rugi'] = $this->model->total_rugi();
			$this->data['total_barang_terjual'] = $this->model->total_barang_terjual();
			$this->data['total_piutang'] = $this->model->total_piutang();
			$this->data['total_hutang'] = $this->model->total_hutang();


			$dari = $this->input->get("filter_tanggal_mulai") ? $_GET['filter_tanggal_mulai'] : date('Y-m-d');
			$sampai = $this->input->get("filter_tanggal_akhir") ? $_GET['filter_tanggal_akhir'] : date('Y-m-d');
			$this->data['tanggal_mulai'] = $dari;
			$this->data['tanggal_akhir'] = $sampai;
			$this->data['table'] = $this->model->getDataPenjualan($dari, $sampai);
			$this->data['admin'] = $this->model->getAdmin();
			$this->data['suplier'] = $this->model->getSuplier();
			$this->content = 'home';
		} elseif ($this->session->userdata('data')['level'] == "Admin" || $this->session->userdata('data')['level'] == "Gudang") {
			redirect('referensi/produk');
			// $dari = $this->input->get("filter_tanggal_mulai") ? $_GET['filter_tanggal_mulai'] : date('Y-m-d');
			// $sampai = $this->input->get("filter_tanggal_akhir") ? $_GET['filter_tanggal_akhir'] : date('Y-m-d');
			// $this->data['tanggal_mulai'] = $dari;
			// $this->data['tanggal_akhir'] = $sampai;
			// $this->data['penjualan'] = $this->model->getStatusPenjualan($dari, $sampai);
			// $this->content = 'home-admin';
		} else {
			// manager : total produk | total stok | total nominal pengadaan | total nominal penjualan | total laba | total rugi | total pesanan barang | total piutang | total hutang

			$this->data['total_produk'] = $this->model->total_produk();
			$this->data['total_stok'] = $this->model->total_stok();
			$this->data['total_nominal_pengadaan'] = $this->model->total_nominal_pengadaan();
			$this->data['total_nominal_penjualan'] = $this->model->total_nominal_penjualan();
			$this->data['total_laba'] = $this->model->total_laba();
			$this->data['total_rugi'] = $this->model->total_rugi();
			$this->data['total_barang_terjual'] = $this->model->total_barang_terjual();
			$this->data['total_piutang'] = $this->model->total_piutang();
			$this->data['total_hutang'] = $this->model->total_hutang();


			$dari = $this->input->get("filter_tanggal_mulai") ? $_GET['filter_tanggal_mulai'] : date('Y-m-d');
			$sampai = $this->input->get("filter_tanggal_akhir") ? $_GET['filter_tanggal_akhir'] : date('Y-m-d');
			$this->data['tanggal_mulai'] = $dari;
			$this->data['tanggal_akhir'] = $sampai;
			$this->data['table'] = $this->model->getDataPenjualan($dari, $sampai);
			$this->data['admin'] = $this->model->getAdmin();
			$this->data['suplier'] = $this->model->getSuplier();
			$this->content = 'home';
		}


		$this->render();
	}

	public function getGrafik()
	{
		$getPenjualanTanggal = $this->db->group_by('penj_tanggal')->get('penjualan')->result_array();

		$tampung = array();
		foreach ($getPenjualanTanggal as $q) {
			// var_dump($q['penj_tanggal']);
			// exit();
			$get_a = $this->db->select('COUNT(a.pede_jumlah) as jumlah')
				->join('penjualan b', 'b.penj_id = a.pede_penj_id')
				// ->join('sumber_penjualan c','c.supe_id = b.penj_supe_id')
				->where('b.penj_tanggal', $q['penj_tanggal'])
				// ->group_by('b.penj_supe_id')
				->get('penjualan_detail a')->row_array();
			$get_total = $this->db->select('SUM(b.penj_total_harga) as total_harga')->where('b.penj_tanggal', $q['penj_tanggal'])->get('penjualan b')->row_array();

			$tampung[] = array(
				'y' 			=> $q['penj_tanggal'],
				'jumlah'		=> $get_a['jumlah'],
				'total_harga'	=> $get_total['total_harga'],
				// 'sumber'		=> $get_a['sumber'],
			);
		}
		// $exe 		= $this->model->getDombaTerjual()->result_array();

		echo json_encode($tampung);
	}

	public function getProdukTerjual()
	{
		$exe 		= $this->model->getProdukTerjual()->result_array();

		echo json_encode($exe);
	}

	public function getProdukSisa()
	{
		$exe 		= $this->model->getProdukSisa()->result_array();

		echo json_encode($exe);
	}

	public function getPemasukan()
	{
		$exe 		= $this->model->getPemasukan()->result_array();

		echo json_encode($exe);
	}

	public function getPengeluaran()
	{
		$exe 		= $this->model->getPengeluaran()->result_array();

		echo json_encode($exe);
	}

	public function getDombaSisaDetail()
	{
		$exe 		= $this->model->getDombaSisaDetail()->result_array();

		echo json_encode($exe);
	}

	public function getDombaTerjualDetail()
	{
		$exe 		= $this->model->getDombaTerjualDetail()->result_array();

		echo json_encode($exe);
	}

	public function getPemasukanDetail()
	{
		$exe 		= $this->model->getPemasukanDetail()->result_array();

		echo json_encode($exe);
	}

	public function getPengeluaranDetail()
	{
		$exe 		= $this->model->getPengeluaranDetail()->result_array();

		echo json_encode($exe);
	}


	public function ajax_data_penjualan()
	{
		$dari = $this->input->post("dari");
		$sampai = $this->input->post("sampai");
		echo json_encode($this->model->getDataPenjualan($dari, $sampai));
	}






	function __construct()
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->model('dashboardModel', 'model');
		$this->load->library('plugin');
		$this->load->helper('url');
		// cek session
		$this->sesion->cek_session();
	}
}
