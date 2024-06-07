@extends('layouts.master')

@section('title')
    Danh sách User
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">

                            <h2>Update Users {{ $user['name'] }}</h2>
                            @if (!empty($_SESSION['errors']))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($_SESSION['errors'] as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @php
                                unset($_SESSION['errors']);
                            @endphp
                            <form action="{{ url("admin/users/{$user['id']}/update") }}" method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Enter name" name="name"
                                            value="{{ $user['name'] }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Enter email" name="email"
                                            value="{{ $user['email'] }}">
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col">
                                        <input type="file" class="form-control" placeholder="Avatar" name="avatar">
                                        <img src="{{ asset($user['avatar']) }}" alt="" width="100px">
                                    </div>
                                    <div class="col">
                                        <input type="password" class="form-control" placeholder="Enter password"
                                            name="password">
                                    </div>

                                </div>

                                <button class="btn btn-dark mt-2" type="submit">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
