@extends('admin.layouts.default')

@section('content')
    @include('admin.includes.halls.hallIndex')
    @if($hall)
        @include('admin.includes.configHall.configHallIndex')
        @include('admin.includes.pricesHall.pricesHallIndex')
        @include('admin.includes.movieSession.movieSessionIndex')
        @include('admin.includes.openSale.openSaleIndex')
    @endif
@endsection
