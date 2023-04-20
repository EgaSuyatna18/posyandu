<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AOC extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}