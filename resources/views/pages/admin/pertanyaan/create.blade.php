@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Pertanyaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('admin.pertanyaan') }}">Pertanyaan</a>
            </div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tambah Pertanyaan</h4>
        </div>

        <div class="card-body p-0">
            <form action="{{ route('admin.pertanyaan.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <!-- Nama Pertanyaan -->
                    <div class="form-group">
                        <label>Pertanyaan</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan pertanyaan">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tahun Akademik -->
                    <div class="form-group">
                        <label>Tahun Akademik</label>
                        <select name="tahun_akademik_id"
                            class="form-control @error('tahun_akademik_id') is-invalid @enderror">

                            <option value="">-- Pilih Tahun Akademik --</option>

                            @foreach ($tahunAkademik as $tahun)
                                <option value="{{ $tahun->id }}"
                                    {{ old('tahun_akademik_id') == $tahun->id ? 'selected' : '' }}>
                                    {{ $tahun->tahun }}
                                </option>
                            @endforeach
                        </select>

                        @error('tahun_akademik_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>
                                Non Aktif
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
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
