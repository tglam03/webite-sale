@extends('layouts.client')
@section('title')
    Check Out
@endsection

@section('content')
    <form action="{{ url('order/checkout') }}" method="post" enctype="multipart/form-data">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('') }}">Trang chủ</a></li>
                        <li><a href="{{ url('cart/detail') }}">Cart</a></li>
                        <li>Trang hoạt động</li>
                    </ul>
                </div>
                <h1>Xác nhận thanh toán</h1>

            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="step first">
                        <h3>1. Thông tin người dùng và địa chỉ thanh toán</h3>
                        <div class="tab-content checkout">
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                <div class="form-group">
                                    @php

                                    @endphp
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        value="{{ $_SESSION['user']['email'] ?? null }}">
                                </div>

                                <hr>
                                <div class="row no-gutters">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Họ và tên" name="name"
                                            value="{{ $_SESSION['user']['name'] ?? null }}">
                                    </div>
                                </div>
                                <div class="row
                                        no-gutters">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Điện thoại" name="phone"
                                            value="{{ $_SESSION['user']['phone'] ?? null }}">
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Địa chỉ" name="address"
                                        value="{{ $_SESSION['user']['address'] ?? null }}">
                                </div>
                                <!-- /row -->

                                <!-- /row -->

                                <hr>
                                <hr>
                            </div>
                            <!-- /tab_1 -->
                        </div>
                    </div>
                    <!-- /step -->
                </div>
                <!-- Thanh toán và vận chuyển------------------------- -->
                <div class="col-lg-4
                                            col-md-6">
                    <div class="step middle payments">
                        <h3>2. Thanh toán và vận chuyển</h3>
                        <ul>
                            <li>
                                <label class="container_radio">Thẻ tín dụng<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Thanh toán khi nhận hàng<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Thanh toán online<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                        </ul>
                        <div class="payment_info d-none d-sm-block">
                            <figure><img src="img/cards_all.svg" alt=""></figure>
                            <p>Nó nên được hiểu là sự co rút của các giác quan, để lỗi lầm của chúng tôi
                                và của bạn đều không
                                phải là một triết lý tốt hơn. Nhưng hầu như không có nguy hiểm gì. Thông
                                thường tritani lúc đầu
                                không phải là những định nghĩa đó.</p>
                        </div>

                        <h6 class="pb-2">Phương thức vận chuyển</h6>


                        <ul>
                            <li>
                                <label class="container_radio">Giao hàng tiết kiệm<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            <li>
                                <label class="container_radio">Giao hàng nhanh<a href="#0" class="info"
                                        data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                    <input type="radio" name="shipping">
                                    <span class="checkmark"></span>
                                </label>
                            </li>

                        </ul>

                    </div>
                    <!-- end Thanh toán và vận chuyển------------------------- -->

                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="step last">
                        @php
                            $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                        @endphp
                        <h3>3. Tóm tắt đơn hàng</h3>
                        <div class="box_general summary">
                            @foreach ($cart as $item)
                                <ul>
                                    <li class="clearfix"><em>{{ $item['name'] }}</em>
                                        <span>{{ number_format($item['price_sale'] ?: $item['price_regular']) }} VNĐ</span>
                                    </li>

                                </ul>
                                <ul>
                                    <li class="clearfix"><em><strong>Tổng</strong></em>
                                        <span>{{ number_format(caculator_total_oder($cart)) }} VNĐ</span>
                                    </li>
                                </ul>
                                <div class="total clearfix">Thành tiền
                                    <span>{{ number_format(caculator_total_oder($cart)) }}
                                        VNĐ</span>
                                </div>
                                <button type="submit" class="btn_1 full-width">Đặt mua</button>
                        </div>
                        @endforeach
                        <!-- /box_general -->
                    </div>
                    <!-- /step -->
                </div>
            </div>
            <!-- /row -->
        </div>
    </form>
@endsection
