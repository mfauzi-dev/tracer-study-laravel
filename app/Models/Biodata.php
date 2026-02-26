<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodatas';

    protected $fillable = [
        'user_id',
        'fakultas_id',
        'program_studi_id',
        'image',
        'nama',
        'npm',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'jenis_kelamin',
        'nama_gelar',
        'ipk',
        'angkatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id', 'id');
    }
}
