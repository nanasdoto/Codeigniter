<?php

namespace App\Controllers;

use App\Models\PasienModel;

class Pasien extends BaseController
{
    protected $pasienModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_pasien') ? $this->request->getVar('page_tb_pasien') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pasien = $this->pasienModel->search($keyword);
        } else {
            $pasien = $this->pasienModel;
        }

        $data = [
            'title' => 'Pasien',
            'pasien' => $pasien->paginate(5, 'tb_pasien'),
            'pager' => $this->pasienModel->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/pasien/index', $data);
    }

    public function createpasien()
    {
        $data = [
            'title' => 'Form Tambah Data Pasien',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/pasien/create', $data);
    }

    public function savepasien()
    {
        //validasi
        if (!$this->validate([
            'no_pasien' => [
                'rules' => 'required|is_unique[tb_pasien.no_pasien]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_pasien' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamat' => [
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
            return redirect()->to('admin/createpasien')->withInput();
        }

        $this->pasienModel->save([
            'no_pasien' => $this->request->getVar('no_pasien'),
            'nama_pasien' => $this->request->getVar('nama_pasien'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

        return redirect()->to('/pasien/index');
    }

    public function deletepasien($id_pasien)
    {
        $this->pasienModel->delete($id_pasien);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
        return redirect()->to('/pasien/index');
    }

    public function editpasien($id_pasien)
    {
        $data = [
            'title' => 'Form Edit Data Pasien',
            'validation' => \Config\Services::validation(),
            'pasien' => $this->pasienModel->getPasien($id_pasien)
        ];

        return view('admin/pasien/edit', $data);
    }

    public function updatepasien($id_pasien)
    {
        $pasienLama = $this->pasienModel->getPasien($this->request->getVar('id_pasien'));
        if ($pasienLama['no_pasien'] == $this->request->getVar('no_pasien')) {
            $rule_pasien = 'required';
        } else {
            $rule_pasien = 'required|is_unique[tb_pasien.no_pasien]';
        }

        if (!$this->validate([
            'no_pasien' => [
                'rules' => $rule_pasien,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_pasien' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamat' => [
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
            return redirect()->to('/pasien/editpasien/' . $this->request->getVar('id_pasien'))->withInput();
        }

        $this->pasienModel->save([
            'id_pasien' => $id_pasien,
            'no_pasien' => $this->request->getVar('no_pasien'),
            'nama_pasien' => $this->request->getVar('nama_pasien'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!!');

        return redirect()->to('/pasien/index');
    }      
}