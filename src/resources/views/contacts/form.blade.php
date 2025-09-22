@extends('layouts.app')

@section('title')
    <title>お問い合わせフォーム</title>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush


@section('content')

  <div class="form-container">
    <form action="{{ route('contacts.confirm') }}" method="POST">
        @csrf
        <h1>Contact</h1>
        {{-- 氏名（姓・名） --}}
        <div class="form-group">
            <label class="form-label">氏名<span class="required">※</span></label>
            <div class="form-inputs">
                <input class="name-input"  type="text" name="last_name" placeholder="姓" value="{{ old('last_name') }}">
                <input class="name-input" type="text" name="first_name" placeholder="名" value="{{ old('first_name') }}">
            </div>
        </div>
        @error('last_name')
            <p class="error">{{ $message }}</p>
        @enderror
        @error('first_name')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 性別（ラジオボタン） --}}
        <div class="form-group">
          <label class="form-label">性別<span class="required">※</span></label>
          <div class="radio-group">
            <label>
              <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>
            男性
            </label>
            <label>
              <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性
            </label>
            <label>
              <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他
            </label>
          </div>
        </div>
        @error('gender')
            <p class="error">{{ $message }}</p>
        @enderror


        {{-- メールアドレス --}}
        <div class="form-group">
            <label class="form-label">メールアドレス<span class="required">※</span></label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 電話番号 --}}
        <div class="form-group">
            <label class="form-label">電話番号<span class="required">※</span></label>
            <input type="text" name="tel" value="{{ old('tel') }}">
        </div>
        @error('tel')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- 住所 --}}
        <div class="form-group">
            <label class="form-label">住所<span class="required">※</span></label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>
        @error('address')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- お問い合わせの種類 --}}
        <div class="form-group">
            <label class="form-label">お問い合わせの種類<span class="required">※</span></label>
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('category_id')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <label class="form-label">お問い合わせ内容<span class="required">※</span></label>
            <textarea name="content" rows="5" maxlength="120">{{ old('content') }}</textarea>
        </div>
        @error('content')
            <p class="error">{{ $message }}</p>
        @enderror

        {{-- ボタン --}}
        <div class="form-buttons">
            <button type="submit">確認画面</button>
        </div>
    </form>
  </div>
@endsection
