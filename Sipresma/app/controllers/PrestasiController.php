<?php

require_once __DIR__ . '/../models/PrestasiModel.php';

class PrestasiController
{
    private $prestasiModel;

    public function __construct($conn)
    {
        $this->prestasiModel = new PrestasiModel($conn);
    }
    public function getMahasiswaList()
    {
        return $this->prestasiModel->getAllMahasiswa();
    }

    public function showPrestasi($id_mahasiswa)
    {
        // Ambil daftar prestasi berdasarkan id mahasiswa
        return $this->prestasiModel->getPrestasiByMahasiswa($id_mahasiswa);
    }

    public function getDosenList()
    {
        return $this->prestasiModel->getAllDosen();
    }

    public function showPrestasiDetail($id_prestasi)
    {
        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        include '../app/views/dosen/dosen_prestasi_detail.php';
    }

    public function showPrestasiDetailMahasiswa($id_prestasi)
    {
        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        include '../app/views/mahasiswa/prestasidetail.php';
    }

    public function addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids, $files)
    {
        try {
            // Validasi tambahan jika file kosong
            foreach ($files as $key => $file) {
                if ($file['size'] == 0 || $file['error'] !== UPLOAD_ERR_OK) {
                    $_SESSION['flash_message'] = [
                        'type' => 'danger',
                        'message' => "File $key tidak di-upload atau kosong!"
                    ];
                    header("Location: index.php?page=dosen_prestasi");
                    exit;
                }
            }
    
            // Panggil model untuk menyimpan data
            $isInserted = $this->prestasiModel->addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids, $files);
    
            if ($isInserted) {
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Prestasi berhasil ditambahkan!'
                ];
                header("Location: index.php?page=dosen_prestasi");
                exit;
            } else {
                $_SESSION['flash_message'] = [
                    'type' => 'danger',
                    'message' => 'Gagal menambahkan prestasi.'
                ];
                header("Location: index.php?page=dosen_prestasi");
                exit;
            }
        } catch (Exception $e) {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
            header("Location: index.php?page=dosen_prestasi");
            exit;
        }
    }

    public function deletePrestasi($id_prestasi)
    {
        $isDeleted = $this->prestasiModel->deletePrestasi($id_prestasi);

        if ($isDeleted) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Prestasi berhasil dihapus!'
            ];
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Gagal menghapus prestasi.'
            ];
        }

        header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
        exit;
    }

    public function showAllPrestasi()
    {
        return $this->prestasiModel->getAllPrestasi();
    }

    public function editPrestasi($id_prestasi, $data_prestasi, $mahasiswa_ids, $dosen_ids)
    {
        $isUpdated = $this->prestasiModel->editPrestasi($id_prestasi, $data_prestasi, $mahasiswa_ids, $dosen_ids);

        if ($isUpdated) {
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Prestasi berhasil diperbarui!'
            ];
            header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
            exit;
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Gagal memperbarui prestasi.'
            ];
            header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi");
            exit;
        }
    }

    public function setujuiPrestasi($id_prestasi)
    {
        if ($this->prestasiModel->updateStatusPrestasi($id_prestasi, 'disetujui')) {
            $this->prestasiModel->insertHistoryApproval($id_prestasi, 'disetujui');
            $_SESSION['flash_message'] = 'Prestasi telah disetujui.';
            header("Location: ?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
            exit();
        } else {
            echo "Gagal menyetujui prestasi.";
        }
    }

    public function tolakPrestasi($id_prestasi, $alasan)
    {
        if ($this->prestasiModel->updateStatusPrestasi($id_prestasi, 'ditolak')) {
            $this->prestasiModel->insertHistoryApproval($id_prestasi, 'ditolak', $alasan);
            $_SESSION['flash_message'] = 'Prestasi telah ditolak.';
            header("Location: ?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
            exit();
        } else {
            echo "Gagal menolak prestasi.";
        }
    }
}