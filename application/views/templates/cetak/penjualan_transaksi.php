
    <style>
        #detail {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }

        #detail td, #detail th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        #detail th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: red;
          color: white;
        }
        </style>
    <br><br>
    <table>
        <tr>
            <td><img src="<?php echo base_url();?>assets/img/logo.png"></td>
        </tr>
    </table>
    <br>
    <hr>
    <div style="height: 10px;"></div>
    <table border="0" width="100%">
        <tr>
            <td><b>NOTA</b> No. 250222</td>
        </tr>
    </table>
    <div style="height: 10px;"></div>
    <table id="detail" border="1" width="100%" style="height: 200px;">
        <thead style="">
            <tr style="background-color: #38b8e7;">
                <th style="width: 5%;text-align: center;">No.</th>
                <th style="width: 30%;text-align: center;">Nama Barang</th>
                <th style="width: 15%;text-align: center;">Ukuran</th>
                <th style="width: 10%;text-align: center;">M2</th>
                <th style="width: 10%;text-align: center;">Stuck/isi</th>
                <th style="width: 15%;text-align: center;">Harga Satuan</th>
                <th style="width: 15%;text-align: center;">Jumlah</th>
            </tr>    
        </thead>
        <tbody>
            <?php $total = 0; $sepuluh=10; $no=1; foreach ($dataPenjualan as $q):
            $total = $q['pede_total_harga'] + $total;
            ?>
            <tr>
                <td style="width: 5%;text-align: center;"><?=$no?></td>
                <td style="width: 30%;text-align: center;"><?=$q['prod_name']?></td>
                <td style="width: 15%;text-align: center;"><?=$q['pede_jumlah_ukuran']?></td>
                <td style="width: 10%;text-align: center;"></td>
                <td style="width: 10%;text-align: center;"></td>
                <td style="width: 15%;text-align: center;"><?=$q['pede_harga']?></td>
                <td style="width: 15%;text-align: center;"><?=$q['pede_jumlah']?></td>
            </tr>
            <?php endforeach;?>
            <?php $sisa = $sepuluh-count($dataPenjualan);
                if($sisa > 0){
                    for ($i=0; $i < $sisa; $i++) { 
                        echo '<tr>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                        echo '</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
    <div style="height: 10px;"></div>
    
    <table style="width: 100%;">
        <tr>
            <td style="width: 30%;text-align: center;">Penerima</td>
            <td style="width: 30%;"></td>
            <td style="width: 30%;text-align: right;"><div style="width: 60%;">Jumlah Rp. : <b style="width:40%;text-align: right;"><?php echo $total;?></b><br>Uang Muka Rp. : <br>Sisa Rp. : </div></td>
            <td style="width: 10%;text-align: right;"></td>
        </tr>
        <tr>
            <td style="width: 30%;text-align: center;"></td>
            <td style="width: 30%;"></td>
            <td style="width: 15%;text-align: right;"></td>
            <td style="width: 25%;text-align: right;"></td>
        </tr>
        <tr>
            <td style="width: 30%;text-align: center;"><br><br><br>(.....................)</td>
            <td style="width: 30%;text-align: center;border: 5px solid;"><br>Perhatian <br>Barang yang sudah dibeli tidak dapat dikembalikan / ditukar<br></td>
            <td style="width: 15%;text-align: right;"></td>
            <td style="width: 25%;text-align: right;"></td>
        </tr>
    </table>