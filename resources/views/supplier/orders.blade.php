@extends('supplier.base')

@section('title', 'Quản lý đơn hàng')

@section('classname', 'manage-orders')

@section('content')
<div class="col-md-9">
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
            <th>Thời gian đặt</th>
            <th style="width: 20%;">Trạng thái</th>
            <th>Tổng tiền</th>
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
                <td>{{ $order->time }}</td>
                <td>
                  <div class="order-status {{ $order->status_class }}">{{ $order->status }}</div>
                  @if ($order->status_class == null)
                    <a href="{{ route('supplier.order.accept', $order->id) }}" class="primary-btn btn--small btn-accept">Nhận đơn</a>
                    <a href="{{ route('supplier.order.cancel', $order->id) }}" class="secondary-btn btn--small btn-cancel">Huỷ đơn</a>
                  @endif
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
</div>
@endsection

<div class="modal fade" id="order-accept-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Xác nhận</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="accept-order" action="" method="POST">
          @csrf
          <p>Xác nhận đơn hàng?</p>
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Xác nhận</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="order-cancel-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Hủy</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="cancel-order" action="" method="POST">
          @csrf
          <p>Hủy đơn hàng?</p>
          <div class="d-flex">
            <button class="btn primary-btn btn-block" type="submit">Hủy</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<template id="supplier-order-row">
  <tr>
    <td></td><!-- madon -->
    <td>
      <ol></ol><!-- danh sach san pham-->
    </td>
    <td></td><!-- nguoi mua -->
    <td></td><!-- thoi gian dat-->
    <td>
      <div class="order-status"></div><!-- trang thai -->
    </td>
    <td></td><!--tong tien -->
    <td>
      <a href="" class="primary-btn btn--small" target="_blank">Chi tiết</a><!-- chi tiet-->
    </td>
  </tr>
</template>

<template id="product-li">
  <li>
    <a href=""></a>
    <p>SL: <span></span></p>
  </li>
</template>

<template id="order-action">
  <a href="" class="primary-btn btn--small btn-accept">Nhận đơn</a>
  <a href="" class="secondary-btn btn--small btn-cancel">Huỷ đơn</a>
</template>