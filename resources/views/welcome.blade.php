@extends('layout')

@section('content')
    <div class="py-5">
        <h3 class="text-xl font-semibold text-slate-500 page-title">Welcome to the home page {{ Auth::user()->name }}</h3>
    </div>
@endsection