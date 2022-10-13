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
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>";
            })
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

    public function store(Request $request)
    {
        $request->validate([
            'komentar' => 'required|max:300'
        ]);

        $aspirasi = Aspirasi::find($request->aspirasi_id);

        $data = new Komentar();
        $data->aspirasi_id = $request->aspirasi_id;
        $data->user_id = 1;
        $data->komentar = $request->komentar;
        $data->save();

        return redirect()
            ->route('aspirasi.show', $aspirasi->id)
            ->withSuccess('BERHASIL! Balasan berhasil terkirim.');
    }

    public function destroy($id)
    {
        $apirasi = Aspirasi::find($id);

        Komentar::where('aspirasi_id', $id)->delete();

        $apirasi->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
