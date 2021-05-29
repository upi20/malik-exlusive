<!DOCTYPE html>
<html>
<head>
  <title>Cetak Faktur Penjualan</title>
  <style type="text/css">
    #outtable{
      padding: 20px;
      border:1px solid #e3e3e3;
      /*width:600px;*/
      border-radius: 5px;
    }
 
    .short{
      /*width: 50px;*/
    }
 
    .normal{
      /*width: 150px;*/
    }
 
    table{
      border-collapse: collapse;
      font-family: arial;
      width: 100%;
      /*color:#5E5B5C;*/
    }
 
    thead th{
      text-align: left;
      padding: 10px;
    }
 
    tbody td{
      border-top: 1px solid #e3e3e3;
      padding: 10px;
    }
 
    tbody tr:nth-child(even){
      /*background: #F6F5FA;*/
    }
 
    tbody tr:hover{
      /*background: #EAE9F5*/
    }
  </style>
</head>
<body>
	<h2 align="center">Faktur Penjualan</h2>
	<hr>
	<br>
	<table style="width: 100%;">
		<tr>
			<td>No. Telp</td>
			<td>:</td>
			<td>-</td>
			<td></td>
			<td></td>
			<td>Deskripsi</td>
			<td>:</td>
			<td>-</td>
		</tr>
	</table>
	<br>
	<br>
	<div id="outtable">
	  <table style="width: 100%">
	  	<thead>
	  		<tr>
					<th class="short">No</th>
					<th class="normal">Nama</th>
					<th class="normal">Jumlah</th>
					<th class="normal">Size S</th>
					<th class="normal">Size M</th>
					<th class="normal">Size L</th>
					<th class="normal">Size XL</th>
					<th class="normal">Total Harga</th>
				</tr>
	  	</thead>
	  	<tbody>
  		 	<tr>
  		 		<td></td>
  		 		<td></td>
  		 		<td></td>
  		 		<td></td>
  		 		<td></td>
  		 		<td></td>
  		 		<td></td>
  		 		<td></td>
  		 	</tr>
	  	</tbody>
	  </table>
	 </div>
	 <br>
	 <br>
	 <br>
	 <br>
	 <table style="width: 100%;">
		<tr align="right">
			<td>Bandung, <?=date("d m Y")?></td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<table style="width: 100%;">
		<tr align="right">
			<td>Susan (Owner Ameera Hijab Fashion)</td>
		</tr>
	</table>
</body>
</html>