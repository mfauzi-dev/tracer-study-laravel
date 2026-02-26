@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Fakultas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Fakultas</a></div>
            <div class="breadcrumb-item"><a href="#">Table</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tambah Fakultas</h4>
        </div>

        <div class="card-body p-0">

            <form action="{{ route('admin.fakultas.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Fakultas</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama fakultas">

                        @error('name')
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
