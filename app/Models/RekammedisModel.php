<?php

namespace App\Models;

use CodeIgniter\Model;

class RekammedisModel extends Model
{
    protected $table      = 'tb_rekammedis';
    protected $primaryKey = 'no_rm';
    protected $returnType = 'object';

    protected $allowedFields = ['no_rm', 'id_pasien', 'alamat', 'keluhan', 'id_dokter', 'diagnosa', 'id_poli','id_tindakan', 'harga', 'id_obat', 'tgl_periksa'];

    // public function getRekammedis($id_rm = false)
    // {
    //     if ($id_rm == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['id_rm' => $id_rm])->first();
    // }

    //join

    public function getAll()
    {
        $builder = $this->db->table('tb_rekammedis');
        $builder->join('tb_pasien', 'tb_pasien.id_pasien = tb_rekammedis.id_pasien');
        $builder->join('tb_dokter', 'tb_dokter.id_dokter = tb_rekammedis.id_dokter');
        $builder->join('tb_poli', 'tb_poli.id_poli = tb_rekammedis.id_poli');
        $builder->join('tb_tindakan', 'tb_tindakan.id_tindakan = tb_rekammedis.id_tindakan');
        $builder->join('tb_obat', 'tb_obat.id_obat = tb_rekammedis.id_obat');
        $query = $builder->get();
        return $query->getResult(); 
    }

    public function noPendaftaran()
    {
        $kode = $this->db->table('tb_rekammedis')->select('RIGHT(no_rm,3) AS no_rm', FALSE)->orderBy('no_rm', 'DESC')->limit(1)->get()->getRowArray();

        if ($kode['no_rm'] == null) {
            $no = 1;
        }else {
            $no = intval($kode['no_rm']) + 1;
        }

        $tgl = date('Ymd');
        $batas = str_pad($no,3,"0", STR_PAD_LEFT);
        $no_rm = $tgl.$batas;
        return $no_rm;
    }

}
