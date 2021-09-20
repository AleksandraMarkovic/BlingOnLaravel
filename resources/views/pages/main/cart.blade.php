@extends('layouts.layout')
@section('title') Cart @endsection
@section('description') Products for sale @endsection
@section('keywords') jewelry, sell, online, rings, bracelet @endsection
@section('content')
    <div id="prazno"></div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mb-5">YOUR CART</h2>
            </div>
        </div>
    </div>
    <div class="container" id="productsCart">
    </div>
    <div class="container mt-5" id="bought">

    </div>
@endsection
