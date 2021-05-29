<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, b.*, c.*");
		$this->db->from("produk_olah a");
		$this->db->join("produk b", "a.proo_prod_id = b.prod_id");
		$this->db->join("kelas c", "a.proo_kela_id = c.kela_id");
		$this->db->where("(b.prod_nama LIKE '%".$cari."%' or c.kela_nama LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}
}