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
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Data Kompetisi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Data Kompetisi</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Program Studi</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['program_studi']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tahun Akademik</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['thn_akademik']); ?></p>
                        </div>
                    </div>
                    <hr class="separator my-3" />
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">URL Kompetisi</p>
                            <p><a href="#"><?php echo htmlspecialchars($prestasi['url_kompetisi']); ?></a></p>
                            <p class="mb-0 fw-bold">Jenis Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jenis_kompetisi']); ?></p>
                            <p class="mb-0 fw-bold">Judul Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></p>
                            <p class="mb-0 fw-bold">Jumlah PT</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jumlah_pt']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Juara</p>
                            <p><?php echo htmlspecialchars($prestasi['juara']); ?></p>
                            <p class="mb-0 fw-bold">Tingkat Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['tingkat_kompetisi']); ?>
                            </p>
                            <p class="mb-0 fw-bold">Tempat Kompetisi</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['tempat_kompetisi']); ?>
                            </p>
                            <p class="mb-0 fw-bold">Jumlah Peserta</p>
                            <p style="color: #495057;"><?php echo htmlspecialchars($prestasi['jumlah_peserta']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Tugas -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Surat Tugas</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Nomor Surat Tugas</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['no_surat_tugas']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold">Tanggal Surat Tugas</p>
                            <p class="mb-0" style="color: #495057;">
                                <?php echo htmlspecialchars($prestasi['tgl_surat_tugas'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="fw-bold" style="margin-bottom: 4px;">File Surat Tugas</p>
                            <?php if ($prestasi['file_surat_tugas'] !== null) : ?>
                            <?php
                                
                                $filePath = '../../../public/uploads/' . $prestasi['id_prestasi'] . '.pdf';
                                file_put_contents($filePath, $prestasi['file_surat_tugas']);
                                echo "<td><a href='" . $filePath . "' target='_blank'><button>View Surat Tugas</button></a> ";
                                echo "<a href='" . $filePath . "' download><button>Download Surat Tugas</button></a></td>";
                            ?>
                            <!-- If the file is an image, show the image preview -->

                            <?php else : ?>
                            <p>No file available</p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Lampiran -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Lampiran</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold" style="margin-bottom: 4px;">File Sertifikat</p>
                            <?php if ($prestasi['file_sertifikat'] !== null) : ?>
                            <a href="../../public/uploads/<?php echo htmlspecialchars($prestasi['id_prestasi']) . '.pdf'; ?>"
                                target="_blank">
                                <button class="btn btn-primary">View Sertifikat</button>
                            </a>
                            <a href="uploads/<?php echo htmlspecialchars($prestasi['id_prestasi']) . '.pdf'; ?>"
                                download>
                                <button class="btn btn-success">Download Sertifikat</button>
                            </a>
                            <?php else : ?>
                            <p>No file available</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <p class="fw-bold" style="margin-bottom: 4px;">Foto Kegiatan</p>
                            <?php if (!empty($prestasi['foto_kegiatan'])) : ?>
                            <?php
                            $fotoFilePath = '../public/uploads' . $prestasi['foto_kegiatan']; // Gunakan path relatif dari database
                            ?>
                            <a href="<?= $fotoFilePath ?>" target="_blank">
                                <button>View Foto Kegiatan</button>
                            </a>
                            <a href="<?= $fotoFilePath ?>" download>
                                <button>Download Foto Kegiatan</button>
                            </a>
                            <div style="margin-top: 10px;">
                                <img src="<?= $fotoFilePath ?>" alt="Foto Kegiatan"
                                    style="max-width: 100%; height: auto;">
                            </div>
                            <?php else : ?>
                            <p>No file available</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-0 fw-bold" style="margin-bottom: 4px;">File Poster</p>
                            <?php if ($prestasi['lampiran_hasil_kompetisi'] !== null) : ?>
                            <a href="../../public/uploads/<?php echo htmlspecialchars($prestasi['id_prestasi']) . '.pdf'; ?>"
                                target="_blank">
                                <button class="btn btn-primary">View Poster</button>
                            </a>
                            <a href="../../public/uploads/<?php echo htmlspecialchars($prestasi['id_prestasi']) . '.pdf'; ?>"
                                download>
                                <button class="btn btn-success">Download Poster</button>
                            </a>
                            <?php else : ?>
                            <p>No file available</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Mahasiswa yang Berpartisipasi -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style="font-size: 16px;">Mahasiswa yang Berpartisipasi</div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="../../img/animoji.png" alt="Profile" class="rounded-circle">
                        <div class="ms-2">
                            <p class="mb-0 fw-bold">Rika Nokotan</p>
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
                        <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle">
                        <div class="ms-2">
                            <p class="mb-0 fw-bold">Rika Nokotan</p>
                            <p class="mb-0" style="color: #495057;">Dosen</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hasil Karya -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white fw-bold" style=" font-size: 16px;">Hasil Karya</div>
                <div class="card-body">
                    <p style="margin-bottom: 4px;"><strong>File</strong></p>
                    <div class="input-group ">
                        <span class="input-group-text"><i class="fas fa-file-pdf text-danger"></i></span>
                        <input class="form-control" type="text" value="file.pdf" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>