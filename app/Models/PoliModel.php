<?php

namespace App\Models;

use CodeIgniter\Model;

class PoliModel extends Model
{
    protected $table      = 'tb_poli';
    protected $primaryKey = 'id_poli';

    protected $allowedFields = ['no_poli', 'nama_poli'];

    public function getPoli($id_poli = false)
    {
        if ($id_poli == false) {
            return $this->findAll();
        }

        return $this->where(['id_poli' => $id_poli])->first();
    }

    public function search($keyword)
    {
        return $this->table('tb_poli')->like('no_poli', $keyword)->orLike('nama_poli', $keyword);
    }
}
