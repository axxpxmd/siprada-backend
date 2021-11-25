<?php

namespace App\Http\Controllers;

use Mail;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
                return "<a href='" . route($this->route . 'show', $p->id) . "' class='text-primary' title='Menampilkan Data'>" . $p->nama . "</a>";
            })
            ->editColumn('status', function ($p) {
                if ($p->status == 1) {
                    return "<span class='badge badge-success'>Sudah</span>";
                } elseif ($p->status == 0) {
                    return "<span class='badge badge-warning'>Belum</span>";
                } elseif ($p->status == 2) {
                    return "<span class='badge badge-danger'>Ditolak</span>";
                }
            })
            ->editColumn('status_user', function ($p) {
                if ($p->status_user == 'individual') {
                    return "<span class='badge badge-primary '>Individual</span>";
                } else {
                    return "<span class='badge badge-secondary '>Kelompok</span>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama', 'status', 'status_user'])
            ->toJson();
    }

    public function show($id)
    {
        $title = $this->title;
        $route = $this->route;

        $data = Pengguna::find($id);

        return view('pages.pengguna.show', compact(
            'title',
            'route',
            'data'
        ));
    }

    public function cekNIK($nik)
    {
        $url = config('app.ip_nik');

        $reqBody = [
            'username' => config('app.username_nik'),
            'password' => config('app.password_nik'),
            'nik' => $nik
        ];

        $res = Http::post($url, $reqBody);
        $resJson = $res->json();
        $content = $resJson['content'][0];

        $data = [
            'no_kk' => $content['NO_KK'],
            'nik' => $content['NIK'],
            'nama_lengkap' => $content['NAMA_LGKP'],
            'kabupaten' => $content['KAB_NAME'],
            'agama' => $content['AGAMA'],
            'no_rw' => $content['NO_RW'],
            'kecamatan' => $content['KEC_NAME'],
            'jenis_pekerjaan' => $content['JENIS_PKRJN'],
            'no_rt' => $content['NO_RT'],
            'alamat' => $content['ALAMAT'],
            'tempat_lahir' => $content['TMPT_LHR'],
            'provinsi' => $content['PROP_NAME'],
            'kelurahan' => $content['KEL_NAME'],
            'jenis_kelamin' => $content['JENIS_KLMIN'],
            'tgl_lahir' => $content['TGL_LHR']
        ];

        return $data;
    }

    public function updateStatus(Request $request, $id)
    {
        //TODO: Validation
        $request->validate([
            'status' => 'required',
            'alasan' => 'max:100'
        ]);

        //* Data
        $status = $request->status;
        $alasan = $request->alasan;

        //TODO: Update tm_users
        $dataUser = Pengguna::find($id);
        $dataUser->update([
            'status' => $status,
            'alasan' => $alasan
        ]);

        //TODO: Send email to user
        if ($status == 1) {
            $hasil = 'TERVERIFIKASI';
        } elseif ($status == 2) {
            $hasil = 'DITOLAK';
        }

        $email = $dataUser->email;

        $data = array(
            'status' => $hasil,
            'alasan' => $alasan,
            'username' => strstr($email, '@', true) //TODO: Get name from email
        );

        //* Send to email user
        Mail::send('layouts.email.verification_user', $data, function ($message) use ($email) {
            $message->to($email)->subject('Hasil Verifikasi Akun SIPRADA');
            $message->from(config('app.mail_from'), config('app.mail_name'));
        });

        return redirect()
            ->route('pengguna.show', $id)
            ->withSuccess('BERHASIL! Status user berhasil diperbaharui.');
    }
}
