<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	public function getProfile($user_id){
		$where = array(
			'user_id' => $user_id
		);
		$query = $this->db->get_where('users',$where)->result_array();
		return $query;
	}
	
	public function getProfileMobile($email){
		$where = array(
			'user_email' => $email
		);
		$query = $this->db->get_where('users',$where)->result_array();
		return $query;
	}

	public function getQuran($juz=null, $surat=1){
		$where = array(
			'ayat_sura_id' => $surat
		);			
		$query = $this->db->get_where('ayat',$where)->result_array();
		return $query;
	}

	public function getJuz(){
		$where = array();
		$query = $this->db->get_where('juz',$where)->result_array();
		return $query;
	}

	public function getSurat($juz=null, $sura_id=0){
		$where = array();
		$juz = (int)$juz;
		if($juz > 0){
			$where += array(
				'sura_juz_id' => $juz
			);
		}
		$sura_id = (int)$sura_id;
		if($sura_id > 0){
			$where += array(
				'sura_id' => $sura_id
			);
		}
		$query = $this->db->get_where('surat',$where)->result_array();
		return $query;
	}

	public function getProvinsi(){
		$where = array();
		$query = $this->db->get_where('provinsi',$where)->result_array();
		return $query;
	}

	public function getKota($prov_id){
		$where = array(
			'kota_prov_id' => $prov_id
		);
		$query = $this->db->get_where('kota',$where)->result_array();
		return $query;
	}

	public function postProfileUpdate($email,$nama,$no_telpon,$alamat){
		$data['user_name'] = $nama;			
		$data['user_phone'] = $no_telpon;			
		$data['user_address'] = $alamat;			
		$execute = $this->db->where('user_email',$email);
		$execute = $this->db->update('users',$data);
		return $execute;
	}

	public function getBeasiswa(){
		$where = array(
			'beas_status' => 'Aktif'
		);

		$query = $this->db->get_where('beasiswa',$where)->result_array();
		return $query;
	}

	public function getBeasiswaDetail($id=null){
		$where = array(
			'beas_status' => 'Aktif',
			'beas_id' => $id
		);
		$query = $this->db->get_where('beasiswa',$where)->result_array();
		return $query;
	}

	public function getHafidzCari($cari){
		$where = array(
			'hafi_status' => 'Aktif'
		);

		$query = $this->db->like('hafi_nama',$cari)->get_where('hafidz',$where)->result_array();
		return $query;
	}

	public function getHafidz(){
		$where = array(
			'hafi_status' => 'Aktif'
		);
		$query = $this->db->get_where('hafidz',$where)->result_array();
		return $query;
	}

	public function getHafidzDetail($id=null){
		$where = array(
			'hafi_status' => 'Aktif',
			'hafi_id' => $id
		);
		$query = $this->db->get_where('hafidz',$where)->result_array();
		return $query;
	}
	public function getDonasi(){
		$where = array(
			'dona_status' => 'Aktif'
		);
		$query = $this->db->get_where('donasi',$where)->result_array();
		return $query;
	}

	public function getVideoCari($cari){
		$where = array(
			'a.vide_status' => 'Aktif'
		);

		$query = $this->db->select('a.*, b.hafi_nama')->join('hafidz b','b.hafi_id = a.vide_hafi_id')->like('a.vide_judul',$cari)->get_where('video a',$where)->result_array();
		return $query;
	}

	public function getVideo(){
		$where = array(
			'a.vide_status' => 'Aktif'
		);

		$query = $this->db->select('a.*, b.hafi_nama')->join('hafidz b','b.hafi_id = a.vide_hafi_id')->get_where('video a',$where)->result_array();
		return $query;
	}

	public function getVideoDetail($id=null){
		$where = array(
			'a.vide_status' => 'Aktif',
			'a.vide_id' => $id
		);
		$query = $this->db->select('a.*, b.hafi_nama')->join('hafidz b','b.hafi_id = a.vide_hafi_id')->get_where('video a',$where)->result_array();
		
		return $query;
	}

	public function editProfile($user_id,$email,$nama,$no_telpon,$alamat,$password){
		$data['user_email'] = $email;
		if($password != null){
			$data['user_password'] = $password;			
		}
		$data['user_name'] = $nama;
		$data['user_phone'] = $no_telpon;
		$data['user_address'] = $alamat;

		$execute = $this->db->where('user_id',$user_id);
		$execute = $this->db->update('users',$data);
		return $execute;
	}

	public function cekPassword($user_id,$password){
		$get = $this->db->get_where('users', array('user_id' => $user_id))->row_array();
		$password_database = $get['user_password'];
		$cek = $this->b_password->verify($password,$password_database);
		if($cek == true){
			$return = true;
		}else{
			$return = false;
		}
		return $return;	
	}

	public function ubahPassword($user_id,$password){
		$data['user_password'] = $password;			
		$execute = $this->db->where('user_id',$user_id);
		$execute = $this->db->update('users',$data);
		return $execute;
	}

	public function postDaftar($email=null,$password=null,$nama=null,$no_telpon=null,$alamat=null){
		$data['user_email'] = $email;
		$data['user_password'] = $password;
		$data['user_name'] = $nama;
		$data['user_phone'] = $no_telpon;
		$data['user_address'] = $alamat;

		$execute = $this->db->insert('users',$data);
		$user_id = $this->db->insert_id();
		$lev_id = 5;
		$sql2 = "INSERT INTO role_users (rolu_user_id, rolu_lev_id, created_date) VALUES (?, ?, ?);";
		$q2 = $this->db->query($sql2, [$user_id, $lev_id, psql_datetime_format()]);

		$get_level = $this->db->get_where('level', array('lev_id' => $lev_id))->row_array();
		$return['user_id'] = $user_id;
		$return['level'] = $get_level['lev_nama'];
		return $return;
	}


	
	public function donasiForm($dona_id, $nama, $whatsapp, $nominal, $keterangan){
		$data['dode_dona_id'] = $dona_id;
		$data['dode_nominal'] = $nominal;
		$data['dode_nama'] = $nama; 
		$data['dode_whatsapp'] = $whatsapp; 
		$exe = $this->db->insert('donasi_detail',$data);
		return $exe;
	}

	public function beasiswaDaftar($beas_id, $keterangan, $hafi_id){
		$data['bead_hafi_id'] = $hafi_id;
		$data['bead_beas_id'] = $beas_id;
		$data['bead_keterangan'] = $keterangan;
		$data['bead_status'] = 'Menunggu';  
		$exe = $this->db->insert('beasiswa_daftar',$data);
		return $exe;
	}

	public function hafidzDaftar($nama, $tanggal_lahir, $alamat, $no_hp, $biografi, $user_id, $kota){
		$data['hafi_kota_id'] = $kota;
		$data['hafi_user_id'] = $user_id;
		$data['hafi_nama'] = $nama;
		$data['hafi_tanggal_lahir'] = $tanggal_lahir;
		$data['hafi_alamat'] = $alamat;  
		$data['hafi_no_hp'] = $no_hp;  
		$data['hafi_biografi'] = $biografi;  
		$data['hafi_status'] = 'Menunggu';  
		$exe = $this->db->insert('hafidz',$data);
		return $exe;
	}

	public function getUserHafalan($email){
		$get = $this->db->select('a.uhta_id,a.uhta_awal, a.uhta_akhir, a.uhta_total_ayat_awal, a.uhta_total_ayat_akhir, d.sura_keterangan as awal, e.sura_keterangan as akhir, a.uhta_tanggal_mulai as tanggal_mulai, a.uhta_tanggal_selesai as tanggal_selesai, a.uhta_persentase as persentase, a.uhta_status as status')
										->join('user_hafalan b','b.useh_id = a.uhta_useh_id')
										->join('users c','c.user_id = b.useh_user_id')
										->join('surat d','d.sura_id = a.uhta_awal')
										->join('surat e','e.sura_id = a.uhta_akhir')
										// ->group_by('a.uhta_id')
										// ->group_by('b.uhta_id')
										->get_where('user_hafalan_target a', array('c.user_email' => $email))
										->result_array();
		return $get;
	}

	public function getUserHafalanHistory($uhta_id){
		// $get = $this->db
										// ->join('user_hafalan_target a','a.uhta_id = z.uhpr_uhta_id')
										// ->join('user_hafalan b','b.useh_id = a.uhta_useh_id')
										// ->join('users c','c.user_id = b.useh_user_id')
										// ->join('surat f','f.sura_id = a.uhta_awal')
										// ->join('surat g','g.sura_id = a.uhta_akhir')
										// ->join('surat d','d.sura_id = z.uhpr_surat_awal')
										// ->join('surat e','e.sura_id = z.uhpr_surat_akhir')
										// // ->group_by('a.uhta_id')
										// // ->group_by('b.uhta_id')
		$get = $this->db->get_where('user_hafalan_progres z', array('z.uhpr_uhta_id' => $uhta_id))->result_array();
		return $get;
	}
	
	public function hafalanTambahPribadi($useh_id, $jenis, $target, $awal, $akhir, $tanggal_mulai, $tanggal_selesai, $keterangan){

		$target_surat_awal = $awal;
		$target_surat_akhir = $akhir;
		if($target_surat_awal == $target_surat_akhir){
			$get_total_ayat = $this->db->join('ayat b', 'b.ayat_sura_id = a.sura_ke')->get_where('surat a', array('a.sura_ke' => $target_surat_awal))->num_rows();		
			$get_total_ayat_awal = $get_total_ayat;
			$get_total_ayat_akhir = 0;
		}else{
			$get_total_ayat_awal = $this->db->join('ayat b', 'b.ayat_sura_id = a.sura_ke')->get_where('surat a', array('a.sura_ke' => $target_surat_awal))->num_rows();			
			$get_total_ayat_akhir = $this->db->join('ayat b', 'b.ayat_sura_id = a.sura_ke')->get_where('surat a', array('a.sura_ke' => $target_surat_akhir))->num_rows();			
			$get_total_ayat = $get_total_ayat_awal + $get_total_ayat_akhir;
		}

		$data['uhta_useh_id'] = $useh_id;
		$data['uhta_jenis'] = $jenis;
		$data['uhta_target'] = $target;
		$data['uhta_awal'] = $awal;
		$data['uhta_akhir'] = $akhir;
		$data['uhta_tanggal_mulai'] = $tanggal_mulai;
		$data['uhta_tanggal_selesai'] = $tanggal_selesai;
		$data['uhta_persentase'] = 0;
		$data['uhta_total_ayat_awal'] = $get_total_ayat_awal;
		$data['uhta_total_ayat_akhir'] = $get_total_ayat_akhir;
		$data['uhta_total_ayat'] = $get_total_ayat;
		$data['uhta_keterangan'] = $keterangan;
		$data['uhta_status'] = 'Belum Selesai';
		$exe = $this->db->insert('user_hafalan_target',$data);
		return $exe;
	}

	public function hafalanUpdatePribadi($uhta_id, $surat_awal, $surat_akhir, $ayat_awal, $ayat_akhir, $total_ayat, $persentase, $keterangan){
		$data['uhpr_uhta_id'] = $uhta_id;
		$data['uhpr_surat_awal'] = $surat_awal;
		$data['uhpr_surat_akhir'] = $surat_akhir;
		$data['uhpr_ayat_awal'] = $ayat_awal;
		$data['uhpr_ayat_akhir'] = $ayat_akhir;
		$data['uhpr_total_ayat'] = $total_ayat;
		$data['uhpr_keterangan'] = $keterangan;
		$exe = $this->db->insert('user_hafalan_progres',$data);

		if($exe){
			$get_persentase_awal = $this->db->select('uhta_persentase')->get_where('user_hafalan_target', array('uhta_id' => $uhta_id))->row_array();
			$persentase_awal = $get_persentase_awal['uhta_persentase'];
			$persentase = $persentase_awal + $persentase;
			$upd['uhta_persentase'] = $persentase;
			if($persentase == 100){
				$upd['uhta_status'] = 'Selesai';
			}
			$this->db->where('uhta_id', $uhta_id);
			$this->db->update('user_hafalan_target',$upd);
		}
		return $exe;
	}

	public function persentase($surat_awal, $surat_akhir, $ayat_awal, $ayat_akhir, $target_ayat_awal, $target_ayat_akhir){
		
		if($surat_awal == $surat_akhir){
			$get_total_ayat = $target_ayat_awal + $target_ayat_akhir;	
			$total_ayat_progress = $ayat_akhir-$ayat_awal+1;
			$persentase = ($total_ayat_progress / $get_total_ayat) * 100;
		}else{
			$get_total_surat_progres1 = $this->db->join('ayat b', 'b.ayat_sura_id = a.sura_ke')->get_where('surat a', array('a.sura_ke' => $surat_awal))->num_rows();			
			$get_total_surat_progres2 = $this->db->join('ayat b', 'b.ayat_sura_id = a.sura_ke')->get_where('surat a', array('a.sura_ke' => $surat_akhir))->num_rows();			
			$get_total_surat_progres = $target_ayat_awal + $target_ayat_akhir;
			$sisa = $get_total_surat_progres2 - $ayat_akhir; 
			$total_ayat_progress = $ayat_akhir+$get_total_surat_progres1;
			$persentase = ($total_ayat_progress / $get_total_surat_progres) * 100;
		}
		$data['total_ayat'] = $total_ayat_progress;
		$data['persentase'] = $persentase;
		return $data;
	}

	public function hafalanCek($email){
		$get = $this->db->join('users b','b.user_id = a.useh_user_id')->get_where('user_hafalan a', array('b.user_email' => $email));
		return $get;
	}

	public function hafalanTambahUser($email, $hafa_id){
		$get = $this->db->get_where('users', array('user_email' => $email))->row_array();
		$user_id = $get['user_id'];
		$data['useh_user_id'] = $user_id;
		$data['useh_hafa_id'] = $hafa_id;
		$data['useh_status'] = 'Aktif';
		$exe = $this->db->insert('user_hafalan',$data);
		return $this->db->insert_id();
	}

	public function lupaPassword($email){
		$get = $this->db->select('*')
						 ->where('a.user_email',$email)
						 ->get('users a')
						 ->row_array();
		return $get;
	}

}
