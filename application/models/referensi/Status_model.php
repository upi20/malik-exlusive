<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" status a ");
		$this->db->where(" (a.stat_id LIKE '%".$cari."%' or a.stat_nama LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama) {
		$sql = "INSERT INTO status (stat_nama, tanggal) VALUES (?, ?);";
		$q = $this->db->query($sql, [$nama, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama){
		$sql = "UPDATE status SET stat_nama=?, tanggal=? WHERE stat_id=?;";
		$q = $this->db->query($sql, [$nama, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM status WHERE stat_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}