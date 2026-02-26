@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Biodata</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Biodata</div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('alumni.biodata.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image">Foto Profil Alumni</label>
                    <br>
                    <span class="text-danger" style="font-size: 14px">(Ukuran foto maksimal: 2mb)</span>
                    <input type="file" name="image" id="image" class="form-control mt-3">
                    @error('image')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control mt-2"
                        value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control mt-2"
                        value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat berdasarkan KTP</label>
                    <input type="text" name="alamat" id="alamat" class="form-control mt-2"
                        value="{{ old('alamat') }}">
                    @error('alamat')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telepon">No Handphone / Telepon</label>
                    <br>
                    <span class="text-danger" style="font-size: 14px">(Nomor yang sedang aktif)</span>
                    <input type="number" name="telepon" id="telepon" class="form-control mt-2"
                        value="{{ old('telepon') }}">
                    @error('telepon')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option selected disabled>Pilih Jenis Kelamin</option>
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
                        value="{{ old('nama_gelar') }}">
                    @error('nama_gelar')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ipk">IPK</label>
                    <input type="text" name="ipk" id="ipk" class="form-control mt-2"
                        value="{{ old('ipk') }}">
                    @error('ipk')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" name="angkatan" id="angkatan" class="form-control mt-2"
                        value="{{ old('angkatan') }}">
                    @error('angkatan')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
