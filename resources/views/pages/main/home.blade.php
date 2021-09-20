@extends('layouts.layout')
@section('title') Home @endsection
@section('description') Website for selling jewelry @endsection
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
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>For you</h4>
            <h2>Stylish Rings</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>We offer</h4>
            <h2>High quality bracelets</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Easy buy</h4>
            <h2>Affordable necklaces</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
              <a href="{{ route('products') }}">view all products <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
            @foreach($products as $product)
                <div class="col-md-4">
                    @include('partials.product')
                </div>
            @endforeach
        </div>
      </div>
    </div>

    <div class="best-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>About Bling On</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <p>Since inception, Bling On has been committed to quality, not only of our products, but of the conditions in which they are produced. We aim to trace each of our pieces from mine to market because traceability allows us to manage and improve the social and environmental impacts of our supply chain</p>
                <p>We strike a balance between recycled and fairly mined materials that support communities dependent on the industry. Traceability is important because it allows us to validate the authenticity of the material and improve the social and environmental impacts of our pieces.</p>
                <p>Our jewelry is handcrafted with the same top materials and quality craftsmanship as other luxury jewelry brands but without the traditional markups.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="{{ asset('assets/images/about-us.jpg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
