@extends('layouts.application')

{{-- @if(isset($accessLevels)) --}}
    @section('content')
        @include('home.search')
    @endsection
{{-- @endif --}}
