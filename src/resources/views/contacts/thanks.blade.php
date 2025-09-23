@extends('layouts.app')

@section('title', 'お問い合わせ完了')

@section('page_css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="thanks-message">
        <h1>お問い合わせありがとうございました</h1>
    </div>

    <div class="return-link">
        <a href="{{ route('contacts.form') }}">HOME</a>
    </div>
</div>
@endsection
