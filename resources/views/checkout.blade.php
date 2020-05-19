@extends('base')

@section('title', 'Thanh toan')

@section('classname', 'page-checkout')

@section('header', '')

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li>
            {{-- <a href="#">Trang chủ</a> --}}
            <div class="header-logo">
              <a class="logo" href="{{ route('home') }}">
                <img src="images/logo.svg" alt="logo">
              </a>
            </div>
          </li>
          <li>Đặt hàng</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">

      <div class="col-md-7">
        <!-- Billing Details -->

        <div class="billing-details">
          <div class="section-title">
            <i class="fa fa-map-marker"></i>
            <h3 class="title">Địa chỉ nhận hàng</h3>
          </div>

          @foreach ($address_infos as $item)
            <div class="detail-addredd-wrapper">
              <label for="">
                <input type="radio" name="address" {{ ($item->is_main_address) ? 'checked' : '' }} data-aid={{ $item->id }} >
              </label>
              <div class="detail-address">
                <dl>
                  <dt>Họ tên:</dt>
                  <dd>{{ $item->name }}</dd>
                  <dt>Số điện thoại:</dt>
                  <dd>{{ $item->phone }}</dd>
                  <dt>Địa chỉ:</dt>
                  <dd>{{ $item->address }}</dd>
                </dl>
              </div>
            </div>
          @endforeach
        </div>
        <!-- /Billing Details -->

      </div>

      <!-- Order Details -->
      <div class="col-md-5 order-details">
        <div class="section-title text-center">
          <h3 class="title">Chi tiết đơn hàng</h3>
        </div>
        <div class="order-summary">
          <div class="order-col">
            <div><strong>SẢN PHẨM</strong></div>
            <div><strong>THÀNH TIỀN</strong></div>
          </div>
          <div class="order-products">
            @foreach ($products as $product)
              <div class="order-col product-col" data-pid="{{ $product->id }}" data-qty="{{ $product->qty }}">
                <div>{{ $product->qty }}x {{ $product->name }}</div>
                <div>{{ $product->sum }}</div>
              </div>
            @endforeach
          </div>
          @if ($coupon)
            <div class="order-col">
              <div class="voucher-wrapper">
                <div class="voucher">
                  <label class="voucher-title"><strong>MÃ GIẢM GIÁ</strong></label>
                  <input type="text" disabled readonly value="{{ $coupon->code }}" data-cid={{ $coupon->id }}>
                  <div class="voucher-money">-{{ $sale }}</div>
                </div>
              </div>
            </div>
          @endif
          <div class="order-col">
            <div><strong>TỔNG TIỀN</strong></div>
            <div><strong class="order-total" data-sid="{{ $sid }}">{{ $sum }}</strong></div>
          </div>
        </div>

        <a href="#" class="primary-btn order-submit">ĐẶT HÀNG</a>
      </div>
      <!-- /Order Details -->
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /SECTION -->
@endsection

<div class="modal fade" id="checkout-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Thành công</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Đặt hàng thành công</p>
        <form class="form-checkout" action="{{ route('user.orders') }}" method="GET">
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Đồng ý</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>