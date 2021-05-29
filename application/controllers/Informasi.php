<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/Render_Controller.php';

class Informasi extends Render_Controller {

	public function index() {
		
 // Page Settings $this->title = 'Dashboard';
		$this->content = 'home';
		$this->navigation = ['Dashboard'];
		$get_data = $this->db->select('a.*, b.keja_id, b.keja_nama, c.refs_id, c.refs_nama, c.refs_keterangan')
											->join('kejadian b','b.keja_id = a.lapo_keja_id')
											->join('referensi_status c','c.refs_id = a.lapo_status')
											->order_by('a.created_date','desc')
											->get_where('lapor a');
		$data['listKejadian'] = $get_data->result_array();

		

		$data['listGambar'] = $this->db->get('galeri')->result_array();
		$dt_informasi = $this->db->get('informasi')->row_array();
		$data['url_video'] = $dt_informasi['url_video'];
		$data['text_footer'] = $dt_informasi['text_informasi_footer'];
		$data['text_header'] = $dt_informasi['text_informasi_header'];
		$data['text_jargon'] = $dt_informasi['text_informasi_jargon'];
		$data['text_logo_keterangan'] = $dt_informasi['text_logo_keterangan'];

		$this->load->library('googlemaps');
		$config['center'] = '-7.2163954, 107.8587683';
		// $config['zoom'] = 'auto';
		$config['zoom'] = '12';
		$config['height'] = '800px';
	   $config['width'] = '100%';
		$this->googlemaps->initialize($config);

		if($get_data->num_rows() > 0){
			foreach ($get_data->result_array() as $q) {
				$marker = array();
				$lat = $q['lapo_lat'];
				$lon = $q['lapo_lon'];
				$marker['position'] = $lat.','.$lon;
				$marker['onclick'] = 'alert("'.$q['lapo_keterangan'].'")';
				$marker['infowindow_content'] = $q['keja_nama'];
				$marker['icon'] = base_url().'assets/img/icon-fire.png';
				$this->googlemaps->add_marker($marker);
			}
		}else{
			$id = null;
		}


		// $marker = array();
		// $marker['position'] = '37.409, -122.1319';
		// $marker['draggable'] = TRUE;
		// $marker['animation'] = 'DROP';
		// $this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('templates/contents/informasi', $data);
	}

	public function detail($id=null){
		$get = $this->db->select('a.*, b.keja_id, b.keja_nama, c.refs_id, c.refs_nama, c.refs_keterangan, b.*, f.user_name, e.regu_nama, g.lapp_file')
											->join('lapor_pasukan d','d.lapa_lapo_id = a.lapo_id')
											->join('lapor_photo g','g.lapp_lapa_id = d.lapa_id','left')
											->join('regu e','e.regu_id = d.lapa_regu_id')
											->join('users f','f.user_id = e.regu_ketua')
											->join('kejadian b','b.keja_id = a.lapo_keja_id')
											->join('referensi_status c','c.refs_id = a.lapo_status')
											->order_by('a.created_date','desc')
											->get_where('lapor a', array('a.lapo_id' => $id))->row_array();
		$data['lapor'] = $get; 
		$data['lapo_id'] = $get['lapo_id'];
		$data['lat_kebakaran'] = $get['lapo_lat'];
		$data['lon_kebakaran'] = $get['lapo_lon'];
		// $lapa_id = $get['lapa_id'];
		// $get_image = $this->db->get_where('lapor_photo', array('lapp_lapa_id' => $lapa_id))
		$this->load->library('googlemaps');
		
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '37.429, -122.1519';
		$marker['infowindow_content'] = '1 - Hello World!';
		$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
		$this->googlemaps->add_marker($marker);

		$marker = array();
		$marker['position'] = '37.409, -122.1319';
		$marker['draggable'] = TRUE;
		$marker['animation'] = 'DROP';
		$this->googlemaps->add_marker($marker);

		$marker = array();
		$marker['position'] = '37.449, -122.1419';
		$marker['onclick'] = 'alert("You just clicked me!!")';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

			$dt_informasi = $this->db->get('informasi')->row_array();
		$data['url_video'] = $dt_informasi['url_video'];
		$data['text_footer'] = $dt_informasi['text_informasi_footer'];
		$data['text_header'] = $dt_informasi['text_informasi_header'];
		$data['text_jargon'] = $dt_informasi['text_informasi_jargon'];
		$data['text_logo_keterangan'] = $dt_informasi['text_logo_keterangan'];

		$get = $this->db->select('a.lalo_lat, a.lalo_lon')
						 ->where('a.lalo_lapo_id',$id)
						 ->where('b.lapo_status != ',5)
						 ->order_by('a.lalo_id','desc')
						 ->limit(1)
						 ->join('lapor b','b.lapo_id = a.lalo_lapo_id')
						 ->get('lapor_lokasi a')
						 ->row_array();

		$data['lat_petugas'] = $get['lalo_lat'];
		$data['lon_petugas'] = $get['lalo_lon'];

		$this->load->view('templates/contents/informasi-detail', $data);	
	}

	public function detail_double(){

		$this->load->library('googlemaps');
		
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '37.429, -122.1519';
		$marker['infowindow_content'] = '1 - Hello World!';
		$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
		$this->googlemaps->add_marker($marker);

		$marker = array();
		$marker['position'] = '37.409, -122.1319';
		$marker['draggable'] = TRUE;
		$marker['animation'] = 'DROP';
		$this->googlemaps->add_marker($marker);

		$marker = array();
		$marker['position'] = '37.449, -122.1419';
		$marker['onclick'] = 'alert("You just clicked me!!")';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

			$dt_informasi = $this->db->get('informasi')->row_array();
		$data['url_video'] = $dt_informasi['url_video'];
		$data['text_footer'] = $dt_informasi['text_informasi_footer'];
		$data['text_header'] = $dt_informasi['text_informasi_header'];
		$data['text_jargon'] = $dt_informasi['text_informasi_jargon'];
		$data['text_logo_keterangan'] = $dt_informasi['text_logo_keterangan'];

		$this->load->view('templates/contents/informasi-detail-double', $data);	
	}
}