<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'position',
        'province_id',
        'regency_id',
        'fakultas_id',
        'program_studi_id',
        'domisili_address',
        'longitude',
        'latitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'regency_id', 'id');
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
