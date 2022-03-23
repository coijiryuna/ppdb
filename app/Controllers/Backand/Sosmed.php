<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SosmedModel;

class Sosmed extends BaseController
{
	protected $sosmedModel;
	protected $validation;

	public function __construct()
	{
		$this->sosmedModel = new SosmedModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller'    	=> 'sosmed',
			'title'     		=> 'Sosmed'
		];
		return view('sosmed', $data);
	}

	public function getAll()
	{
		$data['data'] = array();
		$result = $this->sosmedModel->select('id, icon, url')->findAll();
		foreach ($result as $key => $value) {
			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			$data['data'][$key] = array(
				$value->id,
				$value->icon,
				$value->url,
				$ops,
			);
		}
		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$id = $this->request->getPost('id');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->sosmedModel->where('id', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id'] = $this->request->getPost('id');
		$fields['icon'] = $this->request->getPost('icon');
		$fields['url'] = $this->request->getPost('url');

		$this->validation->setRules([
			'icon' => ['label' => 'Icon', 'rules' => 'required'],
			'url' => ['label' => 'Url', 'rules' => 'required'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->sosmedModel->insert($fields)) {
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
		$fields['icon'] = $this->request->getPost('icon');
		$fields['url'] = $this->request->getPost('url');

		$this->validation->setRules([
			'icon' => ['label' => 'Icon', 'rules' => 'required'],
			'url' => ['label' => 'Url', 'rules' => 'required'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->sosmedModel->update($fields['id'], $fields)) {
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
			if ($this->sosmedModel->where('id', $id)->delete()) {
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
