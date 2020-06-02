@extends('supplier.base')

@section('title', 'Tạo sản phẩm')

@section('classname', 'edit-product')

@section('content')
  <div class="col-md-9">
    <form action="{{ route('product.update', $product->id) }}" method="POST" id="addProductForm" class="form add-product-form" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <br>
      {{-- Hidden input --}}
      <input type="file" id="images" name="images" class="d-none" accept="image/*" multiple>
      <input type="hidden" name="image_id" class="main-img-input" value="{{ $product->image_id }}">

      <label for="images">Ảnh sản phẩm</label>
      <button class="btn btn-primary choose-img-btn" type="button">Chọn ảnh</button>

      {{-- Khu vuc anh upload --}}
      <div class="upload-img-container">
        @foreach ($product->images as $img)
          <div class="img-wrapper {{ ($product->image_id === $img->id) ? 'active' : '' }}">
            <div class="image-wrapper">
              <img src="{{ $img->url }}" alt="product-img" class="product-img" data-id="{{ $img->id }}">
            </div>
            <i class="fa fa-times-circle remove-image" aria-hidden="true"></i>
          </div>
        @endforeach
      </div>

      {{-- Ten san pham --}}
      <div class="form-group">
        <label for="inputName">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" id="inputName" value="{{ $product->name }}" required>
      </div>

      {{-- Ten san pham --}}
      <div class="form-group">
        <label for="inputDescription">Mô tả sản phẩm</label>
        <textarea class="form-control" name="description" id="inputDescription" rows="5" required>{{ $product->description }}</textarea>
      </div>

      {{-- Giá gốc --}}
      <div class="form-group">
        <label for="inputPrice">Giá gốc</label>
        <input type="text" class="form-control" name="price" value="{{ $product->price }}" id="inputPrice" required>
      </div>

      {{-- Giá bán --}}
      <div class="form-group">
        <label for="inputSalePrice">Giá bán</label>
        <input type="text" class="form-control" name="sale_price" value="{{ ($product->price === $product->sale_price) ? '' : $product->sale_price }}" id="inputSalePrice">
        <p class="description">Giá bán thực tế của sản phẩm. Để trống nếu giống giá gốc</p>
      </div>

      {{-- Hàng có sẵn --}}
      <div class="form-group">
        <label for="inputStocke">Số lượng sản phẩm có sẵn</label>
        <input type="text" class="form-control" name="stock" value="{{ $product->stock }}" id="inputStocke" required>
      </div>

      <br>
      <br>
      {{-- Submit form --}}
      <input type="submit" class="btn btn-primary" value="Lưu">

    </form>
  </div>

  {{-- Template de hien thi anh upload --}}
  <template id="imageTemplate">
    <div class="img-wrapper" data-el="">
      <img src="" alt="" class="product-img">
      <i class="fa fa-check-circle-o check-main" aria-hidden="true"></i>
      <i class="fa fa-times-circle remove-image" aria-hidden="true"></i>
    </div>
  </template>
@endsection