<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Komentar;
use App\Models\Pengguna;
use App\Models\Perda;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalUser = Pengguna::whereNotIn('id', [1])->count();
        $totalAspirasi = Aspirasi::count();
        $totalKomentar = Komentar::count();
        $totalPerda = Perda::count();

        return view('home', compact(
            'totalUser',
            'totalAspirasi',
            'totalKomentar',
            'totalKomentar',
            'totalPerda'
        ));
    }
}
