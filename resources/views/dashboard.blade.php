@extends('layouts.main')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>

    <a href="{{ route('logout') }}">ini tombol logout</a>
@endsection
