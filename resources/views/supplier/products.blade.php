@extends('supplier.base')

@section('title', 'Quản lý sản phẩm')

@section('classname', 'manage-products')

@section('content')
<div class="col-md-9">
  <div class="page-pads-container">
    <div class="heading">
      <h3 class="title">QUẢN LÝ SẢN PHẨM</h3>
      <a href="#" class="primary-btn primary-btn--square">+ Thêm sản phẩm</a>
    </div>
    <div class="pad-filters">
      <input type="text" id="search" class="search" placeholder="Tìm kiếm sản phẩm">
      <div class="filter">
        <select id="filter-category" class="dropdown">
          <option value="all">Ngành hàng</option>
          <option value="1">Thời trang nam</option>
          <option value="2">Thời trang nữ</option>
          <option value="3">XXX</option>
        </select>
        <select id="filter-status" class="dropdown">
          <option value="all">Sắp xếp theo</option>
          <option value="1">Giá từ cao xuống thấp</option>
          <option value="2">Giá từ thấp lên cao</option>
          <option value="3">Ngày đăng sản phẩm</option>
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
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="table-product-img" style="background-image: url('../images/man-fashion.png')"></div>
            </td>
            <td>Áo mưa siêu thấm</td>
            <td>Áo nam</td>
            <td>
              <div class="product-old-price">1000000</div>
              <div class="product-price">2000000</div>
            </td>
            <td>500</td>
            <td>30</td>
            <td>
              <a href="" class="secondary-btn btn--small" >Sửa</a>
            </td>
            <td>
              <a href="#" class="primary-btn btn--small" data-toggle="modal" data-target="#delete-modal">Xoá</a>
            </td>
          </tr>
          <tr>
            <td>
              <div class="table-product-img" style="background-image: url('../images/man-fashion.png')"></div>
            </td>
            <td>Áo mưa siêu thấm</td>
            <td>Áo nam</td>
            <td>
              <div class="product-old-price">1000000</div>
              <div class="product-price">2000000</div>
            </td>
            <td>500</td>
            <td>30</td>
            <td>
              <a href="" class="secondary-btn btn--small" >Sửa</a>
            </td>
            <td>
              <a href="#" class="primary-btn btn--small" data-toggle="modal" data-target="#delete-modal">Xoá</a>
            </td>
          </tr>
          <tr>
            <td>
              <div class="table-product-img" style="background-image: url('../images/man-fashion.png')"></div>
            </td>
            <td>Áo mưa siêu thấm</td>
            <td>Áo nam</td>
            <td>
              <div class="product-old-price">1000000</div>
              <div class="product-price">2000000</div>
            </td>
            <td>500</td>
            <td>30</td>
            <td>
              <a href="" class="secondary-btn btn--small" >Sửa</a>
            </td>
            <td>
              <a href="#" class="primary-btn btn--small" data-toggle="modal" data-target="#delete-modal">Xoá</a>
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
        <h2 class="modal-title">Bạn muốn xoá sản phẩm?</h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="" action="" method="POST">
          <div class="d-flex">
            <button class="btn btn-logout primary-btn btn-block" type="submit">Xoá</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>