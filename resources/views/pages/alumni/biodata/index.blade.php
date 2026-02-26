@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Biodata</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Biodata</div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            @endif
            <h1 class="text-center">
                {{ !$biodata ? 'Biodata belum diisi :( Harap diisi dahulu' : 'Biodata Sudah diisi nih! Yuk Cek Biodata' }}
            </h1>

            <div class="d-flex justify-content-center mt-5">
                {{-- @if ($cek < 1) --}}
                {{-- @endif --}}

                @if (!$biodata)
                    <a class="btn btn-sm btn-primary" href="{{ route('alumni.biodata.create') }}">Tambah
                        Biodata</a>
                @else
                    <a class="btn btn-sm btn-primary mr-2" href="{{ route('alumni.biodata.show') }}">Lihat
                        Biodata</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('alumni.biodata.edit') }}">Update
                        Biodata</a>
                @endif

            </div>
        </div>
    </div>
@endsection
