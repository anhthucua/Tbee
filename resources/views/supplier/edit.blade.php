@extends('supplier.base')

@section('title', 'Chỉnh sửa thông tin')

@section('classname', 'edit-shop')

@section('content')
<div class="col-md-9">
  <section class="section">
    <h3 class="title">Thêm sản phẩm</h3>
    <br>
    @if (session('success'))
    <br>
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
  @endif
  <div class="form-edit-shop">
    <form action="{{ route('supplier.update') }}" method="POST" id="editShopForm" class="form edit-shop-form" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      {{-- Hidden input --}}
      <input type="file" name="shopBanner" id="shopBanner" class="d-none" accept="image/*">

      <label for="shopBanner">Ảnh bìa: </label>
      <br>
      <div class="input-file">
        <button class="btn primary-btn primary-btn--square btn-image" type="button">Chọn ảnh</button>
        <p class="image-name">{{ basename($image->url) }}</p>
      </div>
      <br>
      <div class="upload-image-wrapper">
        <div class="upload-image">
          <img class="shop-banner img-responsive" src="{{ $image->url }}" alt="image banner of shop">
        </div>
      </div>
      <br>
      <label for="shop_name">Tên shop</label>
      <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{ $supplier->shop_name }}" required>
      <label for="address">Địa chỉ</label>
      <input type="text" name="address" id="address" class="form-control" value="{{ $supplier->address }}" required>
      <label for="note">Mô tả</label>
      <textarea class="form-control" name="note" id="note" rows="5">{{ $supplier->notes }}</textarea>
      <br>
      <input type="submit" value="Lưu" class="btn primary-btn primary-btn--square">
    </form>
  </div>
  </section>
</div>
@endsection