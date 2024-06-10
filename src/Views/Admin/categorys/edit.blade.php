@extends('layouts.master')

@section('title')
    Cập nhật Người dùng: {{ $category['name'] }}
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

    @if (isset($_SESSION['status']) && $_SESSION['status'])
        <div class="alert alert-success">{{ $_SESSION['msg'] }}</div>

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
                            <h1 class="m-0">Cập nhật: {{ $category['name'] }}</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <form action="{{ url("admin/categorys/{$category['id']}/update") }}" enctype="multipart/form-data"
                        method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="category_id" class="form-label">Category:</label>


                                    <div class="mb-3 mt-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name"
                                            value="{{ $category['name'] }}" name="name">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
