@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Program Studi</h1>
        <div class="breadcrumb-item">
            <a href="{{ route('admin.program-studi') }}">Program Studi</a>
        </div>
        <div class="breadcrumb-item">Edit</div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Edit Program Studi</h4>
        </div>

        <form action="{{ route('admin.program-studi.update', $programStudi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label>Fakultas</label>
                    <select name="fakultas_id" class="form-control @error('fakultas_id') is-invalid @enderror">

                        @foreach ($fakultas as $f)
                            <option value="{{ $f->id }}"
                                {{ old('fakultas_id', $programStudi->fakultas_id) == $f->id ? 'selected' : '' }}>
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
                    <input type="text" name="name" value="{{ old('name', $programStudi->name) }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer text-right">
                <a href="{{ route('admin.program-studi') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
