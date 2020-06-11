@extends('app')

@section('title', 'TOP')

@section('content')
@include('navbar')
  <div class="container-fluid">
    <div class="row">
        @include('projects.sidebar')
        @include('tasks.view_list')
    </div>
  </div>
@endsection
