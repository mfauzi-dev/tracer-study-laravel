<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BiodataController extends Controller
{
    
    public function index()
    {
        $userId = Auth::user()->id;
        $biodata = Biodata::where('user_id', $userId)->first();

        return view('pages.alumni.biodata.index', compact('biodata'));
    }

    public function create()
    {
        return view('pages.alumni.biodata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'telepon'        => 'required|string|max:20',
            'jenis_kelamin'  => 'required',
            'nama_gelar'     => 'nullable|string|max:50',
            'ipk'            => 'required|string',
            'angkatan'       => 'required|integer',
            'image'          => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $user = Auth::user();

        $imagePath = null;

        if ($request->hasFile('image')) {

            $filename =
                'biodata-' . Str::slug($user->name . '-' . $user->id) . '-' . Str::random(5) . '.' .
                $request->file('image')->getClientOriginalExtension();

            $imagePath = $request->file('image')
                ->storeAs('biodata', $filename, 'public');
        }

        Biodata::create([
            'user_id' => $user->id,
            'fakultas_id' => $user->fakultas_id,
            'program_studi_id' => $user->program_studi_id,
            'npm' => $user->nomor_induk,
            'nama' => $user->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_gelar' => $request->nama_gelar,
            'ipk' => $request->ipk,
            'angkatan' => $request->angkatan,
            'image' => $imagePath,
        ]);

        return redirect()->route('alumni.biodata')->with('success', 'Biodata berhasil dibuat');
    }

    public function show()
    {
        $userId = Auth::user()->id;
        $biodata = Biodata::where('user_id', $userId)->first();

        return view('pages.alumni.biodata.show', compact('biodata'));
    }

    public function edit()
    {
        $userId = Auth::user()->id;
        $biodata = Biodata::where('user_id', $userId)->first();

        return view('pages.alumni.biodata.edit', compact('biodata'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string',
            'telepon'        => 'required|string|max:20',
            'jenis_kelamin'  => 'required',
            'nama_gelar'     => 'nullable|string|max:50',
            'ipk'            => 'required|string',
            'angkatan'       => 'required|integer',
            'image'          => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $user = Auth::user();

        $biodata = Biodata::where('user_id', $user->id)->first();

        if (!$biodata) {
            return redirect()
                ->back()
                ->with('error', 'Biodata tidak ditemukan');
        }


        if ($request->hasFile('image')) {

            // hapus foto lama
            if ($biodata->image &&
                Storage::disk('public')->exists($biodata->image)) {
                Storage::disk('public')->delete($biodata->image);
            }

            $filename =
                'biodata-' .Str::slug($user->name . '-' . $user->id) . '-' .Str::random(5) . '.' .
                $request->file('image')->getClientOriginalExtension();

            $biodata->image = $request->file('image')
                ->storeAs('biodata', $filename, 'public');
        }


        $biodata->update([
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nama_gelar'    => $request->nama_gelar,
            'ipk'           => $request->ipk,
            'angkatan'      => $request->angkatan,
        ]);

        return redirect()
            ->route('alumni.biodata')
            ->with('success', 'Biodata berhasil diupdate');


    }
}
