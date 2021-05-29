<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{

	public function harga_lama()
	{
		$sql = $this->db->select('e.kate_nama as kategori')
			->select('SUM(e.kate_deskripsi) as harga_lama')
			->join('produk c', 'c.prod_id = a.pend_prod_id')
			->join('kategori e', 'e.kate_id = a.pend_kate_id')
			->group_by('e.kate_id')
			->get('pengadaan_detail a')
			->result_array();
		return $sql;
	}

	public function harga_olah()
	{
		$sql = $this->db->select('e.kate_nama as kategori')
			->select('SUM(c.prod_harga_jual) as harga_olah')
			->join('produk c', 'c.prod_id = a.pend_prod_id')
			->join('kategori e', 'e.kate_id = c.prod_kate_id')
			->group_by('e.kate_id')
			->get('pengadaan_detail a')
			->result_array();
		return $sql;
	}

	public function harga_jual()
	{
		$sql = $this->db->select('a.pede_kate_id as kategori')
			->select('SUM(a.pede_harga) as harga_jual')
			// ->join('produk c','c.prod_id = a.pede_prod_id')
			->join('kategori e', 'e.kate_id = a.pede_kate_id')
			->group_by('a.pede_kate_id')
			->get('penjualan_detail a')
			->result_array();
		return $sql;
	}

	public function harga_jual_dasar()
	{
		$sql = $this->db->select('a.pede_kate_id as kategori')
			->select('SUM(c.prod_harga_beli) as harga_jual_dasar')
			->join('produk c', 'c.prod_id = a.pede_prod_id')
			->join('kategori e', 'e.kate_id = a.pede_kate_id')
			->group_by('a.pede_kate_id')
			->get('penjualan_detail a')
			->result_array();
		return $sql;
	}

	public function harga_sisa_dasar()
	{
		$sql = $this->db->select('e.kate_nama as kategori')
			->select('SUM(c.prod_harga_jual) as harga_sisa_dasar')
			->join('kategori e', 'e.kate_id = c.prod_kate_id', 'left')
			->where('c.prod_status', 'Tersedia')
			->group_by('e.kate_nama')
			->get('produk c')
			->result_array();
		// var_dump($sql);
		// exit();
		return $sql;
	}

	public function getAllDataKeuntungan()
	{
		$sql = $this->db->select('c.prod_nama,d.kate_nama as kategori,e.kate_deskripsi')
			// ->select('SUM(e.kate_deskripsi) as harga_lama')
			// ->select('SUM(f.kate_deskripsi) as harga_olah')
			// ->select('SUM(d.kate_deskripsi) as harga_laku')
			->join('penjualan b', 'a.pede_penj_id = b.penj_id')
			->join('produk c', 'c.prod_id = a.pede_prod_id')
			->join('kategori e', 'e.kate_id = a.pede_kate_id')
			->join('kategori f', 'f.kate_id = c.prod_kate_id')
			->join('kategori d', 'd.kate_id = a.pede_kate_id')
			->order_by('d.kate_id', 'ASC')
			->group_by('d.kate_id')
			// ->where('e.kate_id',6)
			->get('penjualan_detail a')
			->result_array();

		return $sql;
	}

	public function getAllDataKeuntunganLaporan()
	{
		$sql = $this->db->select('d.kate_nama as kategori, b.penj_id as faktur, b.penj_tanggal as tanggal, c.prod_nama as no_rec')
			->select('e.kate_deskripsi as harga_lama')
			->select('f.kate_deskripsi as harga_olah')
			->select('a.pede_harga as harga_laku')
			->join('penjualan b', 'a.pede_penj_id = b.penj_id')
			->join('produk c', 'c.prod_id = a.pede_prod_id')
			->join('kategori e', 'e.kate_id = c.prod_kate_lama')
			->join('kategori f', 'f.kate_id = c.prod_kate_id')
			->join('kategori d', 'd.kate_id = a.pede_kate_id')
			->order_by('d.kate_id', 'ASC')
			// ->group_by('d.kate_id')
			->get('penjualan_detail a')
			->result_array();
		return $sql;
	}

	public function getAllData()
	{
		$sql 		= " SELECT 	SUM(IF(pr.prod_kate_id = 1, pr.prod_stok, 0)) AS prod_1,
								SUM(IF(pr.prod_kate_id = 2, pr.prod_stok, 0)) AS prod_2,
								SUM(IF(pr.prod_kate_id = 3, pr.prod_stok, 0)) AS prod_3,
								SUM(IF(pr.prod_kate_id = 4, pr.prod_stok, 0)) AS prod_4,
								SUM(IF(pr.prod_kate_id = 5, pr.prod_stok, 0)) AS prod_5,
								SUM(IF(pr.prod_kate_id = 6, pr.prod_stok, 0)) AS prod_6,
								SUM(IF(pr.prod_kate_id = 7, pr.prod_stok, 0)) AS prod_7,

								SUM(IF(pr.prod_kate_id = 1 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_1,
								SUM(IF(pr.prod_kate_id = 2 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_2,
								SUM(IF(pr.prod_kate_id = 3 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_3,
								SUM(IF(pr.prod_kate_id = 4 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_4,
								SUM(IF(pr.prod_kate_id = 5 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_5,
								SUM(IF(pr.prod_kate_id = 6 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_6,
								SUM(IF(pr.prod_kate_id = 7 AND pr.prod_status = 'Tersedia', pr.prod_stok, 0)) AS prod_sisa_7,

								SUM(IF(pr.prod_kategori_terjual = 1 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_1,
								SUM(IF(pr.prod_kategori_terjual = 2 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_2,
								SUM(IF(pr.prod_kategori_terjual = 3 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_3,
								SUM(IF(pr.prod_kategori_terjual = 4 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_4,
								SUM(IF(pr.prod_kategori_terjual = 5 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_5,
								SUM(IF(pr.prod_kategori_terjual = 6 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_6,
								SUM(IF(pr.prod_kategori_terjual = 7 AND pr.prod_status = 'Terjual', pr.prod_stok, 0)) AS prod_jual_7

						FROM produk pr
						JOIN kategori k
						ON pr.prod_kate_id = k.kate_id";

		$exe 		= $this->db->query($sql);

		return $exe;
		return null;
	}
	public function getProdukTerjual()
	{
		$sql 		= " SELECT SUM(pede_jumlah) AS total_produkTerjual
						FROM penjualan_detail";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getProdukSisa()
	{
		$sql 		= " SELECT SUM(prod_stok) AS prod_sisa
						FROM produk";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getPemasukan()
	{
		$sql 		= " SELECT SUM(penj_total_harga) AS pemasukan
						FROM penjualan";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getPengeluaran()
	{
		$sql 		= " SELECT SUM(peng_total_harga) AS pengeluaran
						FROM pengadaan";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getDombaTerjualDetail()
	{
		$sql 		= " SELECT 	SUM(IF(pr.prod_kate_id = 1, pr.prod_stok, 0)) AS prod_1,
								SUM(IF(pr.prod_kate_id = 2, pr.prod_stok, 0)) AS prod_2,
								SUM(IF(pr.prod_kate_id = 3, pr.prod_stok, 0)) AS prod_3,
								SUM(IF(pr.prod_kate_id = 4, pr.prod_stok, 0)) AS prod_4,
								SUM(IF(pr.prod_kate_id = 5, pr.prod_stok, 0)) AS prod_5,
								SUM(IF(pr.prod_kate_id = 6, pr.prod_stok, 0)) AS prod_6,
								SUM(IF(pr.prod_kate_id = 7, pr.prod_stok, 0)) AS prod_7
						FROM produk pr
						JOIN kategori k
						ON pr.prod_kate_id = k.kate_id
						WHERE prod_status = 'Terjual'";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getDombaSisaDetail()
	{
		$sql 		= " SELECT 	SUM(IF(pr.prod_kate_id = 1, pr.prod_stok, 0)) AS prod_1,
								SUM(IF(pr.prod_kate_id = 2, pr.prod_stok, 0)) AS prod_2,
								SUM(IF(pr.prod_kate_id = 3, pr.prod_stok, 0)) AS prod_3,
								SUM(IF(pr.prod_kate_id = 4, pr.prod_stok, 0)) AS prod_4,
								SUM(IF(pr.prod_kate_id = 5, pr.prod_stok, 0)) AS prod_5
								SUM(IF(pr.prod_kate_id = 6, pr.prod_stok, 0)) AS prod_6,
								SUM(IF(pr.prod_kate_id = 7, pr.prod_stok, 0)) AS prod_7
						FROM produk pr
						JOIN kategori k
						ON pr.prod_kate_id = k.kate_id
						WHERE prod_status = 'Tersedia'";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getPemasukanDetail()
	{
		$sql 		= " SELECT 	SUM(penj_dibayar) AS pemasukan_diDepot,
								SUM(penj_sisa) AS pemasukan_diKonsumen
						FROM penjualan";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function getPengeluaranDetail()
	{
		$sql 		= " SELECT 	SUM(IF(pean_kategori = 'Divisi 1', pean_nominal, 0)) AS pengeluaran_1,
								SUM(IF(pean_kategori = 'Divisi 2', pean_nominal, 0)) AS pengeluaran_2,
								SUM(IF(pean_kategori = 'Divisi 3', pean_nominal, 0)) AS pengeluaran_3
						FROM pengeluaran";

		$exe 		= $this->db->query($sql);

		return $exe;
	}

	public function total_produk()
	{
		return $this->db->get('produk')->num_rows();
	}

	public function total_stok()
	{
		$data = $this->db->select_sum('prod_stok')->get('produk')->row_array();
		return $data['total'] = $data['prod_stok'];
	}

	public function total_nominal_pengadaan()
	{
		$data = $this->db->select_sum('peng_total_harga')->get('pengadaan')->row_array();
		return $data['total'] = $data['peng_total_harga'];
	}

	public function total_nominal_penjualan()
	{
		$data = $this->db->select_sum('penj_total_harga')->get('penjualan')->row_array();
		return $data['total'] = $data['penj_total_harga'];
	}

	public function total_laba()
	{
		$data1 = $this->db->select_sum('penj_total_harga')->get('penjualan')->row_array();
		$data2 = $this->db->select_sum('peng_total_harga')->get('pengadaan')->row_array();
		$total = $data1['penj_total_harga'] - $data2['peng_total_harga'];
		if ($total < 0) {
			$total = 0;
		}
		return $total;
	}

	public function total_rugi()
	{
		$data1 = $this->db->select_sum('penj_total_harga')->get('penjualan')->row_array();
		$data2 = $this->db->select_sum('peng_total_harga')->get('pengadaan')->row_array();
		$total = $data2['peng_total_harga'] - $data1['penj_total_harga'];
		if ($total < 0) {
			$total = 0;
		}
		return $total;
	}

	public function total_barang_terjual()
	{
		$data = $this->db->select_sum('b.pede_jumlah')->from('penjualan a')->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')->get()->row_array();
		return $data['total'] = $data['pede_jumlah'];
	}

	public function total_piutang()
	{
		$data = $this->db->select_sum('a.penj_sisa')->from('penjualan a')->join('penjualan_detail b', 'b.pede_penj_id = a.penj_id')->where('a.penj_status', 'Piutang')->get()->row_array();
		return $data['total'] = $data['penj_sisa'];
	}

	public function total_hutang()
	{
		$data = $this->db->select_sum('b.pend_total_harga')->from('pengadaan a')->join('pengadaan_detail b', 'b.pend_peng_id = a.peng_id')->where('b.pend_status_pengiriman', 'Hutang')->get()->row_array();
		return $data['total'] = $data['pend_total_harga'];
	}

	public function total_rak()
	{
		$data = $this->db->select_sum('prod_rak_jumlah')->get('produk')->row_array();
		return $data['total'] = $data['prod_rak_jumlah'];
	}

	public function total_etalase()
	{
		$data = $this->db->select_sum('prod_etal_jumlah')->get('produk')->row_array();
		return $data['total'] = $data['prod_etal_jumlah'];
	}

	public function total_posting_facebook()
	{
		return $data['total'] = $this->db->where('prod_facebook', 'sudah')->get('produk')->num_rows();
	}

	public function total_posting_bukalapak()
	{
		return $data['total'] = $this->db->where('prod_bukalapak', 'sudah')->get('produk')->num_rows();
	}

	public function total_posting_tokopedia()
	{
		return $data['total'] = $this->db->where('prod_tokopedia', 'sudah')->get('produk')->num_rows();
	}

	public function total_posting_shopee()
	{
		return $data['total'] = $this->db->where('prod_shopee', 'sudah')->get('produk')->num_rows();
	}

	public function getAdmin()
	{
		return $this->db->get("admin")->result_array();
	}
	public function getSuplier()
	{
		return $this->db->get("supplier")->result_array();
	}

	public function getDataPenjualan($dari = "", $sampai = "")
	{
		return $this->db->query("SELECT
		a.prod_nama as nama,
		(SELECT sum(b.pede_jumlah) FROM penjualan_detail as b join penjualan as e on e.penj_id = b.pede_penj_id WHERE b.pede_prod_id = a.prod_id and b.pede_status_pengiriman = '' and e.penj_tanggal >= '$dari' and  e.penj_tanggal <= '$sampai') as permintaan,
		(SELECT sum(c.jumlah) FROM produk_stok as c WHERE c.id_produk = a.prod_id) as stok
		FROM produk as a")->result_array();
	}

	public function getStatusPenjualan($dari = "", $sampai = "")
	{
		// ci query builder
		// mudah tapi berat saat di query ke database
		return [
			'proses' =>
			$this->db->get_where("penjualan_detail", [
				"pede_status_pengiriman" => "proses",
				"pede_tanggal_kirim >=" => "$dari 00:00:00",
				"pede_tanggal_kirim <=" => "$sampai 23:59:59"
			])->num_rows(),
			'kirim' => $this->db->get_where("penjualan_detail", [
				"pede_status_pengiriman" => "kirim",
				"pede_tanggal_kirim >=" => "$dari 00:00:00",
				"pede_tanggal_kirim <=" => "$sampai 23:59:59"
			])->num_rows(),
			'retur' => $this->db->get_where("penjualan_detail", [
				"pede_status_pengiriman" => "retur",
				"pede_tanggal_kirim >=" => "$dari 00:00:00",
				"pede_tanggal_kirim <=" => "$sampai 23:59:59"
			])->num_rows()
		];
		// // manual
		// // ringan tampi rumit saat di query ke database
		// return [
		// 	"proses" => $this->db->query("SELECT count(*) as counts FROM penjualan_detail WHERE pede_status_pengiriman = 'proses' and pede_tanggal_kirim >= '$dari 00:00:00' and  pede_tanggal_kirim <= '$sampai 23:59:59'")->row_array()['counts'],
		// 	"kirim" => $this->db->query("SELECT count(*) as counts FROM penjualan_detail WHERE pede_status_pengiriman = 'kirim' and pede_tanggal_kirim >= '$dari 00:00:00' and  pede_tanggal_kirim <= '$sampai 23:59:59'")->row_array()['counts'],
		// 	"retur" => $this->db->query("SELECT count(*) as counts FROM penjualan_detail WHERE pede_status_pengiriman = 'retur' and pede_tanggal_kirim >= '$dari 00:00:00' and  pede_tanggal_kirim <= '$sampai 23:59:59'")->row_array()['counts'],
		// ];
	}
}
