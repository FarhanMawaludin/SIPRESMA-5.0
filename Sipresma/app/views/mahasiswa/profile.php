<?php
include 'partials/header.php';

// Periksa apakah sesi pengguna tersedia
if (!isset($_SESSION['user'])) {
    echo "<div class='alert alert-danger text-center' role='alert'>
            Data pengguna tidak ditemukan. Silakan login kembali.
          </div>";
    exit;
}
?>

<body>
    <div class="mb-0">
        <p class="info-text fw-light">Profile</p>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Form Section -->
            <div class="col-lg-8">
                <form>
                    <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['nama_mahasiswa'] ?? '<span class="text-danger">Nama tidak tersedia</span>'; ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="nim" class="form-label">NIM</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['NIM'] ?? '<span class="text-danger">NIM tidak tersedia</span>'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['tempat_lahir'] ?? '<span class="text-danger">Tempat lahir tidak tersedia</span>'; ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                            <p class="form-control-plaintext">
                                <?= isset($_SESSION['user']['tanggal_lahir']) ? date("d F Y", strtotime($_SESSION['user']['tanggal_lahir'])) : '<span class="text-danger">Tanggal lahir tidak tersedia</span>'; ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <p class="form-control-plaintext">
                                <?= $_SESSION['user']['email_mahasiswa'] ?? '<span class="text-danger">Email tidak tersedia</span>'; ?>
                            </p>
                        </div>
                    </div>
                    <a href="index.php?page=edit" class="btn btn-simpan">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </form>
            </div>

            <!-- Profil Section -->
            <div class="col-lg-4 text-center profile-section">
                <img src="PBL-SIPRESMA/assets/img/animoji.png" alt="Foto Profil">
                <h3 id="profile-name"><?= $_SESSION['user']['nama_mahasiswa'] ?? 'Nama'; ?></h3>
                <p class="text-primary" id="profile-nim">NIM. <?= $_SESSION['user']['NIM'] ?? 'NIM'; ?></p>
                <p>MAHASISWA</p>
                <p style="color: #244282;">TEKNOLOGI INFORMASI <br> D-IV TEKNIK INFORMATIKA</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>



