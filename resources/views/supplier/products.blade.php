@extends('supplier.base')

@section('title', 'Quản lý sản phẩm')

@section('classname', 'manage-products')

@section('content')
<div class="col-md-9">
  <div class="page-pads-container">
    <div class="heading">
      <h3 class="title">QUẢN LÝ SẢN PHẨM</h3>
      <a href="{{ route('supplier.add-product') }}" class="primary-btn primary-btn--square">+ Thêm sản phẩm</a>
    </div>
    <div class="pad-filters">
      <input type="text" id="search" class="search" placeholder="Tìm kiếm sản phẩm">
      <div class="filter">
        <select id="filter-category" class="dropdown">
          <option value="all">Ngành hàng</option>
          @foreach ($cat_lv1 as $cat1)
            <option value="{{ $cat1->id }}">{{ $cat1->name }}</option>
          @endforeach
        </select>
        <select id="sort" class="dropdown">
          <option value="id desc">Sắp xếp theo</option>
          <option value="sale_price desc">Giá giảm dần</option>
          <option value="sale_price asc">Giá tăng dần</option>
          <option value="created_at desc">Ngày đăng mới nhất</option>
          <option value="updated_at desc">Cập nhật mới nhất</option>
        </select>
      </div>
    </div>
    <h5>Thông tin các sản phẩm:</h5>
    <div class="pads-container">
      <table class="table product-list">
        <thead>
          <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Ngành hàng</th>
            <th>Giá gốc/giá bán</th>
            <th>Đã bán</th>
            <th>Tồn kho</th>
            <th>Ngày đăng</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @if (count($products))
            @foreach ($products as $product)
              <tr>
                <td>
                  <div class="table-product-img" style="background-image: url('{{ asset($product->img) }}')"></div>
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->cat_lv2 }}</td>
                <td>
                  @if ($product->sale_price !== $product->price)
                    <div class="product-old-price">{{ $product->price }}</div>
                  @endif
                    <div class="product-price">{{ $product->sale_price }}</div>
                </td>
                <td>{{ $product->purchased_number }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->date }}</td>
                <td>
                  <a href="{{ route('product.edit', $product->id) }}" class="secondary-btn btn--small" >Sửa</a>
                </td>
                <td>
                  <a href="{{ route('product.delete', $product->id) }}" class="primary-btn btn--small btn-delete" data-toggle="modal" data-target="#delete-modal">Xoá</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="9" class="no-item">Không có sản phẩm nào.</td>
            </tr>
          @endif

        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Bạn có chắc muốn xoá sản phẩm?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="del-product" action="" method="POST">
          @csrf
          @method('DELETE')
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Xoá</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<template id="product-row">
  <tr>
    <td>
      <div class="table-product-img" style=""></div>
    </td>
    <td></td> <!--name-->
    <td></td><!--cat_lv2-->
    <td>

    </td>
    <td></td>  <!--purchased-->
    <td></td> <!--stock-->
    <td></td> <!--date-->
    <td>
      <a href="" class="secondary-btn btn--small" >Sửa</a>
    </td>
    <td>
      <a href="" class="primary-btn btn--small btn-delete" data-toggle="modal" data-target="#delete-modal">Xoá</a>
    </td>
  </tr>
</template>