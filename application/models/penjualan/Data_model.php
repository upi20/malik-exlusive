<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{

	public function getAllData($show = null, $start = null, $cari = null, $filter_status_pengiriman = null, $filter_tanggal_mulai = null, $filter_tanggal_akhir = null, $filter_admin = null, $filter_packer = null, $filter_supplier = null, $filter_toko = null)
	{
		$this->db->select(" a.*, b.* ,u.*, w.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*, t.nama as toko, sp.supp_nama");

		$this->db->from("penjualan_detail b");
		$this->db->join("penjualan a", 'b.pede_penj_id = a.penj_id');
		$this->db->join("packer w", 'w.pack_id = a.penj_pack_id', 'left');


		$this->db->join('kategori z', 'z.kate_id = b.pede_kate_id', 'left');
		$this->db->join('kategori x', 'x.kate_id = b.pede_kate_id_2', 'left');
		$this->db->join('kategori y', 'y.kate_id = b.pede_kate_id_3', 'left');
		$this->db->join('produk d', 'd.prod_id = b.pede_prod_id');
		$this->db->join('toko t', 't.id = a.penj_toko_id');

		$this->db->join("users u", "a.penj_user_id = u.user_id");
		$this->db->join("supplier sp", "sp.supp_id = b.pede_supp_id", "left");
		$this->db->order_by('b.pede_id', 'desc');


		if ($filter_status_pengiriman != null) {
			$this->db->where('a.penj_status_pengiriman', $filter_status_pengiriman);
		}

		if ($filter_tanggal_mulai != null) {
			$this->db->where('a.penj_tanggal >= ', date('Y-m-d', strtotime($filter_tanggal_mulai)));
		}

		if ($filter_tanggal_akhir != null) {
			$this->db->where('a.penj_tanggal <= ', date('Y-m-d', strtotime($filter_tanggal_akhir)));
		}

		if ($filter_admin != null) {
			$this->db->where('a.penj_admin', $filter_admin);
		}

		if ($filter_packer != null) {
			$this->db->where('a.penj_pack_id', $filter_packer);
		}

		if ($filter_supplier != null) {
			$this->db->where('sp.supp_id', $filter_supplier);
		}

		if ($filter_toko != null) {
			$this->db->where('a.penj_toko_id', $filter_toko);
		}

		$this->db->where("(u.user_email LIKE '%" . $cari . "%' or a.penj_nama LIKE '%" . $cari . "%' or a.penj_alamat LIKE '%" . $cari . "%' or a.penj_no_hp LIKE '%" . $cari . "%' or a.penj_total_harga LIKE '%" . $cari . "%' or a.penj_dibayar LIKE '%" . $cari . "%' or a.penj_sisa LIKE '%" . $cari . "%' or a.penj_lokasi LIKE '%" . $cari . "%' or a.penj_keterangan LIKE '%" . $cari . "%' or d.prod_nama LIKE '%" . $cari . "%' or z.kate_nama LIKE '%" . $cari . "%' or w.pack_nama LIKE '%" . $cari . "%') ");
		if ($show == null && $start == null) {
			$return = $this->db->get();
		} else {
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllDataBatal($show = null, $start = null, $cari = null)
	{
		$this->db->select(" a.*, u.*, sp.*");
		$this->db->from("penjualan a");
		$this->db->join("users u", "a.penj_user_id = u.user_id");
		$this->db->join("sumber_penjualan sp", "sp.supe_id = a.penj_supe_id");
		$this->db->where('a.penj_status', 'Piutang');
		$this->db->where("(u.user_email LIKE '%" . $cari . "%' or a.penj_nama LIKE '%" . $cari . "%' or a.penj_alamat LIKE '%" . $cari . "%' or a.penj_no_hp LIKE '%" . $cari . "%' or a.penj_total_harga LIKE '%" . $cari . "%' or a.penj_dibayar LIKE '%" . $cari . "%' or a.penj_sisa LIKE '%" . $cari . "%' or a.penj_lokasi LIKE '%" . $cari . "%' or a.penj_keterangan LIKE '%" . $cari . "%') ");
		if ($show == null && $start == null) {
			$return = $this->db->get();
		} else {
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getDetail($id = null)
	{
		$query = $this->db->join('sumber_penjualan sp', 'sp.supe_id = p.penj_supe_id', 'left')->get_where('penjualan p', array('p.penj_id' => $id))->row_array();
		return $query;
	}

	public function getSumberPenjualan()
	{
		$query = $this->db->get_where('sumber_penjualan p')->result_array();
		return $query;
	}

	public function getDetailProduk($id = null)
	{
		$query = $this->db->select('*,z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3')
			->join('produk b', 'b.prod_id = a.pede_prod_id')
			->join('kategori z', 'z.kate_id = b.prod_kate_id', 'left')
			->join('kategori x', 'x.kate_id = b.prod_kate_id_2', 'left')
			->join('kategori y', 'y.kate_id = b.prod_kate_id_3', 'left')
			->get_where('penjualan_detail a', array('a.pede_penj_id' => $id))
			->result_array();
		return $query;
	}

	public function getPembayaran($show = null, $start = null, $cari = null)
	{
		$this->db->select(" a.*, b.*");
		$this->db->from("penjualan_pembayaran b");
		$this->db->join("penjualan a", "a.penj_id = b.pepe_penj_id");
		$this->db->where("(a.penj_nama LIKE '%" . $cari . "%' or a.penj_alamat LIKE '%" . $cari . "%' or a.penj_no_hp LIKE '%" . $cari . "%' or a.penj_total_harga LIKE '%" . $cari . "%' or a.penj_dibayar LIKE '%" . $cari . "%' or a.penj_sisa LIKE '%" . $cari . "%' or a.penj_lokasi LIKE '%" . $cari . "%' or a.penj_keterangan LIKE '%" . $cari . "%') ");
		if ($show == null && $start == null) {
			$return = $this->db->get();
		} else {
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllDataCetak($id)
	{
		$where = ['penj_id' => $id];

		$this->db->select(" a.*, b.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*");
		$this->db->from("penjualan_detail a");
		$this->db->join('penjualan b', 'b.penj_id = a.pede_penj_id');
		$this->db->join('kategori z', 'z.kate_id = a.pede_kate_id', 'left');
		$this->db->join('kategori x', 'x.kate_id = a.pede_kate_id_2', 'left');
		$this->db->join('kategori y', 'y.kate_id = a.pede_kate_id_3', 'left');
		$this->db->join('produk d', 'd.prod_id = a.pede_prod_id');
		$this->db->order_by('a.pede_id', 'desc');
		$this->db->where($where);

		$return = $this->db->get();

		// return
		return $return;
	}

	public function getVendorByIdPede($id)
	{
		$result = $this->db->get_where("penjualan_detail_vendor", ["pede_id" => $id])->result_array();
		return $result;
	}

	public function hangus($id)
	{
		$get = $this->db->where('pede_penj_id', $id)->get('penjualan_detail')->result_array();
		foreach ($get as $q) {
			$prod_id = $q['pede_prod_id'];

			$upd['prod_status'] = "Tersedia";
			$this->db->where('prod_id', $prod_id);
			$this->db->update('produk', $upd);
		}
		$upd2['penj_status'] = "Hangus";
		$this->db->where('penj_id', $id);
		$this->db->update('penjualan', $upd2);
		return true;
	}

	public function getStokByVendorPeDe($vendor_id, $prod_id)
	{
		return $this->db->select('jumlah')
			->from('produk_stok')
			->where(['id_produk' => $prod_id, 'id_supplier' => $vendor_id])
			->get()
			->row_array();
	}

	public function getPackerByPeDe($id)
	{
		return $this->db->select("b.penj_pack_id")
			->from("penjualan_detail a")
			->join("penjualan b", "a.pede_penj_id = b.penj_id")
			->where(['a.pede_id' => $id])
			->get()
			->row_array();
	}

	public function getDataById($id)
	{
		$this->db->select(" a.*, b.* ,u.*, w.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*, t.nama as toko, sp.supp_nama");

		$this->db->from("penjualan_detail b");
		$this->db->join("penjualan a", 'b.pede_penj_id = a.penj_id');
		$this->db->join("packer w", 'w.pack_id = a.penj_pack_id', 'left');


		$this->db->join('kategori z', 'z.kate_id = b.pede_kate_id', 'left');
		$this->db->join('kategori x', 'x.kate_id = b.pede_kate_id_2', 'left');
		$this->db->join('kategori y', 'y.kate_id = b.pede_kate_id_3', 'left');
		$this->db->join('produk d', 'd.prod_id = b.pede_prod_id');
		$this->db->join('toko t', 't.id = a.penj_toko_id');

		$this->db->join("users u", "a.penj_user_id = u.user_id");
		$this->db->join("supplier sp", "sp.supp_id = b.pede_supp_id", "left");
		$this->db->where(['b.pede_id' => $id]);

		return $this->db->get()->row_array();
	}
}
