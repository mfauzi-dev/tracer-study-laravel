@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Program Studi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Program Studi</a></div>
            <div class="breadcrumb-item"><a href="#">Table</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tambah Program Studi</h4>
        </div>

        <form action="{{ route('admin.program-studi.store') }}" method="POST">
            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label>Fakultas</label>
                    <select name="fakultas_id" class="form-control @error('fakultas_id') is-invalid @enderror">

                        <option value="">-- Pilih Fakultas --</option>

                        @foreach ($fakultas as $f)
                            <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>
                                {{ $f->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('fakultas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nama Program Studi</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama program studi">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer text-right">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
