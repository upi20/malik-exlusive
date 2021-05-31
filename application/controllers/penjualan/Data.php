<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';
require APPPATH . 'libraries/Excel.php';

class Data extends Render_Controller
{

	public function index()
	{
		// Page config:
		$this->title = 'Penjualan';
		if ($this->level == "Gudang") {
			$this->content = 'penjualan-data-i';
			$this->data['admin'] = $this->db->get('admin')->result_array();
			$this->data['supplier'] = $this->db->get('supplier')->result_array();
			$this->data['packer'] = $this->db->get('packer')->result_array();
		} elseif ($this->level == "Admin") {
			$this->content = 'penjualan-data-o';
			$this->data['toko'] = $this->db->get('toko')->result_array();
		} elseif ($this->level == "Manager") {
			$this->content = 'penjualan-data-i';
		} else {
			$this->content = 'penjualan-data-o';
		}

		$this->data['vendor'] 	= $this->db->get('supplier')->result_array();
		$this->data['total_harga'] = $this->total_harga();
		$this->plugins 			= ['datatables', 'formatrupiah', 'datetimepicker'];
		$this->navigation 		= ['Penjualan'];
		$this->data['level'] 	= $this->session->userdata('data')['level'];
		$this->data['toko'] = $this->db->get('toko')->result_array();
		$this->data['filter'] = $this->input->get();
		// Commit render:
		$this->render();
	}

	function total_harga($supp_id = null, $tanggal_mulai = null, $tanggal_akhir = null)
	{
		$where = array();
		if ($tanggal_mulai != null) {
			$where += array('a.penj_tanggal >= ' => date('Y-m-d', strtotime($tanggal_mulai)));
		}
		if ($tanggal_akhir != null) {
			$where += array('a.penj_tanggal <= ' => date('Y-m-d', strtotime($tanggal_akhir)));
		}

		if ($supp_id != null) {
			$where += array('b.pede_supp_id' => $supp_id);
		}


		$get = $this->db->select_sum('a.penj_total_harga')->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')->get_where('penjualan a', $where)->result_array();

		return $get[0]['penj_total_harga'];
	}

	function getTotalHarga()
	{
		$where = array();

		$supp_id = $this->input->post('filter_vendor');
		$tanggal_mulai = $this->input->post('filter_tanggal_mulai');
		$tanggal_akhir = $this->input->post('filter_tanggal_akhir');

		if ($tanggal_mulai != null) {
			$where += array('a.penj_tanggal >= ' => date('Y-m-d', strtotime($tanggal_mulai)));
		}
		if ($tanggal_akhir != null) {
			$where += array('a.penj_tanggal <= ' => date('Y-m-d', strtotime($tanggal_akhir)));
		}

		if ($supp_id != null) {
			$where += array('b.pede_supp_id' => $supp_id);
		}


		$get = $this->db->select_sum('a.penj_total_harga')->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')->get_where('penjualan a', $where)->result_array();

		$this->output_json($get[0]['penj_total_harga']);
	}

	public function suratJalan($id)
	{
		$get 	= $this->penjualan->getAllDataCetak($id)->row_array();
		$get_detail 	= $this->penjualan->getAllDataCetak($id)->result_array();
		$this->data['penjualan'] = $get;
		$this->data['detail'] = $get_detail;
		$this->data['id'] = $id;
		// Page config:
		$this->title 	= 'Penjualan';
		$this->content 	= 'cetak-struk-surat-jalan';
		$this->plugins 	= ['datatables', 'formatrupiah'];
		$this->navigation = ['Penjualan'];
		// Commit render:
		$this->render();
	}


	public function ubahStatusPengiriman()
	{
		function getSuplierStokJumlah($ci, $produk, $vendor)
		{

			return (int)$ci->db->get_where("produk_stok", ["id_produk" => $produk, "id_supplier" => $vendor])->row_array()['jumlah'];
		}

		$vendor 	= json_decode(stripslashes($this->input->post('vendor')));
		$id 		= $this->input->post('id');
		$pisah 		= explode("|", $id);
		$id 		= $pisah[0];
		$id_penjualan = $pisah[1];
		$status 	= $this->input->post('status');
		$packer 	= $this->input->post('packer');
		$tanggal_kirim 	= $this->input->post('tanggal_kirim');

		// query
		$penjualan_detail = $this->db->get_where("penjualan_detail", ["pede_id" => $id])->row_array();
		$prod_stok = (int)$this->db->get_where("produk", ["prod_id" => $penjualan_detail['pede_prod_id']])->row_array()['prod_stok'];

		// edit supplayer stok
		if ($status == 'kirim') {
			$upd['pede_tanggal_kirim'] = $tanggal_kirim . " " . date('H:i:s');
		} elseif ($status == 'retur') {
			$upd['pede_tanggal_retur'] = $tanggal_kirim . " " . date('H:i:s');
		} elseif ($status == 'proses') {
			// jika status dari return dan kirim diubah kembali menjadi proses maka stok akan dikembalikan
			if (($penjualan_detail['pede_status_pengiriman'] != "") && ($penjualan_detail['pede_status_pengiriman'] == "kirim" || $penjualan_detail['pede_status_pengiriman'] == "retur")) {
				// // update produk stok
				$stok = $prod_stok + (int) $penjualan_detail['pede_jumlah'];
				$this->db->where('prod_id', $penjualan_detail['pede_prod_id']);
				$this->db->update('produk', ['prod_stok' => $stok]);

				// update produk_stok stok
				foreach ($vendor->vendor as $i => $val) {
					$id_supp = $val;
					$jumlah = $vendor->jumlah[$i];
					$stok_asal = getSuplierStokJumlah($this, $penjualan_detail['pede_prod_id'], $id_supp);

					// update produk_stok sstok
					$stok = $stok_asal + (int)$jumlah;
					$this->db->where(["id_produk" => $penjualan_detail['pede_prod_id'], "id_supplier" => $id_supp]);
					$this->db->update('produk_stok', ['jumlah' => $stok]);
				}
			}
		}

		if ($status == "kirim") {
			// cek penjualan status sebelumnya bukan kirim makan stok akan dikurangi
			if ($penjualan_detail['pede_status_pengiriman'] == "proses" || $penjualan_detail['pede_status_pengiriman'] == "") {
				foreach ($vendor->vendor as $i => $val) {
					$id_supp = $val;
					$jumlah = $vendor->jumlah[$i];
					$stok_asal = getSuplierStokJumlah($this, $penjualan_detail['pede_prod_id'], $id_supp);

					// update produk_stok sstok
					$stok = $stok_asal - (int)$jumlah;
					$this->db->where(["id_produk" => $penjualan_detail['pede_prod_id'], "id_supplier" => $id_supp]);
					$this->db->update('produk_stok', ['jumlah' => $stok]);
				}


				// // update produk stok
				if ($penjualan_detail['pede_status_pengiriman'] != "") {
					$stok = $prod_stok - (int) $penjualan_detail['pede_jumlah'];
					$this->db->where('prod_id', $penjualan_detail['pede_prod_id']);
					$this->db->update('produk', ['prod_stok' => $stok]);
				}
			}
		}

		// edit penjualan detail vendor
		// hapus semua
		$this->db->where('pede_id', $id);
		$this->db->delete('penjualan_detail_vendor');


		// tambah
		foreach ($vendor->vendor as $i => $val) {
			$id_supp = $val;
			$jumlah = $vendor->jumlah[$i];

			$this->db->insert('penjualan_detail_vendor', [
				'pede_id' => $id,
				'vendor_id' => $id_supp,
				'jumlah' => $jumlah
			]);
		}


		$upd['pede_status_pengiriman'] 	= $status;
		// $upd['pede_supp_id'] 			= $vendor;
		// $upd['pede_tanggal_kirim'] 		= date("Y-m-d H:i:s");
		$this->db->reset_query();


		$this->db->where('pede_id', $id);
		$this->db->update('penjualan_detail', $upd);

		$upd2['penj_status_pengiriman'] = $status;
		$upd2['penj_pack_id'] = $packer;
		$upd2['penj_tanggal_pengiriman'] = date("Y-m-d H:i:s");
		$this->db->where('penj_id', $id_penjualan);
		$this->db->update('penjualan', $upd2);


		$this->output_json(
			[
				'id' => $id
			]
		);
	}

	public function detail($id = null)
	{
		// Page config:
		$this->title = 'Penjualan';
		$this->content = 'penjualan-detail';
		$this->plugins = ['datatables', 'formatrupiah'];
		$this->navigation = ['Penjualan'];
		$this->data['id'] = $id;

		$this->data['detail'] = $this->penjualan->getDetail($id);
		$this->data['detailProduk'] = $this->penjualan->getDetailProduk($id);
		// Commit render:
		$this->render();
	}

	public function ubah($id = null)
	{
		// Page config:
		$this->title = 'Penjualan';
		$this->content = 'penjualan-ubah';
		$this->plugins = ['datatables', 'formatrupiah'];
		$this->navigation = ['Penjualan'];
		$this->data['id'] = $id;
		$this->data['listSumberPenjualan'] = $this->penjualan->getSumberPenjualan();
		$this->data['detail'] = $this->penjualan->getDetail($id);
		$this->data['detailProduk'] = $this->penjualan->getDetailProduk($id);
		// Commit render:
		$this->render();
	}

	public function ubahSimpan()
	{
		$code = $this->input->post('code');
		$data['penj_nama'] = $this->input->post('nama');
		$data['penj_no_hp'] = $this->input->post('no_hp');
		$data['penj_alamat'] = $this->input->post('alamat');
		$data['penj_tanggal'] = $this->input->post('tanggal');
		$data['penj_kondisi'] = $this->input->post('kondisi');
		$data['penj_supe_id'] = $this->input->post('supe_id');
		$data['penj_tanggal_pengiriman'] = $this->input->post('tanggal_pengiriman');
		$data['penj_keterangan'] = $this->input->post('keterangan');
		$data['penj_id_marketplace'] = $this->input->post('id_marketplace');
		$data['penj_kurir'] = $this->input->post('kurir');
		$data['penj_ongkir'] = $this->input->post('ongkir');
		$this->db->where('penj_id', $code);
		$this->db->update('penjualan', $data);
		redirect('penjualan/data/detail/' . $code, 'refresh');
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
		$filter_status_pengiriman = $this->input->post('filter_status_pengiriman');
		$filter_tanggal_mulai = $this->input->post('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->input->post('filter_tanggal_akhir');
		$filter_admin = $this->input->post('filter_admin');
		$filter_packer = $this->input->post('filter_packer');
		$filter_supplier = $this->input->post('filter_supplier');
		$filter_toko = $this->input->post('filter_toko');

		$data_session = array(
			'filter_tanggal_mulai' => $filter_tanggal_mulai,
			'filter_tanggal_akhir' => $filter_tanggal_akhir,
			'filter_admin' => $filter_admin,
			'filter_packer' => $filter_packer,
			'filter_supplier' => $filter_supplier,
		);

		$this->session->set_userdata($data_session);

		$data 	= $this->penjualan->getAllData($length, $start, $_cari, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_admin, $filter_packer, $filter_supplier, $filter_toko)->result_array();
		$count 	= $this->penjualan->getAllData(null, null, $_cari, $filter_status_pengiriman, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_admin, $filter_packer, $filter_supplier, $filter_toko)->num_rows();
		array($cari);
		echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
	}

	public function export_excel()
	{
		$filter_tanggal_mulai = $this->session->userdata('filter_tanggal_mulai');
		$filter_tanggal_akhir = $this->input->post('filter_tanggal_akhir');
		$filter_admin = $this->input->post('filter_admin');
		$filter_packer = $this->input->post('filter_packer');
		$filter_supplier = $this->input->post('filter_supplier');

		$data['penjualan'] = $this->penjualan->getAllData(null, null, null, null, $filter_tanggal_mulai, $filter_tanggal_akhir, $filter_admin, $filter_packer, $filter_supplier, null)->result_array();

		$this->load->view('templates/contents/cetak-laporan-penjualan-excel', $data);
	}

	public function import()
	{
		$this->load->library('excel');

		$fileName = $_FILES['file']['name'];

		$config['upload_path'] = './assets/'; //path upload
		$config['file_name'] = $fileName;  // nama file
		$config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
		$config['max_size'] = 100000; // maksimal sizze

		$this->load->library('upload'); //meload librari upload
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')) {
			echo $this->upload->display_errors();
			exit();
		}

		$inputFileName = './assets/' . $fileName;

		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
		}

		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();
		$kode_penjualan1 = '';

		for ($row = 2; $row <= $highestRow; $row++) {
			// Sesuaikan key array dengan nama kolom di database
			$kode_penjualan2 = $sheet->getCellByColumnAndRow(0, $row)->getValue();

			if ($kode_penjualan1 != $kode_penjualan2) {

				$data = array(
					"penj_id" => $sheet->getCellByColumnAndRow(0, $row)->getValue(),
					"penj_tanggal" => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
					"penj_toko_id" => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
					"penj_admin" => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
					"penj_keterangan" => $sheet->getCellByColumnAndRow(4, $row)->getValue(),
					"penj_no_resi" => $sheet->getCellByColumnAndRow(5, $row)->getValue(),
					"penj_nama" => $sheet->getCellByColumnAndRow(6, $row)->getValue(),
					"penj_no_hp" => $sheet->getCellByColumnAndRow(7, $row)->getValue(),
					"penj_alamat" => $sheet->getCellByColumnAndRow(8, $row)->getValue(),
					"penj_kurir" => $sheet->getCellByColumnAndRow(9, $row)->getValue(),
					"penj_user_id" => $this->session->userdata('data')['id']
				);

				$this->db->insert("penjualan", $data);
				$kode_penjualan1 = $sheet->getCellByColumnAndRow(0, $row)->getValue();
			}

			$data_detail = array(
				"pede_penj_id" => $kode_penjualan1,
				"pede_kate_id" => 42,
				"pede_kate_id_2" => 0,
				"pede_kate_id_3" => 0,
				"pede_prod_id" => $sheet->getCellByColumnAndRow(10, $row)->getValue(),
				"pede_harga" => $sheet->getCellByColumnAndRow(12, $row)->getValue(),
				"pede_jumlah" => $sheet->getCellByColumnAndRow(13, $row)->getValue(),
				"pede_total_harga" => $sheet->getCellByColumnAndRow(14, $row)->getValue(),
			);
			$this->db->insert("penjualan_detail", $data_detail);
		}
		redirect('penjualan/data');
		echo "<script>alert('Berhasil Import Data')</script>";
	}

	public function getDetail()
	{
		$id = $this->input->post('id');
		$get = $this->db->select('a.*, b.*, c.*,d.kela_nama')->where('b.penj_id', $id)->join('penjualan b', 'b.penj_id = a.pede_penj_id')->join('produk c', 'c.prod_id = a.pede_prod_id')->join('kelas d', 'd.kela_id = a.pede_kelas', 'left')->get('penjualan_detail a')->result_array();
		$output = $get;
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($output));
	}

	public function hangus()
	{
		$id = $this->input->post('id');

		// Check values
		if (empty($id)) $this->output_json(['message' => 'ID tidak boleh kosong']);

		$r = $this->penjualan->hangus($id);

		if ($r !== FALSE) {
			$this->output_json(
				[
					'id' => $id
				]
			);
		}
	}

	public function cetak($id)
	{
		$get 	= $this->penjualan->getAllDataCetak($id)->row_array();
		$get_detail 	= $this->penjualan->getAllDataCetak($id)->result_array();
		$this->data['penjualan'] = $get;
		$this->data['detail'] = $get_detail;
		$this->data['id'] = $id;
		// Page config:
		$this->title 	= 'Penjualan';
		$this->content 	= 'cetak-struk-penjualan';
		$this->plugins 	= ['datatables', 'formatrupiah'];
		$this->navigation = ['Penjualan'];
		// Commit render:
		$this->render();
	}

	public function getDriver()
	{
		$get = $this->db->select('*,a.id as id')->join('karyawan b', 'b.id = a.id_karyawan')->get('driver a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getVendor()
	{
		$get = $this->db->select('*')->get('supplier a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	public function getKendaraan()
	{
		$get = $this->db->select('*')->get('kendaraan a')->result_array();
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get));
	}

	private function output_json($data)
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
	}

	public function scannBarcode()
	{
		$no_resi = $this->input->post('no_resi');
		$exe = $this->db->get_where('penjualan', ['penj_no_resi' => $no_resi])->row_array();
		$exe2 = $this->db->select('*')->join('produk b', 'a.pede_prod_id = b.prod_id')->join('supplier c', 'a.pede_supp_id = c.supp_id')->get_where('penjualan_detail a', ['a.pede_penj_id' => $exe['penj_id']])->result_array();
		$exe['produk_detail'] = $exe2;

		$this->output_json($exe);
	}

	public function postBarcode()
	{
		$id = $this->input->post('id');
		$no_resi = $this->input->post('no_resi');
		$vendor = $this->input->post('vendor');
		$packer = $this->input->post('packer');
		$tanggal = $this->input->post('tanggal');
		$status = $this->input->post('status');

		$exe = $this->db->where('penj_id', $id)->update('penjualan', [
			'penj_supe_id' => $vendor,
			'penj_pack_id' => $packer,
			'penj_tanggal' => $tanggal,
			'penj_status' => $status,
		]);

		$exe = $this->db->get_where('penjualan_detail', ['pede_penj_id' => $id])->result_array();


		foreach ($exe as $r) {
			if ($status == 'kirim') {
				$product = $this->db->get_where('produk', ['prod_id' => $r['pede_prod_id']])->row_array();
				$exe_update = $this->db->where('prod_id', $r['pede_prod_id'])->update('produk', [
					'prod_stok' => (int)$product['prod_stok'] - (int)$r['pede_jumlah']
				]);
			} else if ($status == 'retur') {
				$product = $this->db->get_where('produk', ['prod_id' => $r['pede_prod_id']])->row_array();
				$exe_update = $this->db->where('prod_id', $r['pede_prod_id'])->update('produk', [
					'prod_stok' => (int)$product['prod_stok'] + (int)$r['pede_jumlah']
				]);
			}
		}

		echo json_encode($exe);
	}

	public function changeVendor()
	{
		$exe = $this->db->where(['pede_id' => $this->input->post('id')])->update('penjualan_detail', [
			'pede_supp_id' => $this->input->post('vendor')
		]);
		echo json_encode($exe);
	}

	public function getVendorByIdPeDe()
	{
		$id = $this->input->post('id');
		$result = $this->penjualan->getVendorByIdPede($id);
		$this->output_json($result);
	}

	public function getStokByVendorPeDe()
	{
		$vendor_id = $this->input->post("vendor_id");
		$prod_id = $this->input->post("prod_id");

		$result = $this->penjualan->getStokByVendorPeDe($vendor_id, $prod_id);
		$this->output_json($result ? $result['jumlah'] : 0);
	}

	public function getPackerByPeDe()
	{
		$id = $this->input->post("id");
		$result = $this->penjualan->getPackerByPeDe($id);
		$this->output_json($result ? $result["penj_pack_id"] : "");
	}

	public function getDetailPede()
	{
		$id = $this->input->post("id");
		$result = $this->penjualan->getDataById($id);
		$this->output_json($result);
	}

	// Penjualan gudang kirim
	public function penjualanKirim()
	{
		// menyiapkan data variable
		$id = $this->input->post('id');
		$pisah = explode("|", $id);

		$vendor = json_decode(stripslashes($this->input->post('vendor')));
		$id = $pisah[0];
		$id_prod = $pisah[2];
		$id_penjualan = $pisah[1];
		$packer = $this->input->post('packer');
		$tanggal_kirim = $this->input->post('tanggal_kirim');
		$qty = 0;

		// input tabel penjualan detail vendor dan tabel produk stok
		foreach ($vendor->vendor as $i => $val) {
			$id_supp = $val;
			$jumlah = $vendor->jumlah[$i];

			// input penjualan detail vendor
			$this->db->insert('penjualan_detail_vendor', [
				'pede_id' => $id,
				'vendor_id' => $id_supp,
				'jumlah' => $jumlah
			]);

			// get stok awal
			$stok_asal = $this->penjualan->getSuplierStokJumlah($id_prod, $id_supp);

			// update produk_stok sstok
			$stok = $stok_asal - (int)$jumlah;
			$this->db->where(["id_produk" => $id_prod, "id_supplier" => $id_supp]);
			$this->db->update('produk_stok', ['jumlah' => $stok]);
		}

		// ubah status penjualan detail ke kirim
		$upd['pede_tanggal_kirim'] = $tanggal_kirim . " " . date('H:i:s');
		$upd['pede_status_pengiriman'] 	= 'kirim';

		$this->db->reset_query();
		$this->db->where('pede_id', $id);
		$this->db->update('penjualan_detail', $upd);

		// ubah status penjualan terngantung pede
		// get penjualan detail where id penjualan
		$status_penjualan = $this->penjualan->getAllDetailPenjualanForPenjualan($id_penjualan);
		$upd2['penj_status_pengiriman'] = $status_penjualan;
		$upd2['penj_pack_id'] = $packer;
		$upd2['penj_tanggal_pengiriman'] = date("Y-m-d H:i:s");
		$this->db->where('penj_id', $id_penjualan);
		$this->db->update('penjualan', $upd2);
		$this->output_json($vendor);
	}

	// Penjualan gudang retur
	public function penjualanRetur()
	{
		$id = $this->input->post('id');
		$pisah = explode("|", $id);

		// pede_id
		$id = $pisah[0];
		$penj_id = $pisah[1];
		$prod_id = $pisah[2];
		$tanggal = $this->input->post('tanggal');
		$vendor = json_decode(stripslashes($this->input->post('vendor')));

		// kembalikan produk_stok
		foreach ($vendor->vendor as $i => $val) {
			$id_supp = $val;
			$jumlah = $vendor->jumlah[$i];

			// get stok awal
			$stok_asal = $this->penjualan->getSuplierStokJumlah($prod_id, $id_supp);

			// update produk_stok sstok
			$stok = $stok_asal + (int)$jumlah;
			$this->db->where(["id_produk" => $prod_id, "id_supplier" => $id_supp]);
			$this->db->update('produk_stok', ['jumlah' => $stok]);
		}
		// hapus pembelian detail vendor by id pede
		$this->db->reset_query();
		$this->db->where('pede_id', $id);
		$this->db->delete('penjualan_detail_vendor');


		// set dan update penjualan detail status dan tanggal retur
		$upd['pede_tanggal_retur'] = $tanggal . " " . date('H:i:s');
		$upd['pede_status_pengiriman'] 	= 'retur';

		$this->db->reset_query();
		$this->db->where('pede_id', $id);
		$this->db->update('penjualan_detail', $upd);

		// update status tabel penjualan by id penj
		$this->db->reset_query();
		$status_penjualan = $this->penjualan->getAllDetailPenjualanForPenjualan($penj_id);
		$upd2['penj_status_pengiriman'] = $status_penjualan;
		$this->db->where('penj_id', $penj_id);
		$this->db->update('penjualan', $upd2);
		$this->output_json($vendor);
	}

	function __construct()
	{
		parent::__construct();
		$this->default_template = 'templates/dashboard';
		$this->load->library('plugin');
		$this->load->helper('url');
		$this->load->model('penjualan/data_model', 'penjualan');
		$this->level = $this->session->userdata('data')['level'];
		// cek session
		$this->sesion->cek_session();
	}
}
