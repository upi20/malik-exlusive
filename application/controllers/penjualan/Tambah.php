<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Tambah extends Render_Controller {

	public function index() {
		// Page config:
		$this->title = 'Penjualan';
		$this->content = 'penjualan-tambah'; 
		$this->plugins = ['datatables','formatrupiah','autocomplete'];
		$this->navigation = ['Penjualan'];
		$this->data['listToko'] = $this->db->get('toko')->result_array();
		$this->data['listAdmin'] = $this->db->get('admin')->result_array();
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
		
		$data 	= $this->penjualan->getAlldata($length, $start, $_cari)->result_array();
		$count 	= $this->penjualan->getAlldata(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function ajax_data_detail()
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
		$data 	= $this->penjualan->getAlldataDetail($length, $start, $_cari)->result_array();
		$count 	= $this->penjualan->getAlldataDetail(null,null, $_cari)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal'=>$count, 'recordsFiltered'=> $count, 'draw'=>$draw, 'search'=>$_cari, 'data'=>$data));
	}

	public function getTotalHarga()
	{
		$exe 	= $this->penjualan->getTotalHarga();

		echo json_encode($exe);
	}

	public function insertHead()
	{
		$code = $this->input->post('code');
		$user_id = $this->input->post('user_id');
		$tanggal = $this->input->post('tanggal');
		$nama = $this->input->post('nama');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');
		$tanggal_pengiriman = $this->input->post('tanggal_pengiriman');
		$keterangan = $this->input->post('keterangan');
		$total = $this->input->post('total');
		$dibayar = $this->input->post('dibayar');
		$sisa = $this->input->post('sisa');
		$nominal_recah = $this->input->post('nominal_recah');
		$nominal_pengiriman = $this->input->post('nominal_pengiriman');
		$supe_id = $this->input->post('supe_id');
		$id_marketplace = $this->input->post('id_marketplace');
		$kurir = $this->input->post('kurir');
		$ongkir = $this->input->post('ongkir');
		$id_toko = $this->input->post('id_toko');
		$no_resi = $this->input->post('no_resi');
		$id_admin = $this->input->post('id_admin');
		
		// Check values
		if(empty($id)) $this->output_json(['message' => 'id_pemesanan tidak boleh kosong']);
		if(empty($tanggal)) $this->output_json(['message' => 'nama tidak boleh kosong']);
		if(empty($keterangan)) $this->output_json(['message' => 'no telpon tidak boleh kosong']);
		if(empty($total_harga)) $this->output_json(['message' => 'total harga tidak boleh kosong']);
		if(empty($dibayar)) $this->output_json(['message' => 'dibayar tidak boleh kosong']);
		if(empty($sisa)) $this->output_json(['message' => 'sisa tidak boleh kosong']);

		$r = $this->penjualan->insertHead($code, $user_id, $tanggal, $nama, $no_hp, $alamat, $tanggal_pengiriman, $keterangan, $total, $dibayar, $sisa, $nominal_recah, $nominal_pengiriman, $supe_id, $id_marketplace, $kurir, $ongkir, $id_toko, $no_resi, $id_admin);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function insert(){
		$code = $this->input->post('code');
		$parent1 = $this->input->post('parent1');
		$parent2 = $this->input->post('parent2');
		$parent3 = $this->input->post('parent3');
		$prod_id = $this->input->post('prod_id');
		$harga = $this->input->post('harga');
		$jumlah = $this->input->post('jumlah');
		$total_harga = $this->input->post('total_harga');
		
		// Check values
		if(empty($code)) $this->output_json(['message' => 'Code tidak boleh kosong']);
		if(empty($kate_id)) $this->output_json(['message' => 'Produk tidak boleh kosong']);
		if(empty($prod_id)) $this->output_json(['message' => 'Produk tidak boleh kosong']);
		if(empty($harga)) $this->output_json(['message' => 'Harga tidak boleh kosong']);

		$r = $this->penjualan->insert($code, $parent1, $parent2, $parent3, $prod_id, $harga, $jumlah, $total_harga);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function insertPembayaran()
	{
		$penj_id 			= $this->input->post('penj_id');
		$total_harga 		= $this->input->post('total_harga');
		$dibayar 			= $this->input->post('dibayar');
		$sisa 				= $this->input->post('sisa');

		$r = $this->penjualan->insertPembayaran($penj_id, $total_harga, $dibayar, $sisa);

		if($r !== FALSE) {

			$this->output_json(
				[
					'id' => $r['id'],
				]
			);
		}
	}

	public function hapusDetail() {

		$id = $this->input->post('id');

		// Check values
		if(empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->penjualan->hapusDetail($id);

		if($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
	}

	public function cekSales(){
		$id = $this->input->post('id');
		$get = $this->db->select('sto_kode,sto_nama,sto_no_hp')->where('sto_kode',$id)->get('sto');
		if($get->num_rows() > 0){
			$get = $get->row_array();
			$output['kode'] = $get['sto_kode'];
			$output['nama'] = $get['sto_nama'];
			$output['no_hp'] = $get['sto_no_hp'];
		}else{
			$output['kode'] = null;
			$output['nama'] = null;
			$output['no_hp'] = null;
		}
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
	}

	public function getProduk(){
		$id = $this->input->post('id');
		$get = $this->db->select('a.prod_nama, a.prod_stok, a.prod_harga_jual, a.prod_harga_beli, b.kate_id, b.kate_nama, a.prod_berat, a.prod_special')
						->join('kategori b','b.kate_id = a.prod_kate_id','left')
						->where('prod_id',$id)
						->get('produk a');
		if($get->num_rows() > 0){
			$get = $get->row_array();
			$output['produk'] = $get['prod_nama'];
			$output['kate_id'] = $get['kate_id'];
			$output['kate_nama'] = $get['kate_nama'];
			$output['stok'] = $get['prod_stok'];
			$output['harga'] = $get['prod_harga_jual'];
			$output['harga_awal'] = $get['prod_harga_beli'];
			$output['berat'] = $get['prod_berat'];
			$output['satuan'] = $get['prod_special'];
		}else{
			$output['kate_id'] = null;
			$output['kate_nama'] = null;
			$output['stok'] = null;
			$output['harga'] = null;
			$output['harga_awal'] = null;
			$output['berat'] = null;
			$output['satuan'] = $get['prod_special'];
		}
		$this->output->set_content_type('js');
		$this->output->set_output(json_encode($output));
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
		$this->load->model('penjualan/tambah_model', 'penjualan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}