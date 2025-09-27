@extends('layouts.app')

@section('title')
    <title>ログイン</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')

<header class="site-header">
    <h1 class="header-logo">FashionablyLate</h1>
    <nav class="header-nav">
        <a href="{{ route('register') }}" class="header-nav__link">register</a>
    </nav>
</header>   

<main>
    <div class="form-container">
        <h1>Login</h1>

        {{-- メールアドレス --}}
        <form method="POST" action="/login" novalidate>
            @csrf      
            <div class="form-group">
                <label>メールアドレス<span class="required">※</span></label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label>パスワード<span class="required">※</span></label>
                <input type="password" name="password">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-buttons">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
</main>

@endsection
