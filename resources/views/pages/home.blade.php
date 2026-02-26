@extends('layouts.app')

@section('title')
    Home
@endsection

@push('addon-style')
    <style>
        #map {
            width: 100%;
            height: 400px;
            border: 1px #fff solid
        }

        #content {
            list-style: none;
            /* text-decoration: none; */
            overflow-y: auto;
        }

        #content li {
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    <header class="text-center">
        <h1>
            Be The Young
            <br>
            Entrepreneur
            <br>
            With UNIBI
        </h1>
        <a href="{{ route('login') }}" class="btn btn-get-started px-4 mt-4">
            Get Started
        </a>
    </header>

    <main>
        <section class="section-maps text-center" id="location">
            <div class="container">
                <h3>Our alumni are spread all over
                    <br> Indonesia
                </h3>
            </div>
        </section>

        <section class="section-about-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about" id="about">
                            <h4>Tentang Tracer Study
                                <br>
                                Universitas Informatika dan Bisnis Indonesia
                            </h4>
                            <p class="text-justify">
                                Tracer study adalah sebuah studi mengenai lulusan lembaga penyelenggara pendidikan tinggi
                                yang bertujuan untuk menyediakan sebuah informasi tentang lulusan yang sudah bekerja atau
                                belum bekerja dan penilaian lulusan terhadap lembaga penyelenggara. Tracer study bermanfaat
                                sebagai sumber data bagi sebuah perguruan tinggi tentang kondisi mahasiswa yang telah lulus
                                dan sebagai sarana evaluasi perguruan tinggi dalam rangka untuk memperbaiki, meningkatkan
                                kualitas pendidikan dan pelayanan serta mewujudkan visi misi yang ingin dicapai.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact" id="contact">
                            <div class="card">
                                <h4>Pengumuman</h4>
                                <p>
                                    Jika mengalami kesulitan saat melakukan login
                                    <br>
                                    silahkan menghubungi admin melalui <span class="whatsapp"><a
                                            href="#">Whatsapp.</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
