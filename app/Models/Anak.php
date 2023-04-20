<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ibu()
    {
        return $this->belongsTo(Ibu::class);
    }

    public function penimbangan()
    {
        return $this->hasMany(Penimbangan::class);
    }

    public function imunisasi()
    {
        return $this->hasMany(Imunisasi::class);
    }

    public function aoc()
    {
        return $this->hasMany(AOC::class);
    }

    public function pmba()
    {
        return $this->hasMany(PMBA::class);
    }

    static function createID($data) {
        $anak = self::create($data);
        self::where('id', $anak->id)->update(['id_anak' => 'A-' . sprintf("%03d", $anak->id)]);
        return $anak;
    }
}
