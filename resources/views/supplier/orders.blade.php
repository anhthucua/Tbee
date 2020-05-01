@extends('supplier.base')

@section('title', 'Quản lý đơn hàng')

@section('classname', 'manage-products')

@section('content')
<div class="col-md-9">
  <div class="page-pads-container">
    <div class="heading">
      <h3 class="title">QUẢN LÝ ĐƠN HÀNG</h3>
    </div>
    <div class="pad-filters">
      <input type="text" id="search" class="search" placeholder="Tìm kiếm theo id đơn hàng">
      <div class="filter">
        <select id="sort" class="dropdown">
          <option value="id desc">Sắp xếp theo</option>
          <option value="wait-confirm_at desc">Đơn chờ xác nhận</option>
          <option value="cancel_at desc">Đơn đã huỷ</option>
          <option value="agree_at desc">Đơn đã nhận</option>
          <option value="created_at desc">Ngày tạo mới nhất</option>
          <option value="updated_at desc">Ngày tạo xa nhất</option>
        </select>
      </div>
    </div>
    <h5>Thông tin các sản phẩm:</h5>
    <div class="pads-container">
      <table class="table product-list">
        <thead>
          <tr>
            <th>Mã đơn</th>
            <th style="width: 40%;">Danh sách sản phẩm</th>
            <th>Người mua</th>
            <th>Thời gian đặt</th>
            <th style="width: 20%;">Trạng thái</th>
            <th style="width: 10%;"></th>
          </tr>
        </thead>
        <tbody>
          {{-- TH1: CHO XAC NHAN --}}
          <tr>
            <td>trananhthu</td>
            <td>
              <ol>
                <li>ao nam chat cotton re nhat thi truong sieu dep sieu ben</li>
                <li>ao nam chat cotton re nhat thi truong sieu dep sieu ben</li>
                <li>ao nam chat cotton re nhat thi truong sieu dep sieu ben</li>
              </ul>
            </td>
            <td>Pham Minh Hieu</td>
            <td>15:45 28/12/2020</td>
            <td>
              <div class="order-status">Chờ xác nhận</div>
              <a href="#" class="primary-btn btn--small">Nhận đơn</a>
              <a href="#" class="secondary-btn btn--small">Huỷ đơn</a>
            </td>
            <td>
              <a href="#" class="primary-btn btn--small" >Chi tiết</a>
            </td>
          </tr>
          {{-- TH2: DA NHAN DON/HUY DON --}}
          <tr>
            <td>trananhthu</td>
            <td>
              <ol>
                <li>ao nam chat cotton re nhat thi truong sieu dep sieu ben</li>
                <li>ao nam chat cotton re nhat thi truong sieu dep sieu ben</li>
                <li>ao nam chat cotton re nhat thi truong sieu dep sieu ben</li>
              </ul>
            </td>
            <td>Pham Minh Hieu</td>
            <td>15:45 28/12/2020</td>
            <td>
              <div class="order-status order-status--cancel">Đã huỷ đơn!</div>
              <div class="order-status order-status--agree">Đã nhận đơn!</div>
            </td>
            <td>
              <a href="#" class="primary-btn btn--small" >Chi tiết</a>
            </td>
          </tr>
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