<?php
include 'partials/header.php';
date_default_timezone_set('Asia/Jakarta');

$prestasiController = new PrestasiController($conn);
$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];

$prestasiList = $prestasiController->showAllPrestasi($id_mahasiswa);

?>
<div class="mb-5">
    <p class="info-text fw-light">Home - Prestasi - Tambah Prestasi</p>
</div>

<div class="form-section card container container-form mb-5" style="padding:24px 30px 24px 30px;">
    <h5 style="color: #475261;; font-size: 20px; margin-bottom: 20px;" class="fw-semibold">
        Form
    </h5>
    <h5 class="fw-semibold mb-3">Data Prestasi</h5>
    <form action="index.php?action=submit_prestasi" method="POST" enctype="multipart/form-data">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium" for="thnAkademik">Tahun Akademik<span class="text-danger">*</span></label>
            <select class="form-select" id="thnAkademik" name="thn_akademik" required>
                <option value="">Pilih Tahun Akademik</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium" for="jenisKompetisi">Jenis Kompetisi<span class="text-danger">*</span></label>
            <input class="form-control" id="jenisKompetisi" type="text" name="jenis_kompetisi" placeholder="Jenis Kompetisi" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium" for="juara">Juara</label>
            <input class="form-control" id="juara" type="text" name="juara" placeholder="Juara">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium" for="programStudi">Program Studi<span class="text-danger">*</span></label>
            <select class="form-select" id="programStudi" name="program_studi" required>
                <option value="">Pilih Program Studi</option>
                <option value="Informatika">Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium" for="urlKompetisi">URL Kompetisi</label>
            <input class="form-control" id="urlKompetisi" type="url" name="url_kompetisi" placeholder="URL Kompetisi">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium" for="tingkatKompetisi">Tingkat Kompetisi<span class="text-danger">*</span></label>
            <input class="form-control" id="tingkatKompetisi" type="text" name="tingkat_kompetisi" placeholder="Tingkat Kompetisi" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium" for="judulKompetisi">Judul Kompetisi<span class="text-danger">*</span></label>
            <input class="form-control" id="judulKompetisi" type="text" name="judul_kompetisi" placeholder="Judul Kompetisi" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium" for="tempatKompetisi">Tempat Kompetisi<span class="text-danger">*</span></label>
            <input class="form-control" id="tempatKompetisi" type="text" name="tempat_kompetisi" placeholder="Tempat Kompetisi" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium" for="jumlahPT">Jumlah PT (Berpartisipasi)<span class="text-danger">*</span></label>
            <input class="form-control" id="jumlahPT" type="number" name="jumlah_pt" placeholder="Jumlah PT" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium" for="jumlahPeserta">Jumlah Peserta<span class="text-danger">*</span></label>
            <input class="form-control" id="jumlahPeserta" type="number" name="jumlah_peserta" placeholder="Jumlah Peserta" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-medium" for="noSuratTugas">No. Surat Tugas<span class="text-danger">*</span></label>
            <input class="form-control" id="noSuratTugas" type="text" name="no_surat_tugas" placeholder="Nomor Surat Tugas" required>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-medium" for="tanggalSuratTugas">Tanggal Surat Tugas<span class="text-danger">*</span></label>
            <input class="form-control" id="tanggalSuratTugas" type="date" name="tgl_surat_tugas" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium" for="fileSuratTugas">Upload Surat Tugas</label>
        <input class="form-control" id="fileSuratTugas" type="file" name="file_surat_tugas" accept=".pdf,.jpg,.png">
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium" for="fotoKegiatan">Foto Kegiatan</label>
        <input class="form-control" id="fotoKegiatan" type="file" name="foto_kegiatan" accept="image/*">
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium" for="fileSertifikat">File Sertifikat</label>
        <input class="form-control" id="fileSertifikat" type="file" name="file_sertifikat" accept=".pdf,.jpg,.png">
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium" for="fileLampiranHasilKompetisi">File Karya</label>
        <input class="form-control" id="fileLampiranHasilKompetisi" type="file" name="lampiran_hasil_kompetisi" accept=".pdf,.jpg,.png">
    </div>

    <div class="mb-3">
        <label class="form-label fw-medium" for="filePoster">File Poster</label>
        <input class="form-control" id="filePoster" type="file" name="file_poster" accept=".pdf,.jpg,.png">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?php include 'partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
