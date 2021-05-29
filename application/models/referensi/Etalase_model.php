<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etalase_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" etalase a ");
		$this->db->where(" (a.etal_id LIKE '%".$cari."%' or a.etal_kode LIKE '%".$cari."%' or a.etal_keterangan LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($kode, $keterangan) {
		$sql = "INSERT INTO etalase (etal_kode, etal_keterangan, tanggal) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $keterangan, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $keterangan){
		$sql = "UPDATE etalase SET etal_kode=?, etal_keterangan=?, tanggal=? WHERE etal_id=?;";
		$q = $this->db->query($sql, [$kode, $keterangan, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM etalase WHERE etal_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}