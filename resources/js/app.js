$(document).ready(function () {
  // Not closing noti dropdown on click inside
  $('.noti.dropdown-menu').on("click.bs.dropdown", function () {
    return $('.dropdown.noti-block').one('hide.bs.dropdown', function () {
      return false;
    });
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
    })

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
});