<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_model extends CI_Model
{

	public function getAllData($show = null, $start = null, $cari = null)
	{
		$this->db->select(" a.*");
		$this->db->from("pengadaan a");
		$this->db->where("(a.peng_id LIKE '%" . $cari . "%' or a.peng_nominal LIKE '%" . $cari . "%' or a.peng_keterangan LIKE '%" . $cari . "%' or a.peng_status LIKE '%" . $cari . "%') ");
		if ($show == null && $start == null) {
			$return = $this->db->get();
		} else {
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllDataDetail($show = null, $start = null, $cari = null)
	{
		$this->db->select(" a.*, b.*, z.kate_id as kate_id_1, z.kate_nama as kate_nama_1, x.kate_id as kate_id_2, x.kate_nama as kate_nama_2, y.kate_id as kate_id_3, y.kate_nama as kate_nama_3, d.*, e.*");
		$this->db->from("pengadaan_detail a");
		$this->db->join('pengadaan b', 'b.peng_id = a.pend_peng_id');
		$this->db->join('kategori z', 'z.kate_id = a.pend_kate_id', 'left');
		$this->db->join('kategori x', 'x.kate_id = a.pend_kate_id_2', 'left');
		$this->db->join('kategori y', 'y.kate_id = a.pend_kate_id_3', 'left');
		$this->db->join('produk d', 'd.prod_id = a.pend_prod_id');
		$this->db->join('supplier e', 'e.supp_id = a.pend_supp_id', 'left');
		$this->db->where('b.peng_status != ', 'Selesai');
		$this->db->where("(z.kate_nama LIKE '%" . $cari . "%' or a.pend_jumlah LIKE '%" . $cari . "%' or a.pend_harga LIKE '%" . $cari . "%' or a.pend_total_harga LIKE '%" . $cari . "%' or b.peng_total_harga LIKE '%" . $cari . "%') ");

		if ($show == null && $start == null) {
			$return = $this->db->get();
		} else {
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function getTotalHarga()
	{
		$get = $this->db->select_sum('a.pend_total_harga')->join('pengadaan b', 'b.peng_id = a.pend_peng_id')->get_where('pengadaan_detail a', array('b.peng_status' => 'belum'))->row_array();
		return $get['pend_total_harga'];
	}

	public function insertHead($id, $tanggal, $keterangan, $total_harga, $dibayar, $sisa, $supp_id)
	{
		$status 	= 'Selesai';
		$status_manager 	= 'terima';
		$status_purchasing 	= 'terima';

		$get_detail = $this->db->where('pend_peng_id', $id)->get('pengadaan_detail');
		$total_produk = $get_detail->num_rows();
		$total_harga_product = 0;
		foreach ($get_detail->result_array() as $d) {
			$total_harga_product = $total_harga_product + $d['pend_total_harga'];
		}

		$sql = "UPDATE pengadaan SET peng_total_harga=?, peng_dibayar=?, peng_sisa=?, peng_keterangan=?, peng_tanggal=?, peng_status=?, peng_status_purchasing=?, peng_status_manager=?, peng_supp_id=? WHERE peng_id=?;";
		$q = $this->db->query($sql, [$total_harga_product, $dibayar, $sisa, $keterangan, $tanggal, $status, $status_purchasing, $status_manager, $supp_id, $id]);

		// $get = $this->db->where('pend_peng_id', $id)->get('pengadaan_detail')->result_array();
		// foreach ($get as $q) {
		// 	$prod_id 			= $q['pend_prod_id'];
		// 	$get_stok = $this->db->get_where('produk', array('prod_id' => $prod_id))->row_array();

		// 	$data['prod_stok'] 	= $get_stok['prod_stok'] + $q['pend_jumlah'];
		// 	$exe 				= $this->db->where('prod_id', $prod_id);
		// 	$exe 				= $this->db->update('produk', $data);
		// }
		$return['id'] = $id;
		return $return;
	}

	public function insert($code, $parent1, $parent2, $parent3, $prod_id, $jumlah, $harga, $total, $berat, $supp_id, $kode_produk_alias, $no_tracking, $link_referensi)
	{

		$status_pengiriman = "Piutang";

		$cek = $this->db->get_where('pengadaan', array('peng_id' => $code))->num_rows();
		if ($cek < 1) {
			$sql0 = "INSERT INTO pengadaan (peng_id, peng_status) VALUES (?, ?)";
			$q0 = $this->db->query($sql0, [$code, 'belum']);
		}
		$sql = "INSERT INTO pengadaan_detail (pend_peng_id, pend_kate_id, pend_kate_id_2, pend_kate_id_3, pend_prod_id, pend_jumlah, pend_harga, pend_total_harga, pend_berat, pend_supp_id, pend_kode_produk_alias, pend_status_pengiriman) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

		$q = $this->db->query($sql, [$code, $parent1, $parent2, $parent3, $prod_id, $jumlah, $harga, $total, $berat, $supp_id, $kode_produk_alias, $status_pengiriman]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function hapusDetail($id)
	{
		$sql = "DELETE FROM pengadaan_detail WHERE pend_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
}
