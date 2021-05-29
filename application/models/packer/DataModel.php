<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataModel extends CI_Model {

	public function getAllIsi($show=null, $start=null, $cari=null, $status=null){
		$this->db->select(" a.* ");
		$this->db->from("packer a");
		$this->db->where("(a.pack_nama LIKE '%".$cari."%' or a.pack_email LIKE '%".$cari."%' or a.pack_telepon LIKE '%".$cari."%' or a.pack_alamat LIKE '%".$cari."%' or a.pack_status LIKE '%".$cari."%' ) ");
		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($nama, $email, $telepon, $alamat) {

		$sql = "INSERT INTO packer (pack_nama, pack_email, pack_telepon, pack_alamat) VALUES (?, ?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $email, $telepon, $alamat]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $nama, $email, $telepon, $alamat){
		$sql = "UPDATE packer SET pack_nama=?, pack_email=?, pack_telepon=?, pack_alamat=? WHERE pack_id=?;";
		$q = $this->db->query($sql, [$nama, $email, $telepon, $alamat, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM packer WHERE pack_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}