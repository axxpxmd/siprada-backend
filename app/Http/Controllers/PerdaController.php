<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Perda;
use App\Models\SubTahapan;
use App\Models\Tahapan;

class PerdaController extends Controller
{
    protected $route = 'perda.';
    protected $view  = 'pages.perda.';
    protected $title = 'Perda';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;

        $tahaps = Tahapan::select('id', 'judul')->get();
        $sub_tahaps = SubTahapan::select('id', 'judul')->get();

        return view($this->view . 'index', compact(
            'route',
            'title',
            'tahaps',
            'sub_tahaps'
        ));
    }

    public function api()
    {
        $data = Perda::all();

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
            'judul' => 'required|string|max:500|unique:tm_perdas,judul',
            'jenis' => 'required',
            'perda_amandemen' => 'max:500',
            'periode1' => 'required',
            'periode2' => 'required',
            'tahun_angrn' => 'required',
            'pengusul' => 'required',
            'pemrakarsa' => 'required',
            'dokumen' => 'required|mimes:png,jpeg,jpg,pdf|max:2024',
            'tgl_inpt_dok' => 'required',
            'tgl_terbit' => 'required'
        ]);

        /* Tahapan : 
         * 1. tm_perdas
         * 2. tm_historis
         */

        // Tahap 1
        $file     = $request->file('dokumen');
        $fileName = time() . "." . $file->getClientOriginalName();
        $request->file('dokumen')->storeAs('perda/', $fileName, 'sftp', 'public');

        $dataPerda = [
            'tahap_id' => 1,
            'sub_tahap_id' => 1,
            'judul' => $request->judul,
            'jenis' => $request->jenis,
            'perda_amandemen' => $request->perda_amandemen,
            'periode' => $request->periode1 . ' - ' . $request->periode2,
            'tahun_angrn' => $request->tahun_angrn,
            'pengusul' => $request->pengusul,
            'pemrakarsa' => $request->pemrakarsa,
            'dokumen' => $fileName,
            'tgl_inpt_dok' => $request->tgl_inpt_dok,
            'naskah_akdmk' => $request->naskah_akdmk,
            'keterangan' => $request->keterangan,
            'ditarik' => 'tidak',
            'tampilkan' => 1,
            'tgl_terbit' => $request->tgl_terbit
        ];
        Perda::create($dataPerda);

        return response()->json([
            'message' => "Data " . $this->title . " berhasil tersimpan."
        ]);
    }
}
