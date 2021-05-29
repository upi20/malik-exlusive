<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function print(){
		// ob_start();
    ob_clean();
		ini_set('memory_limit', '-1');
    $this->load->library('html2pdf');
    //Set folder to save PDF to
    $this->html2pdf->folder('./assets/');
    
    //Set the filename to save/download as
    $name = "cetak_kwitansi".date('H:i:s')."pdf";
    $this->html2pdf->filename($name);
    
    //Set the paper defaults
    $this->html2pdf->paper('a4', 'landscape');
    // $this->html2pdf->paper('a4', 'potrait');
    
   
    $tanggal = date("d F Y");
    $data = array(
      'title'             => 'PDF Created',
      'message'           => 'Hello World!',
      'kota'              => "Soreang"
    );
    
    $data['bread_menu_first']				= "Penjualan";
		$data['bread_menu_first_url']		= "#";
		$data['bread_menu_second']			= "Data Detail Langsung Product";
		$data['bread_menu_second_url']	= "#";
		$data['bread_menu_utama']				= "Dashboard";
		$data['bread_menu_utama_url']		= base_url()."dashboard";
		$data['menu']										= 'Penjualan';
		// $data['dtPenjualan']								= $this->model->showDetailLangsungProduct($id);
		// if($data['dtPenjualan'][0]['penl_status'] == 'belum selesai'){
      // $this->html2pdf->html($this->load->view('cetak_surat_jalan',$data, true));
		// }else{
      $this->html2pdf->html($this->load->view('cetak',$data, true));
      // $html = ob_get_contents();
      // ob_end_clean();
		// }
		// $this->load->view('content/penjualan/dataDetailLangsungProduct',$data);
    // //Load html view
    if($this->html2pdf->create('save')) {
    	echo 'PDF saved';
      redirect("/assets/".$name);
	  }else{
	  	echo "fail";
	  }
	}
}
