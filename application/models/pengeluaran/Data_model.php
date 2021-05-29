<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null, $level=null){
		$this->db->select(" a.* ");
		$this->db->from(" pengeluaran a ");
		$this->db->where(" (a.pean_kategori LIKE '%".$cari."%' or a.pean_keterangan LIKE '%".$cari."%' or a.pean_nominal LIKE '%".$cari."%') ");
		
		if($level != 'null'){
			$this->db->where('a.pean_level', $level);
		}

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function insert($kategori, $keterangan, $nominal, $untuk, $tanggal, $level) {
		$sql = "INSERT INTO pengeluaran (pean_kategori, pean_keterangan, pean_nominal, pean_untuk, pean_level, pean_tanggal) VALUES (?, ?, ?, ?, ?, ?);";
		$q = $this->db->query($sql, [$kategori, $keterangan, $nominal, $untuk, $level, $tanggal]);

		$return['id'] = $this->db->insert_id();
		return $return;
	}

	public function update($id, $kategori, $keterangan, $nominal, $untuk, $tanggal){
		$sql = "UPDATE pengeluaran SET pean_kategori=?, pean_keterangan=?, pean_nominal=?, pean_untuk=?, pean_tanggal=? WHERE pean_id=?;";
		$q = $this->db->query($sql, [$kategori, $keterangan, $nominal, $untuk, $tanggal, $id]);
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM pengeluaran WHERE pean_id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}
	
}