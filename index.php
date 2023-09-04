<!DOCTYPE html>
<html lang="en">
<?php
include "./konek.php";
$query = "SELECT * FROM data_mahasiswa";
$data = mysqli_query($konek, $query);

function cekOpsi($opsi)
{
  if ($opsi) {
    return true;
  } else {
    return false;
  }
}
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <!-- CSS -->
  <style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");

    body {
      font-family: "Poppins", sans-serif;
    }
  </style>

  <title>CRUD Citra</title>
</head>

<body>
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center mt-5">
      <div class="col-md-12">
        <button class="btn btn-primary px-3 py-3 mb-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
          + Tambah Data Mahasiswa
        </button>
        <table class="table table-hover table-responsive">
          <thead class="btn-primary">
            <tr class="text-center">
              <th>NIM</th>
              <th>Nama Lengkap</th>
              <th>Kelas</th>
              <th>Mata Kuliah</th>
              <th>Nilai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="align-middle">
            <?php
            foreach ($data as $row) {
            ?>
              <tr class="text-center">
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama_lengkap'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td><?= $row['mata_kuliah'] ?></td>
                <td><?= $row['nilai'] ?></td>
                <td>
                  <div class="aksi text-center">
                    <div class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="btn btn-danger" onclick="hapus(<?= $row['id'] ?>)">
                      <i class="bi bi-trash3"></i>
                    </div>
                  </div>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- modal tambah data -->
  <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">
            Tambah Data Mahasiswa
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="tambah.php" method="POST">
          <div class="modal-body">
            <div class="row d-flex justify-content-center">
              <div class="col-md-12">
                <div class="mb-4">
                  <label for="nim" class="form-label fw-bold">NIM</label>
                  <input type="number" class="form-control" id="nim" name="nim" placeholder="Masukan NIM" required />
                </div>

                <div class="mb-4">
                  <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                  <input type="text" class="form-control" id="nama" name="nama_lengkap" placeholder="Masukan Nama" required />
                </div>

                <div class="mb-4">
                  <label for="kelas" class="form-label fw-bold">Kelas</label>
                  <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Masukan Kelas" required />
                </div>

                <div class="mb-4">
                  <label for="matkul" class="form-label fw-bold">Pilih Mata Kuliah</label>
                  <select class="form-select" aria-label="Default select example" name="mata_kuliah" id="matkul" required>
                    <option selected disabled>Pilih Mata Kuliah</option>
                    <option value="Pemrograman Web">Pemrograman Web</option>
                    <option value="Jaringan Komputer">Jaringan Komputer</option>
                    <option value="Komputer Animasi">Komputer Animasi</option>
                  </select>
                </div>

                <div class="mb-4">
                  <label for="nilai" class="form-label fw-bold">Nilai</label>
                  <input type="number" min="1" max="100" class="form-control" name="nilai" id="nilai" placeholder="Masukan Nilai" required />
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary rounded-pill">
              Tambah Data
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal tambah data -->


  <?php
  foreach ($data as $row) {
  ?>
    <!-- modal edit data -->
    <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">
              Edit Data Mahasiswa
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="edit.php" method="POST">
            <div class="modal-body">
              <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                  <input type="number" name="id" value="<?= $row['id'] ?>" hidden>
                  <div class="mb-4">
                    <label for="nim" class="form-label fw-bold">NIM</label>
                    <input type="number" class="form-control" id="nim" name="nim" value="<?= $row['nim'] ?>" placeholder="Masukan NIM" required />
                  </div>

                  <div class="mb-4">
                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama_lengkap" value="<?= $row['nama_lengkap'] ?>" placeholder="Masukan Nama" required />
                  </div>

                  <div class="mb-4">
                    <label for="kelas" class="form-label fw-bold">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $row['kelas'] ?>" placeholder="Masukan Kelas" required />
                  </div>

                  <div class="mb-4">
                    <label for="matkul" class="form-label fw-bold">Pilih Mata Kuliah</label>
                    <select class="form-select" aria-label="Default select example" name="mata_kuliah" id="matkul" required>
                      <option disabled>Pilih Mata Kuliah</option>
                      <option <?php cekOpsi($row['mata_kuliah'] == "Pemrograman Web" ? "selected" : "") ?> value="Pemrograman Web">Pemrograman Web</option>
                      <option <?php cekOpsi($row['mata_kuliah'] == "Jaringan Komputer" ? "selected" : "") ?> value="Jaringan Komputer">Jaringan Komputer</option>
                      <option <?php cekOpsi($row['mata_kuliah'] == "Komputer Animasi" ? "selected" : "") ?> value="Komputer Animasi">Komputer Animasi</option>
                    </select>
                  </div>

                  <div class="mb-4">
                    <label for="nilai" class="form-label fw-bold">Nilai</label>
                    <input type="number" class="form-control" id="nilai" name="nilai" value="<?= $row['nilai'] ?>" placeholder="Masukan Nilai" required />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary rounded-pill">
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- modal edit data -->
  <?php
  }
  ?>
  <script>
    function hapus(id) {
      let konfirmasi = confirm("Yakin ingin menghapus data ?");
      if (konfirmasi) {
        window.location.href = "hapus.php?id=" + id
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>