@extends('layouts.app')

@section('title')
    <title>お問い合わせ確認画面</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endpush

@section('content')
<header class="site-header">
  <h1 class="header-logo">FashionablyLate</h1>
</header>   

<main>
    <div class="confirm-container">
        <h1>Confirm</h1>

        <div class="confirm-table">
            <div class="row">
                <div class="label">氏名</div>
                <div class="value">{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</div>
            </div>
            <div class="row">
                <div class="label">性別</div> 
                <div class="value">
                    @if ($inputs['gender'] == 1)
                        男性
                    @elseif ($inputs['gender'] == 2)
                        女性
                    @else
                        その他
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="label">メールアドレス</div>
                <div class="value">{{ $inputs['email'] }}</div>
            </div>
            <div class="row">
                <div class="label">電話番号</div>
                <div class="value">{{ $inputs['tel'] }}</div>
            </div>
            <div class="row">
                <div class="label">住所</div>
                <div class="value">{{ $inputs['address'] }}</div>
            </div>
            <div class="row">
                <div class="label">建物名</div>
                <div class="value">{{ $inputs['building'] }}</div>
            </div>
            <div class="row">
                <div class="label">お問い合わせの種類</div>
                <div class="value">{{ $inputs['category_name'] ?? '' }}</div>
            </div>
            <div class="row">
                <div class="label">お問い合わせ内容</div>
                <div class="value">{{ $inputs['detail'] }}</div>
            </div>
        </div>
        <div class="confirm-buttons">
            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf
            
                @foreach ($inputs as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                <button type="submit">送信</button>
            </form>

            <form action="{{ route('contacts.back') }}" method="POST">
                @csrf
                @foreach ($inputs as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                <button type="submit">修正</button>
            </form>
        </div>
    </div>
</main>
@endsection
