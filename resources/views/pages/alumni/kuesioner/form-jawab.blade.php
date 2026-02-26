@extends('layouts.alumni')

@section('title')
    Jawab Pertanyaan
@endsection

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                {{ $data->tahun_akademik->tahun }}
            </div>
            <div class="card-body">
                @if ($cek < 1)
                    <form action="{{ route('alumni.list.store-jawaban', $data->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="pertanyaan">{{ $data->pertanyaan }}</label>
                        </div>
                        <div class="mb-3">
                            @if ($pilihan->count())
                                {{-- @if ($pilihanc) --}}
                                <label for="pilihan">Silahkan jawab salah satu!</label>
                                @foreach ($pilihan as $pilih)
                                    <div class="form-check">
                                        <input type="radio" name="jawaban" id="{{ $pilih->id }}"
                                            value="{{ $pilih->pilihan }}" class="form-check-input">
                                        <label for="{{ $pilih->id }}"
                                            class="form-check-label">{{ $pilih->pilihan }}</label>
                                        @error('jawaban')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            @else
                                <input type="text" name="jawaban" id="pertanyaan" class="form-control mt-2"
                                    value="{{ old('jawaban') }}">
                                @error('jawaban')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                @else
                    <form action="{{ route('alumni.list.update-jawaban', $data->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="pertanyaan">{{ $data->pertanyaan }}</label>
                        </div>
                        <div class="mb-3">
                            @if ($pilihan->count())
                                {{-- @if ($pilihanc) --}}
                                <label for="pilihan">Silahkan jawab salah satu!</label>
                                @foreach ($pilihan as $pilih)
                                    <div class="form-check">
                                        <input type="radio" name="jawaban" id="{{ $pilih->id }}"
                                            value="{{ $pilih->pilihan }}" class="form-check-input"
                                            {{ $dt->jawaban === $pilih->pilihan ? 'checked' : '' }}>
                                        <label for="{{ $pilih->id }}"
                                            class="form-check-label">{{ $pilih->pilihan }}</label>
                                        @error('jawaban')
                                            <span class="text-danger mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            @else
                                <input type="text" name="jawaban" id="pertanyaan" placeholder="Cth: Bandung, Jawabarat"
                                    class="form-control mt-2" value="{{ old('jawaban') ?? $dt->jawaban }}">
                                @error('jawaban')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>
                        {{-- <div class="mb-3">
                            <label for="pertanyaan">{{ $data->pertanyaan }}</label>
                            <input type="text" name="jawaban" id="pertanyaan" class="form-control mt-2"
                                value="{{ old('jawaban') ?? $dt->jawaban }}">
                            @error('jawaban')
                                <span class="text-danger mt-2">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
