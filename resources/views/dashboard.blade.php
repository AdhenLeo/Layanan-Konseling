@extends('layouts.mainLayout')

@section('title')
    Dashboard
@endsection

@section('sub_title')
    Dashboard
@endsection

@section('content')
<div>
    @include('partials.dashboards.admin')  

    @include('partials.dashboards.guru')
</div>
@endsection