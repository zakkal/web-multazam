<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ustadz extends Model
{
    use HasFactory;
    protected $table = 'ustadzs';
    protected $fillable = ['nama', 'jenis_kelamin', 'no_wa', 'asal_pondok'];

    public function santris()
    {
        return $this->hasMany(Santri::class, 'ustadz_id');
    }
}
