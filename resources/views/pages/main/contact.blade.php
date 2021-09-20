@extends('layouts.layout')
@section('title') Contact @endsection
@section('description') Contact page @endsection
@section('keywords') jewelry, sell, online, contact @endsection
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
    <div class="page-heading contact-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>contact us</h4>
              <h2>let’s get in touch</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    @if(session()->has('success'))
        @include('partials.success')
    @endif
    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Send us a Message</h2>
            </div>
          </div>
          <div class="col-md-12">
            <div class="contact-form">
              <form id="contact" action="{{ route('sendEmail') }}" method="post">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="text-danger" id="nameContactError"></p>
                    <fieldset>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="text-danger" id="emailContactError"></p>
                    <fieldset>
                      <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail Address" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="text-danger" id="subjectError"></p>
                    <fieldset>
                      <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                      <p class="text-danger" id="messageContactError"></p>
                    <fieldset>
                      <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="button" id="form-submit" class="filled-button">Send Message</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-5" id="autor">
        <div class="row mb-5 mt-5">
            <div class="col-lg-9 mx-auto mt-5">
                <h2>Author</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-start">
            <div class="col-12 col-lg-4 text-right" id="imageAuthor">
                <img src="assets/images/autor.jpg" alt="Author" class="img-fluid" width="300px">
            </div>
            <div class="col-12 col-lg-4">
                <p class="mb-3">My name is Aleksandra Markovic. I am from Gornji Milanovac and I am 21 years old. I study internet technologies at ICT college and I am interested in programming and design.</p>
                <p class="mb-3">As I study more it looks like I am more interested in Back End Web development, but who knows, maybe I'll change my mind. </p>
                <p>I was born on 23.05.1999. In my free time I like to watch TV shows, movies, hang out with my friends and lots of different stuff. </p>
            </div>
        </div>
    </div>

@endsection
