<?php

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'sikardu.png';
        // $image_file = null;
        $this->Image($image_file, 20, 17, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');

    }


    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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


$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(20);
$isi = "<br><table>
    <tr>
     <td align=\"right\"><h3>SURAT JALAN</h3></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
     <td align=\"right\"><h6></h6></td>
    </tr>

   </table>
   <br><p></p>

   ";

 $pdf->writeHTML($isi, true, false, false, false, '');

$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(50);
$isi = "<br><table>
    <tr>
     <td align=\"left\"><h6>Yang bertanga tangan dibawah ini :</h6></td>
     <td></td>
     <td></td>
    </tr>
    <tr>
      <td style=\"width:20%;\"><h6>Nama</h6></td>
      <td style=\"width:5%;\"><h6>:</h6></td>
      <td><h6 style=\"text-align:left;\">Distribusi</h6></td>
    </tr>
    <tr>
      <td><h6>Jabatan</h6></td>
      <td><h6>:</h6></td>
      <td><h6>Distribusi </h6></td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr>
     <td style=\"width:100%;\" align=\"left\"><h6>Menerangkan bahwa saudara :</h6></td>
     <td></td>
     <td></td>
    </tr>
    <tr>
      <td style=\"width:20%;\"><h6>Nama</h6></td>
      <td style=\"width:5%;\"><h6>:</h6></td>
      <td><h6 style=\"text-align:left;\">Distribusi</h6></td>
    </tr>
    <tr>
      <td style=\"width:20%;\"><h6>Alamat</h6></td>
      <td style=\"width:5%;\"><h6>:</h6></td>
      <td><h6 style=\"text-align:left;\">Bandung</h6></td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    </tr>

   ";

 $pdf->writeHTML($isi, true, false, false, false, '');


//   $pdf->writeHTML($isi, true, false, false, false, '');

//     $nama_pemilik =  null;
//     $no_hp_pemilik =  null;
//     $luas =  null;
//     $penyebab =  null;
//     $korban_meninggal =  null;
//     $korban_luka =  null;
//     $korban_jiwa =  $korban_meninggal+$korban_luka;
//     $jarak =  null;
//     $personil =  null;
//     $jumlah_mobil =  null;
//     $nomor_polisi =  null;

//     $lapo_waktu_keputusan =  null;
//     $lapa_waktu_mulai =  null;
//     $lapa_waktu_sampai =  null;
//     $lapa_waktu_selesai =  null;
//     $keja_nama =  null;
//     $lapo_nama =  null;
//     $hari_tanggal =  null;
//     $myString = null;
//     $this->load->helper('tanggal');
//     $waktu = null;
//     $format = formatHariTanggal($waktu);
//     $myArray = explode(',', $format);
//     $hari = $myArray[0];
//     $tanggal = $myArray[1];
//     $bulan = $myArray[2];
//     $tahun = $myArray[3];
//     $date = new DateTime( $waktu, new DateTimeZone('Asia/Jakarta') );
//     $jam = $date->format('H:i');
//     $date1 = new DateTime( $lapa_waktu_selesai, new DateTimeZone('Asia/Jakarta') );
//     $jam1 = $date->format('H:i');
//     $waktumulai = null;
//     $waktuselesai = null;
//     $awal  = strtotime($waktumulai); //waktu awal
//     $akhir = strtotime($waktuselesai); //waktu akhir
//     $diff  = $akhir - $awal;
//     $durasijam   = floor($diff / (60 * 60));
//     $menit = $diff - $durasijam * (60 * 60);
//     $durasimenit   = floor( $menit / 60);


//     $responmulai = null;
//     $responselesai = null;
//     $responawal  = strtotime($responmulai); //waktu awal
//     $responakhir = strtotime($responselesai); //waktu akhir
//     $respondiff  = $responakhir - $responawal;
//     $durasiresponjam   = floor($respondiff / (60 * 60));
//     $durasiresponmenit = $respondiff - $durasiresponjam * (60 * 60);
//     $durasiresponmenit1   = floor( $durasiresponmenit / 60);









//      $pdf->SetFont('helvetica', '', 8);
//      $pdf->SetY(70);
//      $isi = "<br><table>
//          <tr>
//          <td align=\"left\"><p>Nama </p></td>
//          </tr>
//          <tr>
//          <td align=\"left\"><p>NIP</p></td>
//          </tr>
//          <tr>
//          <td align=\"left\"><p>Email</p></td>
//          </tr>
//          <tr>
//          <td align=\"left\"><p>Tempat Lahir</p></td>
//          </tr>
//          <tr>
//          <td align=\"left\"><p>Tanggal Lahir</p></td>
//          </tr>
//          <tr>
//          <td align=\"left\"><p>Alamat</p></td>
//          </tr>
//          <tr>
//          <td align=\"left\"><p>Nilai Bobot</p></td>
//          </tr>
//         </table>
//         <p></p>";
//       $pdf->writeHTML($isi, true, false, false, false, '');


//       $pdf->SetFont('helvetica', '', 8);
//       $pdf->SetY(70);
//       $pdf->SetX(10);

//       $isi = "<br><table>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>".$value['nama']."</b></p></td>
//           </tr>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b >".$value['nip']."</b></p></td>
//           </tr>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b >".$value['email']."</b></p></td>
//           </tr>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b >".$value['tempat_lahir']."</b></p></td>
//           </tr>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>".$value['tanggal_lahir']."</b></p></td>
//           </tr>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b >".$value['alamat']."</b></p></td>
//           </tr>
//           <tr>
//           <td align=\"left\"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b >".$value['nilai_bobot_pendaftaran']."</b></p></td>
//           </tr>
//          </table>
//          <p></p>";
//        $pdf->writeHTML($isi, true, false, false, false, '');


//      $pdf->SetFont('helvetica', '', 8);
//      $pdf->SetY(100);
//      $isi = "
//      <style>
//     h1 {
//         color: navy;
//         font-family: times;
//         font-size: 24pt;
//         text-decoration: underline;
//     }
//     p.first {
//         color: #003300;
//         font-family: helvetica;
//         font-size: 12pt;
//     }
//     p.first span {
//         color: #006600;
//         font-style: italic;
//     }
//     p#second {
//         color: rgb(00,63,127);
//         font-family: times;
//         font-size: 12pt;
//         text-align: justify;
//     }
//     p#second > span {
//         background-color: #FFFFAA;
//     }
//     table.first {
//         color: #003300;
//         font-family: helvetica;
//         font-size: 8pt;
//         border-left: 3px solid red;
//         border-right: 3px solid #FF00FF;
//         border-top: 3px solid green;
//         border-bottom: 3px solid blue;
//         background-color: #ccffcc;
//     }
//     td {
//         border: 2px solid black;
//         background-color: #ffffee;
//     }
//     td.second {
//         border: 2px dashed green;
//     }
//     div.test {
//         color: #CC0000;
//         background-color: #FFFF66;
//         font-family: helvetica;
//         font-size: 10pt;
//         border-style: solid solid solid solid;
//         border-width: 2px 2px 2px 2px;
//         border-color: green #FF00FF blue red;
//         text-align: center;
//     }
//     .lowercase {
//         text-transform: lowercase;
//     }
//     .uppercase {
//         text-transform: uppercase;
//     }
//     .capitalize {
//         text-transform: capitalize;
//     }
//     col_1 {
//       width: 3px;
//     }
// </style>
// <br><table class='first'>
//          <tr>
//            <td class='col_1' align=\"left\"><p>No </p></td>
//            <td align=\"left\"><p>Unsur Utama</p></td>
//            <td align=\"left\"><p>Satuan Hasil</p></td>
//            <td align=\"left\"><p>Frek Kegiatan</p></td>
//            <td align=\"left\"><p>Bobot Nilai</p></td>
//            <td align=\"left\"><p>Total</p></td>
//          </tr>";
//          $no=1; foreach($kategori as $q):
//             $sub_unsur = $this->db->where('coni_coni_id', 0)->where('coni_cats_id', $q['cats_id'])->get('config_items')->result_array();
//             $isi.= "<tr>
//               <td class='col_1'>".$no."</td>
//               <td>".$q['cats_name']."</td>
//               <td></td>
//               <td></td>
//               <td></td>
//               <td></td>
//             </tr>";
//             foreach($sub_unsur as $s):
//                 $butir = $this->db->join('config_items b', 'b.coni_id = a.coni_id', 'left')->join('daftar c', 'c.kode = a.kode_daftar')->where('c.email', $email)->where('coni_coni_id', $s['coni_id'])->get('daftar_file a')->result_array();
//                 $isi.= "<tr>
//                   <td class='col_1'></td>
//                   <td>".$s['coni_name']."</td>
//                   <td></td>
//                   <td></td>
//                   <td></td>
//                   <td></td>
//                 </tr>";
//                 foreach($butir as $b):
//                     $isi.= "<tr>
//                       <td class='col_1'></td>
//                       <td>".$b['coni_name']."</td>
//                       <td>".$b['coni_description']."</td>
//                       <td>".$b['coni_frekuensi']."</td>
//                       <td>".$b['nilai']."</td>
//                       <td>".$b['nilai']*$b['coni_frekuensi']."</td>
//                     </tr>";
//               endforeach;
//             endforeach;
//           $no++; endforeach;
//         $isi.= "</table>
//         <p></p>";
//       $pdf->writeHTML($isi, true, false, false, false, '');

//       $pdf->SetFont('helvetica', '', 8);
//       $pdf->SetY(175);
//       $isi = "<br><table>
//           <tr>
//           <td align=\"right\"><p>Ditetapkan di Bandung&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//           </tr>
//           <tr>
//           <td align=\"right\"><p>DINAS KESEHATAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//           </tr>
//           <tr>
//           <td align=\"right\"><p>KOTA BANDUNG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//           </tr>
//           <tr>
//           <td align=\"right\"><p>KEPALA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//           </tr>

//          </table>
//          <p></p>";
//        $pdf->writeHTML($isi, true, false, false, false, '');

//        $pdf->SetFont('helvetica', '', 8);
//        $pdf->SetY(205);
//        $isi = "<br><table>
//            <tr>
//            <td align=\"right\"><p><u>Drs. H. AJI SUKARMAJI. M.Si</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//            </tr>
//            <tr>
//            <td align=\"right\"><p>Pembina Utama Muda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//            </tr>
//            <tr>
//            <td align=\"right\"><p>NIP 19660315 198609 1 001&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//            </tr>

//           </table>
//           <p></p>";
//         $pdf->writeHTML($isi, true, false, false, false, '');

//         $pdf->SetFont('helvetica', '', 8);
//         $pdf->SetY(225);
//         if($keja_nama == "Kebakaran"){
//           $isi = "<br><table>
//             <tr>
//             <td align=\"left\"><p>Tembusan  disampaikan kepada Yth:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>1. Kepala Badan Kepegawaian Daerah Kota Bandung; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>2. Kepala Sub Bagian Umum dan Kepegawaian Dinas Kesehatan Kota Bandung; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>3. Kepala UPT Puskesmas Sindangjaya; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>4. Sekretaris Tim Penilai; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>5. Yang Bersangkutan; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>

//            </table>
//            <p></p>";  
//         }else{
//           $isi = "<br><table>
//             <tr>
//             <td align=\"left\"><p>Tembusan  disampaikan kepada Yth:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>1. Kepala Badan Kepegawaian Daerah Kota Bandung; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>2. Kepala Sub Bagian Umum dan Kepegawaian Dinas Kesehatan Kota Bandung; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>3. Kepala UPT Puskesmas Sindangjaya; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>4. Sekretaris Tim Penilai; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>
//             <tr>
//             <td align=\"left\"><p>5. Yang Bersangkutan; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
//             </tr>

//            </table>
//            <p></p>";  
        
//         }
        
//          $pdf->writeHTML($isi, true, false, false, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
