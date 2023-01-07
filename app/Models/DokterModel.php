<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table      = 'tb_dokter';
    protected $primaryKey = 'id_dokter';

    protected $allowedFields = ['no_dokter', 'nama_dokter', 'spesialis', 'alamat_dokter', 'no_telp'];

    public function getDokter($id_dokter = false)
    {
        if ($id_dokter == false) {
            return $this->findAll();
        }

        return $this->where(['id_dokter' => $id_dokter])->first();
    }

    public function search($keyword)
    {
        return $this->table('tb_dokter')->like('nama_dokter', $keyword)->orLike('spesialis', $keyword);
    }
}
