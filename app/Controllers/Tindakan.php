<?php

namespace App\Controllers;

use App\Models\TindakanModel;

class Tindakan extends BaseController
{
    protected $tindakanModel;

    public function __construct()
    {
        $this->tindakanModel = new TindakanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_tindakan') ? $this->request->getVar('page_tb_tindakan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $tindakan = $this->tindakanModel->search($keyword);
        } else {
            $tindakan = $this->tindakanModel;
        }

        $data = [
            'title' => 'Tindakan',
            'tindakan' => $tindakan->paginate(5, 'tb_tindakan'),
            'pager' => $this->tindakanModel->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/tindakan/index', $data);    }
    
    public function createtindakan()
    {
        $data = [
            'title' => 'Form Tambah Data Tindakan',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/tindakan/create', $data);
    }

    public function savetindakan()
    {
        //validasi
        if (!$this->validate([
            'no_tindakan' => [
                'rules' => 'required|is_unique[tb_tindakan.no_tindakan]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_tindakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('tindakan/createtindakan')->withInput();
        }

        $this->tindakanModel->save([
            'no_tindakan' => $this->request->getVar('no_tindakan'),
            'nama_tindakan' => $this->request->getVar('nama_tindakan'),
            'harga' => $this->request->getVar('harga')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

        return redirect()->to('/tindakan/index');
    }

    public function deletetindakan($id_tindakan)
    {
        $this->tindakanModel->delete($id_tindakan);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
        return redirect()->to('/tindakan/index');
    }

    public function edittindakan($id_tindakan)
    {
        $data = [
            'title' => 'Form Edit Data Tindakan',
            'validation' => \Config\Services::validation(),
            'tindakan' => $this->tindakanModel->getTindakan($id_tindakan)
        ];

        return view('admin/tindakan/edit', $data);
    }

    public function updatetindakan($id_tindakan)
    {
        $tindakanLama = $this->tindakanModel->getTindakan($this->request->getVar('id_tindakan'));
        if ($tindakanLama['no_tindakan'] == $this->request->getVar('no_tindakan')) {
            $rule_tindakan = 'required';
        } else {
            $rule_tindakan = 'required|is_unique[tb_tindakan.no_tindakan]';
        }

        if (!$this->validate([
            'no_tindakan' => [
                'rules' => $rule_tindakan,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'nama_tindakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/tindakan/edittindakan/' . $this->request->getVar('id_tindakan'))->withInput();
        }

        $this->tindakanModel->save([
            'id_tindakan' => $id_tindakan,
            'no_tindakan' => $this->request->getVar('no_tindakan'),
            'nama_tindakan' => $this->request->getVar('nama_tindakan'),
            'harga' => $this->request->getVar('harga')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!!');

        return redirect()->to('/tindakan/index');
    }
}
