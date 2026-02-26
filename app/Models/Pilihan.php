<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    use HasFactory;

    protected $table = 'pilihans';

    protected $fillable = [
        'pertanyaan_id',
        'pilihan'
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id', 'id');
    }
}
