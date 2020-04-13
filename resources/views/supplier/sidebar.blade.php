{{-- <div class="sidebar col-md-3">
  <ul class="sidebar-menu">
    <li>
      <a href="{{ route('supplier.manage-products') }}">Quản lý sản phẩm</a>
    </li>
    <li>
      <a href="{{ route('supplier.add-product') }}">Thêm sản phẩm</a>
    </li>
    <li>
      <a href="#">Quản lý đơn hàng</a>
    </li>
    <li>
      <a href="#">Cập nhật thông tin</a>
    </li>
  </ul>
</div> --}}

<!-- Main sidebar -->
<div id="sidebar-main" class="sidebar sidebar-default sidebar-separate sidebar-fixed col-md-3">
	<div class="sidebar-content">
		<div class="sidebar-category sidebar-default">
			<div class="sidebar-user">
				<div class="category-content">
					<h6>Tên shop</h6>
				</div>
			</div>
		</div>
		<!-- /Sidebar Category -->
		<div class="sidebar-category sidebar-default">
			<div class="category-content">
				<ul id="fruits-nav" class="nav flex-column">
					<li class="nav-item">
						<a href="{{ route('supplier.manage-products') }}" class="nav-link">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Quản lý sản phẩm
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('supplier.add-product') }}" class="nav-link">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Thêm sản phẩm
						</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link active">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Quản lý đơn hàng
						</a>
					</li>
          <li class="nav-item">
						<a href="#" class="nav-link">
							<i class="fa fa-pencil" aria-hidden="true"></i>
							Cập nhật thông tin
						</a>
					</li>
				</ul>
				<!-- /Nav -->
			</div>
			<!-- /Category Content -->
		</div>
		<!-- /Sidebar Category -->
	</div>
</div>
<!-- /main sidebar -->