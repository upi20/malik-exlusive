<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
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
    <div style="height: 10px;"></div>
    <table border="0" width="100%">
        <tr>
            <td>Laporan Sapi</td>
        </tr>
    </table>
    <div style="height: 10px;"></div>
    <table id="detail" border="1" width="100%" style="height: 200px;">
        <thead style="">
            <tr style="background-color: #38b8e7;">
                <th style="width: 30%;text-align: center;">No. Rec</th>
                <th style="width: 20%;text-align: center;">Lokal</th>
                <th style="width: 20%;text-align: center;">Pen</th>
                <th style="width: 30%;text-align: center;">Status</th>
            </tr>    
        </thead>
        <tbody>
            <?php foreach($list as $q):?>
            <tr>
                <td><?=$q['prod_nama']?></td>
                <td><?=$q['ruma_nama']?></td>
                <td><?=$q['blok_nama']?></td>
                <td><?=$q['prod_status']?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <div style="height: 10px;"></div>
    