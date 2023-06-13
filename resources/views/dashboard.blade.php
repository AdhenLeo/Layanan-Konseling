@extends('layouts.mainLayout')

@section('title')
    Dashboard
@endsection

@section('sub_title')
    Dashboard
@endsection

@section('content')
<div>

    @if (Auth::user()->role == 'admin')
    @include('partials.dashboards.admin')  
        
    @elseif(Auth::user()->role == 'admin')
    @include('partials.dashboards.guru')
    @endif
    
</div>
@endsection