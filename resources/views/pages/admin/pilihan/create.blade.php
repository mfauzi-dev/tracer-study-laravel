@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Pilihan Jawaban</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">
                <a href="{{ route('admin.pilihan') }}">Pilihan Jawaban</a>
            </div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tambah Pilihan Jawaban</h4>
        </div>

        <div class="card-body p-0">
            <form action="{{ route('admin.pilihan.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <!-- Tahun Akademik -->
                    <div class="form-group">
                        <label>Pertanyaan</label>
                        <select name="pertanyaan_id" class="form-control">
                            <option value="">-- List Pertanyaan --</option>
                            @foreach ($pertanyaanList as $pertanyaan)
                                <option value="{{ $pertanyaan->id }}"
                                    {{ old('pertanyaan_id') == $pertanyaan->id ? 'selected' : '' }}>
                                    {{ $pertanyaan->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('pertanyaan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Pilihan</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan pilihan jawaban">
                        @error('name')
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
