@extends('layouts.layout')
@section('title') Product @endsection
@section('description') Website for selling jewelry @endsection
@section('keywords') jewelry, sell, online, rings, bracelet @endsection
@section('content')

    <div class="row" id="prazno"></div>
    <!-- Open Content -->
    <section>
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ asset('assets/images/' . $product->main_image) }}" alt="Card image cap" id="product-detail">
                    </div>
                    <div class="row">
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                            <div class="carousel-inner product-links-wap" role="listbox">
                                <div class="carousel-item active">
                                    <div class="row">
                                        @foreach($photos as $photo)
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid" src="{{ asset('assets/images/' . $photo->image) }}" alt="{{ $photo->alt }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card border-0" >
                        <div class="card-body">
                            <h1 class="h2">{{ $product->name }}</h1>
                            <p class="h3 py-2">${{ $product->price }}</p>
                            @foreach($grades as $grade)
                                @if($grade->grade > 0)
                                    <p class="py-2">
                                        <i class="fa fa-star text-warning"></i>
                                        <span class="list-inline-item text-dark"> {{ $grade->grade  }}/5</span>
                                    </p>
                                @endif
                                @endforeach
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6 class="mt-3">Brand:</h6>
                                </li>
                                    <li class="list-inline-item">
                                        <p class="text-muted"><strong>{{ $product->brand }}</strong></p>
                                    </li>
                            </ul>

                            <h6 class="mt-3 mb-2">Description:</h6>
                            <p>{{ $product->description }}</p>
                            @if(session()->has('user'))
                                @if(!is_null($singleGrade))
                                    <h6 class="mt-3">Your rating: {{$singleGrade->grade}} <i class="fa fa-star text-warning mr-1"></i> </h6>
                                @else
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <h6 class="mt-3">Rate:</h6>
                                        </li>
                                        <li class="list-inline-item">
                                            <select id="rating" name="rating" @if(!session()->has('user')) disabled="disabled" @endif>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </li>
                                    </ul>
                                @endif
                            @endif
                            <form action="" method="GET">
                                @if(!session()->has('user'))
                                    <div class="row">
                                        <div class="col-auto">
                                            <p class="text-danger mt-3"> You must login to order the product! </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3 mt-4">
                                            @if(count($sizes) != null)
                                                <li class="list-inline-item">Size : </li>
                                                @foreach($sizes as $size)
                                                    @if($size->quantity > 0)
                                                        <li class="list-inline-item"><input type="radio" data-idsize="{{$size->id}}" value="{{ $size->size }}" class="size" name="size" @if(!session()->has('user')) disabled="disabled" @endif /> {{ $size->size }} </li>
                                                    @endif
                                                @endforeach
                                            @else
                                                <li class="list-inline-item text-danger">Out of stock! </li>
                                            @endif
                                        </ul>
                                    </div>
                                    @if(count($sizes) != null)
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3 mt-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn" id="btn-plus">+</span></li>
                                        </ul>
                                        <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                                    </div>
                                    @endif
                                </div>
                                    @if(count($sizes) != null)
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="button" class="btn btn-lg float-right addToCart" name="submit" data-id="{{ $product->id }}" @if(!session()->has('user')) disabled="disabled" @endif>Add To Cart</button>
                                    </div>
                                </div>
                                    @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(session()->has('user') && session('user')->role_id == 1)
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <a class="btn btn-lg float-right updateBtn ml-3" name="updateBtn" href="{{ route("products.edit", $product->id) }}">Update</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-lg float-right deleteBtn" name="deleteBtn" >Delete</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection
