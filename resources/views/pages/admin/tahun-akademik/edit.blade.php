@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Fakultas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('admin.fakultas') }}">Fakultas</a>
            </div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Edit Fakultas</h4>
        </div>

        <div class="card-body p-0">

            <form action="{{ route('admin.fakultas.update', $fakultas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Fakultas</label>

                        <input type="text" name="name" value="{{ old('name', $fakultas->name) }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama fakultas">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ route('admin.fakultas') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
