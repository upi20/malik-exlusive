<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

	public function getGrafik(){
		$getPenjualanTanggal = $this->db->group_by('penj_tanggal')->get('penjualan')->result_array();

		$tampung = array();
		foreach ($getPenjualanTanggal as $q) {
			// var_dump($q['penj_tanggal']);
			// exit();
			$get_a = $this->db->select('COUNT(a.pede_kelas) as jumlah')->join('penjualan b','b.penj_id = a.pede_penj_id')->where('b.penj_tanggal', $q['penj_tanggal'])->where('a.pede_kelas', 1)->get('penjualan_detail a')->row_array();
			$get_b = $this->db->select('COUNT(a.pede_kelas) as jumlah')->join('penjualan b','b.penj_id = a.pede_penj_id')->where('b.penj_tanggal', $q['penj_tanggal'])->where('a.pede_kelas', 2)->get('penjualan_detail a')->row_array();
			$get_c = $this->db->select('COUNT(a.pede_kelas) as jumlah')->join('penjualan b','b.penj_id = a.pede_penj_id')->where('b.penj_tanggal', $q['penj_tanggal'])->where('a.pede_kelas', 3)->get('penjualan_detail a')->row_array();
			$get_d = $this->db->select('COUNT(a.pede_kelas) as jumlah')->join('penjualan b','b.penj_id = a.pede_penj_id')->where('b.penj_tanggal', $q['penj_tanggal'])->where('a.pede_kelas', 4)->get('penjualan_detail a')->row_array();

			// var_dump($get_a);
			// exit();
			$tampung[] = array(
				'y' => $q['penj_tanggal'],
				'a'	=> $get_a['jumlah'],
				'b'	=> $get_b['jumlah'],
				'c'	=> $get_c['jumlah'],
				'd'	=> $get_d['jumlah']
			);
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($tampung));
	}

	public function getValuePengaturanMenuParent(){
		$get = $this->db->select('menu_id,menu_name')->order_by('menu_index','asc')->where('menu_menu_id',0)->get('menu')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}	
		
	public function getValuePengaturanPenggunaLevel(){
		$get = $this->db->select('lev_id,lev_nama')->order_by('lev_id','asc')->get('level')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueReferensiConfigItems(){
		$coni_id = $this->input->post('coni_id');
		$cats_id = $this->input->post('cats_id'); // default
		$get = $this->db->select('coni_id,coni_name')
										->order_by('coni_id','asc')
										->where('coni_cats_id',$cats_id)
										->where('coni_coni_id',$coni_id)
										->get('config_items')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}


	public function getValueMenu(){
		$get = $this->db->select('*')
										->where('menu_menu_id',0)
										->get('menu a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueLevel(){
		$get = $this->db->select('*')
										// ->where('menu_menu_id',0)
										->get('level a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueKategori(){
		$get = $this->db->select('*')
										->get('kategori a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}
	public function getValueKategoriWhere(){
		$kate_id = $this->input->post('kate_id');
		$level = $this->input->post('level');

		if($level > 1){
			$where = array(
				'kate_kate_id' => $kate_id,
				'kate_level' => $level 
			);
		}else{
			$where = array(
				'kate_level' => $level
			);
		}

		$get = $this->db->select('*')
						->get_where('kategori a', $where)
						->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}
	public function getValueSupplier(){
		$vendor = $this->input->post('vendor');
		if($vendor != null){
			$get = $this->db->select('*')
										->where('supp_nama',$vendor)
										->get('supplier a')->row_array();
		}else{
			$get = $this->db->select('*')
										->get('supplier a')->result_array();
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueBarang(){
		$get = $this->db->select('*')
										->get('barang a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueSubMenu(){
		$menu_id = $this->input->post('menu_id');
		$get = $this->db->select('*')
										->where('menu_menu_id',$menu_id)
										->get('menu a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));	
	}

	public function getValueRak()
	{
		$get 		= $this->db->get('rak')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getValueEtalase()
	{
		$get 		= $this->db->get('etalase')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	
	public function getValueKelasWhere()
	{
		$kelas = $this->input->post('kelas');
		$exe 		= $this->db->get_where('kelas', array('kela_id' => $kelas))->row_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueKelas()
	{
		$exe 		= $this->db->get_where('kelas')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueRegional()
	{
		$exe 		= $this->db->get_where('regional')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueWitel()
	{
		$regi_id 	= $this->input->post('regi_id');
		if($regi_id != null){
			$array = array('wite_regi_id' => $regi_id);
		}else{
			$array = array();
		}
		$exe 		= $this->db->get_where('witel', $array)->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueSto()
	{
		$wite_id 	= $this->input->post('wite_id');
		$exe 		= $this->db->get_where('sto', array('sto_wite_id' => $wite_id))->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueProduk()
	{
		$exe 		= $this->db->get_where('produk')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueSumberPenjualan()
	{
		$exe 		= $this->db->get_where('sumber_penjualan')->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueProdukWhere()
	{
		$kate_id = $this->input->post('kate_id');
		$kate_id_2 = $this->input->post('kate_id_2');
		$kate_id_3 = $this->input->post('kate_id_3');
		$prod_id = $this->input->post('prod_id');
		$prod_kode = $this->input->post('prod_kode');
		if($kate_id != null){
			$where = array(
				'prod_kate_id' => $kate_id
			);
		}elseif($kate_id_2 != null){
			$where = array(
				'prod_kate_id_2' => $kate_id_2
			);
		}elseif($kate_id_3 != null){
			$where = array(
				'prod_kate_id_3' => $kate_id_3
			);
		}elseif($prod_id != null){
			$where = array(
				'prod_id' => $prod_id
			);
		}elseif($prod_kode != null){
			$where = array(
				'prod_kode' => $prod_kode
			);
		}else{
			$where = array();
		}
		$exe 		= $this->db->select('prod_id, prod_nama, prod_kode, prod_kate_id, prod_harga_beli, prod_harga_jual, prod_berat, prod_vendor, prod_kate_id, prod_kate_id_2, prod_kate_id_3, prod_stok, prod_special, prod_selisih_stok, prod_supp_id')->get_where('produk', $where)->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueProdukPenjualan()
	{
		$kelas = $this->input->post('kelas');
		if($kelas != null){
			$where = array('prod_kela_id' => $kelas, 'prod_status' => 'Tersedia');
		}else{
			$where = array('prod_status' => 'Tersedia');
		}
		$exe 		= $this->db->get_where('produk', $where)->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}
	
	public function getDriver()
	{
		$exe 		= $this->db->get_where('driver', array('driv_status' => 'Aktif'))->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getValueRumah()
	{
		$blok_id = $this->input->post('blok_id');
		$exe 		= $this->db->get_where('rumah', array('ruma_blok_id' => $blok_id))->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function getNavigator()
	{
		$exe 		= $this->db->get_where('navigator', array('navi_status' => 'Aktif'))->result_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function cekKode()
	{
		$kode = $this->input->post('kode');
		$exe 		= $this->db->get_where('supplier', array('supp_kode' => $kode))->num_rows();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function cekKodeProduk()
	{
		$kode = $this->input->post('kode');
		$exe 		= $this->db->get_where('produk', array('prod_kode' => $kode))->num_rows();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function cekNoRecording()
	{
		$nama = $this->input->post('nama');
		$exe 		= $this->db->get_where('produk', array('prod_nama' => $nama))->num_rows();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($exe));
	}

	public function cekLokal()
	{
		$lokal = $this->input->post('lokal');
		$exe 		= $this->db->get_where('produk', array('prod_ruma_id' => $lokal))->num_rows();

		$return['jumlah'] = $exe;
		$return['blok'] = $this->db->select('b.blok_nama,b.blok_id')->join('blok b','b.blok_id = a.ruma_blok_id')->where('a.ruma_nama',$lokal)->get('rumah a')->row_array();

		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($return));
	}
	
}	
