@extends('admin.layouts.default')

@section('content')
    @include('admin.includes.halls.hallIndex')
    @include('admin.includes.configHall.configHallIndex')
    @include('admin.includes.pricesHall.pricesHallIndex')
    @include('admin.includes.sessionsMovies.sessionsMoviesIndex')
@endsection
