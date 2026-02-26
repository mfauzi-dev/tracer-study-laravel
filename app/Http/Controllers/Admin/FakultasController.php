<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataFakultasRequest;
use App\Http\Resources\FakultasResource;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    
    public function index()
    {
        $fakultas = Fakultas::latest()->paginate(10);
        return view('pages.admin.fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('pages.admin.fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Fakultas::create([
            'name' => $request->name,
        ]);

        return redirect(route('admin.fakultas'))->with('success', 'Fakultas Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('pages.admin.fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $fakultas = Fakultas::findOrFail($id);

        $fakultas->name = $request->name;
        $fakultas->save();

        return redirect(route('admin.fakultas'))->with('success', 'Fakultas Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $fakultas->delete();
        return redirect(route('admin.fakultas'))->with('success', 'Fakultas Berhasil Dihapus');

    }
}
