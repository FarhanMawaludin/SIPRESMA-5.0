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
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (strlen($username) < 5 || strlen($password) < 5) {
                echo "Username dan password harus minimal 5 karakter.";
                return;
            }

            $user = $this->userModel->validateLogin($username, $password);

            if ($user) {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user['role'] ?? '';
                $_SESSION['loggedin_time'] = time();

                if (isset($user['role_dosen'])) {
                    header("Location: index.php?page=dosen_dashboard");
                } else {
                    header("Location: index.php?page=home");
                }
            } else {
                echo "NIM/NIDN atau password salah.";
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?page=login&message=logged_out");
        exit();
    }
    public function isSessionActive()
    {
        if (isset($_SESSION['loggedin_time']) && (time() - $_SESSION['loggedin_time'] > 3600)) {
            session_destroy();
            header("Location: index.php?page=login&message=session_expired");
            exit();
        }
        return true;
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
