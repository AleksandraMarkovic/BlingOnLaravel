@extends('layouts.layout')
@section('title') Products @endsection
@section('description') Products for sale @endsection
@section('keywords') jewelry, sell, online, rings, bracelet @endsection
@section('content')

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>bling on</h4>
              <h2>products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="products">
      <div class="container">
          <form method="get" action="{{ route('products') }}">
              <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                          <div class="col-md-2">
                              <h5><a href="#" id="pokaziFilter">Filter <i class="fa fa-plus-square-o" aria-hidden="true"></i></a> </h5>
                          </div>
                          <div class="col-md-1">
                              <h5 class="mb-2" id="sortLabel">Sort</h5>
                          </div>
                          <div class="col-md-3">
                              <select id="sort" name="sort">
                                  <option value="0">Choose...</option>
                                  <option value="lowToHigh">Price lowest to highest</option>
                                  <option value="highToLow">Price highest to lowest</option>
                                  <option value="highestRating">Best rated</option>
                              </select>
                          </div>
                          <div class="col-md-1 ml-2">
                              <h5 class="mb-2 mr-3" id="searchLabel">Search</h5>
                          </div>
                          <div class="col-md-3">
                              <input type="text" id="search" name="search" />
                          </div>
                      </div>
                      <div class="row mt-4" id="filter">
                          <div class="col-md-2">
                              <h5 class="mb-2">Brand</h5>
                              <ul>
                                  @foreach($brands as $brand)
                                      <li><input type="checkbox" value="{{ $brand->id }}" name="brands" /> {{ $brand->name }}</li>
                                  @endforeach
                              </ul>
                          </div>
                          <div class="col-md-2">
                              <h5 class="mb-2">Type</h5>
                              <ul>
                                  @foreach($types as $type)
                                      <li><input type="checkbox" value="{{ $type->id }}" name="types" /> {{ $type->type }}s</li>
                                  @endforeach
                              </ul>
                          </div>
                          <div class="col-md-2">
                              <h5 class="mb-2">Color</h5>
                              <ul>
                                  @foreach($colors as $color)
                                      <li><input type="checkbox" value="{{ $color->id }}" name="colors" /> {{ $color->name }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                        <div class="row">
                            <div class="col-md-1 mt-3">
                                <button type="button" class="btn" id="filterBtn">Apply</button>
                            </div>
                            @if(session()->has('user') && session('user')->role_id == 1)
                                <div class="col-md-1 mt-3">
                                    <a type="button" class="btn" id="addProduct" href="{{ route('products.create') }}">Insert new product</a>
                                </div>
                            @endif
                        </div>
                  </div>
              </div>
          </form>
        <div class="row d-flex justify-content-between mt-5">
          <div class="col-md-12">
            <div class="filters-content" id="products">
                <div class="row grid" >
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-4 all des">
                            @include('partials.product')
                        </div>
                    @endforeach
                </div>
            </div>
          </div>
        </div>
          {{$products->links('pagination.bootstrap-4')}}
      </div>
    </div>

@endsection


