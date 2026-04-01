<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'jenis_kelamin', 'kelas', 'kelas_halaqah', 'nisn', 'ustadz_id', 'orangtua', 'wa_orangtua'];

    public function ustadz()
    {
        return $this->belongsTo(Ustadz::class, 'ustadz_id');
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }
}
