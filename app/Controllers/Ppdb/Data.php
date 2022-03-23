<?php

namespace App\Controllers\Ppdb;

use App\Controllers\BaseController;
use App\Models\DatapendaftarModel;
use App\Models\RegisterModel;
use App\Models\SekolahModel;
use App\Models\PengaturanModel;
use App\Models\ContactModel;
use App\Models\JenjangModel;
use App\Models\InfoModel;
use App\Models\JurusanModel;
use App\Models\SyaratModel;

class Data extends BaseController
{
    protected $pengaturanModel;
    protected $validation;
    protected $registerModel;
    protected $contactModel;
    protected $infoModel;
    protected $jenjangModel;
    protected $jurusanModel;
    protected $pendaftar;
    protected $sekolahModel;
    protected $register;
    protected $syarat;
    public function __construct()
    {
        $this->pengaturanModel  = new PengaturanModel();
        $this->sekolahModel     = new SekolahModel();
        $this->contactModel     = new ContactModel();
        $this->infoModel        = new InfoModel();
        $this->jenjangModel     = new JenjangModel();
        $this->jurusanModel     = new JurusanModel();
        $this->pendaftar        = new DatapendaftarModel();
        $this->register         = new RegisterModel();
        $this->syarat           = new SyaratModel();
        $this->validation       =  \Config\Services::validation();
        $this->session          = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'controller'    => 'ppdb/data',
            'school'       => $this->sekolahModel->getData()->where('tbl_sekolah.id = 1')->first(),
            'kontak'       => $this->contactModel->findAll(),
            'info'         => $this->infoModel->where('id', 1)->first(),
            'set'          => $this->pengaturanModel->get_data()->where('tbl_setting.id', 1)->first(),
        ];
        if (!session()->get('loggedin')) {
            return redirect()
                ->to('loginuser/fotout');
        } else {
            $siswa = $this->pendaftar->where('id_daf', session()->get('id'))->first();
            if ($siswa->progres == 0) {
                return view('ppdb/depan', $data);
            } else {
                return view('ppdb/siswa', $data);
            }
        }
    }

    public function resume()
    {
        $data = $this->pendaftar->getData(session()->get('id'))->first();
        return $this->response->setJSON($data);
        dd($data);
    }

    public function get_all()
    {
        $data = $this->syarat->findAll();
        return $this->response->setJSON($data);
    }

    public function edit()
    {
        $response = array();
        $fields['id']       = session()->get('id');
        $fields['nik']      = $this->request->getPost('nik');
        $fields['nisn']     = $this->request->getPost('nisn');
        $fields['nama']     = $this->request->getPost('nama');

        $oldfoto            = $this->request->getPost('oldfoto');
        $foto               = $this->request->getFile('file-input');

        if ($foto->getError() == 4) {
            $fields['foto'] = $oldfoto;
        } else {
            $fields['foto'] = $foto->getRandomName();
        }

        $this->validation->setRules([
            'nik'       => ['label' => 'NIK', 'rules'   => 'required|numeric|min_length[16]|max_length[16]'],
            'nisn'      => ['label' => 'NISN', 'rules'  => 'required|numeric|max_length[12]'],
            'nama'      => ['label' => 'Nama', 'rules'  => 'required'],
            // 'foto'      => ['label' => 'Foto', 'rules'  => 'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|is_image[foto]|max_size[foto,1028]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            $reg        = $this->pendaftar->where('id', $fields['id'])->first();
            $regs['id'] = $reg->id;
            if ($this->register->update($fields['id'], $fields)) {
                $this->pendaftar->update($regs['id'], $fields);
                $response['success'] = true;
                $response['messages'] = 'Perbaikan Data berhasil ';

                if (!$foto->getError() == 4) {
                    $foto->move('foto/', $fields['foto']);
                }
                if ($oldfoto != 'foto.jpg') {
                    unlink('foto/' . $oldfoto);
                }
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }
        return $this->response->setJSON($response);
    }
}
