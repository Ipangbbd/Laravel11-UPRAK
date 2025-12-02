@extends('layouts.app')

@section('content')
<div class="row ">
    <h4>
        Welcome, 
        @auth
            {{ auth()->user()->name }}
        @endauth

        @guest
            Guest! Silakan Login! <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">login</a>
        @endguest
    </h4>
    <p>Aplikasi Inventory Managemen.</p>
</div><!--end row-->
@endsection
