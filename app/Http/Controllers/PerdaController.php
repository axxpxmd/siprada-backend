<?php

namespace App\Http\Controllers;

use DataTables;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Perda;
use App\Models\Histori;
use App\Models\Tahapan;
use App\Models\HistoriFile;
use App\Models\SubTahapan;

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

    public function api2()
    {
        $data = Histori::all();

        return DataTables::of($data)
            ->addColumn('action', function ($p) {
                return "<a href='" . route($this->route . 'editRekamJejak', $p->id) . "' title='Edit Data'><i class='icon-pencil mr-1'></i></a>";
            })
            ->editColumn('tahap_id', function ($p) {
                return $p->tahap->judul;
            })
            ->editColumn('sub_tahap_id', function ($p) {
                return $p->subTahap->judul;
            })
            ->editColumn('tgl_kegiatan', function ($p) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $p->tgl_kegiatan)->format('d M Y | H:i:s');
            })
            ->addColumn('file', function ($p) {
                $totalFile = HistoriFile::where('histori_id', $p->id)->count();

                return "<a href='#' class='text-primary' title='Menampilkan File'>" . $totalFile . ' File' . "</a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'judul', 'file'])
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
            'tahap_id' => 0,
            'sub_tahap_id' => 0,
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

        $tahaps = Tahapan::select('id', 'judul')->get();
        $sub_tahaps = SubTahapan::select('id', 'judul')->get();

        return view($this->view . 'show', compact(
            'route',
            'title',
            'data',
            'tahaps',
            'sub_tahaps'
        ));
    }

    public function subTahapanByTahapan($id)
    {
        $data = SubTahapan::where('tahap_id', $id)->get();

        return $data;
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

    public function storeRekamJejak(Request $request)
    {
        $request->validate([
            'tahap_id' => 'required',
            'sub_tahap_id' => 'required',
            'perda_id' => 'required',
            'status_kegiatan' => 'required',
            'tgl_kegiatan' => 'required'
        ]);

        /* Tahapan : 
         * tm_historis
         * tm_perdas
         * tr_histori_files
         */

        // Tahap 1
        $data = new Histori();
        $data->perda_id = $request->perda_id;
        $data->tahap_id = $request->tahap_id;
        $data->sub_tahap_id = $request->sub_tahap_id;
        $data->judul = $request->judul;
        $data->status_kegiatan = $request->status_kegiatan;
        $data->tgl_kegiatan = $request->tgl_kegiatan;
        $data->keterangan = $request->keterangan;
        $data->save();

        // Tahap 2
        $perda = Perda::find($request->perda_id);
        $perda->update([
            'tahap_id' => $request->tahap_id,
            'sub_tahap_id' => $request->sub_tahap_id
        ]);

        // Tahap 3
        $checkFile = $request->hasFile('file');
        if ($checkFile) {
            $countFile = count($request->file('file'));
            for ($k = 0; $k < $countFile; $k++) {

                //TODO: Saved to Storage
                $file = $request->file('file');
                $fileName = time() . "." . $file[$k]->getClientOriginalName();
                if ($file[$k] != null) {
                    $file[$k]->storeAs('perda/', $fileName, 'sftp', 'public');
                }

                //TODO: Saved to Table
                $inputFile = new HistoriFile();
                $inputFile->histori_id = $data->id;
                $inputFile->file = $fileName;
                $inputFile->save();
            }
        }

        return response()->json([
            'message' => 'Data Rekam Jejak berhasil ditambah.'
        ]);
    }

    public function editRekamJejak($id)
    {
        $route = $this->route;
        $title = 'Rekam Jejak';

        $data = Histori::find($id);
        $files = HistoriFile::where('histori_id', $id)->get();

        return view($this->view . 'edit-rekam-jejak', compact(
            'route',
            'title',
            'data',
            'files'
        ));
    }

    public function updateRekamJejak(Request $request, $id)
    {
        /* Tahapan : 
         * tm_historis
         * tr_histori_files
         */

        // Tahap 1
        $data = Histori::find($id);
        $data->update([
            'judul' => $request->judul,
            'tgl_kegiatan' => $request->tgl_kegiatan,
            'keterangan' => $request->keterangan
        ]);

        // Tahap 2
        $checkFile = $request->hasFile('file');
        if ($checkFile) {
            $countFile = count($request->file('file'));
            for ($k = 0; $k < $countFile; $k++) {

                //TODO: Saved to Storage
                $file = $request->file('file');
                $fileName = time() . "." . $file[$k]->getClientOriginalName();
                if ($file[$k] != null) {
                    $file[$k]->storeAs('perda/', $fileName, 'sftp', 'public');
                }

                //TODO: Saved to Table
                $inputFile = new HistoriFile();
                $inputFile->histori_id = $data->id;
                $inputFile->file = $fileName;
                $inputFile->save();
            }
        }

        return response()->json([
            'message' => 'Data Rekam Jejak berhasil diperbaharui.'
        ]);
    }

    public function deleteFileRekamJejak(Request $request)
    {
        $data = HistoriFile::find($request->id);

        $data->delete();

        return redirect()
            ->route('perda.editRekamJejak', $data->histori_id)
            ->withSuccess('BERHASIL! File berhasil terhapus.');
    }
}
