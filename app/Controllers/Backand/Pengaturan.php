<?php

namespace App\Controllers\Backand;

use App\Controllers\BaseController;
use App\Models\PengaturanModel;
use App\Models\ProvinsiModel;
use App\Models\KabupatenModel;
use App\Models\KecamatanModel;
use App\Models\JenjangModel;
use App\Models\InfoModel;
use App\Models\SekolahModel;
use App\Models\SyaratModel;
use App\Models\ContactModel;
use App\Models\JurusanModel;

use App\Entities\Collection;
use CodeIgniter\API\ResponseTrait;

class Pengaturan extends BaseController
{
	use ResponseTrait;
	protected $syaratModel;
	protected $pengaturanModel;
	protected $provinsiModel;
	protected $kabupatenModel;
	protected $kecamatanModel;
	protected $jenjangModel;
	protected $infoModel;
	protected $sekolahModel;
	protected $contactModel;
	protected $jurusanModel;

	protected $validation;

	public function __construct()
	{
		$this->pengaturanModel	= new PengaturanModel();
		$this->provinsiModel 	= new ProvinsiModel();
		$this->kabupatenModel 	= new KabupatenModel();
		$this->kecamatanModel	= new KecamatanModel();
		$this->jenjangModel		= new JenjangModel();
		$this->infoModel		= new InfoModel();
		$this->sekolahModel		= new SekolahModel();
		$this->syaratModel 		= new SyaratModel();
		$this->contactModel 	= new ContactModel();
		$this->jurusanModel 	= new JurusanModel();
		$this->validation 		=  \Config\Services::validation();
	}
	public function index()
	{
		$data = [
			'controller'    => 'backand/pengaturan',
			'sekolah'		=> 'backand/sekolah',
			'title'         => 'Pengaturan PPDB Sekolah',
		];
		return view('admin/backend/pengaturan', $data);
	}
	public function jenjang()
	{
		$data = $this->jenjangModel->findAll();
		return $this->response->setJSON($data);
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
	public function getOne()
	{
		$id = 1;
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->pengaturanModel->where('id', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
	public function getinfo()
	{
		$id = 1;
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->infoModel->where('id', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
	public function edit()
	{
		$response = array();
		$fields['id'] = $this->request->getPost('id');
		$fields['jenjang'] = $this->request->getPost('jenjang');
		$fields['tapel'] = $this->request->getPost('tapel');
		$fields['semester'] = $this->request->getPost('semester');
		$fields['register'] = $this->request->getPost('register');
		$fields['pengumuman'] = $this->request->getPost('pengumuman');
		$fields['jalur'] = $this->request->getPost('jalur');

		$this->validation->setRules([
			'jenjang' => ['label' => 'Jenjang', 'rules' => 'permit_empty|max_length[11]'],
			'tapel' => ['label' => 'Tahun Pelajaran', 'rules' => 'required|max_length[10]'],
			'semester' => ['label' => 'Semester', 'rules' => 'required|max_length[10]'],
			'register' => ['label' => 'Register', 'rules' => 'required|max_length[10]'],
			'pengumuman' => ['label' => 'Pengumuman', 'rules' => 'required|max_length[1000]'],
			'jalur' => ['label' => 'Jalur', 'rules' => 'required|max_length[10]'],

		]);
		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->pengaturanModel->update($fields['id'], $fields)) {
				$response['success'] = true;
				$response['messages'] = 'Pengaturan PPDB berhasil disimpan';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function simpan()
	{
		$response = array();

		$fields['id'] 		= 1;
		$fields['jenjang'] 	= $this->request->getPost('jenjang');
		$fields['tapel'] 	= $this->request->getPost('tapel');
		$fields['semester'] = $this->request->getPost('semester');
		$fields['jalur'] 	= $this->request->getPost('jalur');

		$info['info'] 		= $this->request->getPost('info');

		$this->validation->setRules([
			'jenjang' 		=> ['label' => 'Jenjang', 'rules' => 'required|max_length[11]'],
			'tapel' 		=> ['label' => 'Tahun Pelajaran', 'rules' => 'required'],
			'semester' 		=> ['label' => 'Semester', 'rules' => 'required'],
			'jalur' 		=> ['label' => 'Jalur', 'rules' => 'required'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->pengaturanModel->update($fields['id'], $fields)) {
				$response['success'] = true;
				$response['messages'] = 'Pengaturan PPDB berhasil disimpan';

				$this->sekolahModel->update($fields['id'], $info);
				$this->info();
			} else {
				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function info()
	{
		$response = array();
		$fields['id'] 		= 1;
		$oldbros          	= $this->request->getPost('oldbros');
		$brosur 			= $this->request->getFile('brosur');
		$fbros              = $brosur->getRandomName();

		$fields['status'] 	= $this->request->getPost('status');

		if ($brosur->getError() == 4) {
			$fields['brosur'] = $oldbros;
		} else {
			$fields['brosur'] = $fbros;
		}
		$this->validation->setRules([
			'status' => ['label' => 'Status', 'rules' => 'permit_empty'],
			'brosur' => ['label' => 'Brosur', 'rules' => 'permit_empty'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->infoModel->update($fields['id'], $fields)) {
				$response['success'] = true;
				$response['messages'] = 'Pengaturan PPDB berhasil disimpan';

				if (!$brosur->getError() == 4) {
					$brosur->move('brosur/', $fbros);
					unlink('brosur/' . $oldbros);
				}
			} else {
				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}
		return $this->response->setJSON($response);
	}

	// persyaratan
	public function get_syarat()
	{
		if ($this->request->isAJAX()) {
			$start = $this->request->getGet('start');
			$length = $this->request->getGet('length');
			$search = $this->request->getGet('search[value]');
			$order = SyaratModel::ORDERABLE[$this->request->getGet('order[0][column]')];
			$dir = $this->request->getGet('order[0][dir]');

			return $this->respond(Collection::datatable(
				$this->syaratModel->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
				$this->syaratModel->getResource()->countAllResults(),
				$this->syaratModel->getResource($search)->countAllResults()
			));
		}
	}
	public function getEdit()
	{
		$id = $this->request->getPost('id_sy');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->syaratModel->where('id_sy', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
	public function add_syarat()
	{
		$response = array();
		$fields['sarat'] = $this->request->getPost('sarat');

		$this->validation->setRules([
			'sarat' => ['label' => 'Persyaratan PPDB', 'rules' => 'required'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->syaratModel->insert($fields)) {
				$response['success'] = true;
				$response['messages'] = 'Data persyaratan PPDB berhasil disimpan';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Insertion error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function edit_syarat()
	{
		$response = array();
		$fields['id_sy'] = $this->request->getPost('id_sy');
		$fields['sarat'] = $this->request->getPost('sarat');

		$this->validation->setRules([
			'sarat' => ['label' => 'Persyaratan PPDB', 'rules' => 'required'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->syaratModel->update($fields['id_sy'], $fields)) {
				$response['success'] = true;
				$response['messages'] = 'Data persyaratan PPDB berhasil diubah';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function remove_syarat()
	{
		$response = array();
		$id = $this->request->getPost('id');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->syaratModel->where('id_sy', $id)->delete()) {
				$response['success'] = true;
				$response['messages'] = 'Data berhasil dihapus';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}

		return $this->response->setJSON($response);
	}

	// Jurusan 
	public function get_jur()
	{
		if ($this->request->isAJAX()) {
			$start = $this->request->getGet('start');
			$length = $this->request->getGet('length');
			$search = $this->request->getGet('search[value]');
			$order = JurusanModel::ORDERABLE[$this->request->getGet('order[0][column]')];
			$dir = $this->request->getGet('order[0][dir]');

			return $this->respond(Collection::datatable(
				$this->jurusanModel->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
				$this->jurusanModel->getResource()->countAllResults(),
				$this->jurusanModel->getResource($search)->countAllResults()
			));
		}
	}
	public function get_jurusan()
	{
		$id = $this->request->getPost('id');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->jurusanModel->where('id', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
	public function add_jurusan()
	{
		$response = array();
		$fields['jurusan'] = $this->request->getPost('jurusan');

		$this->validation->setRules([
			'jurusan' => ['label' => 'Jurusan', 'rules' => 'permit_empty'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->jurusanModel->insert($fields)) {
				$response['success'] = true;
				$response['messages'] = 'Data Jurusan berhasil disimpan';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Insertion error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function edit_jurusan()
	{
		$response = array();
		$fields['id'] = $this->request->getPost('id');
		$fields['jurusan'] = $this->request->getPost('jurusan');

		$this->validation->setRules([
			'jurusan' => ['label' => 'Jurusan', 'rules' => 'permit_empty'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->jurusanModel->update($fields['id'], $fields)) {
				$response['success'] = true;
				$response['messages'] = 'Data Jurusan berhasil diubah';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function remove_jurusan()
	{
		$response = array();
		$id = $this->request->getPost('id');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->jurusanModel->where('id', $id)->delete()) {
				$response['success'] = true;
				$response['messages'] = 'Data Jurusan berhasil dihapus';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}
		return $this->response->setJSON($response);
	}

	// contact 
	public function get_cont()
	{
		if ($this->request->isAJAX()) {
			$start = $this->request->getGet('start');
			$length = $this->request->getGet('length');
			$search = $this->request->getGet('search[value]');
			$order = ContactModel::ORDERABLE[$this->request->getGet('order[0][column]')];
			$dir = $this->request->getGet('order[0][dir]');

			return $this->respond(Collection::datatable(
				$this->contactModel->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject(),
				$this->contactModel->getResource()->countAllResults(),
				$this->contactModel->getResource($search)->countAllResults()
			));
		}
	}
	public function get_ct()
	{
		$id = $this->request->getPost('id');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->contactModel->where('id', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}
	public function add_ct()
	{
		$response = array();
		$fields['nama'] = $this->request->getPost('nama');
		$fields['telp'] = $this->request->getPost('telp');

		$this->validation->setRules([
			'nama' => ['label' => 'Nama', 'rules' => 'permit_empty'],
			'telp' => ['label' => 'Telp', 'rules' => 'permit_empty|max_length[13]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->contactModel->insert($fields)) {
				$response['success'] = true;
				$response['messages'] = 'Data Kontak berhasil disimpan';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Insertion error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function edit_ct()
	{
		$response = array();
		$fields['id'] = $this->request->getPost('id');
		$fields['nama'] = $this->request->getPost('nama');
		$fields['telp'] = $this->request->getPost('telp');

		$this->validation->setRules([
			'nama' => ['label' => 'Nama', 'rules' => 'permit_empty'],
			'telp' => ['label' => 'Telp', 'rules' => 'permit_empty|max_length[13]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->contactModel->update($fields['id'], $fields)) {
				$response['success'] = true;
				$response['messages'] = 'Data Kontak berhasil diubah';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}
		return $this->response->setJSON($response);
	}
	public function remove_ct()
	{
		$response = array();
		$id = $this->request->getPost('id');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->contactModel->where('id', $id)->delete()) {
				$response['success'] = true;
				$response['messages'] = 'Data Kontak berhasil dihapus';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}
		return $this->response->setJSON($response);
	}
}
