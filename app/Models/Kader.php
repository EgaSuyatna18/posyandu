<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    static function createID($data) {
        $kader = self::create($data);
        self::where('id', $kader->id)->update(['id_kader' => 'K-' . sprintf("%03d", $kader->id)]);
        return $kader;
    }
}
