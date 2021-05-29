<?php

 header("Content-type: application/vnd-ms-excel");

 header("Content-Disposition: attachment; filename=$title.xls");

 header("Pragma: no-cache");

 header("Expires: 0");
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Pos Kue, JagadCreative v1.0.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>


<body>
<div>



Nama PT<br>
Komplek atau yg lain<br>
Jl. apa aja Raya, no sekian<br>
Tlp. No 12345678<br>
<br>
<P><strong><h3>Nota Penjualan</h3></strong></P> 
<table border="1"  width="100%" >
    <thead>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga Satuan (Rp)</th>
            <th>Total (Rp)</th>
            
            
        </tr>
    </thead>
    <tbody>
    
        <tr align="center">
            <td valign="top" align="left">1</td>
            <td valign="top" align="left">Nastar</td>
            <td valign="top" align="left">2</td>
            <td valign="top" align="right">75.000</td>
            <td valign="top" align="right">150.000</td>
           
           
            
        </tr>
		<tr align="center" >
            <td valign="top" rowspan="2" align="Right" colspan="4">Grand Total&nbsp;&nbsp;&nbsp;</td>
            <td valign="top" rowspan="2" align="right"><u>Rp. 150.000</u></td>
			
           
           
            
        </tr>
		<tr>
		</tr>
    </tbody>
    
</table>
<br />
Perhatian!!
<ol>
	<li>Barang Yang Sudah Dibeli Tidak Bisa Dikembalikan</li>
	<li>Baca dengan Teliti</li>
</ol>

	<p>Hormat Kami</p>
	<br />
	<br />
	<p>(<u>..............</u>)</p>

</div>
</body>
</html>