<?php include 'partials/header.php'; ?>
<?php include 'partials/sidenav.php'; ?>


<div class="mt-3" style="margin-left: 317px; margin-right: 32px;">
    <div style="margin-bottom: 17.5px;">
        <h4 class="fw-semibold">Dashboard</h4>
        <h6 class="fw-medium text-muted">Home - Prestasi</h6>
    </div>

    <?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?= $_SESSION['flash_message']['type']; ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['flash_message']['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="card p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group" style="max-width: 300px;">
                <button class="btn btn-primary" type="button"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-search"></i>
                </button>
                <input class="form-control" placeholder="Search Prestasi" type="text" />
            </div>
            <div class="d-flex align-items-center gap-3">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <button class="btn btn-primary d-flex justify-content-center align-items-center gap-2"
                    style="color: white; background-color: #244282; outline: none; border: none;">
                    <i class="fas fa-plus"></i>
                    <a href="index.php?page=dosen_prestasi_add" style="text-decoration: none; color: white;">
                        <p class="mb-0">Tambah</p>
                    </a>
                </button>
                <?php endif; ?>
            </div>
        </div>

        <table class="table table-hover ">
            <thead>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th>Tahun Akademik</th>
                    <th>Judul Kompetisi</th>
                    <th>Status Pengajuan</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($prestasiList)) : ?>
                <?php foreach ($prestasiList as $prestasi) : ?>
                <tr>
                    <!-- Kolom Juara -->
                    <td class="align-middle text-left">
                        <?= htmlspecialchars($prestasi['tgl_pengajuan']); ?>
                    </td>

                    <!-- Kolom Jenis Kompetisi -->
                    <td class="align-middle text-left">
                        <?= htmlspecialchars($prestasi['thn_akademik']); ?>
                    </td>

                    <!-- Kolom Tingkat Kompetisi -->
                    <td class="align-middle text-left">
                        <?= htmlspecialchars($prestasi['judul_kompetisi']); ?>
                    </td>


                    <!-- Kolom Status Pengajuan -->
                    <td class="align-middle text-left">
                        <span style="
                        background-color: <?= 
                            $prestasi['status_pengajuan'] === 'disetujui' ? '#DCFCE7' : 
                            ($prestasi['status_pengajuan'] === 'ditolak' ? '#FEE2E2' : '#EAEDEF'); ?>; 
                        color: <?= 
                            $prestasi['status_pengajuan'] === 'disetujui' ? '#166534' : 
                            ($prestasi['status_pengajuan'] === 'ditolak' ? '#991B1B' : '#212529'); ?>; 
                        padding: 4px 8px; 
                        border-radius: 4px; 
                        font-size: 14px; 
                        font-weight: bold;
                        display: inline-block;
                    ">
                            <?= htmlspecialchars($prestasi['status_pengajuan']); ?>
                        </span>
                    </td>

                    <!-- Kolom Actions -->
                    <td class="align-middle text-left">
                        <div class="d-flex align-items-center justify-content-start gap-1">
                            <!-- Tombol Detail
                            <a href="index.php?page=dosen_prestasi_detail&id_prestasi="
                                class="btn btn-outline-primary btn-xs">
                                <i class="fas fa-file-alt"></i>
                            </a> -->

                            <!-- Tombol Edit -->
                            <a href="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>"
                                class="btn btn-outline-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                <!-- Pesan Jika Tidak Ada Data -->
                <tr>
                    <td colspan="7" class="text-center">
                        Tidak ada data prestasi tersedia.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <select class="form-select" style="width: 70px;">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a aria-label="Previous" class="page-link" href="#">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">10</a>
                    </li>
                    <li class="page-item">
                        <a aria-label="Next" class="page-link" href="#">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>