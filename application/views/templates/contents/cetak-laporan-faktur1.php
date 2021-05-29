<?php

class MYPDF extends TCPDF {

		//Page header
		public function Header() {
				//Logo
				$image_file = K_PATH_IMAGES.'logo.png';
				$this->Image($image_file, 15, 10, 20, '', 'PNG', '', 'C', false, 150, '', false, false, 0, false, false, false);
				
				$image_file = K_PATH_IMAGES.'jne.png';
				$this->Image($image_file, 65, 6, 20, '', 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);
				
				// Set font
				$this->SetFont('helvetica', 'B', 20);
				// Title
				$this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');


				// $image_file = K_PATH_IMAGES.'logo.png';
				// $this->Image($image_file, 150, 10, 40, '', 'PNG', '', 'T', false, 150, '', false, false, 0, false, false, false);
				// // Set font
				// $this->SetFont('helvetica', 'B', 20);
				// // Title
				// $this->Cell(0, 10, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');

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
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(374.17322835, 100), true, 'UTF-8', false);
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TB Dwi Makmur');
$pdf->SetTitle('Faktur Penjualan - TB Dwi Makmur');
$pdf->SetSubject('Faktur Penjualan');
$pdf->SetKeywords('POS, Aplikasi, Website, Faktur Penjualan');
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
$total_harga =  $lapor['penj_total_harga']+$biaya_lain;
$dibayar =  $lapor['penj_dibayar'];
$catatan =  $lapor['penj_keterangan'];
$ongkir =  $lapor['penj_ongkir'];
$sisa = $total_harga-$dibayar;


$pdf->SetFont('helvetica', '', 14);
$pdf->SetY(18.5);
$isi = "<hr>";
$pdf->writeHTML($isi, true, false, false, false, '');

// Center position
$pdf->SetY(19.5);
$style['position'] = 'C';
$pdf->write1DBarcode('CENTER', 'C128A', '', '', '', 10, 0.5, $style, 'N');
$pdf->Ln(2);

$pdf->SetFont('helvetica', '', 8);
// $pdf->SetY(28);
$html = '<div style="text-align:center"><span>Kode Booking : <br>'.$nofaktur.'<br></span></div>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFont('helvetica', '', 6);
// $pdf->SetY(18.5);
$isi = '
<table cellspacing="1" cellpadding="1">
	<tr>
		<td width="45%"><hr><br>
		Biaya Kirim     &nbsp;&nbsp;&nbsp;: Rp '.$ongkir.'<br>
		Biaya Admin &nbsp;: -<br>
		Asuransi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Ya<br><hr>
		<b>PENGIRIM</b><br>
		Zeb Hobbies Store - 081573741212 Bandung, Jawa Barat
		<br><hr>
		</td>
		
		
		<td width="10%"></td>
		
		
		<td width="45%"><hr><br>
		No Transaksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$nofaktur.'<br>
		Berat Barang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 451 Gram<br><hr>
		<b>PENERIMA</b><br>
		'.$nama_pembeli.' - '.$no_hp_pembeli.' '.$alamat_pembeli.'
		<br><hr>
		</td>
	</tr>
</table>
';
$pdf->writeHTML($isi, true, false, false, false, '');
// $pdf->SetFont('helvetica', '', 8);
// // $pdf->SetY(18.5);
// $isi = '
// <table cellspacing="1" cellpadding="1">
// 	<tr>
// 		<td width="45%">
// 		Biaya Kirim     : <br>
// 		Biaya Admin : <br>
// 		Asuransi : <br><hr></td>
// 		<td width="10%"></td>
// 		<td width="45%">
// 		No Transaksi : <br>
// 		Jasa Pengiriman : <br>
// 		Berat Barang : <br>
// 		<hr></td>
// 	</tr>
// </table>
// ';
// $pdf->writeHTML($isi, true, false, false, false, '');

$pdf->SetFont('helvetica', '', 7.5);
//  $pdf->SetY(60);
$i=0;
$html='
				<table cellpadding="1">
						<tr bgcolor="#ffffff" cellspacing="0" cellpadding="1">
								<th width="45%">Nama Barang </th>
								<th width="25%" align="left"> SKU </th>
								<th width="15%" align="center"> Jumlah </th>
								<th width="15%" align="center"> Harga </th>
						</tr>';

	foreach ($produk as $row)
		{
				$i++;
				$html.='<tr bgcolor="#ffffff">
								<td>'.$row['prod_nama'].'</td>
								<td align="left">'.$row['prod_kode'].'</td>
								<td align="center">'.$row['pede_jumlah'].'</td>
								<td align="center">'.$row['pede_harga'].'</td>
						</tr>

						';

		}
$html.='</table>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFont('helvetica', '', 10);
// $pdf->SetY(120);
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

				//  $pdf->SetFont('helvetica', '', 10);
				//  $pdf->SetY(145);
				//  $isi = "<br><table>
				// 		 <tr>
				// 		 <td align=\"left\"><p>Hari $hari1 Tanggal $tanggal1 Bulan $bulan1 Tahun $tahun1 </p></td>
				// 		 </tr>
				// 		 <tr>
				// 		 <td align=\"left\"><p>A.n <b>$nama_pembeli</b></p></td>
				// 		 </tr>

				// 		 <tr>
				// 		 <td align=\"left\"><p>Keterangan Lain-lain</p></td>
				// 		 </tr>

				// 		</table>
				// 		<p></p>";
				// 	$pdf->writeHTML($isi, true, false, false, false, '');

					// $pdf->SetFont('helvetica', '', 10);
					// $pdf->SetY(127);
					// $isi = "<br><table>

					// 	 </table>
					// 	<hr style=\"color:#FF0000\"><hr style=\"color:#FF0000\"><p></p>";
					//  $pdf->writeHTML($isi, true, false, false, false, '');
					 
					 $pdf->SetFont('helvetica', '', 10);
					 $pdf->SetY(128);
					 $isi = "
							<hr>";

						$pdf->writeHTML($isi, true, false, false, false, '');

						$pdf->SetFont('helvetica', '', 8);
					//  $pdf->SetY(185);
						$isi = "
							<p><i>CATATAN PEMBELI<i><br>
							".$catatan."</p>";
						$pdf->writeHTML($isi, true, false, false, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
