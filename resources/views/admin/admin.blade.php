@extends('layouts.layout')
@section('title') Admin @endsection
@section('description') Website for selling jewelry @endsection
@section('keywords') jewelry, sell, online, rings, bracelet @endsection
@section('content')
    <div id="prazno"></div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-7">
                <h3>User activity</h3>
            </div>
            <div class="col-lg-5" id="dateFilter">
                <label for="datum" class="form-label mr-3">Filter by date</label>
                <input type="date" id="datum" name="datum">
            </div>
        </div>
        <div class="row" id="activity">
            <table class="table table-responsive-md mt-5">
                <thead>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                @foreach($admins as $admin)
                    <tr>
                        <th scope="row">{{ $admin->user_id }}</th>
                        @if($admin->product_id != null)
                            <th scope="row">{{ $admin->product_id }}</th>
                        @else
                            <th scope="row"><i class="fa fa-times" aria-hidden="true"></i></th>
                        @endif
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->action }}</td>
                        <td>{{ $admin->date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
