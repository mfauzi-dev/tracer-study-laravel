<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string'],
            'page'   => ['nullable', 'integer', 'min:1'],
            'size'   => ['nullable', 'integer', 'max:10'],
        ]);

        $search = $request->input('search');
        $size   = $request->input('size', 10);

        $query = ProgramStudi::with('fakultas')->latest();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhereHas('fakultas', function($fakultasQuery) use ($search) {
                    $fakultasQuery->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        $programStudis = $query->paginate(10)->withQueryString();

        return view('pages.admin.program-studi.index', compact('programStudis', 'search'));
    }

    public function create()
    {
        $fakultas = Fakultas::all();
        return view('pages.admin.program-studi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'name' => 'required',
        ]);

        ProgramStudi::create([
            'fakultas_id' => $request->fakultas_id,
            'name' => $request->name,
        ]);

        return redirect(route('admin.program-studi'))->with('success', 'Program Studi Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        $fakultas = Fakultas::all();

        return view(
            'pages.admin.program-studi.edit',
            compact('programStudi', 'fakultas')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'name' => 'required',
        ]);

        $programStudi = ProgramStudi::findOrFail($id);

        $programStudi->fakultas_id = $request->fakultas_id;
        $programStudi->name = $request->name;
        $programStudi->save();

        return redirect(route('admin.program-studi'))->with('success', 'Program Studi Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);

        $programStudi->delete();

        return redirect(route('admin.program-studi'))->with('success', 'Program Studi Berhasil Dihapus');
    }
}
