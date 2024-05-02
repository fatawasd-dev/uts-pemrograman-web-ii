<?php
require_once 'Mobil.php';
require_once 'Motor.php';

// Membuat array untuk menyimpan data mobil dan motor
$listMobil = [];
$listMotor = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $tipe = $_POST['tipe'];
    $jumlah_pintu_cc = $_POST['jumlah_pintu_cc'];

    // Buat array untuk data baru
    $newData = array($merk, $harga, $tipe, $jumlah_pintu_cc);

    // Tulis data baru ke dalam file CSV
    $file = fopen("data.csv", "a"); // "a" digunakan untuk menambahkan data baru tanpa menghapus data yang sudah ada
    fputcsv($file, $newData);
    fclose($file);
}

// Baca file CSV
$file = fopen("data.csv", "r");

// Loop untuk membaca setiap baris dalam file CSV
while (($data = fgetcsv($file)) !== FALSE) {
    // Cek tipe kendaraan
    if ($data[2] == "Mobil") {
        // Jika mobil, buat objek Mobil dan masukkan ke dalam array listMobil
        $mobil = new Mobil($data[0], $data[1], $data[3]);
        $listMobil[] = $mobil;
    } elseif ($data[2] == "Motor") {
        // Jika motor, buat objek Motor dan masukkan ke dalam array listMotor
        $motor = new Motor($data[0], $data[1], $data[3]);
        $listMotor[] = $motor;
    }
}

// Tutup file CSV
fclose($file);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mobil dan Motor</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Pendataan Mobil dan Motor</h2>

        <form id="myForm" method="POST" autocomplete="off" class="mb-4" onsubmit="return validateForm()">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="merk" class="form-label">Merk:</label>
                    <input type="text" id="merk" name="merk" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="harga" class="form-label">Harga:</label>
                    <input type="number" id="harga" name="harga" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="tipe" class="form-label">Tipe:</label>
                    <select id="tipe" name="tipe" onchange="showInput()" class="form-select" required>
                        <option value="" disabled selected>Pilih Tipe</option>
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                    </select>
                </div>
                <div class="col-md-3" id="inputContainer">
                    <label for="jumlah_pintu_cc" class="form-label">Jumlah Pintu:</label>
                    <input type="number" id="jumlah_pintu_cc" name="jumlah_pintu_cc" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-3">Data Mobil</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Merk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Jumlah Pintu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listMobil as $mobil) { ?>
                            <tr>
                                <td><?php echo $mobil->get_merk(); ?></td>
                                <td><?php echo $mobil->get_harga(); ?></td>
                                <td>Mobil</td>
                                <td><?php echo $mobil->get_jumlah_pintu(); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Data Motor</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Merk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Jumlah CC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listMotor as $motor) { ?>
                            <tr>
                                <td><?php echo $motor->get_merk(); ?></td>
                                <td><?php echo $motor->get_harga(); ?></td>
                                <td>Motor</td>
                                <td><?php echo $motor->get_cc(); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function showInput() {
            var tipe = document.getElementById("tipe").value;
            var inputContainer = document.getElementById("inputContainer");
            inputContainer.innerHTML = "";

            if (tipe === "Mobil") {
                var label = document.createElement("label");
                label.textContent = "Jumlah Pintu:";
                label.className = "form-label";
                var input = document.createElement("input");
                input.type = "number";
                input.name = "jumlah_pintu_cc";
                input.className = "form-control";
                inputContainer.appendChild(label);
                inputContainer.appendChild(input);
            } else if (tipe === "Motor") {
                var label = document.createElement("label");
                label.textContent = "Jumlah CC:";
                label.className = "form-label";
                var input = document.createElement("input");
                input.type = "number";
                input.name = "jumlah_pintu_cc";
                input.className = "form-control";
                inputContainer.appendChild(label);
                inputContainer.appendChild(input);
            }
        }

        function validateForm() {
            var merk = document.getElementById("merk").value;
            var harga = document.getElementById("harga").value;
            var tipe = document.getElementById("tipe").value;

            if (merk === "" || harga === "" || tipe === "") {
                alert("Harap lengkapi semua kolom");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>