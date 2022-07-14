@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div style="padding: 2rem">Добро пожаловать!</div>
    @else
        <div style="padding: 2rem">Добро пожаловать! Войдите в систему, пожалуйста.</div>
    @endif
@endsection()
