<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rak_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" rak a ");
		$this->db->where(" (a.rak_id LIKE '%".$cari."%' or a.rak_kode LIKE '%".$cari."%' or a.rak_keterangan LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($kode, $keterangan) {
		$sql = "INSERT INTO rak (rak_kode, rak_keterangan, tanggal) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $keterangan, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $keterangan){
		$sql = "UPDATE rak SET rak_kode=?, rak_keterangan=?, tanggal=? WHERE rak_id=?;";
		$q = $this->db->query($sql, [$kode, $keterangan, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM rak WHERE rak_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}