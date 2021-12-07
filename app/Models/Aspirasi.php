<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'tm_aspirasis';
    protected $guarded = [];

    public function perda()
    {
        return $this->belongsTo(Perda::class, 'perda_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }

    public static function queryTable($perda_id)
    {
        $data = Aspirasi::orderBy('id', 'DESC');

        if ($perda_id != null) {
            $data->where('perda_id', $perda_id);
        }

        return $data->get();
    }
}
