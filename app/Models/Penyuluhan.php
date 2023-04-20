<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyuluhan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kader()
    {
        return $this->belongsTo(Kader::class);
    }
}
