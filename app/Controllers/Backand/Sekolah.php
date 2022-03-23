<?php

namespace App\Controllers\Backand;

use App\Controllers\BaseController;
use App\Models\SekolahModel;

class Sekolah extends BaseController
{
    protected $sekolahModel;
    protected $validation;

    public function __construct()
    {
        $this->sekolahModel = new SekolahModel();
        $this->validation   =  \Config\Services::validation();
    }

    public function getOne()
    {
        $id = $this->request->getPost('id');
        if ($this->validation->check($id, 'required|numeric')) {
            $data = $this->sekolahModel->getData()->where('tbl_sekolah.id', $id)->first();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function edit()
    {
        $response = array();
        $logo               = $this->request->getFile('logo');
        $ban1               = $this->request->getFile('baner1');
        $ban2               = $this->request->getFile('baner2');

        $oldlogo            = $this->request->getPost('oldlogo');
        $oldban1            = $this->request->getPost('oldban1');
        $oldban2            = $this->request->getPost('oldban2');

        $flogo              = $logo->getRandomName();
        $fban1              = $ban1->getRandomName();
        $fban2              = $ban2->getRandomName();

        $fields['id']       = 1;
        $fields['visi']     = $this->request->getPost('visi');
        $fields['nama']     = $this->request->getPost('sekolah');
        $fields['alamat']   = $this->request->getPost('alamat');
        $fields['kecamatan'] = $this->request->getPost('kecamatan');
        $fields['kabupaten'] = $this->request->getPost('kabupaten');
        $fields['provinsi'] = $this->request->getPost('provinsi');
        $fields['email']    = $this->request->getPost('email');
        $fields['maps']     = $this->request->getPost('maps');

        if ($logo->getError() == 4) {
            $fields['logo'] = $oldlogo;
        } else {
            $fields['logo'] = $flogo;
        }
        if ($ban1->getError() == 4) {
            $fields['baner1'] = $oldban1;
        } else {
            $fields['baner1'] = $fban1;
        }
        if ($ban2->getError() == 4) {
            $fields['baner2'] = $oldban2;
        } else {
            $fields['baner2'] = $fban2;
        }

        $this->validation->setRules([
            'visi'          => ['label' => 'Visi', 'rules'      => 'permit_empty'],
            'nama'          => ['label' => 'Nama', 'rules'      => 'permit_empty'],
            'alamat'        => ['label' => 'Alamat', 'rules'    => 'permit_empty'],
            'kecamatan'     => ['label' => 'Kecamatan', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'kabupaten'     => ['label' => 'Kabupaten', 'rules' => 'permit_empty|numeric|max_length[11]'],
            'provinsi'      => ['label' => 'Provinsi', 'rules'  => 'permit_empty|numeric|max_length[11]'],
            'email'         => ['label' => 'Email', 'rules'     => 'permit_empty'],
            'maps'          => ['label' => 'Maps', 'rules'      => 'permit_empty'],
            'logo'          => ['label' => 'Logo', 'rules'      => 'mime_in[logo,image/jpg,image/jpeg,image/gif,image/png]|is_image[logo]|max_size[logo,1028]'],
            'baner1'        => ['label' => 'Gambar 1', 'rules'  => 'mime_in[baner1,image/jpg,image/jpeg,image/gif,image/png]|is_image[baner1]|max_size[baner1,1028]'],
            'baner2'        => ['label' => 'Gambar 2', 'rules'  => 'mime_in[baner2,image/jpg,image/jpeg,image/gif,image/png]|is_image[baner2]|max_size[baner2,1028]'],

        ]);
        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->sekolahModel->update($fields['id'], $fields)) {
                $response['success']    = true;
                $response['messages']   = 'Data Sekolah berhasil disimpan..!';
                if ($oldlogo != 'logo.png') {
                    unlink('gambar/' . $oldlogo);
                }
                if (!$logo->getError() == 4) {
                    $logo->move('gambar/', $flogo);
                }
                if ($oldban1 != 'slide-1.png') {
                    unlink('gambar/' . $oldban1);
                }
                if (!$ban1->getError() == 4) {
                    $ban1->move('gambar/', $fban1);
                }
                if ($oldban2 != 'slide-2.jpg') {
                    unlink('gambar/' . $oldban2);
                }
                if (!$ban2->getError() == 4) {
                    $ban2->move('gambar/', $fban2);
                }
            } else {
                $response['success']    = false;
                $response['messages']   = 'Update error!';
            }
        }
        return $this->response->setJSON($response);
    }
}
