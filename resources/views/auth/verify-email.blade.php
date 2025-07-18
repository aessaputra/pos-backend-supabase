@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
<div class="card card-md">
    <div class="card-body">
      <h2 class="h2 text-center mb-4">Verify Your Email</h2>
      <p class="text-muted mb-4">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
      </p>

      @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
      @endif

      <div class="d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link">
                {{ __('Log Out') }}
            </button>
        </form>
      </div>
    </div>
</div>
@endsection
