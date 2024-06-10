@extends('layouts.client')
@section('title')
    Cart
@endsection

@section('content')
    @if (!empty($_SESSION['cart']) || !empty($_SESSION['cart-' . $_SESSION['user']['id']]))
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('') }}">Trang chủ</a></li>
                        <li><a href="{{ url('products') }}">Sản phẩm</a></li>
                        <li>Trang hoạt động</li>
                    </ul>
                </div>
                <h1>Giỏ hàng</h1>
            </div>
            <!-- /page_header -->
            <table class="table table-striped cart-list">
                <thead>
                    <tr>
                        <th>
                            Sản phẩm
                        </th>
                        <th>
                            Giá
                        </th>
                        <th>
                            Số lượng
                        </th>
                        <th>
                            Thành tiền
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>

                <!-- phần sản phẩm được thêm vào giỏ hàng -->
                @php
                    $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                @endphp
                @foreach ($cart as $item)
                    <tbody>
                        <tr>
                            <td>
                                <div class="thumb_cart">
                                    <img src="{{ asset($item['img_thumbnail']) }}"class="lazy" alt="Image">
                                </div>
                                <span class="item_cart">{{ $item['name'] }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($item['price_sale'] ?: $item['price_regular']) }}
                                    VNĐ</strong>
                            </td>
                            <td>

                                <div class="d-flex">

                                    @php
                                        $url = url('cart/quantityDec') . '?productID=' . $item['id'];

                                        if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                            $url .= '&cartID=' . $_SESSION['cart_id'];
                                        }
                                    @endphp

                                    <a href="{{ $url }}" class="btn btn-danger">-</a>

                                    <span class="btn btn-warning">{{ $item['quantity'] }}</span>


                                    @php
                                        $url = url('cart/quantityInc') . '?productID=' . $item['id'];

                                        if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                            $url .= '&cartID=' . $_SESSION['cart_id'];
                                        }
                                    @endphp

                                    <a href="{{ $url }}" class="btn btn-success">+</a>
                                </div>
                            </td>
                            <td>
                                <strong>{{ number_format($item['quantity'] * ($item['price_sale'] ?: $item['price_regular'] ?? null)) }}</strong>
                            </td>
                            <td class="options">

                                @php
                                    $url = url('cart/remove/') . '?productID=' . $item['id'];

                                    if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                        $url .= '&cartID=' . $_SESSION['cart_id'];
                                    }
                                @endphp

                                <a onclick="return confirm('Bạn có muốn xóa sản phẩm:  {{ $item['name'] }}')"
                                    href="{{ $url }}"><i class="ti-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

            </table>

            {{-- <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                <div class="col-sm-4 text-end">
                    <button type="button" class="btn_1 gray">Cập nhật giỏ hàng </button>
                </div>
                <div class="col-sm-8">
                    <div class="apply-coupon">
                        <div class="form-group">
                            <div class="row g-2">
                                <div class="col-md-6"><input type="text" name="coupon-code" value=""
                                        placeholder="Promo code" class="form-control"></div>
                                <div class="col-md-4"><button type="button" class="btn_1 outline">Áp dụng phiếu giảm
                                        giá</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- /cart_actions -->

        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Thành tiền</span> {{ number_format(caculator_total_oder($cart)) }} VNĐ
                            </li>
                            <li>
                                <span>Tổng thanh toán</span> {{ number_format(caculator_total_oder($cart)) }} VNĐ
                            </li>
                        </ul>
                        <a href="{{ url('checkout') }}" class="btn_1 full-width cart">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- /box_cart -->
@endsection
