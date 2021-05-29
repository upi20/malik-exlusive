<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select("b.* , c.*");
		$this->db->from("produk b");
		$this->db->join("kategori c", "b.prod_kate_id = c.kate_id", "left");
		$this->db->where(" (b.prod_nama LIKE '%".$cari."%' or b.prod_stok LIKE '%".$cari."%' or b.prod_harga_beli LIKE '%".$cari."%' or b.prod_harga_jual LIKE '%".$cari."%' or b.prod_status LIKE '%".$cari."%' or c.kate_id LIKE '%".$cari."%' or c.kate_nama LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function ubahLokal($prod_id, $blok_id, $ruma_id){
		$sql = "UPDATE produk SET prod_blok_id=?, prod_ruma_id=? WHERE prod_id=?;";
		$q = $this->db->query($sql, [$blok_id, $ruma_id, $prod_id]);
		return $q;
	}
	
	public function ubahKelas($prod_id, $kategori, $kategori_lama)
	{
		$sql 		= " UPDATE produk SET prod_kate_id=? WHERE prod_id=?";
		$sql2 		= " INSERT INTO produk_olah(proo_prod_id, proo_kate_id) VALUES(?, ?)";

		$q 			= $this->db->query($sql, [$kategori, $prod_id]);
		$q2			= $this->db->query($sql2, [$prod_id, $kategori_lama]);

		return $q;
	}
}