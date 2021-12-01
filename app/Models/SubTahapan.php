<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTahapan extends Model
{
    protected $table = 'tm_sub_tahaps';
    protected $guarded = [];

    public function tahap()
    {
        return $this->belongsTo(Tahapan::class, 'tahap_id');
    }
}
