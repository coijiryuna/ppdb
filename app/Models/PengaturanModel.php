<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{

	protected $table = 'tbl_setting';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['jenjang', 'tapel', 'semester', 'jalur'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function get_data()
	{
		return	$this->join('tbl_jenjang', 'tbl_setting.jenjang = tbl_jenjang.id');
	}
}
