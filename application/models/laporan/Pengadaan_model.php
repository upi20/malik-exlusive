<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan_model extends CI_Model {

	public function getAllIsiLapor($show=null, $start=null, $cari=null){
		$this->db->select(" a.*");
		$this->db->from("pengadaan a");
		$this->db->where("(a.peng_id LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}
}