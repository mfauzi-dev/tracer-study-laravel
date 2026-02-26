@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Pertanyaan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Pertanyaan</div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

    <div class="section-body">

        <a href="{{ route('admin.pertanyaan.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Pertanyaan
        </a>

        <a href="{{ route('admin.pertanyaan.status') }}" class="btn btn-primary mb-4">
            Update Status Per Tahun Akademik
        </a>

        <a href="{{ route('admin.pertanyaan.copy') }}" class="btn btn-primary mb-4">
            Copy Pertanyaan
        </a>

        <form action="{{ route('admin.pertanyaan') }}" method="GET" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Pertanyaan"
                        value="{{ $search ?? '' }}">
                </div>

                <div class="col-md-3">
                    <select name="tahun_akademik_id" class="form-control">
                        <option value="">-- Filter Program Studi --</option>
                        @foreach ($tahunAkademik as $tahun)
                            <option value="{{ $tahun->id }}" {{ $tahunAkademikId == $tahun->id ? 'selected' : '' }}>
                                {{ $tahun->tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">-- Status --</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                            Non Aktif
                        </option>
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
                <h4>List Pertanyaan</h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Pertanyaan</th>
                                <th>Tahun Akademik</th>
                                <th>Status</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pertanyaan as $index => $item)
                                <tr>
                                    <td>{{ $pertanyaan->firstItem() + $index }}</td>

                                    <td>{{ $item->name }}</td>

                                    <td>{{ $item->tahun_akademik->tahun }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Non Aktif</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.pertanyaan.delete', $item->id) }}" method="POST"
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
                                        Data Pertanyaan Belum Ada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                {{ $pertanyaan->withQueryString()->links() }}
            </div>
        </div>

    </div>
@endsection
