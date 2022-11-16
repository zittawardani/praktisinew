@extends('_layouts.app')
@section('content')

<section class="py-5">
    <div class="container" style="border-radius: 20px;">
    <div class="row my-5">
        <div class="col-md-6 mt-md-0 mt-4">
            <p>Selamat! Kamu telah menjadi anggota SM Entertainment Indonesia <br>Berikut kartu membermu :</p>
            <div class="card">
                <div class="card-header d-flex justify-content-start">
                    <img src="{{ asset('assets/images/sm1.jpg') }}" class="img-fluid" width="30">
                    <p class="mb-0 ms-3 d-flex align-items-center" style="letter-spacing: 1px">KARTU MEMBER</p>
                </div>
                <div class="card-body">
                    <h2><b>{{ $user->name }}</b></h2>
                    <p class="text-secondary mb-0">{{ $user->email }}</p>
                    <hr class="text-secondary">
                    <small class="text-secondary mb-0">Bergabung Sejak <b>{{ $user->created_at }}</b></small>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection