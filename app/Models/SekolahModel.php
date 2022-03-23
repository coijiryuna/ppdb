<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{

	protected $table = 'tbl_sekolah';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['logo', 'visi', 'nama', 'alamat', 'kecamatan', 'kabupaten', 'provinsi', 'email', 'info', 'maps', 'baner1', 'baner2'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function getData()
	{
		return $this->join('tbl_provinsi', 'tbl_sekolah.provinsi = tbl_provinsi.id')
			->join('tbl_kabupaten', 'tbl_sekolah.kabupaten = tbl_kabupaten.id')
			->join('tbl_kecamatan', 'tbl_sekolah.kecamatan = tbl_kecamatan.id');
	}
}
