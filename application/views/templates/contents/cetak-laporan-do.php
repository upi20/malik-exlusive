<?php

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'Logo.png';

        $this->Image($image_file, 20, 10, 15, '', 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');

    }


    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-5);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 5, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);








// add a page
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', '', 12);


 $this->load->helper('tanggal');
$nodo =  $lapor['penj_id'];
$nama_pembeli =  $lapor['penj_nama'];
$nama_penerima =  $lapor['penj_nama_2'];
$nama_user =  $lapor['user_name'];
$nama_instansi =  $lapor['penj_instansi'];
$alamat_pembeli =  $lapor['penj_alamat'];
$no_hp_pembeli =  $lapor['penj_no_hp'];
$kondisi =  $lapor['penj_kondisi'];
$waktu1 = $lapor['penj_tanggal_pengiriman'];
$format1 = formatHariTanggal($waktu1);
$myArray1 = explode(',', $format1);
$hari1 = $myArray1[0];
$tanggal1 = $myArray1[1];
$bulan1 = $myArray1[2];
$tahun1 = $myArray1[3];
$biaya_recah =  $lapor['penj_nominal_recah'];
$biaya_kirim =  $lapor['penj_nominal_pengiriman'];
$biaya_lain=$biaya_recah+$biaya_kirim ;
$total_harga =  $lapor['penj_total_harga']+$biaya_lain;
$dibayar =  $lapor['penj_dibayar'];
$sisa = $total_harga-$dibayar;


$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(10);
$isi = "<br><table>
    <tr>
     <td align=\"Right\"><h3>SURAT JALAN</h3></td>
    </tr>



   </table>
   <br><p></p>

   ";
 $pdf->writeHTML($isi, true, false, false, false, '');

 $pdf->SetFont('helvetica', '', 10);
 $pdf->SetY(15);
 $isi = "<br><table>

     <tr>
      <td align=\"Right\"><h3>No: <b>......</b>/SJ/...../2019</h3></td>
     </tr>


    </table>
    <br><p></p>

    ";
  $pdf->writeHTML($isi, true, false, false, false, '');

 $pdf->SetFont('helvetica', '', 14);
 $pdf->SetY(10);
 $isi = "<br><table>

     <tr>
      <td width=\"40%\" align=\"right\"><p></p></td><br><br>
     </tr>
     <tr>
      <td width=\"33%\" align=\"right\"><p>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td><br><br>
     </tr>


    </table>
    <br><p></p>

    ";
  $pdf->writeHTML($isi, true, false, false, false, '');





     $pdf->SetFont('helvetica', '', 10);
     $pdf->SetY(30);
     $isi = "<br><table>
         <tr>
         <td align=\"left\"><p>Yang Bertanda tangan dibawah ini : </p></td>
         </tr>
         <tr>
         <td align=\"left\"><p>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>".$nama_distribusi."</b></p></td>
         </tr>

         <tr>
         <td align=\"left\"><p>Jabatan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>Distribusi</b> </p></td>
         </tr>
         <tr>
         <td align=\"left\"><p>Menerangkan bahwa saudara : </p></td>
         </tr>
         <tr>
         <td align=\"left\"><p>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$produk[0]['penj_nama']."<b></b></p></td>
         </tr>

         <tr>
         <td align=\"left\"><p>Alamat  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$produk[0]['penj_alamat_2']."</p></td>
         </tr>

        </table>
        <p></p>";
      $pdf->writeHTML($isi, true, false, false, false, '');

      $pdf->SetFont('helvetica', '', 10);
      $pdf->SetY(60);
      $isi = "<br><table>
          <tr>
          <td align=\"left\"><p>Sebagai tenaga pengemudi/pengantar hewan qurban dengan : </p></td>
          </tr>
         </table>
         <p></p>";
       $pdf->writeHTML($isi, true, false, false, false, '');

       $pdf->SetFont('helvetica', '', 10);
       $pdf->SetY(65);
       $isi = "<br><table>
           <tr>
           <td align=\"left\"><p>Jenis Mobil &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </p></td>
           </tr>
           <tr>
           <td align=\"left\"><p>No Pol &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </p></td>
           </tr>
           <tr>
           <td align=\"left\"><p>Dari  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Jl Cigadung Selatan 6 No. 4 Bandung</p></td>
           </tr>
           <tr>
           <td align=\"left\"><p>Tujuan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </p></td>
           </tr>

          </table>
          <p></p>";
        $pdf->writeHTML($isi, true, false, false, false, '');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetY(88);
        $isi = "<br><table>

            <tr>
            <td align=\"left\"><p>Waktu keberangkatan : </p></td>
            </tr>
           </table>
           <p></p>";
         $pdf->writeHTML($isi, true, false, false, false, '');


       $pdf->SetFont('helvetica', '', 10);
       $pdf->SetY(95);
       $i=0;
       $html='
               <table cellspacing="1" bgcolor="#666666" cellpadding="2" align="center">
                   <tr bgcolor="#ffffff" align="center" >

                       <th width="30%" align="center">Kelas</th>
                       <th width="20%" align="center">Nomor Hewan</th>
                       <th width="25%" align="center">Harga</th>
                       <th width="25%" align="center">Sisa</th>
                   </tr>';
                   $tinggi=0;


       foreach ($produk as $row)
        {
               $i++;
               $html.='
               <tr bgcolor="#ffffff">
                    <td align="center">'.$row['kela_nama'].'</td>
                    <td align="center">'.$row['prod_nama'].'</td>
                    <td>'.$this->libs->rupiah($row['pede_harga']).'</td>
                    <td>'.$this->libs->rupiah($row['penj_sisa']).'</td>
              </tr>

                 ';
                 $tinggi=$tinggi+5;

        }
       $html.='</table>';
       $pdf->writeHTML($html, true, false, true, false, '');


      $pdf->SetFont('helvetica', '', 10);
      $pdf->SetY(120);
      $isi = "<br><table>
          <tr>
            <td align=\"left\"><p>Surat ini berlaku dari tanggal <b>20/08/2019</b> sampai dengan <b>20/08/2019</b> </p></td>
          </tr>

         </table>
         <p></p>";
       $pdf->writeHTML($isi, true, false, false, false, '');

       $pdf->SetFont('helvetica', '', 10);
       $pdf->SetY(127);
       $isi = "<br><table>

           <tr>
           <td align=\"left\"><p>Demikian surat ini kami buat untuk digunakan sebagaimana mestinya. </p></td>
           </tr>
          </table>
          <p></p>";
        $pdf->writeHTML($isi, true, false, false, false, '');


        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetY(126);
        $isi = "<br><table>

            <tr>
            <td align=\"left\"><b><p>$kondisi</p></b></td>
            </tr>

           </table>
           <p></p>";
         $pdf->writeHTML($isi, true, false, false, false, '');


         $pdf->SetFont('helvetica', '', 10);
         $pdf->SetY(145);
         $i=0;
         $html='
                 <table height="200px" cellspacing="1" bgcolor="#666666" cellpadding="2" align="center">
                     <tr bgcolor="#ffffff" align="center" >

                         <th width="55%" align="center"><b>Bukti Penerimaan</b></th>


                     </tr>';
  $tinggi=0;


         foreach ($produk as $row)
         {
                 $i++;
                 $html.='
                 <tr bgcolor="#ffffff">
                      <td align="left">Telah menerima hewan Domba</td><br>


                </tr>
                <tr bgcolor="#ffffff" border="0">
                <td align="left">Sebanyak <b>    <u>............</u>   </b> Ekor</td>
                </tr>

                <tr bgcolor="#ffffff">
        <th >ttd</th>
        <td></td>
        <td></td>
        <td></td>
    </tr>

                     ';
                     $tinggi=$tinggi+5;

             }
         $html.='</table>';
         $pdf->writeHTML($html, true, false, true, false, '');


         $pdf->SetFont('helvetica', '', 10);
         $pdf->SetY(185);
         $i=0;
         $html='
                 <table height="200px" cellspacing="1" bgcolor="#666666" cellpadding="2" align="center">
                     <tr bgcolor="#ffffff" align="center" >

                         <th width="55%" align="center"><b>Nama Jelas Penerima</b></th>


                     </tr>';
  $tinggi=0;


         foreach ($produk as $row)
             {
                 $i++;
                 $html.='



                     ';
                     $tinggi=$tinggi+5;

             }
         $html.='</table>';
         $pdf->writeHTML($html, true, false, true, false, '');








            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetY(145);
            $isi = "<br><table>
            <tr>
            <td width=\"100%\" align=\"right\"><p>Bandung, ".date('d M Y')."</p></td>
            </tr>
            <tr>
            <td width=\"97%\" align=\"right\"><p>Distribusi</p></td>
            </tr>
               </table>
               <p></p>";
             $pdf->writeHTML($isi, true, false, false, false, '');

              $pdf->SetFont('helvetica', '', 10);
              $pdf->SetY(170);
              $isi = "<br><table>
              <tr>
              <td width=\"95%\" align=\"right\"><p><u>(.........................)</u></p></td>
              </tr>
                 </table>
                 <p></p>";
               $pdf->writeHTML($isi, true, false, false, false, '');

               $pdf->SetFont('helvetica', '', 10);
               $pdf->SetY(185);
               $isi = "<br><table>
               <tr>
               <td width=\"93%\" align=\"right\"><p><u>$nama_user</u></p></td>
               </tr>


                  </table>
                  <p></p>";
                $pdf->writeHTML($isi, true, false, false, false, '');



                  // add a page
  // set bacground image
// $img_file = K_PATH_IMAGES.'Logo.png';
// $pdf->Image($img_file, 20, 140, 25, '', '', '', '', false, 300, '', false, false, 0);






// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
