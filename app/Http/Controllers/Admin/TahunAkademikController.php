<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    public function index()
   {
        $tahunAkademik = TahunAkademik::orderBy('tahun', 'DESC')->paginate(10);
        return view('pages.admin.tahun-akademik.index', compact('tahunAkademik'));
    }

    public function create()
    {
        return view('pages.admin.tahun-akademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        TahunAkademik::create([
            'tahun' => $request->tahun,
        ]);

        return redirect()
            ->route('admin.tahun_akademik')
            ->with('success', 'Tahun Akademik Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        return view('pages.admin.tahun-akademik.edit', compact('tahunAkademik'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required',
        ]);

        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->tahun = $request->tahun;
        $tahunAkademik->save();

        return redirect()
            ->route('admin.tahun_akademik')
            ->with('success', 'Tahun Akademik Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $tahunAkademik = TahunAkademik::findOrFail($id);
        $tahunAkademik->delete();

        return redirect()
            ->route('admin.tahun_akademik')
            ->with('success', 'Tahun Akademik Berhasil Dihapus');
    }
}
