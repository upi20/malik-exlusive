<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Api extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        $this->message_success = 'berhasil'; 
        $this->message_fail = 'gagal'; 
    }

    public function _kode($kode_awal,$field,$table){
        $this->db->select('RIGHT('.$table.'.'.$field.',5) as id', FALSE);
        $this->db->order_by($field,'DESC');    
        $this->db->limit(1);    
        $query = $this->db->get($table);  //cek dulu apakah ada sudah ada kode di tabel.    
        if($query->num_rows() <> 0){      

           $data = $query->row();      
           $kode = intval($data->id) + 1; 
        }else{      
           $kode = 1; 
        }
        $tgl=date('my'); 
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
        return $kodetampil = $kode_awal."-".$tgl."-".$batas;  

    }

    public function login_post(){
        $this->load->model('loginModel','model');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $login = $this->model->cekLogin($email,$password);
        $get_user = $this->db->get_where('users', array('user_email' => $email))->row_array();
        if($login['status'] == 0){
            // $message = [
            //     'status' => 0,
            //     'message' => $this->message_success,
            //     'user_id'   => $user_id,
            //     'level'     => $level
            // ];
            $message = 0;
        }else{
            // $message = [
            //     'status' => 1,
            //     'return' => null
            // ];
            $message = 1;
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getBeasiswa_get(){
        $this->load->model('Api_model','model');
        $get = $this->model->getBeasiswa();
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getProvinsi_get(){
        $this->load->model('Api_model','model');
        $get = $this->model->getProvinsi();
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getJuz_get(){
        $this->load->model('Api_model','model');
        $get = $this->model->getJuz();
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getSurat_get(){
        $this->load->model('Api_model','model');
        $juz = $this->input->get('juz');
        $sura_id = (int)$this->input->get('surat');
        $get = $this->model->getSurat($juz, $sura_id);
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    public function getAyat_get(){
        $this->load->model('Api_model','model');
        $sura_id = (int)$this->input->get('surat');
        $get = $this->model->getAyat($sura_id);
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getQuran_get(){
        $this->load->model('Api_model','model');
        $surat = $this->input->get('surat');
        $get = $this->model->getQuran(null,$surat);
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getKota_get(){
        $this->load->model('Api_model','model');
        $prov_id = $this->input->get('prov_id');
        $get = $this->model->getKota($prov_id);
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getBeasiswaDetail_get(){
        $this->load->model('Api_model','model');
        $id = $this->input->get('id');
        $get = $this->model->getBeasiswaDetail($id);
        if($get){
            $message = [
                'status' => 0,
                'return' => $get
            ];
        }else{
            $message = [
                'status' => 1,
                'return' => null
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getDonasi_get(){
        $this->load->model('Api_model','model');
        $get = $this->model->getDonasi();
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    public function getHafidz_get(){
        $this->load->model('Api_model','model');
        $get = $this->model->getHafidz();
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getHafidzCari_get(){
        $this->load->model('Api_model','model');
        $cari = $this->input->get('cari');
        if($cari == null){
            $get = $this->model->getHafidz();
        }else{
            $get = $this->model->getHafidzCari($cari);
        }
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getHafidzDetail_get(){
        $this->load->model('Api_model','model');
        $id = $this->input->get('id');
        $get = $this->model->getHafidzDetail($id);
        if($get){
            $message = [
                'status' => 0,
                'return' => $get
            ];
        }else{
            $message = [
                'status' => 1,
                'return' => null
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    public function getVideoCari_get(){
        $this->load->model('Api_model','model');
        $cari = $this->input->get('cari');
        if($cari == null){
            $get = $this->model->getVideo();
        }else{
            $get = $this->model->getVideoCari($cari);            
        }
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getVideo_get(){
        $this->load->model('Api_model','model');
        $get = $this->model->getVideo();
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getVideoDetail_get(){
        $this->load->model('Api_model','model');
        $id = $this->input->get('id');
        $get = $this->model->getVideoDetail($id);
        if($get){
            $message = [
                'status' => 0,
                'return' => $get
            ];
        }else{
            $message = [
                'status' => 1,
                'return' => null
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getProfile_get(){
        $this->load->model('Api_model','model');
        $email = $this->input->get('email');
        $get = $this->model->getProfileMobile($email);
        if($get){
            $message = [
                'status' => 0,
                'return' => $get
            ];
        }else{
            $message = [
                'status' => 1,
                'return' => null
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    
    public function daftar_post(){
        $this->load->model('Api_model','model');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = $this->b_password->create_hash($password);
        $nama = $this->input->post('name');
        $no_telpon = $this->input->post('phone');
        $alamat = $this->input->post('alamat');
        $execute = $this->model->postDaftar($email,$password,$nama,$no_telpon,$alamat);
        $user_id = $execute['user_id'];
        $level = $execute['level'];
        if($execute){
            $message = 0;
        }else{
            $message = 1;
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function postProfile_post(){
        $this->load->model('Api_model','model');
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $no_telpon = $this->input->post('telp_hp');
        $alamat = $this->input->post('alamat');
        $execute = $this->model->postProfileUpdate($email,$nama,$no_telpon,$alamat);
        if($execute){
            $message = 0;
        }else{
            $message = 1;
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }


    public function editProfile_post(){
        $this->load->model('Api_model','model');
        $user_id = $this->input->post('user_id');
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $no_telpon = $this->input->post('no_telpon');
        $alamat = $this->input->post('alamat');
        $password = $this->input->post('password');
        if($password != null){
            $password = $this->b_password->create_hash($password);
        }else{
            $password = null;
        }
    
        $execute = $this->model->editProfile($user_id,$email,$nama,$no_telpon,$alamat,$password);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function donasiForm_post(){
        $this->load->model('Api_model','model');
        $dona_id = $this->input->post('dona_id');
        $nama = $this->input->post('nama');
        $whatsapp = $this->input->post('whatsapp');
        $nominal = $this->input->post('nominal');
        $nominal = str_replace('.', '', $nominal);
        $keterangan = $this->input->post('keterangan');
        $execute = $this->model->donasiForm($dona_id, $nama, $whatsapp, $nominal, $keterangan);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getUserHafalan_get(){
        $this->load->model('Api_model','model');
        $email = $this->input->get('email');
        $get = $this->model->getUserHafalan($email);
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function getUserHafalanHistory_get(){
        $this->load->model('Api_model','model');
        $uhta_id = $this->input->get('uhta_id');
        $get = $this->model->getUserHafalanHistory($uhta_id);
        $message = $get;
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    
    public function hafalanTambahPribadi_post(){
        $this->load->model('Api_model','model');
        $email = $this->input->post('email');
        $hafa_id = $this->input->post('hafa_id');
        $cek = $this->model->hafalanCek($email);
        if($cek->num_rows() > 0){
            $useh = $cek->row_array();
            $useh_id = $useh['useh_id'];
        }else{
            $tambah = $this->model->hafalanTambahUser($email, $hafa_id);
            $useh_id = $tambah;
        }

        $jenis = $this->input->post('jenis');
        $target = $this->input->post('target');
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');
        $keterangan = $this->input->post('keterangan');
        $execute = $this->model->hafalanTambahPribadi($useh_id, $jenis, $target, $awal, $akhir, $tanggal_mulai, $tanggal_selesai, $keterangan);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function hafalanUpdatePribadi_post(){
        $this->load->model('Api_model','model');
        $uhta_id = $this->input->post('uhta_id');
        $target_ayat_awal = $this->input->post('target_ayat_awal');
        $target_ayat_akhir = $this->input->post('target_ayat_akhir');
        $surat_awal = $this->input->post('surat_awal');
        $surat_akhir = $this->input->post('surat_akhir');
        $ayat_awal = $this->input->post('ayat_awal');
        $ayat_akhir = $this->input->post('ayat_akhir');
        $keterangan = $this->input->post('keterangan');
        $get_hitung = $this->model->persentase($surat_awal, $surat_akhir, $ayat_awal, $ayat_akhir, $target_ayat_awal, $target_ayat_akhir);
        $persentase = $get_hitung['persentase'];
        $total_ayat = $get_hitung['total_ayat'];
        $execute = $this->model->hafalanUpdatePribadi($uhta_id, $surat_awal, $surat_akhir, $ayat_awal, $ayat_akhir, $total_ayat, $persentase, $keterangan);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function beasiswaDaftar_post(){
        $this->load->model('Api_model','model');
        $beas_id = $this->input->post('beas_id');
        $keterangan = $this->input->post('keterangan');
        $email = $this->input->post('email');
        $get = $this->db->join('users b', 'b.user_id = a.hafi_user_id','left')->get_where('hafidz a', array('b.user_email' => $email))->row_array();

        $execute = $this->model->beasiswaDaftar($beas_id, $keterangan, $get['hafi_id']);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }

    public function hafidzDaftar_post(){
        $this->load->model('Api_model','model');
        $kota = $this->input->post('kota');
        $email = $this->input->post('email');
        $nama = $this->input->post('nama');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $alamat = $this->input->post('alamat');
        $no_hp = $this->input->post('no_hp');
        $biografi = $this->input->post('biografi');
        // $photo = $this->input->post('photo');
        $get = $this->db->get_where('users a', array('a.user_email' => $email))->row_array();

        $execute = $this->model->hafidzDaftar($nama, $tanggal_lahir, $alamat, $no_hp, $biografi, $get['user_id'], $kota);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }


    // API Hafalan
    public function hafalanPribadiDaftar_post(){
        $this->load->model('Api_model','model');
        $email = $this->input->post('email');
        $get = $this->db->get_where('users a', array('a.user_email' => $email))->row_array();
        $user_id = $get['user_id'];
        $hafa_id = $this->input->post('hafa_id');
        $status = "Aktif";


        $execute = $this->model->hafalanPribadi($nama, $tanggal_lahir, $alamat, $no_hp, $biografi, $get['user_id'], $kota);
        if($execute){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    
    
    public function gantiPassword_post(){
        $this->load->model('Api_model','model');
        $user_id = $this->input->post('user_id');
        $password_baru = $this->input->post('password_baru');
        $password_lama = $this->input->post('password_lama');
        $cekPassword = $this->model->cekPassword($user_id,$password_lama);
        // $message = $cekPassword;
        if($cekPassword == true){
            $password = $this->b_password->create_hash($password_baru);
            $ubah_password = $this->model->ubahPassword($user_id,$password);
        }else{
            $ubah_password = false;
        }

        if($ubah_password){
            $message = [
                'status' => 0,
                'message' => $this->message_success
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    

    public function lupaPassword_post(){
        $this->load->model('Api_model','model');
        $email = $this->input->post('email');
        $execute = $this->model->lupaPassword($email);
        if($execute){
            $this->load->library('send_email');
            $email = $this->send_email->send($email);    
            $message = [
                'status' => 0,
                'message' => 'Berhasil, cek email anda untuk merubah password'
            ];
        }else{
            $message = [
                'status' => 1,
                'message' => $this->message_fail
            ];
        }
        $this->set_response($message, REST_Controller::HTTP_OK); // CREATED (201) being the HTTP response code
    }
    
    private function _uploadImage()
    {
        $config['upload_path']          = './assets/gambar/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 2024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('photo')) {
            return $this->upload->data("file_name");
        }
    }

}
