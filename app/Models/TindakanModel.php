<?php

namespace App\Models;

use CodeIgniter\Model;

class TindakanModel extends Model
{
    protected $table      = 'tb_tindakan';
    protected $primaryKey = 'id_tindakan';

    protected $allowedFields = ['no_tindakan', 'nama_tindakan', 'harga'];

    public function getTindakan($id_tindakan = false)
    {
        if ($id_tindakan == false) {
            return $this->findAll();
        }

        return $this->where(['id_tindakan' => $id_tindakan])->first();
    }

    public function search($keyword)
    {
        return $this->table('tb_tindakan')->like('no_tindakan', $keyword)->orLike('nama_tindakan', $keyword);
    }
}
