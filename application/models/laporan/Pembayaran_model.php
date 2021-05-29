<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

	public function getAllIsiLapor($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, penjualan.* ");
		$this->db->from("penjualan_pembayaran a");
		$this->db->join("penjualan", "penj_id = pepe_penj_id");
		$this->db->where("(a.pepe_penj_id LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}
}