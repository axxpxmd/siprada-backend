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

        return view($this->view . 'index', compact(
            'route',
            'title'
        ));
    }

    public function api(Request $request)
    {
        $jenis = $request->jenis_filter;
        $tahun_angrn = $request->tahun_angrn_filter;

        $data = Perda::perda($jenis, $tahun_angrn);

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='" . route($this->route . 'edit', $p->id) . "' title='Edit Data'><i class='icon-pencil mr-1'></i></a>";
            })
            ->editColumn('judul', function ($p) {
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->judul . "</a>";
            })
            ->editColumn('sub_tahap_id', function ($p) {
                return $p->subTahap == null ? 'Belum ada' : $p->subTahap->judul;
            })
            ->editColumn('tampilkan', function ($p) {
                if ($p->tampilkan == 1) {
                    return 'Ya';
                } else {
                    return 'Tidak';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'judul'])
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

    public function show($id)
    {
        $route = $this->route;
        $title = $this->title;

        $data = Perda::find($id);

        return view($this->view . 'show', compact(
            'route',
            'title',
            'data'
        ));
    }

    public function edit(Request $request, $id)
    {
        $route = $this->route;
        $title = $this->title;

        $data = Perda::find($id);

        return view($this->view . 'edit', compact(
            'route',
            'title',
            'data'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:500|unique:tm_perdas,judul,' . $id,
            'jenis' => 'required',
            'perda_amandemen' => 'max:500',
            'periode1' => 'required',
            'periode2' => 'required',
            'tahun_angrn' => 'required',
            'pengusul' => 'required',
            'pemrakarsa' => 'required',
            'tgl_inpt_dok' => 'required',
            'tgl_terbit' => 'required'
        ]);

        $data = Perda::find($id);
        $fileName = $data->dokumen;

        if ($request->dokumen != null) {
            $request->validate([
                'dokumen' => 'required|mimes:png,jpeg,jpg,pdf|max:2024',
            ]);

            $file     = $request->file('dokumen');
            $fileName = time() . "." . $file->getClientOriginalName();
            $request->file('dokumen')->storeAs('perda/', $fileName, 'sftp', 'public');
        }

        $data->update([
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
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}
