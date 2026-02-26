@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Kuesioner</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Kuesioner</div>
            <div class="breadcrumb-item">List</div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body table-responsive">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $dt)
                        <tr>
                            <td>
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td>{!! $dt->name !!}</td>
                            <td>
                                <a href="{{ route('alumni.list.pertanyaan', $dt->slug) }}"
                                    class="btn btn-sm btn-info me-2">Jawab</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Data Kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $data->links() }}
        </div>
    </div>
@endsection
