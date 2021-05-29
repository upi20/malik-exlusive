<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.*, b.kate_nama as parent ");
		$this->db->from(" kategori a ");
		$this->db->join(" kategori b ", "b.kate_id = a.kate_kate_id", "left");
		$this->db->where(" (a.kate_id LIKE '%".$cari."%' or a.kate_nama LIKE '%".$cari."%' or a.kate_deskripsi LIKE '%".$cari."%' or a.kate_status LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($parent1=0, $parent2=0, $level=1, $nama, $deskripsi, $status) {
		$sql = "INSERT INTO kategori (kate_kate_id, kate_level, kate_nama, kate_deskripsi, kate_status, tanggal) VALUES (?, ?, ?, ?, ?, ?);";			
		if($level == 1){
			$q = $this->db->query($sql, [0, $level, $nama, $deskripsi, $status, psql_datetime_format()]);				
		}elseif($level == 2) {
			$q = $this->db->query($sql, [$parent1, $level, $nama, $deskripsi, $status, psql_datetime_format()]);				
		}elseif($level == 3) {
			$q = $this->db->query($sql, [$parent2, $level, $nama, $deskripsi, $status, psql_datetime_format()]);				
		}else{

		}

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $parent1=0, $parent2=0, $level=1, $nama, $deskripsi, $status){
		$sql = "UPDATE kategori SET kate_kate_id=?, kate_level=?, kate_nama=?, kate_deskripsi=?, kate_status=?, tanggal=? WHERE kate_id=?;";
		if($level == 1){
			$q = $this->db->query($sql, [0, $level, $nama, $deskripsi, $status, psql_datetime_format(), $id]);			
		}elseif($level == 2) {
			$q = $this->db->query($sql, [$parent1, $level, $nama, $deskripsi, $status, psql_datetime_format(), $id]);			

		}elseif($level == 3) {
			$q = $this->db->query($sql, [$parent2, $level, $nama, $deskripsi, $status, psql_datetime_format(), $id]);					
		}else{
			$q = null;
		}
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM kategori WHERE kate_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}