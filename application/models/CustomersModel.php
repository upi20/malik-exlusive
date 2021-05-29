<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomersModel extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" customers a ");
		$this->db->where(" (a.id LIKE '%".$cari."%' or a.nama LIKE '%".$cari."%' or a.email LIKE '%".$cari."%' or a.perusahaan LIKE '%".$cari."%' or a.no_hp LIKE '%".$cari."%' or a.alamat LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $email, $perusahaan, $no_hp, $alamat) {
		$sql = "INSERT INTO customers (nama, email, perusahaan, no_hp, alamat) VALUES (?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $email, $perusahaan, $no_hp, $alamat]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $email, $perusahaan, $no_hp, $alamat){
		$sql = "UPDATE customers SET nama=?, email=?, perusahaan=?, no_hp=?, alamat=? where id=?;";
		$q = $this->db->query($sql, [$nama, $email, $perusahaan, $no_hp, $alamat, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM customers WHERE id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}