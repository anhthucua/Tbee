$(document).ready(function () {
  // Not closing noti dropdown on click inside
  $('.noti.dropdown-menu').on("click.bs.dropdown", function () {
    return $('.dropdown.noti-block').one('hide.bs.dropdown', function () {
      return false;
    });
  });

  // Mark all as read noti
  $('.noti.dropdown-menu .mark-read a').click(function (e) {
    e.preventDefault();
    axios({
      method: 'post',
      url: '/noti/mark-all-read'
    }).then(() => {
      $('.noti-list .no-read').each(function (index, element) {
        $(element).removeClass('no-read');
        $('.noti-block .qty').remove();
      });
    })
  });

  // Click on notification
  $('.noti .noti-list .no-read a.noti-content').click(function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    axios({
      method: 'post',
      url: `noti/${id}/read`
    }).then(() => {
      window.location.href = $(this).prop('href');
    })
  });

  // Load more noti
  $('.noti-block .see-more ').click(function (e) {
    e.preventDefault();
    let btn = $(this).closest('.see-more'),
      noti_list = document.querySelector('.noti-block .noti-list ul');
    axios({
      method: 'post',
      url: '/get-more-noti',
      data: {
        current: btn.data('cur')
      }
    }).then((res) => {
      btn.data('cur', btn.data('cur') + res.data.length);
      res.data.forEach(noti => {
        let tpl = document.getElementById('noti-li'),
          clone = tpl.content.cloneNode(true),
          li = clone.querySelector('li'),
          a = clone.querySelector('a'),
          span = clone.querySelectorAll('span');
        if (noti.read == 0) {
          li.classList.add('no-read');
        }
        a.href = noti.url;
        a.dataset.id = noti.id;
        span[0].textContent = noti.content;
        span[1].textContent = noti.hour;
        span[2].textContent = noti.date;
        noti_list.appendChild(clone);
      });
      if (btn.data('cur') >= btn.data('all')) {
        btn.remove();
      }
    })
  });

  // handle chat
  $('.chat-box').click(function (e) {
    $('.chat-wrapper').show();
  })

  $('.chat-wrapper .chat .fa-close').click(function (e) {
    $('.chat-wrapper').hide();
  })

  // Login form submit
  $('#login-modal .form-signin .btn-lg').click(function (e) {
    e.preventDefault();
    $('.error-login').text('');
    let data = {
      username: $('.lg-username').val(),
      password: $('.lg-password').val()
    };
    // if ($('#rememberMe').is(':checked')) {
    //   data.remember = "on";
    // };
    axios({
      method: 'post',
      url: '/login',
      data: data
    }).then(function () {
      location.reload();
    })
      .catch(function (error) {
        let errors = error.response.data.errors;
        _.forOwn(errors, (value, key) => {
          value.forEach(el => {
            let err = document.createElement('div');
            err.textContent = el;
            document.querySelector(`.form-signin .error-login`).appendChild(err);
          });
        })
      });
  });

  // Sign up form submit
  $('#signup-modal .form-signup .btn-signup').click(function (e) {
    e.preventDefault();
    $('.error-username').text('');
    $('.error-phone').text('');
    $('.error-email').text('');
    $('.error-password').text('');
    axios({
      method: 'post',
      url: '/register',
      data: {
        username: $('.su-username').val(),
        phone: $('.su-phone').val(),
        email: $('.su-email').val(),
        password: $('.su-password').val(),
        password_confirmation: $('.su-password_confirmation').val(),
      }
    }).then(function () {
      $('#signup-modal').modal('hide');
      $('#signup-modal').on('hidden.bs.modal', function () {
        $('#signup-success-modal').modal('show');
      });
    })
      .catch(function (error) {
        let errors = error.response.data.errors;
        _.forOwn(errors, (value, key) => {
          value.forEach(el => {
            let err = document.createElement('div');
            if (el == 'Định dạng trường tên đăng nhập không hợp lệ.') {
              el = 'Tên đăng nhập chỉ gồm chữ và số, với ít nhất 1 chữ';
            }
            err.textContent = el;
            document.querySelector(`.form-signup .error-${key}`).appendChild(err);
          });
        })
      });
  });

  // Click "Dong y" to hide signup success modal
  $('#signup-success-modal .btn-ok').click((e) => {
    e.preventDefault();
    $('#signup-success-modal').modal('hide');
  });

  // Reload when close signup success modal
  $('#signup-success-modal').on('hidden.bs.modal', function () {
    location.reload();
  });

  ////////////////////////////////////////
  // Home page

  // Products Slick
  $('.products-slick').each(function () {
    var $this = $(this),
      $nav = $this.attr('data-nav');

    $this.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      infinite: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
      responsive: [{
        breakpoint: 991,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      ]
    });
  });

  // Products Widget Slick
  $('.products-widget-slick').each(function () {
    var $this = $(this),
      $nav = $this.attr('data-nav');

    $this.slick({
      infinite: true,
      autoplay: true,
      speed: 300,
      dots: false,
      arrows: true,
      appendArrows: $nav ? $nav : false,
    });
  });

  /////////////////////////////////////////

  // Product Main img Slick
  $('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

  // Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: 0,
    vertical: true,
    asNavFor: '#product-main-img',
    responsive: [{
      breakpoint: 991,
      settings: {
        vertical: false,
        arrows: false,
        dots: true,
      }
    },]
  });

  // Hot deal slider homepage
  $('.hot-deal-wrapper').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    autoplay: true,
    speed: 300,
    infinite: true
  });

  // Product img zoom
  var zoomMainProduct = document.getElementById('product-main-img');
  if (zoomMainProduct) {
    $('#product-main-img .product-preview').zoom();
  }

  // Page search products
  if ($(document.body).is('.page-search-product')) {
    function filterProductSearch() {
      let minPrice = parseInt($('#price-min').val()),
        maxPrice = parseInt($('#price-max').val()),
        sort = $('.store-sort .input-select option:selected').val(),
        name = $('h3 > span.name').text();

      if (!minPrice) {
        return false;
      }

      axios({
        method: 'POST',
        url: '/product/search/filter',
        data: {
          minPrice: minPrice,
          maxPrice: maxPrice,
          sort: sort,
          name: name
        }
      }).then(function (res) {
        document.querySelector('#store > .row').innerHTML = '';
        if (res.data.length > 0) {
          res.data.forEach(product => {
            let tpl = document.querySelector('#product-div'),
              clone = tpl.content.cloneNode(true),
              p_link = clone.querySelector('.product-link'),
              p_img = clone.querySelector('.product-img'),
              p_sale = clone.querySelector('.product-label .sale'),
              p_purchased = clone.querySelector('.product-purchased'),
              p_name = clone.querySelector('.product-name a'),
              price_1 = clone.querySelector('.product-price span'),
              price_2 = clone.querySelector('.product-old-price');
            p_link.href = `/product/${product.id}/show`;
            p_img.style.backgroundImage = `url(${product['img']})`;
            if (product.sale_percent) {
              p_sale.textContent = `${product.sale_percent}%`;
            } else {
              p_sale.style.display = 'none';
            }
            p_purchased.textContent = `Đã bán ${product.purchased_number}`;
            p_name.textContent = product.name;
            p_name.href = `/product/${product.id}/show`;
            price_1.textContent = product.sale_price;
            price_2.textContent = (product.sale_price === product.price) ? '' : product.price;
            document.querySelector('#store > .row').appendChild(clone);
          });
        } else {
          $('#store > .row').html('<p class="no-products">Không có sản phẩm nào.</p>');
        }
      })
    }

    // Sort
    $('.store-sort .input-select').change(function () {
      filterProductSearch();
    });

    $('.input-number').each(function () {
      let $this = $(this),
        $input = $this.find('input[type="number"]'),
        up = $this.find('.qty-up'),
        down = $this.find('.qty-down');

      down.on('click', function () {
        let value = parseInt($input.val()) - 1000;
        value = value < 1 ? 1 : value;
        $input.val(value);
        $input.trigger('change');
      })

      up.on('click', function () {
        let value = parseInt($input.val()) + 1000;
        $input.val(value);
        $input.trigger('change');
      })
    });

    let priceInputMax = document.getElementById('price-max'),
      priceInputMin = document.getElementById('price-min');

    $(priceInputMax).on('change', function () {
      updatePriceSlider($(this).parent(), this.value)
    });

    $(priceInputMin).on('change', function () {
      updatePriceSlider($(this).parent(), this.value)
    });

    function updatePriceSlider(elem, value) {
      if (elem.hasClass('price-min')) {
        priceSlider.noUiSlider.set([value, null]);
      } else if (elem.hasClass('price-max')) {
        priceSlider.noUiSlider.set([null, value]);
      }
    }

    // Price Slider
    var priceSlider = document.getElementById('price-slider');
    if (priceSlider) {
      let minPrice = parseInt(document.querySelector('#productMinPrice').value),
        maxPrice = parseInt(document.querySelector('#productMaxPrice').value);
      nouislider.create(priceSlider, {
        start: [minPrice, maxPrice],
        connect: true,
        step: 1000,
        range: {
          'min': minPrice,
          'max': maxPrice
        },
        format: {
          to: function (value) {
            return value;
          },
          from: function (value) {
            return Number(value);
          }
        }
      });

      priceSlider.noUiSlider.on('set', function (values, handle) {
        var value = values[handle];
        handle ? priceInputMax.value = value : priceInputMin.value = value;
        filterProductSearch();
      });
    }
  }

  ///////////////////////////////////////////////////////////////////////
  /*
  * Danh cho nguoi ban
  */

  // upload anh bia
  $('.page-supplier .form .btn-image').click((e) => {
    e.preventDefault();
    $('.page-supplier .form #shopBanner').trigger('click');
  });

  $('.page-supplier .form #shopBanner').on('change', () => {
    let input = document.querySelector('.page-supplier .form #shopBanner'),
      url = $(input).val(),
      ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase(),
      accepted_ext = ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'svg'];

    if (input.files && input.files[0] && ($.inArray(ext, accepted_ext) !== -1)) {
      let reader = new FileReader();
      reader.onload = function (e) {
        $('.page-supplier .form .image-name').text(input.files[0].name)
        $('.page-supplier .form .shop-banner').attr('src', e.target.result);
        $('.page-supplier .form .shop-banner').removeClass('d-none');
      }
      reader.readAsDataURL(input.files[0]);
    }
  })

  // active sidebar
  $('.page-supplier #sidebar-main a.nav-link').each(function () {
    if (this.href === window.location.href) {
      $(this).addClass('active');
      return false;
    }
  });

  /*
  * Create product form
  */

  if ($(document.body).is('.add-product')) {
    // Array store prodcut images
    let img_arr = [];

    // Insert product image
    $('.add-product-form #images').on('change', function () {
      if (this.files) {
        let images = this.files;
        for (let i = 0; i < images.length; i++) {
          if (img_arr.length + i >= 5) {
            alert('Chỉ được chọn tối đa 5 ảnh');
            break;
          }
          let reader = new FileReader();
          reader.onload = function (e) {
            let tpl = document.querySelector('#imageTemplate'),
              clone = tpl.content.cloneNode(true),
              wrapper = clone.querySelector('.img-wrapper'),
              img = clone.querySelector('img'),
              container = document.querySelector('.form .upload-img-container');
            if (img_arr.length + i === 0) {
              wrapper.classList.add('active');
            }
            // Insert to UI
            wrapper.dataset.el = img_arr.length + i;
            img.src = e.target.result;
            $(container).removeClass('d-none');
            container.appendChild(clone);

            // Insert to array
            if ((i == images.length - 1) || (img_arr.length + i == 4)) {
              setTimeout(() => {
                appendToArray(images);
              }, 400);
            }
          }
          reader.readAsDataURL(this.files[i]);
        }
        function appendToArray(file_list) {
          let new_img_arr = Array.from(file_list);
          img_arr = img_arr.concat(new_img_arr);
          let arr_len = img_arr.length;
          if (arr_len > 5) {
            img_arr.splice(5);
          }
        }
      }
    });

    // Click on image set main image
    $('.form .upload-img-container').on('click', '.img-wrapper .image-wrapper', function (e) {
      if (!$(this).parent().hasClass('active')) {
        $(this).parent().siblings().removeClass('active');
        $(this).parent().addClass('active');
        $('.form .main-img-input').val($(this).parent().attr('data-el'));
      }
    })

    // Delete image
    $('.add-product-form .upload-img-container').on('click', '.img-wrapper .remove-image', function (e) {
      e.preventDefault();
      let wrapper = $(this).parent(),
        number = parseInt($(wrapper).attr('data-el'));
      if (!wrapper.hasClass('active')) {
        img_arr.splice(number, 1);
        $(this).parent().remove();
        $('.form .upload-img-container .img-wrapper').each(function (index, element) {
          if (parseInt($(element).attr('data-el')) > number) {
            $(element).attr('data-el', parseInt($(element).attr('data-el')) - 1);
          }
        });
      } else {
        if (img_arr.length === 1) {
          img_arr.splice(number, 1);
          $(wrapper).remove();
          $('.form .main-img-input').val('');
        } else {
          if (number != 0) {
            img_arr.splice(number, 1);
            $(wrapper).remove();
            $('.form .main-img-input').val('0');
            $('.add-product-form .upload-img-container .img-wrapper[data-el="0"]').addClass('active');
            $('.form .upload-img-container .img-wrapper').each(function (index, element) {
              if (parseInt($(element).attr('data-el')) > number) {
                $(element).attr('data-el', parseInt($(element).attr('data-el')) - 1);
              }
            });
          } else {
            img_arr.splice(number, 1);
            $(wrapper).remove();
            $('.add-product-form .upload-img-container .img-wrapper[data-el="1"]').addClass('active');
            $('.form .upload-img-container .img-wrapper').each(function (index, element) {
              if (parseInt($(element).attr('data-el')) > number) {
                $(element).attr('data-el', parseInt($(element).attr('data-el')) - 1);
              }
            });
          }
        }
      }
    })

    // Form submit
    $('#addProductForm').submit(function (e) {
      e.preventDefault();
      let formData = new FormData($(this)[0]);
      img_arr.forEach((el, i) => {
        formData.append('images[]', el);
      })
      // return false;
      axios({
        method: 'POST',
        url: '/product/create',
        data: formData
      }).then(function () {
        window.location.replace('/supplier/products');
      })
    })
  }

  // Edit product form
  if ($(document.body).is('.edit-product')) {
    $('.upload-img-container .image-wrapper .product-img').click(function (e) {
      e.preventDefault();
      $('.upload-img-container .img-wrapper.active').removeClass('active');
      $(this).closest('.img-wrapper').addClass('active');
      $('.main-img-input').val($(this).data('id'));
    });
  }

  // Click on category_lv1 show cat_lv2
  $('.form .cat-lv1-section .cat-lv1').click(function (e) {
    if (!$(this).hasClass('active')) {
      e.preventDefault();
      $('.cat-lv1-section .cat-lv1').removeClass('active');
      $(this).addClass('active');
      $('.cat-lv2-section .cat-lv2.show').removeClass('show');
      let cat1_id = $(this).data('id');
      $(`.cat-lv2.parent-id-${cat1_id}`).addClass('show');
      $('input#catLv2').val('');
    }
  });

  // Click on category lv2
  $('.form .cat-lv2-section .cat-lv2').click(function (e) {
    if (!$(this).hasClass('active')) {
      e.preventDefault();
      $(this).siblings('.active').removeClass('active');
      $(this).addClass('active');
      let cat2_id = $(this).data('id');
      $('input#catLv2').val(cat2_id);
    }
  });

  // Product images adding
  $('.form .choose-img-btn').click((e) => {
    e.preventDefault();
    $('.add-product-form #images').trigger('click');
  })

  // Validate max 5 images
  $('.form #images').on('click', function (e) {
    if ($('.form .upload-img-container .img-wrapper').length >= 5) {
      e.preventDefault();
      alert('Chỉ được chọn tối đa 5 ảnh');
    }
  });

  /* End create product form */

  /*
  * Manage products
  */

  if ($(document.body).is('.manage-products')) {
    // Set route for delete product
    $('table.product-list').on('click', 'td .btn-delete', function () {
      $('#delete-modal form#del-product').attr('action', this.href);
    });

    let searchValue = $('.pad-filters #search').val(),
      category = $('#filter-category option:selected').val(),
      sort = $('#sort option:selected').val();

    function searchProducts(searchValue, category, sort) {
      axios({
        method: 'POST',
        url: '/product/supplier-search',
        data: {
          search: searchValue,
          category: category,
          sort: sort
        }
      }).then((res) => {
        let tbody = document.querySelector('table.product-list tbody');

        // empty tbody
        while (tbody.lastChild) {
          tbody.removeChild(tbody.lastChild);
        }

        if (res.data.length > 0) {
          res.data.forEach(product => {
            let tpl = document.querySelector('#product-row'),
              clone = tpl.content.cloneNode(true),
              td = clone.querySelectorAll('td'),
              img_div = clone.querySelector('.table-product-img'),
              a = clone.querySelectorAll('td a');
            $(img_div).css('background-image', `url(${product['img']})`);
            td[1].innerText = product.name;
            td[2].innerText = product.cat_lv2;
            if (product.sale_price === product.price) {
              $(td[3]).html(`<div class="product-price">${product.price}</div>`);
            } else {
              $(td[3]).html(`
                  <div class="product-old-price">${product.price}</div>
                  <div class="product-price">${product.sale_price}</div>
                `);
            }
            td[4].innerText = product.purchased_number;
            td[5].innerText = product.stock;
            td[6].innerText = product.date;
            a[0].href = `/product/${product.id}/edit`;
            a[1].href = `/product/${product.id}/delete`;
            tbody.appendChild(clone);
          });
        } else {
          $('table.product-list tbody').html(`
          <tr>
            <td colspan="9" class="no-item">Không có sản phẩm nào.</td>
          </tr>
          `);
        }
      }).catch((err) => {
        console.log(err);
      })
    }

    $('#search').on('input', function () {
      searchValue = $(this).val();
      searchProducts(searchValue, category, sort);
    });

    $('#filter-category').change(() => {
      category = $('#filter-category option:selected').val();
      searchProducts(searchValue, category, sort);
    });

    $('#sort').change(() => {
      sort = $('#sort option:selected').val();
      searchProducts(searchValue, category, sort);
    })
  }

  /* End manage products */

  // Manage orders for supplier
  if ($(document.body).is('.page-supplier.manage-orders')) {
    // Nhan don hang
    $('.product-list tbody').on('click', 'tr .btn-accept', function (e) {
      e.preventDefault();
      $('#order-accept-modal').modal('show');
      $('form#accept-order').prop('action', this.href);
    });

    // Huy don hang
    $('.product-list tbody').on('click', 'tr .btn-cancel', function (e) {
      e.preventDefault();
      $('#order-cancel-modal').modal('show');
      $('form#cancel-order').prop('action', this.href);
    });

    $('.pad-filters #search').on('input', function () {
      supplierSearchOrders();
    });

    $('#filter-category').change(function () {
      supplierSearchOrders();
    });

    function supplierSearchOrders() {
      let search = $('.pad-filters #search').val(),
        status = $('#filter-category option:selected').val();
      axios({
        method: 'post',
        url: '/supplier/orders/search',
        data: {
          search: search,
          status: status
        }
      }).then((res) => {
        let tbody = document.querySelector('.pads-container table tbody');

        // empty tbody
        while (tbody.lastChild) {
          tbody.removeChild(tbody.lastChild);
        }

        if (res.data.length > 0) {
          res.data.forEach(order => {
            let tpl = document.querySelector('#supplier-order-row'),
              clone = tpl.content.cloneNode(true),
              td = clone.querySelectorAll('td'),
              ol = clone.querySelector('td > ol'),
              status = clone.querySelector('div.order-status'),
              link = clone.querySelector('.primary-btn');
            td[0].innerText = order.id;
            order.products.forEach(product => {
              let tpl1 = document.querySelector('#product-li'),
                clone1 = tpl1.content.cloneNode(true),
                a1 = clone1.querySelector('a'),
                span = clone1.querySelector('span');
              a1.href = `/product/${product.id}/show`;
              a1.textContent = product.name;
              span.textContent = product.qty;
              ol.appendChild(clone1);
            });
            td[2].innerText = order.username;
            td[3].innerText = order.time;
            status.innerText = order.status;
            if (order.status_class) {
              status.classList.add(order.status_class);
            } else {
              let tpl2 = document.querySelector('#order-action'),
                clone2 = tpl2.content.cloneNode(true),
                a = clone2.querySelectorAll('a');
              a[0].href = `/supplier/order/${order.id}/accept`;
              a[1].href = `/supplier/order/${order.id}/cancel`;
              td[4].appendChild(clone2);
            }
            td[5].innerText = order.total_price;
            link.href = `/order-detail/${order.id}`;
            tbody.appendChild(clone);
          });
        } else {
          $(tbody).html(`
          <tr>
            <td colspan="7">Không có đơn hàng nào.</td>
          </tr>
          `);
        }
      })
    }
  }

  /////////////////////////////////////////

  // Category page

  if ($(document.body).is('.page-category')) {

    // Filter and sort products
    function filterProductCategory() {
      let minPrice = parseInt($('#price-min').val()),
        maxPrice = parseInt($('#price-max').val()),
        cat_lv2_list = [],
        sort = $('.store-sort .input-select option:selected').val(),
        id = $('input#page-category-id').val(),
        level = $('#category-level').val();

      if (!minPrice) {
        return false;
      }

      $('.checkbox-filter .input-checkbox input:checked').each(function () {
        cat_lv2_list.push($(this).data('id'));
      });

      axios({
        method: 'POST',
        url: `/category/${id}/search`,
        data: {
          minPrice: minPrice,
          maxPrice: maxPrice,
          cat_lv2: cat_lv2_list,
          sort: sort,
          level: level
        }
      }).then(function (res) {
        document.querySelector('#store > .row').innerHTML = '';
        if (res.data.length > 0) {
          res.data.forEach(product => {
            let tpl = document.querySelector('#product-div'),
              clone = tpl.content.cloneNode(true),
              p_link = clone.querySelector('.product-link'),
              p_img = clone.querySelector('.product-img'),
              p_sale = clone.querySelector('.product-label .sale'),
              p_purchased = clone.querySelector('.product-purchased'),
              p_name = clone.querySelector('.product-name a'),
              price_1 = clone.querySelector('.product-price span'),
              price_2 = clone.querySelector('.product-old-price');
            p_link.href = `/product/${product.id}/show`;
            p_img.style.backgroundImage = `url(${product['img']})`;
            if (product.sale_percent) {
              p_sale.textContent = `${product.sale_percent}%`;
            } else {
              p_sale.style.display = 'none';
            }
            p_purchased.textContent = `Đã bán ${product.purchased_number}`;
            p_name.textContent = product.name;
            p_name.href = `/product/${product.id}/show`;
            price_1.textContent = product.sale_price;
            price_2.textContent = (product.sale_price === product.price) ? '' : product.price;
            document.querySelector('#store > .row').appendChild(clone);
          });
        } else {
          $('#store > .row').html('<p class="no-products">Không có sản phẩm nào.</p>');
        }

      })
    }

    // Handle event change category filter
    $('.checkbox-filter .input-checkbox input').on('change', function () {
      filterProductCategory();
    });

    // Sort
    $('.store-sort .input-select').change(function () {
      filterProductCategory();
    });

    $('.input-number').each(function () {
      let $this = $(this),
        $input = $this.find('input[type="number"]'),
        up = $this.find('.qty-up'),
        down = $this.find('.qty-down');

      down.on('click', function () {
        let value = parseInt($input.val()) - 1000;
        value = value < 1 ? 1 : value;
        $input.val(value);
        $input.trigger('change');
      })

      up.on('click', function () {
        let value = parseInt($input.val()) + 1000;
        $input.val(value);
        $input.trigger('change');
      })
    });

    let priceInputMax = document.getElementById('price-max'),
      priceInputMin = document.getElementById('price-min');

    $(priceInputMax).on('change', function () {
      updatePriceSlider($(this).parent(), this.value)
    });

    $(priceInputMin).on('change', function () {
      updatePriceSlider($(this).parent(), this.value)
    });

    function updatePriceSlider(elem, value) {
      if (elem.hasClass('price-min')) {
        priceSlider.noUiSlider.set([value, null]);
      } else if (elem.hasClass('price-max')) {
        priceSlider.noUiSlider.set([null, value]);
      }
    }

    // Price Slider
    var priceSlider = document.getElementById('price-slider');
    if (priceSlider) {
      let minPrice = parseInt(document.querySelector('#productMinPrice').value),
        maxPrice = parseInt(document.querySelector('#productMaxPrice').value);
      nouislider.create(priceSlider, {
        start: [minPrice, maxPrice],
        connect: true,
        step: 1000,
        range: {
          'min': minPrice,
          'max': maxPrice
        },
        format: {
          to: function (value) {
            return value;
          },
          from: function (value) {
            return Number(value);
          }
        }
      });

      priceSlider.noUiSlider.on('set', function (values, handle) {
        var value = values[handle];
        handle ? priceInputMax.value = value : priceInputMin.value = value;
        filterProductCategory();
      });
    }
  }

  ////////////////////////////////////////
  // Product detail page

  if ($(document.body).is('.page-product-detail')) {
    $('.add-to-cart-btn.logged-in').click(function (e) {
      e.preventDefault();
      let pid = window.location.pathname.split("/")[2];
      axios({
        method: 'POST',
        url: '/add-to-cart',
        data: {
          pid: pid
        }
      }).then((res) => {
        $('#error-cart-modal p.info').text(res.data);
        if (res.data === 'Sản phẩm đã được thêm vào giỏ hàng') {
          let qty = $('.cart .qty');
          qty.text(parseInt(qty.text()) + 1);
        }
        $('#error-cart-modal').modal('show');
      })
    });

    $('.buy-now').click(function (e) {
      e.preventDefault();
      let pid = window.location.pathname.split("/")[2];
      axios({
        method: 'POST',
        url: '/add-to-cart',
        data: {
          pid: pid
        }
      }).then((res) => {
        $('#error-cart-modal p.info').text(res.data);
        if (res.data === 'Sản phẩm đã được thêm vào giỏ hàng') {
          window.location.href = '/cart';
        } else {
          $('#error-cart-modal').modal('show');
        }
      })
    });
  }

  ////////////////////////////////////////
  // page cart

  if ($(document.body).is('.page-cart')) {
    // Handle input number
    $('.input-quantity .minus').click(function () {
      var $input = $(this).parent().find('input');
      var count = parseInt($input.val()) - 1;
      $input.val(count);
      $input.trigger('change');
      return false;
    });
    $('.input-quantity .plus').click(function () {
      var $input = $(this).parent().find('input');
      $input.val(parseInt($input.val()) + 1);
      $input.trigger('change');
      return false;
    });
    $('.input-quantity input').change(function () {
      let value = parseInt($(this).val()),
        max = parseInt($(this).attr('max')),
        min = parseInt($(this).attr('min')),
        minus = $(this).parent().find('.minus'),
        plus = $(this).parent().find('.plus'),
        input = $(this);
      if (value >= max) {
        $(this).val(max);
        plus.prop('disabled', true);
        minus.prop('disabled', false);
      } else if (value <= min) {
        $(this).val(min);
        minus.prop('disabled', true);
        plus.prop('disabled', false);
      } else {
        minus.prop('disabled', false);
        plus.prop('disabled', false);
      }
      axios({
        method: 'patch',
        url: '/cart/update',
        data: {
          pid: input.data('pid'),
          quantity: input.val()
        }
      }).then(function () {
        input.closest('.cart-item__content')
          .find('.cart-item__cell-total-price span')
          .text(input.val() * input.data('price'));
        getTotalPrice();
      })
    });
    $('.input-quantity input').each(function () {
      let value = parseInt($(this).val()),
        max = parseInt($(this).attr('max')),
        min = parseInt($(this).attr('min')),
        minus = $(this).parent().find('.minus'),
        plus = $(this).parent().find('.plus');
      if (value >= max) {
        $(this).val(max);
        plus.prop('disabled', true);
      } else if (value <= min) {
        $(this).val(min);
        minus.prop('disabled', true);
      }
    });

    // Delete product
    $('.cart-item__action').click(function (e) {
      e.preventDefault();
      $('#delete-modal .form-delete').prop('action', $(this).data('route'));
      $('#delete-modal').modal('show');
    });

    // Checkbox
    $('.lbl-shop').click(function (e) {
      let lbl = $(this),
        chb = $(this).siblings('input'),
        sid = lbl.data('sid'),
        check = false;
      $('.lbl-shop').each(function (index, element) {
        if ($(element).data('sid') !== sid && $(element).siblings('input').is(':checked')) {
          e.preventDefault();
          check = true;
          $('#noti-cart-modal').modal('show');
        }
      });
      if (!check) {
        if (chb.is(':checked')) {
          $(`.chb-shop-${sid}`).prop('checked', false);
        } else {
          $(`.chb-shop-${sid}`).prop('checked', true);
        }
        getTotalPrice();
      }
    });

    $('.lbl-product').click(function (e) {
      let lbl = $(this),
        sid = lbl.data('sid'),
        pid = lbl.data('pid'),
        check = false;
      if (lbl.siblings('input').is(':checked')) {
        $($(`.chb-shop-${sid}`)).each(function (index, element) {
          if ($(element).data('pid') !== pid && $(element).is(':checked')) {
            check = true;
          }
        });
        if (!check) {
          $(`#check-shop-${sid}`).prop('checked', false);
        }
      } else {
        $('.lbl-shop').each(function (index, element) {
          if ($(element).data('sid') !== sid && $(element).siblings('input').is(':checked')) {
            e.preventDefault();
            check = true;
            $('#noti-cart-modal').modal('show');
          }
        });
        if (!check) {
          $(`#check-shop-${sid}`).prop('checked', true);
        }
      }
    });

    $('.chb-product').change(function (e) {
      getTotalPrice();
    });

    // voucher
    $('.voucher > input').on('input', function () {
      $(this).prop('data-percent', null)
      $(this).prop('data-max', null);
      $('.voucher').siblings('.error').addClass('d-none');
      $('.voucher').siblings('.text-success').addClass('d-none');
      getTotalPrice();
    });

    $('.voucher > button').click(function (e) {
      e.preventDefault();
      axios({
        method: 'post',
        url: '/coupon/check',
        data: {
          code: $('.voucher > input').val(),
        }
      }).then((res) => {
        if (res.data === 'error') {
          $('.voucher').siblings('.text-success').addClass('d-none');
          $('.voucher').siblings(`.error`).removeClass('d-none');
        } else {
          $('.voucher > input').prop('data-percent', res.data.percent);
          $('.voucher > input').prop('data-max', res.data.max);
          $('.voucher').siblings('.error').addClass('d-none');
          $('.voucher').siblings(`.text-success`).removeClass('d-none');
          getTotalPrice();
        }
      })
    });

    function getTotalPrice() {
      let sum = 0,
        voucher = $('.voucher > input'),
        total = 0;

      $('.chb-product').each(function (index, element) {
        if ($(element).is(':checked')) {
          let money = $(element).closest('.cart-item__content').find('.cart-item__cell-total-price span').text();
          sum += parseInt(money);
        }
      });

      if (voucher.prop('data-percent') == null) {
        total = sum;
      } else {
        if (voucher.prop('data-max') == null) {
          total = sum - sum * parseInt(voucher.prop('data-percent')) / 100;
        } else {
          if ((sum * parseInt(voucher.prop('data-percent')) / 100) >= parseInt(voucher.prop('data-max'))) {
            total = sum - parseInt(voucher.prop('data-max'));
          } else {
            total = sum - sum * parseInt(voucher.prop('data-percent')) / 100;
          }
        }
      }

      if (total < 0) {
        total = 0;
      }
      $('.total .total-money').text(total);
    }

    $('.total .primary-btn').click(function (e) {
      e.preventDefault();
      let product_list = [],
        voucher = $('.voucher > input');
      $('.chb-product').each(function (index, element) {
        if ($(element).is(':checked')) {
          let pid = $(element).siblings('.lbl-product').data('pid'),
            qty = $(element).closest('.cart-item__content').find('.cart-item__cell-quantity input').val(),
            product = {
              pid: pid,
              qty: qty
            };
          product_list.push(product);
        }
      });

      if (product_list.length === 0) {
        return false;
      }

      sid = $('input.checkbox-shop:checked').data('sid');

      if (voucher.prop('data-percent') != undefined) {
        var coupon = voucher.val();
      }

      let data = {
        coupon: coupon,
        product_list: product_list,
        sid: sid
      };

      axios({
        method: 'post',
        url: '/cart/submit',
        data: data
      }).then(function () {
        window.location.href = '/checkout';
      });
    });
  }

  // page checkout
  if ($(document.body).is('.page-checkout')) {
    $('a.order-submit').click(function (e) {
      e.preventDefault();
      let aid = $('.detail-addredd-wrapper input:checked').data('aid'),
        product_list = [],
        cid = $('.voucher input').data('cid'),
        total = $('.order-total').text(),
        sid = $('.order-total').data('sid');

      $('.order-col.product-col').each(function () {
        let product = {
          pid: $(this).data('pid'),
          qty: $(this).data('qty')
        };
        product_list.push(product);
      });

      axios({
        method: 'post',
        url: '/checkout',
        data: {
          aid: aid,
          product_list: product_list,
          cid: cid,
          total: total,
          sid: sid
        }
      }).then(() => {
        $('#checkout-modal').modal('show');
      })
    });

    $('#checkout-modal').on('hidden.bs.modal', function () {
      window.location.href = '/user/orders';
    })
  }

  if ($(document.body).is('.page-shop')) {
    // Filter and sort products
    function filterProductShop() {
      let minPrice = parseInt($('#price-min').val()),
        maxPrice = parseInt($('#price-max').val()),
        cat_lv1_list = [],
        sort = $('.store-sort .input-select option:selected').val(),
        id = window.location.pathname.split("/")[2];

      if (!minPrice) {
        return false;
      }

      $('.checkbox-filter .input-checkbox input:checked').each(function () {
        cat_lv1_list.push($(this).data('id'));
      });

      axios({
        method: 'POST',
        url: `/shop/${id}/search`,
        data: {
          minPrice: minPrice,
          maxPrice: maxPrice,
          cat_lv1: cat_lv1_list,
          sort: sort
        }
      }).then(function (res) {
        document.querySelector('#store > .row').innerHTML = '';
        if (res.data.length > 0) {
          res.data.forEach(product => {
            let tpl = document.querySelector('#product-div'),
              clone = tpl.content.cloneNode(true),
              p_link = clone.querySelector('.product-link'),
              p_img = clone.querySelector('.product-img'),
              p_sale = clone.querySelector('.product-label .sale'),
              p_purchased = clone.querySelector('.product-purchased'),
              p_name = clone.querySelector('.product-name a'),
              price_1 = clone.querySelector('.product-price span'),
              price_2 = clone.querySelector('.product-old-price');
            p_link.href = `/product/${product.id}/show`;
            p_img.style.backgroundImage = `url(${product['img']})`;
            if (product.sale_percent) {
              p_sale.textContent = `${product.sale_percent}%`;
            } else {
              p_sale.style.display = 'none';
            }
            p_purchased.textContent = `Đã bán ${product.purchased_number}`;
            p_name.textContent = product.name;
            p_name.href = `/product/${product.id}/show`;
            price_1.textContent = product.sale_price;
            price_2.textContent = (product.sale_price === product.price) ? '' : product.price;
            document.querySelector('#store > .row').appendChild(clone);
          });
        } else {
          $('#store > .row').html('<p class="no-products">Không có sản phẩm nào.</p>');
        }
      })
    }

    // Handle event change category filter
    $('.checkbox-filter .input-checkbox input').on('change', function () {
      filterProductShop();
    });

    // Sort
    $('.store-sort .input-select').change(function () {
      filterProductShop();
    });

    // slider gia ban
    $('.input-number').each(function () {
      let $this = $(this),
        $input = $this.find('input[type="number"]'),
        up = $this.find('.qty-up'),
        down = $this.find('.qty-down');

      down.on('click', function () {
        let value = parseInt($input.val()) - 1000;
        $input.val(value);
        $input.trigger('change');
      })

      up.on('click', function () {
        let value = parseInt($input.val()) + 1000;
        $input.val(value);
        $input.trigger('change');
      })
    });

    let priceInputMax = document.getElementById('price-max'),
      priceInputMin = document.getElementById('price-min');

    $(priceInputMax).on('change', function () {
      updatePriceSlider($(this).parent(), this.value)
    });

    $(priceInputMin).on('change', function () {
      updatePriceSlider($(this).parent(), this.value)
    });

    function updatePriceSlider(elem, value) {
      if (elem.hasClass('price-min')) {
        priceSlider.noUiSlider.set([value, null]);
      } else if (elem.hasClass('price-max')) {
        priceSlider.noUiSlider.set([null, value]);
      }
    }

    // Price Slider
    var priceSlider = document.getElementById('price-slider');
    if (priceSlider) {
      let minPrice = parseInt(document.querySelector('#productMinPrice').value),
        maxPrice = parseInt(document.querySelector('#productMaxPrice').value);
      nouislider.create(priceSlider, {
        start: [minPrice, maxPrice],
        connect: true,
        step: 1000,
        range: {
          'min': minPrice,
          'max': maxPrice
        },
        format: {
          to: function (value) {
            return value;
          },
          from: function (value) {
            return Number(value);
          }
        }
      });

      priceSlider.noUiSlider.on('set', function (values, handle) {
        var value = values[handle];
        handle ? priceInputMax.value = value : priceInputMin.value = value;
        filterProductShop();
      });
    }
  }

  /////////////////////////////////////////////////////
  // For admin

  // active sidebar
  $('.page-admin #sidebar-main a.nav-link').each(function () {
    if (this.href === window.location.href) {
      $(this).addClass('active');
      return false;
    }
  });

  // page manage coupons
  if ($(document.body).is('.page-admin.manage-coupons')) {
    // edit
    $('.pads-container tbody').on('click', 'tr a.btn-edit', function (e) {
      e.preventDefault();
      let tr = $(this).closest('tr'),
        percent = (tr.find('.percent').text()).slice(0, -1),
        money = tr.find('.money').text(),
        start = tr.find('.start').text(),
        id = tr.find('.id').text(),
        code = tr.find('.code').text(),
        end = tr.find('.end').text(),
        numbers = tr.find('.numbers').text(),
        modal = $('#edit-coupon-modal');
      modal.find('.counpon-code').text(code);
      modal.find('.form').prop('action', `/admin/edit-coupon/${id}`);
      modal.find('#percent').val(percent);
      modal.find('#coupon-money').val(money);
      modal.find('#start').val(start);
      modal.find('#end').val(end);
      modal.find('#number').val(numbers);
      modal.modal('show');
    });

    // delete
    $('.pads-container tbody').on('click', 'tr a.btn-delete', function (e) {
      e.preventDefault();
      let tr = $(this).closest('tr'),
        id = tr.find('.id').text(),
        modal = $('#delete-coupon-modal');
      modal.find('.form-delete').prop('action', `/admin/coupon/${id}/delete`);
      modal.modal('show');
    });

    $('.pad-filters #search').on('input', function () {
      searchCoupons();
    });

    $('#filter-category').change(function () {
      searchCoupons();
    });

    $('#sort').change(function (e) {
      searchCoupons();
    });

    function searchCoupons() {
      let search = $('.pad-filters #search').val(),
        filter = $('#filter-category option:selected').val(),
        sort = $('#sort option:selected').val();
      axios({
        method: 'post',
        url: '/admin/coupon/search',
        data: {
          search: search,
          filter: filter,
          sort: sort
        }
      }).then((res) => {
        let tbody = document.querySelector('.pads-container table tbody');

        // empty tbody
        while (tbody.lastChild) {
          tbody.removeChild(tbody.lastChild);
        }

        if (res.data.length > 0) {
          res.data.forEach(coupon => {
            let tpl = document.querySelector('#coupon-row'),
              clone = tpl.content.cloneNode(true),
              td = clone.querySelectorAll('td');
            td[0].innerText = coupon.id;
            td[1].innerText = coupon.code;
            td[2].innerText = coupon.sale_in_percent + '%';
            td[3].innerText = coupon.sale_in_money;
            td[4].innerText = coupon.created_date;
            td[5].innerText = coupon.start_at;
            td[6].innerText = coupon.end_at;
            td[7].innerText = coupon.status;
            td[8].innerText = coupon.numbers;
            td[9].innerText = coupon.used;
            tbody.appendChild(clone);
          });
        } else {
          $(tbody).html(`
          <tr>
            <td colspan="12">Không có mã giảm giá nào</td>
          </tr>
          `);
        }
      })
    }
  }

  // page manage users
  if ($(document.body).is('.page-admin.manage-users')) {
    // unblock
    $('.pads-container tbody').on('click', 'tr a.secondary-btn', function (e) {
      e.preventDefault();
      $('#unblock-modal form').prop('action', $(this).prop('href'));
      $('#unblock-modal').modal('show');
    });

    // block
    $('.pads-container tbody').on('click', 'tr a.primary-btn', function (e) {
      e.preventDefault();
      $('#block-modal form').prop('action', $(this).prop('href'));
      $('#block-modal').modal('show');
    });

    $('.pad-filters #search').on('input', function () {
      searchUsers();
    });

    $('#filter-category').change(function () {
      searchUsers();
    })

    $('#sort').change(function (e) {
      searchUsers();
    });

    function searchUsers() {
      let search = $('.pad-filters #search').val(),
        filter = $('#filter-category option:selected').val(),
        sort = $('#sort option:selected').val();
      axios({
        method: 'post',
        url: '/admin/user/search',
        data: {
          search: search,
          filter: filter,
          sort: sort
        }
      }).then((res) => {
        let tbody = document.querySelector('.pads-container table tbody');

        // empty tbody
        while (tbody.lastChild) {
          tbody.removeChild(tbody.lastChild);
        }

        if (res.data.length > 0) {
          res.data.forEach(user => {
            let tpl = document.querySelector('#admin-users-row'),
              clone = tpl.content.cloneNode(true),
              td = clone.querySelectorAll('td'),
              a = clone.querySelector('td a');
            td[0].innerText = user.username;
            td[1].innerText = user.email;
            td[2].innerText = user.created_date;
            if (user.is_banned) {
              td[3].classList.add('text-danger')
              td[3].innerText = 'Blocked';
              a.href = `/admin/user/${user.id}/unblock`;
              a.classList.add('secondary-btn');
              a.innerText = 'Unblock';
            } else {
              td[3].classList.add('text-success')
              td[3].innerText = 'Active';
              a.href = `/admin/user/${user.id}/block`;
              a.classList.add('primary-btn');
              a.innerText = 'Block';
            }
            if (user.id == 1) {
              td[5].innerHTML = '';
            }
            td[4].innerText = user.isShop ? 'Có' : 'Không';
            tbody.appendChild(clone);
          });
        } else {
          $(tbody).html(`
          <tr>
            <td colspan="12">Không có người dùng nào</td>
          </tr>
          `);
        }
      })
    }
  }

  // page manage orders
  if ($(document.body).is('.page-admin.manage-orders')) {
    $('.pad-filters #search').on('input', function () {
      adminSearchOrders();
    });

    $('#filter-category').change(function () {
      adminSearchOrders();
    });

    function adminSearchOrders() {
      let search = $('.pad-filters #search').val(),
        status = $('#filter-category option:selected').val();
      axios({
        method: 'post',
        url: '/admin/orders/search',
        data: {
          search: search,
          status: status
        }
      }).then((res) => {
        let tbody = document.querySelector('.pads-container table tbody');

        // empty tbody
        while (tbody.lastChild) {
          tbody.removeChild(tbody.lastChild);
        }

        if (res.data.length > 0) {
          res.data.forEach(order => {
            let tpl = document.querySelector('#admin-order-row'),
              clone = tpl.content.cloneNode(true),
              td = clone.querySelectorAll('td'),
              ol = clone.querySelector('td > ol'),
              shop_link = clone.querySelector('.shop-link'),
              status = clone.querySelector('div.order-status'),
              link = clone.querySelector('.primary-btn');
            td[0].innerText = order.id;
            order.products.forEach(product => {
              let tpl1 = document.querySelector('#product-li'),
                clone1 = tpl1.content.cloneNode(true),
                a1 = clone1.querySelector('a'),
                span = clone1.querySelector('span');
              a1.href = `/product/${product.id}/show`;
              a1.textContent = product.name;
              span.textContent = product.qty;
              ol.appendChild(clone1);
            });
            td[2].textContent = order.username;
            shop_link.href = `/shop/${order.supplier_id}`;
            shop_link.textContent = order.supplier_name;
            td[4].innerText = order.time;
            if (order.status_class) {
              status.classList.add(order.status_class);
            }
            status.innerText = order.status;
            td[6].innerText = order.total_price;
            link.href = `/order-detail/${order.id}`;
            tbody.appendChild(clone);
          });
        } else {
          $(tbody).html(`
          <tr>
            <td colspan="7">Không có đơn hàng nào.</td>
          </tr>
          `);
        }
      })
    }
  }

  ///////////////////////////////////////////////////////////
  // trang nguoi dung
  $('.page-user #sidebar-main a.nav-link').each(function () {
    if (this.href === window.location.href) {
      $(this).addClass('active');
      return false;
    }
  });

  // page manage orders
  if ($(document.body).is('.page-user.manage-orders')) {
    $('.pad-filters #search').on('input', function () {
      userSearchOrders();
    });

    $('#filter-category').change(function () {
      userSearchOrders();
    });

    function userSearchOrders() {
      let search = $('.pad-filters #search').val(),
        status = $('#filter-category option:selected').val();
      axios({
        method: 'post',
        url: '/user/orders/search',
        data: {
          search: search,
          status: status
        }
      }).then((res) => {
        let tbody = document.querySelector('.pads-container table tbody');

        // empty tbody
        while (tbody.lastChild) {
          tbody.removeChild(tbody.lastChild);
        }

        if (res.data.length > 0) {
          res.data.forEach(order => {
            let tpl = document.querySelector('#user-order-row'),
              clone = tpl.content.cloneNode(true),
              td = clone.querySelectorAll('td'),
              ol = clone.querySelector('td > ol'),
              shop_link = clone.querySelector('.shop-link'),
              status = clone.querySelector('div.order-status'),
              link = clone.querySelector('.primary-btn');
            td[0].innerText = order.id;
            order.products.forEach(product => {
              let tpl1 = document.querySelector('#product-li'),
                clone1 = tpl1.content.cloneNode(true),
                a1 = clone1.querySelector('a'),
                span = clone1.querySelector('span');
              a1.href = `/product/${product.id}/show`;
              a1.textContent = product.name;
              span.textContent = product.qty;
              ol.appendChild(clone1);
            });
            shop_link.href = `/shop/${order.supplier_id}`;
            shop_link.textContent = order.supplier_name;
            td[3].innerText = order.time;
            if (order.status_class) {
              status.classList.add(order.status_class);
            }
            status.innerText = order.status;
            td[5].innerText = order.total_price;
            link.href = `/order-detail/${order.id}`;
            tbody.appendChild(clone);
          });
        } else {
          $(tbody).html(`
          <tr>
            <td colspan="7">Không có đơn hàng nào.</td>
          </tr>
          `);
        }
      })
    }
  }

  // chinh sua thong tin ca nhan
  if ($(document.body).is('.page-user.edit')) {
    // click on input
    $('.btn-image').click(function (e) {
      e.preventDefault();
      $('.form #avatar').trigger('click');
    })

    // show image when select
    $('.form #avatar').change(function () {
      let input = document.querySelector('.form #avatar'),
        url = $(input).val(),
        ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase(),
        accepted_ext = ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'svg'];

      if (input.files && input.files[0] && ($.inArray(ext, accepted_ext) !== -1)) {
        let reader = new FileReader();
        reader.onload = function (e) {
          $('.form .image-name').text(input.files[0].name)
          $('.form .avt-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    });

    // Add address info
    $('.btn-add').click(function (e) {
      e.preventDefault();
      if ($('.address-wrapper .address-card').length >= 3) {
        alert('Chỉ được có tối đa 3 địa chỉ');
      } else {
        $('#add-address-modal').modal('show');
        return false;
      }
    });

    // Add address submit
    $('.form-add-address .primary-btn').click(function (e) {
      e.preventDefault();
      let name = $('.form-add-address .name').val(),
        phone = $('.form-add-address .phone').val(),
        address = $('.form-add-address .address').val();
      axios({
        method: 'post',
        url: '/user/address/add',
        data: {
          name: name,
          phone: phone,
          address: address
        }
      }).then((res) => {
        $('#add-address-modal').modal('hide');
        let wrapper = document.querySelector('.address-wrapper'),
          item = res.data,
          id = res.data.id,
          tpl = document.querySelector('#address-tpl'),
          clone = tpl.content.cloneNode(true),
          name = clone.querySelector('.row span.name'),
          name_wrapper = clone.querySelector('.row .col-8.name'),
          phone = clone.querySelector('.row .phone'),
          address = clone.querySelector('.row .address'),
          action = clone.querySelector('.col-md-4.text-right.action'),
          card = clone.querySelector('.address-card');

        name.textContent = item.name;
        phone.textContent = item.phone;
        address.textContent = item.address;
        card.dataset.aid = id;
        if (item.is_main_address) {
          $(name_wrapper).append(`<span class="default">Mặc định</span>`);
          card.classList.add('is-main');
        } else {
          $(action).append(`<div class="primary-btn primary-btn--square btn--small btn-default">Thiết lập mặc định</div>`);
        }

        wrapper.appendChild(clone);
      })
    });

    // Edit address info
    $('.address-wrapper').on('click', '.address-card .btn-edit', function (e) {
      e.preventDefault();
      let card = $(this).closest('.address-card'),
        id = card.data('aid'),
        url = `/user/address/${id}/edit`,
        name = card.find('span.name').text(),
        phone = card.find('.col-8.phone').text(),
        address = card.find('.col-8.address').text();
      $('.form-edit-address').prop('action', url);
      $('.form-edit-address .ed-name').val(name);
      $('.form-edit-address .ed-phone').val(phone);
      $('.form-edit-address .ed-address').val(address);
      $('#address-modal').modal('show');
    });

    $('.form-edit-address .primary-btn').click(function (e) {
      e.preventDefault();
      let url = $('.form-edit-address').prop('action'),
        id = url.split('/')[5],
        name = $('.form-edit-address .ed-name').val(),
        phone = $('.form-edit-address .ed-phone').val(),
        address = $('.form-edit-address .ed-address').val();
      axios({
        method: 'put',
        url: url,
        data: {
          name: name,
          phone: phone,
          address: address
        }
      }).then(() => {
        $('#address-modal').modal('hide');
        $(`.address-card[data-aid=${id}]`).find('span.name').text(name);
        $(`.address-card[data-aid=${id}]`).find('.col-8.phone').text(phone);
        $(`.address-card[data-aid=${id}]`).find('.col-8.address').text(address);
      })
    });

    // // delete address info
    $('.address-wrapper').on('click', '.address-card .btn-delete', function (e) {
      e.preventDefault();
      let card = $(this).closest('.address-card'),
        id = card.data('aid'),
        url = `/user/address/${id}/del`;
      $('#del-address').prop('action', url);
      $('#delete-modal').modal('show');
    });

    $('#del-address .btn-block').click(function (e) {
      e.preventDefault();
      let url = $('#del-address').prop('action'),
        id = url.split('/')[5];
      axios({
        method: 'delete',
        url: url
      }).then((res) => {
        $('#delete-modal').modal('hide');
        $(`.address-card[data-aid=${id}]`).remove();
        if (res.data != 0) {
          let card = $(`.address-card[data-aid=${res.data}]`),
            name_wrapper = card.find('.col-8.text-dark.name'),
            btn_default = card.find('.btn-default');
          card.addClass('is-main');
          name_wrapper.append('<span class="default">Mặc định</span>');
          btn_default.remove();
        }
      })
    });

    // Set default address
    $('.address-wrapper').on('click', '.address-card .btn-default', function (e) {
      e.preventDefault();
      let card = $(this).closest('.address-card'),
        id = card.data('aid'),
        url = `/user/address/${id}/default`,
        name_wrapper = card.find('.col-8.text-dark.name'),
        $this = $(this);
      axios({
        method: 'post',
        url: url
      }).then(() => {
        $('span.default').remove();
        $('.address-card').removeClass('is-main');
        $('.address-card .col-md-4.text-right.action').each(function (index, element) {
          if ($(element).find('.btn-default').length == 0) {
            $(element).append(`<div class="primary-btn primary-btn--square btn--small btn-default">Thiết lập mặc định</div>`);
          }
        });
        card.addClass('is-main');
        name_wrapper.append(`<span class="default">Mặc định</span>`);
        $this.remove();
      });
    });
  }
});