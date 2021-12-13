<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Konseling;

class KonselingController extends Controller
{
    protected $route = 'konseling.';
    protected $view  = 'pages.konseling.';
    protected $title = 'Konseling';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        return view($this->view . 'index', compact(
            'route',
            'title'
        ));
    }

    public function api(Request $request)
    {
        $datas = Konseling::orderBy('id', 'DESC')->get();

        return DataTables::of($datas)
            ->editColumn('konseling', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->konseling . "</a>";
            })
            ->editColumn('user_id', function ($p) {
                return $p->user->nama;
            })
            ->addColumn('status_balasan', function ($p) {
                if ($p->jawaban == null) {
                    return "<span class='badge badge-danger'>Belum</span>";
                } else {
                    return "<span class='badge badge-success'>Sudah</span>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'konseling', 'status_balasan'])
            ->toJson();
    }

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;

        $data = Konseling::find($id);

        return view($this->view . 'show', compact(
            'route',
            'title',
            'data'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required|max:500'
        ]);

        $data = Konseling::find($id);
        $data->update([
            'jawaban' => $request->jawaban
        ]);

        return redirect()
            ->route('konseling.show', $data->id)
            ->withSuccess('BERHASIL! Balasan berhasil terkirim.');
    }
}
