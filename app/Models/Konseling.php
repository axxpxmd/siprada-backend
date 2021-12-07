<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    protected $table = 'tm_konselings';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }
}
