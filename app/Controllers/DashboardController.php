<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use App\Models\DatapendaftarModel;

class DashboardController extends BaseController
{
    protected $register;
    protected $daftar;
    public function __construct()
    {
        $this->daftar = new DatapendaftarModel();
        $this->register = new RegisterModel();
    }
    public function index()
    {
        $data = [
            'total'     => $this->daftar->total(),
            'progres'     => $this->daftar->progres(),
            'daftar'    => $this->register->total(),
            'title'     => 'Dashboard',
        ];

        return view('dashboard', $data);
    }
}
