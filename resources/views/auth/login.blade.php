@extends('app')

@section('title', 'ログイン')

@section('content')
    @include('navbar')
    <div class="container">
        <div class="row">

            <div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <h2 class="card-title text-center">ログイン</h5>
                @include('error_list')
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="emailInput">メールアドレス</label>
                                <input type="email" class="form-control" id="emailInput" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordInput">パスワード</label>
                                <input type="password" class="form-control" id="passwordInput" name="password" placeholder="パスワード" required>
                                <small class="form-text text-muted"><a href="{{ route('password.request') }}">※パスワードを忘れた場合</a></small>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">ログインしたままにする</label>
                            </div>
                            <input type="hidden" name="remember" id="remember" value="on">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">ログイン</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
