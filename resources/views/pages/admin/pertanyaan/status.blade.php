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
            Ganti Status
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pertanyaan.status.store') }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="thn_akad_satu">Pilih Tahun Akademik</label>
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
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Tidak Active</option>
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
