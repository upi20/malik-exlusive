<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evakuasi_model extends CI_Model {

	public function getAllIsiLapor($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, users.* ");
		$this->db->from("lapor a");
		$this->db->join("users", "user_id = lapo_user_id");
		$this->db->where("a.lapo_keja_id",6);
		$this->db->where("(a.lapo_user_id LIKE '%".$cari."%' or a.lapo_nama LIKE '%".$cari."%' or a.lapo_no_hp LIKE '%".$cari."%' or a.lapo_alamat LIKE '%".$cari."%' or a.lapo_keterangan LIKE '%".$cari."%' or a.lapo_status LIKE '%".$cari."%') ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}
}