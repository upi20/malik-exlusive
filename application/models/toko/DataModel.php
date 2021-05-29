<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" toko a ");
		$this->db->where(" (a.nama LIKE '%".$cari."%' or a.nama_lengkap LIKE '%".$cari."%' or a.no_hp LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($data) {
		$exe = $this->db->insert('toko', $data);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($data){
		$exe = $this->db->where('id', $data['id'])->update('toko', $data);
		return $exe;
	}

	public function delete($id) {
		$sql = "DELETE FROM toko WHERE id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}