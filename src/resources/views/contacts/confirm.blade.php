{{-- resources/views/contacts/confirm.blade.php --}}
@extends('layouts.app')

@section('title')
    <title>お問い合わせ確認画面</title>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endpush

@section('content')
    <div class="confirm-container">
        <h1>確認画面</h1>

        <div class="confirm-table">
            <div class="row">
                <div class="label">氏名</div>
                <div class="value">{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</div>
            </div>
            <div class="row">
                <div class="label">性別</div>
                <div class="value">
                    @php
                        $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
                    @endphp
                    {{ $genders[$inputs['gender']] ?? '' }}
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
                <div class="label">お問い合わせの種類</div>
                <div class="value">{{ $inputs['category_name'] ?? '' }}</div>
            </div>
            <div class="row">
                <div class="label">お問い合わせ内容</div>
                <div class="value">{{ $inputs['content'] }}</div>
            </div>
        </div>

        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            @foreach ($inputs as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <div class="confirm-buttons">
                <button type="submit" name="action" value="back">修正する</button>
                <button type="submit" name="action" value="submit">送信する</button>
            </div>
        </form>
    </div>
@endsection
