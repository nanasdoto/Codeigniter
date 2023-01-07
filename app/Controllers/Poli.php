<?php

namespace App\Controllers;

use App\Models\PoliModel;

class Poli extends BaseController
{
    protected $poliModel;

    public function __construct()
    {
        $this->poliModel = new PoliModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_poli') ? $this->request->getVar('page_tb_poli') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $poli = $this->poliModel->search($keyword);
        } else {
            $poli = $this->poliModel;
        }

        $data = [
            'title' => 'Poli',
            'poli' => $poli->paginate(5, 'tb_poli'),
            'pager' => $this->poliModel->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/poli/index', $data);
    }

    public function createpoli()
    {
        $data = [
            'title' => 'Form Tambah Data Poli',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/poli/create', $data);
    }

    public function savepoli()
    {
        //validasi
        if (!$this->validate([
            'no_poli' => [
                'rules' => 'required|is_unique[tb_poli.no_poli]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('poli/createpoli')->withInput();
        }

        $this->poliModel->save([
            'no_poli' => $this->request->getVar('no_poli'),
            'nama_poli' => $this->request->getVar('nama_poli')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

        return redirect()->to('/poli/index');
    }

    public function deletepoli($id_poli)
    {
        $this->poliModel->delete($id_poli);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
        return redirect()->to('/poli/index');
    }

    public function editpoli($id_poli)
    {
        $data = [
            'title' => 'Form Edit Data Poli',
            'validation' => \Config\Services::validation(),
            'poli' => $this->poliModel->getPoli($id_poli)
        ];

        return view('admin/poli/edit', $data);
    }

    public function updatepoli($id_poli)
    {
        $poliLama = $this->poliModel->getPoli($this->request->getVar('id_poli'));
        if ($poliLama['no_poli'] == $this->request->getVar('no_poli')) {
            $rule_poli = 'required';
        } else {
            $rule_poli = 'required|is_unique[tb_poli.no_poli]';
        }

        if (!$this->validate([
            'no_poli' => [
                'rules' => $rule_poli,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('admin/poli/editpoli/' . $this->request->getVar('id_poli'))->withInput();
        }

        $this->poliModel->save([
            'id_poli' => $id_poli,
            'no_poli' => $this->request->getVar('no_poli'),
            'nama_poli' => $this->request->getVar('nama_poli')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!!');

        return redirect()->to('/poli/index');
    }

}
