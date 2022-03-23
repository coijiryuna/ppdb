<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterModel;
use App\Models\DatapendaftarModel;
use App\Models\SekolahModel;

class Loginuser extends BaseController
{

    protected $session;
    protected $daftar;
    protected $registerModel;
    protected $sekolahModel;

    public function __construct()
    {
        $this->registerModel    = new RegisterModel();
        $this->daftar           = new DatapendaftarModel();
        $this->sekolahModel     = new SekolahModel();
        $this->validation       =  \Config\Services::validation();
        $this->session          = session();
    }

    public function process()
    {
        $session = session();
        $nik = $this->request->getPost('nik');
        $nisn = $this->request->getPost('nisn');
        $dataUser = $this->registerModel->where([
            'nik'   => $nik,
            'nisn'  => $nisn
        ])->first();
        if ($dataUser == true) {
            $data = [
                'id'        => $dataUser->id,
                'nama'      => $dataUser->nama,
                'nik'       => $dataUser->nik,
                'nisn'      => $dataUser->nisn,
                'no_reg'    => $dataUser->no_qr,
                'jalur'     => $dataUser->jalur,
                'school'    => $this->sekolahModel->getData()->where('tbl_sekolah.id = 1')->first(),
                'loggedin'  => TRUE
            ];
            $session->set($data);
            $session->setFlashdata('msg', 'Silakan Lengkapi Data Anda!');
            $siswa = $this->daftar->where('id_daf', session()->get('id'))->first();
            if ($siswa->progres == 0) {
                return redirect()->to(base_url('ppdb/data'));
            } else {
                return redirect()->to(base_url('ppdb/data'));
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'NIK & NISN tidak terdaftar/salah');
        }
    }

    function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
