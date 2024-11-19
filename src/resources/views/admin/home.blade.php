@extends('layouts.app_admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_home.css') }}">
@endsection

@section('content')
<h2 class="theme">管理者用ページ</h2>
<div class="admin__container">
    <div class="registration__container">
        <h2 class="theme">店舗代表者登録</h2>
        <form action="{{ route('admin.createRepresentative') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">名前:</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label for="repid">代表者ID:</label>
                <input type="text" name="repid" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="create_btn">店舗代表者を作成</button>
        </form>
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
    </div>

    <div class="broadcast__container">
        <h2 class="theme">ユーザー一斉メール送信フォーム</h2>
        <form action="{{ route('admin.sendBroadcastEmail') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email_title">メールタイトル:</label>
                <input type="text" name="email_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email_body">メール本文:</label>
                <textarea name="email_body" class="form-control" rows="6" required></textarea>
            </div>
            <button type="submit" class="send_btn">メール送信</button>
        </form>
        @if(session('broadcast_success'))
            <p class="success">{{ session('broadcast_success') }}</p>
        @endif
    </div>
</div>
@endsection