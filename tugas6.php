<?php
// --- Bagian PHP ---

$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

// Fungsi untuk mengurutkan array berdasarkan nama bandara
function urutkanBandara($array_bandara) {
    ksort($array_bandara); // urut berdasarkan key (nama bandara)
    return $array_bandara;
}

// Urutkan bandara
$bandara_asal = urutkanBandara($bandara_asal);
$bandara_tujuan = urutkanBandara($bandara_tujuan);

$hasil = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maskapai = $_POST["maskapai"];
    $asal = $_POST["asal"];
    $tujuan = $_POST["tujuan"];
    $harga = (int)$_POST["harga"];

    // Gunakan if else untuk pajak bandara asal
    if ($asal == "Soekarno Hatta") {
        $pajak_asal = 65000;
    } else if ($asal == "Husein Sastranegara") {
        $pajak_asal = 50000;
    } else if ($asal == "Abdul Rachman Saleh") {
        $pajak_asal = 40000;
    } else if ($asal == "Juanda") {
        $pajak_asal = 30000;
    } else {
        $pajak_asal = 0;
    }

    // Gunakan if else untuk pajak bandara tujuan
    if ($tujuan == "Ngurah Rai") {
        $pajak_tujuan = 85000;
    } else if ($tujuan == "Hasanuddin") {
        $pajak_tujuan = 70000;
    } else if ($tujuan == "Inanwatan") {
        $pajak_tujuan = 90000;
    } else if ($tujuan == "Sultan Iskandar Muda") {
        $pajak_tujuan = 60000;
    } else {
        $pajak_tujuan = 0;
    }

    // Hitung total
    $pajak = $pajak_asal + $pajak_tujuan;
    $total_harga = $pajak + $harga;

    // Tampilkan hasil
    $hasil = "
    <h3>Data Penerbangan</h3>
    Nomor: " . rand(1000, 9999) . "<br>
    Tanggal: " . date("Y-m-d") . "<br>
    Nama Maskapai: $maskapai<br><br>

    <table border='1' cellpadding='5'>
        <tr>
            <th>Asal Penerbangan</th>
            <th>Tujuan Penerbangan</th>
            <th>Harga Tiket</th>
            <th>Pajak</th>
            <th>Total Harga Tiket</th>
        </tr>
        <tr>
            <td>$asal</td>
            <td>$tujuan</td>
            <td>Rp " . number_format($harga, 0, ',', '.') . "</td>
            <td>Rp " . number_format($pajak, 0, ',', '.') . "</td>
            <td>Rp " . number_format($total_harga, 0, ',', '.') . "</td>
        </tr>
    </table>
    <hr>";
}
?>

<!-- --- Bagian HTML --- -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Rute Penerbangan</title>
</head>
<body>
    <h2>Form Pendaftaran Rute Penerbangan</h2>

    <?= $hasil ?>

    <form method="POST">
        Nama Maskapai: <input type="text" name="maskapai" required><br><br>

        Bandara Asal:
        <select name="asal" required>
            <option value="">-- Pilih Bandara Asal --</option>
            <?php foreach ($bandara_asal as $nama => $pajak): ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php endforeach; ?>
        </select><br><br>

        Bandara Tujuan:
        <select name="tujuan" required>
            <option value="">-- Pilih Bandara Tujuan --</option>
            <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php endforeach; ?>
        </select><br><br>

        Harga Tiket: <input type="number" name="harga" required><br><br>

        <input type="submit" value="Simpan Data">
    </form>
</body>
</html>
