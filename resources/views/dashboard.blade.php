@extends('layouts.master')

@section('title', 'Dashboard')

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <p class="card-text">
                {{ __("You're logged in!") }} Selamat datang di panel admin baru Anda!
            </p>
        </div>
    </div>
@endsection
