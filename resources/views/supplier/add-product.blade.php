@extends('supplier.base')

@section('title', 'Tạo sản phẩm')

@section('classname', 'add-product')

@section('content')
  <div class="col-md-9">
    <form action="{{ route('product.create') }}" method="POST" id="addProductForm" class="form add-product-form" enctype="multipart/form-data">
      @csrf
      {{-- Hidden select nganh hang --}}
      <input type="hidden" name="category_level2_id" id="catLv2">

      <br>
      <label class="label-category">Chọn ngành hàng</label>
      <br>
      {{-- Khu vuc chon nganh hang --}}
      <div class="category-section d-flex">
        <ul class="cat-lv1-section">
          <span class="category-title">Danh mục cấp 1</span>
          @foreach ($cat_lv1 as $cat1)
            <li data-id="{{ $cat1->id }}" class="cat-lv1">{{ $cat1->name }}</li>
          @endforeach
        </ul>

        <ul class="cat-lv2-section">
          <span class="category-title">Danh mục cấp 2</span>
          @foreach ($cat_lv2 as $cat2)
            <li data-id="{{ $cat2->id }}" class="cat-lv2 parent-id-{{ $cat2->category_level1_id }}">{{ $cat2->name }}</li>
          @endforeach
        </ul>
      </div>
      <br>

      {{-- Hidden input --}}
      <input type="file" id="images" class="d-none" accept="image/*" multiple required>
      <input type="hidden" name="main-image" class="main-img-input" value="0">

      <label for="images">Ảnh sản phẩm (chọn tối đa 5 ảnh): </label>
      <button class="btn primary-btn primary-btn--square choose-img-btn" type="button">Chọn ảnh</button>

      {{-- Khu vuc anh upload --}}
      <div class="upload-img-container d-none"></div>

      {{-- Ten san pham --}}
      <div class="form-group">
        <label for="inputName">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" id="inputName" required>
      </div>

      {{-- Ten san pham --}}
      <div class="form-group">
        <label for="inputDescription">Mô tả sản phẩm</label>
        <textarea class="form-control" name="description" id="inputDescription" rows="5" required></textarea>
      </div>

      {{-- Giá gốc --}}
      <div class="form-group">
        <label for="inputPrice">Giá gốc</label>
        <input type="text" class="form-control" name="price" id="inputPrice" required>
      </div>

      {{-- Giá bán --}}
      <div class="form-group">
        <label for="inputSalePrice">Giá bán</label>
        <input type="text" class="form-control" name="sale_price" id="inputSalePrice">
        <p class="description">Giá bán thực tế của sản phẩm. Để trống nếu giống giá gốc</p>
      </div>

      {{-- Hàng có sẵn --}}
      <div class="form-group">
        <label for="inputStocke">Số lượng sản phẩm có sẵn</label>
        <input type="text" class="form-control" name="stock" id="inputStocke" required>
      </div>

      <br>
      {{-- Submit form --}}
      <input type="submit" class="btn primary-btn primary-btn--square" value="Tạo sản phẩm">
    </form>
    <br>
  </div>

  {{-- Template de hien thi anh upload --}}
  <template id="imageTemplate">
    <div class="img-wrapper" data-el="">
      <div class="image-wrapper">
        <img src="" alt="" class="product-img">
      </div>
      <i class="fa fa-times-circle remove-image" aria-hidden="true"></i>
    </div>
  </template>
@endsection