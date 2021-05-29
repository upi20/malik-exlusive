<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateCode extends CI_Controller {

    function __construct()
    {
        parent::__construct();       
        // memanggil library QR Code dan Barcode
        $this->load->library('ciqrcode'); 

    }

    public function ViewPdf()
    {   
        $this->load->view("utility/barcode");
    }


    public function regListRole(){
        $data['header'] = $this->header;
        $data['menu']     = 'Home';
        $data['menuparent']     = 'Utility';
        $data['menusubparent']      = 'Generate Code';
        // $data['menuchild']      = 'Role';
		
        // $        = $this->input->post("");
    }

    public function regCode()
    {
        if ($_POST['generateCodeWith']=="Upload") {
            $code   = pathinfo($_FILES['uploadCode']['name'], PATHINFO_FILENAME);
        }else{
            $code   = $this->input->post('generateCode');
        }
        $qrcodeName="";
        if ("QR-Code" == "QR-Code") {
            $dir = 'qrcode'.DIRECTORY_SEPARATOR;
            //set it to writable location, a place for temp generated PNG files
            $PNG_TEMP_DIR = FCPATH.'assets'.DIRECTORY_SEPARATOR.'barcode'.DIRECTORY_SEPARATOR;
            //set it to writable location, a place for temp generated PNG files    
            //html PNG location prefix
            $PNG_WEB_DIR = 'assets/barcode/';

            // include FCPATH.$dir."qrlib.php";    
            // var_dump(FCPATH.$dir."qrlib.php");
            // exit();
            
            //ofcourse we need rights to create temp dir
            if (!file_exists($PNG_TEMP_DIR))
                mkdir($PNG_TEMP_DIR);
            
            
            $filename = $PNG_TEMP_DIR.'scan.png';
            
            //processing form input
            //remember to sanitize user input in real-life solution !!!
            $errorCorrectionLevel = 'L';
            $matrixPointSize = 4;
            
            if (isset($code)) { 
            
                //it's very important!
                if (trim($code) == '')
                    die('data cannot be empty! <a href="?">back</a>');
                    
                // user data
                $filename = $PNG_TEMP_DIR.$code.'.png';
                QRcode::png($code, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
                // var_dump('bisa');
                // exit();
                
            } else {    
                //default data
                QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);        
            }
            $qrcodeName = basename($filename);  
        }
        $qrlib = base_url().'qrcode'.DIRECTORY_SEPARATOR;
        $generateCodeBy = $this->input->post('generateCodeBy');

        //open this comment /**/ if query already provide
        $data['header'] = $this->header;
        $data['menu']     = 'Home';
        $data['menuparent']     = 'Utility';
        $data['menusubparent']      = 'Generate Code';
        // $data['menuchild']      = 'Role';
        
        $data['dtconfigitem']   = "";
        // $data['dtparentrole']   = $this->listRoleModel->getParentRole();    
        $data['parentrole']     = "";

        // $data['dtlistrole']     = $this->listRoleModel->getListRole();
        $data['collapseFilter'] = "true";
        $data['collapsePrint']  = "false";

        $data['pagemodel'] = 'add';
        // $data['totalSequence']  = $this->totalSequence;
        $data['barcode']        = 1;
        $data['generateCodeBy'] = $generateCodeBy;
        $data['code']           = $code;
        $data['qrcodeName']           = $qrcodeName;

        $this->temppage->render('utility/generateCode_view',$data);
    }

    public function zenddd() {
        $temp = rand(10000, 99999);
        // var_dump($temp);
        // exit();
        echo $this->set_barcode($temp);
    }


    public function set_barcode2($kode)
    {
        // var_dump('fuck youuu');
        // exit();
        $this->load->library('zend');
        //load yang ada di folder Zend
        $this->zend->load('zend/Barcode');
        ob_start();
         
        //generate barcodenya
        $kode = '12345abc';
        return Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
        ob_end_clean();
    }
    public function index() {
        $temp = rand(10000, 99999);
        echo $this->set_barcode($temp);
    }

    private function set_barcode($code)
    {
        $this->load->library('zend');
        //load yang ada di folder Zend
        $this->zend->load('zend/barcode');
        ob_clean();
        return Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
    }

    public function set_qrcode()
    {
        header("Content-Type: image/png");
        $code = $_GET['id'];
        $params['data'] = $code;
        ob_end_clean();
        $this->ciqrcode->generate($params);
    }

    public function code_print()
    {
        // $generateCodeBy = $_POST['printCodeBy'];
        // $code           = $_POST['printCode'];
        $code = 'soni';
        $generateCodeBy = 'Barcode';
        if ($generateCodeBy == 'Barcode') {
            $view = 'barcode_view';
        }else if ($generateCodeBy == 'QR-Code') {
            $view = 'qrcode_view';
        }
        $data['code'] = $code;
        // $data['qrcodeName'] = $_POST['printQrcode'];
        $data['qrcodeName'] = 'sonise';
        // var_dump($data['qrcodeName']);
        // exit();
        $nama_dokumen='Code-'.$code; //Beri nama file PDF hasil.
        define('_MPDF_PATH','MPDF60/');
        include(FCPATH. "MPDF60/mpdf.php");
        
        $mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
        ob_start();

        //Beginning Buffer to save PHP variables and HTML tags
        $this->load->view('utility/'.$view, $data);

        $html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
        ob_end_clean();
        //Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output($nama_dokumen.".pdf" ,'I');
        exit;
    }

    public function test()
    {
        //kita load library nya ini membaca file Zend.php yang berisi loader
        //untuk file yang ada pada folder Zend
        $this->load->library('zend');
         
        //load yang ada di folder Zend
        $this->zend->load('Zend/Barcode');
         
        //generate barcodenya
        $kode = '12345abc';
        Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
    }
}
?>

