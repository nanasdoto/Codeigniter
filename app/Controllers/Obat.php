<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Obat extends BaseController
{
    protected $obatModel;

    public function __construct()
    {
        $this->obatModel = new ObatModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_obat') ? $this->request->getVar('page_tb_obat') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $obat = $this->obatModel->search($keyword);
        } else {
            $obat = $this->obatModel;
        }

        $data = [
            'title' => 'Obat',
            'obat' => $obat->paginate(5, 'tb_obat'),
            'pager' => $this->obatModel->pager,
            'currentPage' => $currentPage
        ];
        return view('admin/obat/index', $data);
    }

    public function createobat()
    {
        $data = [
            'title' => 'Form Tambah Data Obat',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/obat/create', $data);
    }

    public function saveobat()
    {
        //validasi
        if (!$this->validate([
            'no_obat' => [
                'rules' => 'required|is_unique[tb_obat.no_obat]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'ket_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('obat/createobat')->withInput();
        }

        $this->obatModel->save([
            'no_obat' => $this->request->getVar('no_obat'),
            'nama_obat' => $this->request->getVar('nama_obat'),
            'ket_obat' => $this->request->getVar('ket_obat')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

        return redirect()->to('/obat/index');
    }

    public function deleteobat($id_obat)
    {
        $this->obatModel->delete($id_obat);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
        return redirect()->to('/obat/index');
    }

    public function editobat($id_obat)
    {
        $data = [
            'title' => 'Form Edit Data Obat',
            'validation' => \Config\Services::validation(),
            'obat' => $this->obatModel->getObat($id_obat)
        ];

        return view('admin/obat/edit', $data);
    }

    public function updateobat($id_obat)
    {
        $obatLama = $this->obatModel->getObat($this->request->getVar('id_obat'));
        if ($obatLama['no_obat'] == $this->request->getVar('no_obat')) {
            $rule_obat = 'required';
        } else {
            $rule_obat = 'required|is_unique[tb_obat.no_obat]';
        }

        if (!$this->validate([
            'no_obat' => [
                'rules' => $rule_obat,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'ket_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/obat/editobat/' . $this->request->getVar('id_obat'))->withInput();
        }

        $this->obatModel->save([
            'id_obat' => $id_obat,
            'no_obat' => $this->request->getVar('no_obat'),
            'ket_obat' => $this->request->getVar('ket_obat')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!!');

        return redirect()->to('/obat/index');
    }

}
