<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn; // $conn should be a PDO instance
    }

    public function validateLogin($username, $password)
{
    // Cek login mahasiswa
    $queryMahasiswa = "SELECT id_mahasiswa,NIM, nama_mahasiswa,email_mahasiswa, 'mahasiswa' AS role FROM mahasiswa WHERE NIM = :username AND password_mahasiswa = :password";
    $stmtMahasiswa = $this->conn->prepare($queryMahasiswa);
    $stmtMahasiswa->bindParam(':username', $username);
    $stmtMahasiswa->bindParam(':password', $password);
    $stmtMahasiswa->execute();

    $resultMahasiswa = $stmtMahasiswa->fetch(PDO::FETCH_ASSOC);
    if ($resultMahasiswa) {
        return $resultMahasiswa; // Mengembalikan data mahasiswa
    }

    // Cek login dosen/kajur
    $queryDosen = "SELECT id_dosen, NIDN, nama_dosen, role_dosen AS role FROM dosen WHERE NIDN = :username AND password_dosen = :password";
    $stmtDosen = $this->conn->prepare($queryDosen);
    $stmtDosen->bindParam(':username', $username);
    $stmtDosen->bindParam(':password', $password);
    $stmtDosen->execute();

    $resultDosen = $stmtDosen->fetch(PDO::FETCH_ASSOC);
    if ($resultDosen) {
        return $resultDosen; // Mengembalikan data dosen/kajur
    }

    return null; // Tidak ditemukan data login
}


    public function updateProfile($data) {
        $query = "
            UPDATE mahasiswa 
            SET 
                nama_mahasiswa = :nama, 
                email_mahasiswa = :email 
            WHERE 
                NIM = :nim
        ";

        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':nim', $data['nim']);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);

        $stmt->execute();
        return $stmt->rowCount();
    }
    
    
}
?>
