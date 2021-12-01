<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubTahapan;
use App\Models\Tahapan;

class SubTahapanController extends Controller
{
    protected $route = 'sub-tahapan.';
    protected $view  = 'pages.sub_tahapan.';
    protected $title = 'Sub Tahapan';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        $tahaps = Tahapan::select('id', 'judul')->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'tahaps'
        ));
    }

    public function api()
    {
        $data = SubTahapan::all();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "
                <a href='#' onclick='edit(" . $p->id . ")' title='Edit Permission'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger mr-2' title='Hapus Permission'><i class='icon icon-remove'></i></a>";
            })
            ->editColumn('tahap_id', function ($p) {
                return $p->tahap->judul;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahap_id' => 'required',
            'judul' => 'required|unique:tm_sub_tahaps,judul',
            'keterangan' => 'required'
        ]);

        $data = $request->all();
        SubTahapan::create($data);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil tersimpan.'
        ]);
    }

    public function edit($id)
    {
        $data = SubTahapan::find($id);
        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahap_id' => 'required',
            'judul' => 'required|unique:tm_sub_tahaps,judul,' . $id,
            'keterangan' => 'required'
        ]);

        $data = $request->all();
        $subTahapan = SubTahapan::findOrFail($id);
        $subTahapan->update($data);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }

    public function destroy($id)
    {
        SubTahapan::destroy($id);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
}
