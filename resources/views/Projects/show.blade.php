@extends('app')

@section('title', 'TOP')

@section('content')
@include('navbar')
  <div class="container-fluid">
    <div class="row">
        @include('Projects.sidebar')
        @include('Projects.tasks_view')
    </div>
  </div>
@endsection
