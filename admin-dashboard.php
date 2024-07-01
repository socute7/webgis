<?php
session_start();

if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit;
}

include_once 'koneksi.php';

$queryKepadatan = "SELECT * FROM kepadatan";
$resultKepadatan = $conn->query($queryKepadatan);

$queryLokasi = "SELECT * FROM lokasi";
$resultLokasi = $conn->query($queryLokasi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../batubara/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../batubara/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Dashboard Link -->
          <li class="nav-item">
            <a href="#" class="nav-link" id="dashboard-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Add Data Link -->
          <li class="nav-item">
            <a href="#" class="nav-link" id="add-data-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>Add Data</p>
            </a>
          </li>
          <!-- Add Lokasi Link -->
          <li class="nav-item">
            <a href="#" class="nav-link" id="add-lokasi-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>Add Lokasi</p>
            </a>
          </li>
          <!-- Href Link -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-link"></i>
              <p>Go to Your Page</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Dashboard Content -->
        <div class="dashboard-content">
          <h1>Welcome to Admin Dashboard</h1>
        </div>

        <!-- Add Data Content (hidden by default) -->
        <div class="add-data-content" style="display: none;">
          <h2>Add Data</h2>
          <table class="table">
            <thead>
              <tr>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kode Dagri</th>
                <th>Kecamatan</th>
                <th>Jumlah</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Loop through the result set and display data
              while($row = mysqli_fetch_assoc($resultKepadatan)) {
                echo "<tr>";
                echo "<td>".$row['provinsi']."</td>";
                echo "<td>".$row['kabupaten']."</td>";
                echo "<td>".$row['kodedagri']."</td>";
                echo "<td>".$row['kecamatan']."</td>";
                echo "<td>".$row['jumlah']."</td>";
                echo "<td><button class='btn btn-primary' onclick='editData(\"".$row['kodedagri']."\",\"".$row['provinsi']."\",\"".$row['kabupaten']."\",\"".$row['kecamatan']."\",\"".$row['jumlah']."\")'>Edit</button></td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

       <!-- Add Lokasi Content (hidden by default) -->
<div class="lokasi-content" style="display: none;">
  <h2>Lokasi</h2>
  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahLokasiModal">
    Tambah Lokasi
  </button>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Latitude</th>
        <th>Longitude</th>
        <th>Kategori</th>
        <th>Foto</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Loop through the result set and display data
      while($row = mysqli_fetch_assoc($resultLokasi)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['nama']."</td>";
        echo "<td>".$row['alamat']."</td>";
        echo "<td>".$row['lat']."</td>";
        echo "<td>".$row['lng']."</td>";
        echo "<td>".$row['kategori']."</td>";
        echo "<td><img src='".$row['foto']."' alt='Foto' width='100'></td>";
        echo "<td><button class='btn btn-primary' onclick='editLokasi(\"".$row['id']."\",\"".$row['nama']."\",\"".$row['alamat']."\",\"".$row['lat']."\",\"".$row['lng']."\",\"".$row['kategori']."\",\"".$row['foto']."\")'>Edit</button></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            <div class="form-group">
              <label for="provinsiEdit">Provinsi:</label>
              <input type="text" class="form-control" id="provinsiEdit" name="provinsi" readonly>
            </div>
            <div class="form-group">
              <label for="kabupatenEdit">Kabupaten:</label>
              <input type="text" class="form-control" id="kabupatenEdit" name="kabupaten" readonly>
            </div>
            <div class="form-group">
              <label for="kodedagriEdit">Kode Dagri:</label>
              <input type="text" class="form-control" id="kodedagriEdit" name="kodedagri" readonly>
            </div>
            <div class="form-group">
              <label for="kecamatanEdit">Kecamatan:</label>
              <input type="text" class="form-control" id="kecamatanEdit" name="kecamatan" readonly>
            </div>
            <div class="form-group">
              <label for="jumlahEdit">Jumlah:</label>
              <input type="text" class="form-control" id="jumlahEdit" name="jumlah">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="updateData()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Lokasi -->
<div class="modal fade" id="editLokasiModal" tabindex="-1" role="dialog" aria-labelledby="editLokasiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLokasiModalLabel">Edit Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editLokasiForm">
                    <div class="form-group">
                        <label for="idEdit">ID:</label>
                        <input type="text" class="form-control" id="idEdit" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="namaEdit">Nama:</label>
                        <input type="text" class="form-control" id="namaEdit" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="alamatEdit">Alamat:</label>
                        <input type="text" class="form-control" id="alamatEdit" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="latEdit">Latitude:</label>
                        <input type="text" class="form-control" id="latEdit" name="lat">
                    </div>
                    <div class="form-group">
                        <label for="lngEdit">Longitude:</label>
                        <input type="text" class="form-control" id="lngEdit" name="lng">
                    </div>
                    <div class="form-group">
                        <label for="kategoriEdit">Kategori:</label>
                        <input type="text" class="form-control" id="kategoriEdit" name="kategori">
                    </div>
                    <div class="form-group">
                        <label for="fotoEdit">Foto:</label>
                        <input type="text" class="form-control" id="fotoEdit" name="foto">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateLokasi()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Lokasi -->
<div class="modal fade" id="tambahLokasiModal" tabindex="-1" role="dialog" aria-labelledby="tambahLokasiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahLokasiModalLabel">Tambah Lokasi Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tambahLokasiForm">
          <div class="form-group">
            <label for="namaLokasi">Nama Lokasi:</label>
            <input type="text" class="form-control" id="namaLokasi" name="namaLokasi">
          </div>
          <div class="form-group">
            <label for="alamatLokasi">Alamat:</label>
            <input type="text" class="form-control" id="alamatLokasi" name="alamatLokasi">
          </div>
          <div class="form-group">
            <label for="latLokasi">Latitude:</label>
            <input type="text" class="form-control" id="latLokasi" name="latLokasi">
          </div>
          <div class="form-group">
            <label for="lngLokasi">Longitude:</label>
            <input type="text" class="form-control" id="lngLokasi" name="lngLokasi">
          </div>
          <div class="mb-3">
            <label for="kategoriLokasi" class="form-label">Kategori Lokasi</label>
            <select class="form-control" id="kategoriLokasi" required>
            </select>
          </div>
          <div class="form-group">
            <label for="fotoLokasi">Link Foto:</label>
            <input type="text" class="form-control" id="fotoLokasi" name="fotoLokasi">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="tambahLokasi()">Tambah Lokasi</button>
      </div>
    </div>
  </div>
</div>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../batubara/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../batubara/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../batubara/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

<script>
function showDashboardContent() {
    document.querySelector('.dashboard-content').style.display = 'block';
    document.querySelector('.add-data-content').style.display = 'none';
    document.querySelector('.lokasi-content').style.display = 'none';
}

function showAddDataContent() {
    document.querySelector('.add-data-content').style.display = 'block';
    document.querySelector('.dashboard-content').style.display = 'none';
    document.querySelector('.lokasi-content').style.display = 'none';
}

function showAddLokasiContent() {
    document.querySelector('.lokasi-content').style.display = 'block';
    document.querySelector('.dashboard-content').style.display = 'none';
    document.querySelector('.add-data-content').style.display = 'none';
}

document.getElementById('dashboard-link').addEventListener('click', function(event) {
    event.preventDefault();
    showDashboardContent();
});

document.getElementById('add-data-link').addEventListener('click', function(event) {
    event.preventDefault();
    showAddDataContent();
});

document.getElementById('add-lokasi-link').addEventListener('click', function(event) {
    event.preventDefault();
    showAddLokasiContent();
});



function editData(kodedagri, provinsi, kabupaten, kecamatan, jumlah) {
    document.getElementById('kodedagriEdit').value = kodedagri;
    document.getElementById('provinsiEdit').value = provinsi;
    document.getElementById('kabupatenEdit').value = kabupaten;
    document.getElementById('kecamatanEdit').value = kecamatan;
    document.getElementById('jumlahEdit').value = jumlah;
    $('#editModal').modal('show');
}

function updateData() {
    var kodedagri = document.getElementById('kodedagriEdit').value;
    var provinsi = document.getElementById('provinsiEdit').value;
    var kabupaten = document.getElementById('kabupatenEdit').value;
    var kecamatan = document.getElementById('kecamatanEdit').value;
    var jumlah = document.getElementById('jumlahEdit').value;

    $.ajax({
      type: "POST",
      url: "update.php",
      data: { kodedagri: kodedagri, provinsi: provinsi, kabupaten: kabupaten, kecamatan: kecamatan, jumlah: jumlah },
      success: function(response) {
        $('#editModal').modal('hide');
        location.reload();
      },
      error: function() {
        alert('Terjadi kesalahan. Silakan coba lagi.');
      }
    });
}

function editLokasi(id, nama, alamat, lat, lng, kategori, foto) {
    document.getElementById('idEdit').value = id;
    document.getElementById('namaEdit').value = nama;
    document.getElementById('alamatEdit').value = alamat;
    document.getElementById('latEdit').value = lat;
    document.getElementById('lngEdit').value = lng;
    document.getElementById('kategoriEdit').value = kategori;
    document.getElementById('fotoEdit').value = foto;
    $('#editLokasiModal').modal('show');
}

function updateLokasi() {
    const id = document.getElementById('idEdit').value;
    const nama = document.getElementById('namaEdit').value;
    const alamat = document.getElementById('alamatEdit').value;
    const lat = document.getElementById('latEdit').value;
    const lng = document.getElementById('lngEdit').value;
    const kategori = document.getElementById('kategoriEdit').value;
    const foto = document.getElementById('fotoEdit').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_lokasi.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                alert('Data berhasil diperbarui!');
                location.reload();
            } else {
                alert('Gagal memperbarui data: ' + response.message);
            }
        } else {
            alert('Gagal memperbarui data: ' + xhr.status);
        }
    };

    xhr.send(`id=${id}&nama=${nama}&alamat=${alamat}&lat=${lat}&lng=${lng}&kategori=${kategori}&foto=${foto}`);
}

function toggleLokasiContent() {
  var lokasiContent = document.querySelector('.lokasi-content');
  var button = document.getElementById('tambah-lokasi-link');

  if (lokasiContent.style.display === 'none') {
    lokasiContent.style.display = 'block';
    button.textContent = 'Sembunyikan Lokasi';
  } else {
    lokasiContent.style.display = 'none';
    button.textContent = 'Tambah Lokasi';
  }
}

function populateKategori() {
  $.ajax({
    type: "GET",
    url: "kategori.php",
    dataType: "json",
    success: function(response) {
      var select = document.getElementById('kategoriLokasi');
      
      select.innerHTML = '';

      response.forEach(function(kategori) {
        var option = document.createElement('option');
        option.value = kategori['nama_kategori'];
        option.textContent = kategori['nama_kategori'];
        select.appendChild(option);
      });
    },
    error: function() {
      alert('Gagal mengambil data kategori. Silakan coba lagi.');
    }
  });
}

$(document).ready(function() {
  populateKategori();
});

function tambahLokasi() {
  var namaLokasi = document.getElementById('namaLokasi').value;
  var alamatLokasi = document.getElementById('alamatLokasi').value;
  var latLokasi = document.getElementById('latLokasi').value;
  var lngLokasi = document.getElementById('lngLokasi').value;
  var kategoriLokasi = document.getElementById('kategoriLokasi').value;
  var fotoLokasi = document.getElementById('fotoLokasi').value;

  $.ajax({
    type: "POST",
    url: "tambah_lokasi.php",
    data: {
      nama: namaLokasi,
      alamat: alamatLokasi,
      lat: latLokasi,
      lng: lngLokasi,
      kategori: kategoriLokasi,
      foto: fotoLokasi
    },
    success: function(response) {
      $('#tambahLokasiModal').modal('hide');
      alert('Lokasi berhasil ditambahkan!');
      location.reload();
    },
    error: function() {
      alert('Terjadi kesalahan saat menambahkan lokasi. Silakan coba lagi.');
    }
  });
}
</script>
</body>
</html>
