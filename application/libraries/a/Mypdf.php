<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Mypdf extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        // $logo_soni = 'http://pos-batu.berkahnesia.com/assets/img/LogoDTPWiFi.png';
        // $image_file = 'http://pos-batu.berkahnesia.com/assets/img/LogoDTPWiFi.png';
        // $this->Image($image_file, 10, 10, 35, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        // $this->SetFont('helvetica', 'B', 18);
        // Title
        // $this->Cell(0, 15, 'PD. PONDOMORO', 0, false, 'R', 0, '', 0, false, '', '');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}