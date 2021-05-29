<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Produk extends Render_Controller
{

	public function index()
	{

		// Page config:
		$this->title = 'Produk';
		$this->plugins = ['datatables', 'formatrupiah'];
		$this->navigation = ['Produk'];
		if ($this->session->userdata('data')['level'] == 'Gudang') {
			$this->content = 'referensi-produk-i';
		} elseif ($this->session->userdata('data')['level'] == 'Admin') {
			$this->content = 'referensi-produk-o';
		} elseif ($this->session->userdata('data')['level'] == 'Manager') {
			$this->content = 'referensi-produk-o';
		} else {
			$this->content = 'referensi-produk-i';
		}

		$this->data['filter_kategori_utama'] = $this->filter->getKategori(1);
		$this->data['filter_kategori'] = $this->filter->getKategori(2);
		$this->data['filter_sub_kategori'] = $this->filter->getKategori(3);
		// Commit render:
		$this->render();
	}

	public function ajax_data()
	{
		$start 	= $this->input->post('start');
		$draw 	= $this->input->post('draw');
		$length = $this->input->post('length');
		$cari 	= $this->input->post('search');

		$val_kategori_utama = $this->input->post('val_kategori_utama');
		$val_kategori 		= $this->input->post('val_kategori');
		$val_sub_kategori 	= $this->input->post('val_sub_kategori');
		$val_rak 			= $this->input->post('val_rak');
		$val_etalase 		= $this->input->post('val_etalase');
		$val_vendor 		= $this->input->post('val_vendor');
		$val_status_stok 	= $this->input->post('val_status_stok');

		if (isset($cari['value'])) {
			$_cari = $cari['value'];
		} else {
			$_cari = null;
		}

		$data 	= $this->produk->getAlldata($length, $start, $_cari, $val_kategori_utama, $val_kategori, $val_sub_kategori, $val_rak, $val_etalase, $val_vendor, $val_status_stok)->result_array();
		$count 	= $this->produk->getAlldata(null, null, $_cari, $val_kategori_utama, $val_kategori, $val_sub_kategori, $val_rak, $val_etalase, $val_vendor, $val_status_stok)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}

	public function insert()
	{

		// Input values
		$parent1 = $this->input->post('parent1');
		$parent2 = $this->input->post('parent2');
		$parent3 = $this->input->post('parent3');
		$nama = $this->input->post('nama');
		$harga_beli = $this->input->post('harga_beli');
		$harga_jual = $this->input->post('harga_jual');
		$harga_beli = str_replace(".", "", $harga_beli);
		$harga_jual = str_replace(".", "", $harga_jual);
		$berat = $this->input->post('berat');
		$status = $this->input->post('status');
		$min_stok = $this->input->post('min_stok');
		$max_stok = $this->input->post('max_stok');
		$tahun = $this->input->post('tahun');
		$facebook = $this->input->post('facebook');
		$tokopedia = $this->input->post('tokopedia');
		$bukalapak = $this->input->post('bukalapak');
		$shopee = $this->input->post('shopee');
		$supp_nama = $this->input->post('supp_nama');
		$kode = $this->input->post('kode');
		$special = $this->input->post('special');
		$link_referensi = $this->input->post('link_referensi');

		// Check values
		if (empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if (empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->produk->insert($parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $tahun, $facebook, $tokopedia, $bukalapak, $shopee, $supp_nama, $kode, $special, $link_referensi);

		if ($r !== FALSE) {
			$keterangan_special = $this->input->post('keterangan_special');
			$min_stok_special = $this->input->post('min_stok_special');
			if ($special == "Ya") {
				if (count($keterangan_special) > 0) {
					for ($i = 0; $i < count($keterangan_special); $i++) {
						$insert['pros_prod_id'] = $r['id'];
						$insert['pros_spec_id'] = $keterangan_special[$i];
						$insert['pros_min_stok'] = $min_stok_special[$i];
						$insert['pros_value'] = 0;
						$this->db->insert('produk_special', $insert);
					}
				}
			}

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function ubahRak()
	{
		$id = $this->input->post('id');
		$rak_id = $this->input->post('rak_id');
		$rak_jumlah = $this->input->post('rak_jumlah');

		$get_produk = $this->db->get_where('produk', array('prod_id' => $id))->row_array();
		$stok = $get_produk['prod_stok'];
		$rak_awal = $get_produk['prod_rak_jumlah'];
		$stok = $stok + $rak_awal;
		$upd['prod_rak_id'] = $rak_id;
		$upd['prod_rak_jumlah'] = $rak_jumlah;
		$upd['prod_stok'] 		= $stok - $rak_jumlah;
		$this->db->where('prod_id', $id);
		$this->db->update('produk', $upd);
		$this->output_json(
			[
				'id' => $id,
			]
		);
	}

	public function ubahEtalase()
	{
		$id = $this->input->post('id');
		$etal_id = $this->input->post('etal_id');
		$etal_jumlah = $this->input->post('etal_jumlah');

		$get_produk = $this->db->get_where('produk', array('prod_id' => $id))->row_array();
		$stok = $get_produk['prod_stok'];
		$etal_awal = $get_produk['prod_etal_jumlah'];
		$stok = $stok + $etal_awal;
		$upd['prod_etal_id'] = $etal_id;
		$upd['prod_etal_jumlah'] = $etal_jumlah;
		$upd['prod_stok'] 		= $stok - $etal_jumlah;
		$this->db->where('prod_id', $id);
		$this->db->update('produk', $upd);
		$this->output_json(
			[
				'id' => $id,
			]
		);
	}

	public function update()
	{

		// Input values
		$id = $this->input->post('id');
		$parent1 = $this->input->post('parent1');
		$parent2 = $this->input->post('parent2');
		$parent3 = $this->input->post('parent3');
		$nama = $this->input->post('nama');
		$harga_beli = $this->input->post('harga_beli');
		$harga_jual = $this->input->post('harga_jual');
		$harga_beli = str_replace(".", "", $harga_beli);
		$harga_jual = str_replace(".", "", $harga_jual);
		$berat = $this->input->post('berat');
		$status = $this->input->post('status');
		$min_stok = $this->input->post('min_stok');
		$max_stok = $this->input->post('max_stok');
		$tahun = $this->input->post('tahun');
		$facebook = $this->input->post('facebook');
		$tokopedia = $this->input->post('tokopedia');
		$bukalapak = $this->input->post('bukalapak');
		$shopee = $this->input->post('shopee');
		$supp_nama = $this->input->post('supp_nama');
		$kode = $this->input->post('kode');
		$special = $this->input->post('special');
		$link_referensi = $this->input->post('link_referensi');

		// Check values
		if (empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);
		if (empty($status)) $this->output_json(['message' => 'Status tidak boleh kosong']);

		$r = $this->produk->update($id, $parent1, $parent2, $parent3, $nama, $harga_beli, $harga_jual, $berat, $status, $min_stok, $max_stok, $tahun, $facebook, $tokopedia, $bukalapak, $shopee, $supp_nama, $kode, $special, $link_referensi);

		if ($r !== FALSE) {
			$pros_id = $this->input->post('pros_id');
			$keterangan_special = $this->input->post('keterangan_special');
			$min_stok_special = $this->input->post('min_stok_special');
			if ($special == "Ya") {
				if (count($keterangan_special) > 0) {
					for ($i = 0; $i < count($keterangan_special); $i++) {
						$insert['pros_prod_id'] = $id;
						$insert['pros_spec_id'] = $keterangan_special[$i];
						$insert['pros_min_stok'] = $min_stok_special[$i];
						// $insert['pros_value'] = 0;
						$this->db->where('pros_id', $pros_id[$i]);
						$this->db->update('produk_special', $insert);
					}
				}
			}
			$this->output_json(
				[
					'id' => $r,
				]
			);
		}
	}

	public function delete()
	{

		$id = $this->input->post('id');

		// Check values
		if (empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->produk->delete($id);

		if ($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
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
		$this->load->model('referensi/produk_model', 'produk');
		// cek session
		$this->sesion->cek_session();
	}
}
