<?php

$code = 'KD12345';

include_once APPPATH.'/third_party/mpdf/mpdf.php';
// include("mpdf/mpdf.php");
// $this->load->library('mpdf');
        //load yang ada di folder Zend
// $this->mpdf->load('mpdf/mpdf.php');
$html='<html>
<head>
  <style>
    .container{width: 1450px; padding-bottom:2px;}
    body, table {
        /* to centre page on screen*/
        margin:0 auto;
        font-size: 12px;
        border-collapse: collapse;
    }
</style>
</head>
<body>
<div class="container" style="padding-top:2%;">
           <img class="img-responsive" style="text-align:center;" src="'. base_url().'index.php/Controller/barcode?bcd='.$code.'" alt="">
        </div> 
</body>
</html>';

$mpdf=new mPDF('', 'A4', 0, '', 2, 2,5, 0, 0, 0);
header("Content-type:application/pdf");
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);
$mpdf->Output($code.'.PDF','I');
exit;

?>