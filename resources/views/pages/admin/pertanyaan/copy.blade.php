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
            Copy Pertanyaan
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('admin.pertanyaan.copy.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="thn_akad_satu">Copy ke Tahun Akademik</label>
                    <select name="thn_akad_satu" id="thn_akad_satu" class="form-control mt-2">
                        <option selected disabled>Pilih Tahun Akademik</option>
                        @foreach ($tahunAkademik as $thn)
                            <option value="{{ $thn->id }}">{{ $thn->tahun }}</option>
                        @endforeach
                    </select>
                    @error('thn_akad')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="thn_akad_dua">Record dari Tahun Akademik</label>
                    <select name="thn_akad_dua" id="thn_akad_dua" class="form-control mt-2">
                        <option selected disabled>Pilih Tahun Akademik</option>
                        @foreach ($tahunAkademik as $thn)
                            <option value="{{ $thn->id }}">{{ $thn->tahun }}</option>
                        @endforeach
                    </select>
                    @error('thn_akad')
                        <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex mb-3">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
