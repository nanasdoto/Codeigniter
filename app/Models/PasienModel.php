<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table      = 'tb_pasien';
    protected $primaryKey = 'id_pasien';

    protected $allowedFields = ['no_pasien', 'nama_pasien', 'jenis_kelamin', 'alamat', 'no_telp'];

    public function getPasien($id_pasien = false)
    {
        if ($id_pasien == false) {
            return $this->findAll();
        }

        return $this->where(['id_pasien' => $id_pasien])->first();
    }

    public function search($keyword)
    {
        return $this->table('tb_pasien')->like('no_pasien', $keyword)->orLike('nama_pasien', $keyword);
    }
}
