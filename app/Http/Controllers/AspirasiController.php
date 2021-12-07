<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Perda;
use App\Models\Aspirasi;
use App\Models\Komentar;

class AspirasiController extends Controller
{
    protected $route = 'aspirasi.';
    protected $view  = 'pages.aspirasi.';
    protected $title = 'Aspirasi';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        $perdas = Perda::select('id', 'judul')->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'perdas'
        ));
    }

    public function api(Request $request)
    {
        $perda_id = $request->perda_id;

        $datas = Aspirasi::queryTable($perda_id);

        return DataTables::of($datas)
            ->editColumn('aspirasi', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->aspirasi . "</a>";
            })
            ->editColumn('perda_id', function ($p) {
                return $p->perda->judul;
            })
            ->editColumn('user_id', function ($p) {
                return $p->pengguna->nama;
            })
            ->addColumn('balasan', function ($p) {
                $totalBalasan = Komentar::where('aspirasi_id', $p->id)->count();

                return $totalBalasan;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'aspirasi'])
            ->toJson();
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;

        $data = Aspirasi::find($id);
        $komentars = Komentar::where('aspirasi_id', $id)->get();

        return view($this->view . 'show', compact(
            'route',
            'title',
            'data',
            'komentars'
        ));
    }
}
