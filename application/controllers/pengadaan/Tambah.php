<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Tambah extends Render_Controller
{

	public function index()
	{
		// Page config:
		$this->title = 'Pembelian';
		$this->content = 'pengadaan-tambah';
		$this->plugins = ['datatables', 'formatrupiah'];
		$this->navigation = ['Pengadaan'];
		// Commit render:
		$this->render();
	}

	function detail_product()
	{
		$post = $this->input->post('info');
		$prod_id = $this->input->post('prod_id');
		$peng_id = $this->input->post('peng_id');
		$jumlah = count($post) / 2;
		for ($i = 0; $i < count($post); $i++) {
			if ($i >= $jumlah) {
				$id[] = $post[$i];
			} else {
				$val[] = $post[$i];
			}
		}

		for ($s = 0; $s < $jumlah; $s++) {
			$insert['ppsp_peng_id'] = $peng_id;
			$insert['ppsp_prod_id'] = $prod_id;
			$insert['ppsp_spec_id'] = $id[$s];
			$insert['ppsp_min_stok'] = $val[$s];
			$insert['ppsp_value'] = 0;
			$this->db->insert('pengadaan_produk_special', $insert);
		}
		$data = array(0 => $prod_id, 1 => $peng_id);
		echo json_encode($data);
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

	public function ajax_data_detail()
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
		$data 	= $this->pengadaan->getAllDataDetail($length, $start, $_cari)->result_array();
		$count 	= $this->pengadaan->getAllDataDetail(null, null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}

	public function getTotalHarga()
	{
		$exe 	= $this->pengadaan->getTotalHarga();

		echo json_encode($exe);
	}

	public function insertHead()
	{
		$id = $this->input->post('id');
		$tanggal = $this->input->post('tanggal');
		$keterangan = $this->input->post('keterangan');
		$total_harga = $this->input->post('total_harga');
		$dibayar = $this->input->post('dibayar');
		$sisa = $this->input->post('sisa');
		$supp_id = $this->input->post('supp_id');

		// Check values
		if (empty($id)) $this->output_json(['message' => 'id_pemesanan tidak boleh kosong']);
		if (empty($tanggal)) $this->output_json(['message' => 'nama tidak boleh kosong']);
		if (empty($keterangan)) $this->output_json(['message' => 'no telpon tidak boleh kosong']);
		if (empty($total_harga)) $this->output_json(['message' => 'total harga tidak boleh kosong']);
		if (empty($dibayar)) $this->output_json(['message' => 'dibayar tidak boleh kosong']);
		if (empty($sisa)) $this->output_json(['message' => 'sisa tidak boleh kosong']);

		$r = $this->pengadaan->insertHead($id, $tanggal, $keterangan, $total_harga, $dibayar, $sisa, $supp_id);

		$upd1['pend_status_pengiriman'] = 'Selesai';
		// ======================================================
		$upd1 = [
			'pend_status_pengiriman' => 'Selesai',
			'pend_supp_id' => $supp_id
		];
		// ======================================================
		$this->db->where('pend_peng_id', $id);
		$this->db->update('pengadaan_detail', $upd1);

		$get_pengadaan_produk = $this->db->select('a.*,b.peng_supp_id')->join('pengadaan b', 'b.peng_id = a.pend_peng_id')->get_where('pengadaan_detail a', array('a.pend_peng_id' => $id))->result_array();

		foreach ($get_pengadaan_produk as $q) {
			// update stok produk
			$get_produk = $this->db->get_where('produk', array('prod_id' => $q['pend_prod_id']))->row_array();
			$jumlah_awal = $get_produk['prod_stok'];
			$upd['prod_stok'] = $q['pend_jumlah'] + $jumlah_awal;
			$upd['prod_selisih_stok'] = ($get_produk['prod_stok'] + $q['pend_jumlah']) - $get_produk['prod_min_stok'];
			$this->db->where('prod_id', $q['pend_prod_id']);
			$this->db->update('produk', $upd);

			// cek apakah pengadaan sudah pernah dilakukan
			$cek_produk_stok = $this->db->get_where(
				'produk_stok',
				[
					'id_produk' => $q['pend_prod_id'],
					'id_supplier' => $q['peng_supp_id']
				]
			);
			if ($cek_produk_stok->num_rows() > 0) {
				$dt_get = $cek_produk_stok->row_array();
				$stok_awal = $dt_get['jumlah'];
				$stok_total = $stok_awal + $q['pend_jumlah'];
				$upd2['jumlah'] = $stok_total;
				$this->db->where('id_produk', $q['pend_prod_id']);
				$this->db->where('id_supplier', $q['pend_supp_id']);
				$this->db->update('produk_stok', $upd2);
			} else {
				$stok_awal = 0;
				$stok_total = $stok_awal + $q['pend_jumlah'];
				$upd2['jumlah'] = $stok_total;
				$upd2['id_produk'] = $q['pend_prod_id'];
				$upd2['id_supplier'] = $q['pend_supp_id'];
				$this->db->insert('produk_stok', $upd2);
			}
		}

		if ($r !== FALSE) {
			$this->output_json(
				[
					'id' => $r['id'],
					'stok_awal' => $stok_awal,
					'stok_total' => $stok_total,
				]
			);
		}
	}

	public function insert()
	{

		$code = $this->input->post('code');
		$parent1 = $this->input->post('parent1');
		$parent2 = $this->input->post('parent2');
		$parent3 = $this->input->post('parent3');
		$prod_id = $this->input->post('prod_id');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$total = $this->input->post('total');
		$berat = $this->input->post('berat');
		$supp_id = $this->input->post('supp_id');
		$kode_produk_alias = $this->input->post('kode_produk_alias');
		$no_tracking = $this->input->post('no_tracking');
		$link_referensi = $this->input->post('link_referensi');

		// Check values
		if (empty($code)) $this->output_json(['message' => 'id_detail tidak boleh kosong']);
		if (empty($kelas)) $this->output_json(['message' => 'id_pemesanan tidak boleh kosong']);
		if (empty($jumlah)) $this->output_json(['message' => 'id_supplier tidak boleh kosong']);
		if (empty($harga)) $this->output_json(['message' => 'id_barang tidak boleh kosong']);
		if (empty($total)) $this->output_json(['message' => 'harga tidak boleh kosong']);

		$r = $this->pengadaan->insert($code, $parent1, $parent2, $parent3, $prod_id, $jumlah, $harga, $total, $berat, $supp_id, $kode_produk_alias, $no_tracking, $link_referensi);

		if ($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function hapusDetail()
	{

		$id = $this->input->post('id');

		// Check values
		if (empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->pengadaan->hapusDetail($id);

		if ($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
	}

	public function getDataSupplier()
	{
		$get = $this->db->get('supplier')->result_array();
		$this->output_json($get);
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
		$this->load->model('pengadaan/tambah_model', 'pengadaan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}
