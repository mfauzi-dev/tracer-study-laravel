@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Alumni</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Alumni</div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

    <div class="section-body">

        <a href="{{ route('admin.alumni.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Alumni
        </a>

        <form action="{{ route('admin.alumni') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari Nama Alumni, Program Studi, Fakultas" value="{{ $search ?? '' }}">
                </div>

                <div class="col-md-3">
                    <select name="fakultas_id" class="form-control">
                        <option value="">-- Filter Fakultas --</option>
                        @foreach ($fakultasList as $fakultas)
                            <option value="{{ $fakultas->id }}" {{ $fakultasId == $fakultas->id ? 'selected' : '' }}>
                                {{ $fakultas->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="program_studi_id" class="form-control">
                        <option value="">-- Filter Program Studi --</option>
                        @foreach ($programStudiList as $program)
                            <option value="{{ $program->id }}" {{ $programStudiId == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>List Alumni</h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Alumni</th>
                                <th>NPM</th>
                                <th>Email</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($alumnis as $index => $item)
                                <tr>
                                    <td>{{ $alumnis->firstItem() + $index }}</td>

                                    <td>{{ $item->name }}</td>

                                    <td>{{ $item->nomor_induk }}</td>

                                    <td>{{ $item->email }}</td>

                                    <td>{{ $item->fakultas->name ?? '-' }}</td>

                                    <td>{{ $item->program_studi->name ?? '-' }}</td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.alumni.delete', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Data alumni belum ada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                {{ $alumnis->withQueryString()->links() }}
            </div>
        </div>

    </div>
@endsection
