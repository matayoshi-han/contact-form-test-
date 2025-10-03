@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection


@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="first-name" placeholder="例:山田" value="{{ old('name') }}" />
                </div>
                <div class="form__input--text">
                    <input type="text" name="last-name" placeholder="例:太郎" value="{{ old('name') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション-->
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" id="male" value="male">
                    <label for="male">男性</label>

                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">女性</label>

                    <input type="radio" name="gender" id="other" value="other">
                    <label for="other">その他</label>
                </div>
                <div class="form__error">
                    <!--バリデーション-->
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション-->
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--split">
                    <!-- 最初の入力欄（3桁） -->
                    <input type="tel" name="tel1" placeholder="080" maxlength="3" value="{{ old('tel1') }}" pattern="[0-9]{3}">
                    <span>-</span>
                    <!-- 2番目の入力欄（4桁） -->
                    <input type="tel" name="tel2" placeholder="1234" maxlength="4" value="{{ old('tel2') }}" pattern="[0-9]{4}">
                    <span>-</span>
                    <!-- 3番目の入力欄（4桁） -->
                    <input type="tel" name="tel3" placeholder="5678" maxlength="4" value="{{ old('tel3') }}" pattern="[0-9]{4}">
                </div>
                <div class="form__error">
                    <!-- バリデーションエラーメッセージの表示 -->
                    @error('tel')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="address" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    <!--バリデーション-->
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="detail" name="detail" placeholder="例:千駄ヶ谷マンション101" value="{{ old('detail') }}" />
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <select name="category_id">
                    <option value="">選択してください</option>
                    <option value="">
                        @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                    </option>
                </select>
                <div class="form__error">
                    <!--バリデーション-->
                    <div class="form__error">
                        <!--バリデーション-->
                        @error('category')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="content" placeholder="お問い合わせ内容をご記載ください"></textarea>
                </div>
                <div class="form__error">
                    <!--バリデーション-->
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection