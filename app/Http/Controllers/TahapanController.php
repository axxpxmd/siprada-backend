<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Tahapan;

class TahapanController extends Controller
{
    protected $route = 'tahapan.';
    protected $view  = 'pages.tahapan.';
    protected $title = 'Tahapan';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        return view($this->view . 'index', compact(
            'route',
            'title'
        ));
    }

    public function api()
    {
        $data = Tahapan::all();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'judul' => 'required|unique:tm_tahaps,judul',
        // ]);

        // $data = $request->all();
        // Tahapan::create($data);

        // return response()->json([
        //     'message' => 'Data ' . $this->title . ' berhasil tersimpan.'
        // ]);

        return response()->json([
            'message' => 'Tidak bisa menambah data, Silahkan edit.'
        ], 422);
    }

    public function edit($id)
    {
        $data = Tahapan::find($id);
        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|unique:tm_tahaps,judul,' . $id,
        ]);

        $data = $request->all();
        $tahapan = Tahapan::findOrFail($id);
        $tahapan->update($data);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }

    public function destroy($id)
    {
        Tahapan::destroy($id);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
