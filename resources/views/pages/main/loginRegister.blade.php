@extends('layouts.layout')
@section('title') Login or Register @endsection
@section('description') Products for sale @endsection
@section('keywords') jewelry, sell, online, rings, bracelet @endsection
@section('content')

    <div class="row" id="prazno"></div>
    <div class="container mt-5">
        <div class="row d-flex justify-content-between" id="forms">
            <div class="col-md-5" id="register">
                <h2>Register</h2>
                <form action="{{ route('register') }}" method="post" class="mt-3">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">First name</label>
                        <input type="text" class="form-control" id="registerName" name="registerName"/>
                        <p class="text-danger" id="nameRegError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="registerLastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="registerLastName" name="registerLastName"/>
                        <p class="text-danger" id="lastNameRegError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"/>
                        <p class="text-danger" id="addressRegError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="emailRegister" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailRegister" name="emailRegister"/>
                        <p class="text-danger" id="emailRegError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="passRegister" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passRegister" name="passRegister"/>
                        <p class="text-danger" id="passRegError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPass" class="form-label">Confirm password</label>
                        <input type="password" class="form-control" id="confirmPass" name="confirmPass"/>
                        <p class="text-danger" id="confPassRegError"></p>
                    </div>
                    <input type="hidden" id="role_id" name="role_id" value="2" />
                    <button type="button" class="btn btn-lg" id="registerBtn">Register</button>
                </form>
            </div>
            <div class="col-md-5">
                <h2>Login</h2>
                <form action=" {{ route('login') }}" method="POST" class="mt-3">
                    <div class="mb-3">
                        <label for="emailLogin" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailLogin" name="emailLogin" />
                        <p class="text-danger" id="emailLoginError"></p>
                    </div>
                    <div class="mb-3">
                        <label for="passLogin" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passLogin" name="passLogin" />
                        <p class="text-danger" id="passLoginError"></p>
                    </div>
                    <button type="button" class="btn btn-lg" id="loginBtn">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
