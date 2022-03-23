<?php

namespace App\Models;

use CodeIgniter\Model;

class DatapendaftarModel extends Model
{

	protected $st;
	protected $table = 'db_data';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['id_daf', 'id_enc', 'no_reg', 'nisn', 'nama', 'jk', 'tmp_lahir', 'tgl_lahir', 'nik', 'agama', 'alamat', 'rt', 'rw', 'dusun', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi', 'domisili', 'jns_tinggal', 'telp', 'email', 'anak_ke', 'jml_sdr', 'nm_ayh', 'tlahir_ayh', 'lahir_ayh', 'pend_ayh', 'kerja_ayh', 'hasil_ayh', 'nik_ayh', 'nm_ibu', 'tlahir_ibu', 'lahir_ibu', 'pend_ibu', 'kerja_ibu', 'hasil_ibu', 'nik_ibu', 'nm_wl', 'lahir_wl', 'tlahir_wl', 'pend_wl', 'kerja_wl', 'hasil_wl', 'alt_wl', 'nik_wl', 'no_kk', 'no_un', 'no_skhun', 'no_ijazah', 'no_kps', 'no_kip', 'no_kis', 'no_pkh', 'beasiswa', 'kelas_dig', 'skl_asal', 'almt_skl', 'jns_masuk', 'tgl_masuk', 'ket_out', 'tgl_out', 'alasan_out', 'nosrt_out', 'status', 'jalur', 'progres', 'foto', 'editor', 'ket'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	const ORDERABLE = [
		1 => 'db_data.id',
		2 => 'created_at'
	];

	public function getResource(string $search = '')
	{
		$builder = $this->builder()
			->select('*')
			->join('tbl_pendaftar', 'db_data.id_daf = tbl_pendaftar.id', 'left')
			->join('tbl_provinsi', 'db_data.provinsi = tbl_provinsi.id')
			->join('tbl_kabupaten', 'db_data.kabupaten = tbl_kabupaten.id')
			->join('tbl_kecamatan', 'db_data.kecamatan = tbl_kecamatan.id')
			->join('tbl_desa', 'db_data.kelurahan = tbl_desa.id')
			->where('db_data.progres', 1);

		return empty($search)
			? $builder
			: $builder->groupStart()
			->like('nama', $search)
			->orLike('nik', $search)
			->orLike('nisn', $search)
			->groupEnd();
	}

	public function getdata($id)
	{
		return $this->join('tbl_pendaftar', 'db_data.id_daf = tbl_pendaftar.id', 'right')
			->join('tbl_provinsi', 'db_data.provinsi = tbl_provinsi.id')
			->join('tbl_kabupaten', 'db_data.kabupaten = tbl_kabupaten.id')
			->join('tbl_kecamatan', 'db_data.kecamatan = tbl_kecamatan.id')
			->join('tbl_desa', 'db_data.kelurahan = tbl_desa.id')
			->where('db_data.id_daf', $id);
	}
	public function get_data($id)
	{
		return $this->join('tbl_pendaftar', 'db_data.id_daf = tbl_pendaftar.id',)
			->where('db_data.id_daf', $id);
	}
	public function progres()
	{
		return $this->where('progres', 1)->countAllResults();
	}
	public function total()
	{
		return $this->where('progres', 0)->countAllResults();
	}
}
