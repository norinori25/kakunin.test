@extends('layouts.app')

@section('title')
    <title>新規ユーザー登録</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')

<header class="site-header">
    <h1 class="header-logo">FashionablyLate</h1>
    <nav class="header-nav">
        <a href="/login" class="header-nav__link">login</a>
    </nav>
</header>


<main>
<div class="form-container">
    <h1>Register</h1>

    <form method="POST" action="/register">
        @csrf

        {{-- 名前 --}}
        <div class="form-group">
            <label>お名前<span class="required">※</span></label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- メールアドレス --}}
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

        {{-- ボタン --}}
        <div class="form-buttons">
            <button type="submit">登録</button>
         </div>
    </form>
</div>
</main>

@endsection
