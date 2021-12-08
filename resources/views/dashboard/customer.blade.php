@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Hello Customer</h1>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                Logout
            </a>    
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

@endsection