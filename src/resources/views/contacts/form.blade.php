@extends('layouts.app')

@section('title')
    <title>お問い合わせフォーム</title>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush


@section('content')
    <header class="site-header">
      <h1 class="header-logo">FashionablyLate</h1>
    </header>

    <main>
      <div class="inner-container">
        <div class="form-container">
         <form action="{{ route('contacts.confirm') }}" method="POST" novalidate>
        @csrf
        <h1>Contact</h1>

                {{-- 氏名（姓・名） --}}
                <div class="form-group">
                    <label class="form-label">氏名<span class="required">※</span></label>
                    <div class="form-inputs">
                        <div class="form-input-with-error">
                            <input class="name-input"  type="text" name="last_name" placeholder="姓" value="{{ old('last_name') }}">
                            @error('last_name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-input-with-error">
                            <input class="name-input" type="text" name="first_name" placeholder="名" value="{{ old('first_name') }}">
                            @error('first_name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
        

                {{-- 性別（ラジオボタン） --}}
                <div class="form-group">
                    <label class="form-label">性別<span class="required">※</span></label>
                    <div class="radio-group">
                        <label>
                        <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性
                        </label>
                        <label>
                        <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性
                        </label>
                        <label>
                        <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他
                        </label>
                        <div class="form-input-with-error">
                        @error('gender')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        </div>  
                    </div>
                </div>
        

                {{-- メールアドレス --}}
                <div class="form-group">
                    <label class="form-label">メールアドレス<span class="required">※</span></label>
                    <div class="form-input-with-error">
                        <input type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>    
                </div>
        

                {{-- 電話番号 --}}
                <div class="form-group">
                    <label class="form-label">電話番号<span class="required">※</span></label>
                    <div class="form-input-with-error">
                        <input type="text" name="tel" value="{{ old('tel') }}">
                        @error('tel')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
        

                {{-- 住所 --}}
                <div class="form-group">
                    <label class="form-label">住所<span class="required">※</span></label>
                    <div class="form-input-with-error">
                        <input type="text" name="address" value="{{ old('address') }}">
                        @error('address')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
        

                {{-- 建物名 --}}
                <div class="form-group">
                    <label class="form-label">建物名</label>
                    <input type="text" name="building" value="{{ old('building') }}">
                </div>

                {{-- お問い合わせの種類 --}}
                <div class="form-group">
                    <label class="form-label">お問い合わせの種類<span class="required">※</span></label>
                    <div class="form-input-with-error">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>    
                </div>
        

                {{-- お問い合わせ内容 --}}
                <div class="form-group">
                    <label class="form-label">お問い合わせ内容<span class="required">※</span></label>
                    <div class="form-input-with-error">
                        <textarea name="detail" rows="5" maxlength="120">{{ old('detail') }}</textarea>
                        @error('detail')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
        

                {{-- ボタン --}}
                <div class="form-buttons">
                 <button type="submit">確認画面</button>
                </div>
             </form>
         </div>
    </div>
</main>

@endsection
