<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaans';

    protected $fillable = [
        'tahun_akademik_id',
        'name',
        'status',
        'slug',
    ];

    public function tahun_akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id', 'id');
    }
}
