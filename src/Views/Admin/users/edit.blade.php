@extends('layouts.master')

@section('title')
    Danh sách User
@endsection

@section('content')
    @if (isset($_SESSION['status']) && $_SESSION['status'])
        <div class="alert alert-success">
            {{ $_SESSION['msg'] }}
        </div>

        @php
            unset($_SESSION['status']);
            unset($_SESSION['msg']);
        @endphp
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">

                            <h2>Update Users {{ $user['name'] }}</h2>

                            <form action="{{ url("admin/users/{$user['id']}/update") }}" method="post"
                                enctype="multipart/form-data">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        name="name" value="{{ $user['name'] }}">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="img_thumbnail" class="form-label">Avatar:</label>
                                    <input type="file" class="form-control" id="avatar" placeholder="Enter avatar"
                                        name="avatar">
                                    <img src="{{ asset($user['avatar']) }}" class="mt-2" width="100px">
                                </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3 mt-3">
                                <label for="overview" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="overview" placeholder="Enter Email"
                                    name="email" value="{{ $user['email'] }}">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="content" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="content" rows="4"
                                    placeholder="Enter Password" name="password">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type:</label>
                        <select name="type" id="type">
                            <option disabled selected value="{{ $user['type'] }}">{{ $user['type'] }}</option>
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
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
