<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KendaraanModel extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" kendaraan a ");
		$this->db->where(" (a.id LIKE '%".$cari."%' or a.jenis LIKE '%".$cari."%' or a.merk LIKE '%".$cari."%' or a.plat_nomor LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}


	public function insert($jenis, $merk, $plat_nomor) {
		$sql = "INSERT INTO kendaraan (jenis, merk, plat_nomor) VALUES (?, ?, ?);";
		$q = $this->db->query($sql, [$jenis, $merk, $plat_nomor]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $jenis, $merk, $plat_nomor){
		$sql = "UPDATE kendaraan SET jenis=?, merk=?, plat_nomor=? WHERE id=?;";
		$q = $this->db->query($sql, [$jenis, $merk, $plat_nomor, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM kendaraan WHERE id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}

}