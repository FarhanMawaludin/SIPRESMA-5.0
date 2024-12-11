<?php include 'partials/header.php' ?>

<div class="mb-5">
    <p class="info-text fw-light">Home - Prestasi - Detail Prestasi</p>
</div>

<div class="container-detail-prestasi">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 31px;">
        <h5 style="color: #475261;" class="align-items-center mb-0">Detail Prestasi</h5>
        <a class="btn btn-warning d-flex align-items-center" href="#" style="color: white;">
            <i class="bi bi-pencil me-2"></i>Edit
        </a>
    </div>

    <!-- Content Section -->
    <div class="row justify-content-between">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Data Kompetisi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Data Kompetisi</div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Program Studi</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['program_studi']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tahun Akademik</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['thn_akademik']); ?>
                            </p>
                        </div>
                    </div>

                    <hr class="separator my-3" />

                    <!-- Baris 2 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">URL Kompetisi</p>
                            <p><a href="#"><?php echo htmlspecialchars($prestasi['url_kompetisi']); ?></a></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Jenis Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jenis_kompetisi']); ?></p>
                        </div>
                    </div>

                    <!-- Baris 3 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Judul Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Jumlah PT</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jumlah_pt']); ?></p>
                        </div>
                    </div>

                    <!-- Baris 4 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Juara</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['juara']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tingkat Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['tingkat_kompetisi']); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Baris 5 -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tempat Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['tempat_kompetisi']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Jumlah Peserta</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jumlah_peserta']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Tugas -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Surat Tugas</div>
                <div class="card-body">
                    <!-- Informasi Surat Tugas -->
                    <div class="row ">
                        <div class="col-md-6">
                            <p class="mb-1 fw-bold">Nomor Surat Tugas</p>
                            <p class="mb-0 text-secondary">
                                <?= htmlspecialchars($prestasi['no_surat_tugas']); ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 fw-bold">Tanggal Surat Tugas</p>
                            <p class="mb-0 text-secondary">
                                <?= htmlspecialchars(
                                    $prestasi['tgl_surat_tugas'] instanceof DateTime 
                                        ? $prestasi['tgl_surat_tugas']->format('Y-m-d') 
                                        : $prestasi['tgl_surat_tugas'] ?? '', 
                                    ENT_QUOTES, 
                                    'UTF-8'
                                ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- File Surat Tugas -->
                    <div class="row">
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Surat Tugas</p>
                            <?php 
                            if ($prestasi['file_surat_tugas'] !== null) {
                                $fotoFilePath = 'uploads/ST_' . $prestasi['id_prestasi'] . '.jpg';
                                file_put_contents($fotoFilePath, $prestasi['file_surat_tugas']);
                                echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewModal'>View Foto</button> ";
                                echo "<a href='" . $fotoFilePath . "' download><button class='btn btn-success'>Download Foto</button></a>";

                                // Modal for preview
                                echo "
                                <div class='modal fade' id='viewModal' tabindex='-1' aria-labelledby='viewModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewModalLabel'>Preview Foto Surat Tugas</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='$fotoFilePath' alt='Foto Surat Tugas' class='img-fluid'>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            } else {
                                echo "<td>No photo available</td>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Lampiran -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Lampiran</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- File Sertifikat -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Sertifikat</p>
                            <?php 
                            if ($prestasi['file_sertifikat'] !== null) {
                                $fotoFilePath = 'uploads/sertif_' . $prestasi['id_prestasi'] . '.jpg';
                                file_put_contents($fotoFilePath, $prestasi['file_sertifikat']);
                                echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewModalSertifikat'>View Foto</button> ";
                                echo "<a href='" . $fotoFilePath . "' download><button class='btn btn-success'>Download Foto</button></a>";

                                // Modal for preview of Sertifikat
                                echo "
                                <div class='modal fade' id='viewModalSertifikat' tabindex='-1' aria-labelledby='viewModalLabelSertifikat' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewModalLabelSertifikat'>Preview Foto Sertifikat</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='$fotoFilePath' alt='Foto Sertifikat' class='img-fluid'>
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='$fotoFilePath' download><button class='btn btn-success'>Download Foto</button></a>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            } else {
                                echo "<td>No photo available</td>";
                            }
                            ?>
                                    </div>

                        <!-- Foto Kegiatan -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">Foto Kegiatan</p>
                            <?php 
                            if ($prestasi['foto_kegiatan'] !== null) {
                                $fotoFilePath = 'uploads/foto_' . $prestasi['id_prestasi'] . '.jpg';
                                file_put_contents($fotoFilePath, $prestasi['foto_kegiatan']);
                                echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewModalFotoKegiatan'>View Foto</button> ";
                                echo "<a href='" . $fotoFilePath . "' download><button class='btn btn-success'>Download Foto</button></a>";

                                // Modal for preview of Foto Kegiatan
                                echo "
                                <div class='modal fade' id='viewModalFotoKegiatan' tabindex='-1' aria-labelledby='viewModalLabelFotoKegiatan' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewModalLabelFotoKegiatan'>Preview Foto Kegiatan</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='$fotoFilePath' alt='Foto Kegiatan' class='img-fluid'>
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='$fotoFilePath' download><button class='btn btn-success'>Download Foto</button></a>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            } else {
                                echo "<td>No photo available</td>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- File Poster -->
                        <div class="col-md-6">
                            <p class="fw-bold mb-2">File Poster</p>
                            <?php 
                            if ($prestasi['file_poster'] !== null) {
                                $fotoFilePath = 'uploads/poster_' . $prestasi['id_prestasi'] . '.jpg';
                                file_put_contents($fotoFilePath, $prestasi['file_poster']);
                                echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewModalPoster'>View Foto</button> ";
                                echo "<a href='" . $fotoFilePath . "' download><button class='btn btn-success'>Download Foto</button></a>";

                                // Modal for preview of Poster
                                echo "
                                <div class='modal fade' id='viewModalPoster' tabindex='-1' aria-labelledby='viewModalLabelPoster' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewModalLabelPoster'>Preview Foto Poster</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='$fotoFilePath' alt='Foto Poster' class='img-fluid'>
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='$fotoFilePath' download><button class='btn btn-success'>Download Foto</button></a>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            } else {
                                echo "<td>No photo available</td>";
                            }
                            ?>
                                    </div>

                                    <!-- Hasil Karya -->
                                    <div class="col-md-6">
                                        <p class="fw-bold mb-2">Hasil Karya</p>
                                        <?php 
                            if ($prestasi['lampiran_hasil_kompetisi'] !== null) {
                                $fotoFilePath = 'uploads/karya_' . $prestasi['id_prestasi'] . '.jpg';
                                file_put_contents($fotoFilePath, $prestasi['lampiran_hasil_kompetisi']);
                                echo "<button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewModalHasilKarya'>View Foto</button> ";
                                echo "<a href='" . $fotoFilePath . "' download><button class='btn btn-success'>Download Foto</button></a>";

                                // Modal for preview of Hasil Karya
                                echo "
                                <div class='modal fade' id='viewModalHasilKarya' tabindex='-1' aria-labelledby='viewModalLabelHasilKarya' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='viewModalLabelHasilKarya'>Preview Hasil Karya</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <img src='$fotoFilePath' alt='Hasil Karya' class='img-fluid'>
                                            </div>
                                            <div class='modal-footer'>
                                                <a href='$fotoFilePath' download><button class='btn btn-success'>Download Foto</button></a>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            } else {
                                echo "<td>No photo available</td>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4">
                <!-- Mahasiswa yang Berpartisipasi -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white fw-bold" style="font-size: 16px;">Mahasiswa yang Berpartisipasi
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="../../img/animoji.png" alt="Profile" class="rounded-circle"
                                style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <p class="mb-0 fw-bold">
                                    <?php echo htmlspecialchars($prestasi['nama_mahasiswa'] ?? 'null'); ?></p>
                                <p class="mb-0" style="color: #495057;">D-IV Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dosen Pembimbing -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-white fw-bold" style="font-size: 16px;">Dosen Pembimbing</div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle"
                                style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <p class="mb-0 fw-bold">
                                    <?php echo htmlspecialchars($prestasi['nama_dosen'] ?? 'null'); ?>
                                </p>
                                <p class="mb-0" style="color: #495057;">Dosen</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'partials/footer.php'; ?>