<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table    = 'tm_users';
    protected $fillable = ['email', 'password', 'nama', 'nama_perusahaan', 'no_telp', 'nik', 'foto', 'keterangan', 'status', 'alasan', 'status_user', 'token'];
    protected $hidden   = ['password', 'token'];

    public static function queryTable($status, $status_user)
    {
        $datas = Pengguna::select('id', 'nama', 'email', 'nik', 'status', 'status_user');

        if ($status != null) {
            $datas->where('status', $status);
        }

        if ($status_user != null) {
            $datas->where('status_user', $status_user);
        }

        return $datas->get();
    }
}
