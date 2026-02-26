@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Tahun Akademik</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Tahun Akademik</a></div>
            <div class="breadcrumb-item"><a href="#">Table</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tambah Tahun Akademik</h4>
        </div>

        <div class="card-body p-0">

            <form action="{{ route('admin.tahun_akademik.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Tahun Akademik</label>
                        <input type="text" name="tahun" value="{{ old('tahun') }}"
                            class="form-control @error('tahun') is-invalid @enderror"
                            placeholder="Masukkan nama Tahun Akademik (2024-2025)">

                        @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
