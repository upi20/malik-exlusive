<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Data extends Render_Controller
{

	public function index()
	{
		// Page config:
		$this->title = 'Pembelian';
		if ($this->session->userdata('data')['level'] == 'Gudang') {
			$this->content = 'pengadaan-data';
		} elseif ($this->session->userdata('data')['level'] == 'Purchasing') {
			$this->content = 'pengadaan-data-purchasing';
		} elseif ($this->session->userdata('data')['level'] == 'Manager') {
			$this->content = 'pengadaan-data-manager';
		} else {
			$this->content = 'pengadaan-data';
		}
		$this->plugins = ['datatables', 'formatrupiah'];
		$this->navigation = ['Pembelian'];
		// Commit render:
		$this->render();
	}

	public function hapus($id)
	{
		$detail = $this->db->where('pend_peng_id', $id)->get('pengadaan_detail')->result_array();
		foreach ($detail as $q) {
			$get_stok = $this->db->get_where('produk', array('prod_id' => $q['pend_prod_id']))->row_array();
			$upd['prod_stok'] = $get_stok['prod_stok'] - $q['pend_jumlah'];
			$this->db->where('prod_id', $q['pend_prod_id']);
			$this->db->update('produk', $upd);
		}

		$this->db->where('pend_peng_id', $id);
		$this->db->delete('pengadaan_detail');

		$this->db->where('peng_id', $id);
		$this->db->delete('pengadaan');
		echo "<script>alert('Berhasil')</script>";
		redirect('pengadaan/data', 'refresh');
	}

	public function cetak($id)
	{
		$get 	= $this->pengadaan->getAllDataCetak($id)->row_array();
		$get_detail 	= $this->pengadaan->getAllDataCetak($id)->result_array();

		$this->data['pembelian'] = $get;
		$this->data['detail'] = $get_detail;
		$this->data['id'] = $id;
		// Page config:
		$this->title 	= 'Pengadaan';
		$this->content 	= 'cetak-struk-pembelian';
		$this->plugins 	= ['datatables', 'formatrupiah'];
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
		// if ($length == null) {
		// 	$length = 10;
		// }
		$data 	= $this->pengadaan->getAllProduk($length, $start, $cari['value'], $peng_id)->result_array();
		$count 	= $this->pengadaan->getAllProduk(null, null, $cari['value'], $peng_id)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
	}

	public function detail()
	{
		$peng_id 		= $this->uri->segment(4);
		// $get 			= $this->pengadaan->getAllProduk($peng_id)->result_array();
		// $this->data['list'] = $get;
		// Page config:
		$this->data['peng_id'] = $peng_id;
		$this->title 	= 'Pengadaan';
		$this->content 	= 'pengadaan-data-detail';
		$this->plugins 	= ['datatables', 'formatrupiah'];
		$this->navigation = ['Pengadaan'];
		// Commit render:
		$this->render();
	}

	public function pengiriman()
	{
		$peng_id 		= $this->uri->segment(4);
		$this->data['peng_id'] = null;
		$this->title 	= 'Pengadaan';
		$this->content 	= 'pengadaan-data-pengiriman';
		$this->plugins 	= ['datatables', 'formatrupiah'];
		$this->navigation = ['Pengadaan'];
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
		$data 	= $this->pengadaan->getAllData($length, $start, $_cari)->result_array();
		$count 	= $this->pengadaan->getAllData(null, null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}

	public function generate()
	{
		$id = $this->uri->segment(4);
		$get = $this->db->select('a.*,b.kela_nama,b.kela_deskripsi')->join('kelas b', 'b.kela_id = a.pend_kela_id')->where('a.pend_peng_id', $id)->get('pengadaan_detail a')->result_array();
		// var_dump($get);
		// exit();
		foreach ($get as $q) {

			for ($i = 0; $i < (int)$q['pend_jumlah']; $i++) {
				$data['prod_kela_id'] = $q['pend_kela_id'];
				$data['prod_nama'] = $this->codeDomba($q['kela_nama']);
				$data['prod_stok'] = 1;
				$data['prod_harga_beli'] = $q['pend_harga'];
				$data['prod_harga_jual'] = $q['kela_deskripsi'];
				$data['prod_status'] = 'Tersedia';
				$exe = $this->db->insert('produk', $data);
			}
		}

		if ($exe) {
			$upd['peng_generate'] = 1;
			$this->db->where('peng_id', $id);
			$this->db->update('pengadaan', $upd);
		}
		echo "<script>alert('Berhasil ditambahkan ke stok domba')</script>";
		redirect('pengadaan/data', 'refresh');
	}


	public function codeDomba()
	{
		$this->db->select('RIGHT(produk.prod_nama,3) as domba', FALSE);
		$this->db->order_by('prod_nama', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('produk');  //cek dulu apakah ada sudah ada kode di tabel.
		if ($query->num_rows() <> 0) {

			$data = $query->row();
			$kode = intval($data->domba) + 1;
		} else {
			$kode = 1;
		}
		$tgl = date('Y');
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodetampil = "DM" . "-" . $batas;
		return $kodetampil;
	}

	public function getDetail()
	{
		$id = $this->input->post('id');
		$get = $this->db->select('a.*, b.*, c.*')->where('b.peng_id', $id)->join('pengadaan b', 'b.peng_id = a.pend_peng_id')->join('kelas c', 'c.kela_id = a.pend_kela_id')->get('pengadaan_detail a')->result_array();
		$output = $get;
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($output));
	}

	public function proses()
	{
		$status = $this->uri->segment(4);
		$peng_id = $this->uri->segment(5);
		$role = $this->uri->segment(6);

		// if($status == 'terima'){
		// 	$get_pengadaan_produk = $this->db->get_where('pengadaan_detail', array('pend_peng_id' => $peng_id))->result_array();
		// 	foreach ($get_pengadaan_produk as $q) {
		// 		$get_produk = $this->db->get_where('produk', array('prod_id' => $q['pend_prod_id']))->row_array();
		// 		$jumlah_awal = $get_produk['prod_stok'];
		// 		$upd['prod_stok'] = $q['pend_jumlah'] + $jumlah_awal;
		// 		$this->db->where('prod_id', $q['pend_prod_id']);
		// 		$this->db->update('produk', $upd);
		// 	}

		// 	$get_special = $this->db->get_where('pengadaan_produk_special', array('ppsp_peng_id' => $peng_id))->result_array();

		// 	foreach ($get_special as $q) {
		// 		$get_produk_special = $this->db->get_where('produk_special', array('pros_prod_id' => $q['ppsp_prod_id'], 'pros_spec_id' => $q['ppsp_spec_id']))->row_array();
		// 		$jumlah_awal_min = $get_produk_special['pros_min_stok'];
		// 		$insert['pros_min_stok'] = $q['ppsp_min_stok'] + $jumlah_awal_min;
		// 		$insert['pros_value'] = 0;
		// 		$this->db->where('pros_spec_id', $q['ppsp_spec_id']);
		// 		$this->db->where('pros_prod_id', $q['ppsp_prod_id']);
		// 		$this->db->update('produk_special', $insert);
		// 	}
		// }

		if ($role == "purchasing") {
			$upd2['peng_status_purchasing'] = $status;
		} elseif ($role == "manager") {
			$upd2['peng_status_manager'] = $status;
		}
		$this->db->where('peng_id', $peng_id);
		$this->db->update('pengadaan', $upd2);
		echo "<script>alert('Berhasil')</script>";
		redirect('pengadaan/data', 'refresh');
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
		$this->load->model('pengadaan/data_model', 'pengadaan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}
