<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\Pilihan;
use Illuminate\Http\Request;

class PilihanJawabanController extends Controller
{
    
    public function index(Request $request)
    {
        $request->validate([
            'pertanyaan_id'     => ['nullable'],
            'page'              => ['nullable', 'integer', 'min:1'],
            'size'              => ['nullable', 'integer', 'max:50'],
        ]);

        $pertanyaanList = Pertanyaan::orderBy('name')->where('status', 1)->get();
        $query = Pilihan::with('pertanyaan');

        $pertanyaanId = $request->input('pertanyaan_id');
        $size = $request->input('size', 10);


        if($pertanyaanId) {
            $query->where('pertanyaan_id', $pertanyaanId);
        }

        $pilihanJawaban = $query->paginate($size)->withQueryString();

        return view('pages.admin.pilihan.index', compact('pertanyaanList', 'pilihanJawaban', 'pertanyaanId'));
    }

    public function create(Request $request)
    {
        $pertanyaanList = Pertanyaan::orderBy('name')->where('status', 1)->get();
        return view('pages.admin.pilihan.create', compact('pertanyaanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pertanyaan_id' => 'required|exists:pertanyaans,id',
        ]);

        Pilihan::create([
            'pilihan' => $request->name,
            'pertanyaan_id' => $request->pertanyaan_id,
        ]);

        return redirect()->route('admin.pilihan')->with('success', 'Pilihan Jawaban Berhasil Ditambahkan');
    }
}
