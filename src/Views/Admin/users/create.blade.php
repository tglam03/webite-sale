@extends('layouts.master')

@section('title')
    Danh sách User
@endsection

@section('content')


    <div class="container mt-3">
        <h2>Create Users</h2>
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
        <form action="{{ url('admin/users/store') }}" method="post" enctype="multipart/form-data" class="mb-10">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Enter email" name="email">
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <input type="file" class="form-control" placeholder="Avatar" name="avatar">
                </div>
                <div class="col">
                    <input type="password" class="form-control" placeholder="Enter password" name="password">
                </div>
                <div class="col">
                    <input type="password" class="form-control" placeholder="Confirm password" name="confirm_password">
                </div>
            </div>

            <button class="btn btn-dark mt-2" type="submit">Create</button>
        </form>
    </div>

@endsection
