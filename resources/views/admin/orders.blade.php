@extends('admin.base')

@section('title', 'Quản lý đơn hàng')

@section('classname', 'manage-orders')

@section('content')

<div class="page-pads-container">
  <div class="heading">
    <h3 class="title">QUẢN LÝ ĐƠN HÀNG</h3>
  </div>
  <div class="pad-filters">
    <input type="text" id="search" class="search" placeholder="Tìm kiếm theo id đơn hàng">
    <div class="filter">
      <select id="filter-category" class="dropdown">
        <option value="all">Trạng thái đơn hàng</option>
        <option value="pending">Đơn chờ xác nhận</option>
        <option value="cancel">Đơn đã huỷ</option>
        <option value="done">Đơn đã nhận</option>
      </select>
    </div>
  </div>
  <h5>Thông tin các đơn hàng:</h5>
  <div class="pads-container">
    <table class="table product-list">
      <thead>
        <tr>
          <th>Mã đơn</th>
          <th style="width: 40%;">Danh sách sản phẩm</th>
          <th>Người mua</th>
          <th>Người bán</th>
          <th>Thời gian đặt</th>
          <th style="width: 20%;">Trạng thái</th>
          <th style="width: 10%;"></th>
        </tr>
      </thead>
      <tbody>
        @if (count($orders) > 0)
          @foreach ($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>
                <ol>
                  @foreach ($order->products as $product)
                    <li>
                      <a href="{{ route('product.show', $product['id']) }}">{{ $product['name'] }}</a>
                      <p>SL: <span>{{ $product['qty'] }}</span></p>
                    </li>
                  @endforeach
                </ol>
              </td>
              <td>{{ $order->username }}</td>
              <td>
                <a href="{{ route('products-shop', $order->supplier_id) }}" class="shop-link">{{ $order->supplier_name }}</a>
              </td>
              <td>{{ $order->time }}</td>
              <td>
                <div class="order-status {{ $order->status_class }}">{{ $order->status }}</div>
              </td>
              <td>{{ $order->total_price }}</td>
              <td>
                <a href="{{ route('order-detail', $order->id) }}" target="_blank" class="primary-btn btn--small">Chi tiết</a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="7">Không có đơn hàng nào.</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection

<template id="admin-order-row">
  <tr>
    <td></td><!--ma don-->
    <td>
      <ol><!--danh sach san pham-->
        <li><a href=""></a></li><!--ten sp-->
      </ol>
    </td>
    <td></td><!--nguoi mua-->
    <td><a href="" class="shop-link"></a></td><!--nguoi ban-->
    <td></td><!--thoi gian dat-->
    <td>
      <div class="order-status"></div><!--trang thai-->
    </td>
    <td>
      <a href="" target="_blank" class="primary-btn btn--small"></a><!--chi tiet-->
    </td>
  </tr>
</template>

<template id="product-li">
  <li>
    <a href=""></a>
    <p>SL: <span></span></p>
  </li>
</template>