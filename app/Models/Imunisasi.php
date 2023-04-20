<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function vaksin()
    {
        return $this->belongsTo(Vaksin::class);
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
