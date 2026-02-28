@extends('layouts.master')

@section('content')
    <div class="section-header">
        <h1>Kuesioner</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Kuesioner</div>
            <div class="breadcrumb-item">List</div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            @if (!$dt)
                <form action="{{ route('alumni.list.store-jawaban', $data->id) }}" method="post">
                    @csrf
                @else
                    <form action="{{ route('alumni.list.update-jawaban', $data->id) }}" method="post">
                        @csrf
                        @method('put')
            @endif

            <div class="mb-3">
                <label>{{ $data->name }}</label>
            </div>

            <div class="mb-3">

                @if ($pilihan->count())
                    <label>Silahkan jawab salah satu!</label>

                    @foreach ($pilihan as $pilih)
                        <div class="form-check">

                            <input type="radio" name="pilihan_id" id="pilihan{{ $pilih->id }}"
                                value="{{ $pilih->id }}" class="form-check-input" {{-- CHECKED LOGIC --}}
                                {{ $dt ? ($dt->pilihan_id == $pilih->id ? 'checked' : '') : '' }}>

                            <label for="pilihan{{ $pilih->id }}" class="form-check-label">
                                {{ $pilih->pilihan }}
                            </label>

                        </div>
                    @endforeach

                    @error('pilihan_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @else
                    {{-- kalau essay --}}
                    <input type="text" name="jawaban_teks" class="form-control mt-2"
                        value="{{ old('jawaban_teks', $dt->jawaban_teks ?? '') }}">

                    @error('jawaban_teks')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @endif

            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    {{ $dt ? 'Update' : 'Save' }}
                </button>
            </div>

            </form>

        </div>
    </div>
@endsection
