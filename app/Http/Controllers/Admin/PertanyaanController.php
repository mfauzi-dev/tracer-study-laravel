<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\Pilihan;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PertanyaanController extends Controller
{
    
    public function index(Request $request)
    {
        $request->validate([
            'search'            => ['nullable', 'string'],
            'tahun_akademik_id' => ['nullable'],
            'status'            => ['nullable'],
            'page'              => ['nullable', 'integer', 'min:1'],
            'size'              => ['nullable', 'integer', 'max:50'],
        ]);

        $tahunAkademik = TahunAkademik::orderBy('tahun', 'DESC')->get();
        $tahunAkademikId = $request->input('tahun_akademik_id');
        $search = $request->input('search');
        $size = $request->input('size', 10);
        $status = $request->input('status');

        $query = Pertanyaan::with('tahun_akademik');

        if($request->filled('status')) {
            $query->where('status', $status);
        }

        if($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if($tahunAkademikId) {
            $query->where('tahun_akademik_id', $tahunAkademikId);
        }

        $pertanyaan = $query->paginate($size)->withQueryString();

        return view('pages.admin.pertanyaan.index', compact('pertanyaan', 'search', 'tahunAkademikId', 'tahunAkademik'));
    }

    public function create() 
    {
        $tahunAkademik = TahunAkademik::orderBy('tahun', 'DESC')->get();

        return view('pages.admin.pertanyaan.create', compact('tahunAkademik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tahun_akademik_id' => 'required|exists:tahun_akademiks,id',
            'status' => 'required|in:0,1',
        ]);

        Pertanyaan::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'tahun_akademik_id' => $request->tahun_akademik_id,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pertanyaan')->with('success', 'Pertanyaan Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);

        $pertanyaan->delete();

        return redirect()->route('admin.pertanyaan')->with('success', 'Pertanyaan Berhasil Dihapus');
    }

    public function getStatus()
    {
        $tahunAkademik = TahunAkademik::orderBy('tahun', 'DESC')->get();
        return view('pages.admin.pertanyaan.status', compact('tahunAkademik'));
    }

    public function storeStatus(Request $request)
    {
        if(Pertanyaan::where('tahun_akademik_id', $request->thn_akad_satu)->exists()) {
            $data = Pertanyaan::where('tahun_akademik_id', $request->thn_akad_satu)->get();
            $pertanyaan = array();
            foreach ($data as $dt) {
                $pertanyaan = $dt;

                $pertanyaan->slug = $dt->slug;
                $pertanyaan->name = $dt->name;
                $pertanyaan->tahun_akademik_id = $request->thn_akad_satu;
                $pertanyaan->status = $request->status;
                $pertanyaan->save();
            }

            return redirect()->route('admin.pertanyaan')->with('success', 'Status pertanyaan berhasil diganti');
        } else {
            return redirect()->route('admin.pertanyaan')->with('success', 'Data Kosong');
        }
    }

    public function getCopy()
    {
        $tahunAkademik = TahunAkademik::orderBy('tahun', 'DESC')->get();
        return view('pages.admin.pertanyaan.copy', compact('tahunAkademik'));
    }

    public function storeCopy(Request $request)
    {

        if (Pertanyaan::where('tahun_akademik_id', $request->thn_akad_dua)->exists()) {
            $data = Pertanyaan::where('tahun_akademik_id', $request->thn_akad_dua)->get();
            $pertanyaan = array();
            foreach ($data as $dt) {
                $pertanyaan = new Pertanyaan();
                $pertanyaan->slug = Str::slug($dt->pertanyaan . '-' . Str::random(5));
                $pertanyaan->tahun_akademik_id = $request->thn_akad_satu;
                $pertanyaan->name = $dt->name;
                $pertanyaan->status = 1;
                $pertanyaan->save();

                $items = Pilihan::where('pertanyaan_id', $dt->id)->get();
                $pilihan = array();
                foreach ($items as $item) {
                    $pilihan = new Pilihan();
                    $pilihan->pertanyaan_id = $pertanyaan->id;
                    $pilihan->pilihan = $item->pilihan;
                    $pilihan->save();
                }
            }

            return redirect(route('admin.pertanyaan'))->with('success', 'Your data has been saved! ');
        } else {
            return redirect(route('admin.pertanyaan.copy'))->with('success', 'Maaf, data kosong');
        }
    }
}
