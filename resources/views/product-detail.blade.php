@extends('base')

@section('title', 'home')

@section('content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li><a href="#">Home</a></li>
          <li><a href="#">All Categories</a></li>
          <li><a href="#">Accessories</a></li>
          <li><a href="#">Headphones</a></li>
          <li class="active">Product name goes here</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
  <div class="container">
    <div class="row">
      <!-- Product main img -->
      <div class="col-md-5 col-md-push-2">
        <div id="product-main-img">
          <div class="product-preview" style="background-image: url('images/man-fashion.png');">
          </div>

          <div class="product-preview" style="background-image: url('images/product03.png');">
          </div>

          <div class="product-preview" style="background-image: url('images/product06.png');">
          </div>

          <div class="product-preview" style="background-image: url('images/product08.png');">
          </div>
        </div>
      </div>
      <!-- /Product main img -->

      <!-- Product thumb imgs -->
      <div class="col-md-2  col-md-pull-5">
        <div id="product-imgs">
          <div class="product-preview" style="background-image: url('images/man-fashion.png');">
          </div>

          <div class="product-preview" style="background-image: url('images/product03.png');">
          </div>

          <div class="product-preview" style="background-image: url('images/product06.png');">
          </div>

          <div class="product-preview" style="background-image: url('images/product08.png');">
          </div>
        </div>
      </div>
      <!-- /Product thumb imgs -->

      <!-- Product details -->
      <div class="col-md-5">
        <div class="product-details">
          <h2 class="product-name">product name goes here</h2>
          <div>10 sản phẩm đã bán
          </div>
          <div>
            <h3 class="product-price">980000 <del class="product-old-price">990000</del></h3>
            <span class="product-available">Còn xxx sản phẩm</span>
          </div>

          <div class="add-to-cart">
            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
          </div>
        </div>
      </div>
      <!-- /Product details -->
    </div>
  </div>
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
  <div class="container">
     <!-- shop infor -->
     <div class="product-shop">
      <div class="d-flex">
        <a href="#" class="shop-image" style="background-image: url('images/man-fashion.png');"></a>
        <div class="shop-info">
          <a href="#">Tên shop</a>
          <div class="shop-link">
            <a href="#" class="primary-btn primary-btn--normal">Xem shop</a>
            <a href="#" class="secondary-btn">Chat ngay</a>
          </div>
        </div>
      </div>
    </div>
     <!-- /shop infor -->
    <!-- description -->
    <div class="product-desc">
      <h5 class="product-desc-title">Mô tả</h5>
      <div class="product-desc-content">
        <p>Xuất xứ: Việt Nam</p>
        <p>Có màu đỏ</p>
        <p>Sản phẩm nguyên seal</p>
      </div>
    </div>
    <!-- /description -->
  </div>
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <div class="section-title text-center">
          <h3 class="title">Sản phẩm bán chạy</h3>
        </div>
      </div>

      <!-- product -->
      <div class="col-md-3 col-xs-6">
        <div class="product">
          <a class="product-link" href="#"></a>
          <div class="product-img" style="background-image: url('../images/man-fashion.png');" alt="">
            <div class="product-label"><span class="sale">-30%</span></div>
          </div>
          <div class="product-body">
            <p class="product-category">Name Category</p>
            <h3 class="product-name"><a href="#">product name goes here</a></h3>
            <h4 class="product-price">980000
              <del class="product-old-price">990000</del>
            </h4>
          </div>
        </div>
      </div>
      <!-- /product -->

      <!-- product -->
      <div class="col-md-3 col-xs-6">
        <div class="product">
          <a class="product-link" href="#"></a>
          <div class="product-img" style="background-image: url('../images/man-fashion.png');" alt="">
            <div class="product-label"><span class="sale">-30%</span></div>
          </div>
          <div class="product-body">
            <p class="product-category">Name Category</p>
            <h3 class="product-name"><a href="#">product name goes here</a></h3>
            <h4 class="product-price">980000
              <del class="product-old-price">990000</del>
            </h4>
          </div>
        </div>
      </div>
      <!-- /product -->

      <!-- product -->
      <div class="col-md-3 col-xs-6">
        <div class="product">
          <a class="product-link" href="#"></a>
          <div class="product-img" style="background-image: url('../images/man-fashion.png');" alt="">
            <div class="product-label"><span class="sale">-30%</span></div>
          </div>
          <div class="product-body">
            <p class="product-category">Name Category</p>
            <h3 class="product-name"><a href="#">product name goes here</a></h3>
            <h4 class="product-price">980000
              <del class="product-old-price">990000</del>
            </h4>
          </div>
        </div>
      </div>
      <!-- /product -->

      <!-- product -->
      <div class="col-md-3 col-xs-6">
        <div class="product">
          <a class="product-link" href="#"></a>
          <div class="product-img" style="background-image: url('../images/man-fashion.png');" alt="">
            <div class="product-label"><span class="sale">-30%</span></div>
          </div>
          <div class="product-body">
            <p class="product-category">Name Category</p>
            <h3 class="product-name"><a href="#">product name goes here</a></h3>
            <h4 class="product-price">980000
              <del class="product-old-price">990000</del>
            </h4>
          </div>
        </div>
      </div>
      <!-- /product -->

    </div>
  </div>
</div>
<!-- /Section -->


@endsection