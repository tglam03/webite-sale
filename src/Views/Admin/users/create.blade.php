@extends('layouts.master')

@section('title')
    Danh sách User
@endsection

@section('content')
    @if (!empty($_SESSION['errors']))
        <div class="alert alert-warning">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @php
            unset($_SESSION['errors']);
        @endphp
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Thêm mới User</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <form action="{{ url('admin/users/store') }}" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name"
                                        name="name">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="img_thumbnail" class="form-label">Avatar:</label>
                                    <input type="file" class="form-control" id="avatar" placeholder="Enter avatar"
                                        name="avatar">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="overview" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="overview" placeholder="Enter Email"
                                        name="email">
                                </div>



                                <div class="mb-3 mt-3">
                                    <label for="content" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="content" rows="4"
                                        placeholder="Enter Password" name="password">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="content" class="form-label">Confirm Password:</label>
                                    <input type="password" class="form-control" id="content" rows="4"
                                        placeholder="Enter Confirm Password" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type:</label>
                            <select name="type" id="type">
                                <option selected value="member">Member</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
