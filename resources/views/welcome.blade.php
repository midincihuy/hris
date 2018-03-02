@extends('adminlte::master')

@section('body_class', 'hold-transition lockscreen')

@section('body')
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="{{route('start')}}">{{ env('APP_NAME') }}</a>
    </div>
    <div class="text-center">
      <a href="{{route('login')}}">
        <h1>LOGIN HERE</h1>
      </a>
    </div>
    <div class="lockscreen-footer text-center">
      Copyright &copy; {{date("Y")}}
    </div>
  </div>
  <!-- /.center -->
@endsection
