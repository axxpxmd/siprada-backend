<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'tm_komentars';
    protected $guarded = [];

    public function perda()
    {
        return $this->belongsTo(Perda::class, 'perda_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }
}
