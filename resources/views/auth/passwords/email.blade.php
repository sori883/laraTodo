@extends('app')

@section('title', 'パスワード再設定')

@section('content')
    @include('navbar')
    <div class="container">
        <div class="row">

            <div class="mx-auto col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                <h2 class="card-title text-center">パスワード再設定</h5>
                @include('error_list')
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="card-text alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="emailInput">メールアドレス</label>
                                <input type="email" class="form-control" id="emailInput" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">ログイン</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
