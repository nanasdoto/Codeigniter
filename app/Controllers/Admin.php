<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\ObatModel;
use App\Models\PoliModel;
use App\Models\TindakanModel;
use App\Models\RekammedisModel;
use Dompdf\Dompdf;

class Admin extends BaseController
{
    protected $dokterModel;
    protected $pasienModel;
    protected $obatModel;
    protected $poliModel;
    protected $tindakanModel;
    protected $rekammedisModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
        $this->pasienModel = new PasienModel();
        $this->obatModel = new ObatModel();
        $this->poliModel = new PoliModel();
        $this->tindakanModel = new TindakanModel();
        $this->rekammedisModel = new RekammedisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Beranda'
        ];
        return view('admin/index', $data);
    }

    public function rekammedis()
    {
        // $currentPage = $this->request->getVar('page_tb_rekammedis') ? $this->request->getVar('page_tb_rekammedis') : 1;

        // $keyword = $this->request->getVar('keyword');
        // if ($keyword) {
        //     $rekam = $this->rekammedisModel->search($keyword);
        // } else {
        //     $rekam = $this->rekammedisModel;
        // }
        
        $data = [
            'title' => 'Rekam Medis',
            'rekammedis' => $this->rekammedisModel->getAll(),
            // 'rekammedis' => $rekam->paginate(1, 'tb_rekammedis'),
            // 'dokter' => $this->dokterModel->getDokter(),
            // 'tindakan' => $this->tindakanModel->getTindakan(),
            // 'pager' => $this->rekammedisModel->pager,
            // 'currentPage' => $currentPage
        ];

        return view('admin/rekammedis/index', $data);
    }

    public function createrekammedis()
    {
        $no_rm = $this->rekammedisModel->noPendaftaran();
        $data = [
            'title' => 'Form Tambah Data Rekam Medis',
            'dokter' => $this->dokterModel->getDokter(),
            'no_rm' => $no_rm,
            'poli' => $this->poliModel->getPoli(),
            'tindakan' => $this->tindakanModel->getTindakan(),
            'pasien' => $this->pasienModel->getPasien(),
            'obat' => $this->obatModel->getObat(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/rekammedis/create', $data);
    }

    public function saverekammedis()
    {
        $this->rekammedisModel->save([
            'no_rm' => $this->request->getVar('no_rm'),
            'id_pasien' => $this->request->getVar('id_pasien'),
            'keluhan' => $this->request->getVar('keluhan'),
            'id_dokter' => $this->request->getVar('id_dokter'),
            'diagnosa' => $this->request->getVar('diagnosa'),
            'id_poli' => $this->request->getVar('id_poli'),
            'id_tindakan' => $this->request->getVar('id_tindakan'),
            'harga' => $this->request->getVar('harga'),
            'id_obat' => $this->request->getVar('id_obat'),
            'tgl_periksa' => $this->request->getVar('tgl_periksa')
        ]);

        return redirect()->to('admin/rekammedis/index')->with('success', 'Berhasil');
    }

    public function print()
    {
        $data = [
            'title' => 'Rekam Medis',
            'rekammedis' => $this->rekammedisModel->getAll(),
        ];

        $html = view('admin/rekammedis/print', $data);

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }


    public function profile()
    {
        $data['title'] = 'User List';
        $users = new \Myth\Auth\Models\UserModel();
        $data['users'] = $users->findAll();

        return view('admin/profile/index', $data);
    }

    // public function dokter()
    // {
    //     $currentPage = $this->request->getVar('page_tb_dokter') ? $this->request->getVar('page_tb_dokter') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $dokter = $this->dokterModel->search($keyword);
    //     } else {
    //         $dokter = $this->dokterModel;
    //     }

    //     $data = [
    //         'title' => 'Dokter',
    //         'dokter' => $dokter->paginate(5, 'tb_dokter'),
    //         'pager' => $this->dokterModel->pager,
    //         'currentPage' => $currentPage
    //     ];

    //     return view('admin/dokter/index', $data);
    // }

    // public function create()
    // {
    //     $data = [
    //         'title' => 'Form Tambah Data Dokter',
    //         'validation' => \Config\Services::validation()
    //     ];

    //     return view('admin/dokter/create', $data);
    // }

    // public function save()
    // {
    //     //validasi
    //     if (!$this->validate([
    //         'no_dokter' => [
    //             'rules' => 'required|is_unique[tb_dokter.no_dokter]',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_dokter' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'spesialis' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'alamat_dokter' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'no_telp' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/create')->withInput();
    //     }

    //     $this->dokterModel->save([
    //         'no_dokter' => $this->request->getVar('no_dokter'),
    //         'nama_dokter' => $this->request->getVar('nama_dokter'),
    //         'spesialis' => $this->request->getVar('spesialis'),
    //         'alamat_dokter' => $this->request->getVar('alamat_dokter'),
    //         'no_telp' => $this->request->getVar('no_telp')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

    //     return redirect()->to('admin/dokter/index');
    // }

    // public function delete($id_dokter)
    // {
    //     $this->dokterModel->delete($id_dokter);
    //     session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
    //     return redirect()->to('admin/dokter/index');
    // }

    // public function edit($id_dokter)
    // {
    //     $data = [
    //         'title' => 'Form Edit Data Dokter',
    //         'validation' => \Config\Services::validation(),
    //         'dokter' => $this->dokterModel->getDokter($id_dokter)
    //     ];

    //     return view('admin/dokter/edit', $data);
    // }

    // public function update($id_dokter)
    // {
    //     $dokterLama = $this->dokterModel->getDokter($this->request->getVar('id_dokter'));
    //     if ($dokterLama['no_dokter'] == $this->request->getVar('no_dokter')) {
    //         $rule_dokter = 'required';
    //     } else {
    //         $rule_dokter = 'required|is_unique[tb_dokter.no_dokter]';
    //     }

    //     if (!$this->validate([
    //         'no_dokter' => [
    //             'rules' => $rule_dokter,
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_dokter' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'spesialis' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'alamat_dokter' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'no_telp' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/dokter/edit/' . $this->request->getVar('id_dokter'))->withInput();
    //     }

    //     $this->dokterModel->save([
    //         'id_dokter' => $id_dokter,
    //         'no_dokter' => $this->request->getVar('no_dokter'),
    //         'nama_dokter' => $this->request->getVar('nama_dokter'),
    //         'spesialis' => $this->request->getVar('spesialis'),
    //         'alamat_dokter' => $this->request->getVar('alamat_dokter'),
    //         'no_telp' => $this->request->getVar('no_telp')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil diubah!!');

    //     return redirect()->to('admin/dokter/index');
    // }


    // public function obat()
    // {

    //     $currentPage = $this->request->getVar('page_tb_obat') ? $this->request->getVar('page_tb_obat') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $obat = $this->obatModel->search($keyword);
    //     } else {
    //         $obat = $this->obatModel;
    //     }

    //     $data = [
    //         'title' => 'Obat',
    //         'obat' => $obat->paginate(5, 'tb_obat'),
    //         'pager' => $this->obatModel->pager,
    //         'currentPage' => $currentPage
    //     ];
    //     return view('admin/obat/index', $data);
    // }

    // public function createobat()
    // {
    //     $data = [
    //         'title' => 'Form Tambah Data Obat',
    //         'validation' => \Config\Services::validation()
    //     ];

    //     return view('admin/obat/create', $data);
    // }

    // public function saveobat()
    // {
    //     //validasi
    //     if (!$this->validate([
    //         'no_obat' => [
    //             'rules' => 'required|is_unique[tb_obat.no_obat]',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_obat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'ket_obat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/createobat')->withInput();
    //     }

    //     $this->obatModel->save([
    //         'no_obat' => $this->request->getVar('no_obat'),
    //         'nama_obat' => $this->request->getVar('nama_obat'),
    //         'ket_obat' => $this->request->getVar('ket_obat')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

    //     return redirect()->to('admin/obat/index');
    // }

    // public function deleteobat($id_obat)
    // {
    //     $this->obatModel->delete($id_obat);
    //     session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
    //     return redirect()->to('admin/obat/index');
    // }

    // public function editobat($id_obat)
    // {
    //     $data = [
    //         'title' => 'Form Edit Data Obat',
    //         'validation' => \Config\Services::validation(),
    //         'obat' => $this->obatModel->getObat($id_obat)
    //     ];

    //     return view('admin/obat/edit', $data);
    // }

    // public function updateobat($id_obat)
    // {
    //     $obatLama = $this->obatModel->getObat($this->request->getVar('id_obat'));
    //     if ($obatLama['no_obat'] == $this->request->getVar('no_obat')) {
    //         $rule_obat = 'required';
    //     } else {
    //         $rule_obat = 'required|is_unique[tb_obat.no_obat]';
    //     }

    //     if (!$this->validate([
    //         'no_obat' => [
    //             'rules' => $rule_obat,
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_obat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'ket_obat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/obat/edit/' . $this->request->getVar('id_obat'))->withInput();
    //     }

    //     $this->obatModel->save([
    //         'id_obat' => $id_obat,
    //         'no_obat' => $this->request->getVar('no_obat'),
    //         'ket_obat' => $this->request->getVar('ket_obat')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil diubah!!');

    //     return redirect()->to('admin/obat/index');
    // }


    // public function pasien()
    // {
    //     $currentPage = $this->request->getVar('page_tb_pasien') ? $this->request->getVar('page_tb_pasien') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $pasien = $this->pasienModel->search($keyword);
    //     } else {
    //         $pasien = $this->pasienModel;
    //     }

    //     $data = [
    //         'title' => 'Pasien',
    //         'pasien' => $pasien->paginate(5, 'tb_pasien'),
    //         'pager' => $this->pasienModel->pager,
    //         'currentPage' => $currentPage
    //     ];

    //     return view('admin/pasien/index', $data);
    // }

    // public function createpasien()
    // {
    //     $data = [
    //         'title' => 'Form Tambah Data Pasien',
    //         'validation' => \Config\Services::validation()
    //     ];

    //     return view('admin/pasien/create', $data);
    // }

    // public function savepasien()
    // {
    //     //validasi
    //     if (!$this->validate([
    //         'no_pasien' => [
    //             'rules' => 'required|is_unique[tb_pasien.no_pasien]',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_pasien' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'jenis_kelamin' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'no_telp' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/createpasien')->withInput();
    //     }

    //     $this->pasienModel->save([
    //         'no_pasien' => $this->request->getVar('no_pasien'),
    //         'nama_pasien' => $this->request->getVar('nama_pasien'),
    //         'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
    //         'alamat' => $this->request->getVar('alamat'),
    //         'no_telp' => $this->request->getVar('no_telp')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

    //     return redirect()->to('admin/pasien/index');
    // }

    // public function deletepasien($id_pasien)
    // {
    //     $this->pasienModel->delete($id_pasien);
    //     session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
    //     return redirect()->to('admin/pasien/index');
    // }

    // public function editpasien($id_pasien)
    // {
    //     $data = [
    //         'title' => 'Form Edit Data Pasien',
    //         'validation' => \Config\Services::validation(),
    //         'pasien' => $this->pasienModel->getPasien($id_pasien)
    //     ];

    //     return view('admin/pasien/edit', $data);
    // }

    // public function updatepasien($id_pasien)
    // {
    //     $pasienLama = $this->pasienModel->getPasien($this->request->getVar('id_pasien'));
    //     if ($pasienLama['no_pasien'] == $this->request->getVar('no_pasien')) {
    //         $rule_pasien = 'required';
    //     } else {
    //         $rule_pasien = 'required|is_unique[tb_pasien.no_pasien]';
    //     }

    //     if (!$this->validate([
    //         'no_pasien' => [
    //             'rules' => $rule_pasien,
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_pasien' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'jenis_kelamin' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'alamat' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'no_telp' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/pasien/edit/' . $this->request->getVar('id_pasien'))->withInput();
    //     }

    //     $this->pasienModel->save([
    //         'id_pasien' => $id_pasien,
    //         'no_pasien' => $this->request->getVar('no_pasien'),
    //         'nama_pasien' => $this->request->getVar('nama_pasien'),
    //         'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
    //         'alamat' => $this->request->getVar('alamat'),
    //         'no_telp' => $this->request->getVar('no_telp')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil diubah!!');

    //     return redirect()->to('admin/pasien/index');
    // }

    // public function poli()
    // {
    //     $currentPage = $this->request->getVar('page_tb_poli') ? $this->request->getVar('page_tb_poli') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $poli = $this->poliModel->search($keyword);
    //     } else {
    //         $poli = $this->poliModel;
    //     }

    //     $data = [
    //         'title' => 'Poli',
    //         'poli' => $poli->paginate(5, 'tb_poli'),
    //         'pager' => $this->poliModel->pager,
    //         'currentPage' => $currentPage
    //     ];

    //     return view('admin/poli/index', $data);
    // }

    // public function createpoli()
    // {
    //     $data = [
    //         'title' => 'Form Tambah Data Poli',
    //         'validation' => \Config\Services::validation()
    //     ];

    //     return view('admin/poli/create', $data);
    // }

    // public function savepoli()
    // {
    //     //validasi
    //     if (!$this->validate([
    //         'no_poli' => [
    //             'rules' => 'required|is_unique[tb_poli.no_poli]',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_poli' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/createpoli')->withInput();
    //     }

    //     $this->poliModel->save([
    //         'no_poli' => $this->request->getVar('no_poli'),
    //         'nama_poli' => $this->request->getVar('nama_poli')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

    //     return redirect()->to('admin/poli/index');
    // }

    // public function deletepoli($id_poli)
    // {
    //     $this->poliModel->delete($id_poli);
    //     session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
    //     return redirect()->to('admin/poli/index');
    // }

    // public function editpoli($id_poli)
    // {
    //     $data = [
    //         'title' => 'Form Edit Data Poli',
    //         'validation' => \Config\Services::validation(),
    //         'poli' => $this->poliModel->getPoli($id_poli)
    //     ];

    //     return view('admin/poli/edit', $data);
    // }

    // public function updatepoli($id_poli)
    // {
    //     $poliLama = $this->poliModel->getPoli($this->request->getVar('id_poli'));
    //     if ($poliLama['no_poli'] == $this->request->getVar('no_poli')) {
    //         $rule_poli = 'required';
    //     } else {
    //         $rule_poli = 'required|is_unique[tb_poli.no_poli]';
    //     }

    //     if (!$this->validate([
    //         'no_poli' => [
    //             'rules' => $rule_poli,
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_poli' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/poli/edit/' . $this->request->getVar('id_poli'))->withInput();
    //     }

    //     $this->poliModel->save([
    //         'id_poli' => $id_poli,
    //         'no_poli' => $this->request->getVar('no_poli'),
    //         'nama_poli' => $this->request->getVar('nama_poli')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil diubah!!');

    //     return redirect()->to('admin/poli/index');
    // }

    // public function tindakan()
    // {
    //     $currentPage = $this->request->getVar('page_tb_tindakan') ? $this->request->getVar('page_tb_tindakan') : 1;

    //     $keyword = $this->request->getVar('keyword');
    //     if ($keyword) {
    //         $tindakan = $this->tindakanModel->search($keyword);
    //     } else {
    //         $tindakan = $this->tindakanModel;
    //     }

    //     $data = [
    //         'title' => 'Tindakan',
    //         'tindakan' => $tindakan->paginate(5, 'tb_tindakan'),
    //         'pager' => $this->tindakanModel->pager,
    //         'currentPage' => $currentPage
    //     ];

    //     return view('admin/tindakan/index', $data);
    // }

    // public function createtindakan()
    // {
    //     $data = [
    //         'title' => 'Form Tambah Data Tindakan',
    //         'validation' => \Config\Services::validation()
    //     ];

    //     return view('admin/tindakan/create', $data);
    // }

    // public function savetindakan()
    // {
    //     //validasi
    //     if (!$this->validate([
    //         'no_tindakan' => [
    //             'rules' => 'required|is_unique[tb_tindakan.no_tindakan]',
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_tindakan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'harga' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/createtindakan')->withInput();
    //     }

    //     $this->tindakanModel->save([
    //         'no_tindakan' => $this->request->getVar('no_tindakan'),
    //         'nama_tindakan' => $this->request->getVar('nama_tindakan'),
    //         'harga' => $this->request->getVar('harga')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil ditambahkan!!');

    //     return redirect()->to('admin/tindakan/index');
    // }

    // public function deletetindakan($id_tindakan)
    // {
    //     $this->tindakanModel->delete($id_tindakan);
    //     session()->setFlashdata('pesan', 'Data berhasil dihapus!!');
    //     return redirect()->to('admin/tindakan/index');
    // }

    // public function edittindakan($id_tindakan)
    // {
    //     $data = [
    //         'title' => 'Form Edit Data Tindakan',
    //         'validation' => \Config\Services::validation(),
    //         'tindakan' => $this->tindakanModel->getTindakan($id_tindakan)
    //     ];

    //     return view('admin/tindakan/edit', $data);
    // }

    // public function updatetindakan($id_tindakan)
    // {
    //     $tindakanLama = $this->tindakanModel->getTindakan($this->request->getVar('id_tindakan'));
    //     if ($tindakanLama['no_tindakan'] == $this->request->getVar('no_tindakan')) {
    //         $rule_tindakan = 'required';
    //     } else {
    //         $rule_tindakan = 'required|is_unique[tb_tindakan.no_tindakan]';
    //     }

    //     if (!$this->validate([
    //         'no_tindakan' => [
    //             'rules' => $rule_tindakan,
    //             'errors' => [
    //                 'required' => '{field} harus diisi',
    //                 'is_unique' => '{field} sudah terdaftar'
    //             ]
    //         ],
    //         'nama_tindakan' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ],
    //         'harga' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field} harus diisi'
    //             ]
    //         ]
    //     ])) {
    //         return redirect()->to('admin/tindakan/edit/' . $this->request->getVar('id_tindakan'))->withInput();
    //     }

    //     $this->tindakanModel->save([
    //         'id_tindakan' => $id_tindakan,
    //         'no_tindakan' => $this->request->getVar('no_tindakan'),
    //         'nama_tindakan' => $this->request->getVar('nama_tindakan'),
    //         'harga' => $this->request->getVar('harga')
    //     ]);

    //     session()->setFlashdata('pesan', 'Data berhasil diubah!!');

    //     return redirect()->to('admin/tindakan/index');
    // }

}
