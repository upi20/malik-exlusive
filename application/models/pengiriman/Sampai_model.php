<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sampai_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* , pman.*");
		$this->db->from(" penjualan a ");
		// $this->db->join(" penjualan_detail b ", "a.penj_id = b.pede_penj_id");
		// $this->db->join(" produk p ", "b.pede_prod_id = p.prod_id");
		// $this->db->join(" kategori k ", "k.kate_id = p.prod_kate_id");
		$this->db->join(" pengiriman pman ", "pman.pman_penj_id = a.penj_id");
		$this->db->group_by("a.penj_id");
		$this->db->where('a.penj_status_pengiriman', 'Sampai');
		$this->db->where(" (a.penj_id LIKE '%".$cari."%' or a.penj_nama LIKE '%".$cari."%' or a.penj_no_hp LIKE '%".$cari."%' or a.penj_alamat LIKE '%".$cari."%' or a.penj_total_harga LIKE '%".$cari."%' or a.penj_dibayar LIKE '%".$cari."%' or a.penj_sisa LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}
}