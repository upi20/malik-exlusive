<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KaryawanModel extends CI_Model {

	public function getAllData($show=null, $start=null, $cari=null){
		$this->db->select(" a.* ");
		$this->db->from(" karyawan a ");
		$this->db->where(" (a.id LIKE '%".$cari."%' or a.nama LIKE '%".$cari."%' or a.no_hp LIKE '%".$cari."%' or a.alamat LIKE '%".$cari."%' or a.total_hutang LIKE '%".$cari."%' or a.dibayar LIKE '%".$cari."%' or a.sisa LIKE '%".$cari."%') ");

		if ($show == null && $start == null){
			$return = $this->db->get();
		}else{
			$this->db->limit($show, $start);   
			$return = $this->db->get();
		}
		return $return;
	}

	public function getAllDataCetak($id){
		$get = $this->db->get_where('karyawan',['id' => $id])->row_array();
		return $get;
	}

	public function insert($nama, $no_hp, $alamat, $driver) {
		$sql = "INSERT INTO karyawan (nama, no_hp, alamat, driver) VALUES (?, ?, ?, ?);";
		$q = $this->db->query($sql, [$nama, $no_hp, $alamat, $driver]);

		$return['id'] = $this->db->insert_id();
		if($driver == "ya"){
			$data['id_karyawan'] = $return['id'];
			$data['status']		 = 1;
			$this->db->insert('driver', $data);
		}
		return $return;
	}

	public function update($id, $nama, $no_hp, $alamat, $driver){
		$sql = "UPDATE karyawan SET nama=?, no_hp=?, alamat=?, driver=? WHERE id=?;";
		$q = $this->db->query($sql, [$nama, $no_hp, $alamat, $driver, $id]);
		if($driver == "tidak"){
			$this->db->where('id_karyawan', $id);
			$this->db->delete('driver');
		}else{
			$cek = $this->db->get_where('driver', ['id_karyawan' => $id])->num_rows();
			if($cek < 1){
				$data['id_karyawan'] = $id;
				$data['status']		 = 1;
				$this->db->insert('driver', $data);	
			}
			
		}
		return $q;
	}

	public function delete($id) {
		$sql = "DELETE FROM karyawan WHERE id=?;";
		$q = $this->db->query($sql, [$id]);
		return $q;
	}

	public function hutang($id, $jumlah){
		$data['id_karyawan'] = $id;
		$data['jumlah'] = $jumlah;
		$exe = $this->db->insert('karyawan_hutang', $data);
		if($exe){
			$get = $this->db->get_where('karyawan',['id' => $id])->row_array();
			$total_hutang = $get['total_hutang'];
			$sisa = $get['sisa'];

			$total_hutang = $total_hutang+$jumlah;
			$sisa = $sisa+$jumlah;
			$upd['total_hutang'] = $total_hutang;
			$upd['sisa'] = $sisa;
			$this->db->where('id', $id);
			$this->db->update('karyawan', $upd);
		}
		return true;
	}
	
	public function bayar($id, $jumlah){
		$data['id_karyawan'] = $id;
		$data['jumlah'] = $jumlah;
		$exe = $this->db->insert('karyawan_bayar', $data);
		if($exe){
			$get = $this->db->get_where('karyawan',['id' => $id])->row_array();
			$total_hutang = $get['total_hutang'];
			$bayar = $get['dibayar']+$jumlah;
			$sisa = $get['sisa'];

			$total_hutang = $total_hutang-$jumlah;
			$sisa = $sisa-$jumlah;
			$upd['total_hutang'] = $total_hutang;
			$upd['dibayar'] = $bayar;
			$upd['sisa'] = $sisa;
			$this->db->where('id', $id);
			$this->db->update('karyawan', $upd);
		}
		return true;
	}
}