<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function validateLogin($username, $password)
    {
        // mhs
        $sqlMahasiswa = "SELECT * FROM mahasiswa WHERE NIM = ? AND password_mahasiswa = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlMahasiswa, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($result) {
                $result['role'] = 'mahasiswa';
                return $result;
            }
        }

        // dosen
        $sqlDosen = "SELECT id_dosen, NIDN, role_dosen, nama_dosen FROM dosen WHERE NIDN = ? AND password_dosen = ?";
        $stmt = sqlsrv_prepare($this->conn, $sqlDosen, array(&$username, &$password));

        if (sqlsrv_execute($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($result) {
                $result['role'] = $result['role_dosen'];
                return $result;
            }
        }

        return false;
    }

    public function updateProfile($data) {
        $query = "
            UPDATE mahasiswa 
            SET 
                nama_mahasiswa = ?, 
                email_mahasiswa = ? 
            WHERE 
                NIM = ?
        ";
    
        // Menyiapkan pernyataan dengan sqlsrv_prepare
        $params = [
            $data['nama'],
            $data['email'],
            $data['nim']
        ];
    
        $stmt = sqlsrv_prepare($this->conn, $query, $params);
    
        // Menjalankan pernyataan
        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }
    
        if (sqlsrv_execute($stmt)) {
            // Memeriksa jumlah baris yang diperbarui
            $rowsAffected = sqlsrv_rows_affected($stmt);
            sqlsrv_free_stmt($stmt); // Membersihkan statement
            return $rowsAffected; // Mengembalikan jumlah baris yang diperbarui
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    }
    
}
