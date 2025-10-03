@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header-nav')
<nav>
    <ul class="header-nav">
        <li class="header-nav__item">
            <a class="header-nav__link" href="/login">Logout</a>
        </li>
    </ul>
</nav>
@endsection

@section('content')
<div class="admin-form__content">
    <div class="admin-form__heading">
        <h2>Admin</h2>
    </div>
    <div class="search-form">
        <div class="search-form__item">
            <input type="text" placeholder="名前やメールアドレスを入力してください">
        </div>
        <div class="search-form__item">
            <select>
                <option>性別</option>
            </select>
        </div>
        <div class="search-form__item">
            <select>
                <option>お問い合わせの種類</option>
            </select>
        </div>
        <div class="search-form__item">
            <select>
                <option>年/月/日</option>
            </select>
        </div>
        <div class="search-form__buttons">
            <button class="search-form__button search">検索</button>
            <button class="search-form__button reset">リセット</button>
        </div>
    </div>

    <form class="form" action="/contacts/confirm" method="get">
        @csrf
    </form>
    @endsection