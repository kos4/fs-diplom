@extends('site.layouts.default')

@section('dates')
    @include('site.includes.index.indexDates')
@endsection

@section('content')
    @include('site.includes.index.indexMovies')
@endsection
