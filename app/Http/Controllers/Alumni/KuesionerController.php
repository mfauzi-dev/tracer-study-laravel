<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use App\Models\Pilihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuesionerController extends Controller
{
    
    public function index()
    {
        $data = Pertanyaan::with('tahun_akademik')->where('status', 1)->paginate(10);
        return view('pages.alumni.kuesioner.list-pertanyaan', compact('data'));
    }

    public function detailPertanyaan($slug)
    {
        $data = Pertanyaan::with('tahun_akademik')
            ->where('slug', $slug)
            ->firstOrFail();
        $pilihan = Pilihan::where('pertanyaan_id', $data->id)->get();
        // $pilihanc = Pilihan::where('pertanyaan_id', $data->id)->count();
        $dt = Jawaban::where('user_id', Auth::user()->id)->where('pertanyaan_id', $data->id)->first();

        return view('pages.alumni.kuesioner.form-jawab', compact(['data', 'dt', 'pilihan']));
    }

    public function storeJawaban(Request $request, $id)
    {
        $request->validate([
            'pilihan_id'   => 'nullable|exists:pilihans,id',
            'jawaban_teks' => 'nullable|string|min:2|max:255',
        ]);

        $pertanyaan = Pertanyaan::findOrFail($id);


        Jawaban::create([
            'user_id' => Auth::id(),
            'pertanyaan_id' => $pertanyaan->id,
            'tahun_akademik' => $pertanyaan->tahun_akademik->tahun,
            'pilihan_id' => $request->pilihan_id,
            'jawaban_teks' => $request->jawaban_teks,

        ]);


        return redirect()->route('alumni.list.kuesioner')->with('success', 'Jawaban berhasil disimpan!');
    }

    public function updateJawaban(Request $request, $id)
    {
        $request->validate([
            'pilihan_id'   => 'nullable|exists:pilihans,id',
            'jawaban_teks' => 'nullable|string|min:2|max:255',
        ]);

        Jawaban::where('user_id', Auth::id())
            ->where('pertanyaan_id', $id)
            ->update([
                'pilihan_id' => $request->pilihan_id,
                'jawaban_teks' => $request->jawaban_teks,
            ]);

        return redirect(route('alumni.list.kuesioner'))
            ->with('success', 'Jawaban berhasil diupdate!');
    }
}
