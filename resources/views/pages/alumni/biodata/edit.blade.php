@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Biodata</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Biodata</div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('alumni.biodata.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="image">Foto Profil Alumni</label>
                    <br>
                    <span class="text-danger" style="font-size: 14px">(Ukuran foto maksimal: 2mb)</span>
                    <img src="{{ Storage::url($biodata->image) }}" alt="" style="width: 150px" class="d-block mt-3">
                    <input type="file" name="image" id="image" class="form-control mt-3"
                        value="{{ $biodata->image }}">
                    @error('image')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control mt-2"
                        value="{{ old('tempat_lahir') ?? $biodata->tempat_lahir }}">
                    @error('tempat_lahir')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control mt-2"
                        value="{{ old('tanggal_lahir') ?? $biodata->tanggal_lahir }}">
                    @error('tanggal_lahir')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat sesuai KTP</label>
                    <input type="text" name="alamat" id="alamat" class="form-control mt-2"
                        value="{{ old('alamat') ?? $biodata->alamat }}">
                    @error('alamat')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telepon">No Handphone / Telepon</label>
                    <br>
                    <span class="text-danger" style="font-size: 14px">(Nomor yang sedang aktif)</span>
                    <input type="text" name="telepon" id="telepon" class="form-control mt-2"
                        value="{{ old('telepon') ?? $biodata->telepon }}">
                    @error('telepon')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option {{ $biodata->jenis_kelamin ? 'selected' : '' }} value="{{ $biodata->jenis_kelamin }}">
                            Jenis Kelamin : {{ $biodata->jenis_kelamin }}
                        </option>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    @error('telepon')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama_gelar">Nama Gelar</label>
                    <input type="text" name="nama_gelar" id="nama_gelar" class="form-control mt-2"
                        value="{{ old('nama_gelar') ?? $biodata->nama_gelar }}">
                    @error('nama_gelar')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ipk">IPK</label>
                    <input type="text" name="ipk" id="ipk" class="form-control mt-2"
                        value="{{ old('ipk') ?? $biodata->ipk }}">
                    @error('ipk')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" name="angkatan" id="angkatan" class="form-control mt-2"
                        value="{{ old('angkatan') ?? $biodata->angkatan }}">
                    @error('angkatan')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex mb-3">
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('alumni.biodata') }}" class="btn btn-outline-info">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
