<?php

namespace App\Models;

use CodeIgniter\Model;

class SyaratModel extends Model
{

    protected $table = 'tbl_sarat';
    protected $primaryKey = 'id_sy';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['sarat'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    const ORDERABLE = [
        1 => 'id_sy',
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
            ->like('sarat', $search)
            ->groupEnd();
    }
}
