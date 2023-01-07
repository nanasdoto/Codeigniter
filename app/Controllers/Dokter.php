<?php

namespace App\Controllers;

use App\Models\DokterModel;

class Dokter extends BaseController
{
    protected $dokterModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_dokter') ? $this->request->getVar('page_tb_dokter') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $dokter = $this->dokterModel->search($keyword);
        } else {
            $dokter = $this->dokterModel;
        }

        $data = [
            'title' => 'Dokter',
            'dokter' => $dokter->paginate(5, 'tb_dokter'),
            'pager' => $this->dokterModel->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/dokter/index', $data);
    }
   
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Dokter',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/dokter/create', $data);
    }

    public function save()
    {
        //validasi
        if (!$this->validate([
            'no_dokter' => [
                'rules' => 'required|is_unique[tb_dokter.no_dokter]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'spesialis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamat_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('dokter/create')->withInput();
        }

        $this->dokterModel->save([
            'no_dokter' => $this->request->getVar('no_dokter'),
            'nama_dokter' => $this->request->getVar('nama_dokter'),
            'spesialis' => $this->request->getVar('spesialis'),
            'alamat_dokter' => $this->request->getVar('alamat_dokter'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

        return redirect()->to('/dokter/index');
    }

    public function delete($id_dokter)
    {
        $this->dokterModel->delete($id_dokter);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
        return redirect()->to('/dokter/index');
    }

    public function edit($id_dokter)
    {
        $data = [
            'title' => 'Form Edit Data Dokter',
            'validation' => \Config\Services::validation(),
            'dokter' => $this->dokterModel->getDokter($id_dokter)
        ];

        return view('admin/dokter/edit', $data);
    }

    public function update($id_dokter)
    {
        $dokterLama = $this->dokterModel->getDokter($this->request->getVar('id_dokter'));
        if ($dokterLama['no_dokter'] == $this->request->getVar('no_dokter')) {
            $rule_dokter = 'required';
        } else {
            $rule_dokter = 'required|is_unique[tb_dokter.no_dokter]';
        }

        if (!$this->validate([
            'no_dokter' => [
                'rules' => $rule_dokter,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'spesialis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamat_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/dokter/edit/' . $this->request->getVar('id_dokter'))->withInput();
        }

        $this->dokterModel->save([
            'id_dokter' => $id_dokter,
            'no_dokter' => $this->request->getVar('no_dokter'),
            'nama_dokter' => $this->request->getVar('nama_dokter'),
            'spesialis' => $this->request->getVar('spesialis'),
            'alamat_dokter' => $this->request->getVar('alamat_dokter'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!!');

        return redirect()->to('/dokter/index');
    }

}
