@extends('layouts.client')
@section('title')
    Login
@endsection

@section('content')
    <div class="container margin_30">
        <div class="page_header">
            <div class="breadcrumbs">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Danh mục</a></li>
                    <li>Trang hoạt động</li>
                </ul>
            </div>
            <h1>Đăng nhập hoặc đăng ký</h1>
        </div>
        <!-- /page_header -->
        <div class="row justify-content-center">
            <form method="post" action="{{ url('handle-login') }}" class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">
                    <h3 class="client">Đăng nhập</h3>
                    <div class="form_container">

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

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password_in" value=""
                                placeholder="Mật khẩu*">
                        </div>
                        <div class="clearfix add_bottom_15">
                            <div class="checkboxes float-start">
                                <label class="container_check">Ghi nhớ tài khoản
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="float-end"><a id="forgot" href="javascript:void(0);">Quên mật khẩu</a></div>
                        </div>
                        <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
                        <div id="forgot_pw">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email_forgot" id="email_forgot"
                                    placeholder="Nhập email của bạn">
                            </div>
                            <p>Mật khẩu sẽ sớm được gửi đến</p>
                            <div class="text-center"><input type="submit" value="Đặt lại mật khẩu" class="btn_1"></div>
                        </div>
                    </div>
                    <!-- /end đăng nhập form_container -->
                </div>
                <!-- /box_account -->
                <div class="row">
                    <div class="col-md-6 d-none d-lg-block">
                        <ul class="list_ok">
                            <li>Tìm kiếm vị trí</li>
                            <li>Kiểm tra vị trí</li>
                            <li>Bảo vệ dữ liệu</li>
                        </ul>
                    </div>
                    <div class="col-md-6 d-none d-lg-block">
                        <ul class="list_ok">
                            <li>Thanh toán an toàn</li>
                            <li>Hỗi trợ 24/24</li>
                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </form>
            <!-- Đăng ký ------------------->
            <form method="post" action="{{ url('handle-register') }}" class="col-xl-6 col-lg-6 col-md-8">
                <div class="box_account">


                    <h3 class="new_client">Đăng ký</h3>
                    @if (!empty($_SESSION['errorsRegister']))
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($_SESSION['errorsRegister'] as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @php
                            unset($_SESSION['errorsRegister']);
                        @endphp
                    @endif
                    <small class="float-right pt-2">* Bắt buộc</small>
                    <div class="form_container">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password_in_2" value=""
                                placeholder="Mật khẩu*">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirm_password" id="password_in_2"
                                value="" placeholder="Nhập lại mật khẩu*">
                        </div>
                        <div class="private box">
                            <div class="row no-gutters">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Họ và tên*" name="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="container_check">Đồng ý <a href="#0">Điều khoản sử dụng</a>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="text-center"><input type="submit" value="Register" class="btn_1 full-width"></div>
                    </div>
                    <!-- /form_container -->
                </div>
                <!-- /box_account -->
            </form>
        </div>
        <!-- /row -->
    </div>
@endsection
