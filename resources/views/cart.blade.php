@extends('base')

@section('title', 'Giỏ hàng')

@section('header', '')

@section('classname', 'page-cart')

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li>
            <div class="header-logo">
              <a class="logo" href="{{ route('home') }}">
                <img src="images/logo.svg" alt="logo">
              </a>
            </div>
          </li>
          <li>GIỎ HÀNG</li>
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
      <div class="cart-header__quantity">Số lượng</div>
      <div class="cart-header__total-price w-10">Số tiền</div>
      <div class="cart-header__action w-10">Thao tác</div>
    </div>
    <!-- /CART HEADER - PLACE TO SELECT ALL -->
    @foreach ($shop_list as $shop)
      <div class="cart-page-shop-section">

        <!-- CART SHOP header -->
        <div class="cart-page-shop-header">
          <div class="cart-page-shop-header__center-wrapper">
            <div class="cart-item__cell-checkbox cart-page-shop-header__checkbox-wrapper">
              <input class="checkbox-shop" type="checkbox"
                id="check-shop-{{ $shop['id'] }}" data-sid="{{ $shop['id'] }}">
              <label for="check-shop-{{ $shop['id'] }}" class="lbl-shop" data-sid="{{ $shop['id'] }}"></label>
            </div>
            <a class="cart-page-shop-header__shop-name" href="{{ route('products-shop', $shop['id']) }}">
              <!-- icon shop -->
              <svg width="17" height="16"
                viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
                <path
                  d="M1.95 6.6c.156.804.7 1.867 1.357 1.867.654 0 1.43 0 1.43-.933h.932s0 .933 1.155.933c1.176 0 1.15-.933 1.15-.933h.984s-.027.933 1.148.933c1.157 0 1.15-.933 1.15-.933h.94s0 .933 1.43.933c1.368 0 1.356-1.867 1.356-1.867H1.95zm11.49-4.666H3.493L2.248 5.667h12.437L13.44 1.934zM2.853 14.066h11.22l-.01-4.782c-.148.02-.295.042-.465.042-.7 0-1.436-.324-1.866-.86-.376.53-.88.86-1.622.86-.667 0-1.255-.417-1.64-.86-.39.443-.976.86-1.643.86-.74 0-1.246-.33-1.623-.86-.43.536-1.195.86-1.895.86-.152 0-.297-.02-.436-.05l-.018 4.79zM14.996 12.2v.933L14.984 15H1.94l-.002-1.867V8.84C1.355 8.306 1.003 7.456 1 6.6L2.87 1h11.193l1.866 5.6c0 .943-.225 1.876-.934 2.39v3.21z"
                  stroke-width=".3" stroke="#333" fill="#333" fill-rule="evenodd"></path>
              </svg>
              <!-- /icon shop -->
              <span style="margin-left: 5px;">{{ $shop['name'] }}</span>
            </a>
          </div>
        </div>

        {{-- Section san phma --}}
        <div class="cart-page-shop-section__items">
          @foreach ($shop['products'] as $product)
            <div class="cart-item">

              {{-- Checkbox --}}
              <div class="cart-item__content">
                <div class="cart-item__cell-checkbox cart-page-shop-header__checkbox-wrapper">
                  <input class="chb-product chb-shop-{{ $shop['id'] }}" id="chb-item-{{ $product->id }}"
                    type="checkbox" data-sid="{{ $shop['id'] }}" data-pid="{{ $product->id }}">
                  <label for="chb-item-{{ $product->id }}" class="lbl-product"
                    data-sid="{{ $shop['id'] }}" data-pid="{{ $product->id }}"></label>
                </div>

                <div class="cart-item__cell-overview">
                  <a class="cart-item-overview__thumbnail-wrapper" href="#">
                    <div class="cart-item-overview__thumbnail" alt="cart_thumbnail"
                      style="background-image: url('{{ $product->url }}');">
                    </div>
                  </a>
                  <div class="cart-item-overview__product-name-wrapper">
                    <a class="cart-item-overview__name"
                      href="{{ route('product.show', $product->id) }}">{{ $product->name }}
                    </a>
                    <div class="cart-item-overview__message"></div>
                  </div>
                </div>

                <!-- DON GIA -->
                <div class="cart-item__cell-unit-price">
                  <div>
                    @if ($product->price !== $product->sale_price)
                      <span class="cart-item__unit-price cart-item__unit-price--before">{{ $product->price }}</span>
                    @endif
                    <span class="cart-item__unit-price cart-item__unit-price--after">{{ $product->sale_price }}</span>
                  </div>
                </div>

                <!-- SO LUONG -->
                <div class="cart-item__cell-quantity">
                  <div class="input-quantity">
                    <button type="button" class="minus"></button>
                    <input type="number" class="qty" value="{{ $product->quantity }}" min="1"
                      max="{{ $product->stock }}" data-pid="{{ $product->id }}"
                      data-price ="{{ $product->sale_price }}"/>
                    <button type="button" class="plus"></button>
                  </div>
                </div>

                <div class="cart-item__cell-total-price">
                  <span>{{ $product->sale_price * $product->quantity }}</span>
                </div>

                <div class="cart-item__cell-actions">
                  <button type="button" class="cart-item__action primary-btn"
                    data-pid="{{ $product->id }}" data-route="{{ route('delete-cart', $product->id) }}">Xóa</button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- /SECTION -->
<div class="footer-cart">
  <div class="container">

    <!-- VOUCHER -->
    <div class="row">
      <div class="col-md-5 offset-md-7">
        <div class="voucher">
          <label class="voucher-title">Mã giảm giá</label>
          <input type="text" data-percent="" data-max="">
          <button type="button" class="primary-btn btn btn--small">Áp dụng</button>
        </div>
        <div class="error d-none">Mã giảm giá không hợp lệ!</div>
        <div class="text-success d-none">Mã giảm giá hợp lệ</div>
      </div>
    </div>
    <!-- /VOUCHER -->

    <!-- TOTAL -->
    <div class="row">
      <div class="col-md-5 offset-md-7">
        <div class="total">
          <div class="total-title">Tổng tiền hàng:</div>
          <div class="total-money">0</div>
          <a href="#" class="primary-btn primary-btn--square">Mua hàng</a>
        </div>
      </div>
    </div>
    <!-- /TOTAL -->
  </div>
</div>

{{-- Modal delete --}}
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Xóa sản phẩm</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?</p>
        <form class="form-delete" action="{{ route('cart') }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="d-flex">
            <button class="btn btn-logout primary-btn btn-block" type="submit">Xóa</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal thong bao --}}
<div class="modal fade" id="noti-cart-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Thông báo</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Vui lòng chỉ chọn sản phẩm từ 1 shop</p>
        <div class="d-flex">
          <button class="btn primary-btn" type="button" data-dismiss="modal" aria-label="Close">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection