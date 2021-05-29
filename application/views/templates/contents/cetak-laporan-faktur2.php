<?php

class MYPDF extends TCPDF {

		//Page header
		public function Header() {
				// Logo
				$image_file = K_PATH_IMAGES.'logo.png';

				$this->Image($image_file, 15, 10, 40, '', 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);
				// Set font
				$this->SetFont('helvetica', 'B', 20);
				// Title
				$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');


				$image_file = K_PATH_IMAGES.'logo.png';

				$this->Image($image_file, 150, 10, 40, '', 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);
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
// $your_width = 374.17322835;
// $yout_height = 1000;
// $custom_layout = array($your_width, $your_height);
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(374.17322835, 100), true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Royale House');
$pdf->SetTitle('Faktur Penjualan - Royale House');
$pdf->SetSubject('Faktur Penjualan');
$pdf->SetKeywords('Royale House, POS, Aplikasi, Website, Faktur Penjualan');
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
$nofaktur =  $lapor['penj_id'];
$nama_pembeli =  $lapor['penj_nama'];
$nama_user =  $this->session->userdata('data')['nama'];
$alamat_pembeli =  $lapor['penj_alamat'];
$no_hp_pembeli =  $lapor['penj_no_hp'];
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
$pdf->SetY(28);
$isi = "<hr>";
$pdf->writeHTML($isi, true, false, false, false, '');

$pdf->SetFont('helvetica', '', 8);
$pdf->SetY(28);
$isi = "<p style='text-align: center;'>Kode Boking</p> <p style='text-align: center;'>BL-1923423422123</p>";
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
				 <td align=\"left\"><p>Pemesan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>$nama_pembeli</b> </p></td>
				 </tr>
				 <tr>
				 <td align=\"left\"><p>Alamat Lengkap&nbsp;: <b>$alamat_pembeli</b> </p></td>
				 </tr>
					<tr>
					<td align=\"left\"><p>Telp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>$no_hp_pembeli</b> </p></td>
					</tr>

				 </table>
				 <p></p>";
			 $pdf->writeHTML($isi, true, false, false, false, '');

			 $pdf->SetFont('helvetica', '', 10);
			 $pdf->SetY(55);
			 $isi = "<br><table>
					 <tr>
					 <td><p><b>Daftar Produk</b></p></td>
					 </tr>
					</table>
					<p></p>";
				$pdf->writeHTML($isi, true, false, false, false, '');



			 $pdf->SetFont('helvetica', '', 10);
			 $pdf->SetY(60);
			 $i=0;
			 $html='
							 <table cellspacing="1" bgcolor="#666666" cellpadding="1">
									 <tr bgcolor="#ffffff">
											 <th width="5%" align="center">No</th>
											 <th width="15%" align="center">Kategori</th>
											 <th width="20%" align="center">Produk</th>
											 <th width="20%" align="center">Harga</th>
											 <th width="20%" align="center">Jumlah</th>
											 <th width="20%" align="center">Total Harga</th>
									 </tr>';
$tinggi=0;


			 foreach ($produk as $row)
					 {
							 $i++;
							 $html.='<tr bgcolor="#ffffff">
											 <td align="center">'.$i.'</td>
											 <td>'.$row['kate_nama'].'</td>
											 <td>'.$row['prod_nama'].'</td>
											 <td align="right">'.number_format($row['pede_harga'],0,",",",").'</td>
											 <td>'.$row['pede_jumlah'].'</td>
											 <td align="right">'.number_format($row['pede_total_harga'],0,",",",").'</td>
									 </tr>

									 ';
									 $tinggi=$tinggi+5;

					 }
			 $html.='</table>';
			 $pdf->writeHTML($html, true, false, true, false, '');

			 $pdf->SetFont('helvetica', '', 10);
			 $pdf->SetY(70+$tinggi);
			 $i=0;
			 $html='
							 <table cellspacing="1" bgcolor="#666666" cellpadding="2">
							 <tr bgcolor="white">
									 <th width="65%" align="right">Total</th>
									 <th width="35%" align="right">'.number_format($total_harga,0,",",",").'</th>
							 </tr>';

			 foreach ($produk as $row)
					 {
							 $i++;

					 }
			 $html.='</table>';
			 $pdf->writeHTML($html, true, false, true, false, '');

			 $pdf->SetFont('helvetica', '', 10);
			 $pdf->SetY(65+$tinggi);
			 $i=0;
			 $html='
							 <table cellspacing="1" bgcolor="#666666" cellpadding="2">
							 <tr bgcolor="white">
									 <th width="65%" align="right">Uang Muka</th>
									 <th width="35%" align="right">'.number_format($dibayar,0,",",",").'</th>
							 </tr>';

			 foreach ($produk as $row)
					 {
							 $i++;

					 }
			 $html.='</table>';
			 $pdf->writeHTML($html, true, false, true, false, '');

			 $pdf->SetFont('helvetica', '', 10);
			 $pdf->SetY(75+$tinggi);
			 $i=0;
			 $html='
							 <table cellspacing="1" bgcolor="#666666" cellpadding="2">
							 <tr bgcolor="white">
									 <th width="65%" align="right">Uang Sisa</th>
									 <th width="35%" align="right">'.number_format($sisa,0,",",",").'</th>
							 </tr>';

			 foreach ($produk as $row)
					 {
							 $i++;

					 }
			 $html.='</table>';
			 $pdf->writeHTML($html, true, false, true, false, '');

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetY(120);
			$isi = "<br>
					<table>
						<tr>
							<td align=\"left\"><p></p></td>
						</tr>
				 </table>
				 <p></p>";
			 $pdf->writeHTML($isi, true, false, false, false, '');

			 $pdf->SetFont('helvetica', '', 10);
			 $pdf->SetY(130);
			 $isi = "<br><table>

					 <tr>
					 <td align=\"left\"><p></p></td>
					 </tr>

					</table>
					<p></p>";
				$pdf->writeHTML($isi, true, false, false, false, '');
				$pdf->SetFont('helvetica', '', 10);
				$pdf->SetY(126);
				$isi = "<br><table>

						<tr>
						<td align=\"left\"><b><p></p></b></td>
						</tr>

					 </table>
					 <p></p>";
				 $pdf->writeHTML($isi, true, false, false, false, '');

				 $pdf->SetFont('helvetica', '', 10);
				 $pdf->SetY(145);
				 $isi = "<br><table>
						 <tr>
						 <td align=\"left\"><p>Hari $hari1 Tanggal $tanggal1 Bulan $bulan1 Tahun $tahun1 </p></td>
						 </tr>
						 <tr>
						 <td align=\"left\"><p>A.n <b>$nama_pembeli</b></p></td>
						 </tr>

						 <tr>
						 <td align=\"left\"><p>Keterangan Lain-lain</p></td>
						 </tr>

						</table>
						<p></p>";
					$pdf->writeHTML($isi, true, false, false, false, '');

					$pdf->SetFont('helvetica', '', 10);
					$pdf->SetY(127);
					$isi = "<br><table>

						 </table>
						<hr style=\"color:#FF0000\"><hr style=\"color:#FF0000\"><p></p>";
					 $pdf->writeHTML($isi, true, false, false, false, '');
					 $pdf->SetFont('helvetica', '', 10);
					 $pdf->SetY(128);
					 $isi = "<br><table>
							</table>
							<hr><hr><p></p>";

						$pdf->writeHTML($isi, true, false, false, false, '');




						$pdf->SetFont('helvetica', '', 10);
						$pdf->SetY(165);
						$isi = "<br><table>
						<tr>
						<td width=\"100%\" align=\"right\"><p>Bandung, 30 Juli 2019</p></td>
						</tr>
							 </table>
							 <p></p>";
						 $pdf->writeHTML($isi, true, false, false, false, '');

							$pdf->SetFont('helvetica', '', 10);
							$pdf->SetY(170);
							$isi = "<br><table>
							<tr>
							<td width=\"95%\" align=\"right\"><p>Petugas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td>
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



								 $pdf->SetFont('helvetica', '', 9);
								 $pdf->SetY(185);
								 $isi = "<br><table>
										 <tr>
										 <td  align=\"left\"><p><i> Terima Kasih <br>Semoga amal ibadah kita semua.
										 diterima Allah SWT. aamin yra.</i></p></td>
										 </tr>
										</table>
										<p></p>";
									$pdf->writeHTML($isi, true, false, false, false, '');


									// add a page
	// set bacground image
$img_file = K_PATH_IMAGES.'plaza1.png';
$pdf->Image($img_file, 20, 140, 25, '', '', '', '', false, 300, '', false, false, 0);






// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
