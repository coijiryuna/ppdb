<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DatapendaftarModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\DesaModel;
use App\Libraries\Ciqrcode;

use function bin2hex;
use function file_exists;
use function mkdir;

class Datapendaftar extends BaseController
{

    protected $datapendaftarModel;
    protected $provinsiModel;
    protected $kabupatenModel;
    protected $kecamatanModel;
    protected $desaModel;
    protected $validation;
    protected $ciqrcode;

    public function __construct()
    {
        $this->ciqrcode             = new Ciqrcode();
        $this->datapendaftarModel   = new DatapendaftarModel();
        $this->provinsiModel        = new ProvinsiModel();
        $this->kabupatenModel       = new KabupatenModel();
        $this->kecamatanModel       = new KecamatanModel();
        $this->desaModel            = new DesaModel();
        $this->validation           = \Config\Services::validation();
    }

    public function getProv()
    {
        $data = $this->provinsiModel->findAll();
        return $this->response->setJSON($data);
    }

    public function getKab()
    {
        $id = $this->request->getPost('id');
        if ($this->validation->check($id, 'required|numeric')) {
            $data = $this->kabupatenModel->where('provinsi_id', $id)->findAll();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function getKec()
    {
        $id = $this->request->getPost('id');
        if ($this->validation->check($id, 'required|numeric')) {
            $data = $this->kecamatanModel->where('kabupaten_id', $id)->findAll();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function getDes()
    {
        $id = $this->request->getPost('id');
        if ($this->validation->check($id, 'required|numeric')) {
            $data = $this->desaModel->where('kecamatan_id', $id)->findAll();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {

        $response = array();

        $fields['id']           = $this->request->getPost('id');
        $fields['nama']         = session()->get('nama');
        $fields['nik']          = session()->get('nik');
        $fields['nisn']         = session()->get('nisn');
        $fields['no_reg']       = session()->get('no_reg');
        $fields['jk']           = $this->request->getPost('jk');
        $fields['tmp_lahir']    = $this->request->getPost('tmptlahir');
        $fields['tgl_lahir']    = $this->request->getPost('tgllahir');
        $fields['agama']        = $this->request->getPost('agama');
        $fields['alamat']       = $this->request->getPost('alamat');
        $fields['rt']           = $this->request->getPost('rt');
        $fields['rw']           = $this->request->getPost('rw');
        $fields['dusun']        = $this->request->getPost('dusun');
        $fields['kelurahan']    = $this->request->getPost('kelurahan');
        $fields['kecamatan']    = $this->request->getPost('kecamatan');
        $fields['kabupaten']    = $this->request->getPost('kabupaten');
        $fields['provinsi']     = $this->request->getPost('provinsi');
        $fields['domisili']     = $this->request->getPost('domisili');
        $fields['skl_asal']     = $this->request->getPost('sklAsal');
        $fields['almt_skl']     = $this->request->getPost('almtSkl');

        $fields['sts_tinggal']  = $this->request->getPost('stsTinggal');
        $fields['anak_ke']      = $this->request->getPost('anakke');
        $fields['jml_sdr']      = $this->request->getPost('jmlsdr');
        $fields['nm_ayh']       = $this->request->getPost('nmayh');
        $fields['pend_ayh']     = $this->request->getPost('pendayah');
        $fields['kerja_ayh']    = $this->request->getPost('krjayah');
        $fields['hasil_ayh']    = $this->request->getPost('hasilayh');
        $fields['nm_ibu']       = $this->request->getPost('nmIbu');
        $fields['pend_ibu']     = $this->request->getPost('pendIbu');
        $fields['kerja_ibu']    = $this->request->getPost('krjibu');
        $fields['hasil_ibu']    = $this->request->getPost('hasilIbu');
        $fields['nm_wl']        = $this->request->getPost('nmWl');
        $fields['pend_wl']      = $this->request->getPost('pendWl');
        $fields['kerja_wl']     = $this->request->getPost('kerjaWl');
        $fields['hasil_wl']     = $this->request->getPost('hasilWl');
        $fields['alt_wl']       = $this->request->getPost('altWl');
        $fields['no_un']        = $this->request->getPost('noUn');
        $fields['no_skhun']     = $this->request->getPost('noSkhun');
        $fields['no_ijazah']    = $this->request->getPost('noIjazah');
        $fields['no_kps']       = $this->request->getPost('noKps');
        $fields['no_kip']       = $this->request->getPost('noKip');
        $fields['no_kis']       = $this->request->getPost('noKis');
        $fields['no_pkh']       = $this->request->getPost('noPkh');
        $fields['skl_asal']     = $this->request->getPost('sklAsal');
        $fields['almt_skl']     = $this->request->getPost('almtSkl');
        $fields['jalur']        = session()->get('jalur');
        $fields['progres']      = $this->request->getPost('progres');

        $this->validation->setRules([
            'jk'            => ['label' => 'Jenis Kelamin', 'rules' => 'required'],
            'tmp_lahir'     => ['label' => 'Tempat Lahir', 'rules' => 'required'],
            'tgl_lahir'     => ['label' => 'Tanggal Lahir', 'rules' => 'required|valid_date'],
            'agama'         => ['label' => 'Agama', 'rules' => 'required'],
            'alamat'        => ['label' => 'Alamat', 'rules' => 'required'],
            'rt'            => ['label' => 'RT', 'rules' => 'required|max_length[3]'],
            'rw'            => ['label' => 'RW', 'rules' => 'required|max_length[3]'],
            'dusun'         => ['label' => 'Dusun', 'rules' => 'required'],
            'kelurahan'     => ['label' => 'Kelurahan', 'rules' => 'required'],
            'kecamatan'     => ['label' => 'Kecamatan', 'rules' => 'required'],
            'kabupaten'     => ['label' => 'Kabupaten', 'rules' => 'required'],
            'provinsi'      => ['label' => 'Provinsi', 'rules' => 'required'],
            'domisili'      => ['label' => 'Domisili', 'rules' => 'permit_empty'],
            'skl_asal'      => ['label' => 'Sekolah Asal', 'rules' => 'required'],
            'almt_skl'      => ['label' => 'Alamat Sekolah', 'rules' => 'required'],

            'sts_tinggal'   => ['label' => 'Status Tinggal', 'rules' => 'required'],
            'anak_ke'       => ['label' => 'Anak ke', 'rules' => 'required|max_length[3]'],
            'jml_sdr'       => ['label' => 'Jumlah Saudara', 'rules' => 'required|max_length[3]'],
            'nm_ayh'        => ['label' => 'Nama Ayah', 'rules' => 'required'],
            'pend_ayh'      => ['label' => 'Pendidikan Ayah', 'rules' => 'required'],
            'hasil_ayh'     => ['label' => 'Penghasilan Ayah', 'rules' => 'required'],
            'nm_ibu'        => ['label' => 'Nama Ibu', 'rules' => 'required'],
            'pend_ibu'      => ['label' => 'Pendidikan Ibu', 'rules' => 'required'],
            'kerja_ibu'     => ['label' => 'Pekerjaan Ibu', 'rules' => 'required'],
            'hasil_ibu'     => ['label' => 'Penghasilan Ibu', 'rules' => 'required'],
            'nm_wl'         => ['label' => 'Nama Wali', 'rules' => 'permit_empty'],
            'pend_wl'       => ['label' => 'Pendidikan Wali', 'rules' => 'permit_empty'],
            'kerja_wl'      => ['label' => 'Pekerjaan wali', 'rules' => 'permit_empty'],
            'hasil_wl'      => ['label' => 'Penghasilan Wali', 'rules' => 'permit_empty'],
            'no_un'         => ['label' => 'No UN', 'rules' => 'permit_empty'],
            'no_skhun'      => ['label' => 'No SKHUN', 'rules' => 'permit_empty'],
            'no_ijazah'     => ['label' => 'No Ijazah', 'rules' => 'permit_empty'],
            'no_kps'        => ['label' => 'No KPS', 'rules' => 'permit_empty'],
            'no_kip'        => ['label' => 'No KIP', 'rules' => 'permit_empty'],
            'no_kis'        => ['label' => 'No KIS', 'rules' => 'permit_empty'],
            'no_pkh'        => ['label' => 'No PKH', 'rules' => 'permit_empty'],
            'jalur'         => ['label' => 'Jalur', 'rules' => 'required'],

        ]);
        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->datapendaftarModel->update($fields['id'], $fields)) {

                $response['success']    = true;
                $response['messages']   = 'Data Registrasi Data Diri Berhasil di Simpan..!';
                $response['direc']      = redirect()->to(base_url('ppdb/data'));
            } else {
                $response['success'] = false;
                $response['messages'] = 'Update error!';
            }
        }
        return $this->response->setJSON($response);
    }
}
