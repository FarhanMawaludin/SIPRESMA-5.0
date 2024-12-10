<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $userModel;

    public function __construct($conn)
    {
        $this->userModel = new UserModel($conn);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil input dan bersihkan dari spasi
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            // Validasi input
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "Username atau password tidak boleh kosong!";
                header("Location: ./views/login.php");
                exit();
            }

            // Validasi login
            $user = $this->userModel->validateLogin($username, $password);

            if ($user) {
                // Jika login berhasil, simpan data pengguna ke dalam session
                $_SESSION['user'] = $user;
                $_SESSION['loggedin_time'] = time();
                $_SESSION['role'] = $user['role']; // Role: mahasiswa, dosen, atau kajur

                // Arahkan pengguna berdasarkan role
                switch ($user['role']) {
                    case 'dosen':
                    case 'ketua jurusan':
                    case 'admin':
                        header("Location: index.php?page=dosen_dashboard");
                        break;
                    case 'mahasiswa':
                        header("Location: index.php?page=home");
                        break;
                    default:
                        $_SESSION['error'] = "Peran tidak dikenal!";
                        header("Location: index.php?page=login");
                        break;
                }
                exit();
            } else {
                // Jika login gagal
                $_SESSION['error'] = "Username atau password salah!";
                header("Location: index.php?page=login");
                exit();
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?page=homepertama");
        exit();
    }

    public function isSessionActive()
    {
        // Cek apakah sesi aktif
        if (isset($_SESSION['loggedin_time']) && (time() - $_SESSION['loggedin_time'] > 3600)) {
            session_destroy();
            header("Location: ../public/login.php?message=session_expired");
            exit();
        }
        return true; // Sesi masih aktif
    }

    public function editProfileMahasiswa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input
            $data = [
                'nim' => $_SESSION['user']['NIM'],
                'nama' => $_POST['nama'] ?? '',
                'email' => $_POST['email'] ?? ''
            ];

            // Validasi data wajib diisi
            if (empty($data['nama']) || empty($data['email'])) {
                $_SESSION['error'] = "Semua field wajib diisi!";
                header("Location: index.php?page=edit");
                exit();
            }

            // Validasi format email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Format email tidak valid!";
                header("Location: index.php?page=edit");
                exit();
            }

            // Panggil metode updateProfile
            $result = $this->userModel->updateProfile($data);

            if ($result > 0) {
                // Update session data
                $_SESSION['user']['nama_mahasiswa'] = $data['nama'];
                $_SESSION['user']['email_mahasiswa'] = $data['email'];

                $_SESSION['success'] = "Profil berhasil diperbarui!";
                header("Location: index.php?page=profile");
                exit();
            } else {
                $_SESSION['error'] = "Tidak ada perubahan yang dibuat pada profil.";
                header("Location: index.php?page=edit");
                exit();
            }
        }

        $_SESSION['error'] = "Request tidak valid.";
        header("Location: index.php?page=edit");
        exit();
    }
}
?>
