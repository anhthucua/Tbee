@extends('base')

@section('title', 'Chi tiết đơn hàng')

@section('content')

<div class="wrapper" id="pjax-wrapper">
  <div class="pjax-container" data-border-state="" data-color="#DAD9D6">
    <main>
      <section class="section">
        <div class="container">
          <h3>CHI TIẾT ĐƠN HÀNG</h3>
          <br>
          <dl>
            <dt>Mã đơn hàng:</dt>
            <dd>{{ $order->id }}</dd>

            {{-- shop --}}
            <dt>
              <!-- icon shop -->
              <svg width="17" height="16" viewBox="0 0 17 16" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
                <path d="M1.95 6.6c.156.804.7 1.867 1.357 1.867.654 0 1.43 0 1.43-.933h.932s0 .933 1.155.933c1.176 0 1.15-.933 1.15-.933h.984s-.027.933 1.148.933c1.157 0 1.15-.933 1.15-.933h.94s0 .933 1.43.933c1.368 0 1.356-1.867 1.356-1.867H1.95zm11.49-4.666H3.493L2.248 5.667h12.437L13.44 1.934zM2.853 14.066h11.22l-.01-4.782c-.148.02-.295.042-.465.042-.7 0-1.436-.324-1.866-.86-.376.53-.88.86-1.622.86-.667 0-1.255-.417-1.64-.86-.39.443-.976.86-1.643.86-.74 0-1.246-.33-1.623-.86-.43.536-1.195.86-1.895.86-.152 0-.297-.02-.436-.05l-.018 4.79zM14.996 12.2v.933L14.984 15H1.94l-.002-1.867V8.84C1.355 8.306 1.003 7.456 1 6.6L2.87 1h11.193l1.866 5.6c0 .943-.225 1.876-.934 2.39v3.21z"
                stroke-width=".3" stroke="#333" fill="#333" fill-rule="evenodd"></path>
              </svg>
              <!-- /icon shop -->
              <a href="{{ route('products-shop', $order->supplier_id) }}" style="margin-left: 5px;">{{ $order->supplier_name }}</a>
            </dt>
            <dd></dd>

            {{-- nguoi mua --}}
            <dt>Người mua:</dt>
            <dd>{{ $order->name }}</dd>

            {{-- phone  --}}
            <dt>Số điện thoại người mua:</dt>
            <dd>{{ $order->phone }}</dd>

            {{-- address  --}}
            <dt>Địa chỉ người mua:</dt>
            <dd>{{ $order->address }}</dd>

            {{-- ngay dat --}}
            <dt>Ngày đặt:</dt>
            <dd>{{ $order->time }}</dd>

            {{-- trang thai: 3 --}}
            <dt>Trạng thái đơn hàng:</dt>
            <dd>{{ $order->status . ' ' . $order->upd_time }}</dd>
            @if ($order->coupon_id)
              {{-- ma giam gia ap dung --}}
              <dt>Mã giảm giá áp dụng:</dt>
              <dd>{{ $order->coupon_code }}</dd>
              <dd>Số tiền giảm: -{{ $order->coupon_sale }}</dd>
            @endif
          </dl>
          <br>
          <!-- danh sach chi tiet san pham -->
          <h5>Danh sách các sản phẩm:</h5>
          <div class="pads-container">
            <table class="table product-list">
              <thead>
                <tr>
                  <th>Mã sản phẩm:</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Ngành hàng</th>
                  <th>Giá bán</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                      <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                    </td>
                    <td>
                      <div class="table-product-img" style="background-image: url('{{ $product->main_img }}')"></div>
                    </td>
                    <td>{{ $product->cat_lv2 }}</td>
                    <td>
                      <div class="product-price">{{ $product->sale_price }}</div>
                    </td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->total_price }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /danh sach chi tiet san pham -->
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="order-summary">
                {{-- so luong --}}
                <div class="order-col">
                  <div><strong>Tổng số lượng sản phẩm:</strong></div>
                  <div><strong>{{ $product_count }}</strong></div>
                </div>
                {{-- tong tien  --}}
                <div class="order-col">
                  <div><strong>Tổng tiền thanh toán:</strong></div>
                  <div class="order-total"><strong>{{ $order->total_price }}</strong></div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </main>
  </div>
</div>
@endsection