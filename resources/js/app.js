$(document).ready(function () {

  // Not closing cart dropdown on click inside
  $('.cart-dropdown.dropdown-menu').on("click.bs.dropdown", function () {
    return $('.dropdown.cart').one('hide.bs.dropdown', function () {
      return false;
    });
  });

  // Not closing noti dropdown on click inside
  $('.noti.dropdown-menu').on("click.bs.dropdown", function () {
    return $('.dropdown.noti-block').one('hide.bs.dropdown', function () {
      return false;
    });
  });

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
  $('.page-supplier.create .btn-image').click((e) => {
    e.preventDefault();
    $('.page-supplier.create #shopBanner').trigger('click');
  });

  $('.page-supplier.create #shopBanner').on('change', () => {
    let input = document.querySelector('.page-supplier.create #shopBanner'),
      url = $(input).val(),
      ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase(),
      accepted_ext = ['gif', 'png', 'jpg', 'jpeg', 'jfif', 'svg'];

    if (input.files && input.files[0] && ($.inArray(ext, accepted_ext) !== -1)) {
      let reader = new FileReader();
      reader.onload = function (e) {
        $('.page-supplier.create .image-name').text(input.files[0].name)
        $('.page-supplier.create .shop-banner').attr('src', e.target.result);
        $('.page-supplier.create .shop-banner').removeClass('d-none');
      }
      reader.readAsDataURL(input.files[0]);
    }
  })

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
          $('.add-product-form .upload-img-container').hide();
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

  // Input number
  // $('.input-number').each(function () {
  //   var $this = $(this),
  //     $input = $this.find('input[type="number"]'),
  //     up = $this.find('.qty-up'),
  //     down = $this.find('.qty-down');

  //   down.on('click', function () {
  //     var value = parseInt($input.val()) - 1;
  //     value = value < 1 ? 1 : value;
  //     $input.val(value);
  //     $input.change();
  //     updatePriceSlider($this, value)
  //   })

  //   up.on('click', function () {
  //     var value = parseInt($input.val()) + 1;
  //     $input.val(value);
  //     $input.change();
  //     updatePriceSlider($this, value)
  //   })
  // });

  // var priceInputMax = document.getElementById('price-max'),
  //   priceInputMin = document.getElementById('price-min');

  // priceInputMax.addEventListener('change', function () {
  //   updatePriceSlider($(this).parent(), this.value)
  // });

  // priceInputMin.addEventListener('change', function () {
  //   updatePriceSlider($(this).parent(), this.value)
  // });

  // function updatePriceSlider(elem, value) {
  //   if (elem.hasClass('price-min')) {
  //     console.log('min')
  //     priceSlider.noUiSlider.set([value, null]);
  //   } else if (elem.hasClass('price-max')) {
  //     console.log('max')
  //     priceSlider.noUiSlider.set([null, value]);
  //   }
  // }

  // // Price Slider
  // var priceSlider = document.getElementById('price-slider');
  // if (priceSlider) {
  //   noUiSlider.create(priceSlider, {
  //     start: [1, 999],
  //     connect: true,
  //     step: 1,
  //     range: {
  //       'min': 1,
  //       'max': 999
  //     }
  //   });

  //   priceSlider.noUiSlider.on('update', function (values, handle) {
  //     var value = values[handle];
  //     handle ? priceInputMax.value = value : priceInputMin.value = value
  //   });
  // }
});