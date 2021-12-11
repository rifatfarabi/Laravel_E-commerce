@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12 pl-5">
            <h1>Hello Admin</h1>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                Logout
            </a>    
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

@endsection