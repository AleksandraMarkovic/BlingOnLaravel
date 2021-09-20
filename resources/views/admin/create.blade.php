@extends('layouts.layout')
@section('title') Insert Product @endsection
@section('description') Website for selling jewelry @endsection
@section('keywords') jewelry, sell, online, rings, bracelet @endsection
@section('content')
    <div id="prazno"></div>
    @if(session()->has('success'))
        @include('partials.success')
    @endif
    <div class="container mt-5">
        <div class="col-md-12">
            <h2 class="mb-4">Insert new product</h2>
            @include("admin.form", ["action" => 'products.store'])
        </div>
    </div>
@endsection
