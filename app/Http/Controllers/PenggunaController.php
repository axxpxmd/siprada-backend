<?php

namespace App\Http\Controllers;

use DataTables;

use Illuminate\Http\Request;

// Models
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    protected $title = 'User';
    protected $route = 'pengguna.';

    public function index()
    {
        $title = $this->title;
        $route = $this->route;

        return view('pages.pengguna.index', compact(
            'title',
            'route'
        ));
    }

    public function api(Request $request)
    {
        $status = $request->status;
        $status_user = $request->status_user;

        $datas = Pengguna::queryTable($status, $status_user);

        return DataTables::of($datas)
            ->addColumn('action', function ($p) {
                return '-';
            })
            ->editColumn('nama', function ($p) {
                return "<a href='" . route($this->route . 'edit', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->nama . "</a>";
            })
            ->editColumn('status', function ($p) {
                if ($p->status == 1) {
                    return "<span class='badge badge-success font-weight-bold'>Sudah</span>";
                } elseif ($p->status == 0) {
                    return "<span class='badge badge-warning font-weight-bold'>Belum</span>";
                } elseif ($p->status == 2) {
                    return "<span class='badge badge-danger font-weight-bold'>Ditolak</span>";
                }
            })
            ->editColumn('status_user', function ($p) {
                if ($p->status_user == 'individual') {
                    return "<span class='badge badge-primary  font-weight-bold'>Individual</span>";
                } else {
                    return "<span class='badge badge-secondary  font-weight-bold'>Kelompok</span>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama', 'status', 'status_user'])
            ->toJson();
    }
}
