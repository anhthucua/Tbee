@extends('base')

@section('title', 'home')

@section('content')

<!-- SECTION -->
<div class="section">
  <div class="container">
     <!-- shop infor -->
     <div class="product-shop">
      <div class="d-flex">
        <a href="" class="shop-image"
          style="background-image: url('');"></a>
        <div class="shop-info">
          <a href="">ten shop</a>
          <div class="shop-link">
            <a href="#" class="secondary-btn">Chat ngay</a>
          </div>
        </div>
      </div>
    </div>
     <!-- /shop infor -->
    <!-- description -->
    <div class="product-desc">
      <h5 class="product-desc-title">Giới thiệu shop</h5>
      <div class="product-desc-content">
        áccnscsdov
      </div>
    </div>
    <!-- /description -->
    <!-- banner shop -->
    <div class="shop-banner">
      <div class="image-wrapper">
        <img src="https://cf.shopee.vn/file/ebb84b8ba24766b2ba875390788b3328_xxhdpi" alt="">
      </div>
    </div>
    <!-- /banner shop -->
  </div>
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
  <div class="container">
    <div class="row">
      <!-- ASIDE -->
      <div id="aside" class="col-md-3">
        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Categories</h3>
          <div class="checkbox-filter">

            <div class="input-checkbox">
              <input type="checkbox" id="category-1">
              <label for="category-1">
                Category 1
                <small>(120)</small>
              </label>
            </div>

            <div class="input-checkbox">
              <input type="checkbox" id="category-2">
              <label for="category-2">
                Category 2
                <small>(740)</small>
              </label>
            </div>

          </div>
        </div>
        <!-- /aside Widget -->

        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Giá</h3>
          <div class="price-filter">
            <div id="price-slider"></div>
            <div class="input-number price-min">
              <input id="price-min" type="number">
              <span class="qty-up">+</span>
              <span class="qty-down">-</span>
            </div>
            <span>-</span>
            <div class="input-number price-max">
              <input id="price-max" type="number">
              <span class="qty-up">+</span>
              <span class="qty-down">-</span>
            </div>
          </div>
        </div>
        <!-- /aside Widget -->

        <!-- aside Widget -->
        <div class="aside">
          <h3 class="aside-title">Sản phẩm bán chạy</h3>
          <div class="product-widget">
            <a href="#" class="product-img" style="background-image: url('images/man-fashion.png');">
            </a>
            <div class="product-body">
              <p class="product-category">Category</p>
              <h3 class="product-name"><a href="#">product name goes here</a></h3>
              <h4 class="product-price">980000 <del class="product-old-price">990000</del></h4>
            </div>
          </div>

          <div class="product-widget">
            <a href="#" class="product-img" style="background-image: url('images/man-fashion.png');">
            </a>
            <div class="product-body">
              <p class="product-category">Category</p>
              <h3 class="product-name"><a href="#">product name goes here</a></h3>
              <h4 class="product-price">980000<del class="product-old-price">990000</del></h4>
            </div>
          </div>

          <div class="product-widget">
            <a href="#" class="product-img" style="background-image: url('images/man-fashion.png');">
            </a>
            <div class="product-body">
              <p class="product-category">Category</p>
              <h3 class="product-name"><a href="#">product name goes here</a></h3>
              <h4 class="product-price">990000 <del class="product-old-price">990000</del></h4>
            </div>
          </div>
        </div>
        <!-- /aside Widget -->
      </div>
      <!-- /ASIDE -->

      <!-- STORE -->
      <div id="store" class="col-md-9">
        <!-- store top filter -->
        <div class="store-filter clearfix">
          <div class="store-sort">
            <label>
              Sắp xếp theo:
              <select class="input-select">
                <option value="0">Giá từ thấp lên cao</option>
                <option value="1">Giá từ cao xuống thấp</option>
                <option value="2">Sản phẩm mới nhất</option>
                <option value="3">Sản phẩm bán chạy</option>
              </select>
            </label>
          </div>
        </div>
        <!-- /store top filter -->

        <!-- store products -->
        <div class="row">
          <!-- product -->
          <div class="col-lg-4 col-xs-6">
            <div class="product">
              <a class="product-link" href="#"></a>
              <div class="product-img" style="background-image: url('../images/product01.png');">
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
          <div class="col-lg-4 col-xs-6">
            <div class="product">
              <a class="product-link" href="#"></a>
              <div class="product-img" style="background-image: url('../images/product01.png');">
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
          <div class="col-lg-4 col-xs-6">
            <div class="product">
              <a class="product-link" href="#"></a>
              <div class="product-img" style="background-image: url('../images/product01.png');">
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
          <div class="col-lg-4 col-xs-6">
            <div class="product">
              <a class="product-link" href="#"></a>
              <div class="product-img" style="background-image: url('../images/product01.png');">
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
          <div class="col-lg-4 col-xs-6">
            <div class="product">
              <a class="product-link" href="#"></a>
              <div class="product-img" style="background-image: url('../images/product01.png');">
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
        <!-- /store products -->
      </div>
      <!-- /STORE -->
    </div>

  </div>
</div>
<!-- /SECTION -->

@endsection

<template id="product-div">
  <div class="col-lg-4 col-xs-6">
    <div class="product">
      <a class="product-link" href=""></a>
      <div class="product-img" style="">
        <div class="product-label">
          <span class="sale"></span>
        </div>
      </div>
      <div class="product-body">
        <p class="product-purchased"></p>
        <h3 class="product-name">
          <a href=""></a>
        </h3>
        <h4 class="product-price">
          <span></span>
          <del class="product-old-price"></del>
        </h4>
      </div>
    </div>
  </div>
</template>