<?php

namespace App\Controllers\Backand;

use App\Controllers\BaseController;

use App\Models\DatapendaftarModel;
use App\Models\RegisterModel;
use App\Entities\Collection;
use CodeIgniter\API\ResponseTrait;

class Datapendaftar extends BaseController
{
    use ResponseTrait;
    protected $datapendaftarModel;
    protected $registerModel;
    protected $validation;

    public function __construct()
    {
        $this->registerModel        = new RegisterModel();
        $this->datapendaftarModel   = new DatapendaftarModel();
        $this->validation           =  \Config\Services::validation();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $start  = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order  = DatapendaftarModel::ORDERABLE[$this->request->getGet('order[0][column]')];
            $dir    = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                $this->datapendaftarModel->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
                $this->datapendaftarModel->getResource()->countAllResults(),
                $this->datapendaftarModel->getResource($search)->countAllResults()
            ));
        }

        $data = [
            'controller'        => 'backand/datapendaftar',
            'title'             => 'Data Pendaftar'
        ];

        return view('admin/backend/datasiswa', $data);
    }
    public function get_prog0()
    {
        if ($this->request->isAJAX()) {
            $start  = $this->request->getGet('start');
            $length = $this->request->getGet('length');
            $search = $this->request->getGet('search[value]');
            $order  = RegisterModel::ORDERABLE[$this->request->getGet('order[0][column]')];
            $dir    = $this->request->getGet('order[0][dir]');

            return $this->respond(Collection::datatable(
                $this->registerModel->getResources($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
                $this->registerModel->getResources()->countAllResults(),
                $this->registerModel->getResources($search)->countAllResults()
            ));
        }
    }
    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('id');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->datapendaftarModel->where('id', $id)->first();

            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {

        $response = array();

        $fields['id'] = $this->request->getPost('id');
        $fields['jk'] = $this->request->getPost('jk');
        $fields['tmp_lahir'] = $this->request->getPost('tmptlahir');
        $fields['tgl_lahir'] = $this->request->getPost('tgllahir');
        $fields['agama'] = $this->request->getPost('agama');
        $fields['alamat'] = $this->request->getPost('alamat');
        $fields['rt'] = $this->request->getPost('rt');
        $fields['rw'] = $this->request->getPost('rw');
        $fields['dusun'] = $this->request->getPost('dusun');
        $fields['kelurahan'] = $this->request->getPost('kelurahan');
        $fields['kecamatan'] = $this->request->getPost('kecamatan');
        $fields['kabupaten'] = $this->request->getPost('kabupaten');
        $fields['provinsi'] = $this->request->getPost('provinsi');
        $fields['sts_tinggal'] = $this->request->getPost('stsTinggal');
        $fields['anak_ke'] = $this->request->getPost('anakke');
        $fields['jml_sdr'] = $this->request->getPost('jmlsdr');
        $fields['nm_ayh'] = $this->request->getPost('nmayh');
        $fields['pend_ayh'] = $this->request->getPost('Pekerjaan');
        $fields['hasil_ayh'] = $this->request->getPost('hasilayh');
        $fields['nm_ibu'] = $this->request->getPost('nmIbu');
        $fields['pend_ibu'] = $this->request->getPost('pendIbu');
        $fields['kerja_ibu'] = $this->request->getPost('krjibu');
        $fields['hasil_ibu'] = $this->request->getPost('hasilIbu');
        $fields['nm_wl'] = $this->request->getPost('nmWl');
        $fields['pend_wl'] = $this->request->getPost('pendWl');
        $fields['kerja_wl'] = $this->request->getPost('kerjaWl');
        $fields['hasil_wl'] = $this->request->getPost('hasilWl');
        $fields['no_un'] = $this->request->getPost('noUn');
        $fields['no_skhun'] = $this->request->getPost('noSkhun');
        $fields['no_ijazah'] = $this->request->getPost('noIjazah');
        $fields['no_kps'] = $this->request->getPost('noKps');
        $fields['no_kip'] = $this->request->getPost('noKip');
        $fields['no_kis'] = $this->request->getPost('noKis');
        $fields['no_pkh'] = $this->request->getPost('noPkh');
        $fields['skl_asal'] = $this->request->getPost('sklAsal');
        $fields['almt_skl'] = $this->request->getPost('almtSkl');
        $fields['jalur'] = $this->request->getPost('jalur');


        $this->validation->setRules([
            'jk' => ['label' => 'Jenis Kelamin', 'rules' => 'required|max_length[50]'],
            'tmp_lahir' => ['label' => 'Tempat Lahir', 'rules' => 'required|max_length[100]'],
            'tgl_lahir' => ['label' => 'Tanggal Lahir', 'rules' => 'required|valid_date'],
            'agama' => ['label' => 'Agama', 'rules' => 'required|max_length[20]'],
            'alamat' => ['label' => 'Alamat', 'rules' => 'required|max_length[100]'],
            'rt' => ['label' => 'RT', 'rules' => 'required|max_length[3]'],
            'rw' => ['label' => 'RW', 'rules' => 'required|max_length[3]'],
            'dusun' => ['label' => 'Dusun', 'rules' => 'required|max_length[100]'],
            'kelurahan' => ['label' => 'Kelurahan', 'rules' => 'required|max_length[100]'],
            'kecamatan' => ['label' => 'Kecamatan', 'rules' => 'required|max_length[100]'],
            'kabupaten' => ['label' => 'Kabupaten', 'rules' => 'required|max_length[100]'],
            'provinsi' => ['label' => 'Provinsi', 'rules' => 'required|max_length[100]'],
            'sts_tinggal' => ['label' => 'Status Tinggal', 'rules' => 'required|max_length[50]'],
            'anak_ke' => ['label' => 'Anak ke', 'rules' => 'required|max_length[2]'],
            'jml_sdr' => ['label' => 'Jumlah Saudara', 'rules' => 'required|max_length[2]'],
            'nm_ayh' => ['label' => 'Nama Ayah', 'rules' => 'required'],
            'pend_ayh' => ['label' => 'Pendidikan Ayah', 'rules' => 'required'],
            'hasil_ayh' => ['label' => 'Penghasilan Ayah', 'rules' => 'required|max_length[50]'],
            'nm_ibu' => ['label' => 'Nama Ibu', 'rules' => 'required'],
            'pend_ibu' => ['label' => 'Pendidikan Ibu', 'rules' => 'required|max_length[20]'],
            'kerja_ibu' => ['label' => 'Pekerjaan Ibu', 'rules' => 'required'],
            'hasil_ibu' => ['label' => 'Penghasilan Ibu', 'rules' => 'required|max_length[50]'],
            'nm_wl' => ['label' => 'Nama Wali', 'rules' => 'required'],
            'pend_wl' => ['label' => 'Pendidikan Wali', 'rules' => 'required|max_length[20]'],
            'kerja_wl' => ['label' => 'Pekerjaan wali', 'rules' => 'required|max_length[100]'],
            'hasil_wl' => ['label' => 'Penghasilan Wali', 'rules' => 'required|max_length[50]'],
            'no_un' => ['label' => 'No UN', 'rules' => 'required|max_length[30]'],
            'no_skhun' => ['label' => 'No SKHUN', 'rules' => 'required|max_length[30]'],
            'no_ijazah' => ['label' => 'No Ijazah', 'rules' => 'required|max_length[30]'],
            'no_kps' => ['label' => 'No KPS', 'rules' => 'required|max_length[25]'],
            'no_kip' => ['label' => 'No KIP', 'rules' => 'required|max_length[25]'],
            'no_kis' => ['label' => 'No KIS', 'rules' => 'required|max_length[25]'],
            'no_pkh' => ['label' => 'No PKH', 'rules' => 'required|max_length[25]'],
            'skl_asal' => ['label' => 'Sekolah Asal', 'rules' => 'required'],
            'almt_skl' => ['label' => 'Alamat Sekolah', 'rules' => 'required'],
            'jalur' => ['label' => 'Jalur', 'rules' => 'required|max_length[25]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->datapendaftarModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function edit()
    {

        $response = array();

        $fields['id'] = $this->request->getPost('id');
        $fields['jk'] = $this->request->getPost('jk');
        $fields['tmp_lahir'] = $this->request->getPost('tmptlahir');
        $fields['tgl_lahir'] = $this->request->getPost('tgllahir');
        $fields['agama'] = $this->request->getPost('agama');
        $fields['alamat'] = $this->request->getPost('alamat');
        $fields['rt'] = $this->request->getPost('rt');
        $fields['rw'] = $this->request->getPost('rw');
        $fields['dusun'] = $this->request->getPost('dusun');
        $fields['kelurahan'] = $this->request->getPost('kelurahan');
        $fields['kecamatan'] = $this->request->getPost('kecamatan');
        $fields['kabupaten'] = $this->request->getPost('kabupaten');
        $fields['provinsi'] = $this->request->getPost('provinsi');
        $fields['sts_tinggal'] = $this->request->getPost('stsTinggal');
        $fields['anak_ke'] = $this->request->getPost('anakke');
        $fields['jml_sdr'] = $this->request->getPost('jmlsdr');
        $fields['nm_ayh'] = $this->request->getPost('nmayh');
        $fields['pend_ayh'] = $this->request->getPost('Pekerjaan');
        $fields['hasil_ayh'] = $this->request->getPost('hasilayh');
        $fields['nm_ibu'] = $this->request->getPost('nmIbu');
        $fields['pend_ibu'] = $this->request->getPost('pendIbu');
        $fields['kerja_ibu'] = $this->request->getPost('krjibu');
        $fields['hasil_ibu'] = $this->request->getPost('hasilIbu');
        $fields['nm_wl'] = $this->request->getPost('nmWl');
        $fields['pend_wl'] = $this->request->getPost('pendWl');
        $fields['kerja_wl'] = $this->request->getPost('kerjaWl');
        $fields['hasil_wl'] = $this->request->getPost('hasilWl');
        $fields['no_un'] = $this->request->getPost('noUn');
        $fields['no_skhun'] = $this->request->getPost('noSkhun');
        $fields['no_ijazah'] = $this->request->getPost('noIjazah');
        $fields['no_kps'] = $this->request->getPost('noKps');
        $fields['no_kip'] = $this->request->getPost('noKip');
        $fields['no_kis'] = $this->request->getPost('noKis');
        $fields['no_pkh'] = $this->request->getPost('noPkh');
        $fields['skl_asal'] = $this->request->getPost('sklAsal');
        $fields['almt_skl'] = $this->request->getPost('almtSkl');
        $fields['jalur'] = $this->request->getPost('jalur');


        $this->validation->setRules([
            'jk' => ['label' => 'Jenis Kelamin', 'rules' => 'required|max_length[50]'],
            'tmp_lahir' => ['label' => 'Tempat Lahir', 'rules' => 'required|max_length[100]'],
            'tgl_lahir' => ['label' => 'Tanggal Lahir', 'rules' => 'required|valid_date'],
            'agama' => ['label' => 'Agama', 'rules' => 'required|max_length[20]'],
            'alamat' => ['label' => 'Alamat', 'rules' => 'required|max_length[100]'],
            'rt' => ['label' => 'RT', 'rules' => 'required|max_length[3]'],
            'rw' => ['label' => 'RW', 'rules' => 'required|max_length[3]'],
            'dusun' => ['label' => 'Dusun', 'rules' => 'required|max_length[100]'],
            'kelurahan' => ['label' => 'Kelurahan', 'rules' => 'required|max_length[100]'],
            'kecamatan' => ['label' => 'Kecamatan', 'rules' => 'required|max_length[100]'],
            'kabupaten' => ['label' => 'Kabupaten', 'rules' => 'required|max_length[100]'],
            'provinsi' => ['label' => 'Provinsi', 'rules' => 'required|max_length[100]'],
            'sts_tinggal' => ['label' => 'Status Tinggal', 'rules' => 'required|max_length[50]'],
            'anak_ke' => ['label' => 'Anak ke', 'rules' => 'required|max_length[2]'],
            'jml_sdr' => ['label' => 'Jumlah Saudara', 'rules' => 'required|max_length[2]'],
            'nm_ayh' => ['label' => 'Nama Ayah', 'rules' => 'required'],
            'pend_ayh' => ['label' => 'Pendidikan Ayah', 'rules' => 'required'],
            'hasil_ayh' => ['label' => 'Penghasilan Ayah', 'rules' => 'required|max_length[50]'],
            'nm_ibu' => ['label' => 'Nama Ibu', 'rules' => 'required'],
            'pend_ibu' => ['label' => 'Pendidikan Ibu', 'rules' => 'required|max_length[20]'],
            'kerja_ibu' => ['label' => 'Pekerjaan Ibu', 'rules' => 'required'],
            'hasil_ibu' => ['label' => 'Penghasilan Ibu', 'rules' => 'required|max_length[50]'],
            'nm_wl' => ['label' => 'Nama Wali', 'rules' => 'required'],
            'pend_wl' => ['label' => 'Pendidikan Wali', 'rules' => 'required|max_length[20]'],
            'kerja_wl' => ['label' => 'Pekerjaan wali', 'rules' => 'required|max_length[100]'],
            'hasil_wl' => ['label' => 'Penghasilan Wali', 'rules' => 'required|max_length[50]'],
            'no_un' => ['label' => 'No UN', 'rules' => 'required|max_length[30]'],
            'no_skhun' => ['label' => 'No SKHUN', 'rules' => 'required|max_length[30]'],
            'no_ijazah' => ['label' => 'No Ijazah', 'rules' => 'required|max_length[30]'],
            'no_kps' => ['label' => 'No KPS', 'rules' => 'required|max_length[25]'],
            'no_kip' => ['label' => 'No KIP', 'rules' => 'required|max_length[25]'],
            'no_kis' => ['label' => 'No KIS', 'rules' => 'required|max_length[25]'],
            'no_pkh' => ['label' => 'No PKH', 'rules' => 'required|max_length[25]'],
            'skl_asal' => ['label' => 'Sekolah Asal', 'rules' => 'required'],
            'almt_skl' => ['label' => 'Alamat Sekolah', 'rules' => 'required'],
            'jalur' => ['label' => 'Jalur', 'rules' => 'required|max_length[25]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->datapendaftarModel->update($fields['id'], $fields)) {

                $response['success'] = true;
                $response['messages'] = 'Successfully updated';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Update error!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('id');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {

            if ($this->datapendaftarModel->where('id', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Deletion error!';
            }
        }

        return $this->response->setJSON($response);
    }
}
