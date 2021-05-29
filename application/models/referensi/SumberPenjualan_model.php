<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SumberPenjualan_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" sumber_penjualan a ");
		$this->db->where(" (a.supe_id LIKE '%".$cari."%' or a.supe_nama LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $jenis) {
		$sql = "INSERT INTO sumber_penjualan (supe_nama, supe_jenis, tanggal) VALUES (?, ? ,?);";
		$q = $this->db->query($sql, [$nama, $jenis, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $jenis){
		$sql = "UPDATE sumber_penjualan SET supe_nama=?, supe_jenis=?, tanggal=? WHERE supe_id=?;";
		$q = $this->db->query($sql, [$nama, $jenis, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM sumber_penjualan WHERE supe_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}