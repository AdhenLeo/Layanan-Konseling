@extends('layouts.mainLayout')

@section('title')
    Dashboard - DeepTalk
@endsection

@section('sub_title')
    Dashboard
@endsection

@section('content')
<div>

    @if (Auth::user()->role == 'admin')
    @include('partials.dashboards.admin')  
    @endif
    @if (Auth::user()->role == 'guru')
    @include('partials.dashboards.guru')
    @endif
</div>
@endsection