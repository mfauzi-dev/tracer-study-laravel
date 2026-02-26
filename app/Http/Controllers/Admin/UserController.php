<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Fakultas;
use App\Models\Location;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(DataUserRequest $request)
    {
        DB::beginTransaction();

        try {

            $prodi = ProgramStudi::find($request->program_studi_id);
            $fakultas = Fakultas::find($request->fakultas_id);

            if(!$prodi || !$fakultas) {
                return ResponseHelper::jsonResponse(
                    'false',
                    'Fakultas atau Program Studi Tidak Ditemukan',
                        null,
                    404,
                );
            }

            $user = User::create([
                'name' => $request->name,
                'fakultas_id' => $fakultas->id,
                'program_studi_id' => $prodi->id,
                'role_as' => $request->role_as,
                'email' => $request->email,
                'nomor_induk' => $request->nomor_induk,
                'password' => Hash::make($request->password),
            ]);

            Location::create([
                'user_id' => $user->id,
                'fakultas_id' => $user->fakultas_id,
                'program_studi_id' => $user->program_studi_id
            ]);

            DB::commit();

            return ResponseHelper::jsonResponse(
                true,
                'User berhasil ditambahkan',
                new UserResource($user),
                '201'
            );

        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseHelper::jsonResponse(
                false, 
                $e->getMessage(), 
                null, 
                500);
        }
    }

    public function index(Request $request)
    {
         $request->validate([
            'search' => ['nullable', 'string'],
            'fakultas_id' => ['nullable', 'integer', 'exists:fakultas,id'],
            'program_studi_id' => ['nullable', 'integer', 'exists:program_studi,id'],
            'page' => ['nullable', 'integer', 'min:1'],
            'size' => ['nullable', 'integer', 'max:10']
        ]);

        try {
            $search = $request->search;
            $fakultasId = $request->fakultas_id;
            $programStudiId = $request->program_studi_id;
            $size = $request->input('size', 10);

            $query = User::with(['fakultas', 'program_studi']);
            
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('role_as', 'like', '%' . $search . '%')
                      ->orWhere('nomor_induk', 'like', '%' . $search . '%')
                      ->orWhereHas('fakultas', function ($fakultasQuery) use ($search) {
                        $fakultasQuery->where('name', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('program_studi', function ($prodiQuery) use ($search) {
                        $prodiQuery->where('name', 'like', '%' . $search . '%');
                      });
                });
            }

            if($fakultasId) {
                $query->where('fakultas_id', $fakultasId);
            }

            if($programStudiId) {
                $query->where('program_studi_id', $programStudiId);
            }



            $user = $query->latest()->paginate($size);

             $customResponse = [
            'users' => UserResource::collection($user),
            'meta' => [
                'current_page' => $user->currentPage(),
                'from'         => $user->firstItem(),
                'last_page'    => $user->lastPage(),
                'path'         => $user->path(),
                'per_page'     => $user->perPage(),
                'to'           => $user->lastItem(),
                'total'        => $user->total(),
            ],
        ];

        return ResponseHelper::jsonResponse(
            true, 
            'Daftar User Berhasil Diambil', 
            $customResponse, 
            200
        );

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(
                false, 
                $e->getMessage(), 
                null, 
                500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $user = User::with(['fakultas', 'program_studi'])->find($id);

            if(!$user) {
                return ResponseHelper::jsonResponse(
                    'false',
                    'User Tidak Ditemukan',
                    null,
                    404,
                );
            }

            $user->delete();

            DB::commit();

            return ResponseHelper::jsonResponse(
                'true',
                'User Berhasil Dihapus',
                new UserResource($user),
                200
            );
        
        } catch (\Exception $e) {
            DB::rollBack();

            return ResponseHelper::jsonResponse(
                false, 
                $e->getMessage(), 
                null, 
                500);
        }
    }
}
