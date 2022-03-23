<?php

namespace App\Models;

use CodeIgniter\Model;

class JurusanModel extends Model
{

	protected $table = 'tbl_jurusan';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['jurusan'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	const ORDERABLE = [
		1 => 'id',
	];

	/**
	 * Get resource data.
	 *
	 * @param string $search
	 *
	 * @return \CodeIgniter\Database\BaseBuilder
	 */
	public function getResource(string $search = '')
	{
		$builder = $this->builder()
			->select('*');

		return empty($search)
			? $builder
			: $builder->groupStart()
			->like('jurusan', $search)
			->groupEnd();
	}
}
