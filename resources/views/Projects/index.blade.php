@extends('app')

@section('title', 'TOP')

@section('content')
@include('navbar')
  <div class="container">
    <div class="row">

        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="{{ route ('projects.index') }}">Inbox</a>
                </li>
                 @foreach($projects as $project)
                <li class="list-group-item">
                    <a href="">{{ $project->title }}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-8">

        </div>

    </div>
  </div>
@endsection
