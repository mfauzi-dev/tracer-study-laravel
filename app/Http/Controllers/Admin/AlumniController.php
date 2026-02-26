<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;

class AlumniController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'search'        => ['nullable', 'string'],
            'fakultas_id'   => ['nullable', 'exists:fakultas,id'],
            'program_studi_id' => ['nullable', 'exists:program_studis,id'],
            'page'          => ['nullable', 'integer', 'min:1'],
            'size'          => ['nullable', 'integer', 'max:50'],
        ]);

        $search = $request->input('search');
        $fakultasId = $request->input('fakultas_id');
        $programStudiId = $request->input('program_studi_id');
        $size = $request->input('size', 10);

        $query = User::with(['program_studi', 'fakultas'])
                     ->where('role_as', 'alumni');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nomor_induk', 'like', '%' . $search . '%')
                  ->orWhereHas('program_studi', function($programQuery) use ($search) {
                      $programQuery->where('name', 'like', '%' . $search . '%')
                                   ->orWhereHas('fakultas', function($fakultasQuery) use ($search) {
                                       $fakultasQuery->where('name', 'like', '%' . $search . '%');
                                   });
                  });
            });
        }

        if ($fakultasId) {
            $query->where('fakultas_id', $fakultasId);
        }

        if ($programStudiId) {
            $query->where('program_studi_id', $programStudiId);
        }

        $alumnis = $query->paginate($size)->withQueryString();

        $fakultasList = Fakultas::orderBy('name')->get();
        $programStudiList = ProgramStudi::orderBy('name')->get();

        return view('pages.admin.alumni.index', compact(
            'alumnis', 'search', 'fakultasId', 'programStudiId', 'fakultasList', 'programStudiList'
        ));
    }

    public function create()
    {
        $fakultasList = Fakultas::orderBy('name')->get();
        $programStudiList = ProgramStudi::with('fakultas')->orderBy('name')->get();
        
        return view('pages.admin.alumni.create', compact('fakultasList','programStudiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'nomor_induk'      => ['required', 'string', 'max:50', 'unique:users,nomor_induk'],
            'email'            => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'string', 'min:6'],
            'fakultas_id'      => ['required', 'exists:fakultas,id'],
            'program_studi_id' => ['required', 'exists:program_studis,id'],
            'active'           => ['required', 'in:0,1'],
        ]);

        User::create([
            'name'             => $request->name,
            'nomor_induk'      => $request->nomor_induk,
            'email'            => $request->email,
            'password'         => bcrypt($request->password),
            'role_as'          => 'alumni',
            'fakultas_id'      => $request->fakultas_id,
            'program_studi_id' => $request->program_studi_id,
            'active'           => $request->active,
        ]);

        return redirect()->route('admin.alumni')->with('success', 'Alumni berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.alumni')->with('success', 'Your data has been deleted!');
    }
}
