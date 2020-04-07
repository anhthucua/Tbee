@extends('supplier.base')

@section('title', 'Tạo shop')

@section('classname', 'create')

@section('sidebar', '')

@section('content')
  <div class="col-md-8 offset-md-2">
    <form action="{{ route('supplier.create') }}" method="POST" enctype="multipart/form-data">
      @csrf
      {{-- Hidden input --}}
      <input type="file" name="shopBanner" id="shopBanner" class="d-none" accept="image/*">

      <label for="shopBanner">Ảnh bìa: </label>
      <br>
      <button class="btn btn-primary btn-image" type="button">Chọn ảnh</button>
      <br>
      <p class="image-name"></p>
      <img class="shop-banner img-responsive d-none" src="" alt="shop banner">
      <br>
      <label for="shop_name">Tên shop</label>
      <input type="text" name="shop_name" id="shop_name" class="form-control" required>
      <label for="address">Địa chỉ</label>
      <input type="text" name="address" id="address" class="form-control" required>
      <label for="note">Mô tả</label>
      <textarea class="form-control" name="note" id="note" rows="5"></textarea>
      <input type="submit" value="Lưu" class="btn btn-primary">
    </form>
  </div>
@endsection