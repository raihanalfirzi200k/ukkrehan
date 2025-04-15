<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .btn {
                display: none;
            }
            body {
                background: white;
                color: black;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h2>LAPORAN PENJUALAN KASIR</h2>
        <p><em>Dicetak otomatis saat halaman dibuka</em></p>
    </div>

    <a href="index.php" class="btn btn-success mb-3">⬅ Kembali</a>

    <?php
    include '../koneksi.php';
    ?>

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>ID Penjualan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $sql = mysqli_query($koneksi, "SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.PelangganID=penjualan.PelangganID");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $data['PelangganID']; ?></td>
                <td><?= $data['NamaPelanggan']; ?></td>
                <td><?= $data['Alamat']; ?></td>
                <td>Rp <?= number_format($data['TotalHarga'], 0, ',', '.'); ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    window.onload = function() {
        window.print();
    }
</script>

</body>
</html>
