@extends('base')

@section('title', 'Gio hang')

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
              <a class="logo" href="home.html">
                <img src="images/logo.svg" alt="logo">
              </a>
            </div>
          </li>
          <li><a href="#">GIỎ HÀNG</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
  <div class="container">
    <!-- CART HEADER - PLACE TO SELECT ALL -->
    <div class="cart-header">
      <div class="cart-item__cell-checkbox">
        <input class="checkbox-primary" type="checkbox" id="check-all">
        <label for="check-all" class="stardust-checkbox"></label>
      </div>
      <div class="cart-header__product">Sản phẩm</div>
      <div class="cart-header__unit-price w-10">Đơn giá</div>
      <div class="cart-header__quantity w-10">Số lượng</div>
      <div class="cart-header__total-price w-10">Số tiền</div>
      <div class="cart-header__action w-10">Thao tác</div>
    </div>
    <!-- /CART HEADER - PLACE TO SELECT ALL -->
    <!-- CART SHOP -->
    <div class="cart-page-shop-section">
      <!-- CART SHOP header -->
      <div class="cart-page-shop-header">
        <div class="cart-page-shop-header__center-wrapper">
          <div class="cart-item__cell-checkbox cart-page-shop-header__checkbox-wrapper">
            <input class="checkbox-primary" type="checkbox" id="check-shop-1">
            <label for="check-shop-1" class="stardust-checkbox"></label>
          </div>
          <a class="cart-page-shop-header__shop-name" href="/aset1234">
            <!-- icon shop -->
            <svg width="17" height="16"
              viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
              <path
                d="M1.95 6.6c.156.804.7 1.867 1.357 1.867.654 0 1.43 0 1.43-.933h.932s0 .933 1.155.933c1.176 0 1.15-.933 1.15-.933h.984s-.027.933 1.148.933c1.157 0 1.15-.933 1.15-.933h.94s0 .933 1.43.933c1.368 0 1.356-1.867 1.356-1.867H1.95zm11.49-4.666H3.493L2.248 5.667h12.437L13.44 1.934zM2.853 14.066h11.22l-.01-4.782c-.148.02-.295.042-.465.042-.7 0-1.436-.324-1.866-.86-.376.53-.88.86-1.622.86-.667 0-1.255-.417-1.64-.86-.39.443-.976.86-1.643.86-.74 0-1.246-.33-1.623-.86-.43.536-1.195.86-1.895.86-.152 0-.297-.02-.436-.05l-.018 4.79zM14.996 12.2v.933L14.984 15H1.94l-.002-1.867V8.84C1.355 8.306 1.003 7.456 1 6.6L2.87 1h11.193l1.866 5.6c0 .943-.225 1.876-.934 2.39v3.21z"
                stroke-width=".3" stroke="#333" fill="#333" fill-rule="evenodd"></path>
            </svg>
            <!-- /icon shop -->
            <span style="margin-left: 5px;">Ten shop</span>
          </a>
        </div>
      </div>
      <!-- /CART SHOP header -->
      <div class="cart-page-shop-section__items">
        <!-- ITEM -->
        <div class="cart-item">
          <div class="cart-item__content">
            <div class="cart-item__cell-checkbox cart-page-shop-header__checkbox-wrapper">
              <input class="checkbox-primary" type="checkbox" id="check-item-1">
              <label for="check-item-1" class="stardust-checkbox"></label>
            </div>
            <div class="cart-item__cell-overview">
              <a class="cart-item-overview__thumbnail-wrapper" href="#">
                <div class="cart-item-overview__thumbnail" alt="cart_thumbnail"
                  style="background-image: url('images/man-fashion.png');">
                </div>
              </a>
              <div class="cart-item-overview__product-name-wrapper"><a class="cart-item-overview__name" href="#">Áo
                  mưa đôi 2 đầu có kính che mặt dáng trùm rộng có tai kính che gương và đèn Có nhiều màu cho cả
                  nam và nữ</a>
                <div class="cart-item-overview__message"></div>
              </div>
            </div>
            <!-- DON GIA -->
            <div class="cart-item__cell-unit-price">
              <div>
                <span class="cart-item__unit-price cart-item__unit-price--before">300000</span>
                <span class="cart-item__unit-price cart-item__unit-price--after">179000</span>
              </div>
            </div>
            <!-- /DON GIA -->
            <!-- SO LUONG -->
            <div class="cart-item__cell-quantity">
              <div class="input-quantity">

              </div>
            </div>
            <!-- /SO LUONG -->
            <div class="cart-item__cell-total-price"><span>179000</span></div>
            <div class="cart-item__cell-actions"><button class="cart-item__action primary-btn">Xóa</button></div>
          </div>
        </div>
        <!-- /ITEM -->

        <!-- ITEM -->
        <div class="cart-item">
          <div class="cart-item__content">
            <div class="cart-item__cell-checkbox cart-page-shop-header__checkbox-wrapper">
              <input class="checkbox-primary" type="checkbox" id="check-item-2">
              <label for="check-item-2" class="stardust-checkbox"></label>
            </div>
            <div class="cart-item__cell-overview">
              <a class="cart-item-overview__thumbnail-wrapper" href="#">
                <div class="cart-item-overview__thumbnail" alt="cart_thumbnail" style="background-image: url('images/man-fashion.png');">
                </div>
              </a>
              <div class="cart-item-overview__product-name-wrapper"><a class="cart-item-overview__name" href="#">Áo
                  mưa đôi 2 đầu có kính che mặt dáng trùm rộng có tai kính che gương và đèn Có nhiều màu cho cả
                  nam và nữ</a>
                <div class="cart-item-overview__message"></div>
              </div>
            </div>
            <!-- DON GIA -->
            <div class="cart-item__cell-unit-price">
              <div>
                <span class="cart-item__unit-price cart-item__unit-price--before">300000</span>
                <span class="cart-item__unit-price cart-item__unit-price--after">179000</span>
              </div>
            </div>
            <!-- /DON GIA -->
            <!-- SO LUONG -->
            <div class="cart-item__cell-quantity">
              <div class="input-quantity">

              </div>
            </div>
            <!-- /SO LUONG -->
            <div class="cart-item__cell-total-price"><span>179000</span></div>
            <div class="cart-item__cell-actions"><button class="cart-item__action primary-btn">Xóa</button></div>
          </div>
        </div>
        <!-- /ITEM -->
      </div>
    </div>
    <!-- /CART SHOP -->
  </div>
</div>
<!-- /SECTION -->
<div class="footer-cart">
  <div class="container">
    <!-- VOUCHER -->
    <div class="row">
      <div class="col-md-7"></div>
      <div class="col-md-5">
        <div class="voucher">
          <label class="voucher-title">Mã giảm giá</label>
          <input type="text">
          <button type="submit" class="primary-btn btn btn--small">Áp dụng</button>
        </div>
        <div class="error">Mã giảm giá không hợp lệ!</div>
        <div class="text-success">Mã giảm giá hợp lệ</div>
      </div>
    </div>
    <!-- /VOUCHER -->
    <!-- TOTAL -->
    <div class="row">
      <div class="col-md-7"></div>
      <div class="col-md-5">
        <div class="total">
          <div class="total-title">Tổng tiền hàng:</div>
          <div class="total-money">2000000</div>
          <a href="#" class="primary-btn primary-btn--square">Mua hàng</a>
        </div>
      </div>
    </div>
    <!-- /TOTAL -->
  </div>
</div>

@endsection