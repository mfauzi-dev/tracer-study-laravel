<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    
    public function index()
    {
        $data = Pertanyaan::with('tahun_akademik')->where('status', 1)->paginate(10);
        return view('pages.alumni.kuesioner.list-pertanyaan', compact('data'));
    }
}
