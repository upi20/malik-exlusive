<!DOCTYPE html>
<html><head>
    <title>Data Pasien</title>
</head><body>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }
    </style>
    <?php if($this->input->get('start_date') != '' && $this->input->get('end_date') != ''): ?>
        <h3>DATA PASIEN Dari Tanggal <?= $this->input->get('start_date'); ?> - <?= $this->input->get('end_date'); ?></h3>
        <?php else: ?>
        <h3>DATA PASIEN KESELURUHAN</h3>
    <?php endif; ?>
    <br>
   <pre><?php print_r($data); ?></pre>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Email Pasien</th>
                <th>No.Telp Pasien</th>
                <th>Status</th>
                <th>Hasil Diagnosa</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
  
        </tbody>
    </table>
</body></html> q