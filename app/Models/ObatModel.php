<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table      = 'tb_obat';
    protected $primaryKey = 'id_obat';

    protected $allowedFields = ['no_obat', 'nama_obat', 'ket_obat'];

    public function getObat($id_obat = false)
    {
        if ($id_obat == false) {
            return $this->findAll();
        }

        return $this->where(['id_obat' => $id_obat])->first();
    }

    public function search($keyword)
    {
        return $this->table('tb_obat')->like('nama_obat', $keyword)->orLike('ket_obat', $keyword);
    }
}
