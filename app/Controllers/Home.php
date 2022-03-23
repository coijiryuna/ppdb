<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterModel;
use App\Models\PengaturanModel;
use App\Models\SekolahModel;
use App\Models\ContactModel;
use App\Models\JenjangModel;
use App\Models\InfoModel;
use App\Models\JurusanModel;
use App\Models\DatapendaftarModel;

use App\Libraries\Ciqrcode;

use function bin2hex;
use function file_exists;
use function mkdir;

class Home extends BaseController
{
    protected $pengaturanModel;
    protected $validation;
    protected $registerModel;
    protected $sekolahModel;
    protected $contactModel;
    protected $infoModel;
    protected $jenjangModel;
    protected $jurusanModel;
    protected $daftar;
    protected $session;
    protected $ciqrcode;



    public function __construct()
    {
        $this->ciqrcode         = new Ciqrcode();
        $this->pengaturanModel  = new PengaturanModel();
        $this->registerModel    = new RegisterModel();
        $this->sekolahModel     = new SekolahModel();
        $this->contactModel     = new ContactModel();
        $this->infoModel        = new InfoModel();
        $this->jenjangModel     = new JenjangModel();
        $this->jurusanModel     = new JurusanModel();
        $this->daftar           = new DatapendaftarModel();
        $this->validation       =  \Config\Services::validation();
        $this->session          = \Config\Services::session();
    }
    public function index()
    {

        $data = [
            'school'       => $this->sekolahModel->getData()->where('tbl_sekolah.id = 1')->first(),
            'kontak'       => $this->contactModel->findAll(),
            'info'         => $this->infoModel->where('id', 1)->first(),
            'set'          => $this->pengaturanModel->get_data()->where('tbl_setting.id', 1)->first(),
            'controller'   => 'home',
            'name'         => session()->get("nama"),
        ];
        if (session()->get('loggedin')) {
            return redirect()->to(base_url('ppdb/data/cek'));
        } else {
            return view('ppdb/home', $data);
        }
    }
    public function getJurusan()
    {
        $data = $this->jurusanModel->findAll();
        return $this->response->setJSON($data);
    }

    public function add()
    {
        $set = $this->pengaturanModel->where('id', 1)->first();
        $response = array();
        $fields['nik']      = $this->request->getPost('nik');
        $fields['nisn']     = $this->request->getPost('nisn');
        $fields['nama']     = $this->request->getPost('nama');
        $fields['email']    = $this->request->getPost('email');
        $fields['telp']     = $this->request->getPost('telp');
        $fields['par']      = $this->request->getPost('par');
        $fields['no_qr']    = $this->request->getPost('nik') . date('dmy');
        $fields['jalur']    = $set->jalur;

        $format = $fields['nik'] . $fields['nisn'];

        $this->validation->setRules([
            'nik'       => ['label' => 'NIK', 'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[tbl_pendaftar.nik]'],
            'nisn'      => ['label' => 'NISN', 'rules' => 'required|numeric|max_length[12]|is_unique[tbl_pendaftar.nisn]'],
            'nama'      => ['label' => 'Nama', 'rules' => 'required'],
            'email'     => ['label' => 'Email', 'rules' => 'permit_empty'],
            'telp'      => ['label' => 'Telphone', 'rules' => 'required|numeric|max_length[13]'],
            'par'       => ['label' => 'Jenjang', 'rules' => 'required'],
            'jalur'     => ['label' => 'Jalur', 'rules' => 'required'],

        ]);
        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->registerModel->insert($fields)) {

                $id = $this->registerModel->getInsertID();
                $hs['id_daf'] = $id;
                $hs['nik']      = $this->request->getPost('nik');
                $hs['nisn']     = $this->request->getPost('nisn');
                $hs['nama']     = $this->request->getPost('nama');
                $hs['no_reg']   = $this->request->getPost('nik') . date('dmy');
                $hs['jalur']    = $set->jalur;
                $this->daftar->insert($hs);

                // signature Qrcode
                $qr     = $format . substr(md5($format), 0, 10);
                $data   = $this->generate_qrcode($qr);
                // update signature
                $this->registerModel->update($id, $data);

                $response['success'] = true;
                $response['messages'] = 'Pendaftaran Berhasil Silakan Login';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }
        return $this->response->setJSON($response);
    }

    function generate_qrcode($data)
    {

        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data . '.png';

        /* QR Code File Directory Initialize */
        $dir = 'qrcode/awal/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [255, 255, 255];
        $config['white']        = [255, 255, 255];
        $this->ciqrcode->initialize($config);

        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $save_name;

        $this->ciqrcode->generate($params);

        /* Return Data */
        return [
            'enc_qr'        => $data,
            'qr_code'       => $save_name,
        ];
    }
}
