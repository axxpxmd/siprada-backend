<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perda extends Model
{
    protected $table = 'tm_perdas';
    protected $guarded = [];

    public function tahap()
    {
        return $this->belongsTo(Tahapan::class, 'tahap_id');
    }

    public function subTahap()
    {
        return $this->belongsTo(SubTahapan::class, 'sub_tahap_id');
    }
}
