<?php

namespace App\Models;

use CodeIgniter\Model;

class RegisterModel extends Model
{

	protected $table = 'tbl_pendaftar';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['no_qr', 'nik', 'nisn', 'nama', 'email', 'telp', 'par', 'status', 'jalur', 'qr_code', 'enc_qr', 'deleted_at'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	const ORDERABLE = [
		1 => 'tbl_pendaftar.id',
		2 => 'created_at'
	];
	public function getResources(string $search = '')
	{
		$builder = $this->builder()
			->select('*')
			->join('db_data', 'tbl_pendaftar.id = db_data.id_daf', 'LEFT')
			// ->join('tbl_provinsi', 'db_data.provinsi = tbl_provinsi.id')
			// ->join('tbl_kabupaten', 'db_data.kabupaten = tbl_kabupaten.id')
			// ->join('tbl_kecamatan', 'db_data.kecamatan = tbl_kecamatan.id')
			// ->join('tbl_desa', 'db_data.kelurahan = tbl_desa.id');
			->where('db_data.id_daf = tbl_pendaftar.id')
			->where('db_data.progres', 0);

		return empty($search)
			? $builder
			: $builder->groupStart()
			->like('nama', $search)
			->orLike('nik', $search)
			->orLike('nisn', $search)
			->groupEnd();
	}

	public function getData($id)
	{
		return $this->join('db_data', 'tbl_pendaftar.id = db_data.id_daf')
			->where('tbl_pendaftar.id', $id);
	}

	public function total()
	{
		return $this->countAllResults();
	}
}
