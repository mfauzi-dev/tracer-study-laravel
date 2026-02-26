@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Alumni</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.alumni') }}">Alumni</a></div>
            <div class="breadcrumb-item">Tambah</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tambah Alumni</h4>
        </div>

        <div class="card-body p-0">
            <form action="{{ route('admin.alumni.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <!-- Nama Alumni -->
                    <div class="form-group">
                        <label>Nama Alumni</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama alumni">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor Induk -->
                    <div class="form-group">
                        <label>Nomor Induk</label>
                        <input type="text" name="nomor_induk" value="{{ old('nomor_induk') }}"
                            class="form-control @error('nomor_induk') is-invalid @enderror"
                            placeholder="Masukkan nomor induk">
                        @error('nomor_induk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Fakultas -->
                    <div class="form-group">
                        <label>Fakultas</label>
                        <select name="fakultas_id" class="form-control @error('fakultas_id') is-invalid @enderror">
                            <option value="">-- Pilih Fakultas --</option>
                            @foreach ($fakultasList as $fakultas)
                                <option value="{{ $fakultas->id }}"
                                    {{ old('fakultas_id') == $fakultas->id ? 'selected' : '' }}>
                                    {{ $fakultas->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('fakultas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Program Studi -->
                    <div class="form-group">
                        <label>Program Studi</label>
                        <select name="program_studi_id"
                            class="form-control @error('program_studi_id') is-invalid @enderror">
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($programStudiList as $program)
                                <option value="{{ $program->id }}"
                                    {{ old('program_studi_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_studi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="form-group">
                        <label>Status</label>
                        <select name="active" class="form-control @error('active') is-invalid @enderror">
                            <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('active')
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
