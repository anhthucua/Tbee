$(document).ready(function () {
  "use strict"

  // Not closing cart dropdown on click inside
  $('.cart-dropdown.dropdown-menu').on("click.bs.dropdown", function () {
    return $('.dropdown.cart').one('hide.bs.dropdown', function () {
      return false;
    });
  });

  // Login form submit
  $('#login-modal .form-signin .btn-lg').click(function (e) {
    e.preventDefault();
    $('.error-username').text('');
    $('.error-password').text('');
    axios({
      method: 'post',
      url: '/login',
      data: {
        username: $('.lg-username').val(),
        password: $('.lg-password').val(),
      }
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
      location.reload();
    })
      .catch(function (error) {
        let errors = error.response.data.errors;
        _.forOwn(errors, (value, key) => {
          value.forEach(el => {
            let err = document.createElement('div');
            if (el == 'Định dạng trường tên đăng nhập không hợp lệ.') {
              console.log(123);
              el = 'Tên đăng nhập chỉ gồm chữ và số, với ít nhất 1 chữ';
            }
            err.textContent = el;
            document.querySelector(`.form-signup .error-${key}`).appendChild(err);
          });
        })
      });
  });

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

  /////////////////////////////////////////

  // Input number
  $('.input-number').each(function () {
    var $this = $(this),
      $input = $this.find('input[type="number"]'),
      up = $this.find('.qty-up'),
      down = $this.find('.qty-down');

    down.on('click', function () {
      var value = parseInt($input.val()) - 1;
      value = value < 1 ? 1 : value;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value)
    })

    up.on('click', function () {
      var value = parseInt($input.val()) + 1;
      $input.val(value);
      $input.change();
      updatePriceSlider($this, value)
    })
  });

  var priceInputMax = document.getElementById('price-max'),
    priceInputMin = document.getElementById('price-min');

  priceInputMax.addEventListener('change', function () {
    updatePriceSlider($(this).parent(), this.value)
  });

  priceInputMin.addEventListener('change', function () {
    updatePriceSlider($(this).parent(), this.value)
  });

  function updatePriceSlider(elem, value) {
    if (elem.hasClass('price-min')) {
      console.log('min')
      priceSlider.noUiSlider.set([value, null]);
    } else if (elem.hasClass('price-max')) {
      console.log('max')
      priceSlider.noUiSlider.set([null, value]);
    }
  }

  // Price Slider
  var priceSlider = document.getElementById('price-slider');
  if (priceSlider) {
    noUiSlider.create(priceSlider, {
      start: [1, 999],
      connect: true,
      step: 1,
      range: {
        'min': 1,
        'max': 999
      }
    });

    priceSlider.noUiSlider.on('update', function (values, handle) {
      var value = values[handle];
      handle ? priceInputMax.value = value : priceInputMin.value = value
    });
  }
});