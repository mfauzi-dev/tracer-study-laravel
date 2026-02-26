@extends('layouts.master')

@push('addon-style')
    <style>
        .card {
            color: #000;
            padding-bottom: 30px;
        }

        .kartu {
            width: 800px;
            margin: 0 auto;
            margin-top: 70px;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, .03);
            transition: all .3s;
            background-color: #1f8a45;
            border: solid 8px #4fd47e;
        }

        .foto {
            padding: 20px;
            margin-left: 30px;
            margin-top: 10px;
        }

        tbody {
            font-size: 20px;
            font-weight: 300;
            color: #000;
        }

        .biodata {
            margin-top: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="section-header">
        <h1>Biodata</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active">Biodata</div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>
    <div class="card shadow">
        <div class="row">
            <div class="col-md-4">
                <div class="foto">
                    <img src="{{ Storage::url($biodata->image) }}" alt="{{ $biodata->title }}" class="img-thumbnail"
                        alt="" width="300" height="auto">
                </div>
            </div>
            <div class="col-md-8 kertas-biodata">
                <div class="biodata">
                    <table width="100%" border="0">
                        <tbody>
                            <tr>
                                <td valign="top">
                                    <table border="0" width="100%" style="padding-left: 2px; padding-right: 13px;">
                                        <tbody>
                                            <tr>
                                                <td width="25%" valign="top" class="textt">Nama</td>
                                                <td width="2%">:</td>
                                                <td>{{ $biodata->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td width="25%" valign="top" class="textt">NPM</td>
                                                <td width="2%">:</td>
                                                <td>{{ $biodata->npm }}</td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Fakultas</td>
                                                <td>:</td>
                                                <td>{{ $biodata->fakultas->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Program Studi</td>
                                                <td>:</td>
                                                <td>{{ $biodata->prodi->name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Jenis Kelamin</td>
                                                <td>:</td>
                                                <td>{{ $biodata->jenis_kelamin }}</td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Tempat Lahir</td>
                                                <td>:</td>
                                                <td>{{ $biodata->tempat_lahir }}</td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Tanggal Lahir</td>
                                                <td>:</td>
                                                <td>{{ \Carbon\Carbon::create($biodata->tanggal_lahir)->format('F n, Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Alamat</td>
                                                <td>:</td>
                                                <td>{{ $biodata->alamat }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Telepon</td>
                                                <td>:</td>
                                                <td>{{ $biodata->telepon }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="textt">Angkatan</td>
                                                <td>:</td>
                                                <td>{{ $biodata->angkatan }}</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="textt">Nama Gelar</td>
                                                <td valign="top">:</td>
                                                <td>{{ $biodata->nama_gelar }}</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" class="textt">IPK</td>
                                                <td valign="top">:</td>
                                                <td>{{ $biodata->ipk }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ route('alumni.biodata') }}" class="btn btn-outline-info mt-3">Back</a>
    </div>
@endsection
