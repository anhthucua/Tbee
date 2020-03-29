@extends('base')

@section('title', 'home')

@section('content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb-tree">
          <li><a href="#">Home</a></li>
          <li><a href="#">All Categories</a></li>
          <li><a href="#">Accessories</a></li>
          <li class="active">Headphones (227,490 Results)</li>
        </ul>
      </div>
    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</div>
<!-- /BREADCRUMB -->

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
                <span></span>
                Category 1
                <small>(120)</small>
              </label>
            </div>

            <div class="input-checkbox">
              <input type="checkbox" id="category-2">
              <label for="category-2">
                <span></span>
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

    <div class="row">
      <div class="col-12">
        <!-- store bottom filter -->
        <div class="store-filter float-right">
          <ul class="store-pagination">
            <li class="active">1</li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
          </ul>
        </div>
        <!-- /store bottom filter -->
      </div>
    </div>

  </div>
</div>
<!-- /SECTION -->

@endsection