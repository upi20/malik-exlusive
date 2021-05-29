<?php
 
class PdfGenerator
{
  public function generate($html,$filename)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', true);
    // require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");
    require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
  
    // $dompdf = new DOMPDF();
    // $dompdf->load_html($html);
    // $dompdf->render();
    // $dompdf->stream($filename.'.pdf',array("Attachment"=>0));

    $dompdf = new DOMPDF();

    $dompdf->load_html($html);

    $dompdf->render();

    $pdf = $dompdf->output();

    $invnoabc = 'Bokkinglist.pdf';

    ob_end_clean();

    $dompdf->stream($invnoabc);exit;
  }
}