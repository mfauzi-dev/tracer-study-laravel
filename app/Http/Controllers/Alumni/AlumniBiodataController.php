<!-- <?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\User;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Alumni\BiodataRequest;
use App\Http\Requests\CreateBiodataRequest;
use App\Http\Requests\UpdateBiodataRequest;
use App\Http\Resources\BiodataResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AlumniBiodataController extends Controller
{
    // Create Biodata
    public function store(BiodataRequest $request)
    {
        try {
            $userId = Auth::id();
            
            $user = User::select('id', 'nomor_induk', 'fakultas_id', 'program_studi_id', 'name')
                ->find($userId);

            if (!$user) {
                return ResponseHelper::jsonResponse(false, 'User tidak ditemukan', null, 404);
            }

            // Cek biodata sudah ada atau belum
            $biodataExists = Biodata::where('user_id', $userId)->exists();

            if ($biodataExists) {
                // Hapus file yang baru diupload kalau biodata sudah ada
                if ($request->hasFile('image')) {
                    Storage::disk('public')->delete($request->file('image')->store('biodata', 'public'));
                }
                return ResponseHelper::jsonResponse(false, 'Biodata sudah dibuat untuk user ini', null, 400);
            }

            // Validasi file image
            if (!$request->hasFile('image')) {
                return ResponseHelper::jsonResponse(false, 'Gambar wajib diunggah', null, 400);
            }

            // Upload image
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('biodata', 'public');

            // Create biodata
            $biodata = Biodata::create([
                'user_id' => $user->id,
                'fakultas_id' => $user->fakultas_id,
                'program_studi_id' => $user->program_studi_id,
                'npm' => $user->nomor_induk,
                'name' => $user->name,
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

            return ResponseHelper::jsonResponse(
                true, 
                'Biodata berhasil dibuat', 
                new BiodataResource($biodata), 
                201
            );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    // Update Biodata
    public function update(BiodataRequest $request)
    {
        try {
            $userId = Auth::id();

            $biodata = Biodata::where('user_id', $userId)->first();

            if (!$biodata) {
                // Hapus file yang baru diupload kalau biodata tidak ada
                if ($request->hasFile('image')) {
                    Storage::disk('public')->delete($request->file('image')->store('biodata', 'public'));
                }
                return ResponseHelper::jsonResponse(false, 'Biodata tidak ditemukan', null, 404);
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Hapus image lama
                if ($biodata->image && Storage::disk('public')->exists($biodata->image)) {
                    Storage::disk('public')->delete($biodata->image);
                }
                // Upload image baru
                $biodata->image = $request->file('image')->store('biodata', 'public');
            }

            // Update data
            $biodata->tempat_lahir = $request->tempat_lahir ?? $biodata->tempat_lahir;
            $biodata->tanggal_lahir = $request->tanggal_lahir ?? $biodata->tanggal_lahir;
            $biodata->alamat = $request->alamat ?? $biodata->alamat;
            $biodata->telepon = $request->telepon ?? $biodata->telepon;
            $biodata->jenis_kelamin = $request->jenis_kelamin ?? $biodata->jenis_kelamin;
            $biodata->nama_gelar = $request->nama_gelar ?? $biodata->nama_gelar;
            $biodata->ipk = $request->ipk ?? $biodata->ipk;
            $biodata->angkatan = $request->angkatan ?? $biodata->angkatan;

            $biodata->save();

            return ResponseHelper::jsonResponse(
                true, 
                'Biodata berhasil diupdate', 
                new BiodataResource($biodata), 
                200
            );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    // Delete Biodata
    public function destroy($id)
    {
        try {
            $biodata = Biodata::find($id);

            if (!$biodata) {
                return ResponseHelper::jsonResponse(false, 'Biodata tidak ditemukan', null, 404);
            }

            // Hapus image
            if ($biodata->image && Storage::disk('public')->exists($biodata->image)) {
                Storage::disk('public')->delete($biodata->image);
            }

            $biodata->delete();

            return ResponseHelper::jsonResponse(true, 'Biodata berhasil dihapus', null, 200);

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    // Get My Biodata
    public function getMyBiodata()
    {
        try {
            $userId = Auth::id();

            $biodata = Biodata::where('user_id', $userId)->first();

            if (!$biodata) {
                return ResponseHelper::jsonResponse(
                    false, 
                    'Biodata belum dibuat', 
                    ['redirect_to' => '/create-biodata'], 
                    404
                );
            }

            return ResponseHelper::jsonResponse(
                true, 
                'Ini adalah biodata anda', 
                new BiodataResource($biodata), 
                200
            );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    // Get User Biodata by ID
    public function show($id)
    {
        try {
            $biodata = Biodata::find($id);

            if (!$biodata) {
                return ResponseHelper::jsonResponse(false, 'Biodata tidak ditemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(
                true, 
                'User Biodata berhasil didapatkan', 
                new BiodataResource($biodata), 
                200
            );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    // Get All Biodata with Filters
    public function index(Request $request)
    {
        $request->validate([
            'fakultas_id' => ['nullable', 'integer', 'exists:fakultas,id'],
            'program_studi_id' => ['nullable', 'integer', 'exists:program_studis,id'],
            'jenis_kelamin' => ['nullable', 'string', 'in:Laki-laki,Perempuan'],
            'search' => ['nullable', 'string'],
            'page' => ['nullable', 'integer', 'min:1'],
            'size' => ['nullable', 'integer', 'max:100'],
        ]);

        try {
            $search = $request->search;
            $fakultasId = $request->fakultas_id;
            $programStudiId = $request->program_studi_id;
            $jenisKelamin = $request->jenis_kelamin;
            $size = $request->input('size', 10);

            $query = Biodata::query();

            // Filter search (name or npm)
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('npm', 'like', '%' . $search . '%');
                });
            }

            // Filter fakultas_id
            if ($fakultasId) {
                $query->where('fakultas_id', $fakultasId);
            }

            // Filter program_studi_id
            if ($programStudiId) {
                $query->where('program_studi_id', $programStudiId);
            }

            // Filter jenis_kelamin
            if ($jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            }

            // Load relations
            $query->with(['fakultas', 'programStudi']);

            // Paginate
            $biodatas = $query->orderBy('id', 'asc')->paginate($size);

            $customResponse = [
                'biodata' => BiodataResource::collection($biodatas),
                'meta' => [
                    'current_page' => $biodatas->currentPage(),
                    'from'         => $biodatas->firstItem(),
                    'last_page'    => $biodatas->lastPage(),
                    'path'         => $biodatas->path(),
                    'per_page'     => $biodatas->perPage(),
                    'to'           => $biodatas->lastItem(),
                    'total'        => $biodatas->total(),
                ],
            ];

            return ResponseHelper::jsonResponse(
                true, 
                'Semua biodata berhasil didapatkan', 
                $customResponse, 
                200
            );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }
} -->