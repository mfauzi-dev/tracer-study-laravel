@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Fakultas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Fakultas</a></div>
            <div class="breadcrumb-item"><a href="#">Table</a></div>
            {{-- <div class="breadcrumb-item">Form Validation</div> --}}
        </div>
    </div>

    <div class="section-body">

        <a href="{{ route('admin.tahun_akademik.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Tambah Tahun Akademik
        </a>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4>List Tahun Akademik</h4>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Tahun Akademik</th>
                                <th width="180" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($tahunAkademik as $index => $item)
                                <tr>
                                    <td>
                                        {{ $tahunAkademik->firstItem() + $index }}
                                    </td>
                                    <td>
                                        {{ $item->tahun }}
                                    </td>

                                    <td class="text-center">

                                        <form action="{{ route('admin.tahun_akademik.delete', $item->id) }}" method="POST"
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
                                    <td colspan="3" class="text-center">
                                        Data Tahun Akademik belum ada
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

            <div class="card-footer text-right">
                {{ $tahunAkademik->links() }}
            </div>
        </div>

    </div>
@endsection
