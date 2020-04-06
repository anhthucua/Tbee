@extends('base')

@section('title', 'Thanh toan')

@section('header', '')

@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li><a href="#">Trang chủ</a></li>
          <li><a href="#">Đặt hàng</a></li>
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
          <div class="detail-address">
            <dl>
              <dt>Họ tên:</dt>
              <dd>Trần Anh Thư</dd>
              <dt>Số điện thoại:</dt>
              <dd>0966666666</dd>
              <dt>Địa chỉ:</dt>
              <dd>Số 00 đường ABC thị trấn Con Cò, huyện Con Lai, tỉnh Lai Dai</dd>
            </dl>
          </div>
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
            <div class="order-col">
              <div>1x Product Name Goes Here</div>
              <div>980000</div>
            </div>
            <div class="order-col">
              <div>2x Product Name Goes Here</div>
              <div>980000</div>
            </div>
          </div>
          <div class="order-col">
            <div class="voucher-wrapper">
              <div class="voucher">
                <label class="voucher-title"><strong>MÃ GIẢM GIÁ</strong></label>
                <input type="text">
                <button type="submit" class="primary-btn btn btn--small">Áp dụng</button>
              </div>
              <div class="error">Mã giảm giá không hợp lệ!</div>
              <div class="text-success">Mã giảm giá hợp lệ</div>
            </div>
          </div>
          <div class="order-col">
            <div><strong>TỔNG TIỀN</strong></div>
            <div><strong class="order-total">2940000</strong></div>
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