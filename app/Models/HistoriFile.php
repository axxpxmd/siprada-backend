<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriFile extends Model
{
    protected $table = 'tr_histori_files';
    protected $guarded = [];

    public function histori()
    {
        return $this->belongsTo(Histori::class, 'histori_id');
    }
}
