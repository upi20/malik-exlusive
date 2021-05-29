<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" supplier a ");
		$this->db->where(" (a.supp_id LIKE '%".$cari."%' or a.supp_kode LIKE '%".$cari."%' or a.supp_nama LIKE '%".$cari."%' or a.supp_email LIKE '%".$cari."%' or a.supp_telpon LIKE '%".$cari."%' or a.supp_no_hp LIKE '%".$cari."%' or a.supp_alamat LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($kode, $nama, $email, $telpon, $no_hp, $alamat, $status, $rating, $komen) {
		$sql = "INSERT INTO supplier (supp_kode, supp_nama, supp_email, supp_telpon, supp_no_hp, supp_alamat, supp_status, tanggal) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$kode, $nama, $email, $telpon, $no_hp, $alamat, $status, psql_datetime_format()]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kode, $nama, $email, $telpon, $no_hp, $alamat, $status, $rating, $komen){
		$sql = "UPDATE supplier SET supp_kode=?, supp_nama=?, supp_email=?, supp_telpon=?, supp_no_hp=?, supp_alamat=?, supp_status=?, tanggal=? WHERE supp_id=?;";
		$q = $this->db->query($sql, [$kode, $nama, $email, $telpon, $no_hp, $alamat, $status, psql_datetime_format(), $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM supplier WHERE supp_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}