@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Program Studi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Program Studi</div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

    <div class="section-body">

        <a href="{{ route('admin.program-studi.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Tambah Program Studi
        </a>

        <form action="{{ route('admin.program-studi') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Program Studi atau Fakultas"
                    value="{{ $search ?? '' }}">
                <button class="btn btn-primary" type="submit">Search</button>
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
                <h4>List Program Studi</h4>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Fakultas</th>
                                <th>Nama Program Studi</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($programStudis as $index => $item)
                                <tr>
                                    <td>
                                        {{ $programStudis->firstItem() + $index }}
                                    </td>

                                    <td>
                                        {{ $item->fakultas->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->name }}
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('admin.program-studi.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.program-studi.delete', $item->id) }}" method="POST"
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
                                    <td colspan="4" class="text-center">
                                        Data program studi belum ada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                {{ $programStudis->links() }}
            </div>
        </div>

    </div>
@endsection
