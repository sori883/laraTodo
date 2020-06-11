@extends('app')

@section('title', '登録')

@section('content')
@include('navbar')
  <div class="container">
    <div class="row">

        <div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
            <h2 class="card-title text-center">ユーザ登録</h5>
            @include('error_list')
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="usernameInput">ユーザ名</label>
                            <input type="text" class="form-control" id="usernameInput" name="name" placeholder="ユーザ名" value="{{ old('name') }}" required>
                            <small id="emailHelp" class="form-text text-muted">英数字3～16文字（登録後の変更は出来ません）</small>
                        </div>
                        <div class="form-group">
                            <label for="emailInput">メールアドレス</label>
                            <input type="email" class="form-control" id="emailInput" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordInput">パスワード</label>
                            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="パスワード" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordConfirmInput">パスワード（確認）</label>
                            <input type="password" class="form-control" id="passwordConfirmInput" name="password_confirmation" placeholder="パスワード（確認）" required>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">登録</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
  </div>

@endsection
